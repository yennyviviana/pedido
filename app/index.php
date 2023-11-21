<?php
require_once('Config/database.php');
require_once('Models/sentenciaModel.php');
require_once('Controllers/validacionController.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App pedidos</title>
    <link href="Public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    
<div class="container">

<form action="routes.php" method="POST">
  <h1 class="text">Sistema de pedidos.</h1>

  <div class="mi-formulario">
  <div class="row">
	        	<div class="col-md-6">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" class="form-control" required>
  </div>

  <div class="row">
	        	<div class="col-md-6">
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" class="form-control" required>
  </div>

  <div class="row">
	        	<div class="col-md-6">
    <label for="direccion">Direccion:</label>
    <input type="text" id="direccion" name="direccion" class="form-control" required>
  </div>

  <div class="row">
	        	<div class="col-md-6">
    <label for="tel">Telefono:</label>
    <input type="tel" id="telefono" name="telefono" class="form-control" required>
  </div>

  <div class="row">
    <div class="col-md-12">
        <label for="usuario">Tipo Usuario:</label>
        <select id="usuario" name="usuario" class="form-control" required>
            <option value="administrador">Administrador</option>
            <option value="cliente">Cliente</option>
            <!-- Puedes agregar más opciones según sea necesario -->
        </select>
    </div>
</div>


  <div class="row">
	        	<div class="col-md-6">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>

  <div class="row">
	        	<div class="col-md-12">
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>

  <div class="row">
	        	<div class="col-md-12">
    <input type="submit" name="submit" value="Registrar">
  </div>
</form>
</div>
</div>










</body>
</html>