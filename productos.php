<?php
include("conexion/conect.php");
$sqldos="SELECT * FROM productos INNER JOIN categorias ON productos.idcategoria = categorias.idcategoria";
$sentenciaprod=$mysqli->query($sqldos);
?>
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
	<div class="form-row text-center">
		<div class="col-12 py-3 cuerpo table-responsive">
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col" >Categoria</th>
					<th scope="col" >Nombre</th>
					<th scope="col" >Descripcion</th>
					<th scope="col" >Precio</th>
					<th scope="col" >Stock</th>
					<th scope="col" >Editar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($reg=$sentenciaprod->fetch_assoc()){
						echo "<tr>
									<td scope='col'>$reg[nombrecat]</td>
									<td scope='col'>$reg[nombre]</td>
									<td scope='col'>$reg[descripcion]</td>
									<td scope='col'>$reg[precio]</td>
									</tr>";
								}
					?>
				</tbody>
			</table>
		</div>
		
	</div>
	</div>

</body>
</html>