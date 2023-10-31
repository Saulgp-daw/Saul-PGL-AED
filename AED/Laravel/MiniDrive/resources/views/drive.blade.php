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
    <h3 id="colorful-text">Poorgle Drive</h3>


    {{-- Verificar si el objeto Usuario existe --}}
    @if (isset($usuario))
        <h1>Bienvenido, {{ $usuario }}</h1>
    @else
        <h1>Bienvenido, Invitado</h1>
    @endif
    <div class="h5" style="position: absolute; top: 50px; right: 10px;">{{ $mensaje ?? '' }}</div>
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
        @isset($carpetas)
            @foreach ($carpetas as $carpeta)
                <div class="cell">
                    <a href="#">{{ $carpeta }}</span>
                </div>
            @endforeach
        @endisset

    </div>
    <script>
        const text = document.getElementById("colorful-text").textContent;
        const colorfulText = document.getElementById("colorful-text");

        // Lista de colores
        const colors = ['#4285f4', '#0f9d58', '#f4b400', '#db4437', '#ff6d00', '#46bdc6'];

        // Divide el texto en caracteres y aplica colores
        colorfulText.innerHTML = text
            .split('')
            .map((char, index) => {
                const color = colors[index % colors.length];
                return `<span style="color: ${color}">${char}</span>`;
            })
            .join('');
    </script>
</body>


</html>
