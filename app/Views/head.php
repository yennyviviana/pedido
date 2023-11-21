<?php
require_once('Config/database.php');
require_once('Models/sentenciaModel.php');




//echo $_SESSION['usuario'];
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
    $conUsuario = "SELECT * FROM usuarios WHERE id_usuario = ".$_SESSION['usuario'];
    $resultado = new sentenciaModel($conUsuario, $conexion, 'usuarios');
    $resultado->ejecutarConsulta();

    $usuario = mysqli_fetch_array($resultado->getResultado());
} else {
   
   // exit("Te has logueado");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App pedidos</title>
    <link href="Public/css/style.css" type="text/css" rel="stylesheet">
    <script src="Library/ckeditor/ckeditor.js"></script>
</head>
<body>
    

<header class="header">
<div id="cerrar">
		<h2 class="text1">Bienvenido: <?php echo $username; ?>&nbsp;</h1>
		<a href="Models/salirModel.php">Cerrar Sesión</a>
</div>


</header>



</body>
</html>