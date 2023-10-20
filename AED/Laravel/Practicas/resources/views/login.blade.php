<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/Adicional/LoginRegistro.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="carta">
        <h3>Página de Login</h3>
        <form action="login" method="post">
            <div class="contenedor">
                <div class="alinearDerecha"><label for="nombreUsuario">Nombre de usuario:</label></div>
                <div><input type="text" name="nombreUsuario"></div>
                <div class="alinearDerecha"><label for="contrasenha">Contraseña:</label></div>
                <div><input type="password" name="contrasenha" id="contrasenha"></div>
                <div class="alinearDerecha"><input type="submit" value="Login" class="btnSubmit"></div>
                <div class="enlace"><a href="redirigirRegistro" >Registro</a></div>
            </div>
        </form>
        <p class="mensaje">{{$mensaje ?? ""}}</p>
    </div>
</body>
</html>
