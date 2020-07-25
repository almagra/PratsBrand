<?php 
//Se cargan todas las clases de MODALES y VIEWS
		require_once(dirname(__FILE__)."/../modals/heroes.php");
		require_once(dirname(__FILE__)."/../modals/hero.php");
		require_once(dirname(__FILE__)."/../modals/game.php");
		require_once(dirname(__FILE__)."/../modals/users.php");
		require_once(dirname(__FILE__)."/../views/gamepad.php");
/**
*
* La clase Playground engloba todas las funciones que puede hacer el controlador.
*
* 
*/
	class Playground{
		public  $pad;
		public  $word;
		public  $game;
		public  $gamepad;
		public  $user;

	/**
	*
	* Constructor que carga las clases imprescindibles para el juego.
	*
	*/
		function __construct(){
			//Gamepad muestra la informacion al usuario
			$this->gamepad  = new GamePad();
			//Game permite iniciar la estructura del juego.
			$this->game     = new Game('data.txt');
			//User obtiene los jugadores a jugar.
			$this->user     = new users();

		}
		/**
		*
		* Inicia la partida estableciendo todos los valores al valor inicial.
		*
		*@param string $fichero obtiene el fichero del que se obtendran los  nombres.
		*/
		function start($fichero){
			//Esta funcion restablece los valores del juego ha 0
			$this->game->restart();
			//Creamos el gamepad el lugar donde se dispondran las letras y al informacion para el usuario.
			$this->gamepad->draw($_SESSION['hero'],$_SESSION['letras'],$_SESSION['fallos']);
			
		}

		/**
		*
		* Esta funcion se encarga de cada turno del juego y cada accion.
		*
		*@param object $word el objeto que contiene las letras del nombre.
		*@param string $letter la letra que se ha insertado.
		*@param object $game los valores del juego (puntuacion, numero de fallos, letras)
		*/
		function guess($word,$letter,$game){
			switch($this->game->check_letters($letter,$game)){
				case 1:
				//Se inserta una letra correcta.
					$this->word     = new Hero($word);
					$result = $this->word->check_word($letter);
					if($result !=false){
							$_SESSION['hero'] = $this->word->check_word($letter);
							//En el caso de completar la palabra se aplicara esta seccion
 							if($this->game->you_win($_SESSION['hero'])){
 								$this->gamepad->alert = $this->user->puntuar()." HAS PUNTUADO";
 								;
 								?>
 								<script>
 									$(".btn_letter").hide();
 								</script>
 								<?php
 							}
					}else{
						// Si hay error se aplica esta parte
						if($this->game->set_fallo($letter)=='fail'){
							$this->user->colgado();
							?>
							<script>
 								$(".btn_letter").hide();
 							</script>
 							<?php
						}
					}
					break;
				//Caso de que no se haya insertado una letra
				case 2:
					$this->gamepad->alert = 'Utiliza solo letras';
					break;
				//Se ha repetido una letra
				case 3:
					$this->gamepad->alert = "REPETIDA";
					break;
			}
			//Se actualiza el apartado grafico del juego con la nueva informacion.
			$this->gamepad->draw($_SESSION['hero'],$_SESSION['letras'],$_SESSION['fallos']);
		}
	}
	
	?>
