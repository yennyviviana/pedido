<?php
    // Iniciar la sesión
    session_start();

    // Limpiar la variable de sesión 'usuario'
    $_SESSION['usuario'] = "";

    // Destruir la sesión
    session_destroy();
    
    // Redirigir al usuario a la página de inicio
    header("Location: ../index.php");
    exit; // Añadir exit después de la redirección
?>
