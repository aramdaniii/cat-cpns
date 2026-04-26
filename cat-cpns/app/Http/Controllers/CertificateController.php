<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\TestSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display user's certificates
     */
    public function index()
    {
        $certificates = Certificate::where('user_id', Auth::id())
            ->with('testSession')
            ->latest()
            ->paginate(10);

        return view('certificates.index', compact('certificates'));
    }

    /**
     * Display specific certificate
     */
    public function show(Certificate $certificate)
    {
        // Check if user owns the certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        return view('certificates.show', compact('certificate'));
    }

    /**
     * Get certificate data for PDF generation (JSON API)
     */
    public function getPdfData(Certificate $certificate)
    {
        // Check if user owns the certificate
        if ($certificate->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $session = $certificate->testSession;
        
        // Recalculate percentage with correct formula
        $maxSkor = $certificate->total_questions * 5;
        $correctPercentage = $maxSkor > 0 ? round(($certificate->score / $maxSkor) * 100, 2) : 0;

        return response()->json([
            'user_name' => Auth::user()->name,
            'title' => $certificate->title,
            'description' => $certificate->description,
            'category' => $certificate->category,
            'percentage' => $correctPercentage,
            'twk_score' => $certificate->twk_score ?? 0,
            'tiu_score' => $certificate->tiu_score ?? 0,
            'tkp_score' => $certificate->tkp_score ?? 0,
            'exam_date' => $session ? $session->finished_at->format('d M Y') : $certificate->issued_at->format('d M Y'),
            'certificate_number' => $certificate->certificate_number,
            'verification_code' => $certificate->verification_code,
            'status' => $certificate->status,
        ]);
    }

    /**
     * Download certificate as PDF (returns JSON data for frontend)
     */
    public function download(Certificate $certificate)
    {
        // Check if user owns the certificate
        if ($certificate->user_id !== Auth::id()) {
            abort(403);
        }

        // Load certificate with user relationship
        $certificate->load('user', 'testSession');

        // Generate PDF using DomPDF
        $pdf = Pdf::loadView('certificates.pdf', compact('certificate'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Times New Roman',
            ]);

        $filename = 'Sertifikat_' . str_replace(' ', '_', $certificate->title) . '_' . $certificate->certificate_number . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Verify certificate by verification code
     */
    public function verify($code)
    {
        $certificate = Certificate::verifyByCode($code);

        if (!$certificate) {
            return view('certificates.verify', [
                'certificate' => null,
                'error' => 'Sertifikat tidak ditemukan atau kode verifikasi tidak valid.'
            ]);
        }

        return view('certificates.verify', compact('certificate'));
    }

    /**
     * Generate certificate for completed test
     */
    public static function generateForTestSession(TestSession $session)
    {
        // Only generate certificate for passed tests
        $percentage = $session->total_questions > 0 ? ($session->score / $session->total_questions) * 100 : 0;
        if ($percentage < 65) {
            return null;
        }

        // Check if certificate already exists
        $existingCertificate = Certificate::where('test_session_id', $session->id)->first();
        if ($existingCertificate) {
            return $existingCertificate;
        }

        return Certificate::createFromTestSession($session);
    }

    /**
     * Revoke certificate (admin only)
     */
    public function revoke(Certificate $certificate)
    {
        // This should be protected by admin middleware
        $certificate->revoke();
        
        return back()->with('success', 'Sertifikat berhasil dicabut.');
    }

    /**
     * Get certificate statistics (admin only)
     */
    public function statistics()
    {
        $totalCertificates = Certificate::count();
        $validCertificates = Certificate::valid()->count();
        $expiredCertificates = Certificate::where('status', 'expired')->count();
        $revokedCertificates = Certificate::where('status', 'revoked')->count();
        $expiringSoon = Certificate::expiringSoon()->count();

        $certificatesByCategory = Certificate::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        $monthlyIssued = Certificate::selectRaw('DATE_FORMAT(issued_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('issued_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.certificates.statistics', compact(
            'totalCertificates',
            'validCertificates',
            'expiredCertificates',
            'revokedCertificates',
            'expiringSoon',
            'certificatesByCategory',
            'monthlyIssued'
        ));
    }
}
