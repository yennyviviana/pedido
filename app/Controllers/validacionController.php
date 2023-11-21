<?php
require_once('Config/database.php');
require_once('Models/sentenciaModel.php');



if (isset($_POST['submit'])) {
    // Validar y obtener datos del formulario
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password= sha1($_POST['password']);

    // Validar los otros campos
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $tipo_usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    

    
// Verificar que todos los campos son válidos
if ($email && !empty($clave) && !empty($nombre) && !empty($apellido) && !empty($direccion) && !empty($telefono) && !empty($tipo_usuario)) {
    
    // Consulta a la base de datos utilizando una consulta preparada
    $sql = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
    $consulta = new sentenciaModel($sql, $conexion, 'usuarios');
    $consulta->ejecutarConsulta();
    
    
    // Obtener el resultado de la consulta
    $usuario = mysqli_fetch_array($consulta->getResultado());



        if( $usuario['email'] != "" ) {
            $_SESSION['usuario'] = $usuario['id_usuario'];
            header("Location: routes.php?da=1"); 
        }else{
            header("Location: index.php"); 
        }	
        
    }
}



?>




