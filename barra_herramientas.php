<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--estilos contenedores-->
	<style type="text/css">
		.barra{height: 80px;background:#E5E8E8;}
	</style>

	</div>
	<!--Barra de menu opciones-->
	<div class="container">
	<div class="form-row text-center">
		<div class="col-3 barra">
		</div>

		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reportes
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    				<a class="dropdown-item" href="ventas.php">Productos Vendidos</a>
    				<a class="dropdown-item" href="vent-total.php">Ventas Totales</a>
    			</div>
			</div>
		</div>

		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Inventario
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="categoria.php">Agregar categoria</a>
					<a class="dropdown-item" href="addproducto.php">Agregar Producto</a>
    			<a class="dropdown-item" href="productos.php">Productos</a>

    			</div>
			</div>
		</div>

		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Caja
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    				<a class="dropdown-item" href="reportes.php">Reportes Z, X</a>
    				<a class="dropdown-item" href="admincaja.php">Operaciones caja</a>
    			</div>
			</div>
		</div>

		<div class="col-3 py-3 barra">
			<a href="index.php" class="btn btn-primary btn-lg">Listo</a>
		</div>
	</div>
	</div>

</body>
</html>
