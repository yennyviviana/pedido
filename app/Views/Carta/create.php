<!-- HTML part -->
<a href="routes.php?da=2" title="Ingresar un nuevo plato" class="boton-ingresar">
    Ingresar un nuevo plato
</a>

<br><br>

<table class="table table-striped">
	<tr>
		<th>Nombre del Plato</th>
		<th>Precio</th>
		<th>Ingredientes</th>
		<th>Imagen</th>
		<th>Editar</th>
		<th>Borrar</th>
	</tr>
 


<?php

	$consulta = "SELECT * FROM carta ORDER BY  nombre_plato";
	$nuevaOperacion= new SentenciaModel($consulta, $conexion, 'carta');
	$nuevaOperacion->ejecutarConsulta();
	while($platos = mysqli_fetch_array($nuevaOperacion->getResultado())) {
?>


<td>
<tr>
		<td><?php echo $platos['nombre_plato']; ?></td>
		<td>$ <?php echo number_format($platos['precio'], 2, ',', '.'); ?></td>
		<td><?php echo $platos['ingredientes']; ?></td>
		<td><img src="imagenes/platos/<?php echo $platos['imagen']; ?>" width="100" alt=""></td>
		
      
		<td><a href="routes.php?da=3&lla=<?php echo $platos['nombre_plato']; ?>">Editar</a></td>
		<td><a href="routes.php?da=4&lla=<?php echo $platos['nombre_plato']; ?>" onclick="pregunta('<?php echo $platos['nombre_plato']; ?>', '<?php echo $platos['imagen']; ?>')">Borrar</a></td>

	</tr>
<?php } ?>	
</td>
</table>



<script>
	function pregunta(id, imagen) {
		if (confirm('¿Esta seguro de borrar el plato de la carta?')) {
			document.location="routes.php?da=4&lla=" + id + "&imagen=" + imagen;
		}else{
			document.location="routes.php?da=1";		
		}
	}
</script>

	






