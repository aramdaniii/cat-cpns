<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes CAT - CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .timer-display.warning {
            color: #f59e0b;
            animation: pulse 1s infinite;
        }
        
        .timer-display.danger {
            color: #ef4444;
            animation: pulse 0.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Modern Navbar -->
    <nav class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-slate-800">
                        <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>CAT CPNS
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('test.index') }}" class="text-blue-600 bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium">
                            Tes CAT
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-slate-600 text-sm font-medium">
                        Halo, {{ auth()->user()->name }}!
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-600 hover:text-red-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-8">
        <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
            <!-- Left Sidebar - Timer & Question Numbers (Order: Top on mobile, Left on desktop) -->
            <div class="lg:w-1/4 order-first lg:order-none">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6 sticky top-4 sm:top-6">
                    <!-- Timer Section -->
                    @if($session->timer_enabled)
                    <div class="bg-slate-50 rounded-xl p-4 mb-6">
                        <h6 class="text-center text-slate-600 font-semibold mb-3">
                            <i class="fas fa-clock text-blue-600 mr-2"></i> Waktu
                        </h6>
                        <div class="timer-display text-2xl font-bold text-center text-slate-800" id="timerDisplay">
                            00:00
                        </div>
                        <div class="h-2 bg-slate-200 rounded-full overflow-hidden mt-3">
                            <div class="timer-progress-bar h-full bg-gradient-to-r from-emerald-500 to-blue-600 transition-all duration-1000" id="timerProgress" 
                                 style="width: 100%"></div>
                        </div>
                        <div class="flex justify-center gap-2 mt-3">
                            <button type="button" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors" id="pauseBtn">
                                <i class="fas fa-pause"></i>
                            </button>
                            <button type="button" class="px-4 py-2 bg-emerald-100 text-emerald-600 rounded-lg text-sm font-medium hover:bg-emerald-200 transition-colors hidden" id="resumeBtn">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Question Numbers -->
                    <h6 class="text-slate-800 font-semibold mb-4">
                        <i class="fas fa-list text-blue-600 mr-2"></i> Nomor Soal
                    </h6>
                    <div class="flex flex-wrap gap-2">
                        @foreach($allQuestions as $index => $question)
                            <div class="sidebar-question-number w-10 h-10 rounded-full flex items-center justify-center text-sm font-medium transition-all cursor-pointer
                                @if($session->isQuestionAnswered($index)) bg-emerald-500 text-white shadow-md shadow-emerald-500/30
                                @elseif($index == $session->current_question) bg-blue-600 text-white shadow-md shadow-blue-500/30 transform scale-110
                                @else bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 @endif"
                                 onclick="navigateToQuestion({{ $index }})">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 text-sm text-slate-500">
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>
                            Sudah dijawab
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="w-3 h-3 rounded-full bg-blue-600 mr-2"></span>
                            Soal ini
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-full bg-slate-200 mr-2"></span>
                            Belum dijawab
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:w-1/2 w-full">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6 lg:p-8">
                    <form method="POST" action="{{ route('test.answer', $session) }}" id="answerForm">
                        @csrf
                        
                        <!-- Question Header -->
                        <div class="text-lg font-semibold text-slate-800 mb-6">
                            Soal {{ $session->current_question + 1 }} dari {{ $session->total_questions }} 
                            @if($currentQuestion->kategori === 'TWK')
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-medium ml-2">
                                    TWK
                                </span>
                            @elseif($currentQuestion->kategori === 'TIU')
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium ml-2">
                                    TIU
                                </span>
                            @elseif($currentQuestion->kategori === 'TKP')
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium ml-2">
                                    TKP
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-sm font-medium ml-2">
                                    {{ $currentQuestion->kategori }}
                                </span>
                            @endif
                        </div>
                        
                        <!-- Question Text -->
                        <div class="mb-8">
                            <div class="text-slate-700 leading-relaxed text-base">
                                {{ $currentQuestion->pertanyaan }}
                            </div>
                        </div>

                        <!-- Answer Options -->
                        @php
                            // Collect options into array, filter out empty ones
                            $pilihan = array_filter([
                                'A' => $currentQuestion->opsi_a,
                                'B' => $currentQuestion->opsi_b,
                                'C' => $currentQuestion->opsi_c,
                                'D' => $currentQuestion->opsi_d,
                                'E' => $currentQuestion->opsi_e,
                            ], function($value) {
                                return !empty($value);
                            });
                            
                            // Shuffle the keys randomly
                            $keys = array_keys($pilihan);
                            shuffle($keys);
                        @endphp

                        <div class="space-y-3">
                            @foreach($keys as $key)
                                <label class="w-full text-left p-4 rounded-xl border-2 border-slate-200 bg-white hover:border-blue-400 hover:bg-blue-50/50 transition-all cursor-pointer flex items-center gap-4 answer-option
                                    @if($session->getCurrentAnswer() == $key) border-blue-500 bg-blue-50 ring-2 ring-blue-200 @endif"
                                     id="option-{{ $key }}">
                                    <input type="radio" name="answer" value="{{ $key }}" 
                                           class="hidden" 
                                           @if($session->getCurrentAnswer() == $key) checked @endif
                                           onchange="selectAnswer('{{ $key }}')">
                                    <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold option-badge
                                        @if($session->getCurrentAnswer() == $key) bg-blue-600 text-white @else bg-slate-100 text-slate-600 @endif">
                                        <i class="fas fa-circle text-xs"></i>
                                    </span>
                                    <span class="flex-1 text-slate-700">
                                        {{ $pilihan[$key] }}
                                    </span>
                                    @if($session->getCurrentAnswer() == $key)
                                        <i class="fas fa-check-circle text-blue-600 text-lg"></i>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                        
                        <!-- Hidden Answer Input (for form submission) -->
                        <input type="hidden" name="answer" id="answerInput" value="{{ $session->getCurrentAnswer() ?? '' }}">

                        
                        <!-- Navigation Buttons -->
                        <div class="flex flex-col sm:flex-row justify-between items-center mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-100 gap-3 sm:gap-0">
                            <button type="button"
                                    class="w-full sm:w-auto px-6 py-4 sm:py-3 border border-slate-300 text-slate-600 rounded-xl font-medium hover:bg-slate-50 transition-colors flex items-center justify-center gap-2 text-sm sm:text-base @if($session->current_question == 0) opacity-50 cursor-not-allowed @endif"
                                    onclick="previousQuestion()">
                                <i class="fas fa-chevron-left"></i> Previous
                            </button>

                            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                                <button type="button" class="w-full sm:w-auto px-6 py-4 sm:py-3 border border-red-300 text-red-600 rounded-xl font-medium hover:bg-red-50 transition-colors flex items-center justify-center gap-2 text-sm sm:text-base" onclick="cancelTest()">
                                    <i class="fas fa-times"></i> Batalkan
                                </button>

                                @if($session->current_question < $session->total_questions - 1)
                                    <button type="submit" class="w-full sm:w-auto px-6 py-4 sm:py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-500/30 text-sm sm:text-base" id="nextButton">
                                        Next <i class="fas fa-chevron-right"></i>
                                    </button>
                                @else
                                    <button type="button" class="w-full sm:w-auto px-6 py-4 sm:py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 shadow-lg shadow-blue-500/30 text-sm sm:text-base" id="btn-selesai" onclick="showReviewModal()">
                                        Selesai <i class="fas fa-check"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Sidebar - Progress (Hidden on mobile, shown on desktop) -->
            <div class="lg:w-1/4 hidden lg:block">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6 sticky top-4 sm:top-6">
                    <h6 class="text-slate-800 font-semibold mb-4">
                        <i class="fas fa-chart-line text-blue-600 mr-2"></i> Progress
                    </h6>
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-slate-600 mb-2">
                            <span>{{ $session->getAnsweredCount() }} soal</span>
                            <span>{{ $session->total_questions }} soal</span>
                        </div>
                        <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-emerald-500 to-blue-600 rounded-full transition-all duration-500" 
                                 style="width: {{ $session->getProgressPercentage() }}%"></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-4xl font-bold text-slate-800">{{ round(($session->getAnsweredCount() / $session->total_questions) * 100) }}%</span>
                        <p class="text-slate-500 text-sm mt-1">Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-2 text-center">Review Jawaban Anda</h2>
                <p class="text-slate-600 text-center mb-4">Periksa kembali jawaban Anda sebelum mengumpulkan</p>

                <div id="warningMessage" class="hidden bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-red-800">Peringatan!</p>
                            <p class="text-red-700 text-sm" id="modal-warning-text">Ada 0 soal yang belum dijawab!</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-slate-700 mb-3">Status Jawaban:</h3>
                    <div class="flex items-center gap-4 text-sm mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-emerald-500 text-white rounded-lg flex items-center justify-center text-xs font-medium">✓</div>
                            <span class="text-slate-600">Sudah dijawab</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-red-100 text-red-600 border border-red-300 rounded-lg flex items-center justify-center text-xs font-medium animate-pulse">!</div>
                            <span class="text-slate-600">Belum dijawab</span>
                        </div>
                    </div>

                    <div id="modal-grid-container" class="grid grid-cols-5 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2">
                        <!-- Question numbers will be generated by JavaScript -->
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="hideReviewModal()" class="flex-1 px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali Mengerjakan
                    </button>
                    <button type="button" onclick="submitExam()" class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                        <i class="fas fa-check mr-2"></i>Ya, Kumpulkan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedAnswer = '{{ $session->getCurrentAnswer() ?? '' }}';

        function selectAnswer(answer) {
            selectedAnswer = answer;
            
            console.log('Answer selected:', answer);
            
            // Update UI - Remove selected state from all options
            document.querySelectorAll('.answer-option').forEach(el => {
                el.classList.remove('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-200');
                el.classList.add('border-slate-200', 'bg-white');
                
                // Update badge color
                const badge = el.querySelector('.option-badge');
                if (badge) {
                    badge.classList.remove('bg-blue-600', 'text-white');
                    badge.classList.add('bg-slate-100', 'text-slate-600');
                }
                
                // Remove check icon
                const checkIcon = el.querySelector('.fa-check-circle');
                if (checkIcon) {
                    checkIcon.remove();
                }
                
                // Uncheck radio input
                const radio = el.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = false;
                }
            });
            
            // Add selected state to clicked option
            const selectedOption = document.getElementById('option-' + answer);
            if (selectedOption) {
                selectedOption.classList.remove('border-slate-200', 'bg-white');
                selectedOption.classList.add('border-blue-500', 'bg-blue-50', 'ring-2', 'ring-blue-200');
                
                // Update badge color
                const badge = selectedOption.querySelector('.option-badge');
                if (badge) {
                    badge.classList.remove('bg-slate-100', 'text-slate-600');
                    badge.classList.add('bg-blue-600', 'text-white');
                }
                
                // Add check icon
                if (!selectedOption.querySelector('.fa-check-circle')) {
                    const checkIcon = document.createElement('i');
                    checkIcon.className = 'fas fa-check-circle text-blue-600 text-lg';
                    selectedOption.appendChild(checkIcon);
                }
                
                // Check radio input
                const radio = selectedOption.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            }
            
            // Update hidden input
            const answerInput = document.getElementById('answerInput');
            if (answerInput) {
                answerInput.value = answer;
                console.log('Answer input updated to:', answerInput.value);
            }
        }

        function navigateToQuestion(questionNumber) {
            if (questionNumber === {{ $session->current_question }}) {
                return;
            }
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('test.navigate', $session) }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const questionInput = document.createElement('input');
            questionInput.type = 'hidden';
            questionInput.name = 'question_number';
            questionInput.value = questionNumber;
            
            form.appendChild(csrfToken);
            form.appendChild(questionInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        function previousQuestion() {
            if ({{ $session->current_question }} > 0) {
                navigateToQuestion({{ $session->current_question }} - 1);
            }
        }

        function cancelTest() {
            if (confirm('Apakah Anda yakin ingin membatalkan tes?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('test.cancel', $session) }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key >= '1' && e.key <= '5') {
                const options = ['A', 'B', 'C', 'D', 'E'];
                selectAnswer(options[parseInt(e.key) - 1]);
            } else if (e.key === 'ArrowLeft') {
                previousQuestion();
            } else if (e.key === 'ArrowRight') {
                document.getElementById('nextButton').click();
            }
        });

        // Form submission validation
        document.getElementById('answerForm').addEventListener('submit', function(e) {
            console.log('Form submission triggered');
            
            const answerInput = document.getElementById('answerInput');
            const currentAnswer = answerInput ? answerInput.value : '';
            
            console.log('Answer input found:', !!answerInput);
            console.log('Current answer value:', currentAnswer);
            console.log('Selected answer variable:', selectedAnswer);
            
            // Ensure answer is selected
            if (!currentAnswer || !currentAnswer.trim()) {
                console.log('Answer validation failed - showing alert');
                e.preventDefault();
                alert('Anda harus memilih jawaban terlebih dahulu!');
                return false;
            }
            
            // Ensure answer input has correct value
            if (answerInput && selectedAnswer) {
                answerInput.value = selectedAnswer;
                console.log('Answer input updated to selectedAnswer:', selectedAnswer);
            }
            
            // Remove any hidden _method input if it exists
            const methodInput = this.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
                console.log('Removed _method input');
            }
            
            console.log('Form will be submitted with answer:', currentAnswer);
        });

        // Auto-submit on Enter
        document.getElementById('answerForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && selectedAnswer) {
                e.preventDefault();
                document.getElementById('nextButton').click();
            }
        });

        // Timer functionality - Using absolute end time
        let timerInterval;
        let isPaused = false;

        // Get absolute end time from server (in milliseconds)
        const endsAt = {{ $endTime ? $endTime->timestamp * 1000 : 'null' }};
        const totalDuration = {{ $session->total_questions * 60 }}; // Total duration in seconds
        
        // Debug: Check initial values
        console.log('Timer initialized:', {
            endsAt: endsAt,
            totalDuration: totalDuration,
            currentTime: Date.now()
        });

        function updateTimerDisplay() {
            const timerDisplay = document.getElementById('timerDisplay');
            const timerProgress = document.getElementById('timerProgress');
            
            if (!timerDisplay || !timerProgress || !endsAt) return;
            
            // Calculate remaining time based on absolute end time
            const currentTime = Date.now();
            let timeRemaining = Math.max(0, Math.floor((endsAt - currentTime) / 1000));
            
            // Format display as MM:SS or HH:MM:SS
            let displayTime;
            if (timeRemaining >= 3600) {
                // More than 1 hour - show HH:MM:SS
                const hours = Math.floor(timeRemaining / 3600);
                const minutes = Math.floor((timeRemaining % 3600) / 60);
                const seconds = timeRemaining % 60;
                displayTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            } else {
                // Less than 1 hour - show MM:SS
                const minutes = Math.floor(timeRemaining / 60);
                const seconds = timeRemaining % 60;
                displayTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }
            
            timerDisplay.textContent = displayTime;
            
            // Update progress bar
            const percentage = (timeRemaining / totalDuration) * 100;
            timerProgress.style.width = Math.max(0, percentage) + '%';
            
            // Update color based on remaining time
            timerDisplay.classList.remove('warning', 'danger');
            if (timeRemaining <= 30) {
                timerDisplay.classList.add('danger');
            } else if (timeRemaining <= 60) {
                timerDisplay.classList.add('warning');
            }
            
            // Check if time is up
            if (timeRemaining <= 0 && !isPaused) {
                clearInterval(timerInterval);
                autoSubmit();
            }
        }

        function startTimer() {
            if (timerInterval) clearInterval(timerInterval);

            timerInterval = setInterval(() => {
                if (!isPaused) {
                    updateTimerDisplay();
                }
            }, 1000);
        }

        function pauseTimer() {
            isPaused = true;
            fetch(`{{ route('test.pause-timer', $session) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      document.getElementById('pauseBtn').style.display = 'none';
                      document.getElementById('resumeBtn').style.display = 'block';
                  }
              });
        }

        function resumeTimer() {
            isPaused = false;
            fetch(`{{ route('test.resume-timer', $session) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      document.getElementById('pauseBtn').style.display = 'block';
                      document.getElementById('resumeBtn').style.display = 'none';
                  }
              });
        }

        function autoSubmit() {
            fetch(`{{ route('test.auto-submit', $session) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            });
        }

        // Timer controls
        document.getElementById('pauseBtn')?.addEventListener('click', pauseTimer);
        document.getElementById('resumeBtn')?.addEventListener('click', resumeTimer);

        // Initialize timer
        updateTimerDisplay();
        startTimer(); // Start the timer interval

        // Review Modal Functions
        function showReviewModal() {
            const modal = document.getElementById('reviewModal');
            const modalGrid = document.getElementById('modal-grid-container');
            const totalQuestions = {{ $session->total_questions }};

            // Generate modal grid with all question numbers first
            modalGrid.innerHTML = '';
            for (let i = 0; i < totalQuestions; i++) {
                const questionNum = i + 1;
                const questionBox = document.createElement('div');
                questionBox.className = 'modal-question-number w-10 h-10 rounded-lg flex items-center justify-center text-sm font-medium cursor-pointer transition-all duration-200 hover:scale-105 bg-slate-100 text-slate-600';
                questionBox.textContent = questionNum;

                // Click to navigate to question
                questionBox.onclick = function() {
                    hideReviewModal();
                    navigateToQuestion(i);
                };

                modalGrid.appendChild(questionBox);
            }

            // Sync with sidebar state
            syncModalWithSidebar();

            // Show modal
            modal.classList.remove('hidden');
        }

        function syncModalWithSidebar() {
            // Get all sidebar question numbers
            const sidebarItems = document.querySelectorAll('.sidebar-question-number');
            // Get all modal question numbers
            const modalItems = document.querySelectorAll('.modal-question-number');
            const warningMessage = document.getElementById('warningMessage');
            const warningText = document.getElementById('modal-warning-text');

            let unansweredCount = 0;

            // Loop and sync colors
            sidebarItems.forEach((sidebarItem, index) => {
                // Check if sidebar item has bg-emerald-500 (answered from previous pages)
                const isGreen = sidebarItem.classList.contains('bg-emerald-500') || sidebarItem.classList.contains('sudah-dijawab');

                // Check if sidebar item has bg-blue-600 (currently active question)
                const isBlue = sidebarItem.classList.contains('bg-blue-600') || sidebarItem.classList.contains('soal-ini');

                let isAnswered = isGreen;

                // If this is the currently active question, check if there's a radio button checked on the screen
                if (isBlue) {
                    const isRadioChecked = document.querySelector('input[type="radio"]:checked');
                    if (isRadioChecked) {
                        isAnswered = true;
                    }
                }

                if (modalItems[index]) {
                    if (isAnswered) {
                        // Make it green in modal
                        modalItems[index].className = 'modal-question-number w-10 h-10 rounded-lg flex items-center justify-center text-sm font-medium cursor-pointer transition-all duration-200 hover:scale-105 bg-emerald-500 text-white';
                    } else {
                        // Make it red in modal
                        modalItems[index].className = 'modal-question-number w-10 h-10 rounded-lg flex items-center justify-center text-sm font-medium cursor-pointer transition-all duration-200 hover:scale-105 bg-red-100 text-red-600 border border-red-300 animate-pulse';
                        unansweredCount++;
                    }
                }
            });

            // Update warning text
            if (unansweredCount > 0) {
                warningText.textContent = `Ada ${unansweredCount} soal yang belum dijawab!`;
                warningMessage.classList.remove('hidden');
            } else {
                warningMessage.classList.add('hidden');
            }
        }

        function hideReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.classList.add('hidden');
        }

        function submitExam() {
            // Submit the form
            document.getElementById('answerForm').submit();
        }
    </script>
</body>
</html>
