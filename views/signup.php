<?php 	
/****
*
* Esta clase permite dibujar los elementos dinamicos de la pàgina de inicio del juego.
* En esta se crearan los jugadores y se mostrarán en unas tarjetas para que el usuario pueda modificar 
* los jugadores.
*
****/
class Signup{
	/**
	 *
	 * set_player permite crear y mostrar las tarjetas de los jugadores que se preparan para jugar al juego
	 *
	 *
	 */
	function set_player(){
		//Se obtiene el array de usuarios que se ha generado y se printa en forma de tarjetas con un boton que las permite eliminar.
		foreach ($_SESSION['users'] as $key => $value) {
			?>
			<div class="player">
				<div class="row">	
						<div class="col-8">
							<span><?= $value['nombre']?></span>
						</div>
						<div class="col-4">
							<?php
							 	//Este boton permite eliminar esta tarjeta si se quiere prescindir de un jugador creado.
							  ?>
							<button class="btn-danger btn-delete" id-data='<?=$key?>'>Eliminar</button>
						</div>
				</div>	
			</div>
			<?php
		}
	}
}

 ?>