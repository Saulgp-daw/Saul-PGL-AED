<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div>
        <h3>Página de Home</h3>
        <h5>Bienvenido, {{session()->get("nombreUsuario")}}</h5>
    </div>
</body>
</html>
