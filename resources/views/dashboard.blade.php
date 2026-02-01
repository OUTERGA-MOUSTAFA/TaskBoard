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

        .modern-pagination nav p.text-sm.text-gray-700 {
            display: none !important;
        }

        .modern-pagination nav div:first-child {
            display: none !important;
        }

        .modern-pagination nav div:last-child {
            display: flex !important;
            justify-content: center;
            width: 100%;
        }

        #result_Mostafa tr {
            will-change: transform, opacity;
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
            $firstLetter = strtoupper(substr(auth()->user()->prenom, 0, 1));
            $secondLetter = strtoupper(substr(auth()->user()->nom, 0, 1));

            $initials = $firstLetter . $secondLetter;
            @endphp

            <div class=" flex items-center justify-center font-bold text-xl text-purple-600">
                <div class="flex items-center justify-center  rounded-full w-12 h-12">{{ $initials }}</div>Panel
            </div>

            <header class="mt-8 flex center justify-center">

                <img src="https://i.pravatar.cc/100" alt="Profile" class="w-20 h-20 rounded-full shadow">
            </header>
            <nav class="mt-8">
                <a href="#" class="block py-3 px-8 text-gray-700 hover:bg-purple-100">ToDo</a>
                <a href="#" class="block py-3 px-8 text-gray-700 hover:bg-purple-100">In progress</a>
                <a href="#" class="block py-3 px-8 text-gray-700 hover:bg-purple-100">Done</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-purple-700">Dashboard</h1>
                <div class="flex items-center gap-4">

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
            <main class="p-3 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition-all">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">To do</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ $taskStatut->where('statut', 'to do')->count() }}</h2>
                    </div>

                    <div class="bg-green py-2 px-6 hover:bg-blue-300 transition-all rounded-lg shadow-md">
                        <p class="text-sm text-gray-500">In progress</p>
                        <h2 class="text-3xl font-bold text-orange-600 mt-2">{{ $taskStatut->where('statut', 'in progress')->count()}}</h2>
                    </div>
                    <div class="bg-green py-2 px-6 hover:bg-blue-300 transition-all rounded-lg shadow-md">
                        <p class="text-sm text-gray-500">Done</p>
                        <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $taskStatut->where('statut', 'done')->count()}}</h2>
                    </div>
                    <div class="bg-green py-2 px-6 hover:bg-blue-300 transition-all rounded-lg shadow-md">
                        <p class="text-sm text-gray-500">Retard</p>
                        <h2 class="text-3xl font-bold text-red-600 mt-2">
                            {{ $taskStatut->filter(fn($task) => $task->deadline < now() && $task->statut !== 'done')->count() }}
                        </h2>
                    </div>
                    <div class="bg-green py-2 px-6 hover:bg-blue-300 transition-all rounded-lg shadow-md">
                        <p class="text-sm text-gray-500">Total</p>
                        <h2 class="text-3xl font-bold text-blue-600 mt-2">{{ $taskStatut->count('statut')}}</h2>
                    </div>

                </div>

                <div class="bg-white rounded-lg">
                    <div class="bg-white p-6 rounded-lg grid grid-cols-2 item-center justify-around gap-4">
                        <div class="p-4 font-bold text-purple-700 border-b">Tasks List</div>
                        <div class="flex items-center justify-end gap-3 border-b">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input id="search_By_Mostafa" type="text" placeholder="Search tasks..."
                                    class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none transition-all w-full sm:w-64">
                            </div>

                            <button @click="showModal = true"
                                class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-purple-200 transition-all active:scale-95 whitespace-nowrap">
                                <i class="fas fa-plus"></i>
                                <span class="hidden sm:inline">Add Task</span>
                            </button>
                        </div>
                    </div>

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
                        <tbody id="result_Mostafa">

                            @foreach ($tasks as $task)

                            <tr class="border-t transition-all shadow-md
                                
                                {{ $task->statut == 'in progress' ? 'bg-red-100' : ($task->statut == 'done' ? 'bg-green-100' : '') }}
                                
                                {{ $task->deleted_at !== null ? 'bg-amber-100/40 grayscale-[50%] text-gray-400 opacity-75' : 'text-gray-700' }}">
                                <td class="p-4 font-semibold text-gray-700" dir="auto">{{ $task->titre }}</td>
                                <td class="p-4 text-gray-600" dir="auto">{{ $task->description }}</td>
                                <td class="p-4 text-sm text-purple-600">{{ $task->deadline }}</td>
                                <td class="p-4" dir="auto">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $task->priorite == 'high' ? 'bg-red-100 text-red-600' : ($task->priorite == 'medium' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                                        {{ strtoupper($task->priorite) }}
                                    </span>
                                </td>

                                <td class="p-4 italic text-gray-500">
                                    <div x-data="{ statut: '{{ $task->statut }}' }"
                                        class="relative rotate-[-2deg] hover:rotate-0 flex w-full items-center group bg-white rounded-lg px-2 py-1 shadow-[1px_1px_4px_rgba(0,0,0,0.1)] shadow-blue-200 transition-all hover:shadow-blue-400">
                                        <select class='w-full'
                                            x-model="statut"
                                            @change="
                                                fetch(`/tasks/{{ $task->id }}/update-statut`, {
                                                    method: 'PATCH',
                                                    headers: { 
                                                        'Content-Type': 'application/json', 
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                                                    },
                                                    body: JSON.stringify({ statut: statut })
                                                });
                                            "
                                            class="bg-transparent border-none focus:ring-0 focus:border-none p-0 m-0 cursor-pointer appearance-none hover:text-blue-600 transition italic text-gray-500 ">
                                            <option value="to do" :selected="statut == 'to do'">To Do</option>
                                            <option value="in progress" :selected="statut == 'in progress'">In Progress</option>
                                            <option value="done" :selected="statut == 'done'">Done</option>
                                        </select>
                                        <i class="fas fa-chevron-down absolute right-2 text-xs text-blue-400 group-hover:text-blue-600 transition-colors pointer-events-none"></i>
                                    </div>
                                </td>
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
                                        @method('PATCH')
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
                    <div class="mt-6 flex flex-col items-center gap-4">

                        <div class="modern-pagination">
                            {{ $tasks->links('pagination::tailwind') }}
                        </div>

                        <div class="text-xs text-gray-400 font-medium">
                            <span class="text-purple-600 font-bold">{{ $tasks->firstItem() }}</span>
                            to
                            <span class="text-purple-600 font-bold">{{ $tasks->lastItem() }}</span>
                            <span class="mx-1">of</span>
                            <span class="text-gray-600">{{ $tasks->total() }}</span>
                        </div>
                    </div>

                </div>


        </div>
        </main>
    </div>
    <footer class="bg-white p-4 mt-10 text-center text-sm text-gray-400 border-t">
        © 2025 AdminPanel. All rights reserved.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.getElementById('search_By_Mostafa').addEventListener('input', (e) => {
            let text = e.target.value
            fetch(`/tasks/search?query=${encodeURIComponent(text)}`, {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then(response => response.json())
                .then(result => {
                    let table = document.getElementById('result_Mostafa');
                    table.innerHTML = '';

                    if (result.length === 0) {
                        table.innerHTML = '<tr><td colspan="5" class="p-4 text-center">Aucun résultat trouvé</td></tr>';
                        return;
                    }

                    result.forEach((task, index) => {

                        let priorityClass = task.priorite === 'high' ? 'bg-red-100 text-red-600' :
                            task.priorite === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                            'bg-green-100 text-green-600';

                        let row = document.createElement('tr');
                        row.className = "border-t hover:bg-gray-50 transition opacity-0 transform translate-y-4"; // بادي شفاف ونازل شوية
                        row.style.transition = "all 0.5s ease"; // speed annimation

                        row.innerHTML = `
                            <td class="p-4 font-semibold">${task.titre || '-'}</td>
                            <td class="p-4 text-sm text-gray-600">${task.description || '-'}</td>
                            <td class="p-4 text-purple-600 font-medium">${task.deadline}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold ${priorityClass}">
                                    ${task.priorite.toUpperCase()}
                                </span>
                            </td>
                            <td class="p-4 italic text-gray-500">${task.statut}</td>
                        `;

                        table.appendChild(row);

                        setTimeout(() => {
                            row.classList.remove('opacity-0', 'translate-y-4');
                            row.classList.add('opacity-100', 'translate-y-0');
                        }, index * 300); // one by one animation
                    });
                })
                .catch(error => console.error('Error fetching tasks:', error))


        })
    </script>
    </script>
</body>

</html>