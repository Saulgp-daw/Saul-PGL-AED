@include('header')
<h3>Login</h3>
<div class="h5" style="position: absolute; top: 10px; right: 10px;">{{ $mensaje ?? '' }}</div>
<form action="login" method="post">
    @csrf
    <label for="telefono">* Teléfono: </label>
    <input type="number" name="telefono" id="telefono" required><br>
    <label for="contrasenha">* Contraseña: </label>
    <input type="password" name="contrasenha" id="contrasenha" required><br>

    <input type="submit" value="Entrar"><a href="/registro_form">Registrarse</a>
</form>
@include('footer')
