<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar Archivos</title>
</head>
<body>
    <h3>Práctica 19 - Listar archivos y descargar al hacer click</h3>

    @foreach ($ficheros as $fichero)
        <p><a href="/descargar/{{ basename($fichero) }}">{{ basename($fichero) }}</a></p> <!--basename()-->
    @endforeach
</body>
</html>
