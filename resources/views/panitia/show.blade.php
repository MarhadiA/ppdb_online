@extends('admin.layouts.panitia')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Detail Pendaftar
</h1>

{{-- DATA SISWA --}}
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4">Data Siswa</h2>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-gray-500">Nomor Pendaftaran</p>
            <p class="font-semibold">{{ $registration->nomor_pendaftaran }}</p>
        </div>

        <div>
            <p class="text-gray-500">Status</p>
            <p class="font-semibold">{{ $registration->status }}</p>
        </div>

        <div>
            <p class="text-gray-500">Nama Lengkap</p>
            <p class="font-semibold">{{ $registration->student->nama_lengkap }}</p>
        </div>

        <div>
            <p class="text-gray-500">NIK</p>
            <p class="font-semibold">{{ $registration->student->nik }}</p>
        </div>

        <div>
            <p class="text-gray-500">Sekolah Asal</p>
            <p class="font-semibold">{{ $registration->student->sekolah_asal }}</p>
        </div>

        <div>
            <p class="text-gray-500">Nilai Rata-rata</p>
            <p class="font-semibold">{{ $registration->student->nilai_rata_rata }}</p>
        </div>
    </div>
</div>

{{-- DOKUMEN --}}
<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-6">Verifikasi Dokumen</h2>

    <div class="space-y-6">
        @foreach($registration->documents as $doc)
            <div class="border rounded-lg p-5">

                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="font-bold text-lg capitalize">
                            {{ $doc->jenis_dokumen }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            Status:
                            @if($doc->status_verifikasi == 'disetujui')
                                <span class="text-green-600 font-semibold">
                                    Disetujui
                                </span>
                            @elseif($doc->status_verifikasi == 'ditolak')
                                <span class="text-red-600 font-semibold">
                                    Ditolak
                                </span>
                            @else
                                <span class="text-yellow-600 font-semibold">
                                    Menunggu Verifikasi
                                </span>
                            @endif
                        </p>
                    </div>

                    <a href="{{ $doc->cloudinary_url }}"
                       target="_blank"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Preview File
                    </a>
                </div>

                {{-- CATATAN --}}
                @if($doc->catatan)
                    <div class="bg-red-50 text-red-700 p-3 rounded mb-3">
                        Catatan: {{ $doc->catatan }}
                    </div>
                @endif

                {{-- TOMBOL VERIFIKASI --}}
                @if($doc->status_verifikasi != 'disetujui')
                    <div class="flex gap-3">

                        {{-- APPROVE --}}
                        <form method="POST"
                              action="/panitia/document/{{ $doc->id }}/approve">
                            @csrf
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                Approve
                            </button>
                        </form>

                        {{-- REJECT --}}
                        <form method="POST"
                              action="/panitia/document/{{ $doc->id }}/reject"
                              class="flex gap-2">
                            @csrf

                            <input
                                type="text"
                                name="catatan"
                                placeholder="Alasan penolakan..."
                                required
                                class="border rounded px-3 py-2 w-80"
                            >

                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Reject
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        @endforeach
    </div>
</div>

@endsection