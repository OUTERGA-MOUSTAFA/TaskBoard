<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class createController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'description' => 'required',
            'deadline' => 'required|date',
            'priorite' => 'required|in:low,medium,high',
            'status' => 'required|in:To do,In progress,Done',
        ]);
        auth()->user()->tasks()->create($validated);

        return redirect()->back()->with('success', 'Task ajouter avec success!');
    }
    
}
