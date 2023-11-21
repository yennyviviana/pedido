<?php
require_once('Config/database.php');
require_once('Models/sentenciaModel.php');
require_once('Views/menu.php');
require_once('Views/head.php');

?>



<?php
	
    $dato = isset($_GET['da']) ? $_GET['da'] : 1;

	switch($dato) {
		case 1:
			require_once('Views/Carta/create.php');
			break;
		case 2:
			require_once('Views/Carta/insert.php');
			break;
		case 3:
			require_once('Views/Carta/edit.php');
			break;
		case 4:
			require_once('Views/carta/delete.php');
			break;
			
	}

?>