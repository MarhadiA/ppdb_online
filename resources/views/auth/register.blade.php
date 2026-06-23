<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PPDB Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-white to-emerald-50">

    {{-- CARD --}}
    <div class="w-full max-w-4xl grid md:grid-cols-2 bg-white shadow-2xl rounded-3xl overflow-hidden">

        {{-- LEFT SIDE --}}
        <div class="hidden md:flex flex-col justify-center p-10 bg-gradient-to-br from-green-600 to-emerald-700 text-white">
            <h1 class="text-3xl font-bold">Buat Akun 🚀</h1>
            <p class="mt-3 text-green-100">
                Daftar untuk mengikuti PPDB Online sekolah.
            </p>

            <div class="mt-8 space-y-2 text-sm text-green-100">
                <p>✔ Gratis Pendaftaran</p>
                <p>✔ Upload Dokumen Online</p>
                <p>✔ Tracking Status Real-time</p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="p-10">

            <h2 class="text-2xl font-bold text-slate-800">Register</h2>
            <p class="text-sm text-slate-500 mb-6">Buat akun baru untuk melanjutkan</p>

            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm">Nama Lengkap</label>
                    <input type="text" name="name"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 outline-none"
                        placeholder="Nama kamu">
                </div>

                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 outline-none"
                        placeholder="you@email.com">
                </div>

                <div>
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-green-500 outline-none"
                        placeholder="••••••••">
                </div>

                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                    Register
                </button>
            </form>

            <p class="text-center text-sm mt-6 text-slate-500">
                Sudah punya akun?
                <a href="/login" class="text-green-600 font-semibold hover:underline">Login</a>
            </p>

        </div>

    </div>

</body>
</html>