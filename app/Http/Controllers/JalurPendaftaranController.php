<?php

namespace App\Http\Controllers;

use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;

class JalurPendaftaranController extends Controller
{
    public function index()
    {
        $jalur = JalurPendaftaran::all();
        return view('admin.jalur.index', compact('jalur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kuota' => 'required|integer',
        ]);

        JalurPendaftaran::create($request->all());

        return back()->with('success', 'Jalur berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jalur = JalurPendaftaran::findOrFail($id);

        $jalur->update([
            'nama' => $request->nama,
            'kuota' => $request->kuota,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Jalur berhasil diupdate');
    }

    public function destroy($id)
    {
        JalurPendaftaran::findOrFail($id)->delete();

        return back()->with('success', 'Jalur dihapus');
    }
}