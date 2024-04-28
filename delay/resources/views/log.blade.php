<!DOCTYPE html>
<html lang="RU">
<head>
    <title>delay</title>
    <meta charset="UTF-8">
    @vite(['resources/css/log.css'])
    @vite(['resources/js/eyeCheckerLog.js'])
    <script src="https://kit.fontawesome.com/e3b4feb7cf.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="containerReg">
    <div class="reg">
        Вход
    </div>
    <form action="/login/check" method="post">
        @csrf
        <div class="input-box">
            <input type="text" name="login" id="login" placeholder="Логин" title="Логин - это уникальное имя, от которого публикуются ваши треки" required>
            <span class="error" id="loginError">
                @if ($errors->has('login'))
                    {{ $errors->first('login') }}
                @endif
            </span>

        </div>

        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Пароль" title="Пароль - секретный набор символов, который защищает вашу учетную запись" required>
            <span class="error" id="passwordError" >
                @if ($errors->has('password'))
                    {{ $errors->first('password') }}
                @endif
            </span>
            <div class="i1 fa-solid fa-eye Eyecon"></div>
        </div>

        <div class="button">
            <input type="submit" value="Войти">
        </div>

    </form>

    <div class="text">
        <h3><a href="/registration">Зарегистрироваться</a></h3>
    </div>

    <div class="text">
        <h3><a href="/new">Войти как гость</a></h3>
    </div>

</div>

</div>
<div class="logo">
    delay
</div>
</body>
</html>
