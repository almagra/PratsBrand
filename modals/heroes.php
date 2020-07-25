<?php 
//Controlador del juego
class Heroes{
	//Variable que llevara la informacion del archivo solicitado en forma de string
		public $file_array = '';
		//Constructor. Se inserta el nombre del archivo que por defecto esta vacio.
		/**
		 *
		 * Generamos el objeto Heroe que llevara la información adquirida de un fichero. 
		 *
		 * @param    objeto  $file el archivo a procesar.
		 *
		 */
		function __construct($file=''){
			//Corroboramos que la variable $file no esta vacia
			if($file==''){
				echo "Error no hay archivo de Heroes";
			}else{
				//corroboramos que es un archivo que existe en nuestra carpeta de archivos
				if(file_exists(dirname(__FILE__).'/../assets/files/'.$file)){
					//Validamos que la extension del archivo es compatible con lo que queremos.
					$pthn = pathinfo('/assets/files/'.$file);
					$exten = $pthn["extension"];
					if($exten=='txt'||$exten=='json'){
						if($exten=='txt'){
							//En el caso de ser TXT lo procesamos y lo guardamos en un array. 
							//La variable $file_string se mantiene para otros posibles usos. 
							$this->file_string = file_get_contents(dirname(__FILE__).'/../assets/files/'.$file, true);
							$this->file_array = explode(";",$this->file_string);
						}elseif($exten=='json'){
							//En el caso de ser JSON hacemos un decode y guardamos la informacion en el array.($file_array)
							$this->file_array = json_decode(dirname(__FILE__).'/../assets/files/'.$file);
						}
					}else{
						//Error de defecto por extension no contemplada.
						echo "Extension no disponible para procesar";
					}
				}else{
					//Error. Archivo no disponible.
					echo "Archivo no disponible. Asegurate de que el archivo se encuentra en /assets/files/";
				}
			}
		}
		/**
		 *
		 * Nos devuelve un heroe del array de heroes
		 *
		 * @return      object
		 *
		 */
		function get_a_hero(){
			$total_heroes = sizeof($this->file_array)-2;
			$num_rand   = rand(0,$total_heroes);
			$this->hero = $this->file_array[$num_rand];
			return $this->hero;
		}
		
}
 ?>