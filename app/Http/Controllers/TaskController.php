<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        // هاد السطر كيقول لـ Laravel: أي واحد بغا يدخل لهاد الـ Controller خاصو يكون auth (مسجل)
        $this->middleware('auth');

        // إلا بغيتي تحمي غير "Method" وحدة (مثلاً index) وتخلي لباقي:
        // $this->middleware('auth')->only('index');
    }

    public function index()
    {
        return view('dashboard');
    }
}
