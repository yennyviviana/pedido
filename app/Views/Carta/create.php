

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Tu Página</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    </head>
    <body>
<style>
    body {
    background-color: #fff;
    color: #f5f5f5; 
}

.panel {
    display: flex;
    justify-content: space-between;
    border: 1px solid #333;
    padding: 20px;
    border-radius: 8px;
    background-color: #234DF0; 
}

.column {
    width: 48%;
}

h2 {
    color: whitesmoke; 
}

.nav {
    display: flex;
    align-items: center;
    float: left;
    margin-left: 20px;
}

.nav a {
    color: whitesmoke; 
    text-decoration: none;
    padding: 10px;
    font-size: 16px;
    margin-left: 10px;
}

.nav a:hover {
    background-color: darkblue;
    color: #000; 
}
.nav .active {
    color: #ff6f61;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #333;
    color: #ff6f61; 
}

.btn:hover {
    background-color: #ff6f61;
    color: #fff; 
}


.btn-borrar {
    display: inline-block;
    padding: 7px 10px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #ff4d4d; 
    color: #fff;
}

.btn-borrar:hover {
    background-color: #c82333;
}

.btn-editar {
    display: inline-block;
    padding: 7px 10px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color:  blue;
    color: #fff;
}

.btn-editar:hover {
    background-color:  #0B1CDB;
}

.table-container {
    width: 100%;
    margin: 0 auto;
}

.table {
    width: 100%;
    table-layout: auto;
    word-wrap: break-word;
    color: #fff; 
    background-color: #818274; 
}

.table th, .table td {
    border: 1px solid #444;
    padding: 1rem;
    font-size: 1.1rem;
    text-align: center;
}
.table th {
    background-color: #000000;
    color:  #65D8DB; 
    font-weight: bold;
    border-bottom: 3px solid #ff6f61;
}

.table tbody tr {
    background-color: #000;
}

.table tbody tr:nth-of-type(odd) {
    background-color:  #fff; 
    color:  #000;
}



.table-responsive {
    margin-top: 1.5rem;
    overflow-x: auto;
}

.search-button {
    margin-left: auto; 
    margin-right: 20px; 
    width: 150px; 
    height: 35px;
    border-radius: 20px; 
    text-align: center; 
}

.btn-search {
    background-color: #ffffff; 
    color: #007bff; 
    border: 2px solid #007bff; 
    padding: 0; 
    display: flex; 
    align-items: center;
    justify-content: center; 
    font-size: 14px; 
    font-weight: bold; 
}

.btn-search:hover {
    background-color: #f8f9fa; 
    color: #0056b3;
    border-color: #0056b3; 
}



    </style>

</head>
<body>

<br>
<!-- HTML part -->
<a href="routes.php?da=2" title="Ingresar un nuevo plato" class="boton-ingresar">
    Ingresar un nuevo plato
</a>

<br><br>

<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Nombre del Plato</th>
        <th>Ingredientes</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Acciones</th>
        
    <tbody>
    <?php      

    $host = 'localhost';
    $dbname = 'pedido_sistema';
    $username = 'root';
    $password = '';

    // Conexión a MySQL
    $conexion = mysqli_connect($host, $username, $password) or die('No se conectó a MySQL');

    // Selección de la base de datos
    mysqli_select_db($conexion, $dbname) or die('No se seleccionó la base de datos');

    // Establecer juego de caracteres UTF-8
    mysqli_set_charset($conexion, 'utf8');

    // Consulta utilizando MySQLi
    $consulta = "SELECT * FROM carta ORDER BY id_carta";
    $nuevaOperacion = new SentenciaModel($consulta, $conexion, 'carta');
    $nuevaOperacion->ejecutarConsulta();

    // Comprobación de errores en la ejecución de la consulta
    if (!$nuevaOperacion->getResultado()) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
    }

    // Iterar sobre los resultados y mostrarlos
    while ($plato = mysqli_fetch_array($nuevaOperacion->getResultado())) {
    ?>
        <tr>
            <td><?php echo htmlspecialchars($plato['id_carta']); ?></td>
            <td><?php echo htmlspecialchars($plato['plato']); ?></td>
            <td><?php echo htmlspecialchars($plato['ingredientes']); ?></td>
            <td>$ <?php echo number_format($plato['precio'], 2, ',', '.'); ?></td>
            <td><img src="Public/imagenes/<?php echo htmlspecialchars($plato['imagen']); ?>" width="100" alt=""></td>
            
			<td class="btn-actions">
    <a href="routes.php?da=3&lla=<?php echo htmlspecialchars($plato['id_carta']); ?>" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i> Editar
    </a>
    <a href="routes.php?da=4&lla=<?php echo htmlspecialchars($plato['id_carta']); ?>" 
       onclick="pregunta('<?php echo htmlspecialchars($plato['plato']); ?>', '<?php echo htmlspecialchars($plato['imagen']); ?>')" 
       class="btn btn-danger btn-sm">
        <i class="fas fa-trash-alt"></i> Borrar
    </a>
</td>

        </tr>
    <?php } ?>	
    </tbody>
</table>

<script>
    function pregunta(id, imagen) {
        if (confirm('¿Está seguro de borrar el plato de la carta?')) {
            document.location = "routes.php?da=4&lla=" + id + "&imagen=" + imagen;
        } else {
            document.location = "routes.php?da=1";		
        }
    }
</script>
