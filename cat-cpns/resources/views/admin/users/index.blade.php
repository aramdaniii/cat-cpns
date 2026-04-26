@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }
    .fade-in-delay-1 {
        animation: fadeIn 0.6s ease-out 0.1s both;
    }
</style>
        <!-- Header Section -->
        <div class="fade-in mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-2">
                        Manajemen User
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Kelola semua pengguna sistem CAT CPNS
                    </p>
                </div>
                
                <a href="{{ route('admin.users.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah User
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success') || session('error'))
            <div class="fade-in-delay-1 mb-6">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-600 hover:text-emerald-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>
        @endif

        <!-- Users Table -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Terdaftar
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        #{{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-slate-900">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-slate-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->isAdmin())
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700">
                                                <i class="fas fa-shield-alt mr-1"></i>
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                <i class="fas fa-user mr-1"></i>
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               class="text-slate-400 hover:text-slate-600 transition-colors duration-200"
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="text-slate-400 hover:text-amber-600 transition-colors duration-200"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-slate-400 hover:text-red-600 transition-colors duration-200"
                                                            title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-slate-400 text-2xl"></i>
                                            </div>
                                            <p class="text-slate-600 font-medium">Belum ada user</p>
                                            <p class="text-slate-500 text-sm mt-1">Mulai dengan menambahkan user pertama</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 flex items-center justify-between">
                        <div class="text-sm text-slate-700">
                            Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> hingga 
                            <span class="font-medium">{{ $users->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $users->total() }}</span> user
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection
