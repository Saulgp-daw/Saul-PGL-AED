<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Asignaturas</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/formularios.css') }}">
</head>

<body>

    <div>
        <a href="/home"><h2>Gestionar Instituto</h2></a>
    </div>
    <div class="logout"><a href="/logout">Logout</a></div>
    <h3>Gestión Asignaturas</h3>
    <p>{!! $mensaje ?? '' !!}</p>
    <div class="contenedorForms">
        <div class="form">
            <h4>Agregar asignatura</h4>
            <form action="/agregar_asignatura" method="post">
                @csrf
                <label for="nombre">* Nombre: </label><input type="text" name="nombre" required><br>
                <label for="curso">* Curso: </label><input type="text" name="curso" required><br>
                <button type="submit">Crear</button>
            </form>
        </div>
        <div class="form">
            <h4>Borrar asignatura</h4>
            <form action="/borrar_asignatura" method="post">
                @csrf
                <label for="id">* Selecciona: </label>
                <select name="id">
                    @isset($asignaturas)
                        @foreach ($asignaturas as $asignatura)
                            <option value={{ $asignatura->id }}>{{ $asignatura->nombre . ' ' . $asignatura->curso }}
                            </option>
                        @endforeach
                    @endisset
                </select>

                <button type="submit">Borrar</button>
            </form>
        </div>
        <div class="form">
            <h4>Editar asignatura</h4>
            <form action="/editar_asignatura" method="post">
                @csrf
                <label for="id">* Selecciona: </label>
                <select name="id">
                    @isset($asignaturas)
                        @foreach ($asignaturas as $asignatura)
                            <option value={{ $asignatura->id }}>{{ $asignatura->nombre . ' ' . $asignatura->curso }}
                            </option>
                        @endforeach
                    @endisset
                </select><br>
                <label for="nombre">* Nombre: </label><input type="text" name="nombre" required><br>
                <label for="curso">* Curso: </label><input type="text" name="curso" required><br>

                <button type="submit">Editar</button>
            </form>
        </div>
        <div class="form">
            <h4>Buscar asignatura</h4>
            <form action="/buscar_asignatura" method="post">
                @csrf
                <label for="curso">* Buscar por curso: </label>
                <select name="curso">
                    @isset($asignaturasUnicas)
                        @foreach ($asignaturasUnicas as $asignatura)
                            <option value="{{ $asignatura }}">{{ $asignatura }}</option>
                        @endforeach
                    @endisset
                </select><br>
                <button type="submit">Buscar</button>
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
