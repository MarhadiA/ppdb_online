<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-indigo-50">

    {{-- CARD --}}
    <div class="w-full max-w-4xl grid md:grid-cols-2 bg-white shadow-2xl rounded-3xl overflow-hidden">

        {{-- LEFT SIDE --}}
        <div class="hidden md:flex flex-col justify-center p-10 bg-gradient-to-br from-blue-600 to-indigo-700 text-white">
            <h1 class="text-3xl font-bold">Selamat Datang </h1>
            <p class="mt-3 text-blue-100">
                Login untuk melanjutkan pendaftaran PPDB Online.
            </p>

            <div class="mt-8 space-y-2 text-sm text-blue-100">
                <p>✔ Pendaftaran Online</p>
                <p>✔ Upload Dokumen</p>
                <p>✔ Verifikasi Panitia</p>
                <p>✔ Pengumuman Otomatis</p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="p-10">

            <h2 class="text-2xl font-bold text-slate-800">Login Akun</h2>
            <p class="text-sm text-slate-500 mb-6">Masukkan email dan password kamu</p>

            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="you@email.com">
                </div>

                <div>
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="••••••••">
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                    Login
                </button>
            </form>

            <p class="text-center text-sm mt-6 text-slate-500">
                Belum punya akun?
                <a href="/register" class="text-blue-600 font-semibold hover:underline">Daftar</a>
            </p>

        </div>

    </div>

</body>
</html>