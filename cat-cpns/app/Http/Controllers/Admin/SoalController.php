<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Services\ExcelService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SoalController extends Controller
{
    /**
     * Display a listing of soal.
     */
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'all');
        
        $query = Soal::query();
        
        if ($kategori !== 'all') {
            $query->byKategori($kategori);
        }
        
        $soals = $query->latest()->paginate(10)->withQueryString();
        $kategoriOptions = Soal::getKategoriOptions();
        
        return view('admin.soals.index', compact('soals', 'kategoriOptions', 'kategori'));
    }

    /**
     * Show the form for creating a new soal.
     */
    public function create()
    {
        $kategoriOptions = Soal::getKategoriOptions();
        return view('admin.soals.create', compact('kategoriOptions'));
    }

    /**
     * Store a newly created soal in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string', 'min:10'],
            'opsi_a' => ['required', 'string', 'max:255'],
            'opsi_b' => ['required', 'string', 'max:255'],
            'opsi_c' => ['required', 'string', 'max:255'],
            'opsi_d' => ['required', 'string', 'max:255'],
            'opsi_e' => ['nullable', 'string', 'max:255'],
            'jawaban_benar' => ['nullable', 'string', Rule::in(['A', 'B', 'C', 'D', 'E'])],
            'pembahasan' => ['nullable', 'string'],
            'kategori' => ['required', 'string', Rule::in(['TWK', 'TIU', 'TKP'])],
            'difficulty_level' => ['nullable', 'string', Rule::in(['mudah', 'sedang', 'sulit'])],
            'poin_a' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_b' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_c' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_d' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_e' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        $data = $request->all();

        // Handle poin values based on category
        if ($data['kategori'] !== 'TKP') {
            // For TWK/TIU: set all poin to 0
            $data['poin_a'] = 0;
            $data['poin_b'] = 0;
            $data['poin_c'] = 0;
            $data['poin_d'] = 0;
            $data['poin_e'] = 0;
        } else {
            // For TKP: set jawaban_benar to null and ensure poin values
            $data['jawaban_benar'] = null;
            $data['poin_a'] = $data['poin_a'] ?? 0;
            $data['poin_b'] = $data['poin_b'] ?? 0;
            $data['poin_c'] = $data['poin_c'] ?? 0;
            $data['poin_d'] = $data['poin_d'] ?? 0;
            $data['poin_e'] = $data['poin_e'] ?? 0;
        }

        Soal::create($data);

        return redirect()->route('admin.soals.index')
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    /**
     * Display the specified soal.
     */
    public function show(Soal $soal)
    {
        return view('admin.soals.show', compact('soal'));
    }

    /**
     * Show the form for editing the specified soal.
     */
    public function edit(Soal $soal)
    {
        $kategoriOptions = Soal::getKategoriOptions();
        return view('admin.soals.edit', compact('soal', 'kategoriOptions'));
    }

    /**
     * Update the specified soal in storage.
     */
    public function update(Request $request, Soal $soal)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string', 'min:10'],
            'opsi_a' => ['required', 'string', 'max:255'],
            'opsi_b' => ['required', 'string', 'max:255'],
            'opsi_c' => ['required', 'string', 'max:255'],
            'opsi_d' => ['required', 'string', 'max:255'],
            'opsi_e' => ['nullable', 'string', 'max:255'],
            'jawaban_benar' => ['nullable', 'string', Rule::in(['A', 'B', 'C', 'D', 'E'])],
            'pembahasan' => ['nullable', 'string'],
            'kategori' => ['required', 'string', Rule::in(['TWK', 'TIU', 'TKP'])],
            'difficulty_level' => ['nullable', 'string', Rule::in(['mudah', 'sedang', 'sulit'])],
            'poin_a' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_b' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_c' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_d' => ['nullable', 'integer', 'min:0', 'max:5'],
            'poin_e' => ['nullable', 'integer', 'min:0', 'max:5'],
        ]);

        $data = $request->all();

        // Handle poin values based on category
        if ($data['kategori'] !== 'TKP') {
            // For TWK/TIU: set all poin to 0
            $data['poin_a'] = 0;
            $data['poin_b'] = 0;
            $data['poin_c'] = 0;
            $data['poin_d'] = 0;
            $data['poin_e'] = 0;
        } else {
            // For TKP: set jawaban_benar to null and ensure poin values
            $data['jawaban_benar'] = null;
            $data['poin_a'] = $data['poin_a'] ?? 0;
            $data['poin_b'] = $data['poin_b'] ?? 0;
            $data['poin_c'] = $data['poin_c'] ?? 0;
            $data['poin_d'] = $data['poin_d'] ?? 0;
            $data['poin_e'] = $data['poin_e'] ?? 0;
        }

        $soal->update($data);

        return redirect()->route('admin.soals.index')
            ->with('success', 'Soal berhasil diperbarui!');
    }

    /**
     * Remove the specified soal from storage.
     */
    public function destroy(Soal $soal)
    {
        $soal->delete();

        return redirect()->route('admin.soals.index')
            ->with('success', 'Soal berhasil dihapus!');
    }

    /**
     * Bulk delete soals
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'soal_ids' => ['required', 'array'],
            'soal_ids.*' => ['exists:soals,id'],
        ]);

        Soal::whereIn('id', $request->soal_ids)->delete();

        return redirect()->route('admin.soals.index')
            ->with('success', count($request->soal_ids) . ' soal berhasil dihapus!');
    }

    /**
     * Show upload form
     */
    public function uploadForm()
    {
        return view('admin.soals.upload');
    }

    /**
     * Import soal from CSV using native PHP
     */
    public function import(Request $request)
    {
        // Increase execution time to 5 minutes for large imports
        set_time_limit(300);

        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:10240'], // Max 10MB, CSV or TXT
        ]);

        try {
            $file = $request->file('file');
            $filePath = $file->getPathname();

            $handle = fopen($filePath, 'r');

            if ($handle === false) {
                throw new \Exception('Gagal membuka file CSV');
            }

            // Skip header row
            fgetcsv($handle);

            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            $rowNumber = 2; // Start from row 2 (after header)
            $batchSize = 100; // Process in batches of 100 rows
            $batch = [];

            while (($data = fgetcsv($handle)) !== false) {
                try {
                    // Map CSV columns to database fields
                    $soalData = [
                        'kategori' => $data[0] ?? 'TWK',
                        'tingkat_kesulitan' => $data[1] ?? 'Sedang',
                        'pertanyaan' => $data[2] ?? '',
                        'opsi_a' => $data[3] ?? '',
                        'opsi_b' => $data[4] ?? '',
                        'opsi_c' => $data[5] ?? '',
                        'opsi_d' => $data[6] ?? '',
                        'opsi_e' => $data[7] ?? '',
                        'jawaban_benar' => strtoupper($data[8] ?? 'A'),
                        'pembahasan' => $data[9] ?? '',
                    ];

                    // Validate required fields
                    if (empty($soalData['pertanyaan']) || empty($soalData['opsi_a']) || empty($soalData['opsi_b']) || empty($soalData['opsi_c']) || empty($soalData['opsi_d'])) {
                        $errors[] = "Baris {$rowNumber}: Data tidak lengkap";
                        $errorCount++;
                        $rowNumber++;
                        continue;
                    }

                    // Validate jawaban_benar
                    if (!in_array($soalData['jawaban_benar'], ['A', 'B', 'C', 'D', 'E'])) {
                        $soalData['jawaban_benar'] = 'A';
                    }

                    // Validate kategori
                    if (!in_array($soalData['kategori'], ['TWK', 'TIU', 'TKP'])) {
                        $soalData['kategori'] = 'TWK';
                    }

                    $batch[] = $soalData;

                    // Insert batch when it reaches batch size
                    if (count($batch) >= $batchSize) {
                        Soal::insert($batch);
                        $successCount += count($batch);
                        $batch = []; // Clear batch
                    }

                } catch (\Exception $e) {
                    $errors[] = "Baris {$rowNumber}: " . $e->getMessage();
                    $errorCount++;
                }

                $rowNumber++;
            }

            // Insert remaining records in batch
            if (!empty($batch)) {
                Soal::insert($batch);
                $successCount += count($batch);
            }

            fclose($handle);

            if (!empty($errors)) {
                $errorMessage = 'Import selesai dengan beberapa error:<br>';
                foreach (array_slice($errors, 0, 10) as $error) { // Show max 10 errors
                    $errorMessage .= $error . "<br>";
                }
                if (count($errors) > 10) {
                    $errorMessage .= "... dan " . (count($errors) - 10) . " error lainnya";
                }

                return redirect()->route('admin.soals.index')
                    ->with('warning', $errorMessage)
                    ->with('success', $successCount . ' soal berhasil diimport');
            }

            return redirect()->route('admin.soals.index')
                ->with('success', $successCount . ' soal berhasil diimport!');

        } catch (\Exception $e) {
            return redirect()->route('admin.soals.index')
                ->with('error', 'Error saat import: ' . $e->getMessage());
        }
    }

    /**
     * Export soal to CSV using native PHP
     */
    public function export(Request $request)
    {
        $kategori = $request->get('kategori', null);

        $query = Soal::query();

        if ($kategori && $kategori !== 'all') {
            $query->where('kategori', $kategori);
        }

        $soals = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="Data_Soal_CAT_CPNS.csv"',
        ];

        $callback = function() use ($soals) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, "\xEF\xBB\xBF");

            // CSV Header
            fputcsv($file, [
                'ID',
                'Kategori',
                'Tingkat Kesulitan',
                'Pertanyaan',
                'Pilihan A',
                'Pilihan B',
                'Pilihan C',
                'Pilihan D',
                'Pilihan E',
                'Jawaban Benar',
                'Poin A',
                'Poin B',
                'Poin C',
                'Poin D',
                'Poin E',
                'Pembahasan'
            ]);

            // CSV Data
            foreach ($soals as $soal) {
                fputcsv($file, [
                    $soal->id,
                    $soal->kategori,
                    $soal->difficulty_level ?? 'Sedang',
                    $soal->pertanyaan,
                    $soal->opsi_a,
                    $soal->opsi_b,
                    $soal->opsi_c,
                    $soal->opsi_d,
                    $soal->opsi_e ?? '',
                    $soal->jawaban_benar,
                    $soal->poin_a ?? 0,
                    $soal->poin_b ?? 0,
                    $soal->poin_c ?? 0,
                    $soal->poin_d ?? 0,
                    $soal->poin_e ?? 0,
                    $soal->pembahasan ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Download template CSV using native PHP
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="Template_Soal_CPNS.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fprintf($file, "\xEF\xBB\xBF");

            // CSV Header
            fputcsv($file, [
                'kategori',
                'tingkat_kesulitan',
                'pertanyaan',
                'pilihan_a',
                'pilihan_b',
                'pilihan_c',
                'pilihan_d',
                'pilihan_e',
                'jawaban_benar',
                'pembahasan'
            ]);

            // Sample data row
            fputcsv($file, [
                'TWK',
                'Sedang',
                'Contoh pertanyaan TWK tentang Pancasila',
                'Pilihan A',
                'Pilihan B',
                'Pilihan C',
                'Pilihan D',
                'Pilihan E (opsional)',
                'A',
                'Pembahasan jawaban'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
