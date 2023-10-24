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
    <div class="container">
        @foreach ($ficheros as $fichero)
            <div class="cell">
                <a href="/descargar/{{ basename($fichero) }}">{{ basename($fichero) }}</a> <a href="/borrar/{{ basename($fichero) }}">Borrar</a>
            </div>
        @endforeach
    </div>

</body>
</html>
