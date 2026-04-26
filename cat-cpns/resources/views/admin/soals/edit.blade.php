@extends('layouts.admin')

@section('title', 'Edit Soal')

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
            <div class="flex items-center space-x-4 mb-6">
                <a href="{{ route('admin.soals.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Edit Soal #{{ $soal->id }}
                </h1>
            </div>
        </div>

        <!-- Form Card -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                        <form method="POST" action="{{ route('admin.soals.update', $soal) }}">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Left Column - Main Content -->
                                <div class="lg:col-span-2 space-y-6">
                                    <!-- Category Field -->
                                    <div>
                                        <label for="kategori" class="block text-sm font-medium text-slate-700 mb-2">
                                            Kategori Soal
                                        </label>
                                        <select id="kategori" name="kategori" required
                                                class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                            @foreach($kategoriOptions as $key => $label)
                                                <option value="{{ $key }}" {{ old('kategori', $soal->kategori) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Tingkat Kesulitan Field -->
                                    <div>
                                        <label for="difficulty_level" class="block text-sm font-medium text-slate-700 mb-2">
                                            Tingkat Kesulitan
                                        </label>
                                        <select id="difficulty_level" name="difficulty_level" required
                                                class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                            <option value="">Pilih Tingkat Kesulitan</option>
                                            <option value="mudah" {{ old('difficulty_level', $soal->difficulty_level) == 'mudah' ? 'selected' : '' }}>Mudah</option>
                                            <option value="sedang" {{ old('difficulty_level', $soal->difficulty_level) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                            <option value="sulit" {{ old('difficulty_level', $soal->difficulty_level) == 'sulit' ? 'selected' : '' }}>Sulit</option>
                                        </select>
                                        @error('difficulty_level')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Question Field -->
                                    <div>
                                        <label for="pertanyaan" class="block text-sm font-medium text-slate-700 mb-2">
                                            Pertanyaan
                                        </label>
                                        <textarea id="pertanyaan" name="pertanyaan" rows="4" required
                                                  class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm resize-none">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                                        @error('pertanyaan')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Discussion Field -->
                                    <div>
                                        <label for="pembahasan" class="block text-sm font-medium text-slate-700 mb-2">
                                            Pembahasan
                                        </label>
                                        <textarea id="pembahasan" name="pembahasan" rows="3"
                                                  class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm resize-none">{{ old('pembahasan', $soal->pembahasan) }}</textarea>
                                        @error('pembahasan')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column - Answer Options -->
                                <div class="space-y-6">
                                    <div class="bg-slate-50/80 rounded-xl p-6">
                                        <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center">
                                            <i class="fas fa-list-check mr-2 text-blue-600"></i>
                                            Pilihan Jawaban
                                        </h3>
                                        
                                        <div class="space-y-4">
                                            @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                                                <div>
                                                    <label class="block text-sm font-medium text-slate-700 mb-1">
                                                        Opsi {{ $option }}
                                                    </label>
                                                    <input type="text" 
                                                           id="opsi_{{ strtolower($option) }}" 
                                                           name="opsi_{{ strtolower($option) }}" 
                                                           value="{{ old('opsi_' . strtolower($option), $soal->{'opsi_' . strtolower($option)}) }}" 
                                                           {{ $option == 'E' ? '' : 'required' }}
                                                           class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                                    @error('opsi_' . strtolower($option))
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Correct Answer Card -->
                                    <div id="jawaban-benar-card" class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                                        <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center">
                                            <i class="fas fa-check-circle mr-2 text-blue-600"></i>
                                            Jawaban Benar
                                        </h3>
                                        <select id="jawaban_benar" name="jawaban_benar" required
                                                class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                            <option value="">Pilih Jawaban</option>
                                            <option value="A" {{ old('jawaban_benar', $soal->jawaban_benar) == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ old('jawaban_benar', $soal->jawaban_benar) == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ old('jawaban_benar', $soal->jawaban_benar) == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ old('jawaban_benar', $soal->jawaban_benar) == 'D' ? 'selected' : '' }}>D</option>
                                            <option value="E" {{ old('jawaban_benar', $soal->jawaban_benar) == 'E' ? 'selected' : '' }}>E</option>
                                        </select>
                                        @error('jawaban_benar')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Bobot Poin Card (TKP Only) -->
                                    <div id="poin-card" class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-100 hidden">
                                        <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center">
                                            <i class="fas fa-star mr-2 text-amber-600"></i>
                                            Bobot Poin (TKP)
                                        </h3>
                                        <div class="space-y-3">
                                            @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                                                <div class="flex items-center space-x-3">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-white border-2 border-amber-300 rounded-full text-xs font-bold text-amber-600">
                                                        {{ $option }}
                                                    </span>
                                                    <input type="number" 
                                                           id="poin_{{ strtolower($option) }}" 
                                                           name="poin_{{ strtolower($option) }}" 
                                                           value="{{ old('poin_' . strtolower($option), data_get($soal, 'poin_' . strtolower($option), '')) }}" 
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

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-200">
                                <a href="{{ route('admin.soals.index') }}" 
                                   class="px-6 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200 flex items-center space-x-2">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali</span>
                                </a>
                                <button type="submit" 
                                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg flex items-center space-x-2">
                                    <i class="fas fa-save"></i>
                                    <span>Update Soal</span>
                                </button>
                            </div>
                        </form>
                    </div>
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

            // Trigger on page load
            if (document.getElementById('kategori').value === 'TKP') {
                document.getElementById('kategori').dispatchEvent(new Event('change'));
            }
        </script>
@endsection
