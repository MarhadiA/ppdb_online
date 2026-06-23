<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);

        Announcement::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'is_published' => false,
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $a = Announcement::findOrFail($id);

        $a->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return back();
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return back();
    }

    // 🔥 TOGGLE PUBLISH (INI YANG PENTING)
    public function toggle($id)
    {
        $a = Announcement::findOrFail($id);

        $a->update([
            'is_published' => !$a->is_published,
            'published_at' => $a->is_published ? null : now(),
        ]);

        return back();
    }
}