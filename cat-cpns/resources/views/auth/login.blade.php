<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CAT CPNS</title>
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
    </style>
</head>
<body class="bg-slate-50/50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8 fade-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Masuk Akun</h1>
            <p class="text-slate-600">Selamat datang kembali di CAT CPNS</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8 fade-in-delay-1">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
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
                               autofocus
                               class="w-full pl-10 pr-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-300 @enderror"
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
                               class="w-full pl-10 pr-10 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-300 @enderror"
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
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember" 
                               @old('remember') ? 'checked' : ''
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-slate-700">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </button>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Lupa password?
                    </a>
                </div>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-slate-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" 
                       class="font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center fade-in-delay-1">
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
    </script>
</body>
</html>
