<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Matrículas</title>
</head>

<body>
    <div>
        <a href="/home"><h2>Gestionar Instituto</h2></a>
    </div>
    <div class="h5" style="position: absolute; top: 10px; right: 10px;"><a href="/logout">Logout</a></div>
    <h3>Gestión Matriculas</h3>
    <p>{!! $mensaje ?? '' !!}</p>
    <div class="contenedorForms">
        <div class="form">
            <h4>Agregar Matricula</h4>
            <form action="/agregar_matricula" method="post">
                @csrf
                <label for="dni">* DNI: </label>
                <select name="dni">
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            <option value={{ $alumno->dni }}>{{ $alumno->nombre . ' ' . $alumno->dni }}</option>
                        @endforeach
                    @endisset
                </select>
                <br>
                <label for="year">* Year: </label><input type="text" name="year" required><br>
                <label for="asignaturas">* Asignaturas: </label>
                @isset($asignaturas)
                    @foreach ($asignaturas as $asignatura)
                        <label>
                            <input type="checkbox" name="asignaturas[]" value={{ $asignatura->id }}>
                            {{ $asignatura->nombre }}
                        </label>
                    @endforeach
                    <br>
                @endisset
                <button type="submit">Agregar</button><br><br>
            </form>
        </div>
        <div class="form">
            <h4>Borrar Matrícula</h4>
            <form action="/borrar_matricula" method="post">
                @csrf
                <label for="id">Elija: </label>
                <select name="id">
                    @isset($matriculas)
                        @foreach ($matriculas as $matricula)
                            <option value={{ $matricula->id }}>
                                {{ $matricula->id . ' ' . $matricula->dni . ' ' . $matricula->year }}</option>
                        @endforeach
                    @endisset
                </select>
                <button type="submit">Borrar</button>
            </form>
        </div>
        <div class="form">
            <h4>Actualizar matrícula</h4>
            <form action="/editar_matricula" method="post">
                @csrf
                <label for="idMatricula">* Matrícula: </label>
                <select name="idMatricula">
                    @isset($matriculas)
                        @foreach ($matriculas as $matricula)
                            <option value={{ $matricula->id }}>
                                {{ $matricula->id . ' ' . $matricula->dni . ' ' . $matricula->year }}</option>
                        @endforeach
                    @endisset
                </select><br>
                <label for="dni">* Alumno:</label>
                <select name="dni">
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->dni }}">{{ $alumno->dni. " ".$alumno->nombre }}</option>
                        @endforeach
                    @endisset
                </select><br>
                <label for="year">* Año: </label> <input type="text" name="year" required> <br>
                <label for="asignaturas">Asignaturas: </label>
                @isset($asignaturas)
                    @foreach ($asignaturas as $asignatura)
                        <label>
                            <input type="checkbox" name="asignaturas[]" value={{ $asignatura->id }}>
                            {{ $asignatura->nombre }}
                        </label>
                    @endforeach
                    <br>
                @endisset
                <button type="submit">Editar</button><br><br>
            </form>
        </div>
        <div class="form">
            <form action="/buscar_matricula" method="post">
                @csrf
                <label for="dni">Dni: </label>
                <select name="dni">
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->dni }}">{{ $alumno->dni. " ".$alumno->nombre }}</option>
                        @endforeach
                    @endisset
                </select><br>
                <label for="year">Año: </label>
                <select name="year">
                    @isset($matriculas)
                        @foreach ($matriculas as $matricula)
                            <option value={{ $matricula->year }}>{{ $matricula->year }}</option>
                        @endforeach
                    @endisset
                </select><br>
                <label>
                    <input type="radio" name="opcion" value="dni" checked> DNI
                </label>

                <label>
                    <input type="radio" name="opcion" value="year"> Año
                </label>
                <button type="submit">Buscar</button><br><br>
            </form>
        </div>
    </div>
    <div class="matriculas">
        <br>
        <br>
        <br>
        @isset($matriculas)
            @foreach ($matriculas as $matricula)
                <div>
                    <span>Id: </span>{{ $matricula->id }} <br>
                    <span>Dni: </span>{{ $matricula->dni }}<br>
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            @if ($alumno->dni == $matricula->dni)
                                {{ $alumno->nombre . ' ' . $alumno->apellidos . ' ' . date('d/m/Y', $alumno->fechaNacimiento) }}
                                <br>
                            @endif
                        @endforeach
                    @endisset
                    <span>Year: </span>{{ $matricula->year }}<br>
                    <span>Asignaturas: </span>
                    @isset($datos)
                        @foreach ($datos as $id => $asignaturas)
                            @foreach ($asignaturas as $asignatura)
                                @if ($matricula->id == $id)
                                    {{ $asignatura->nombre . ' - ' . $asignatura->curso . ', ' }}
                                @endif
                            @endforeach
                        @endforeach
                    @endisset
                </div>
                <br><br>
            @endforeach

        @endisset
    </div>
</body>

</html>
