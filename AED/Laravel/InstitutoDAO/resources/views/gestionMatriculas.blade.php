<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestin Matrículas</title>
</head>

<body>
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
                <label for="year">Year: </label><input type="text" name="year"><br>
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
                <button type="submit">Agregar</button><br><br>
            </form>
        </div>
    </div>
    <div class="matriculas">
        @isset($matriculas)
            @foreach ($matriculas as $matricula)
                <div>
                    <span>Id: </span>{{ $matricula->id }} <br>
                    <span>Dni: </span>{{ $matricula->dni }}<br>
                    @isset($alumnos)
                        @foreach ($alumnos as $alumno)
                            @if ($alumno->dni == $matricula->dni)
                                {{ $alumno->nombre . ' ' . $alumno->apellidos . ' ' . date('d/m/Y', $alumno->fechaNacimiento) }} <br>
                            @endif
                        @endforeach
                    @endisset
                    <span>Year: </span>{{ $matricula->year }}<br>
                    <span>Asignaturas: </span>
                    @isset($datos)
                        @foreach ($datos as $id => $asignaturas)
                            @foreach ($asignaturas as $asignatura)
                                @if ($matricula->id == $id)
                                    {{ $asignatura->nombre . ' - ' . $asignatura->curso. ", " }}
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
