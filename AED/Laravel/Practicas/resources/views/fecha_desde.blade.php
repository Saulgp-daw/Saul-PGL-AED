<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fecha desde 1970</title>
</head>

<body>
    <h4>Fecha desde 1970</h4>

    @for($i = 0; $i < 3; $i++)
        <p>Desde el 1-01-1970 han pasado: {{ $dato = time()}} segundos</p>

        @php
            sleep(1);
        @endphp
    @endfor



</body>

</html>
