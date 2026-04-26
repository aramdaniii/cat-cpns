<?php

namespace App\Exports\SoalExports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SoalExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    protected $kategori;

    /**
     * Constructor
     */
    public function __construct($kategori = null)
    {
        $this->kategori = $kategori;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Soal::query();
        
        if ($this->kategori) {
            $query->byKategori($this->kategori);
        }
        
        return $query->select([
            'pertanyaan',
            'opsi_a',
            'opsi_b', 
            'opsi_c',
            'opsi_d',
            'jawaban_benar',
            'pembahasan',
            'kategori'
        ])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'pertanyaan',
            'opsi_a',
            'opsi_b',
            'opsi_c',
            'opsi_d',
            'jawaban_benar',
            'pembahasan',
            'kategori'
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 50, // pertanyaan
            'B' => 20, // opsi_a
            'C' => 20, // opsi_b
            'D' => 20, // opsi_c
            'E' => 20, // opsi_d
            'F' => 15, // jawaban_benar
            'G' => 30, // pembahasan
            'H' => 10, // kategori
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'E2EFDA'
                    ]
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            // Auto-size for better readability
            'A' => [
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ],
            ],
            'G' => [
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                ],
            ],
        ];
    }
}
