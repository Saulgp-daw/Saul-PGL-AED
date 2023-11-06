<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Asignaturas</title>
</head>
<body>
    <h3>Gestión Asignaturas</h3>
    <p>{!! $mensaje ?? '' !!}</p>
    <div class="contenedorForms">
        <div class="form">
            <form action="/agregar_asignatura" method="post">
                @csrf
                <label for="nombre">* Nombre: </label><input type="text" name="nombre" required><br>
                <label for="curso">* Curso: </label><input type="text" name="curso" required><br>
                <button type="submit">Crear</button>
            </form>
        </div>
    </div>
    @isset($asignaturas)
        @foreach ($asignaturas as $asignatura)
        <div>
            <span>Id: {{ $asignatura->id }} - </span>
            <span>Nombre: {{ $asignatura->nombre }} - </span>
            <span>Curso: {{ $asignatura->curso }} </span>
        </div>
        <br>
        @endforeach
    @endisset
</body>
</html>
