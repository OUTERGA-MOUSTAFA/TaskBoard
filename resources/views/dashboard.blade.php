<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md">
    <div class="p-6 font-bold text-purple-700 text-2xl">AdminPanel</div>
    <header class="mt-8 flex center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-6">
            <img src="https://i.pravatar.cc/100" alt="Profile" class="w-20 h-20 rounded-full shadow">
        <div>
    </header>
    <nav class="mt-8">
      <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">ToDo</a>
      <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">In progress</a>
      <a href="#" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">Done</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Top Navbar -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-purple-700">Dashboard</h1>
      <div class="flex items-center gap-4">
        <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center bg-red-200 p-2 rounded-md text-gray-700 hover:text-red-600 transition">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Déconnecter</span>
            </button>
        </form>
      </div>
    </header>

    <!-- Content -->
    <main class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-sm text-gray-500">todo</p>
            <h2 class="text-3xl font-bold text-purple-700 mt-2">12</h2>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-sm text-gray-500">in progress</p>
            <h2 class="text-3xl font-bold text-green-600 mt-2">2</h2>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-sm text-gray-500">done</p>
            <h2 class="text-3xl font-bold text-blue-600 mt-2">10</h2>
        </div>
        
        </div>

        <div class="bg-white rounded-lg shadow-md">
        <div class="p-4 border-b font-bold text-purple-700">Tasks List</div>
            <table class="w-full text-left">
                <thead class="bg-purple-50">
                <tr>
                    <th class="p-4">Titre</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">deadline</th>
                    <th class="p-4">priorite</th>
                    <th class="p-4">statut</th>
                </tr>
                </thead>
                <tbody>
                
                    @foreach ($tasks as $task)
                    <tr class="border-t">
                        <td class="p-4 font-semibold text-gray-700">{{ $task->titre }}</td>
                        <td class="p-4 text-gray-600">{{ $task->description }}</td>
                        <td class="p-4 text-sm text-purple-600">{{ $task->deadline }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold 
                                {{ $task->priorite == 'high' ? 'bg-red-100 text-red-600' : ($task->priorite == 'medium' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                                {{ strtoupper($task->priorite) }}
                            </span>
                        </td>
                        <td class="p-4 italic text-gray-500">{{ $task->statut }}</td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
            <div class="mt-4 p-4">
                {{ $tasks->links() }}
            </div>
        </div>

    <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-2 md:grid-cols-4 gap-4">
    <button class="bg-purple-600 text-white py-3 rounded-lg shadow hover:bg-purple-700">Add Task</button>
    </div>    
  </div>
</div>

<footer class="bg-white p-4 mt-10 text-center text-sm text-gray-400 border-t">
  © 2025 AdminPanel. All rights reserved.
</footer>

</body>
</html>