
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title> *</title>
</head>

<body style="background: #34495E;">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<!--estilos contenedores-->
<style type="text/css">
	.encabezado{height: 40px; background: #34495E;}
	.barra{height: 80px;background:#E5E8E8;}
	.barrabuscar {height: 60px;background:#E5E8E8;}
	.cuerpo{height: 280px; background:#F4F6F6;}
</style>

<!--encabezado sin contenido-->
	<div class="">
		<div class="col-12 encabezado">
		</div>
	</div>
<!--Barra de menu opciones-->
<div class="container">
	<div class="form-row text-center">
		<div class="col-2 barra">
		</div>
		<div class="col-7 barra">
			<h2>Caja Express</h2>
		</div>
		<div class="col-3 py-3 barra">
			<a href="opciones.php" class="btn btn-primary btn-lg">Opciones</a>
		</div>
	</div>
<br>
<!--Barra de busqueda de producto-->
	<div class="form-row text-center">
		<div class="col-8 py-2 barrabuscar">
			<input class="form-control form-control-lg" type="text" placeholder="descripcion del producto" name="buscar" id="buscar"></input>
		</div>
		<div class="col-4 py-2  barrabuscar">
		</div>
	</div>
<!--Selector de productos-->
	<div class="form-row text-center ">
		<div class="col-8 barrabuscar " id="resultado">
		

		</div>		
		<div class="col-4 py-2  barrabuscar">
			<h1>TOTAL</h1>
		</div>
	</div>
	<!--seccion de listado de producto y boton de venta-->
	<div class="form-row text-center">
		<div class="col-8 py-3 cuerpo table-responsive">
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col" >Nombre</th>
					<th scope="col" >Descripcion</th>
					<th scope="col" >Precio</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		<div class="col-4 py-5  cuerpo">
			<style type="text/css">
				.boton{font-size: 28px; padding: 30px;}
			</style>
			<a href="pago.php" class="btn btn-success btn-lg btn-block boton">
			Total de la compra
			</a>
		</div>
	</div>
</div>


</body>
</html>
