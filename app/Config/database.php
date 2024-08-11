<?php

$host = 'localhost';
$dbname = 'pedido_sistema';
$username = 'root';
$password = '';


//funcion que nos conecta a mysql
$conexion = mysqli_connect($host,$username,$password) or die('No se conecto a mysql');

//conectar a la base de datos
mysqli_select_db($conexion, $dbname) or die('no se conecto a la base de datos pedido');

//utf8 para todos los simbolos salgan bien
mysqli_set_charset($conexion, 'utf8');

?>
































