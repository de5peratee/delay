// window.onload = function() {
//     document.querySelector('input[type="submit"]').addEventListener('click', function(e) {
//         e.preventDefault();
//
//         var isValid = true;
//
//         var login = document.getElementById('login');
//         var loginError = document.getElementById('loginError');
//         loginError.textContent = '';
//
//         if (login.value.length === 0) {
//             loginError.textContent += 'Введите логин. ';
//             isValid = false;
//         }
//
//         if (login.value.length < 5 && login.value.length > 0) {
//             loginError.textContent += 'Логин должен содержать не менее 5 символов. ';
//             isValid = false;
//         }
//
//         var password = document.getElementById('password');
//         var passwordError = document.getElementById('passwordError');
//         passwordError.textContent = '';
//         isValid = true;
//
//         if (password.value.length === 0 && isValid===true) {
//             passwordError.textContent = 'Введите пароль. ';
//             isValid = false;
//         }
//
//         if (password.value.length < 8 && password.value.length > 0 && isValid===true) {
//             passwordError.textContent = 'Пароль должен содержать не менее 8 символов. ';
//             isValid = false;
//         }
//
//         var hasNumber = /\d/;
//         var hasLetter = /[a-zA-Z]/;
//         if ((!hasNumber.test(password.value) || !hasLetter.test(password.value)) && isValid===true) {
//             passwordError.textContent = 'Пароль должен содержать минимум одну цифру и букву. ';
//             isValid = false;
//         }
//
//         var confirmPassword = document.getElementById('confirmPassword');
//         var confirmPasswordError = document.getElementById('confirmPasswordError');
//         isValid = true;
//
//         if (passwordError.textContent==='' && password.value!==confirmPassword.value) {
//             confirmPasswordError.textContent = 'Пароли не совпадают.';
//             isValid = false;
//         }
//
//         if (isValid) {
//             this.form.submit();
//         }
//     });
// }
