<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Práctica 15</title>
</head>
<body>
    <h3>Práctica 15</h3>
    <form action="procesar" method="post">
        <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre"><br>
        <label for="edad">Edad: </label><input type="number" name="edad" id="edad"><br>
        <label for="gustos">Tus gustos: </label><input type="text" name="gustos" id="gustos"><br>
        <input type="submit" value="Enviar">
    </form>

    @if (session()->get("nombre"))
        <h5>Nombre: {{session()->get("nombre")}}</h5>
    @endif
    @if (session()->get("edad"))
        <h5>Edad: {{session()->get("edad")}}</h5>
    @endif
    @if (session()->get("gustos"))
        <h5>Gustos: {{session()->get("gustos")}}</h5>
    @endif
</body>
</html>