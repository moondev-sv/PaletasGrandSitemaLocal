<?php
error_reporting(0);
@$accion=$_POST['accion'];
include("Core/DB.php");
$BD = new BaseDatos();
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
		?>
		<div class="alert alert-danger" role="alert">
		  <?php echo "Error: $resultado";?>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="alert alert-success" role="alert">
		  <?php echo "Se registro el producto"; ?>
		</div>
		<?php
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
		?>
		<div class="alert alert-danger" role="alert">
		  <?php echo "Error: $resultado";?>
		</div>
		<?php
	}
	elseif($resultado==0)
	{
		?>
		<div class="alert alert-warning" role="alert">
		  <?php echo "No puede eliminar un porducto que aun esta en inventario. Reduzca su cantidad a cero";?>
		</div>
		<?php

		
	}
	else
	{
		?>
		<div class="alert alert-success" role="alert">
		  <?php echo "Se elimino el producto"; ?>
		</div>
		<?php

		
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
		?>
		<div class="alert alert-danger" role="alert">
		  <?php echo "Error: $resultado"; ?>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="alert alert-success" role="alert">
		  <?php echo "Se cambio el estado"; ?>
		</div>
		<?php

		
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
		?>
		<div class="alert alert-danger" role="alert">
		  <?php echo "Error: $resultado"; ?>
		</div>
		<?php

		
	}
	else
	{
		?>
		<div class="alert alert-success" role="alert">
		  <?php echo "Se aumento el stock"; ?>
		</div>
		<?php
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
	{
		?>
		<div class="alert alert-warning" role="alert">
		  <?php echo "No puede eliminar mas producto del existente"; ?>
		</div>
		<?php
	}
	else
	{
		$resultado=$conexion->ejecutar("UPDATE producto set cant_producto=cant_producto-$cantidad where idproducto=$idProducto");
		if(gettype($resultado)=="string")
		{
			?>
			<div class="alert alert-danger" role="alert">
			  <?php echo "Error: $resultado"; ?>
			</div>
			<?php
			
		}
		else
		{
			?>
			<div class="alert alert-success" role="alert">
			  <?php echo "Se disminuyo el stock"; ?>
			</div>
			<?php
			
		}
	}
}
// ----------------------------------FUNCIONES DE CATEGORIA----------------------
//----------------------------------------------------------
//--------------------------PARA GUARDAR UNA NUEVA CATEGORIA
//----------------------------------------------------------
if(isset($_POST["guardar"])){
	$valores[0] = "";
	$nombre = $_POST['nombre'];
	$valores[1] =$nombre;
	$valores[2] = "0";
	$campos[0] = "idcategoria";
	$campos[1] = "nom_categoria";
	$campos[2] = "estado";
	

	if ($BD->insert("categoria",$campos,$valores)==1)
	{
		echo "<script type='text/javascript'>alert('categoria guardada')</script>";
		echo "<script>document.location.href='categoria.php'</script>";
	}
	else{
		echo "<script type='text/javascript'>alert('error')</script>";
	}
}
//----------------------------------------------------------
//--------------------------PARA ELIMINAR UNA CATEGORIA
//----------------------------------------------------------
if(($_POST["bandera"])=="eliminar"){
	$res = $BD->ejecutar("UPDATE categoria SET estado = 1 WHERE idcategoria = ".$_POST['id']);
	//echo $res;
	echo 1;
	die();
}
//----------------------------------------------------------
//--------------------------PARA SELECCIONAR UN ITEM
//----------------------------------------------------------
if(($_POST["bandera"])=="obtener"){
	$id = $_POST['id'];
	$resultado = $BD->selectbyidGeneral("categoria","idcategoria",$id);
	$html.="";
	foreach ($resultado as $key => $value) {
		$html .="
		<input id='nombre_categoria' value='".$value['nom_categoria']."' required>
		<button onclick='editar(".$value['idcategoria'].")'>Actualizar</button>
	";
		# code...
	}
	
	echo $html;
	die();
}
//----------------------------------------------------------
//--------------------------PARA ACTUALIZAR
//----------------------------------------------------------
if(($_POST["bandera"])=="editar"){
	$id = $_POST['id'];
	$nombre = $_POST['nombre_categoria'];
	$respuesta = $BD->ejecutar("UPDATE categoria SET nom_categoria = '$nombre' WHERE idcategoria = $id");
	echo 1;
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
		<script src="js/functions.js"></script>
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
			
		</div><center style="color: white;"><img src="Logo.svg" height="150" width="300"><h6>Cont&aacute;ctanos: <br><br> 7504-8995 &nbsp;&nbsp;&nbsp; 
    7375-7233 &nbsp;&nbsp;&nbsp; 7482-2740<br> moondev.sv@gmail.com</h6></center>
	</body>
</html>