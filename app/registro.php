<?php

date_default_timezone_set("America/Bogota");
require_once('Config/database.php');

if (isset($_POST['usuario'])) {
    $usuario = stripslashes($_POST['usuario']);
    $clave = stripslashes($_POST['clave']);
    $email = stripslashes($_POST['email']);
    $nombre = stripslashes($_POST['nombre']);
    $apellido = stripslashes($_POST['apellido']);
    $tipo_usuario = $_POST['tipo_usuario'];  // Obtener el tipo de usuario desde el formulario

    // Escapar las variables para evitar inyecciones SQL
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $clave = mysqli_real_escape_string($conexion, $clave);
    $email = mysqli_real_escape_string($conexion, $email);
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $apellido = mysqli_real_escape_string($conexion, $apellido);

    // Verificar si el usuario ya existe
    $check_query = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $check_result = mysqli_query($conexion, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "El usuario ya está registrado. Por favor, elija otro nombre de usuario.";
        $alert_type = "danger";
    } else {
        // Cifrar la contraseña
        $clave_cifrada = sha1($clave);  // Considera usar password_hash() para un mayor nivel de seguridad
        
        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO `usuario` (usuario, clave, email, nombre, apellido, tipo_usuario) 
                  VALUES ('$usuario', '$clave_cifrada', '$email', '$nombre', '$apellido', '$tipo_usuario')";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            $message = "¡Registro exitoso! Ahora serás redirigido a la página de inicio de sesión.";
            $alert_type = "success";
        } else {
            $message = "Error al registrar el usuario. Inténtalo de nuevo.";
            $alert_type = "danger";
        }
    }
} else {
    $message = '';
    $alert_type = '';
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="form-container">
        <form action="" method="POST">
            <h1><i class="fas fa-users"></i> Nuevo Usuario</h1>
            <p><b><font size="3" color="#c68615">*Datos obligatorios</font></b></p>

            <div class="form-group">
                <label for="usuario">* Usuario:</label>
                <input type="text" name="usuario" class="form-control" id="usuario" required>
            </div>

            <div class="form-group">
                <label for="nombre">* Nombre:</label>
                <input type="text" name="nombre" class="form-control" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">* Apellido:</label>
                <input type="text" name="apellido" class="form-control" id="apellido" required>
            </div>
            
            <div class="form-group">
                <label for="email">* Correo Electrónico:</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            
            <div class="form-group">
                <label for="clave">* Clave:</label>
                <input type="password" name="clave" class="form-control" id="clave" required>
            </div>

            <div class="form-group">
                <label for="tipo_usuario">* Tipo de Usuario:</label>
                <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                    <option value="9">Administrador</option>
                    <option value="2">Cliente</option>
                    <option value="3">Usuario</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Registrar Usuario</button>
            <button type="button" class="btn btn-dark" onclick="window.location.href='index.php';">Regresar</button>
        </form>
    </div>

    <?php if ($message): ?>
        <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-<?php echo $alert_type; ?> text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resultModalLabel"><?php echo $alert_type == 'success' ? 'Éxito' : 'Error'; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo $message; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('resultModal'));
                myModal.show();
                <?php if ($alert_type == 'success'): ?>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 2000); // Redirige después de 2 segundos
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

</div>
</body>
</html>
