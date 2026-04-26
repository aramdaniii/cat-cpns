@extends('layouts.admin')

@section('title', 'Role Switch')

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
    .user-card {
        transition: all 0.3s ease;
    }
    .user-card:hover {
        transform: translateY(-2px);
    }
    .user-card input[type="radio"]:checked + label {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-color: #3b82f6;
        color: white;
    }
    .user-card input[type="radio"]:checked + label .user-badge {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
</style>
        <!-- Header Section -->
        <div class="fade-in mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-2">
                        Role Switch
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Switch antar akun user untuk testing development
                    </p>
                </div>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="fade-in-delay-1 mb-6">
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-amber-600 text-lg mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-amber-800 font-semibold mb-1">⚠️ Perhatian</h3>
                    <p class="text-amber-700 text-sm">
                        Fitur ini hanya untuk testing development. Jangan digunakan di production environment!
                    </p>
                </div>
            </div>
        </div>

        <!-- Current Status Alert -->
        @if(session('original_user_id'))
            <div class="fade-in-delay-1 mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-blue-800 font-semibold mb-1">🔄 Current Status</h3>
                            <p class="text-blue-700 text-sm">
                                Anda sedang login sebagai user lain
                            </p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.role-switch.back') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors duration-200 text-sm">
                            <i class="fas fa-undo mr-2"></i>
                            Switch Back to Admin
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- User Selection Form -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(251,146,60,0.1)] border border-slate-100 p-8">
                <form method="POST" action="{{ route('admin.role-switch.switch') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-2">Pilih User untuk Switch</h2>
                        <p class="text-slate-600 text-sm">
                            Klik pada kartu user untuk memilih target switch
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        @forelse(App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                            <div class="user-card">
                                <input type="radio" 
                                       name="user_id" 
                                       id="user_{{ $user->id }}" 
                                       value="{{ $user->id }}" 
                                       required
                                       class="hidden">
                                <label for="user_{{ $user->id }}" 
                                       class="block cursor-pointer bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-blue-300 hover:shadow-md transition-all duration-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <h3 class="font-semibold text-slate-900 truncate">
                                                    {{ $user->name }}
                                                </h3>
                                                <div class="user-badge">
                                                    @if($user->isAdmin())
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700 transition-colors duration-200">
                                                            <i class="fas fa-shield-alt mr-1"></i>
                                                            Admin
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 transition-colors duration-200">
                                                            <i class="fas fa-user mr-1"></i>
                                                            User
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="text-slate-600 text-sm truncate">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-users text-slate-400 text-2xl"></i>
                                    </div>
                                    <p class="text-slate-600 font-medium">Tidak ada user lain untuk di-switch</p>
                                    <p class="text-slate-500 text-sm mt-1">Buat user baru terlebih dahulu</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-amber-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                            <i class="fas fa-exchange-alt mr-2"></i>
                            Switch User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Add interactive selection effect
        document.querySelectorAll('.user-card input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove all selected states
                document.querySelectorAll('.user-card label').forEach(label => {
                    label.classList.remove('ring-2', 'ring-blue-500');
                });
                
                // Add selected state to checked label
                if (this.checked) {
                    const label = this.nextElementSibling;
                    label.classList.add('ring-2', 'ring-blue-500');
                }
            });
        });
    </script>
@endsection
