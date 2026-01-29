<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class EditController extends Controller
{
    
    function index($id)
    {
        $tasks = Task::findOrFail($id);
        return view('tasks.update',compact('tasks'));
    }
    function updateTask(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'priorite' => 'required|string',
            'statut' => 'required|in:To do,In progress,Done',
        ]);
        //echo $id;
        //dd($variable);
        // SELECT * FROM tasks WHERE id = $id AND user_id = current_user_id
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priorite' => $request->priorite,
            'statut' => $request->statut,
        ]);
        return redirect()->route('dashboard')->with('success', 'Task Edit avec Success');
    }
}
