@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Status Pendaftaran</h1>

    @if(!$reg)
        <div class="bg-red-100 p-4 rounded">
            Nomor pendaftaran tidak ditemukan
        </div>
    @else

        <div class="bg-white p-6 rounded shadow space-y-3">

            <p><b>Nama:</b> {{ $reg->student->nama_lengkap }}</p>
            <p><b>NIK:</b> {{ $reg->student->nik }}</p>
            <p><b>Jalur:</b> {{ $reg->jalur->nama }}</p>

            <p>
                <b>Status:</b>
                <span class="px-3 py-1 rounded 
                    {{ $reg->status == 'diterima' ? 'bg-green-200' : 'bg-yellow-200' }}">
                    {{ $reg->status }}
                </span>
            </p>

        </div>

    @endif

</div>

@endsection