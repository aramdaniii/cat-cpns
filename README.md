# CAT CPNS Project

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

Aplikasi Simulasi Tes CAT CPNS (Computer Assisted Test - Calon Pegawai Negeri Sipil) yang dibangun dengan Laravel 11 dan MySQL. Aplikasi ini dirancang untuk membantu persiapan tes CPNS dengan menyediakan simulasi tes yang komprehensif dan analisis performa.

## 🚀 Fitur Utama

- **📝 Simulasi Tes CAT CPNS** - Tes interaktif dengan kategori TWK, TIU, dan TKP
- **👥 Manajemen Pengguna** - Sistem role-based (Admin/User) dengan kontrol akses
- **📊 Analisis Performa** - Statistik lengkap dan saran pembelajaran yang dipersonalisasi
- **📋 Manajemen Soal** - CRUD soal dengan import/export CSV
- **🏆 Sertifikat PDF** - Generate sertifikat otomatis dengan DomPDF
- **⏱️ Timer Tes** - Countdown timer real-time dengan auto-submit
- **📱 Responsive Design** - Tampilan optimal di desktop dan mobile
- **🎯 Navigasi Pintar** - Sidebar dengan indikator progress dan status jawaban

## 📋 Persyaratan Sistem

### Prerequisites
- PHP 8.2+
- MySQL Database 8.0+
- Composer 2.0+
- Web Server (Apache/Nginx/Laravel Sail)
- barryvdh/laravel-domPDF (untuk generate PDF)

## 🛠️ Instalasi

### Cara Cepat (Quick Start)

```bash
# Clone repository
git clone https://github.com/aramdaniii/cat-cpns.git
cd cat-cpns

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cat_cpns
DB_USERNAME=root
DB_PASSWORD=your_password

# Run database setup
php artisan migrate
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=SoalSeeder

# Start server
php artisan serve
```

