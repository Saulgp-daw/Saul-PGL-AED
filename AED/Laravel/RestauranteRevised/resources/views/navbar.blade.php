<nav>
    <div class="navbar-left">
        <a href="/home">Home</a>
    </div>
    <div class="navbar-right">
        <a href="/logout">Logout</a>
    </div>
    <div class="navbar-right">
        <a href={{ "/perfil/".$telefonoSesion}}>{{ 'Usuario: ' . $telefonoSesion ?? '' }}</a>
    </div>
</nav>
