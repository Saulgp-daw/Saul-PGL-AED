@include('header')
@include('navbar')
<h3>Modificar reserva</h3>
@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif
<form action="/modificar" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="id_reserva" id="id_reserva" value={{ $reserva->getId_reserva() }}><br>
    <label for="telefono">* Teléfono: </label>
    <input type="text" name="telefono" id="telefono" value={{ $telefonoSesion }} required><br>
    <label for="duracion">* Duración: </label>
    <select name="duracion" id="duracion" required>
        @foreach ($opciones as $value)
            @if ($reserva->getDuracion() == $value)
                <option value="{{ $value }}" selected>{{ $value }}</option>
            @elseif($reserva->getDuracion() != $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endif
        @endforeach
    </select><br>
    <label for="sillas">* Número de sillas: </label>
    <select name="sillas" id="sillas" required>
        @foreach ($opciones as $value)
            <option value="{{ $value }}" selected>{{ $value }}</option>
        @endforeach
    </select><br>
    @php
        $timestamp = $reserva->getFecha_hora() ?? time(); // Asumiendo que tienes un objeto reserva
        $fechaHoraFormatoLocal = date('Y-m-d\TH:i', $timestamp);
    @endphp

    <input type="datetime-local" name="fecha_hora" id="fecha_hora" required value="{{ $fechaHoraFormatoLocal }}"><br>


    <input type="submit" value="Reservar"><br>

</form>


@include('footer')
