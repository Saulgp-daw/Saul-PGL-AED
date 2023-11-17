<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <div class="h5" style="position: absolute; top: 10px; right: 10px;">{{ $mensaje ?? "" }}</div>
    <h3>Registro</h3>
    <form action="/registro" method="post">
        @csrf
        <label for="nickname">Nickname: </label><input type="text" name="nickname"><br>
        <label for="email">Email: </label><input type="text" name="email"><br>
        <label for="password">Contraseña: </label><input type="text" name="password"><br>
        <input type="submit" value="Registrarse"><a href="/loginForm">Login</a>
    </form>
    <br>
    @include('compartido')
</body>
</html>
