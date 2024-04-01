window.onload = function() {
    document.querySelector('input[type="submit"]').addEventListener('click', function(e) {
        e.preventDefault();

        var isValid = true;

        var login = document.getElementById('login');
        var loginError = document.getElementById('loginError');
        loginError.textContent = '';

        if (login.value.length === 0) {
            loginError.textContent += 'Введите логин. ';
            isValid = false;
        }

        var password = document.getElementById('password');
        var passwordError = document.getElementById('passwordError');
        passwordError.textContent = '';
        isValid = true;

        if (password.value.length === 0 && isValid===true) {
            passwordError.textContent = 'Введите пароль. ';
            isValid = false;
        }


        if (isValid) {
            this.form.submit();
        }
    });
}
