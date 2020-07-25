<?php 	
	//Script/controlador para accionar los casos del template de index.php
	// Se abre la session
	session_start();
	//Se cargan las clases
		require_once(dirname(__FILE__).'/../modals/users.php');
		require_once(dirname(__FILE__).'/../views/signup.php');
		//Se corrobora que ha llegado informacion del template
		if(isset($_POST)){
			$action=$_POST['action'];
		}
		//Se cargab las clases
			$user = new Users();
			$view = new Signup();
			$respuesta = [];
		//Switch que recibe y procesa cada caso.
		switch($action){
			//El caso 'initial' borra todos los usuarios
			case 'initial':
					$user->delete_all();
					break;
			//El caso 'create' crea un nuevo jugador
			case 'create':
			if(isset($_POST['name'])){
				//Llama a la accion del modal create_user
				$user->create_user($_POST['name']);
				//Llama a la accion del view para cargar ese apartado gráfico
				echo $view->set_player();
			}
				break;
			// begin comprueba que hay almenos un usuario listo para jugar 
			case 'begin':
				echo $user->total_users();
				break;
			// Elimina un jugador
			case 'delete':
				if(isset($_POST['id'])){
					$user->delete_one($_POST['id']);
					echo $view->set_player();
				}
				break;
			//Elimina todos los jugadores
			case 'delete_all':
				echo $user->delete_all();
				break;
			default:
			break;
		}
		

 ?>