<?php
 /**
 *
 * Template del juego
 *
 * Contiene informacion estatica y acciones de los botons con llamadas AJAX.
 *
 **/
	session_start();
	if(sizeof($_SESSION['users'])<=0){
			header("Location: index.php");
			exit;
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>COLGADO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div id="block">
	<div class="body_block">
		<?php 
		/* Boton para salir en caso de no querer jugar*/
		 ?>
		<button class="btn-salir btn-danger"><a href="index.php">SALIR</a></button>
		<div id="pad">
			<div class="row">
				<div class="col-sm-12">
					<div class="space">
				<?php /*  Espacio donde se gestionan los elementos graficos dinamicos  */ ?>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php /* INPUT DE LA LETRA */ ?>
					<div id="input_place">	
						<input class="letter_input" type="text" maxlength="1">
					</div>
				</div>
			</div>
			<?php /* BOTONERAS */ ?>
			<div class="row">
				<div class="col-sm-hidden col-lg-3">
				</div>
				<div class="col-sm-12 col-lg-6">
		 			<button class="btn-pdd btn-primary btn_letter">PROBAR ESTA LETRA</button><br>
				</div>
				<div class="col-sm-hidden col-lg-3">
				</div>
				<div class="col-sm-hidden col-lg-3">
				</div>
				<div class="col-sm-12 col-lg-6">
					<h4 style="text-align: center" class="empezar-msg">Pulsa el boton para empezar. <br>	El primer jugador sera <?= ucfirst($_SESSION['users'][0]['nombre']);?></h4>
					<button class="btn-pdd btn-success btn_nuevo">NUEVA PALABRA</button>
				</div>
				<div class="col-sm-hidden col-lg-3">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	//Permite vaciar el input una vez nos ponemos en el ahorrando tiempo y la accion de borrar.
 	$(".letter_input").on('focus',function(){
 		$(this).val("");
 	})
 	//Permite enviar la letra para que esta sea procesada.
	$(".btn_letter").click(function(){
		$.ajax({
			url:'app.php',
			method:'POST',
			data:{
				action:'check',
				letra:$(".letter_input").val()},
			success:function(data){
				$(".space").html(data);
			}
		});
	});
	//Permite crear una nueva palabra si se resiste.
	$(".btn_nuevo").click(function(){
		$(".empezar-msg").hide();
		$.ajax({
			url:'app.php',
			method:'POST',
			data:{
				action:'new'
				},
			success:function(data){
				$(".space").html(data);
				$(".btn_letter").show();
			}
		})
	});
</script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 </body>
</html>