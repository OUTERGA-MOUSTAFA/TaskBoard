<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ showModal: {{ $errors->any() ? 'true' : 'false' }} }">

    <div x-show="showModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 backdrop-blur-sm"
        x-cloak>

        <div class="bg-white w-full max-w-lg mx-4 rounded-xl shadow-2xl p-6 relative"
            @click.away="showModal = false">

            <button @click="showModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>

            @include('tasks.createTask')

        </div>
    </div>

    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            @php
            $words = explode(' ', auth()->user()->name);

            $initials = strtoupper(substr($words[0], 0, 1));
            if (count($words) > 1) {
            $initials .= strtoupper(substr($words[1], 0, 1));
            }
            @endphp

            <div class="bg-purple-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-xl">
                {{ $initials }}
            </div>Panel

            <header class="mt-8 flex center justify-center">

                <img src="https://i.pravatar.cc/100" alt="Profile" class="w-20 h-20 rounded-full shadow">
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
                @if(session('welcome') || session('success'))
                <div x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed top-4 right-4 {{ session('success') ? 'bg-blue-500' : 'bg-green-500' }} text-white px-6 py-3 rounded-lg shadow-lg z-50">

                    <div class="flex items-center gap-2">
                        <i class="fas {{ session('success') ? 'fa-tasks' : 'fa-check-circle' }}"></i>
                        <span>{{ session('welcome') ?? session('success') }}</span>
                    </div>
                </div>
                @endif
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
                                <th class="p-4">Action</th>
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
                                <td class="p-4 grid grid-cols-3 grid-rows-3 h-24 w-24 border-t relative">
                                    <a href="{{route('tasks.edit', $task->id)}}" class="text-blue-600 hover:text-blue-800 transition col-start-1 row-start-1 justify-self-start">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if( $task->deleted_at === null)
                                    <form action="{{ route('tasks.archive', $task->id, 'archive') }}" method="post" class="col-start-2 row-start-2 justify-self-center self-center">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-green-700 hover:text-green-500 transition col-start-2 row-start-2 justify-self-center self-center">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('tasks.desarchive', $task->id , 'desarchive') }}" method="post" class="col-start-2 row-start-2 justify-self-center self-center">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-600 hover:text-orange-700 transition col-start-2 row-start-2 justify-self-center self-center">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{route('tasks.delete' , $task->id)}}" method="POST" onsubmit='return confirm("tu es sure !")'
                                        class="col-start-3 row-start-3 justify-self-end self-end">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-4 p-4 flex justify-center">
                        {{ $tasks->links() }}
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button @click="showModal = true" class="bg-purple-600 text-white py-3 rounded-lg shadow hover:bg-purple-700">Add Task</button>
                </div>
        </div>
        </main>
    </div>

    <!-- model -->


    <footer class="bg-white p-4 mt-10 text-center text-sm text-gray-400 border-t">
        © 2025 AdminPanel. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>