<?php
@$accion=$_POST['accion'];

if($accion=="Agregar producto")
{
	require_once('Core/DB.php');
	$conexion=new BaseDatos();
	$nombre=$_POST['nombre'];
	$idCategoria=$_POST['categorias'];
	$precio=$_POST['precio'];
	$cantidad=$_POST['cantidad'];
	$resultado=$conexion->ejecutar("INSERT into producto values (null, '$nombre', $idCategoria,$precio,$cantidad, 1)");
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
	$idProducto=$_POST['idProductoEliminar'];
	$resultado=$conexion->ejecutar("UPDATE producto set estado=0 where idproducto=$idProducto");
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
elseif($accion=="Cambiar estado")
{
	require_once('Core/DB.php');
	$conexion=new BaseDatos();
	$estadoTicket=$_POST['estadoTicket'];
	$idTicket=$_POST['idTicketHidden'];
	$resultado=$conexion->ejecutar("UPDATE ticket set estado=$estadoTicket where idticket=$idTicket");
	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	else
	{
		echo "Se cambio el estado";
	}
}
elseif($accion=="Aumentar stock")
{
	require_once('Core/DB.php');
	$conexion=new BaseDatos();
	$idProducto=$_POST['idProductoAumentar'];
	$cantidad=$_POST['cantidadAgregarProducto'];
	$resultado=$conexion->ejecutar("UPDATE producto set cant_producto=cant_producto+$cantidad where idproducto=$idProducto");
	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	else
	{
		echo "Se aumento el stock";
	}
}
elseif($accion=="Disminuir stock")
{
	require_once('Core/DB.php');
	$conexion=new BaseDatos();
	$idProducto=$_POST['idProductoDisminuir'];
	$cantidad=$_POST['cantidadDisminuirProducto'];
	$resultado=$conexion->ejecutar("SELECT cant_producto from producto where idproducto=$idProducto");

	if($resultado[0]['cant_producto']<$cantidad)
		echo "No puede eliminar mnas producto del existente";
	else
	{
		$resultado=$conexion->ejecutar("UPDATE producto set cant_producto=cant_producto-$cantidad where idproducto=$idProducto");
		if(gettype($resultado)=="string")
		{
			echo "Error: $resultado";
		}
		else
		{
			echo "Se disminuyo el stock";
		}
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
		<title>Inventario</title>
		<script src="js/Jquery.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/inventario.js"></script>
	</head>
	<body style="background: #34495E;" onload="obtenerProductos()">
		<!--estilos contenedores-->
		<style type="text/css">
			.encabezado{height: 80px; background: #34495E;}
			.cuerpo{height: 280px; background:#F4F6F6;}
			.barra{height: 80px;background:#E5E8E8;}
		</style>
		<!--Barra de menu opciones-->
		<?php include("Menus/menuInventario.php"); ?>
		<!--seccion de la tabla de reportes-->
		<br><br>
		<div class="container" style="background-color: white;">
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Producto</th>
						<th>Categoria</th>
						<th>Cantidad Producto</th>
						<th>Precio Unitario</th>
						<th></th>
					</tr>
				</thead>
				<tbody id='btblProductos'>
					
				</tbody>
			</table>
			
		</div>
	</body>
</html>