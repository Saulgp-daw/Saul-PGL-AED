<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/Adicional/galeria.css') }}">
    <title>Práctica 12</title>
</head>

<body>
    <h3>Práctica 12 - imágenes</h3>
    <p>Práctica 14: {{ csrf_token() }}</p>
    <div class="galeria">
        
        @foreach ($imagenesHubble as $imagen)
            <div class="cuadricula"><img src={{ $imagen }} alt={{ $imagen }}></div>
        @endforeach
    </div>
</body>

</html>
