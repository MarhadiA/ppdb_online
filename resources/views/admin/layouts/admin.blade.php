<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin PPDB</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-700 text-white p-6">

        <h1 class="text-2xl font-bold mb-8">
            PPDB Admin
        </h1>

        <nav class="space-y-3">

            <a href="/admin/dashboard" class="block p-2 rounded hover:bg-blue-600">
                Dashboard
            </a>

            <a href="/admin/panitia" class="block p-2 rounded hover:bg-blue-600">
                Manajemen Panitia
            </a>
               <a href="/admin/jalur" class="block p-2 hover:bg-blue-600 rounded">
                Jalur Pendaftaran
            </a>

            <a href="/admin/seleksi" class="block p-2 rounded hover:bg-blue-600">
                Proses Seleksi
            </a>

            <a href="/admin/announcements" class="block p-2 rounded hover:bg-blue-600">
                Pengumuman
            </a>

            <a href="/admin/export/seleksi" class="block p-2 rounded hover:bg-blue-600">
                Laporan
            </a>

        </nav>

        {{-- LOGOUT --}}
        <form method="POST" action="/logout" class="mt-10">
            @csrf
            <button class="w-full bg-red-500 py-2 rounded">
                Logout
            </button>
        </form>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>