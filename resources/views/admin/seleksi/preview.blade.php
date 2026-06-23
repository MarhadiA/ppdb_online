@extends('admin.layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Preview Hasil Seleksi
        </h1>

        <div class="flex gap-2">

            {{-- Kembali --}}
            <a href="/admin/seleksi"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Kembali
            </a>

            {{-- RUN SELEKSI --}}
            <form method="POST" action="/admin/seleksi/run">
                @csrf
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Jalankan Ulang
                </button>
            </form>

        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Ranking</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Jalur</th>
                    <th class="p-3">Nilai</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>

                @foreach($data as $r)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $r->ranking_nilai ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $r->student->nama_lengkap ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $r->jalur->nama ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $r->student->nilai_rata_rata ?? 0 }}
                    </td>

                    <td class="p-3">

                        @if($r->status == 'diterima')
                            <span class="text-green-600 font-bold">DITERIMA</span>

                        @elseif($r->status == 'tidak_diterima')
                            <span class="text-red-600">TIDAK DITERIMA</span>

                        @else
                            <span class="text-blue-600">TERVERIFIKASI</span>
                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection