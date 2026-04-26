<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Kelulusan</title>
    <style>
        @page {
            margin: 0px;
        }
        html, body {
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
        }
        .pdf-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            padding: 40px;
            overflow: hidden;
            page-break-inside: avoid;
            page-break-after: avoid;
        }
        .certificate-container {
            width: 100%;
            height: 100%;
            border: 15px solid #1e3a8a;
            padding: 40px;
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            box-sizing: border-box;
        }
        .certificate-inner {
            border: 3px solid #3b82f6;
            padding: 30px;
            position: relative;
            height: 100%;
            box-sizing: border-box;
        }
        .corner-decoration {
            position: absolute;
            width: 50px;
            height: 50px;
        }
        .corner-tl {
            top: 15px;
            left: 15px;
            border-top: 3px solid #fbbf24;
            border-left: 3px solid #fbbf24;
        }
        .corner-tr {
            top: 15px;
            right: 15px;
            border-top: 3px solid #fbbf24;
            border-right: 3px solid #fbbf24;
        }
        .corner-bl {
            bottom: 15px;
            left: 15px;
            border-bottom: 3px solid #fbbf24;
            border-left: 3px solid #fbbf24;
        }
        .corner-br {
            bottom: 15px;
            right: 15px;
            border-bottom: 3px solid #fbbf24;
            border-right: 3px solid #fbbf24;
        }
        .logo {
            display: inline-block;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);
            margin-bottom: 25px;
        }
        .logo span {
            font-size: 50px;
            color: white;
            font-weight: bold;
        }
        h1 {
            color: #1e3a8a;
            font-size: 40px;
            margin: 0 0 5px 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .subtitle {
            color: #6b7280;
            font-size: 16px;
            margin-top: 5px;
            letter-spacing: 1px;
        }
        .divider {
            margin: 20px auto;
            width: 150px;
            height: 2px;
            background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
        }
        .recipient-label {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
            font-style: italic;
        }
        h2 {
            color: #0f172a;
            font-size: 32px;
            margin: 8px 0 25px 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .achievement-label {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
            font-style: italic;
        }
        h3 {
            color: #1e3a8a;
            font-size: 24px;
            margin: 8px 0 30px 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .score-table {
            margin: 30px auto;
            max-width: 600px;
            width: 100%;
            border-collapse: collapse;
        }
        .score-table td {
            border: 2px solid #e5e7eb;
            padding: 15px;
            text-align: center;
            background: #f8fafc;
        }
        .score-label {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
            font-weight: bold;
        }
        .score-value {
            color: #1e3a8a;
            font-size: 28px;
            margin: 5px 0;
            font-weight: bold;
        }
        .total-score {
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            border-radius: 8px;
        }
        .total-score-label {
            color: white;
            font-size: 18px;
            margin: 0;
            font-weight: bold;
        }
        .total-score-value {
            color: #fbbf24;
            font-size: 42px;
            margin: 5px 0;
            font-weight: bold;
        }
        .status-pass {
            color: #10b981;
            font-size: 20px;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-fail {
            color: #ef4444;
            font-size: 20px;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }
        .details-table td {
            padding: 10px;
            text-align: left;
        }
        .detail-label {
            color: #6b7280;
            font-size: 12px;
            margin: 0;
            font-weight: bold;
        }
        .detail-value {
            color: #0f172a;
            font-size: 14px;
            margin: 3px 0;
            font-family: 'Courier New', monospace;
        }
        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
        }
        .footer p {
            color: #9ca3af;
            font-size: 12px;
            margin: 0;
            font-style: italic;
        }
        .footer p:last-child {
            font-size: 10px;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="pdf-wrapper">
        <div class="certificate-container">
        <div class="certificate-inner">
            <!-- Corner decorations -->
            <div class="corner-decoration corner-tl"></div>
            <div class="corner-decoration corner-tr"></div>
            <div class="corner-decoration corner-bl"></div>
            <div class="corner-decoration corner-br"></div>

            <!-- Logo Section -->
            <div class="logo">
                <span>CP</span>
            </div>

            <!-- Header -->
            <h1>SERTIFIKAT</h1>
            <p class="subtitle">CAT CPNS - SISTEM ASESMEN KOMPETENSI</p>

            <!-- Decorative Line -->
            <div class="divider"></div>

            <!-- Recipient Section -->
            <p class="recipient-label">Diberikan kepada</p>
            <h2>{{ $user_name ?? 'Nama Peserta' }}</h2>

            <!-- Achievement Section -->
            <p class="achievement-label">Atas kelulusan dalam ujian</p>
            <h3>{{ $title ?? 'Tes Kompetensi' }}</h3>

            <!-- Score Table -->
            <table class="score-table">
                <tr>
                    <td>
                        <p class="score-label">TWK</p>
                        <p class="score-value">{{ $twk_score ?? 0 }}%</p>
                    </td>
                    <td>
                        <p class="score-label">TIU</p>
                        <p class="score-value">{{ $tiu_score ?? 0 }}%</p>
                    </td>
                    <td>
                        <p class="score-label">TKP</p>
                        <p class="score-value">{{ $tkp_score ?? 0 }}%</p>
                    </td>
                </tr>
            </table>

            <!-- Total Score Section -->
            <div class="total-score">
                <p class="total-score-label">SKOR TOTAL</p>
                <p class="total-score-value">{{ $percentage ?? 0 }}%</p>
                @if(($percentage ?? 0) >= 65)
                    <p class="status-pass">LULUS</p>
                @else
                    <p class="status-fail">TIDAK LULUS</p>
                @endif
            </div>

            <!-- Certificate Details -->
            <table class="details-table">
                <tr>
                    <td>
                        <p class="detail-label">NOMOR SERTIFIKAT</p>
                        <p class="detail-value">{{ $certificate_number ?? '-' }}</p>
                    </td>
                    <td>
                        <p class="detail-label">TANGGAL UJIAN</p>
                        <p class="detail-value">{{ $exam_date ?? '-' }}</p>
                    </td>
                    <td>
                        <p class="detail-label">KODE VERIFIKASI</p>
                        <p class="detail-value">{{ $verification_code ?? '-' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Footer -->
            <div class="footer">
                <p>Sertifikat ini diterbitkan secara otomatis oleh sistem CAT CPNS</p>
                <p>Dokumen ini sah dan dapat diverifikasi secara online</p>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
