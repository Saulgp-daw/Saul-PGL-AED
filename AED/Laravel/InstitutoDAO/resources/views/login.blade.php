<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div class="h5" style="position: absolute; top: 10px; right: 10px;">{{ $mensaje ?? "" }}</div>
    <h3>Login</h3>
    <form action="login" method="post">
        @csrf
        <label for="nickname">Nickname: </label><input type="text" name="nickname"><br>
        <label for="password">Contraseña: </label><input type="text" name="password"><br>
        <input type="submit" value="Entrar"><a href="/">Registro</a>
    </form>
</body>
</html>
