@extends('admin.layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Admin Dashboard PPDB</h1>

    </div>

    {{-- STAT CARDS TOTAL --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-xl shadow">
            <p>Total Pendaftar</p>
            <h2 class="text-2xl font-bold">{{ $total }}</h2>
        </div>

        <div class="bg-blue-100 p-5 rounded-xl">
            <p>Reguler</p>
            <h2 class="text-2xl font-bold">{{ $reguler }}</h2>
        </div>

        <div class="bg-green-100 p-5 rounded-xl">
            <p>Prestasi</p>
            <h2 class="text-2xl font-bold">{{ $prestasi }}</h2>
        </div>

        <div class="bg-yellow-100 p-5 rounded-xl">
            <p>Zonasi</p>
            <h2 class="text-2xl font-bold">{{ $zonasi }}</h2>
        </div>

    </div>

    {{-- STATUS FLOW --}}
    <div class="grid grid-cols-4 gap-4 mt-6">

        <div class="bg-yellow-500 text-white p-4 rounded-xl">
            Menunggu: {{ $menunggu }}
        </div>

        <div class="bg-blue-500 text-white p-4 rounded-xl">
            Terverifikasi: {{ $terverifikasi }}
        </div>

        <div class="bg-green-500 text-white p-4 rounded-xl">
            Diterima: {{ $diterima }}
        </div>

        <div class="bg-red-500 text-white p-4 rounded-xl">
            Ditolak: {{ $ditolak }}
        </div>

    </div>

    {{-- GRAFIK SIMPLE (tanpa chart library dulu) --}}
    <div class="mt-8 bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-bold mb-4">Pendaftaran 7 Hari Terakhir</h2>

        <div class="space-y-2">
            @foreach($daily as $d)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $d->date }}</span>
                    <span class="font-bold">{{ $d->total }}</span>
                </div>
            @endforeach
        </div>

    </div>

    {{-- ACTIONS --}}
    <div class="mt-10 flex flex-wrap gap-4">

        {{-- JALANKAN SELEKSI --}}
        <form method="POST" action="/admin/seleksi/run">
            @csrf
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700">
                Jalankan Seleksi
            </button>
        </form>

        {{-- PUBLISH --}}
        <a href="/admin/seleksi/preview"
        class="bg-gray-600 text-white px-4 py-2 rounded">
            Preview Hasil
        </a>

        {{-- EXPORT --}}
        <a href="/admin/export/seleksi"
           class="bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800">
            Export Excel
        </a>

    </div>

    {{-- INFO STATUS SISTEM --}}
    <div class="mt-6 p-4 bg-gray-100 rounded-xl text-sm text-gray-600">
        Sistem seleksi:
        • Urut nilai rata-rata tertinggi  
        • Dibagi per jalur (Reguler / Prestasi / Zonasi)  
        • Sesuai kuota masing-masing jalur  
    </div>

</div>

@endsection