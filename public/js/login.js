const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

togglePassword.addEventListener('click', function () {

    if (password.type === 'password') {
        password.type = 'text';

        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');

    } else {
        password.type = 'password';

        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    }

});