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
		.cuerpo{height: 400px; background:#F4F6F6;}
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

			<div class="col-6 cuerpo background">
				<div class="form">
					<h3>Agregar a Existencias</h3>
				</div>
				<div class="form-group">
					<label for="" ><h5>Nombre: </h5></label>
						<input type="text" class="form-control" id="" placeholder="Nombre del producto">
				</div>
    			<div class="form-group">
    				<label for="inputState"><h5>Buscar producto</h5></label>
    				<select id="inputState" class="form-control">
    					<option selected>Buscar...</option>
    					<option>...</option>
    				</select>
    			</div>
				<div class="form-group">
					<label for="" ><h5>Nueva cantidad: </h5></label>
						<input type="text" class="form-control" id="" placeholder="cantidad">
				</div>
>

				<div class="form-group text-center">
					<button type="button" class="btn btn-success btn-lg">Finalizar</button>
				</div>
			</div>
		
			<div class="col-3 cuerpo">	
			</div>
		</div>
	</div>
</body>
</html>