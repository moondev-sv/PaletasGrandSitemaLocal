<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>*</title>
</head>

<body style="background: #34495E;">	
	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.barra{height: 80px;background:#E5E8E8;}
		.cuerpo{height: 280px; background:#F4F6F6;}
	</style>	
	<div class="">
		<div class="col-12 encabezado"></div>
	</div>	
	<!--Barra de menu opciones-->
	<div class="">
	<?php
		include("barra_herramientas.php")
	?>
	</div>

<div class="container">
		<div class="form-row">
			<div class="col-3 cuerpo">
			</div>

			<div class="col-6 cuerpo text-center background">
				<div class="form">
					<h4>imprimir reporte Z</h4>
				</div>
				<form method="post">
					
					<div class="form-group text-center">
						<input type="submit" class="btn btn-success btn-lg" name="reportex" id="reportex" value="reportex">
					</div>
				</form>

				<div class="form">
					<h4>imprimir reporte X</h4>
				</div>
				<form method="post">
					
					<div class="form-group text-center">
						<input type="submit" class="btn btn-success btn-lg" name="reportez" id="reportez" value="reportez">
					</div>
				</form>
			</div>

			<div class="col-3 cuerpo">
			</div>
		</div>
	</div>
<script>
    $(document).ready(function(){
        $('#reportex').click(function(){
           $.ajax({
               url: 'reporte_x.php',
               type: 'POST',
               success: function(response){
                   if(response==1){
                       alert('Imprimiendo....');
                   }else{
                       alert('Exito');
                   }
               }
           }); 
        });
    });
</script>



<script>
    $(document).ready(function(){
        $('#reportez').click(function(){
           $.ajax({
               url: 'reporte_z.php',
               type: 'POST',
               success: function(response){
                   if(response==1){
                       alert('Imprimiendo....');
                   }else{
                       alert('Exito');
                   }
               }
           }); 
        });
    });
</script>




</body>
</html>