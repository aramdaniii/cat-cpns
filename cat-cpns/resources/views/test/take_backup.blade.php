<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes CAT - CAT CPNS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        
        .question-number {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 2px;
        }
        
        .question-number.answered {
            background-color: #28a745;
            color: white;
        }
        
        .question-number.current {
            background-color: #007bff;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }
        
        .question-number.unanswered {
            background-color: #6c757d;
            color: white;
        }
        
        .question-number:hover {
            transform: scale(1.05);
        }
        
        .answer-option {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #dee2e6;
        }
        
        .answer-option:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        
        .answer-option.selected {
            border-color: #007bff;
            background-color: #e3f2fd;
        }
        
        .main-content {
            min-height: calc(100vh - 56px);
            padding: 20px;
        }
        
        .question-text {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .progress-info {
            position: fixed;
            top: 76px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .timer-container {
            background: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        
        .timer-display {
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            margin: 5px 0;
        }
        
        .timer-display.warning {
            color: #ff6b6b;
            animation: pulse 1s infinite;
        }
        
        .timer-display.danger {
            color: #dc3545;
            animation: pulse 0.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .timer-progress {
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            overflow: hidden;
            margin: 10px 0;
        }
        
        .timer-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #ffc107, #dc3545);
            transition: width 1s linear;
        }
        
        .timer-controls {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">CAT CPNS</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="nav-link active" href="{{ route('test.index') }}">Tes CAT</a>
                <span class="navbar-text ms-3">Halo, {{ auth()->user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="p-3">
                    <!-- Timer Section -->
                    @if($session->timer_enabled)
                    <div class="timer-container">
                        <h6 class="text-center mb-2">
                            <i class="fas fa-clock"></i> Waktu
                        </h6>
                        <div class="timer-display" id="timerDisplay">
                            {{ $session->getRemainingTime() }}s
                        </div>
                        <div class="timer-progress">
                            <div class="timer-progress-bar" id="timerProgress" 
                                 style="width: {{ ($session->getRemainingTime() / $session->time_per_question) * 100 }}%"></div>
                        </div>
                        <div class="timer-controls">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="pauseBtn">
                                <i class="fas fa-pause"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" id="resumeBtn" style="display: none;">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Question Numbers -->
                    <h6 class="mb-3">
                        <i class="fas fa-list"></i> Nomor Soal
                    </h6>
                    <div class="d-flex flex-wrap">
                        @foreach($allQuestions as $index => $question)
                            <div class="question-number 
                                @if($session->isQuestionAnswered($index)) answered @elseif($index == $session->current_question) current @else unanswered @endif"
                                 onclick="navigateToQuestion({{ $index }})">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-circle text-success"></i> Sudah dijawab<br>
                            <i class="fas fa-circle text-primary"></i> Soal ini<br>
                            <i class="fas fa-circle text-secondary"></i> Belum dijawab
                        </small>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-7 main-content">
                <!-- Question Header -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            Soal {{ $session->current_question + 1 }} dari {{ $session->total_questions }} {{ $session->kategori }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('test.answer', $session) }}" id="answerForm">
                            @csrf
                            
                            <!-- Question Text -->
                            <div class="mb-4">
                                <div class="question-text">
                                    {{ $currentQuestion->pertanyaan }}
                                </div>
                            </div>

                            <!-- Answer Options -->
                            <div class="row">
                                @foreach(['A', 'B', 'C', 'D'] as $option)
                                    <div class="col-md-6 mb-3">
                                        <div class="answer-option card p-3 
                                            @if($session->getCurrentAnswer() == $option) selected @endif"
                                             onclick="selectAnswer('{{ $option }}')">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="badge bg-primary fs-6">{{ $option }}</span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    {{ $currentQuestion->{'opsi_' . strtolower($option)} }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Hidden Answer Input (only one) -->
                            <input type="hidden" name="answer" id="answerInput" value="{{ $session->getCurrentAnswer() ?? '' }}">

                            
                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" 
                                        class="btn btn-outline-secondary @if($session->current_question == 0) disabled @endif"
                                        onclick="previousQuestion()">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </button>
                                
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-danger" onclick="cancelTest()">
                                        <i class="fas fa-times"></i> Batalkan
                                    </button>
                                    
                                    <button type="submit" class="btn btn-success" id="nextButton">
                                        @if($session->current_question < $session->total_questions - 1)
                                            <i class="fas fa-chevron-right"></i> Next
                                        @else
                                            <i class="fas fa-check"></i> Selesai
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-2">
                <!-- Progress Info -->
                <div class="progress-info">
                    <h6 class="mb-2">Progress</h6>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $session->getProgressPercentage() }}%">
                        </div>
                    </div>
                    <small class="text-muted">
                        {{ $session->getAnsweredCount() }} / {{ $session->total_questions }} soal
                    </small>
                    <div class="mt-2">
                        <strong>{{ round(($session->getAnsweredCount() / $session->total_questions) * 100) }}%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

                            <!-- Answer Options -->
                            <div class="row">
                                @foreach(['A', 'B', 'C', 'D'] as $option)
                                    <div class="col-md-6 mb-3">
                                        <div class="answer-option card p-3 
                                            @if($session->getCurrentAnswer() == $option) selected @endif"
                                             onclick="selectAnswer('{{ $option }}')">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="badge bg-primary fs-6">{{ $option }}</span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    {{ $currentQuestion->{'opsi_' . strtolower($option)} }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Hidden Answer Input (only one) -->
                            <input type="hidden" name="answer" id="answerInput" value="{{ $session->getCurrentAnswer() ?? '' }}">

                            
                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" 
                                        class="btn btn-outline-secondary @if($session->current_question == 0) disabled @endif"
                                        onclick="previousQuestion()">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </button>
                                
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-danger" onclick="cancelTest()">
                                        <i class="fas fa-times"></i> Batalkan
                                    </button>
                                    
                                    <button type="submit" class="btn btn-success" id="nextButton">
                                        @if($session->current_question < $session->total_questions - 1)
                                            <i class="fas fa-chevron-right"></i> Next
                                        @else
                                            <i class="fas fa-check"></i> Selesai
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedAnswer = '{{ $session->getCurrentAnswer() ?? '' }}';

        function selectAnswer(answer) {
            selectedAnswer = answer;
            
            console.log('Answer selected:', answer);
            
            // Update UI
            document.querySelectorAll('.answer-option').forEach(el => {
                el.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
            
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
                navigateToQuestion({{ $session->current_question - 1 }});
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
            if (e.key >= '1' && e.key <= '4') {
                const options = ['A', 'B', 'C', 'D'];
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

        // Timer functionality
        let timerInterval;
        let isPaused = false;
        let timeRemaining = {{ $session->getRemainingTime() }};
        const timePerQuestion = {{ $session->time_per_question }};
        
        // Debug: Check initial values
        console.log('Timer initialized:', {
            timeRemaining: timeRemaining,
            timePerQuestion: timePerQuestion,
            serverTime: '{{ $session->getRemainingTime() }}'
        });

        function updateTimerDisplay() {
            const timerDisplay = document.getElementById('timerDisplay');
            const timerProgress = document.getElementById('timerProgress');
            
            if (!timerDisplay || !timerProgress) return;
            
            // Update display
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            // Update progress bar
            const percentage = (timeRemaining / timePerQuestion) * 100;
            timerProgress.style.width = percentage + '%';
            
            // Update color based on remaining time
            timerDisplay.classList.remove('warning', 'danger');
            if (timeRemaining <= 10) {
                timerDisplay.classList.add('danger');
            } else if (timeRemaining <= 30) {
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
                if (!isPaused && timeRemaining > 0) {
                    timeRemaining--;
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
        startTimer();
    </script>
</body>
</html>
