<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="relative min-h-screen overflow-x-hidden bg-[url('/images/background.png')] bg-center bg-cover text-white">

<div class="absolute top-[20px] left-[20px] w-[160px] h-[160px] bg-[url('/images/logolokerinaja.png')] bg-center bg-no-repeat bg-contain pointer-events-none"></div>

<div class="right min-h-screen flex items-center justify-center px-[20px] py-[40px]">
    <div class="login-box w-[450px] max-w-full rounded-[20px] bg-white/15 backdrop-blur-[10px] shadow-[0_0_20px_rgba(0,0,0,0.2)] p-[35px] flex flex-col gap-[18px] text-center">

        <h1 class="text-[32px] text-white mb-[5px]">Login</h1>

        <!-- PESAN LOGIN -->
        <?php if(session('success')): ?>
            <p class="text-[#90ee90] text-center"><?php echo e(session('success')); ?></p>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <p class="text-white text-center"><?php echo e(session('error')); ?></p>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form action="<?php echo e(url('/login')); ?>" method="POST" class="flex flex-col gap-[18px] mt-[10px]">
            <?php echo csrf_field(); ?>

            <div class="input-box relative w-full">
                <input type="email" name="email" placeholder="Email" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[18px] py-[16px] outline-none">
            </div>

            <div class="input-box relative w-full">
                <input type="password" id="password" name="password" placeholder="Password" required class="w-full rounded-[12px] bg-white text-black text-[15px] px-[18px] py-[16px] outline-none">
                <i class="fa-solid fa-eye-slash absolute right-[15px] top-1/2 -translate-y-1/2 text-[#555] text-[16px] cursor-pointer" id="togglePassword"></i>
            </div>

            <div class="-mt-2 text-right">
                <a class="text-sm font-bold text-[#2cc2d6] hover:underline" href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
            </div>

            <button class="btn w-full rounded-[30px] bg-[#2cc2d6] px-[14px] py-[14px] text-[16px] font-bold text-white transition duration-300 ease-in-out hover:bg-[#239aa5] hover:scale-[1.03]" type="submit">Login</button>
        </form>

        <p class="register-text text-white text-[14px]">Belum punya akun? <a class="text-[#2cc2d6] font-bold hover:underline" href="<?php echo e(url('/register')); ?>">Registrasi Disini</a></p>

    </div>
</div>

<script src="<?php echo e(asset('js/login.js')); ?>"></script>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/detail.pkerjaan.dara/resources/views/login.blade.php ENDPATH**/ ?>