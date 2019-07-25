<?php

$accion=$_POST['accion'];

if($accion=="obtenerCategorias")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from categoria");

	echo json_encode($resultado);
}
elseif($accion=="obtenerProductos")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from producto");

	echo json_encode($resultado);
}



?>