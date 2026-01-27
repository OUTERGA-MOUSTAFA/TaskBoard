<?php

namespace App\Http\Controllers;
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
        $tasks = auth()->user()->tasks()->paginate(10);
        return view('dashboard', compact('tasks'));
    }
}
