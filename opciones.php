<?php 

$accion=$_POST['accion'];

if($accion=="Agregar producto")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$nombre=$_POST['nombre'];
	$idCategoria=$_POST['categorias'];
	$descripcion=$_POST['descripcion'];
	$precio=$_POST['precio'];


	$resultado=$conexion->ejecutar("INSERT into producto values (null, $idCategoria, '$nombre','$descripcion',$precio,0)");

	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	else
	{
		echo "Se registro el producto";
	}
}
elseif($accion=="Eliminar producto")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$idProducto=$_POST['productosSelect'];

	$resultado=$conexion->ejecutar("DELETE from producto where id_producto=$idProducto and cantidad_producto=0");

	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	elseif($resultado==0)
	{
		echo "No puede eliminar un porducto que aun esta en inventario. Reduzca su cantidad a cero";
	}
	else
	{
		echo "Se elimino el producto";
	}
}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>*</title>

	<script src="js/Jquery.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/inventario.js"></script>
	

</head>

<body style="background: #34495E;">	
	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.cuerpo{height: 280px; background:#F4F6F6;}
		.barra{height: 80px;background:#E5E8E8;}

	</style>	

	<!--Barra de menu opciones-->
	<?php include("Menus/menuinventario.php"); ?>

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
