@extends('layouts.admin')

@section('title', 'Upload CSV')

@section('content')
<div class="fade-in">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 mb-6">Upload CSV Soal CPNS</h1>
                <p class="text-slate-600">Import soal dari file CSV ke bank soal CAT CPNS</p>
            </div>
            <a href="{{ route('admin.soals.index') }}" 
               class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Upload Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 max-w-4xl mx-auto">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {!! session('warning') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Upload Form Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3">Upload File CSV</h5>
                                <form method="POST" action="{{ route('admin.soals.import') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="file" class="form-label">Pilih File CSV</label>
                                                <input type="file" 
                                                       class="form-control @error('file') is-invalid @enderror" 
                                                       id="file" 
                                                       name="file" 
                                                       accept=".csv"
                                                       required>
                                                @error('file')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">
                                                    Format yang didukung: .csv (Maksimal 10MB)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label d-block">&nbsp;</label><br>
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="fas fa-upload"></i> Upload & Import
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Template Download Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="fas fa-download"></i> Download Template CSV
                                        </h5>
                                        <p class="card-text">
                                            Download template CSV untuk memastikan format file sesuai dengan yang dibutuhkan.
                                        </p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.soals.template') }}" class="btn btn-primary">
                                                <i class="fas fa-file-csv"></i> Download Template CSV
                                            </a>
                                            <a href="{{ route('admin.soals.export') }}" class="btn btn-info">
                                                <i class="fas fa-file-export"></i> Export Data CSV
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Format Guide Section -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-info-circle"></i> Format File CSV
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-3">File CSV harus memiliki kolom-kolom berikut (header case-sensitive):</p>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Kolom</th>
                                                        <th>Tipe</th>
                                                        <th>Required</th>
                                                        <th>Contoh</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><code>pertanyaan</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>Siapa nama presiden pertama Indonesia?</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>opsi_a</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>Soekarno</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>opsi_b</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>Soeharto</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>opsi_c</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>B.J. Habibie</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>opsi_d</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>Megawati</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>jawaban_benar</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>A</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>pembahasan</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-secondary">Tidak</span></td>
                                                        <td>Ir. Soekarno adalah presiden pertama...</td>
                                                    </tr>
                                                    <tr>
                                                        <td><code>kategori</code></td>
                                                        <td>Text</td>
                                                        <td><span class="badge bg-danger">Ya</span></td>
                                                        <td>TWK</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="alert alert-warning mt-3">
                                            <strong>Catatan:</strong>
                                            <ul class="mb-0">
                                                <li>Jawaban benar harus berupa huruf: A, B, C, atau D</li>
                                                <li>Kategori harus: TWK, TIU, atau TKP</li>
                                                <li>Baris kosong akan diabaikan</li>
                                                <li>Error pada baris tertentu tidak akan menghentikan proses import</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <a href="{{ route('admin.soals.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Soal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // File validation
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = 10 * 1024 * 1024; // 10MB
            const allowedTypes = ['text/csv'];
            
            if (file) {
                if (file.size > maxSize) {
                    alert('File terlalu besar. Maksimal ukuran file adalah 10MB.');
                    e.target.value = '';
                    return;
                }
                
                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan file CSV (.csv).');
                    e.target.value = '';
                    return;
                }
            }
        });
    </script>
</div>
@endsection
