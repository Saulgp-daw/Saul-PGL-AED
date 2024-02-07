@include('header')
@include('navbar')
<h3>Reserva</h3>
@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif
<form action="reserva" method="post">
    @csrf
    <label for="telefono">* Teléfono: </label>
    <input type="text" name="telefono" id="telefono" value={{ $telefonoSesion }} required><br>
    <label for="duracion">* Duración: </label>
    <select name="duracion" id="duracion" required>
        @foreach ($opciones as $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select><br>
    <label for="sillas">* Número de sillas: </label>
    <select name="sillas" id="sillas" required>
        @foreach ($opciones as $value)
            <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
    </select><br>
    * <input type="datetime-local" name="fecha_hora" id="fecha_hora" required><br>

    <input type="submit" value="Reservar"><br>
    {{ $mensaje ?? '' }}

</form>


@include('footer')
