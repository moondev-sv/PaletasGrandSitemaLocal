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
		<div class="container">
			Seleccione el filtro de fecha 
		<select name="" id="">
			<option value="">6 HORAS</option>
			<option value="">12 HORAS</option>
			<option value="">1 DIA</option>
			<option value="">1 SEMANA</option>
			<option value="">1 MES</option>
			</select>
		</div>
		<div>
			<table CLASS="table table-row table-light">
				<thead>
					<td>ID</td>
					<td>PRODUCTO</td>
					<td>CANTIDAD</td>
					<td>PRECIO UNITARIO</td>
					<td>PRECIO TOTAL</td>
				</thead>
				<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	
</body>
</html>