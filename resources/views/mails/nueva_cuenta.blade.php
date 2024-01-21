<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <style>
        body {
            font-family: "Segoe UI";
            font-size: 16px;
        }
    </style>
</head>

<body>
    <p>Hola! <strong>{{ $user->name }}</strong>, Se a registrado un usuario con este correo.</p>
    <p>Estos son los datos de inicio de sesión</p>
    <br>
    <strong>{{ 'Usuario: ' }}</strong><span>{{ $user->email }}</span><br>
    <strong>{{ 'Contraseña: ' }}</strong><span>{{ '12345' }}</span>
</body>

</html>
