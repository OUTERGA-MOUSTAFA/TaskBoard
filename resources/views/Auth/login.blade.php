<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <i class="fas fa-sign-in-alt text-red-600 fa-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Welcome Back!</h2>
                    <p class="text-gray-500 mt-2">Please sign in to continue</p>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm italic border-l-4 border-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                @error('login_error')
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm border-l-4 border-red-500 italic">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
                    </div>
                @enderror
                <form action="/log" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="w-full px-4 py-3 rounded-lg border border-red-500 border-gray-300 focus:ring-2 focus:ring-red-600 focus:outline-none transition-all @error('email') border-red-500 @enderror"
                                placeholder="you@example.com">
                            <i class="fas fa-envelope absolute right-3 top-4 text-gray-400"></i>
                        </div>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" 
                                class="w-full px-4 py-3 rounded-lg border border-red-500 border-gray-300 focus:ring-2 focus:ring-red-600 focus:outline-none transition-all @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            <i class="fas fa-lock absolute right-3 top-4 text-gray-400"></i>
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-bold hover:bg-red-700 transition-all shadow-lg shadow-red-200 active:scale-95">
                        Sign In
                    </button>

                    <p class="mt-6 text-center text-gray-600">
                        Don't have an account? 
                        <a href="/register" class="text-red-600 hover:text-red-700 font-bold underline">Sign up</a>
                    </p>
                </form>
            </div>
        </div>

        <div class="hidden lg:block lg:w-1/2 bg-cover bg-center shadow-2xl" 
             style="background-image: url('https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')">
            <div class="h-full bg-black bg-opacity-40 flex items-center justify-center backdrop-blur-[2px]">
                <div class="text-center text-white px-12">
                    <h2 class="text-5xl font-extrabold mb-6 tracking-tight">Master Your Tasks</h2>
                    <p class="text-xl font-light leading-relaxed">Organize your life, achieve your goals, and stay productive with TaskBoard.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>