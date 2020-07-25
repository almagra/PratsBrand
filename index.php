<?php 

	/*
	Template del INICIO
	Aqui se disponen los elementos estaticos. 
	Mas abajo se dispone el codigo javascript que servira para hacer llamadas a los controladores.
	*/
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>COLGADO ¡PREPARATE!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

	<div id="alerts">	
	</div>
	<div id="block2">
		<h2>El AHORCADO</h2>
		<h4>Insertar jugadores</h4>
		<div id="info">	

		</div>
		<div id="acciones">
			<div id="botones">
				<div class="row">	
					<div class="col-12">
						<input type="text" maxlength="20" class="nombre">
					</div>
				</div>
				<div class="row">	
						<div class="col-12">
							<button class="btn-primary btn-new">Crear</button>
						</div>
				</div>
				<div class="row">	
						<div class="col-12">
							<button class="btn-info btn-begin">Empezar</button>
						</div>
				</div>
			</div>	
		</div>
	</div>				
</body>
<script type="">
	//Cuando se carga la pantalla se disponen todos los valores a 0.
	$(document).ready(function(){
			$.ajax({
					url:'controllers/enter.php',
					method:'POST',
					data:{
						action:"initial"
					},
					success:function(data){
							$("#info").html(data);
					}
				})
	});
	//Cuando se aprieta el boton de Empezar se hace una llamada al controlador para ver si es viable.
	$(".btn-begin").click(function(){
		$.ajax({
					url:'controllers/enter.php',
					method:'POST',
					data:{
						action:"begin",
					},
					success:function(data){
							if(data>0){
								window.location.href="ahorcado.php";
							}
					}
				})
	})
	//Este  boton permite crear un nuevo Jugador
	$(".btn-new").click(function(){
		var str = $(".nombre").val()
		str = str.replace(/\s/g, '');
			if(str!=""){
				$.ajax({
					url:'controllers/enter.php',
					method:'POST',
					data:{
						action:"create",
						name:str	
					},
					success:function(data){
							$("#info").html(data);
					}
				})
			}
	});
	//Este boton elimina los jugadores que lo poseen.
	$(document).on('click','.btn-delete',function(){
		console.log($(this).attr('id-data'));
			$.ajax({
					url:'controllers/enter.php',
					method:'POST',
					data:{
						action:"delete",
						id:$(this).attr('id-data')	
					},
					success:function(data){
							$("#info").html(data);
					}
				})
	});
</script>
<noscript><meta http-equiv="refresh" content="0; url=whatyouwant.html" /></noscript>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>