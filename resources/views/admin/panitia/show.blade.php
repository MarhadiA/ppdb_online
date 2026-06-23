@extends('layouts.admin')

@section('content')
@foreach($registration->documents as $doc)
    <div class="bg-white p-4 rounded shadow mb-4">
        <p>{{ $doc->jenis_dokumen }}</p>

        <a href="{{ $doc->cloudinary_url }}" target="_blank">
            Lihat File
        </a>

        <p>Status: {{ $doc->status_verifikasi }}</p>

        @if($doc->status_verifikasi != 'disetujui')

            <form method="POST" action="/panitia/document/{{ $doc->id }}/approve">
                @csrf
                <button>Approve</button>
            </form>

            <form method="POST" action="/panitia/document/{{ $doc->id }}/reject">
                @csrf
                <textarea name="catatan" required></textarea>
                <button>Reject</button>
            </form>

        @endif
    </div>
@endforeach
@endsection