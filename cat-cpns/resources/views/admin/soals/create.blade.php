@extends('layouts.admin')

@section('title', 'Tambah Soal')

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
                        Tambah Soal Baru
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Buat soal baru untuk bank soal CAT CPNS
                    </p>
                </div>
                
                <a href="{{ route('admin.soals.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Soal
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8">
                <form method="POST" action="{{ route('admin.soals.store') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Kategori Field -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-slate-700 mb-2">
                                    Kategori Soal
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-layer-group text-slate-400 text-sm"></i>
                                    </div>
                                    <select id="kategori" 
                                            name="kategori" 
                                            required
                                            class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('kategori') border-red-300 @enderror">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kategori')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Tingkat Kesulitan Field -->
                            <div>
                                <label for="difficulty_level" class="block text-sm font-medium text-slate-700 mb-2">
                                    Tingkat Kesulitan
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-signal text-slate-400 text-sm"></i>
                                    </div>
                                    <select id="difficulty_level" 
                                            name="difficulty_level" 
                                            required
                                            class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('difficulty_level') border-red-300 @enderror">
                                        <option value="">Pilih Tingkat Kesulitan</option>
                                        <option value="mudah" {{ old('difficulty_level') == 'mudah' ? 'selected' : '' }}>Mudah</option>
                                        <option value="sedang" {{ old('difficulty_level') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                        <option value="sulit" {{ old('difficulty_level') == 'sulit' ? 'selected' : '' }}>Sulit</option>
                                    </select>
                                </div>
                                @error('difficulty_level')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pertanyaan Field -->
                            <div>
                                <label for="pertanyaan" class="block text-sm font-medium text-slate-700 mb-2">
                                    Pertanyaan
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                        <i class="fas fa-question text-slate-400 text-sm"></i>
                                    </div>
                                    <textarea id="pertanyaan" 
                                              name="pertanyaan" 
                                              rows="6" 
                                              required
                                              class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none @error('pertanyaan') border-red-300 @enderror"
                                              placeholder="Tulis pertanyaan di sini...">{{ old('pertanyaan') }}</textarea>
                                </div>
                                @error('pertanyaan')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pembahasan Field -->
                            <div>
                                <label for="pembahasan" class="block text-sm font-medium text-slate-700 mb-2">
                                    Pembahasan
                                    <span class="text-slate-400 font-normal">(Opsional)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                                        <i class="fas fa-lightbulb text-slate-400 text-sm"></i>
                                    </div>
                                    <textarea id="pembahasan" 
                                              name="pembahasan" 
                                              rows="4" 
                                              class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none @error('pembahasan') border-red-300 @enderror"
                                              placeholder="Tulis pembahasan atau penjelasan...">{{ old('pembahasan') }}</textarea>
                                </div>
                                @error('pembahasan')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sidebar Options -->
                        <div class="space-y-6">
                            <!-- Pilihan Jawaban Card -->
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-list-ul text-blue-600 mr-2"></i>
                                    <h3 class="text-lg font-semibold text-slate-900">Pilihan Jawaban</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">
                                                Opsi {{ $option }}
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-white border-2 border-slate-300 rounded-full text-xs font-bold text-slate-600">
                                                        {{ $option }}
                                                    </span>
                                                </div>
                                                <input type="text" 
                                                       id="opsi_{{ strtolower($option) }}" 
                                                       name="opsi_{{ strtolower($option) }}" 
                                                       value="{{ old('opsi_' . strtolower($option)) }}" 
                                                       {{ $option == 'E' ? '' : 'required' }}
                                                       class="w-full pl-12 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('opsi_' . strtolower($option)) border-red-300 @enderror"
                                                       placeholder="Jawaban {{ $option }}">
                                                @error('opsi_' . strtolower($option))
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Jawaban Benar Card -->
                            <div id="jawaban-benar-card" class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-check-circle text-blue-600 mr-2"></i>
                                    <h3 class="text-lg font-semibold text-slate-900">Jawaban Benar</h3>
                                </div>
                                
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-flag-checkered text-blue-600 text-sm"></i>
                                    </div>
                                    <select id="jawaban_benar" 
                                            name="jawaban_benar" 
                                            required
                                            class="w-full pl-10 pr-3 py-3 border border-blue-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('jawaban_benar') border-red-300 @enderror">
                                        <option value="">Pilih Jawaban</option>
                                        <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ old('jawaban_benar') == 'E' ? 'selected' : '' }}>E</option>
                                    </select>
                                </div>
                                @error('jawaban_benar')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Bobot Poin Card (TKP Only) -->
                            <div id="poin-card" class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100 hidden">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-star text-amber-600 mr-2"></i>
                                    <h3 class="text-lg font-semibold text-slate-900">Bobot Poin (TKP)</h3>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center justify-center w-6 h-6 bg-white border-2 border-amber-300 rounded-full text-xs font-bold text-amber-600">
                                                {{ $option }}
                                            </span>
                                            <input type="number" 
                                                   id="poin_{{ strtolower($option) }}" 
                                                   name="poin_{{ strtolower($option) }}" 
                                                   value="{{ old('poin_' . strtolower($option)) ?? '' }}" 
                                                   class="flex-1 px-3 py-2 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 text-sm"
                                                   placeholder="1-5">
                                        </div>
                                    @endforeach
                                </div>
                                <p class="mt-3 text-xs text-amber-600">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Masukkan bobot poin 1-5 untuk setiap opsi jawaban
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-slate-200">
                        <div class="text-sm text-slate-500 mb-4 sm:mb-0">
                            <i class="fas fa-info-circle mr-1"></i>
                            Pastikan semua field yang wajib diisi dengan benar
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.soals.index') }}" 
                               class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Soal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Toggle form fields based on category
            document.getElementById('kategori').addEventListener('change', function() {
                const kategori = this.value;
                const jawabanCard = document.getElementById('jawaban-benar-card');
                const poinCard = document.getElementById('poin-card');
                const jawabanSelect = document.getElementById('jawaban_benar');

                if (kategori === 'TKP') {
                    // TKP: Show poin card, hide jawaban benar
                    poinCard.classList.remove('hidden');
                    jawabanCard.classList.add('hidden');
                    jawabanSelect.removeAttribute('required');
                    jawabanSelect.value = ''; // Clear value when hidden
                } else {
                    // TWK/TIU: Show jawaban benar, hide poin card
                    poinCard.classList.add('hidden');
                    jawabanCard.classList.remove('hidden');
                    jawabanSelect.setAttribute('required', 'required');
                }
            });

            // Trigger on page load if category is pre-selected
            if (document.getElementById('kategori').value === 'TKP') {
                document.getElementById('kategori').dispatchEvent(new Event('change'));
            }
        </script>
@endsection
