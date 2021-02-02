<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
    <p>Recibiste un mensaje de: {{$msg['nombre']}} - {{$msg['email']}} </p>
    <p>Asunto <strong>{{$msg['asunto']}}</strong></p>
    <p>Contenido: {{$msg['mensaje']}} </p>
</body>
</html>