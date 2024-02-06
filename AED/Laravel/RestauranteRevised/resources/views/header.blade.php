<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            padding: 15px;
            color: white;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
            display: inline-block;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar-left {
            float: left;
        }

        .navbar-right {
            float: right;
        }

        .contenedor{
            display: grid;
            grid-template-columns: repeat(4, 1fr);

        }

        .contenedor > div {
            margin: auto;
        }

        .contenedor:nth-child(odd) {
            background: #333;
            color: white;
        }

        .contenedor:nth-child(even) {
            background: #6e6e6e;
            color: white;
        }

        .error {
            background-color: rgb(241, 117, 117);
            color: white;
            border-radius: 10px;
            padding: 1rem;
            position: absolute;
            top: 5rem;
            right: 0.5rem;
        }
    </style>
</head>
<body>
