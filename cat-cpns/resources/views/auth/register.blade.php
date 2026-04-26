<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .fade-in-delay-1 {
            animation: fadeIn 0.8s ease-out 0.2s both;
        }
        .fade-in-delay-2 {
            animation: fadeIn 0.8s ease-out 0.4s both;
        }
    </style>
</head>
<body class="bg-slate-50/50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8 fade-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-user-plus text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Buat Akun Baru</h1>
            <p class="text-slate-600">Bergabung dengan CAT CPNS untuk memulai persiapan</p>
        </div>

        <!-- Register Form Card -->
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(16,185,129,0.1)] border border-slate-100 p-8 fade-in-delay-1">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-slate-400 text-sm"></i>
                        </div>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('name') border-red-300 @enderror"
                               placeholder="John Doe">
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-slate-400 text-sm"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required
                               class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('email') border-red-300 @enderror"
                               placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400 text-sm"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full pl-10 pr-10 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('password') border-red-300 @enderror"
                               placeholder="••••••••">
                        <button type="button" 
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-slate-400 text-sm hover:text-slate-600 transition-colors cursor-pointer" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex items-center justify-between text-xs text-slate-500 mb-1">
                            <span>Kekuatan password</span>
                            <span id="strengthText">-</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div id="strengthBar" class="h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400 text-sm"></i>
                        </div>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 @error('password_confirmation') border-red-300 @enderror"
                               placeholder="••••••••">
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <!-- Match Indicator -->
                    <div id="matchIndicator" class="mt-2 text-sm hidden">
                        <span class="flex items-center">
                            <i class="fas fa-check-circle mr-1"></i>
                            Password cocok
                        </span>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           required
                           class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded mt-1">
                    <label for="terms" class="ml-2 block text-sm text-slate-700">
                        Saya setuju dengan <a href="#" class="text-emerald-600 hover:text-emerald-700 transition-colors">syarat dan ketentuan</a> yang berlaku
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-slate-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" 
                       class="font-medium text-emerald-600 hover:text-emerald-700 transition-colors">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center fade-in-delay-2">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center text-slate-500 hover:text-slate-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke beranda
            </a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        const matchIndicator = document.getElementById('matchIndicator');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Password strength checker
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;

            const strengthPercent = (strength / 5) * 100;
            strengthBar.style.width = strengthPercent + '%';
            
            if (strength <= 2) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
                strengthText.textContent = 'Lemah';
                strengthText.className = 'text-red-500';
            } else if (strength <= 3) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-amber-500';
                strengthText.textContent = 'Sedang';
                strengthText.className = 'text-amber-500';
            } else {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-emerald-500';
                strengthText.textContent = 'Kuat';
                strengthText.className = 'text-emerald-500';
            }

            // Check password match
            checkPasswordMatch();
        });

        // Password match checker
        passwordConfirmInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirmInput.value;

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchIndicator.classList.remove('hidden');
                    matchIndicator.innerHTML = '<span class="flex items-center text-emerald-600"><i class="fas fa-check-circle mr-1"></i>Password cocok</span>';
                } else {
                    matchIndicator.classList.remove('hidden');
                    matchIndicator.innerHTML = '<span class="flex items-center text-red-600"><i class="fas fa-times-circle mr-1"></i>Password tidak cocok</span>';
                }
            } else {
                matchIndicator.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
