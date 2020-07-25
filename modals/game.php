<?php 
/**
*
*		Este Modal permite gestionar el juego y sus acciones como un todo.
* 		De esta manera las funciones que modifican los valores del juego se gestionan desde una sola *			clase obteniendo así mayor control.
*
**/
class Game{

	public $fichero = "";/* $fichero contiene el nombre del fichero que se utilizara para obtener las palabras para el juego */

	/**
	 *
	 * Constructor de clase. genera la clase.
	 *
	 * @param    string  $fichero es el fichero que procesaremos
	 *
	 */
	function __construct($fichero){
		$this->fichero = $fichero;
	}
	/**
	 *
	 * Funcion que se activarà cada vez que se quiere empezar a jugar.
	 * Restablece los valores de nuevo a su valor inicial.
	 * Crea las classes de los demas Modales que se utilizaran para gestionar aspectos del juego.
	 * Se crear las variables de SESSION indispensables para jugar. letras y fallos.
	 */
	function restart(){
		$heroes 	        = new Heroes($this->fichero);
		$hero           	= new Hero($heroes->get_a_hero());
		$_SESSION['hero']   = $hero->set_hero();

		$_SESSION['letras'] =[];
		$_SESSION['fallos'] = [];
	}
	/**
	 *
	 * Revisa si el valor que se ha introducido en el input es una letra y de ser así que no este repetida
	 *
	 * @param    char  $letter El valor que se pretende revisar
	 * @return      integer con el valor de cada caso (Valido(1), no valido(2), repetido(3))
	 *
	 */
	function check_letters($letter){
		if(preg_match('/[a-zA-Z]/',$letter)==1){
			//Se recorren todas las letras de la variable letras
			foreach ($_SESSION['letras'] as $llave => $letra) {
				if($letter==ucfirst($letra)||$letter==strtolower($letra)){
					//Si esta repetida se devuele el valor 3 informando al controlador.
					return 3;
				}
			}
			//Si es valida se introduce en el array de letras. Se devuele el valor 1.
			array_push($_SESSION['letras'],$letter);
			return 1;
		}
		//Si no es una letra se devuelve el valor 2.
		return 2;
	}

	/**
	 *
	 * Funcion que se activarà para ver si se ha completado una palabra.
	 Se recorren todas las letras de la palabra para ver si su valor es positivo. 
	 *
	 * @param    object  $word El objeto con cada letra y su estado.
	 * @return   retorna un string con la respuesta de si esta completada o no la palabra.
	 *
	 */
	function you_win($word){
		$win = true;
		foreach ($word as $key => $value) {
			if($word[$key]['is_check']!=1){
				$win = false;
			}
		}
		return $win;
	}

	/**
	 *
	 * Funcion que se encarga de guardar los errores que se cometen en partida y de comprobar si se ha fallado el ´àximo de veces.
	 *
	 * @param    char  $letter la letra que ha sido fallada
	 * @return   retorna un string con la respuesta de si se ha fallado elmàximo de veces establecido.
	 *
	 */
	function set_fallo($letter){
		array_push($_SESSION["fallos"],$letter);
		if(sizeof($_SESSION["fallos"])>=10){
				return 'fail';
		}
	}
}

 ?>