<?php

$accion=$_POST['accion'];

if($accion=="obtenerCategorias")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from categoria");

	echo json_encode($resultado);
}
elseif($accion=="obtenerProductosctivos")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from producto where estado=1");

	echo json_encode($resultado);
}
elseif($accion=="obtenerVentasTotales")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from producto where estado=1");

	echo json_encode($resultado);
}


?>