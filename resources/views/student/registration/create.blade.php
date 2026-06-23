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

    <form method="POST" action="/student/registration/store">
        @csrf

        <div class="bg-white rounded-2xl shadow p-8 space-y-6">

            <h2 class="text-xl font-bold">Data Diri</h2>

            <input name="nik" placeholder="NIK"
                class="w-full border p-3 rounded-xl">

            <input name="nama_lengkap" placeholder="Nama Lengkap"
                class="w-full border p-3 rounded-xl">
                <select name="jenis_kelamin" class="w-full border p-3 rounded-xl">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>

            <input name="tempat_lahir" placeholder="Tempat Lahir"
                class="w-full border p-3 rounded-xl">

            <input type="date" name="tanggal_lahir"
                class="w-full border p-3 rounded-xl">

            <textarea name="alamat"
                class="w-full border p-3 rounded-xl"
                placeholder="Alamat"></textarea>
                        
            <input name="agama"
                placeholder="Agama"
                class="w-full border p-3 rounded-xl">

            <input name="no_hp"
                placeholder="No HP"
                class="w-full border p-3 rounded-xl">

            <h2 class="text-xl font-bold">Data Orang Tua</h2>

            <input name="nama_ayah"
                placeholder="Nama Ayah"
                class="w-full border p-3 rounded-xl">

            <input name="nama_ibu"
                placeholder="Nama Ibu"
                class="w-full border p-3 rounded-xl">
                    <input name="pekerjaan_ortu"
            placeholder="Pekerjaan Orang Tua"
            class="w-full border p-3 rounded-xl">
                    <h2 class="text-xl font-bold">Data Akademik</h2>

            <input name="sekolah_asal"
                placeholder="Sekolah Asal"
                class="w-full border p-3 rounded-xl">

            <input name="nilai_rata_rata"
                placeholder="Nilai Rata-rata"
                class="w-full border p-3 rounded-xl">

            <select name="jalur_id" class="w-full border p-3 rounded-xl">
            @foreach($jalurs as $jalur)
                <option value="{{ $jalur->id }}">
                    {{ $jalur->nama }}
                </option>
            @endforeach
            </select>

            <button class="w-full bg-blue-600 text-white py-4 rounded-xl">
                Submit Pendaftaran
            </button>
        </div>

    </form>

</div>

</body>
</html>