### Instalasi Manual

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure Database**
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cat_cpns
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Database**
   ```bash
   php artisan db:seed --class=AdminSeeder
   php artisan db:seed --class=SoalSeeder
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

## 🌐 Akses Aplikasi

### URL Endpoints
- **🏠 Halaman Utama**: http://localhost:8000
- **🔐 Login**: http://localhost:8000/login
- **📝 Register**: http://localhost:8000/register
- **👤 Dashboard User**: http://localhost:8000/dashboard
- **⚙️ Dashboard Admin**: http://localhost:8000/admin/dashboard
- **📝 Tes CAT**: http://localhost:8000/test
- **🏆 Sertifikat**: http://localhost:8000/certificates

### Default Admin Credentials
- **Email**: admin@catcpns.com
- **Password**: admin123

## 📱 Screenshots & Demo

*(Coming soon - Screenshots dari aplikasi yang sedang berjalan)*

## 🧪 Panduan Testing

### Testing Role System
1. **Run seeder** untuk membuat admin default:
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

2. **Login sebagai Admin**:
   - Navigasi ke http://localhost:8000/login
   - Gunakan kredensial admin di atas

3. **Akses Fitur Admin**:
   - Dashboard: http://localhost:8000/admin/dashboard
   - User Management: http://localhost:8000/admin/users
   - Role Switch: http://localhost:8000/admin/role-switch

4. **Test Role Protection**:
   - Coba akses admin routes sebagai user biasa (harus redirect)
   - Test CRUD operations user management

5. **Test Soal Management**:
   - Run seeder: `php artisan db:seed --class=SoalSeeder`
   - Access: http://localhost:8000/admin/soals
   - Test CRUD operations untuk soal
   - Test filtering kategori (auto-submit dropdown)
   - Test bulk delete functionality
   - Test pagination dengan filter preservation

### Features Implemented (STEP 1)
- [x] Laravel 11 Setup
- [x] MySQL Database Connection
- [x] User Authentication (Login/Register/Logout)
- [x] Role-based Access (Admin/User)
- [x] Admin Middleware Protection
- [x] Redirect Logic based on Role
- [x] Bootstrap 5 UI

### Features Implemented (STEP 2)
- [x] Admin Seeder for Default Admin User
- [x] User Management CRUD (Create, Read, Update, Delete)
- [x] Enhanced Admin Dashboard with User Statistics
- [x] Role-based Navigation Components
- [x] Role Switching for Testing
- [x] Protected Admin Routes

### Features Implemented (STEP 3)
- [x] Soal Model with Migration
- [x] Complete Soal CRUD Operations (Create, Read, Update, Delete)
- [x] Question Management System with Categories (TWK/TIU/TKP)
- [x] Admin Interface for Soal Management
- [x] Bulk Delete Functionality
- [x] Category-based Filtering
- [x] Sample Soal Seeder

### Features Implemented (STEP 4)
- [x] Native PHP CSV Import/Export (fputcsv/fgetcsv)
- [x] CSV Import Functionality with Validation
- [x] CSV Export with Category Filtering
- [x] Template Download System
- [x] Bulk Import Error Handling
- [x] File Format Validation (CSV/TXT only)
- [x] Modal Import Interface in Admin Soals Page

### Features Implemented (STEP 5)
- [x] TestSession Model for Test Progress Tracking
- [x] CAT Test Interface with Modern UI
- [x] Sidebar Navigation with Question Numbers
- [x] Color-Coded Question Status (Answered/Current/Unanswered)
- [x] Question Navigation (Next/Previous)
- [x] Answer Selection and Tracking
- [x] Test Start and End Functionality
- [x] Test Results with Detailed Analysis
- [x] Keyboard Navigation Support
- [x] Responsive Design for Mobile and Desktop
- [x] Real-time Countdown Timer
- [x] Modal Review before Test Submission
- [x] Synchronization between Sidebar and Modal Review
- [x] Detection of Active Question Answers

### Features Implemented (STEP 6)
- [x] Performance Analytics on User Dashboard
- [x] Category-wise Score Calculation (TWK/TIU/TKP)
- [x] Dynamic Progress Bars with Color Coding
- [x] Smart Study Suggestions based on Lowest Score
- [x] Visual Statistics for User Improvement

### Features Implemented (STEP 7)
- [x] PDF Certificate Download (Server-side DomPDF)
- [x] Certificate Data JSON API Endpoint
- [x] Elegant Certificate Template Design
- [x] Certificate Verification System
- [x] Correct Percentage Calculation (score / total_questions * 5 * 100)
- [x] Unified PDF Generation from Both Test Result and Certificate View Pages

### Testing CAT Test
1. **Mulai Tes Baru**:
   - Navigasi ke: http://localhost:8000/test
   - Pilih kategori (TWK/TIU/TKP) dan jumlah soal
   - Klik "Mulai Tes"

2. **Mengerjakan Tes**:
   - Gunakan sidebar untuk navigasi antar soal
   - Klik opsi jawaban untuk memilih
   - Gunakan keyboard shortcuts (1-4 untuk jawaban, arrow keys untuk navigasi)
   - Monitor progress indicator

3. **Selesaikan Tes**:
   - Jawab semua soal atau klik "Selesai"
   - Lihat hasil detail dengan skor dan analisis
   - Review jawaban benar/salah dengan penjelasan

4. **Fitur Tes**:
   - Navigasi Previous/Next
   - Color coding nomor soal
   - Real-time progress tracking
   - Opsi pembatalan tes
   - Modal review sebelum submit
   - Synchronization otomatis jawaban

### Testing Performance Analytics
1. **Lihat Analytics**:
   - Login sebagai user biasa
   - Navigasi ke: http://localhost:8000/dashboard
   - Lihat card "Analisis Performa Anda"

2. **Fitur Analytics**:
   - Progress bars untuk skor TWK, TIU, TKP
   - Color-coded scores (Hijau > 80%, Kuning 60-79%, Merah < 60%)
   - Saran pembelajaran pintar berdasarkan skor terendah
   - Analytics hanya muncul jika user sudah menyelesaikan tes

### Testing PDF Certificate Download
1. **Generate Certificate**:
   - Selesaikan tes dengan skor ≥ 65%
   - Navigasi ke: http://localhost:8000/certificates

2. **Download PDF**:
   - Klik tombol "Unduh PDF" pada certificate
   - PDF akan digenerate menggunakan DomPDF (server-side)
   - Certificate includes: nama, skor, status, verification code

3. **Fitur Certificate**:
   - Design elegan dengan border dan header
   - Skor individual TWK/TIU/TKP
   - Total skor dengan kalkulasi persentase yang benar
   - Nomor certificate dan verification code

## 📦 Dependencies

### Core Dependencies
- **Laravel Framework** ^11.0 - PHP framework utama
- **Laravel Sanctum** ^4.0 - Authentication dan API security
- **Laravel Tinker** ^2.0 - Interactive REPL untuk debugging
- **Barryvdh DomPDF** ^3.1 - Generate PDF certificate

### Development Dependencies
- **Faker PHP** ^1.23 - Generate fake data untuk testing
- **Laravel Pint** ^1.13 - Code formatting dan style checking
- **PHPUnit** ^11.0 - Unit testing framework

### Catatan Dependencies
- `maatwebsite/excel` dihapus karena dependency conflicts dengan Laravel 11
- `laravel/tinker` diupdate dari ^1.0 ke ^2.0 untuk Laravel 11 compatibility
- Menggunakan native PHP `fputcsv/fgetcsv` untuk CSV import/export

## 🏗️ Struktur Project

```
cat-cpns/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Logic controllers
│   │   ├── Middleware/           # Custom middleware (Admin, dll)
│   │   └── Requests/             # Form request validation
│   ├── Models/                   # Eloquent models (User, Soal, TestSession)
│   └── Providers/               # Service providers
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data (Admin, Soal)
├── resources/
│   ├── views/                   # Blade templates
│   ├── css/                     # Custom CSS (Bootstrap 5)
│   └── js/                      # JavaScript functionality
├── routes/
│   ├── web.php                  # Web routes
│   └── api.php                  # API routes
├── public/                      # Public assets
├── storage/                     # File storage
├── .env                         # Environment configuration
└── composer.json               # PHP dependencies
```

## 🚀 Deployment

### Production Setup
```bash
# Install dependencies
composer install --optimize-autoloader --no-dev

# Set environment
cp .env.example .env
php artisan key:generate

# Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Link storage
php artisan storage:link
```

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=3306
DB_DATABASE=cat_cpns_production
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

## 🤝 Kontribusi

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

Project ini dilisensikan under MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## 📞 Kontak & Support

- **Developer**: Arif Ramdani
- **Email**: ariframdani0112@gmail.com
- **GitHub**: [@aramdaniii](https://github.com/aramdaniii)

## 🙏 Acknowledgments

- Laravel Framework untuk foundation yang powerful
- Bootstrap 5 untuk UI components yang modern
- DomPDF untuk PDF generation
- Seluruh kontributor dan community Laravel Indonesia

---

**⭐ Jika project ini membantu Anda, jangan lupa untuk memberikan star di GitHub!**
