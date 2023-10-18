<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Números Primos</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Número</th>
            <th>Primo</th>
        </tr>
        @foreach ($coleccion as $primo)
            <tr>
                <td>primo </td>
                <td>{{ $primo }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
