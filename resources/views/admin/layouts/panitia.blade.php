<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panitia PPDB</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-slate-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-indigo-700 text-white p-6">
        <h1 class="text-2xl font-bold mb-8">
            Panitia PPDB
        </h1>

        <nav class="space-y-3">
            <a href="/panitia/dashboard"
               class="block px-4 py-3 rounded hover:bg-indigo-600">
                Dashboard
            </a>

            <a href="/panitia/registrations"
               class="block px-4 py-3 rounded hover:bg-indigo-600">
                Daftar Pendaftar
            </a>

            <form action="/logout" method="POST">
                @csrf
                <button
                    class="w-full text-left px-4 py-3 rounded bg-red-500 hover:bg-red-600">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Content --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>