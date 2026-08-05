@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">
        Upload Dokumen
    </h1>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pesan Berhasil --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form
        action="{{ route('student.documents.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white shadow rounded-3xl p-8 space-y-6">

        @csrf

        <div>
            <label class="block font-semibold mb-2">
                Foto 3x4
            </label>

            <input
                type="file"
                name="foto"
                class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-semibold mb-2">
                Kartu Keluarga (KK)
            </label>

            <input
                type="file"
                name="kk"
                class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-semibold mb-2">
                Ijazah / SKL
            </label>

            <input
                type="file"
                name="ijazah"
                class="w-full border rounded-lg p-2">
        </div>

        <div>
            <label class="block font-semibold mb-2">
                Rapor
            </label>

            <input
                type="file"
                name="rapor"
                class="w-full border rounded-lg p-2">
        </div>

        {{-- Hanya muncul jika jalur Prestasi --}}
        @if(strtolower($jalur->nama) == 'prestasi')
            <div>
                <label class="block font-semibold mb-2">
                    Piagam / Sertifikat Prestasi
                </label>

                <input
                    type="file"
                    name="piagam"
                    class="w-full border rounded-lg p-2">
            </div>
        @endif

        <div class="pt-4">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">
                Upload Dokumen
            </button>
        </div>

    </form>

</div>
@endsection