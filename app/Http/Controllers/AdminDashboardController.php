<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total = Registration::count();

        $reguler = Registration::where('jalur_id', 1)->count();
        $prestasi = Registration::where('jalur_id', 2)->count();
        $zonasi = Registration::where('jalur_id', 3)->count();

        $menunggu = Registration::where('status', 'menunggu_verifikasi')->count();
        $terverifikasi = Registration::where('status', 'terverifikasi')->count();
        $diterima = Registration::where('status', 'diterima')->count();
        $ditolak = Registration::where('status', 'tidak_diterima')->count();

            // 🔥 DAILY 7 HARI TERAKHIR
        $daily = Registration::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        return view('admin.dashboard', compact(
            'total',
            'reguler',
            'prestasi',
            'zonasi',
            'menunggu',
            'terverifikasi',
            'diterima',
            'ditolak',
            'daily'
        ));
    }
}