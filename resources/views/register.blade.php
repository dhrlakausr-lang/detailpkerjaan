<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    @vite('resources/css/app.css')

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="relative min-h-screen overflow-x-hidden bg-[url('/images/background.png')] bg-center bg-cover text-white">

<div class="absolute top-[20px] left-[20px] w-[160px] h-[160px] bg-[url('/images/logolokerinaja.png')] bg-center bg-no-repeat bg-contain pointer-events-none"></div>

<div class="right min-h-screen flex items-center justify-center px-[20px] py-[40px]">
    <div class="login-box w-[470px] max-w-full rounded-[22px] bg-white/15 backdrop-blur-[10px] shadow-[0_0_25px_rgba(0,0,0,0.2)] pt-[45px] pb-[45px] px-[40px] flex flex-col gap-[22px] text-center">

        <h1 class="text-[32px] text-white">Registrasi</h1>

        <!-- PESAN -->
        @if(session('error'))
            <p class="text-white text-center">{{ session('error') }}</p>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="w-full flex flex-col gap-[18px]">
            @csrf

            <!-- NAMA -->
            <div class="input-box relative w-full">
                <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] outline-none">
            </div>

            <!-- USERNAME -->
            <div class="input-box relative w-full">
                <input type="text" name="username" placeholder="Username" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] outline-none">
            </div>

            <!-- EMAIL -->
            <div class="input-box relative w-full">
                <input type="email" name="email" placeholder="Email" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] outline-none">
            </div>

            <!-- JENIS LAMARAN -->
            <div class="input-box relative w-full">
                <input type="text" name="jenis_lamaran" placeholder="Jenis lamaran yang diminati, contoh: Backend Developer" class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] outline-none">
            </div>

            <!-- PASSWORD -->
            <div class="input-box relative w-full">
                <input type="password" id="password" name="password" placeholder="Password" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] pr-[50px] outline-none">
                <i class="fa-solid fa-eye-slash absolute right-[18px] top-1/2 -translate-y-1/2 text-[#555] text-[18px] cursor-pointer transition duration-300 ease-in-out hover:text-black" id="togglePassword"></i>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="input-box relative w-full">
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[20px] py-[18px] pr-[50px] outline-none">
                <i class="fa-solid fa-eye-slash absolute right-[18px] top-1/2 -translate-y-1/2 text-[#555] text-[18px] cursor-pointer transition duration-300 ease-in-out hover:text-black" id="toggleConfirmPassword"></i>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn w-full rounded-[30px] bg-[#2cc2d6] px-[16px] py-[16px] text-[16px] font-bold text-white transition duration-300 ease-in-out hover:bg-[#239aa5] hover:scale-[1.03]">
                Daftar
            </button>

        </form>

        <p class="register-text text-white text-[14px]">Sudah punya akun? <a class="text-[#2cc2d6] font-bold hover:underline" href="{{ url('/login') }}">Login Disini</a></p>

    </div>
</div>

<!-- JS -->
<script src="{{ asset('js/regis.js') }}"></script>

</body>
</html>
