@extends('layouts.app')

@section('content')

{{-- Hero --}}
<section class="min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">

        <div>
            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold">
                PPDB Tahun Ajaran 2026/2027
            </span>

            <h2 class="mt-6 text-5xl lg:text-6xl font-extrabold leading-tight">
                Pendaftaran Siswa Baru
                <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Lebih Mudah
                </span>
                & Modern
            </h2>

            <p class="mt-6 text-lg text-slate-600 leading-relaxed">
                Sistem Penerimaan Peserta Didik Baru secara online untuk mempermudah
                proses pendaftaran, upload dokumen, verifikasi, hingga pengumuman hasil seleksi.
            </p>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="/register"
                   class="px-6 py-4 rounded-2xl bg-blue-600 text-white hover:bg-blue-700 shadow-xl transition">
                    Daftar Sekarang
                </a>

                <a href="#status"
                   class="px-6 py-4 rounded-2xl border hover:bg-white transition">
                    Cek Status
                </a>
            </div>
        </div>

        {{-- Hero Card --}}
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-white/50">
            <h3 class="text-2xl font-bold mb-6">Statistik PPDB</h3>

            <div class="grid grid-cols-2 gap-4">

                <div class="rounded-2xl bg-blue-50 p-6">
                    <p class="text-slate-500 text-sm">Total Pendaftar</p>
                    <h4 class="text-3xl font-bold text-blue-700 mt-2">
                        {{ $totalPendaftar ?? 0 }}
                    </h4>
                </div>

                <div class="rounded-2xl bg-green-50 p-6">
                    <p class="text-slate-500 text-sm">Kuota</p>
                    <h4 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $kuota ?? 0 }}
                    </h4>
                </div>

                <div class="rounded-2xl bg-yellow-50 p-6">
                    <p class="text-slate-500 text-sm">Terverifikasi</p>
                    <h4 class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $terverifikasi ?? 0 }}
                    </h4>
                </div>

                <div class="rounded-2xl bg-purple-50 p-6">
                    <p class="text-slate-500 text-sm">Jalur</p>
                    <h4 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ $jalur ?? 0 }}
                    </h4>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- Features --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-4xl font-bold text-center mb-12">
            Kenapa Memilih Sekolah Kami?
        </h3>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 transition">
                <h4 class="text-xl font-bold mb-4"> Pendidikan Berkualitas</h4>
                <p class="text-slate-600">
                    Kurikulum modern dan relevan dengan kebutuhan industri.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 transition">
                <h4 class="text-xl font-bold mb-4">Guru Profesional</h4>
                <p class="text-slate-600">
                    Didukung tenaga pengajar berpengalaman dan kompeten.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:-translate-y-2 transition">
                <h4 class="text-xl font-bold mb-4">Fasilitas Modern</h4>
                <p class="text-slate-600">
                    Lab komputer, workshop, perpustakaan, dan sarana lengkap.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- Timeline --}}
<section id="jadwal" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-4xl font-bold text-center mb-16">
            Tahapan PPDB
        </h3>

        <div class="grid md:grid-cols-4 gap-6">

            @foreach([
                ['Pendaftaran', '1-15 Juli'],
                ['Upload Dokumen', '1-20 Juli'],
                ['Verifikasi', '21-25 Juli'],
                ['Pengumuman', '30 Juli']
            ] as $item)

                <div class="bg-slate-50 rounded-3xl p-6 shadow">
                    <h4 class="font-bold text-xl">{{ $item[0] }}</h4>
                    <p class="text-slate-600 mt-2">{{ $item[1] }}</p>
                </div>

            @endforeach

        </div>
    </div>
</section>

{{-- Announcement --}}
<section id="pengumuman" class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <h3 class="text-4xl font-bold text-center mb-12">
            Pengumuman
        </h3>

        <div class="space-y-6">
      

            @forelse($announcements as $a)
                <div class="bg-white rounded-3xl shadow p-6">

                    <div class="flex justify-between mb-3">
                        <h4 class="font-bold text-xl">
                            {{ $a->judul }}
                        </h4>

                        <span class="text-sm text-slate-500">
                            {{ $a->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <p class="text-slate-600">
                        {{ $a->isi }}
                    </p>

                </div>
            @empty
                <div class="text-center text-slate-500">
                    Belum ada pengumuman
                </div>
            @endforelse

       

        </div>
    </div>
</section>

{{-- Check Status --}}
<section id="status" class="py-20">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-[32px] shadow-2xl p-10">

            <h3 class="text-4xl font-bold text-center mb-4">
                Cek Status Pendaftaran
            </h3>

            <p class="text-center text-slate-500 mb-8">
                Masukkan nomor pendaftaran untuk melihat progres.
            </p>

            <form method="GET" action="/cek-status">
                <div class="flex flex-col md:flex-row gap-4">

                    <input
                        type="text"
                        name="nomor"
                        placeholder="Contoh: PPDB-2026-00001"
                        class="flex-1 border rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <button
                        class="px-8 py-4 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition">
                        Cek
                    </button>

                </div>
            </form>

        </div>
    </div>
</section>

@endsection