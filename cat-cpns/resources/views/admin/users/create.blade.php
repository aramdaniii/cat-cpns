@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="fade-in">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 mb-6">Tambah User Baru</h1>
                <p class="text-slate-600">Buat akun pengguna baru untuk sistem CAT CPNS</p>
            </div>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Create User Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 max-w-3xl mx-auto">
                        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 @enderror" 
                                       placeholder="Masukkan nama lengkap pengguna">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                       class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-500 @enderror" 
                                       placeholder="contoh@email.com">
                                @error('email')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                                <input type="password" id="password" name="password" required
                                       class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-500 @enderror" 
                                       placeholder="Masukkan password minimal 8 karakter">
                                @error('password')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                       class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password_confirmation') border-red-500 @enderror" 
                                       placeholder="Ulangi password yang sama">
                                @error('password_confirmation')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-slate-700 mb-2">Role Pengguna</label>
                                <select id="role" name="role" required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('role') border-red-500 @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                                <a href="{{ route('admin.users.index') }}" 
                                   class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200">
                                    Kembali
                                </a>
                                <button type="submit" 
                                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 flex items-center space-x-2">
                                    <i class="fas fa-save"></i>
                                    <span>Tambah User</span>
                                </button>
                            </div>
                        </form>
    </div>
</div>
@endsection
