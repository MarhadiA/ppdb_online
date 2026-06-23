@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- HEADER USER --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Dashboard Calon Siswa
            </h1>

            <p class="text-gray-500 mt-1">
                Selamat datang,
                <span class="font-semibold text-blue-600">
                    {{ auth()->user()->name }}
                </span>
            </p>
        </div>



    </div>

    @if(!$student)

        {{-- BELUM DAFTAR --}}
        <div class="bg-white rounded-3xl shadow p-8">
            <h2 class="text-2xl font-bold text-red-500">
                Belum Mendaftar
            </h2>

            <p class="mt-4 text-gray-600">
                Anda belum mengisi form pendaftaran PPDB.
            </p>

            <a href="/student/registration/create"
               class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-xl">
                Isi Form Pendaftaran
            </a>
        </div>

    @else

        {{-- STAT CARD --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Status</p>
                <h2 class="text-xl font-bold text-blue-600 mt-2">
                    {{ $student->registration->status }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-gray-500">Nomor Pendaftaran</p>
                <h2 class="text-lg font-bold mt-2">
                    {{ $student->registration->nomor_pendaftaran }}
                </h2>
            </div>

        <div class="bg-white rounded-2xl shadow p-6">
    <p class="text-gray-500">Jalur</p>
    <h2 class="text-lg font-bold mt-2">
        {{ $student->registration->jalur->nama ?? 'Belum Memilih Jalur' }}
    </h2>
</div>
        <div class="bg-white rounded-2xl shadow p-6">
    <p class="text-gray-500">Hasil Seleksi</p>

    <h2 class="text-lg font-bold mt-2">
        @if($student->registration->status == 'diterima')
            <span class="text-green-600">Diterima</span>
        @elseif($student->registration->status == 'tidak_diterima')
            <span class="text-red-600">Tidak Diterima</span>
        @else
            <span class="text-gray-500">Belum Diproses</span>
        @endif
    </h2>
</div>

        </div>

        {{-- PROGRESS DOKUMEN --}}
        <div class="bg-white rounded-3xl shadow p-8 mt-8">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">
                    Dokumen PPDB
                </h2>

                <a href="{{ route('student.documents') }}"
                   class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl">
                    Upload Dokumen
                </a>
            </div>

            @php
                $total = $student->registration->documents->count();
                $disetujui = $student->registration->documents->where('status_verifikasi', 'disetujui')->count();
                $ditolak = $student->registration->documents->where('status_verifikasi', 'ditolak')->count();
            @endphp

            <div class="grid md:grid-cols-3 gap-4 mt-4">

                <div class="p-4 bg-gray-100 rounded-xl">
                    <p class="text-gray-500">Total Upload</p>
                    <h3 class="text-xl font-bold">{{ $total }}</h3>
                </div>

                <div class="p-4 bg-green-100 rounded-xl">
                    <p class="text-gray-500">Disetujui</p>
                    <h3 class="text-xl font-bold text-green-700">{{ $disetujui }}</h3>
                </div>

                <div class="p-4 bg-red-100 rounded-xl">
                    <p class="text-gray-500">Ditolak</p>
                    <h3 class="text-xl font-bold text-red-700">{{ $ditolak }}</h3>
                </div>

            </div>

        </div>

    @endif

</div>

@endsection