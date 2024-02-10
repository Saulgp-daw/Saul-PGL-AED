@include('header')
@include('navbar')
<h2>Lista de usuarios</h2>
@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif
@foreach ($listaUsuarios as $usuario)
<div class="contenedor">
    <div>{{ $usuario->getTelefono() }}</div>
    <div>{{ $usuario->getNombre() }}</div>
    <div>
        <a href={{ "/perfil/".$usuario->getTelefono() }}>Ver usuario</a>
    </div>
</div>
@endforeach

@include('footer')
