@extends('admin.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Manajemen Jalur Pendaftaran</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- CREATE --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="POST" action="/admin/jalur">
            @csrf

            <input type="text" name="nama" placeholder="Nama Jalur"
                class="w-full border p-2 rounded mb-2">

            <input type="number" name="kuota" placeholder="Kuota"
                class="w-full border p-2 rounded mb-2">

            <textarea name="deskripsi" placeholder="Deskripsi"
                class="w-full border p-2 rounded mb-2"></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Tambah Jalur
            </button>
        </form>
    </div>

    {{-- LIST --}}
    @foreach($jalur as $j)
    <div class="bg-white rounded shadow p-4 mb-4">

        {{-- EDIT FORM --}}
        <form method="POST" action="/admin/jalur/{{ $j->id }}">
            @csrf
            @method('PUT')

            <input type="text"
                   name="nama"
                   value="{{ $j->nama }}"
                   class="w-full border p-2 rounded mb-2">

            <input type="number"
                   name="kuota"
                   value="{{ $j->kuota }}"
                   class="w-full border p-2 rounded mb-2">

            <textarea name="deskripsi"
                class="w-full border p-2 rounded mb-2">{{ $j->deskripsi }}</textarea>

            <div class="flex justify-between items-center">
                <div>
                    Kuota tersisa:
                    <span class="font-bold text-blue-600">
                        {{ $j->kuota - $j->registrations()->where('status','diterima')->count() }}
                    </span>
                </div>

                <div class="flex gap-2">
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Edit
                    </button>
        </form>

                    {{-- DELETE --}}
        <form method="POST" action="/admin/jalur/{{ $j->id }}">
             @csrf
             @method('DELETE')
             <button onclick="return confirm('Hapus jalur ini?')" class="bg-red-600 text-white px-4 py-2 rounded">
                 Hapus
            </button>
        </form>
    </div>
    </div>
    </div>
    @endforeach

</div>
@endsection