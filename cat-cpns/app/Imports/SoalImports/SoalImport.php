<?php

namespace App\Imports\SoalImports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class SoalImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip empty rows
        if (empty($row['pertanyaan']) || empty($row['jawaban_benar'])) {
            return null;
        }

        return new Soal([
            'pertanyaan' => $row['pertanyaan'],
            'opsi_a' => $row['opsi_a'] ?? '',
            'opsi_b' => $row['opsi_b'] ?? '',
            'opsi_c' => $row['opsi_c'] ?? '',
            'opsi_d' => $row['opsi_d'] ?? '',
            'jawaban_benar' => strtoupper($row['jawaban_benar']),
            'pembahasan' => $row['pembahasan'] ?? null,
            'kategori' => strtoupper($row['kategori']),
        ]);
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'pertanyaan' => ['required', 'string', 'min:10'],
            'opsi_a' => ['required', 'string', 'max:255'],
            'opsi_b' => ['required', 'string', 'max:255'],
            'opsi_c' => ['required', 'string', 'max:255'],
            'opsi_d' => ['required', 'string', 'max:255'],
            'jawaban_benar' => ['required', 'string', 'in:A,B,C,D'],
            'pembahasan' => ['nullable', 'string'],
            'kategori' => ['required', 'string', 'in:TWK,TIU,TKP'],
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages(): array
    {
        return [
            'pertanyaan.required' => 'Kolom pertanyaan wajib diisi',
            'pertanyaan.min' => 'Pertanyaan minimal 10 karakter',
            'opsi_a.required' => 'Kolom opsi_a wajib diisi',
            'opsi_b.required' => 'Kolom opsi_b wajib diisi',
            'opsi_c.required' => 'Kolom opsi_c wajib diisi',
            'opsi_d.required' => 'Kolom opsi_d wajib diisi',
            'jawaban_benar.required' => 'Kolom jawaban_benar wajib diisi',
            'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D',
            'kategori.required' => 'Kolom kategori wajib diisi',
            'kategori.in' => 'Kategori harus TWK, TIU, atau TKP',
        ];
    }

    /**
     * Handle errors
     */
    public function onError(\Throwable $e)
    {
        // Log error if needed
        \Log::error('Excel Import Error: ' . $e->getMessage());
    }
}
