<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        // Ambil student milik user login
        $student = Student::with([
            'registration.jalur',
            'registration.documents'
        ])
        ->where('user_id', Auth::id())
        ->first();

        return view('student.dashboard', compact('student'));
    }
}
