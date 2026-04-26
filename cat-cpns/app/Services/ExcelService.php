<?php

namespace App\Services;

use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExcelService
{
    /**
     * Import soal from CSV file
     */
    public function importFromCsv($file)
    {
        $results = [
            'success' => 0,
            'errors' => [],
            'total' => 0
        ];

        $handle = fopen($file->getPathname(), 'r');
        if (!$handle) {
            throw new \Exception('Cannot open file');
        }

        // Skip header row
        $header = fgetcsv($handle);
        
        // Validate header
        $requiredHeaders = ['pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar', 'kategori'];
        if (!$this->validateHeaders($header, $requiredHeaders)) {
            fclose($handle);
            throw new \Exception('Invalid CSV format. Required headers: ' . implode(', ', $requiredHeaders));
        }

        $rowNumber = 2; // Start from row 2 (after header)
        
        while (($row = fgetcsv($handle)) !== FALSE) {
            $results['total']++;
            
            // Skip empty rows
            if (empty($row[0]) || empty($row[5])) {
                continue;
            }

            $data = [
                'pertanyaan' => $row[0] ?? '',
                'pilihan_a' => $row[1] ?? '',
                'pilihan_b' => $row[2] ?? '',
                'pilihan_c' => $row[3] ?? '',
                'pilihan_d' => $row[4] ?? '',
                'jawaban_benar' => strtoupper($row[5] ?? ''),
                'pembahasan' => $row[6] ?? null,
                'kategori' => strtoupper($row[7] ?? ''),
            ];

            // Validate data
            $validator = Validator::make($data, [
                'pertanyaan' => ['required', 'string', 'min:10'],
                'pilihan_a' => ['required', 'string', 'max:255'],
                'pilihan_b' => ['required', 'string', 'max:255'],
                'pilihan_c' => ['required', 'string', 'max:255'],
                'pilihan_d' => ['required', 'string', 'max:255'],
                'jawaban_benar' => ['required', 'string', 'in:A,B,C,D'],
                'pembahasan' => ['nullable', 'string'],
                'kategori' => ['required', 'string', 'in:TWK,TIU,TKP'],
            ]);

            if ($validator->fails()) {
                $results['errors'][] = [
                    'row' => $rowNumber,
                    'errors' => $validator->errors()->all()
                ];
            } else {
                try {
                    Soal::create($data);
                    $results['success']++;
                } catch (\Exception $e) {
                    $results['errors'][] = [
                        'row' => $rowNumber,
                        'errors' => ['Database error: ' . $e->getMessage()]
                    ];
                }
            }

            $rowNumber++;
        }

        fclose($handle);
        return $results;
    }

    /**
     * Export soal to CSV
     */
    public function exportToCsv($kategori = null)
    {
        $filename = 'soal_cpns_' . ($kategori ?? 'all') . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $query = Soal::query();
        
        if ($kategori) {
            $query->byKategori($kategori);
        }
        
        $soals = $query->get();

        $callback = function() use ($soals) {
            $file = fopen('php://output', 'w');
            
            // Add header
            fputcsv($file, [
                'pertanyaan',
                'pilihan_a',
                'pilihan_b',
                'pilihan_c',
                'pilihan_d',
                'jawaban_benar',
                'pembahasan',
                'kategori'
            ]);
            
            // Add data rows
            foreach ($soals as $soal) {
                fputcsv($file, [
                    $soal->pertanyaan,
                    $soal->pilihan_a,
                    $soal->pilihan_b,
                    $soal->pilihan_c,
                    $soal->pilihan_d,
                    $soal->jawaban_benar,
                    $soal->pembahasan,
                    $soal->kategori
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Download template CSV
     */
    public function downloadTemplate()
    {
        $filename = 'template_soal_cpns.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add header
            fputcsv($file, [
                'pertanyaan',
                'pilihan_a',
                'pilihan_b',
                'pilihan_c',
                'pilihan_d',
                'jawaban_benar',
                'pembahasan',
                'kategori'
            ]);
            
            // Add sample data
            fputcsv($file, [
                'Siapa nama presiden pertama Indonesia?',
                'Soekarno',
                'Soeharto',
                'B.J. Habibie',
                'Megawati',
                'A',
                'Ir. Soekarno adalah presiden pertama Indonesia yang menjabat pada tahun 1945-1967.',
                'TWK'
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Validate CSV headers
     */
    private function validateHeaders($header, $requiredHeaders)
    {
        if (!$header) return false;
        
        $header = array_map('strtolower', array_map('trim', $header));
        $requiredHeaders = array_map('strtolower', $requiredHeaders);
        
        foreach ($requiredHeaders as $required) {
            if (!in_array($required, $header)) {
                return false;
            }
        }
        
        return true;
    }
}
