@include('header')
@include('navbar')
<h2>Perfil</h2>
@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

@if ($usuario)

    <p>Nombre: {{ $usuario->getNombre() }}</p>
    <p>Teléfono: {{ $usuario->getTelefono() }}</p>
    <p>Rol: {{ $usuario->getRol() }}</p>
    </div>

    @if ($reservas)
        <div>
            <h3>Sus reservas: </h3>

            @foreach ($reservas as $reserva)
                <div class="contenedor">
                    <div>
                        <p> Fecha: {{ date('Y-m-d H:i:s', $reserva->getFecha_hora()) }}
                            Duración: {{ $reserva->getDuracion() }}h
                            Num_mesa: {{ $reserva->getNum_mesa() }}
                            Estado: {{ $reserva->getEstado() }}
                        </p>
                    </div>
                    <div>
                        <form action="{{ url("/borrar/{$reserva->getId_reserva()}") }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('¿Estás seguro de que quieres borrar este elemento?')">Borrar</button>

                        </form>
                    </div>
                    <div>
                        <form action="{{ url("/modificar_form/{$reserva->getId_reserva()}") }}" method="GET">
                            @csrf
                            <button type="submit">Modificar</button>
                        </form>
                    </div>
                    <div>
                        @if ($reserva->getEstado() == 'Sin confirmar')
                            <form action="{{ url("/confirmar/{$reserva->getId_reserva()}") }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    onclick="return confirm('¿Estás seguro de que quieres confirmar esta reserva?')">Confirmar
                                    Reserva</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div>
            <h3>No tiene ninguna reserva creada</h3>
        </div>
    @endif
@else
    <div>
        <h3>Usuario inexistente</h3>
    </div>
@endif

@include('footer')
