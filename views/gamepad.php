<?php 
//Esta clase genera los elementos básicos de diseño que serán modificados segun la interaccion del usuario.
	class GamePad{
		 
		public $alert;/*$alert es la variable que contiene los avisos y la información segun los casos que se den.*/

		function __construct(){
				//Constructor por defecto
		}

		/**
		 *
		 * Esta funcion  muestra el 'pad'(El apartado visual donde se disponen las letrasde la palabra que tiene que ser descubierta)
		 *
		 * @param   word $word recibe la palabra que esta en juego y la dispone en el 'holder' de la letras. El contador por así decirlo donde estas las letras descubirtas y las que siguen escondidas.
		 *
		 */
		function pads($word){
			//Se hace un loop por todos los elementos que componen la variable word y se disponen segun su valor.
			foreach ($word as $key => $value) {
				// Se corrobora que sea una letra en caso contrario se muestra el simbolo o otro char que pueda ser. Para que el jugador solo tenga que adivinar letras.
				if(preg_match('/[a-zA-Z]/', $value['char'])==1){
					if($value['is_check']==0){
					?>
					<span>_</span>
					<?php
					 }else{
					 	//Reaccion de la funcion al ser un char no igual a una letra.
					 	?>
					 	<span><?= $value['char']?></span>
					 	<?php
					 }
				}else{
					//Reaccion de la funcion en caso de char = espacio
					 if($value['char']==" "){
					 	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
					 	}else{?>
					 		<span><?= $value['char']?></span>
					<?php
					 	}
					}
			}
		}
		/**
		 *
		 * Esta funcion dibuja el contador con los usuarios que participan y sus respectivas puntuaciones.
		 *
		 *
		 */
		function contador(){
			?>
			<div id="puntuador">
				<div class="jugador_principal">	
					<?php 	
					//Dibuja un objeto apartir de los valores de la variable de Session users generada por el modal Users.
						foreach ($_SESSION['users'] as $key => $value) {
							if($value['jugando']==1){
								?>
								<h5>Jugador actual <?= $value['nombre'];?> : <?= $value['puntuacion'];?></h5>
								<?php
							}else{
								?>
								<small><?= $value['nombre'];?> : <?= $value['puntuacion'];?></small><br>
								<?php
							}
						}
					 ?>
				</div>	
			</div>	
			<?php
		}
		/**
		 *
		 * Con esta funcion se agrupan todas las funciones que actualizan el apartado gráfico dinámico con el fin de hacer las llamadas a un solo metodo. 
		 *
		 * @param   word $word recibe la palabra que esta en juego, $letras contiene la 'pool' de letras que ya se han utilizado y $errores recupera los errores que se han cometido.
		 De esta forma estas variables se aplicaran en su respectivo espacio gráfico.
		 *
		 */
		function draw($word,$letras,$errores){
			//Activacion de la funcion contador.
			echo $this->contador();

			//Aqui se muestra la imagen del colgado, en su respectiva etapa, segun el numero de errores cometidos
			?>
			<div id="ahorcado">
				<div class="row">
						<div class="col-12">
							<div class="image-holder">
								<img src="assets/img/part<?= sizeof($errores);?>.png">
							</div>
						</div>		
				</div>
				<div class="row">	
						<div class="col-12 ">
						<h4>Letras descartadas</h4>
						<div class="descartes">	
				<?php
				//loop para mostrar las letras falladas.
					foreach ($errores as $key => $value) {
						?>
						
						<?php
						echo '<span style="font-size:20px">'.$value.',</span>';
						
					}
				?>
						</div>
						<hr>		
					</div>
				</div>
			</div>
			<?php
			//En el caso de haber completado la palabra se mostrara un mensaje con esta información con tal de que el usuario este informado.
			?>
			<h3 class="victoria"><?= $this->alert; ?></h3>
			<?php
			//activacion de la funcion pads que redibuja el estado del pad
			$this->pads($word);
		}
	}
 ?>