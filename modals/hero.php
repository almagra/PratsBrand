<?php 
/**
*
* Modal para gestionar el objeto de Heroe.
*
*
**/
	class Hero{

		public  $name  = ''; // $name contiene el nombre del heroe seleccionado al azar.
		public  $hero  = []; // $hero contiene el objeto del heroe seleccionado.
		
		/**
		 *
		 * Constructor de clase. genera la clase.
		 *
		 * @param    string  $word es el nombre del hero que vamos a utilizar.
		 *
		 */
		function __construct($word){
			$this->word = $word;
		}

		/**
		 *
		 * Del nombre del heroe seleccionado se genera un objeto para tratar cada parte del mismo como una sola. 
		 *
		 * @return  object $this->hero el objeto del nombre del heroe.
		 *
		 */
		function set_hero(){
			//cogemos el nombre
			$this->name = $this->word;
			//Generamos el array donde dispondremos el objeto
			$hero_ready = array();
			//Seccionamos cada elemento(char) del nombre y creamos un objeto (type, char, is_check)
			for($i=0;$i<=strlen($this->name)-1;$i++){
				$is_checked = 0;
				$typed 		= 'letter';
				$lett		= $this->name[$i];
				//corroboramos con Regex que es una letra.
				if(preg_match('/[a-zA-Z]/', $this->name[$i])==0){
					$is_checked = 1;
					$typed 		= 'other_char';
					if($lett==null){
						$word = '&nbsp';
					}
				}
				array_push($hero_ready,
						array(
							'type'=>$typed,
							'char'=>$lett,
							'is_check'=>$is_checked
						)
					);
			}
			$this->hero = $hero_ready;
			return $this->hero;
		}
		/**
		 *
		 * Comprueba que la letra forma parte del objeto. 
		 *
		 * @param    string  $letter es la letra que queremos comprobar.
		 *
		 * @return  object $word el objeto del nombre del heroe procesado.
		 *
		 */
		function check_word($letter){
			$acierto = false;
			foreach ($this->word as $key => $value) {

					if($value['char']==ucfirst($letter)||$value['char']==strtolower($letter)){
						$this->word[$key]['is_check'] = 1;
						$acierto = true;
					}
					if($this->word[$key]['is_check'] !=1){
						$completada = false;
					}
			}
			
			if($acierto == false){
				return false;
			}
			return $this->word;
		}
		
	}
 ?>