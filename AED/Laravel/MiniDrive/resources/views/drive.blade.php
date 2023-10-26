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
    @php
        $usuario = session()->get("usuario");
    @endphp

    {{-- Verificar si el objeto Usuario existe --}}
    @isset($usuario)
    <h1>Bienvenido, {{ $usuario->getNickname() }}</h1>
    @endisset
    @isset ($usuario)

    @else
        <h1>Bienvenido, Invitado</h1>
    @endif
    <div class="container">
        @foreach ($ficheros as $fichero)
            <div class="cell">
                <a href="/descargar/{{ basename($fichero) }}">{{ basename($fichero) }}</a> <a
                    href="/borrar/{{ basename($fichero) }}">Borrar</a>
            </div>
        @endforeach
    </div>

</body>

</html>
