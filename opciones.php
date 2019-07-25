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
		.cuerpo{height: 280px; background:#F4F6F6;}
	</style>	

	<!--encabezado sin contenido-->
	<div class="">
		<div class="col-12 encabezado"></div>
	</div>	
	<!--Barra de menu opciones-->
	<div class="">
	<?php
		include("barra_herramientas_modificada.php")
	?>
	</div>

	<!--seccion de la tabla de reportes-->
	<div class="container">
		<div class="form-row text-center">
		<div class="col-12 cuerpo">
			
			<table class="table table-striped">
  				<thead>
    			<tr>
      				<th scope="col">Codigo</th>
      				<th scope="col">Producto</th>
      				<th scope="col">Precio</th>
      				<th scope="col">Cantidad</th>
      				<th scope="col">Total</th>
    			</tr>
  				</thead>
  				<tbody>
    			<tr>
    				<th scope="row">0000</th>
    				<td>paletaq</td>
    				<td>0.50</td>
    				<td>3</td>
    				<td>1.50</td>
    			</tr>
    			<tr>
    				<th scope="row">0001</th>
    				<td>paleto</td>
    				<td>0.25</td>
    				<td>1</td>
    				<td>0.25</td>
    			</tr>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</body>
</html>
