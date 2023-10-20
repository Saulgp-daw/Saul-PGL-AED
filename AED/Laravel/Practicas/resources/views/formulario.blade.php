<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario sesión</title>
    <style>
        body{
            background: {{$colorFavorito}}
        }
    </style>
</head>
<body>
    <form action="/agregarColor" method="get">
        <label for="nuevoColor">Añada un nuevo color: </label><input type="text" name="color">
        <input type="submit" value="Enviar">
    </form>


    @foreach (session()->get("colores") as $color)
        <span>{{$color}}, </span>
    @endforeach
</body>
</html>
