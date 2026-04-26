@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="fade-in">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail User</h1>
                <p class="text-slate-600 mt-2">Informasi lengkap pengguna: {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- User Details Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">ID</div>
                                <div class="md:col-span-2 text-slate-900">{{ $user->id }}</div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">Nama</div>
                                <div class="md:col-span-2 text-slate-900 font-medium">{{ $user->name }}</div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">Email</div>
                                <div class="md:col-span-2 text-slate-900">{{ $user->email }}</div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">Role</div>
                                <div class="md:col-span-2">
                                    @if($user->isAdmin())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                            <i class="fas fa-shield-alt mr-1.5"></i>
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            <i class="fas fa-user mr-1.5"></i>
                                            User
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">Terdaftar</div>
                                <div class="md:col-span-2 text-slate-900">{{ $user->created_at->format('d M Y H:i') }}</div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-sm font-medium text-slate-500">Terakhir Update</div>
                                <div class="md:col-span-2 text-slate-900">{{ $user->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-6 border-t border-slate-200">
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                Kembali
                            </a>
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="px-4 py-2 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 transition-colors duration-200 flex items-center space-x-2"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            <i class="fas fa-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
</div>
@endsection
