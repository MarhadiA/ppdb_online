@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">
        Upload Dokumen
    </h1>

    <form action="{{ route('student.documents.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white shadow rounded-3xl p-8 space-y-6">
        @csrf

        <div>
            <label>Foto 3x4</label>
            <input type="file" name="foto" class="block mt-2">
        </div>

        <div>
            <label>Kartu Keluarga</label>
            <input type="file" name="kk" class="block mt-2">
        </div>

        <div>
            <label>Ijazah / SKL</label>
            <input type="file" name="ijazah" class="block mt-2">
        </div>

        <div>
            <label>Rapor</label>
            <input type="file" name="rapor" class="block mt-2">
        </div>

        <button class="bg-blue-600 text-white px-6 py-3 rounded-xl">
            Upload Dokumen
        </button>
    </form>

</div>
@endsection