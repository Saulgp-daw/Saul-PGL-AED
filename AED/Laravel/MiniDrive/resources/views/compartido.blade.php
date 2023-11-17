<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Mini Drive</title>
    <style>
        h3 {
            font-size: 45px;
            /* Tamaño de fuente */
            font-weight: bold;
            /* Texto en negrita */

            text-align: center;
        }
    </style>
</head>

<body>
    <h5>Carpeta compartida</h5>
    <div class="container">
        @if (isset($usuario))
        <form action="/subirCompartida" enctype='multipart/form-data' method="post">
            @csrf
            <input type="file" name="archivo" id="archivo">
            <button type="submit">Subir archivo</button>
            <!--Preguntar por qué no funciona el input type submit aquí pero button sí-->
        </form>
        @endif
        @foreach ($compartidos as $compartido)
            <div class="cell">
                <a href="/descargar/zonacompartida/{{ basename($compartido) }}">{{ basename($compartido) }}</a>
                @if (isset($usuario) && $usuario == "admin")
                    <a href="/borrarCompartido/{{ basename($compartido) }}">Borrar</a>
                @endif

            </div>
        @endforeach
        @isset($carpetas)
            @foreach ($carpetas as $carpeta)
                <div class="cell">
                    <a href="#">{{ $carpeta }}</span>
                </div>
            @endforeach
        @endisset

    </div>

</body>


</html>
