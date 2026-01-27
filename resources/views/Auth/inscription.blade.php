<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes neon-pulse {

           0%,
           100% {
             text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #ff00de, 0 0 35px #ff00de, 0 0 40px #ff00de, 0 0 50px #ff00de, 0 0 75px #ff00de;
           }

           50% {
             text-shadow: 0 0 2px #fff, 0 0 5px #fff, 0 0 7px #fff, 0 0 10px #ff00de, 0 0 17px #ff00de, 0 0 20px #ff00de, 0 0 25px #ff00de, 0 0 37px #ff00de;
           }
         }

         @keyframes bg-shift {
           0% {
             background-position: 0% 50%;
           }

           50% {
             background-position: 100% 50%;
           }

           100% {
             background-position: 0% 50%;
           }
         }

         @keyframes float {

           0%,
           100% {
             transform: translateY(0);
           }

           50% {
             transform: translateY(-20px);
           }
         }

         @keyframes rotate {
           0% {
             transform: rotate(0deg);
           }

           100% {
             transform: rotate(360deg);
           }
         }

         .neon-text {
           animation: neon-pulse 1.5s infinite alternate;
         }

         .bg-animate {
           background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
           background-size: 400% 400%;
           animation: bg-shift 15s ease infinite;
         }

         .float {
           animation: float 6s ease-in-out infinite;
         }

         .rotate {
           animation: rotate 10s linear infinite;
         }
    </style>
</head>
<body class="bg-animate min-h-screen flex items-center justify-center p-4">
    <div class="bg-black bg-opacity-80 p-8 rounded-3xl shadow-2xl transform hover:scale-105 transition-all duration-500 max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-center mb-8 neon-text">Extreme Signup</h1>
        <form class="space-y-6" action="/save" method="post">
            @csrf
            <div class="relative">
              @error('Nom')
                <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
              @enderror
                <input type="text" name="Nom" placeholder="Nom" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                <i class="fas fa-user absolute right-3 top-3 text-pink-500"></i>
            </div>
            <div class="relative">
              @error('Prenom')
                  <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
              @enderror
                <input type="text" name="Prenom" placeholder="Prénom" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                <i class="fas fa-user absolute right-3 top-3 text-pink-500"></i>
            </div>
            <div class="relative">
              @error('Email')
                  <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
              @enderror
                <input type="email" name="Email" placeholder="Email" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                <i class="fas fa-envelope absolute right-3 top-3 text-pink-500"></i>
            </div>
            <div class="relative">
              @error('Password')
                <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
              @enderror
                <input type="password" name="Password" placeholder="Password" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                <i class="fas fa-lock absolute right-3 top-3 text-pink-500"></i>
            </div>
            <div class="relative">
              @error('Password_confirmation')
                  <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
              @enderror
                <input type="password" name="Password_confirmation" placeholder=" repaite password" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition-all duration-300">
                <i class="fas fa-lock absolute right-3 top-3 text-pink-500"></i>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold py-3 rounded-lg hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                Sign Up
            </button>
        </form>
        <div class="mt-8 text-center">
            <p class="text-gray-400">Or  <a href="/login" class="text-blue-500 hover:text-blue-600 transform hover:scale-125 transition-all duration-300"> sign up</a>
            </p>
        </div>
    </div>
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
        <i class="fas fa-meteor text-yellow-500 text-4xl absolute animate-ping" style="top: 10%; left: 5%;"></i>
        <i class="fas fa-star text-blue-500 text-2xl absolute animate-pulse" style="top: 20%; right: 10%;"></i>
        <i class="fas fa-rocket text-red-500 text-5xl absolute float" style="bottom: 15%; left: 15%;"></i>
        <i class="fas fa-planet-ringed text-purple-500 text-6xl absolute rotate" style="top: 40%; right: 20%;"></i>
    </div>
</body>
</html>