# CAT_CPNS_PROJECT.md

# 🚀 Project Roadmap Aplikasi CAT CPNS (Laravel + MySQL)

**Versi Pemula Total**
Tujuan: Membuat website simulasi CAT CPNS modern menggunakan Laravel.

---

# 📌 STACK YANG DIGUNAKAN

* Laravel 11
* PHP 8+
* MySQL
* Blade Template
* Bootstrap 5
* JavaScript
* OpenAI API (opsional tahap akhir)

---

# 🎯 TARGET PROJECT

Website memiliki fitur:

✅ Register & Login
✅ Role Admin / User
✅ Admin kelola soal
✅ Upload soal Excel
✅ Simulasi tes CAT
✅ Timer otomatis
✅ Penilaian TWK / TIU / TKP
✅ Passing grade
✅ AI pembahasan jawaban

---

# 📁 STRUKTUR FOLDER PROJECT

```text
cat-cpns/
├── app/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
│   └── web.php
└── .env
```

---

# 🗓 ROADMAP STEP BY STEP

---

# 🟢 STEP 1 — INSTALL & AUTH LOGIN

## Tujuan:

Membuat Laravel berjalan + login register.

## Kerjakan:

* Install Laravel
* Koneksi MySQL
* Install Laravel Breeze
* Login
* Register
* Logout

## Prompt ke Cursor:

```text
Buatkan sistem login register Laravel Breeze untuk project CAT CPNS.
Tambahkan role admin dan user.
Redirect admin ke /admin/dashboard
Redirect user ke /dashboard
Jelaskan step by step.
```

---

# 🔵 STEP 2 — ROLE ADMIN & USER

## Tujuan:

Membedakan user biasa dan admin.

## Kerjakan:

* Tambah kolom role di users
* Middleware role
* Proteksi route admin

## Prompt ke Cursor:

```text
Lanjutkan project Laravel.
Buat role admin dan user.
Gunakan middleware agar admin hanya bisa akses /admin/*
```

---

# 🟡 STEP 3 — CRUD SOAL CPNS

## Tabel soal:

| Field         | Tipe    |
| ------------- | ------- |
| id            | bigint  |
| pertanyaan    | text    |
| opsi_a        | varchar |
| opsi_b        | varchar |
| opsi_c        | varchar |
| opsi_d        | varchar |
| jawaban_benar | varchar |
| pembahasan    | text    |
| kategori      | enum    |

## Kategori:

* TWK
* TIU
* TKP

## Prompt ke Cursor:

```text
Buat CRUD soal Laravel lengkap.
Admin bisa tambah, edit, hapus, lihat soal.
Gunakan Bootstrap.
```

---

# 🟠 STEP 4 — UPLOAD EXCEL

## Tujuan:

Admin upload soal massal.

## Gunakan package:

```bash
composer require maatwebsite/excel
```

## Prompt ke Cursor:

```text
Tambahkan fitur upload Excel soal CAT CPNS menggunakan Laravel Excel.
Kolom file:
pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, jawaban_benar, pembahasan, kategori
```

---

# 🔴 STEP 5 — HALAMAN TES CAT

## Tujuan:

Simulasi CAT asli.

## Fitur:

* Sidebar nomor soal kiri
* Soal tengah
* Next / Previous
* Pilih jawaban
* Warna nomor:

  * hijau = sudah jawab
  * abu = belum

## Prompt ke Cursor:

```text
Buat halaman tes CAT CPNS modern pakai Blade + Bootstrap.
Sidebar nomor soal kiri, soal tengah.
Navigasi next previous.
```

---

# ⏱ STEP 6 — TIMER

## Fitur:

* Countdown
* Auto submit saat habis

## Prompt ke Cursor:

```text
Tambahkan timer countdown 100 menit pada halaman tes.
Jika waktu habis auto submit.
```

---

# 🟣 STEP 7 — NILAI & PASSING GRADE

## Passing Grade:

* TWK = 65
* TIU = 80
* TKP = 166

## Nilai:

* Benar = 5 poin

## Prompt ke Cursor:

```text
Buat sistem penilaian CAT CPNS.
Hitung TWK, TIU, TKP.
Tentukan status LULUS atau TIDAK LULUS.
```

---

# 🟤 STEP 8 — HALAMAN HASIL

## Tampilkan:

* Nilai TWK
* Nilai TIU
* Nilai TKP
* Status

## Prompt ke Cursor:

```text
Buat halaman hasil tes modern.
Tampilkan nilai per kategori dan status lulus.
```

---

# ⚫ STEP 9 — AI PEMBAHASAN (OPSIONAL)

## Gunakan OpenAI API

Jika user salah:

* kenapa salah
* jawaban benar
* penjelasan sederhana

## Prompt ke Cursor:

```text
Integrasikan OpenAI API Laravel.
Jika user salah menjawab, tampilkan pembahasan AI.
```

---

# ⚙️ PERINTAH PENTING

## Jalankan Laravel

```bash
php artisan serve
```

## Jalankan Migration

```bash
php artisan migrate
```

## Clear Cache

```bash
php artisan optimize:clear
```

---