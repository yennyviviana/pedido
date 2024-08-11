<?php
require 'Config/database.php';
session_start();


if($_POST)
{

$usuario = $_POST['usuario'];
 $clave = $_POST['clave'];

$sql = "SELECT * FROM usuario WHERE usuario='$usuario'";
//echo $sql;
 $resultado = $conexion->query($sql);
 $num = $resultado->num_rows;

if($num>0)
 {
 $row = $resultado->fetch_assoc();
 $password_bd = $row['clave'];

$password_contrasena = sha1($clave);

if($password_bd == $password_contrasena)
 {
 // Establecer variables de sesión
 $_SESSION['id_usuario'] = $row['id_usuario'];
 $_SESSION['usuario'] = $row['usuario'];
 $_SESSION['email'] = $row['email'];
 $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

if($row['tipo_usuario']==9)
 {
 
header("Location: routes.php");
 }
 elseif($row['tipo_usuario']==2)
 {
 header("Location: routes.php");
 }
 elseif($row['tipo_usuario']==3)
 {
 header("Location: routes.php");
 }
 elseif($row['tipo_usuario']==4)
 {
 header("Location: routes.php");
 }
 elseif($row['tipo_usuario']==5)
 {
 header("Location: routes.php");
 }
 elseif($row['tipo_usuario']==6)
 {
 header("Location: routes.php");
 }
 else
 {
 
header("Location: index.php");
 }
 }else
 {
 echo "La contraseña no coincide";
 }
 }else
 {
 echo "NO existe usuario";
 }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <title>OptimizacionPro</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="public/css/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>

        <div class="container">
    

    
			<form method="POST"   action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
    
        <h2><i class="fa fa-sign-in-alt"></i><h2>Iniciar session</h2>

        <label for="usuario"><i class="fa fa-envelope"></i>Usuario:</label>
        <input type="text" id="usuario" name="usuario" required placeholder="usuario">

        <label for="clave"><i class="fa fa-lock"></i>Clave:</label>
        <input type="clave" id="clave" name="clave" required placeholder="ingrese clave">

        <input type="submit" name="submit_login" value="Entrar">


<br>

      <!-- Por ejemplo, en tu página de inicio de sesión (login.html) -->
<a href="recuperar_contrasena.php"><i class="fa fa-question-circle"></i> ¿Olvidaste tu contraseña?</a>


        <!-- Enlace para mostrar el formulario de registro -->
        <p>¿No tienes una cuenta? <a href="registro.php" id="showRegister"><i class="fa fa-user-plus"></i>Regístrate aquí</a></p>
    </form>
</div>

  

    </body>
</html>