@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="fade-in">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
                <p class="text-slate-600 mt-2">Ubah informasi pengguna: {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" id="password" name="password"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password_confirmation') border-red-500 @enderror">
                                @error('password_confirmation')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="role" class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                                <select id="role" name="role" required
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('role') border-red-500 @enderror">
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                                <a href="{{ route('admin.users.index') }}" 
                                   class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                    Kembali
                                </a>
                                <button type="submit" 
                                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105">
                                    Update User
                                </button>
                            </div>
                        </form>
    </div>
</div>
@endsection
