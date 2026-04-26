# CAT CPNS Project

Aplikasi Simulasi Tes CAT CPNS menggunakan Laravel 11 dan MySQL.

## Setup Instructions

### Prerequisites
- PHP 8.2+
- MySQL Database
- Composer
- Web Server (Apache/Nginx)
- barryvdh/laravel-domPDF (for PDF generation)

### Installation Steps

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

5. **Create Admin User**
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   App\Models\User::create([
       'name' => 'Admin',
       'email' => 'admin@example.com',
       'password' => Hash::make('password'),
       'role' => 'admin'
   ]);
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

### Access Points

- **Main Page**: http://localhost:8000
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/register
- **User Dashboard**: http://localhost:8000/dashboard
- **Admin Dashboard**: http://localhost:8000/admin/dashboard

### Default Admin Credentials
- Email: admin@catcpns.com
- Password: admin123

### Testing Role System
1. **Run seeder** to create default admin:
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

2. **Login as Admin**:
   - Navigate to http://localhost:8000/login
   - Use admin credentials above

3. **Access Admin Features**:
   - Dashboard: http://localhost:8000/admin/dashboard
   - User Management: http://localhost:8000/admin/users
   - Role Switch: http://localhost:8000/admin/role-switch

4. **Test Role Protection**:
   - Try accessing admin routes as regular user (should redirect)
   - Test user management CRUD operations

5. **Test Soal Management**:
   - Run seeder: `php artisan db:seed --class=SoalSeeder`
   - Access: http://localhost:8000/admin/soals
   - Test CRUD operations for questions
   - Test category filtering (auto-submit dropdown)
   - Test bulk delete functionality
   - Test pagination with filter preservation

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

### Testing CSV Upload
1. **Prepare Sample CSV File**:
   - Download template from: http://localhost:8000/admin/soals/template
   - Fill in sample data following the format guide

2. **Upload CSV File**:
   - Navigate to: http://localhost:8000/admin/soals
   - Click "Upload CSV" button to open modal
   - Select prepared CSV file (.csv or .txt)
   - Click "Import" button

3. **Verify Upload Results**:
   - Check for successful import message
   - Verify data in Soal Management interface
   - Test error handling with invalid data

4. **Export Functionality**:
   - Export all soal: http://localhost:8000/admin/soals/export
   - Export by category: http://localhost:8000/admin/soals/export?kategori=TWK

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
1. **Start New Test**:
   - Navigate to: http://localhost:8000/test
   - Select category (TWK/TIU/TKP) and number of questions
   - Click "Mulai Tes"

2. **Take the Test**:
   - Use sidebar to navigate between questions
   - Click answer options to select
   - Use keyboard shortcuts (1-4 for answers, arrow keys for navigation)
   - Monitor progress indicator

3. **Complete Test**:
   - Answer all questions or click "Selesai"
   - View detailed results with score and analysis
   - Review correct/incorrect answers with explanations

4. **Test Features**:
   - Previous/Next navigation
   - Question number color coding
   - Real-time progress tracking
   - Test cancellation option
   - Modal review before submission
   - Automatic synchronization of answered questions

### Testing Performance Analytics
1. **View Analytics**:
   - Login as regular user
   - Navigate to: http://localhost:8000/dashboard
   - View "Analisis Performa Anda" card

2. **Analytics Features**:
   - View progress bars for TWK, TIU, TKP scores
   - Color-coded scores (Green > 80%, Yellow 60-79%, Red < 60%)
   - Read smart study suggestions based on lowest score
   - Analytics only shown if user has completed tests

### Testing PDF Certificate Download
1. **Generate Certificate**:
   - Complete a test with score ≥ 65%
   - Navigate to: http://localhost:8000/certificates

2. **Download PDF**:
   - Click "Unduh PDF" button on certificate
   - PDF will be generated using DomPDF (server-side)
   - Certificate includes: name, scores, status, verification code

3. **Certificate Features**:
   - Elegant design with border and header
   - TWK/TIU/TKP individual scores
   - Total score with correct percentage calculation
   - Certificate number and verification code

## Dependencies

### Core Dependencies
- Laravel Framework ^11.0
- Laravel Sanctum ^4.0
- Laravel Tinker ^2.0
- Barryvdh DomPDF ^3.1 (for PDF certificate generation)

### Development Dependencies
- Faker PHP ^1.23
- Laravel Pint ^1.13
- PHPUnit ^11.0

### Note on Dependencies
- `maatwebsite/excel` was removed due to dependency conflicts with Laravel 11
- `laravel/tinker` updated from ^1.0 to ^2.0 for Laravel 11 compatibility

## Project Structure

```
cat-cpns/
|-- app/
|   |-- Http/
|   |   |-- Controllers/
|   |   |-- Middleware/
|   |   |-- Requests/
|   |-- Models/
|   |-- Providers/
|-- database/
|   |-- migrations/
|   |-- seeders/
|-- resources/
|   |-- views/
|   |-- css/
|   |-- js/
|-- routes/
|   |-- web.php
|   |-- api.php
|-- public/
|-- storage/
|-- .env
|-- composer.json
```
