<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //  auth(): Authenticated User
        //  user(): objet from User model
        //  tasks(): fonction dans le model User.php  hasMany that make to get alltasks user_id
        $tasks = auth()->user()->tasks()->withTrashed()->paginate(4);

        return view('dashboard', compact('tasks'));
    }

    public function destroy($id)
    {

        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('dashboard')->with('success', 'le task est bien supprimer!');
    }

    public function archiveTask($id)
    {
        // get only trashed tasks (archived tasks)

        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'le task est bien archiver!');
    }

    // get task back to table tasks
    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('dashboard')->with('success', 'le task est bien return!');
    }

    // update status task this is result of ajax request
    public function updateStatut(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->statut = $request->statut;
        $task->save();

        return response()->json(['message' => 'Status updated!']);
    }
}
