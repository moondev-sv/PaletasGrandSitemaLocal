<?php

$accion=$_POST['accion'];

if($accion=="obtenerCategorias")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from categoria WHERE estado = 0");

	echo json_encode($resultado);
}
elseif($accion=="obtenerProductosctivos")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$resultado=$conexion->ejecutar("SELECT * from producto where estado=1");

	echo json_encode($resultado);
}
elseif($accion=="obtenerProductos")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$resultado=$conexion->ejecutar("SELECT producto.*,categoria.nom_categoria FROM producto inner join categoria on categoria.idcategoria = producto.cat_producto where producto.estado=1 ORDER BY producto.nom_producto ASC");

	if($resultado==0)
		echo "<tr><td colspan='7'>No hay ventas este día</td></tr>";
	else
	{
		foreach ($resultado as $key) {
			echo "	<tr><td>".$key['nom_producto']."</td>
					<td>".$key['nom_categoria']."</td>
					<td>".$key['cant_producto']."</td>
					<td>$".$key['precio_producto']."</td>";
			
			echo "<td><button class='btn btn-info' data-toggle='modal' data-target='#opcionesProductosModal'
					onclick='colocarIdProducto(".$key['idproducto'].")'>Opciones</button></td></tr>";
		}
	}
}
elseif($accion=="obtenerVentasTotales")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$fecha=$_POST['fecha'];

	$resultado=$conexion->ejecutar("SELECT T.numero_ticket,T.fecha,V.subtotal,V.total,FP.descripcion,T.estado,T.idticket FROM venta as V inner join forma_pago as FP on FP.idforma_pago = V.id_formapago inner join ticket as T on T.id_venta= V.idventa where Date(T.fecha)='$fecha' ");


	if($resultado==0)
		echo "<tr><td colspan='7'>No hay ventas este día</td></tr>";
	else
	{
		foreach ($resultado as $key) {
			echo "	<tr><td>".$key['numero_ticket']."</td>
					<td>".$key['fecha']."</td>
					<td>$".$key['subtotal']."</td>
					<td>$".$key['total']."</td>
					<td>".$key['descripcion']."</td>
					<td>";
			switch($key['estado'])
			{
				case 0:
					echo "Anulado";
					break;
				case 1:
					echo "Activo";
					break;
			} 
			echo "</td>";
			echo "<td><button class='btn btn-info' data-toggle='modal' data-target='#cambiarEstadoTicketModal'
					data-mod='' onclick='asignarIdTicket(".$key['idticket'].")'>Cambiar estado</button></td></tr>";
		}
	}
}
elseif($accion=="obtenerVentasTotalesRangoFechas")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];

	$resultado=$conexion->ejecutar("SELECT T.numero_ticket,T.fecha,V.subtotal,V.total,FP.descripcion,T.estado,T.idticket FROM venta as V inner join forma_pago as FP on FP.idforma_pago = V.id_formapago inner join ticket as T on T.id_venta= V.idventa where Date(T.fecha)>='$fechaInicial' and Date(T.fecha)<='$fechaFinal' ");


	if($resultado==0)
		echo "<tr><td colspan='7'>No hay ventas en este rango de fechas</td></tr>";
	else
	{
		foreach ($resultado as $key) {
			echo "	<tr><td>".$key['numero_ticket']."</td>
					<td>".$key['fecha']."</td>
					<td>$".$key['subtotal']."</td>
					<td>$".$key['total']."</td>
					<td>".$key['descripcion']."</td>
					<td>";
			switch($key['estado'])
			{
				case 0:
					echo "Activo";
					break;
				case 1:
					echo "Anulado";
					break;
				case 2:
					echo "Devolucion";
					break;
			} 
			echo "</td>";
			echo "<td><button class='btn btn-info' data-toggle='modal' data-target='#cambiarEstadoTicketModal'
					data-mod='' onclick='asignarIdTicket(".$key['idticket'].")'>Cambiar estado</button></td></tr>";
		}
	}
}

/****************************************** */
elseif($accion=="obtenerProductosTotales")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$fecha=$_POST['fecha'];

	$resultado=$conexion->ejecutar("SELECT  * FROM `producto` INNER JOIN venta_producto ON producto.idproducto = venta_producto.id_producto INNER JOIN venta ON venta.idventa = venta_producto.id_venta INNER JOIN ticket ON venta.idventa = ticket.id_venta where Date(ticket.fecha)='$fecha' ");


	if($resultado==0)
		echo "<tr><td colspan='7'>No hay ventas de productos ese dia</td></tr>";
	else
	{
		foreach ($resultado as $key) {
			echo "<tr>
			<td>".$key['idproducto']."</td>
			<td>".$key['nom_producto']."</td>
			<td>".$key['cant_producto']."</td>
			<td>".$key['cant_x_producto']."</td>
			<td>$".$key['precio_producto']."</td>
			<td>$".$key['cant_producto']." x ".$key['precio_producto']."</td>
			<td>$".$key['cant_x_producto']." x  ".$key['precio_producto']."</td></td>
		</tr>";
			
		}
	}
}

elseif($accion=="obtenerProcutosTotalesRangoFechas")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$fechaInicial=$_POST['fechaInicial'];
	$fechaFinal=$_POST['fechaFinal'];

	$resultado=$conexion->ejecutar("SELECT  * FROM `producto` INNER JOIN venta_producto ON producto.idproducto = venta_producto.id_producto INNER JOIN venta ON venta.idventa = venta_producto.id_venta INNER JOIN ticket ON venta.idventa = ticket.id_venta where Date(ticket.fecha)>='$fechaInicial' and Date(ticket.fecha)<='$fechaFinal' ");

	if($resultado==0)
		echo "<tr><td colspan='7'>No hay ventas en este rango de fechas</td></tr>";
	else
	{
		foreach ($resultado as $key) {
			echo "<tr>
			<td>".$key['idproducto']."</td>
			<td>".$key['nom_producto']."</td>
			<td>".$key['cant_producto']."</td>
			<td>".$key['cant_x_producto']."</td>
			<td>$".$key['precio_producto']."</td>
			<td>$".$key['cant_producto']*$key['precio_producto']."</td>
			<td>$ ".$key['cant_x_producto']*$key['precio_producto']."</td></td>
		</tr>";
			
		}
	}
}
?>