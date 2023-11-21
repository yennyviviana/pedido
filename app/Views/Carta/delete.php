<?php
$llave = $_GET['lla'];
$imagen = $_GET ['imagen'];


unlink('imagenes/platos/'. $imagen);

// Crear la sentencia SQL para eliminar carta
$ejecutarBorrar = "DELETE FROM  carta  WHERE  nombre_plato = '$llave'";
$borrar = new sentenciaModel($ejecutarBorrar, $conexion, 'carta');
$borrar->insertarDBO();

header("Location:  routes.php?da=1");


?>