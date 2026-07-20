<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - LokerInAja</title>
    @vite('resources/css/app.css')
</head>
<body class="relative min-h-screen overflow-x-hidden bg-[url('/images/background.png')] bg-center bg-cover text-white">

<div class="absolute top-[20px] left-[20px] h-[160px] w-[160px] bg-[url('/images/logolokerinaja.png')] bg-center bg-no-repeat bg-contain pointer-events-none max-[520px]:h-[100px] max-[520px]:w-[100px]"></div>

<div class="min-h-screen flex items-center justify-center px-[20px] py-[40px]">
    <div class="w-[450px] max-w-full rounded-[20px] bg-white/15 p-[35px] text-center text-white shadow-[0_0_20px_rgba(0,0,0,0.2)] backdrop-blur-[10px] max-[520px]:p-6">
        <h1 class="mb-2 text-[32px] font-bold text-white max-[520px]:text-[28px]">Verifikasi OTP</h1>
        <p class="mb-6 text-sm text-white/80">
            Masukkan kode OTP yang dikirim ke <strong>{{ $email }}</strong> lalu buat password baru.
        </p>

        @if(session('success'))
            <p class="mb-4 rounded-xl bg-green-500/20 px-4 py-3 text-sm font-semibold text-[#90ee90]">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="mb-4 rounded-xl bg-red-500/20 px-4 py-3 text-sm font-semibold text-white">{{ session('error') }}</p>
        @endif

        @if($errors->any())
            <p class="mb-4 rounded-xl bg-red-500/20 px-4 py-3 text-sm font-semibold text-white">{{ $errors->first() }}</p>
        @endif

        <form action="{{ session('otp_verified_email') ? route('password.update') : route('password.verify-otp') }}" method="POST" class="flex flex-col gap-[18px]">
            @csrf

            <input type="text" name="otp" inputmode="numeric" maxlength="6" placeholder="Kode OTP (6 digit)" required
                   class="w-full rounded-[12px] bg-white px-[18px] py-[16px] text-center text-[20px] font-bold tracking-[8px] text-black outline-none" {{ session('otp_verified_email') ? 'disabled' : '' }}>

            @if(session('otp_verified_email'))
                <input type="password" name="password" placeholder="Password Baru" required
                       class="w-full rounded-[12px] bg-white px-[18px] py-[16px] text-[15px] text-black outline-none">

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required
                       class="w-full rounded-[12px] bg-white px-[18px] py-[16px] text-[15px] text-black outline-none">

                <button class="w-full rounded-[30px] bg-[#2cc2d6] px-[14px] py-[14px] text-[16px] font-bold text-white transition duration-300 ease-in-out hover:scale-[1.03] hover:bg-[#239aa5]" type="submit">Ubah Password</button>
            @else
                <button class="w-full rounded-[30px] bg-[#2cc2d6] px-[14px] py-[14px] text-[16px] font-bold text-white transition duration-300 ease-in-out hover:scale-[1.03] hover:bg-[#239aa5]" type="submit">Verifikasi OTP</button>
            @endif
        </form>


        <p class="mt-5 text-sm text-white">
            Tidak menerima kode?
            <a class="font-bold text-[#2cc2d6] hover:underline" href="{{ route('password.request') }}">Kirim ulang</a>
        </p>

        <p class="mt-2 text-sm text-white">
            Kembali ke
            <a class="font-bold text-[#2cc2d6] hover:underline" href="{{ route('login') }}">Login</a>
        </p>
    </div>
</div>

</body>
</html>
