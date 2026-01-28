
<form action="{{ route('tasks.store') }}" method="POST" class="p-6 space-y-4">
    @csrf
    <div>
        <label>Titre</label>
        <input type="text" name="titre" class="w-full border p-2 rounded">
    </div>
    
    <div>
        <label>Description</label>
        <textarea name="description" class="w-full border p-2 rounded"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Deadline</label>
            <input type="datetime-local" name="deadline" class="w-full border p-2 rounded">
        </div>
        <div>
            <label>Priorité</label>
            <select name="priorite" class="w-full border p-2 rounded">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div>
            <label>statut</label>
            <select name="priorite" class="w-full border p-2 rounded">
                <option value="To do">To do</option>
                <option value="In progress">In progress</option>
                <option value="Done">Done</option>
            </select>
        </div>
    </div>

    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Save Task</button>
    <div>
        <a href="/dashboard" >Close</a >
    </div>
</form>