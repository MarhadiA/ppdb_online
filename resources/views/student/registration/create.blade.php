<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100">

<div class="max-w-5xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        Form Pendaftaran PPDB
    </h1>

    {{-- Error Validasi --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pesan Error --}}
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.registration.store') }}">
        @csrf

        <div class="bg-white rounded-2xl shadow p-8 space-y-6">

            <h2 class="text-xl font-bold">Data Diri</h2>

            <input
                type="text"
                name="nik"
                value="{{ old('nik') }}"
                placeholder="NIK"
                class="w-full border p-3 rounded-xl">

            <input
                type="text"
                name="nama_lengkap"
                value="{{ old('nama_lengkap') }}"
                placeholder="Nama Lengkap"
                class="w-full border p-3 rounded-xl">

            <select
                name="jenis_kelamin"
                class="w-full border p-3 rounded-xl">

                <option value="">Pilih Jenis Kelamin</option>

                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                    Laki-laki
                </option>

                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                    Perempuan
                </option>

            </select>

            <input
                type="text"
                name="tempat_lahir"
                value="{{ old('tempat_lahir') }}"
                placeholder="Tempat Lahir"
                class="w-full border p-3 rounded-xl">

            <input
                type="date"
                name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}"
                class="w-full border p-3 rounded-xl">

            <textarea
                name="alamat"
                class="w-full border p-3 rounded-xl"
                placeholder="Alamat">{{ old('alamat') }}</textarea>
                <input
                    type="text"
                    name="kecamatan"
                    value="{{ old('kecamatan') }}"
                    placeholder="Kecamatan"
                    class="w-full border p-3 rounded-xl">

            <input
                type="text"
                name="agama"
                value="{{ old('agama') }}"
                placeholder="Agama"
                class="w-full border p-3 rounded-xl">

            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
                placeholder="No HP"
                class="w-full border p-3 rounded-xl">

            <h2 class="text-xl font-bold">Data Orang Tua</h2>

            <input
                type="text"
                name="nama_ayah"
                value="{{ old('nama_ayah') }}"
                placeholder="Nama Ayah"
                class="w-full border p-3 rounded-xl">

            <input
                type="text"
                name="nama_ibu"
                value="{{ old('nama_ibu') }}"
                placeholder="Nama Ibu"
                class="w-full border p-3 rounded-xl">

            <input
                type="text"
                name="pekerjaan_ortu"
                value="{{ old('pekerjaan_ortu') }}"
                placeholder="Pekerjaan Orang Tua"
                class="w-full border p-3 rounded-xl">

            <h2 class="text-xl font-bold">Data Akademik</h2>

            <input
                type="text"
                name="sekolah_asal"
                value="{{ old('sekolah_asal') }}"
                placeholder="Sekolah Asal"
                class="w-full border p-3 rounded-xl">

            <input
                type="number"
                step="0.01"
                name="nilai_rata_rata"
                value="{{ old('nilai_rata_rata') }}"
                placeholder="Nilai Rata-rata"
                class="w-full border p-3 rounded-xl">

            <select
                name="jalur_id"
                class="w-full border p-3 rounded-xl">

                @foreach($jalurs as $jalur)
                    <option
                        value="{{ $jalur->id }}"
                        {{ old('jalur_id') == $jalur->id ? 'selected' : '' }}>
                        {{ $jalur->nama }}
                    </option>
                @endforeach

            </select>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl transition">
                Submit Pendaftaran
            </button>

        </div>

    </form>

</div>

</body>
</html>