<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
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
		<select name="" id="filtro_fecha" onchange="recargar_tabla()">
			<option value="1">6 HORAS</option>
			<option value="2">12 HORAS</option>
			<option value="3">1 DIA</option>
			<option value="4">1 SEMANA</option>
			<option value="5">1 MES</option>
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
				<tbody id="cuerpo_tabla">
			
				</tbody>
			</table>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		recargar_tabla();
	});
	function recargar_tabla(){
		var fecha = $("#filtro_fecha option:selected").val();
		$.post( "tabla_ventas.php", { bandera: "recargar",fecha:fecha} )
				.done(function( data ) {
					$("#cuerpo_tabla").html(data);
				});
	}


	</script>

</body>

</html>