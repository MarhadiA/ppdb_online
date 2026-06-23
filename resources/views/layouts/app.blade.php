<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Online</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-100 text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            {{-- LOGO --}}
            <a href="/" class="text-xl font-bold text-blue-600">
                PPDB Online
            </a>

            {{-- MENU --}}
            <div class="flex items-center gap-6">

                <a href="/" class="hover:text-blue-600">Home</a>

                @auth
                    <a href="{{ url('/student/dashboard') }}" class="hover:text-blue-600">
                        Dashboard
                    </a>

                    {{-- USER NAME --}}
                    <span class="text-sm text-gray-500">
                        {{ auth()->user()->name }}
                    </span>

                    {{-- LOGOUT --}}
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            Logout
                        </button>
                    </form>

                @else
                    <a href="/login" class="hover:text-blue-600">Login</a>
                    <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Register
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center text-gray-500 text-sm">
            © {{ date('Y') }} PPDB Online. All rights reserved.
        </div>
    </footer>

</body>
</html>