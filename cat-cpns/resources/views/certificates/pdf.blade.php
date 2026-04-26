<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat - {{ $certificate->title }}</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', serif;
        }
    </style>
</head>
<body>
    <div style="padding: 0; font-family: 'Times New Roman', serif; max-width: 1123px; margin: 0 auto; background: white;">
        <!-- Decorative Border -->
        <div style="border: 15px solid #1e3a8a; padding: 60px; text-align: center; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); position: relative;">
            <!-- Inner decorative border -->
            <div style="border: 3px solid #3b82f6; padding: 40px; position: relative;">
                <!-- Corner decorations -->
                <div style="position: absolute; top: 20px; left: 20px; width: 60px; height: 60px; border-top: 4px solid #fbbf24; border-left: 4px solid #fbbf24;"></div>
                <div style="position: absolute; top: 20px; right: 20px; width: 60px; height: 60px; border-top: 4px solid #fbbf24; border-right: 4px solid #fbbf24;"></div>
                <div style="position: absolute; bottom: 20px; left: 20px; width: 60px; height: 60px; border-bottom: 4px solid #fbbf24; border-left: 4px solid #fbbf24;"></div>
                <div style="position: absolute; bottom: 20px; right: 20px; width: 60px; height: 60px; border-bottom: 4px solid #fbbf24; border-right: 4px solid #fbbf24;"></div>

                <!-- Logo Section -->
                <div style="margin-bottom: 40px;">
                    <div style="display: inline-block; width: 120px; height: 120px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);">
                        <span style="font-size: 60px; color: white; font-weight: bold;">CP</span>
                    </div>
                </div>

                <!-- Header -->
                <div style="margin-bottom: 30px;">
                    <h1 style="color: #1e3a8a; font-size: 48px; margin: 0; font-weight: bold; text-transform: uppercase; letter-spacing: 4px;">SERTIFIKAT</h1>
                    <p style="color: #6b7280; font-size: 20px; margin-top: 10px; letter-spacing: 2px;">CAT CPNS - SISTEM ASESMEN KOMPETENSI</p>
                </div>

                <!-- Decorative Line -->
                <div style="margin: 30px auto; width: 200px; height: 3px; background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);"></div>

                <!-- Recipient Section -->
                <div style="margin-bottom: 40px;">
                    <p style="color: #6b7280; font-size: 18px; margin: 0; font-style: italic;">Diberikan kepada</p>
                    <h2 style="color: #0f172a; font-size: 42px; margin: 15px 0; font-weight: bold; text-transform: uppercase; letter-spacing: 2px;">{{ $certificate->user->name }}</h2>
                </div>

                <!-- Achievement Section -->
                <div style="margin-bottom: 40px;">
                    <p style="color: #6b7280; font-size: 18px; margin: 0; font-style: italic;">Atas kelulusan dalam ujian</p>
                    <h3 style="color: #1e3a8a; font-size: 32px; margin: 15px 0; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">{{ $certificate->title }}</h3>
                </div>

                <!-- Score Table -->
                <div style="margin: 50px auto; max-width: 700px;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                        <tr>
                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TWK</p>
                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">{{ $certificate->twk_score ?? 0 }}%</p>
                            </td>
                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TIU</p>
                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">{{ $certificate->tiu_score ?? 0 }}%</p>
                            </td>
                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TKP</p>
                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">{{ $certificate->tkp_score ?? 0 }}%</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Total Score Section -->
                @php
                    $maxSkor = $certificate->total_questions * 5;
                    $correctPercentage = $maxSkor > 0 ? round(($certificate->score / $maxSkor) * 100, 2) : 0;
                @endphp
                <div style="margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 10px;">
                    <p style="color: white; font-size: 24px; margin: 0; font-weight: bold;">SKOR TOTAL</p>
                    <p style="color: #fbbf24; font-size: 56px; margin: 10px 0; font-weight: bold;">{{ $correctPercentage }}%</p>
                    <p style="color: {{ $correctPercentage >= 65 ? '#10b981' : '#ef4444' }}; font-size: 28px; margin: 10px 0; font-weight: bold; text-transform: uppercase;">{{ $correctPercentage >= 65 ? 'LULUS' : 'TIDAK LULUS' }}</p>
                </div>

                <!-- Certificate Details -->
                <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e5e7eb;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 15px; text-align: left;">
                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">NOMOR SERTIFIKAT</p>
                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0; font-family: 'Courier New', monospace;">{{ $certificate->certificate_number }}</p>
                            </td>
                            <td style="padding: 15px; text-align: left;">
                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">TANGGAL UJIAN</p>
                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0;">{{ $certificate->testSession ? $certificate->testSession->finished_at->format('d M Y') : $certificate->issued_at->format('d M Y') }}</p>
                            </td>
                            <td style="padding: 15px; text-align: left;">
                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">KODE VERIFIKASI</p>
                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0; font-family: 'Courier New', monospace;">{{ $certificate->verification_code }}</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Footer -->
                <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e5e7eb;">
                    <p style="color: #9ca3af; font-size: 14px; margin: 0; font-style: italic;">Sertifikat ini diterbitkan secara otomatis oleh sistem CAT CPNS</p>
                    <p style="color: #9ca3af; font-size: 12px; margin: 5px 0;">Dokumen ini sah dan dapat diverifikasi secara online</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
