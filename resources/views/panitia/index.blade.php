@extends('admin.layouts.panitia')

@section('content')

<h1 class="text-2xl font-bold mb-6">Data Pendaftar</h1>

<table class="w-full bg-white rounded shadow">

    <tr class="border-b">
        <th class="p-2">Nama</th>
        <th class="p-2">Status</th>
        <th class="p-2">Aksi</th>
    </tr>

    @foreach($registrations as $r)
    <tr class="border-b">
        <td class="p-2">{{ $r->student->nama_lengkap }}</td>
        <td class="p-2">{{ $r->status }}</td>
        <td class="p-2">
            <a href="/panitia/registrations/{{ $r->id }}" class="text-blue-600">
                Detail
            </a>
        </td>
    </tr>
    @endforeach

</table>

@endsection