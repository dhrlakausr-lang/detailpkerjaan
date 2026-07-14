const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const confirmPassword = document.getElementById("confirmPassword");

togglePassword.addEventListener("click", function () {

    if (password.type === "password") {

        password.type = "text";

        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");

    } else {

        password.type = "password";

        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    }

});

toggleConfirmPassword.addEventListener("click", function () {

    if (confirmPassword.type === "password") {

        confirmPassword.type = "text";

        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");

    } else {

        confirmPassword.type = "password";

        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    }

});