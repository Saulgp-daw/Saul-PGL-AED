<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h3>Registro</h3>
    <form action="registro" method="post">
        @csrf
        <label for="nombre">* Nombre: </label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="contrasenha">* Contraseña: </label>
        <input type="password" name="contrasenha" id="contrasenha" required><br>
        <label for="telefono">* Teléfono: </label>
        <input type="number" name="telefono" id="telefono" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>