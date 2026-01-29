<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .auth-container {
            perspective: 1200px;
            transform-style: preserve-3d;
        }

        .form-card {
            transform-style: preserve-3d;
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backface-visibility: hidden;
        }

        .form-card.flipped {
            transform: rotateY(180deg);
        }

        .form-side {
            backface-visibility: hidden;
            transition: all 0.6s ease;
        }

        .form-back {
            transform: rotateY(180deg);
        }

        .floating-shapes {
            animation: float 8s ease-in-out infinite;
        }

        .floating-shapes:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-shapes:nth-child(3) {
            animation-delay: -4s;
        }

        .floating-shapes:nth-child(4) {
            animation-delay: -6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.7;
            }

            25% {
                transform: translateY(-20px) translateX(10px) rotate(90deg);
                opacity: 0.8;
            }

            50% {
                transform: translateY(-10px) translateX(-10px) rotate(180deg);
                opacity: 0.6;
            }

            75% {
                transform: translateY(-30px) translateX(5px) rotate(270deg);
                opacity: 0.9;
            }
        }

        .particle {
            animation: particleFloat 6s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .input-group {
            position: relative;
        }

        .input-group input:focus+label,
        .input-group input:not(:placeholder-shown)+label {
            transform: translateY(-28px) scale(0.8);
            color: #8b5cf6;
        }

        .input-group label {
            transition: all 0.3s ease;
            transform-origin: left top;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-border {
            background: linear-gradient(45deg, #8b5cf6, #06b6d4, #10b981, #f59e0b);
            padding: 2px;
            border-radius: 16px;
        }

        .gradient-border-inner {
            background: rgba(17, 24, 39, 0.95);
            border-radius: 14px;
        }

        .social-btn {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .social-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .ripple-effect {
            position: relative;
            overflow: hidden;
        }

        .ripple-effect:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ripple-effect:active:before {
            width: 300px;
            height: 300px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(139, 92, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0);
            }
        }

        .slide-in {
            animation: slideIn 0.6s ease-out forwards;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .glow-effect {
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.3);
        }

        .loading {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-violet-900 min-h-screen overflow-hidden relative">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Floating Shapes -->
        <div class="floating-shapes absolute top-20 left-10 w-20 h-20 bg-gradient-to-r from-purple-500/30 to-pink-500/30 rounded-full blur-xl"></div>
        <div class="floating-shapes absolute top-40 right-20 w-32 h-32 bg-gradient-to-r from-blue-500/30 to-cyan-500/30 rounded-lg blur-xl"></div>
        <div class="floating-shapes absolute bottom-32 left-1/4 w-24 h-24 bg-gradient-to-r from-green-500/30 to-emerald-500/30 rounded-full blur-xl"></div>
        <div class="floating-shapes absolute top-1/2 right-10 w-16 h-16 bg-gradient-to-r from-yellow-500/30 to-orange-500/30 rounded-lg blur-xl"></div>

        <!-- Particles -->
        <div id="particles-container" class="absolute inset-0"></div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="auth-container w-full max-w-md">
            <!-- 3D Form Card -->
            <div id="formCard" class="form-card relative">

                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-green-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                <div class="relative bg-white shadow-lg sm:rounded-3xl sm:overflow-hidden">
                    <!-- ########## ***  Form Content  *** ########## -->
                    <form action="{{ route('tasks.update', $tasks->id) }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PUT')
                        <h2 class="text-xl font-bold">Edit tâche</h2>
                        @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded shadow-sm">
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div>
                            <label>Titre</label>
                            <input type="text" name="titre" class="w-full border p-2 rounded" value="{{$tasks->titre}}">
                        </div>

                        <div>
                            <label>Description</label>
                            <textarea name="description" class="w-full border p-2 rounded">{{$tasks->description}}"</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label>Deadline</label>
                                <input type="datetime-local" name="deadline"
                                    class="w-full border p-2 rounded"
                                    value="{{ $tasks->deadline ? \Carbon\Carbon::parse($tasks->deadline)->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <div>
                                <label>Priorité</label>
                                <select name="priorite" class="w-full border p-2 rounded">
                                    <option value="low" @selected($tasks->priorite == 'low')>Low</option>
                                    <option value="medium" @selected($tasks->priorite == 'medium')>Medium</option>
                                    <option value="high" @selected($tasks->priorite == 'high')>High</option>
                                </select>
                            </div>
                            <div>
                                <label>statut</label>
                                <select name="statut" class="w-full border p-2 rounded">
                                    <option value="To do" @selected($tasks->statut == 'To do')>To do</option>
                                    <option value="In progress" @selected($tasks->statut == 'In progress')>In progress</option>
                                    <option value="Done" @selected($tasks->statut == 'Done')>Done</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Edit Task</button>
                        <div>
                            <a href="/dashboard">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Particle Generation
        const particlesContainer = document.getElementById('particles-container');

        function createParticle() {
            const particle = document.createElement('div');
            const size = Math.random() * 6 + 4;
            particle.classList.add('particle');
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.background = `rgba(255, 255, 255, ${Math.random()})`;
            particle.style.borderRadius = '50%';
            particle.style.position = 'absolute';
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = '100%';
            particle.style.animationDuration = `${Math.random() * 5 + 5}s`;
            particlesContainer.appendChild(particle);

            setTimeout(() => {
                particlesContainer.removeChild(particle);
            }, 1000000);
        }

        setInterval(createParticle, 200);
    </script>
</body>

</html>