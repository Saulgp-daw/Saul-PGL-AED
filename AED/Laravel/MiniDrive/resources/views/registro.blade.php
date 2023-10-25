<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <h3>Registro</h3>
    <form action="registro" method="post">
        @csrf
        <label for="nickname">Nickname: </label><input type="text" name="nickname"><br>
        <label for="email">Email: </label><input type="text" name="email"><br>
        <label for="password">Contraseña: </label><input type="text" name="password"><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
