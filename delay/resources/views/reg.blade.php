<!DOCTYPE html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/reg.css'])
{{--    @vite(['resources/js/regValidation.js'])--}}
</head>
<body>
<div class="containerReg">
    <div class="reg">
        Регистрация
    </div>
    <form action="/new" method="post">
        @csrf
        <div class="input-box">
            <input type="text" id="login" name="login" placeholder="Логин" title="Логин - это уникальное имя, от которого публикуются ваши треки" required>
            <span class="error" id="loginError">
            @if ($errors->has('login'))
                    {{ $errors->first('login') }}
                @endif
        </span>
        </div>

        <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Пароль" title="Пароль - секретный набор символов, который защищает вашу учетную запись" required>
            <span class="error" id="passwordError">
            @if ($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
        </span>
        </div>

        <div class="input-box">
            <input type="password" id="password_confirmation"  name="password_confirmation" placeholder="Повторите пароль" required>
            <span class="error" id="confirmPasswordError">
            @if ($errors->has('password_confirmation'))
                    {{ $errors->first('password_confirmation') }}
                @endif
        </span>
        </div>
        <div class="button">
            <input type="submit" value="Зарегистрироваться">
        </div>

        <div class="text">
            <h3><a href="/login">Уже есть аккаунт</a></h3>
    </div>
    </form>

</div>

</div>
<div class="logo">
    delay
</div>
</body>
</html>
