<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div>
        <h3>Página de Login</h3>

        <form action="login" method="post">
            <label for="nombreUsuario">Nombre de usuario: </label><input type="text" name="nombreUsuario"><br>
            <label for="contrasenha">Contraseña:</label><input type="password" name="contrasenha" id="contrasenha"><br>
            <input type="submit" value="Login">
        </form>
        <p>{{$mensaje}}</p>
    </div>
</body>
</html>
