@extends('admin.layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Manajemen Pengumuman</h1>

    {{-- FORM CREATE --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form method="POST" action="/admin/announcements">
            @csrf

            <input type="text" name="judul" placeholder="Judul"
                class="w-full border p-2 mb-2 rounded">

            <textarea name="isi" placeholder="Isi pengumuman"
                class="w-full border p-2 mb-2 rounded"></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>

    {{-- LIST --}}
    <div class="space-y-4">

        @foreach($announcements as $a)
        <div class="bg-white p-4 rounded shadow">

            <div class="flex justify-between items-center">
                <h2 class="font-bold">{{ $a->judul }}</h2>

                <span class="text-sm px-2 py-1 rounded 
                    {{ $a->status == 'published' ? 'bg-green-200' : 'bg-gray-200' }}">
                    {{ $a->status }}
                </span>
            </div>

            <p class="text-gray-600 mt-2">{{ $a->isi }}</p>

            <div class="flex gap-2 mt-4">

                {{-- TOGGLE --}}
                <form method="POST" action="/admin/announcements/{{ $a->id }}/toggle">
                    @csrf
                    <button class="bg-yellow-500 text-white px-3 py-1 rounded">
                         {{ $a->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>
                <button 
                    onclick='openEditModal(@json($a))'
                    class="bg-blue-500 text-white px-3 py-1 rounded">
                    Edit
                </button>

                {{-- DELETE --}}
                <form method="POST" action="/admin/announcements/{{ $a->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>
</div>
<!-- EDIT MODAL -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white w-1/2 p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Edit Pengumuman</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="judul" id="editJudul"
                class="w-full border p-2 mb-2 rounded">

            <textarea name="isi" id="editIsi"
                class="w-full border p-2 mb-2 rounded"></textarea>

            <div class="flex justify-end gap-2 mt-4">

                <button type="button" onclick="closeModal()"
                    class="bg-gray-400 text-white px-4 py-2 rounded">
                    Cancel
                </button>

                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Update
                </button>

            </div>

        </form>
    </div>
</div>
<script>
function openEditModal(data) {
    document.getElementById('editModal').classList.remove('hidden');

    document.getElementById('editJudul').value = data.judul;
    document.getElementById('editIsi').value = data.isi;

    document.getElementById('editForm').action = `/admin/announcements/${data.id}`;
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection