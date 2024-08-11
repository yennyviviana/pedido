<div id="form">
	<form action="routes.php?da=2" method="post" enctype="multipart/form-data">
	
	<input type="text" name="plato" required="required" placeholder="Insertar plato"><br>
	<input type="number" name="precio" required="required" placeholder="Precio"><br>
	<input type="file" name="imagen" required="required"><br>
	<textarea name="ingredientes" rows="4" cols="50" required="required" placeholder="Ingredientes" class="ckeditor"></textarea><br>
	<input type="submit" name="submit" value="Guardar">
	
	</form>
</div>



<?php
//preguntar si el boton se presiono ----------
	if(isset($_POST['submit'])) {
		//capturan todos los datos enviados
		$plato = $_POST['plato'];
		$ingredientes = isset($_POST['ingredientes']) ? $_POST['ingredientes'] : '';
		$precio = $_POST['precio'];
		$imagen = $_FILES['imagen'];
		
		//cuando se captura un archivo
		$destino = '"../../Public/imagenes/';
		$nombre = $imagen['name'];
		list($nombre_img, $ext_img) = explode('.', $nombre);
		$tamano = $imagen['size'];
		$nombrefinal = $plato. "_" . $precio. "_".$nombre_img.".".$ext_img;
		/*echo $nombrefinal. "<br>";
		echo $nombre_img. "<br>";
		echo $ext_img. "<br>";*/
		
		//grabo dentro de la base de datos
		$insertar = "INSERT  INTO  carta(plato, precio, ingredientes, imagen) values('$plato', $precio, '$ingredientes', '$nombrefinal')";
		
		$insertar = new sentenciaModel($insertar, $conexion, 'carta');		
		$insertar->insertarDBO();
		
		//muevo el archivo a la carpeta
		if($tamano < 100000000) {
			move_uploaded_file($imagen['tmp_name'], $destino . '/' . $nombrefinal);
		}else {
			echo "La imagen supera el tamaño permitido";
		}
		
		header("Location: routes.php?da=1");
				
	}


	var_dump($_POST);
?>









