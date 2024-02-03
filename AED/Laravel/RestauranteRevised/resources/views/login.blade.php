<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>
   <div class="h5" style="position: absolute; top: 10px; right: 10px;">{{ $mensaje ?? "" }}</div>
    <form action="login" method="post">
        @csrf
        <label for="telefono">* Teléfono: </label>
        <input type="number" name="telefono" id="telefono" required><br>
        <label for="contrasenha">* Contraseña: </label>
        <input type="password" name="contrasenha" id="contrasenha" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
