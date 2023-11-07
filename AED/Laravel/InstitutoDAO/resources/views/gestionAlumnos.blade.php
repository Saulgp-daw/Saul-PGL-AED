<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Alumnos</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/formularios.css') }}">
</head>

<body>
    <div>
        <a href="/home"><h2>Gestionar Instituto</h2></a>
    </div>
    <div class="logout"><a href="/logout">Logout</a></div>
    <h3>Gestión alumnos</h3>
    <p>{!! $mensaje ?? '' !!}</p>
    <div class="contenedorForms">
        <div class="form">
            <h4>Agregar Alumno</h4>
            <form action="/agregar_alumno" method="post">
                @csrf
                <label for="dni">* DNI: </label><input type="text" name="dni" required><br>
                <label for="nombre">* Nombre: </label><input type="text" name="nombre" required><br>
                <label for="apellidos">Apellidos: </label><input type="text" name="apellidos"><br>
                <label for="fechanacimiento">Fecha nacimiento: </label><input type="date" name="fechanacimiento">
                <button type="submit">Agregar</button>
            </form>
        </div>
        <div class="form">
            <h4>Borrar Alumno</h4>
            <form action="/borrar_alumno" method="post">
                @csrf
                <label for="dni">Elija: </label>
                <select name="dni">
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            <option value={{ $alumno->dni }}>{{ $alumno->nombre . ' ' . $alumno->dni }}</option>
                        @endforeach
                    @endisset
                </select>
                <button type="submit">Borrar</button>
            </form>
        </div>
        <div class="form">
            <h4>Actualizar alumno</h4>
            <form action="/actualizar_alumno" method="post">
                @csrf
                <label for="dni">* Alumno: </label>
                <select name="dni">
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            <option value={{ $alumno->dni }}>{{ $alumno->nombre . ' ' . $alumno->dni }}</option>
                        @endforeach
                    @endisset
                </select>
                <br>
                <label for="nombre">* Nombre: </label><input type="text" name="nombre" required><br>
                <label for="apellidos">Apellidos: </label><input type="text" name="apellidos"><br>
                <label for="fechanacimiento">Fecha nacimiento: </label><input type="date" name="fechanacimiento">
                <button type="submit">Editar</button>
            </form>
        </div>
        <div class="form">
            <h4>Buscar alumno</h4>
            <form action="/buscar_alumno" method="post">
                @csrf
                <label for="dni">Dni: </label><input type="text" name="dni"><br>
                <label for="nombre">Nombre: </label><input type="text" name="nombre"><br>
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <div class="alumnos">
            @isset($alumnos)
                @foreach ($alumnos as $alumno)
                        <div class="alumno">
                            <h4>Alumno</h4>
                            <span>Dni: </span>{{ $alumno->dni }} <br>
                            <span>Nombre: </span>{{ $alumno->nombre }}<br>
                            <span>Apellidos: </span>{{ $alumno->apellidos }}<br>
                            <span>Fecha de Nacimiento: </span>{{ date("d/m/Y", $alumno->fechaNacimiento) }} <br><br>
                        </div>
                @endforeach
            @endisset
    </div>
    <div>

    </div>
</body>

</html>
