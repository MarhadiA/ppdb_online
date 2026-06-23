<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPanitiaController extends Controller
{
    public function index()
    {
        $panitia = User::where('role', 'panitia')->get();
        return view('admin.panitia.index', compact('panitia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'panitia'
        ]);

        return back()->with('success', 'Panitia berhasil ditambahkan');
    }

    public function destroy($id)
    {
        User::where('id', $id)->where('role', 'panitia')->delete();

        return back()->with('success', 'Panitia dihapus');
    }
}