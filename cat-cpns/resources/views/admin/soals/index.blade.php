@extends('layouts.admin')

@section('title', 'Manajemen Soal')

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
                        Manajemen Soal CPNS
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Kelola semua soal untuk tes CAT CPNS
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="openImportModal()"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                        <i class="fas fa-file-csv mr-2"></i>
                        Upload CSV
                    </button>
                    <a href="{{ route('admin.soals.export') }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i>
                        Export CSV
                    </a>
                    <a href="{{ route('admin.soals.create') }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-xl hover:from-indigo-600 hover:to-indigo-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Soal
                    </a>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="fade-in-delay-1 mb-6">
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
            </div>
        @endif

        <!-- Table Card -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 overflow-hidden">
                <!-- Filter Section -->
                <div class="bg-slate-50/80 px-6 py-4 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <form method="GET" action="{{ route('admin.soals.index') }}" class="flex-1">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 sm:flex-initial">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-filter text-slate-400 text-sm"></i>
                                        </div>
                                        <select name="kategori"
                                                onchange="this.form.submit()"
                                                class="w-full sm:w-auto pl-10 pr-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                            <option value="all" {{ $kategori == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                            @foreach($kategoriOptions as $key => $label)
                                                <option value="{{ $key }}" {{ $kategori == $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <button type="button" id="btn-hapus-terpilih"
                                class="px-4 py-2 bg-gradient-to-r from-rose-500 to-rose-600 text-white font-medium rounded-xl hover:from-rose-600 hover:to-rose-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg text-sm">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Terpilih
                        </button>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-6 py-3 text-left">
                                    <input type="checkbox" id="selectAll" onchange="toggleAllCheckboxes()"
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Jawaban
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse($soals as $soal)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="soal_ids[]" value="{{ $soal->id }}" class="soal-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        #{{ $soal->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($soal->kategori == 'TWK')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                <i class="fas fa-book mr-1"></i>
                                                TWK
                                            </span>
                                        @elseif($soal->kategori == 'TIU')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700">
                                                <i class="fas fa-brain mr-1"></i>
                                                TIU
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700">
                                                <i class="fas fa-user-check mr-1"></i>
                                                TKP
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-900 max-w-xs truncate" title="{{ $soal->pertanyaan }}">
                                            {{ Str::limit($soal->pertanyaan, 80) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                            {{ $soal->jawaban_benar }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.soals.show', $soal) }}" 
                                               class="text-slate-400 hover:text-blue-500 transition-colors duration-200"
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.soals.edit', $soal) }}" 
                                               class="text-slate-400 hover:text-amber-500 transition-colors duration-200"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.soals.destroy', $soal) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-slate-400 hover:text-rose-500 transition-colors duration-200"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus soal ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-question text-slate-400 text-2xl"></i>
                                            </div>
                                            <p class="text-slate-600 font-medium">Belum ada soal</p>
                                            <p class="text-slate-500 text-sm mt-1">Mulai dengan menambahkan soal pertama</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($soals->hasPages())
                    <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 flex items-center justify-between">
                        <div class="text-sm text-slate-700">
                            Menampilkan <span class="font-medium">{{ $soals->firstItem() }}</span> hingga 
                            <span class="font-medium">{{ $soals->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $soals->total() }}</span> soal
                            @if($kategori !== 'all')
                                (kategori: {{ $kategoriOptions[$kategori] ?? $kategori }})
                            @endif
                        </div>
                        <div>
                            {{ $soals->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        function toggleAllCheckboxes() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.soal-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }

        function confirmBulkDelete() {
            const checkboxes = document.querySelectorAll('.soal-checkbox:checked');
            
            if (checkboxes.length === 0) {
                alert('Pilih minimal satu soal untuk dihapus!');
                return false;
            }
            
            return confirm(`Yakin ingin menghapus ${checkboxes.length} soal yang dipilih?`);
        }

        // Update select all checkbox state
        document.querySelectorAll('.soal-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allCheckboxes = document.querySelectorAll('.soal-checkbox');
                const checkedBoxes = document.querySelectorAll('.soal-checkbox:checked');
                const selectAll = document.getElementById('selectAll');

                selectAll.checked = allCheckboxes.length === checkedBoxes.length;
            });
        });

        // Bulk delete handler
        document.getElementById('btn-hapus-terpilih').addEventListener('click', function() {
            let selected = Array.from(document.querySelectorAll('.soal-checkbox:checked')).map(cb => cb.value);
            
            if(selected.length === 0) {
                alert('Pilih minimal satu soal untuk dihapus.');
                return;
            }
            
            if(confirm('Yakin ingin menghapus ' + selected.length + ' soal terpilih?')) {
                let form = document.getElementById('form-bulk-delete');
                // Bersihkan input lama jika ada (sisakan token CSRF dan Method)
                form.querySelectorAll('input[name="soal_ids[]"]').forEach(el => el.remove());
                
                // Masukkan ID yang baru
                selected.forEach(id => {
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'soal_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });
                
                form.submit();
            }
        });

        // Import Modal Functions
        function openImportModal() {
            document.getElementById('importModal').classList.remove('hidden');
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.add('hidden');
        }
    </script>

    <!-- Form Bulk Delete Tersembunyi -->
    <form id="form-bulk-delete" action="{{ route('admin.soals.bulk-delete') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Import CSV Modal -->
    <div id="importModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-slate-900">
                        <i class="fas fa-file-csv text-emerald-600 mr-2"></i>
                        Import Soal dari CSV
                    </h3>
                    <button type="button" onclick="closeImportModal()" class="text-slate-400 hover:text-slate-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form action="{{ route('admin.soals.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            File CSV
                        </label>
                        <input type="file" name="file" accept=".csv,.txt" required
                               class="block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-emerald-50 file:text-emerald-700
                                      hover:file:bg-emerald-100
                                      cursor-pointer">
                        <p class="mt-2 text-xs text-slate-500">
                            Format: .csv atau .txt (Max 10MB)
                        </p>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('admin.soals.template') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            <i class="fas fa-download mr-1"></i>
                            Download Template CSV
                        </a>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeImportModal()"
                                class="flex-1 px-4 py-2 border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transition-colors">
                            <i class="fas fa-upload mr-2"></i>
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
