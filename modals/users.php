<?php 	
/**
*
* El modal Users permite tratar los usuarios que crearemos como jugadores de nuestro juego.
* 
*
*/
class Users{
	function __construct(){
		
	}
	/**
	*
	* Crea un nuevo usuario. Lo guarda en un array de objetos con todos los usuarios
	*
	* @param    string  $name el nombre del usuario.
	*
	*/
	function create_user($name){
		foreach ($_SESSION['users'] as $key => $value) {
			if($value['nombre']==$name){
				return 'Nombre ya es cogido';
			}
		}
		array_push($_SESSION['users'],
						array(
							'nombre'    => $name,
							'puntuacion'=> 0,
							'jugando'=> 0,
								)
						);
		return '¡Jugador creado con exito!';
	}
	/**
	*
	* Permite sumar la puntuacion de cada jugador cada vez que aciertan. 
	*
	* @param    string  $name el nombre del usuario.
	*
	*@return 	El nombre del jugador premiado.
	*/
	function puntuar(){
		foreach ($_SESSION['users'] as $key => $value) {
			if($value['jugando']==1){
					$_SESSION['users'][$key]['puntuacion'] = $_SESSION['users'][$key]['puntuacion']+1;
					return $_SESSION['users'][$key]['nombre'];
			}
		}
	}
	/**
	*
	* Funcion para pasar de un jugador a otro en caso de que fallen 
	* Esta funcion revisa que el jugador que esta jugando y ha fallado mas de 10 veces pasa el turno al otro jugador
	*/
	function colgado(){
		$top_players = sizeof($_SESSION['users'])-1;
		foreach ($_SESSION['users'] as $key => $value) {
			if($value['jugando']==1){
				$key=$key+1;
					if($key>$top_players){
							$_SESSION['users'][$key-1]['jugando'] = 0;
							$_SESSION['users'][0]['jugando'] = 1;
					}else{
							$_SESSION['users'][$key-1]['jugando'] = 0;
							$_SESSION['users'][$key]['jugando'] = 1;
					}
			}
		
		}
	}
	/**
	*
	* Funcion que elimina todos los jugadores
	*
	*/
	function delete_all(){
		$_SESSION['users']=[];
	}
		
	/**
	*
	* Funcion que devuelve el numero de jugadores
	*
	*/
	function total_users(){
		if(isset($_SESSION['users'])){
				$_SESSION['users'][0]['jugando']=1;
		}
		return sizeof($_SESSION['users']);
	}
	/**
	*
	* Permite eliminar un jugador.
	*
	* @param integer $index el indice del jugador. 
	*/
	function delete_one($index){
		array_splice($_SESSION['users'],$index,1);
	}
}

 ?>		
