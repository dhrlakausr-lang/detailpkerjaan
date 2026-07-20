<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - LokerInAja</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="relative min-h-screen overflow-x-hidden bg-[url('/images/background.png')] bg-center bg-cover text-white">

<div class="absolute top-[20px] left-[20px] h-[160px] w-[160px] bg-[url('/images/logolokerinaja.png')] bg-center bg-no-repeat bg-contain pointer-events-none max-[520px]:h-[100px] max-[520px]:w-[100px]"></div>

<div class="min-h-screen flex items-center justify-center px-[20px] py-[40px]">
    <div class="w-[450px] max-w-full rounded-[20px] bg-white/15 p-[35px] text-center text-white shadow-[0_0_20px_rgba(0,0,0,0.2)] backdrop-blur-[10px] max-[520px]:p-6">
        <h1 class="mb-2 text-[32px] font-bold text-white max-[520px]:text-[28px]">Forgot Password</h1>
        <p class="mb-6 text-sm text-white/80">Masukkan email akun pelamar untuk menerima kode OTP reset password.</p>

        <?php if(session('success')): ?>
            <p class="mb-4 rounded-xl bg-green-500/20 px-4 py-3 text-sm font-semibold text-[#90ee90]"><?php echo e(session('success')); ?></p>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <p class="mb-4 rounded-xl bg-red-500/20 px-4 py-3 text-sm font-semibold text-white"><?php echo e(session('error')); ?></p>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <p class="mb-4 rounded-xl bg-red-500/20 px-4 py-3 text-sm font-semibold text-white"><?php echo e($errors->first()); ?></p>
        <?php endif; ?>

        <form action="<?php echo e(route('password.email')); ?>" method="POST" class="flex flex-col gap-[18px]">
            <?php echo csrf_field(); ?>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email" required class="w-full rounded-[12px] bg-white px-[18px] py-[16px] text-[15px] text-black outline-none">

            <button class="w-full rounded-[30px] bg-[#2cc2d6] px-[14px] py-[14px] text-[16px] font-bold text-white transition duration-300 ease-in-out hover:scale-[1.03] hover:bg-[#239aa5]" type="submit">Kirim Kode OTP</button>
        </form>

        <p class="mt-5 text-sm text-white">
            Ingat password?
            <a class="font-bold text-[#2cc2d6] hover:underline" href="<?php echo e(route('login')); ?>">Login</a>
        </p>
    </div>
</div>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/detail.pkerjaan.dara/resources/views/forgot-password.blade.php ENDPATH**/ ?>