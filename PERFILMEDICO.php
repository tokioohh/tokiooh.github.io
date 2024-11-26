<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Perfil del Médico</title>
    <link rel="stylesheet" href="LOGIN.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form action="VALIDARCREDENCIALES.php" method="POST" class="login-form">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>
           
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
           
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
