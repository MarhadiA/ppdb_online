<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\JalurPendaftaran;
use App\Models\Announcement;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $totalPendaftar = Registration::count();

        $kuota = JalurPendaftaran::sum('kuota');

        $terverifikasi = Registration::where('status', 'terverifikasi')->count();

        $jalur = JalurPendaftaran::count();

        $announcements = Announcement::where('is_published', 'true')
            ->latest()
            ->get();

        return view('welcome', compact(
            'totalPendaftar',
            'kuota',
            'terverifikasi',
            'jalur',
            'announcements'
        ));
    }
    public function checkStatus(Request $request)
    {
        $request->validate([
            'nomor' => 'required'
        ]);

        $reg = Registration::with(['student', 'jalur'])
            ->where('nomor_pendaftaran', $request->nomor)
            ->first();

        return view('status', compact('reg'));
    }
}