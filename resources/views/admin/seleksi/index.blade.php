@extends('admin.layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">Seleksi PPDB</h1>

        <form method="POST" action="/admin/seleksi/run">
            @csrf
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl">
                Jalankan Seleksi
            </button>
        </form>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Jalur</th>
                    <th class="p-3">Nilai</th>
                    <th class="p-3">Ranking</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $i => $r)

                <tr class="border-t">

                    <td class="p-3">{{ $i+1 }}</td>

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
                        {{ $r->ranking_nilai ?? '-' }}
                    </td>

                    <td class="p-3">

                        @if($r->status == 'terverifikasi')
                            <span class="text-blue-600">Terverifikasi</span>

                        @elseif($r->status == 'diterima')
                            <span class="text-green-600 font-bold">Diterima</span>

                        @else
                            <span class="text-red-600">Tidak Diterima</span>
                        @endif

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center p-4">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection