<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Mini Drive</title>
</head>

<body>
    <h3>Poorgle Drive</h3>

    {{-- Verificar si el objeto Usuario existe --}}
    @if (isset($usuario))
        <h1>Bienvenido, {{ $usuario }}</h1>
    @else
        <h1>Bienvenido, Invitado</h1>
    @endif
    <div class="h5" style="position: absolute; top: 50px; right: 10px;">{{ $mensaje ?? "" }}</div>
    <div class="h5" style="position: absolute; top: 10px; right: 10px;"><a href="/logout">Logout</a></div>
    <div class="container">
        <form action="/subir" enctype='multipart/form-data' method="post">
            @csrf
            <input type="file" name="archivo" id="archivo">
            <button type="submit">Subir archivo</button>
            <!--Preguntar por qué no funciona el input type submit aquí pero button sí-->
        </form>

        @foreach ($ficheros as $fichero)
            <div class="cell">
                <a href="/descargar/{{ basename($fichero) }}">{{ basename($fichero) }}</a> <a
                    href="/borrar/{{ basename($fichero) }}">Borrar</a>
            </div>
        @endforeach
    </div>

</body>

</html>
