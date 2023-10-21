<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TextArea</title>
</head>

<body>
    <h3>Práctica 11 - Laravel</h3>
    <form action="devolverLista" method="post">
        <label for="lista">Introduce palabras separadas por comas y se transformarán a una lista: </label><br>
        <textarea name="lista" id="list" cols="30" rows="10"></textarea><br>
        <input type="submit" value="Enviar">
    </form>

    @if (isset($textoSeparado))
        <ul>
            @for ($i = 0; $i < $iteraciones; $i++)
                <li> {{$textoSeparado[$i]}}</li>
            @endfor
        </ul>
    @endif
</body>

</html>
