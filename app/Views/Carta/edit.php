<?php


$dato = $_GET['da'];
$llave = $_GET['lla'];

$consulta = "SELECT * FROM carta WHERE nombre_plato = '$llave'";
$nuevaConsulta = new sentenciaModel($consulta, $conexion, 'carta');
$nuevaConsulta->ejecutarConsulta();
$plato = mysqli_fetch_array($nuevaConsulta->getResultado());

?>

<div id="form">
    <form action="routes.php?da=3&lla=<?php echo $llave; ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="llave" value="<?php echo $llave; ?>">
        <input type="text" name="nombre_plato" value="<?php echo $plato['nombre_plato']; ?>" required="required" placeholder="Ingresar plato"><br>
        <input type="number" name="precio" value="<?php echo $plato['precio']; ?>" required="required" placeholder="precio"><br>
        <input type="file" name="imagen" required="required"><br>

        <textarea name="ingredientes" rows="4" cols="50" required="required" placeholder="Ingredientes" class="ckeditor">
            <?php echo $plato['ingredientes']; ?>
        </textarea><br>

        <input type="submit" name="boton" value="Guardar">

    </form>
</div>

<?php

if (isset($_POST['boton'])) {
    $plato = $_POST['nombre_plato'];
    $ingredientes = $_POST['ingredientes'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen'];
    $llave = $_POST['llave'];

    $nombre = $imagen['name'];
    $destino = 'imagenes/platos/';

    list($nombre_img, $ext_img) = explode('.', $nombre);
    $tamano = $imagen['size'];
    $nombrefinal = $plato . "_" . $precio . "_" . $nombre_img . "." . $ext_img;

    $editar = "UPDATE carta SET imagen ='$nombrefinal', precio = $precio, ingredientes = '$ingredientes' WHERE nombre_plato = '$llave'";
    $nuevoEditar = new sentenciaModel($editar, $conexion, 'carta imagen');
    $resultado = $nuevoEditar->insertarDBO();

    if ($resultado === false) {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    if ($tamano < 100000000) {
        move_uploaded_file($imagen['tmp_name'], $destino . '/' . $nombrefinal);
    } else {
        echo "La imagen supera el tamaño permitido";
    }

    header("location: routes.php?da=1");
}

?>













