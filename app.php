<?php 
session_start();
//Este script sirve como intermediario y ejecutor de las llamadas AJAX
// Se carga el controlador.
require(dirname(__FILE__)."/controllers/playground.php");

	if(isset($_POST)){
		$action = $_POST['action'];
		//Cargamos la clase controladora.
		$playground = new Playground();
		switch ($action) {
			case 'new':
			//Crear nuevo juego
				$playground->start('data.txt');
				break;
			case 'check':
			//Comprobar si la accion del juego es correcta.
				$playground->guess($_SESSION['hero'],$_POST['letra'],$_SESSION['letras']);
				break;
			default:
				break;
		}
	}
	
	
	
 ?>