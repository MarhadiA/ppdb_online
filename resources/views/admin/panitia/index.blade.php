@extends('admin.layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Manajemen Panitia</h1>

{{-- FORM TAMBAH PANITIA --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <form method="POST" action="/admin/panitia" class="space-y-3">
        @csrf

        <input name="name" placeholder="Nama"
            class="border p-2 w-full">

        <input name="email" placeholder="Email"
            class="border p-2 w-full">

        <input type="password" name="password" placeholder="Password"
            class="border p-2 w-full">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah Panitia
        </button>
    </form>
</div>

{{-- LIST PANITIA --}}
<div class="bg-white p-6 rounded shadow">

    <h2 class="font-bold mb-4">Daftar Panitia</h2>

    <table class="w-full">
        <tr class="border-b">
            <th class="text-left p-2">Nama</th>
            <th class="text-left p-2">Email</th>
            <th class="p-2">Aksi</th>
        </tr>

        @foreach($panitia as $p)
        <tr class="border-b">
            <td class="p-2">{{ $p->name }}</td>
            <td class="p-2">{{ $p->email }}</td>
            <td class="p-2">

                <form method="POST" action="/admin/panitia/{{ $p->id }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-600">
                        Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection

