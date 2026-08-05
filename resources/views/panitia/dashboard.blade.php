@extends('admin.layouts.panitia')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">
        Dashboard Panitia
    </h1>
    <p class="text-gray-500 mt-2">
        Monitoring verifikasi dokumen calon siswa PPDB
    </p>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">

    {{-- Total --}}
    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Total Pendaftar</p>
        <h2 class="text-3xl font-bold mt-2 text-blue-600">
            {{ $totalPendaftar }}
        </h2>
    </div>

    {{-- Menunggu Upload --}}
    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Menunggu Upload</p>
        <h2 class="text-3xl font-bold mt-2 text-orange-500">
            {{ $menungguUpload }}
        </h2>
    </div>

    {{-- Menunggu Verifikasi --}}
    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Menunggu Verifikasi</p>
        <h2 class="text-3xl font-bold mt-2 text-yellow-500">
            {{ $menungguVerifikasi }}
        </h2>
    </div>

    {{-- Terverifikasi --}}
    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Terverifikasi</p>
        <h2 class="text-3xl font-bold mt-2 text-green-600">
            {{ $terverifikasi }}
        </h2>
    </div>

    {{-- Ditolak --}}
    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-500">Dokumen Ditolak</p>
        <h2 class="text-3xl font-bold mt-2 text-red-600">
            {{ $dokumenDitolak }}
        </h2>
    </div>

</div>

{{-- Shortcut Menu --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-2">
            Verifikasi Dokumen
        </h2>

        <p class="text-gray-500 mb-4">
            Lihat semua calon siswa dan verifikasi dokumen yang telah diupload.
        </p>

        <a href="/panitia/registrations"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Buka Daftar Pendaftar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-2">
            Tugas Panitia
        </h2>

        <ul class="list-disc ml-5 text-gray-600 space-y-1">
            <li>Periksa kelengkapan dokumen</li>
            <li>Setujui dokumen valid</li>
            <li>Tolak dokumen bermasalah</li>
            <li>Berikan catatan revisi</li>
        </ul>
    </div>

</div>

{{-- Workflow --}}
<div class="bg-white rounded-xl shadow p-6 mt-8">
    <h2 class="text-xl font-bold mb-4">
        Alur Verifikasi
    </h2>

    <div class="flex flex-wrap gap-4">
        <div class="bg-orange-100 text-orange-700 px-4 py-2 rounded">
            Menunggu Upload
        </div>

        <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded">
            Menunggu Verifikasi
        </div>

        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">
            Terverifikasi
        </div>
    </div>
</div>

@endsection