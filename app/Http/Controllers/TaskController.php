<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        // هاد السطر كيقول لـ Laravel: أي واحد بغا يدخل لهاد الـ Controller خاصو يكون auth (مسجل)
        $this->middleware('auth');
    }

    public function index()
    {
        //  auth(): Authenticated User
        //  user(): objet from User model
        //  tasks(): fonction dans le model User.php  hasMany that make to get alltasks user_id
        $tasks = auth()->user()->tasks()->withTrashed()->paginate(10);
        
        return view('dashboard', compact('tasks'));
    }

    public function destroy($id)
    {

        Task::destroy($id);

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
}
