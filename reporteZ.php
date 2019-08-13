<?php
require_once "Core/DB.php";
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
	Esta funcion imprime un
	ticket de reporte X desde una impresora térmica
*/

$connection = new BaseDatos();
$tiket = $connection->ejecutar("select * from ticket where idticket = (select max(idticket) from ticket);"); 
$connection = new BaseDatos();
$tiketR = $connection->ejecutar("select * from reporte where idreporte = (select max(idreporte) from reporte);");
$MaxTicketN = 0;

if ((double) $tiket[0]['numero_ticket'] > $tiketR[0]['numero_ticket']) {
	$MaxTicketN += $tiket[0]['numero_ticket'];
} else {
	$MaxTicketN += $tiketR[0]['numero_ticket'];
}

$MaxTicketN++;

//echo $MaxTicketN . "<br>";
$fecha = $_POST['fecha'];

if (isset($_POST['reporteZ'])) {
	$fechaFin = $_POST['fecha_fin'];
} else {
	$fechaFin = $_POST['fecha'];
}

$productos;
$total = 0;

$connection = new BaseDatos();
$idventa = $connection->ejecutar("select id_venta from ticket where fecha between '$fecha 00:00:00' AND '$fechaFin 23:59:59' AND estado = 1");

if ($idventa != 0) {
	$connection = new BaseDatos();
	for ($i=0; $i < count($idventa); $i++) { 

		$productos[] = $connection->ejecutar("SELECT producto.nom_producto, venta_producto.cant_x_producto, producto.precio_producto, venta.total, producto.idproducto
		from venta_producto 
		inner join producto on producto.idproducto = venta_producto.id_producto
		inner join venta on venta.idventa = venta_producto.id_venta where venta.idventa = " . $idventa[$i]['id_venta'] . ";");
	
		for ($j=0; $j < count($productos[$i]); $j++) { 
			$total += (double) $productos[$i][$j]['cant_x_producto'] * $productos[$i][$j]['precio_producto'];
		}
	}

	//Esta variable guarda los productos ya de forma compacta para su facil impresion en un reporte
	$productosFormateados;

	//este for se encarga de ordenar los productos del mismo tipo en un solo espacio del array
	for($i=0; $i<count($productos); $i++)
	{
		for($j=0; $j<count($productos[$i]); $j++)
		{
			if(@array_key_exists($productos[$i][$j][idproducto], $productosFormateados))
			{
				$productosFormateados[$productos[$i][$j][idproducto]][cant_x_producto]+=$productos[$i][$j][cant_x_producto];
			}
			else
			{
				$productosFormateados[$productos[$i][$j][idproducto]]= array(
						"nom_producto" => $productos[$i][$j][nom_producto],
						"cant_x_producto" => $productos[$i][$j][cant_x_producto],
						"precio_producto" => $productos[$i][$j][precio_producto]
					);
			}
		}
	}
}



$connection = new BaseDatos();
$idventa = $connection->ejecutar("select id_venta from ticket where fecha between '$fecha 00:00:00' AND '$fecha 23:59:59' AND estado = 0");
$totalAnulados = 0;
$cantAnulados = 0;

if ($idventa != 0) {
	$cantAnulados = count($idventa);

	for ($i=0; $i < count($idventa); $i++) { 
		$connection = new BaseDatos();
		$productosAnulados[] = $connection->ejecutar("select producto.nom_producto, venta_producto.cant_x_producto, producto.precio_producto, venta.total
		from venta_producto 
		inner join producto on producto.idproducto = venta_producto.id_producto
		inner join venta on venta.idventa = venta_producto.id_venta where venta.idventa = " . $idventa[$i]['id_venta'] . ";");
	
		for ($j=0; $j < count($productosAnulados[$i]); $j++) { 
			$totalAnulados += (double) $productosAnulados[$i][$j]['total'];
		}
	}
}
$connection = new BaseDatos();
$idventa = $connection->ejecutar("select * from venta where id_formapago = 9");
$totalEfectivo = 0;

if ($idventa != 0) {
	
for ($i=0; $i < count($idventa); $i++) { 
	$totalEfectivo += (double) $idventa[$i]['total'];
}

}

$connection = new BaseDatos();
$idventa = $connection->ejecutar("select * from venta where id_formapago = 10");
$totaTarlCredito = 0;

if ($idventa != 0) {
	for ($i=0; $i < count($idventa); $i++) { 
		$totaTarlCredito += (double) $idventa[$i]['total'];
	}
}


$connection = new BaseDatos();
$tickets = $connection->ejecutar("select ticket.numero_ticket, venta.total from ticket 
								inner join venta on venta.idventa = ticket.id_venta 
								where fecha between '$fecha 00:00:00' AND '$fechaFin 23:59:59' AND estado = 1");

if (count($productos) > 0) {
	if(isset($_POST['imprimirPantalla']))
	{
		imprimirPantalla($productosFormateados, $fecha, $MaxTicketN, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo, $tickets);
	}
	else
	{
		imprimir($productosFormateados, $fecha, $MaxTicketN, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo, $tickets);
		$connection = new BaseDatos();
		$connection->ejecutar("insert into reporte(tipo_reporte, exento, gravado, nogravado, venta_neta, venta_bruta, fecha_reporte, fecha_fin_reporte, numero_ticket)
							values(1, $total, $total, 0, $total, $total, $fecha, $fechaFin, $MaxTicketN)");
	}
	
}

function imprimir($productosFormateados, $fecha, $numeroTicket, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo, $tickets)
{
	$nombre_impresora = "LR2000"; 

	$connector = new WindowsPrintConnector($nombre_impresora);
	$printer = new Printer($connector);
	#Mando un numero de respuesta para saber que se conecto correctamente.
	echo 1;
	/*--
		Vamos a imprimir un logotipo
		opcional. Recuerda que esto
		no funcionará en todas las
		impresoras

		Pequeña nota: Es recomendable que la imagen no sea
		transparente (aunque sea png hay que quitar el canal alfa)
		y que tenga una resolución baja. En mi caso
		la imagen que uso es de 250 x 250
	*/

	# Vamos a alinear al centro lo próximo que imprimamos
	$printer->setJustification(Printer::JUSTIFY_CENTER);

	/*
		Intentaremos cargar e imprimir
		el logo
	*/
	try{
		$logo = EscposImage::load("geek.png", false);
		$printer->bitImage($logo);
	}catch(Exception $e){/*No hacemos nada si hay error*/}

	/*
		Ahora vamos a imprimir un encabezado
	*/

	$printer->text("\n"."|TICKET Nª: " . $numeroTicket . "\n\n\n");
	$printer->text("\n"."|GRACIELA Y ANDREA S.A DE .CV" . "\n");
	$printer->text("|GRAND BE NATURAL" . "\n");
	$printer->text("|NRC: 252757-0" . "\n");
	$printer->text("|NIT: 0210-190716-101-1" . "\n");
	$printer->text("|Giro: Venta al por menor" . "\n|\n");
	$printer->text("|Resolucion:15041-RES-CR-41514-2019" . "\n");
	$printer->text("|Autorizado: 24/07/2019" . "\n");
	$printer->text("|Del: 19AS00200002I1" . "\n");
	$printer->text("|Al: 19AS00200002I150000" . "\n|\n|\n");
	$printer->text("|GRAND BE NATURAL" . "\n");
	$printer->text("|local fc-4, pabellon int n°5" . "\n");
	$printer->text("|centro internacional de ferias y convenciones" . "\n|\n");
	$printer->text("|san salvador, san salvador" . "\n|\n|\n");

	#La fecha también
	$printer->text($fecha . "\n");
	$printer->setJustification(Printer::JUSTIFY_LEFT);

	/*Empezamos el reporte X*/
	$printer->text("----------------------------------"."\n");
	$printer->text("Reporte Z\n");
	$printer->text("Z $fecha - ". date("h:i:s") . "\n");
	$printer->text("----------------------------------"."\n");


	$printer->text("Venta bruta    $  $total\n");

	$printer->text("Venta neta     $ $total\n");

	$printer->text("Efectivo Gav   $ $total\n");

	$printer->text("Credito        $ 0.00\n");

	$printer->text("Cheque         $ 0.00\n");

	$printer->text("Tarj/credito   $ $totaTarlCredito\n");

	$printer->text("Tarj/debito    $ 0.00\n");

	$printer->text("Crid(3)        $ 0.00\n");

	$printer->text("Crid(4)        $ 0.00\n");

	$printer->text("----------------------------------\n");
	
	$printer->text("Anula ticket N° $cantAnulados\n");
	$printer->text("               $totalAnulados\n");

	$printer->text("----------------------------------\n");

	$printer->text("TOTAL          $total\n");
	$printer->text("TOTAL EXENTO   $total\n");
	$printer->text("TOTAL Gravado  $total\n");

	$printer->text("----------------------------------\n");

	$printer->text("Z funciones libres\n");

	$printer->text("Efectivo N°    $ $total\n");

	$printer->text("----------------------------------\n");

	for ($i=0; $i < count($tickets); $i++) { 
		$printer->text("N° Ticket". $tickets[$i]['numero_ticket'] . "			    " . $tickets[$i]['total'] . "\n");
	}

	$printer->text("----------------------------------\n");

	$printer->text("Z productos\n");

	foreach ($productosFormateados as $auxProducto) {
		$printer->text($auxProducto['nom_producto'] . "          " . $auxProducto['cant_x_producto'] . "\n");
			$printer->text("                                           $" . ($auxProducto['cant_x_producto'] * $auxProducto['precio_producto']) . "\n\n");
	}

	$printer->text("----------------------------------\n");

	$printer->text("Total          $total\n");

	$printer->text("----------------------------------\n");

	$printer->text("Venta bruta    $ $total\n");

	$printer->text("Venta neta  N° $ $total\n");

	$printer->text("Efectivo Gav   $ $total\n");

	/*
		Podemos poner también un pie de página
	*/
	//$printer->setJustification(Printer::JUSTIFY_CENTER);
	//$printer->text("Muchas gracias por su compra\n");



	/*Alimentamos el papel 3 veces*/
	$printer->feed(3);

	/*
		Cortamos el papel. Si nuestra impresora
		no tiene soporte para ello, no generará
		ningún error
	*/
	$printer->cut();

	/*
		Por medio de la impresora mandamos un pulso.
		Esto es útil cuando la tenemos conectada
		por ejemplo a un cajón
	*/
	/*$printer->pulse();*/

	/*
		Para imprimir realmente, tenemos que "cerrar"
		la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
	*/
	$printer->close();
}

function imprimirPantalla($productosFormateados, $fecha, $numeroTicket, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo, $tickets)
{


	/*
		Ahora vamos a imprimir un encabezado
	*/

	print("<br>"."|TICKET Nª: " . $numeroTicket . "<br><br><br>");
	print("<br>"."|GRACIELA Y ANDREA S.A DE .CV" . "<br>");
	print("|GRAND BE NATURAL" . "<br>");
	print("|NRC: 252757-0" . "<br>");
	print("|NIT: 0210-190716-101-1" . "<br>");
	print("|Giro: Venta al por menor" . "<br>|<br>");
	print("|Resolucion:15041-RES-CR-41514-2019" . "<br>");
	print("|Autorizado: 24/07/2019" . "<br>");
	print("|Del: 19AS00200002I1" . "<br>");
	print("|Al: 19AS00200002I150000" . "<br>|<br>|<br>");
	print("|GRAND BE NATURAL" . "<br>");
	print("|local fc-4, pabellon int n°5" . "<br>");
	print("|centro internacional de ferias y convenciones" . "<br>|<br>");
	print("|san salvador, san salvador" . "<br>|<br>|<br>");

	#La fecha también
	print($fecha . "<br>");
	/*Empezamos el reporte X*/
	print("----------------------------------"."<br>");
	print("Reporte Z<br>");
	print("Z $fecha - ". date("h:i:s") . "<br>");
	print("----------------------------------"."<br>");


	print("Venta bruta    $  $total<br>");

	print("Venta neta     $ $total<br>");

	print("Efectivo Gav   $ $total<br>");

	print("Credito        $ 0.00<br>");

	print("Cheque         $ 0.00<br>");

	print("Tarj/credito   $ $totaTarlCredito<br>");

	print("Tarj/debito    $ 0.00<br>");

	print("Crid(3)        $ 0.00<br>");

	print("Crid(4)        $ 0.00<br>");

	print("----------------------------------<br>");
	
	print("Anula ticket N° $cantAnulados<br>");
	print("               $totalAnulados<br>");

	print("----------------------------------<br>");

	print("TOTAL          $total<br>");
	print("TOTAL EXENTO   $total<br>");
	print("TOTAL Gravado  $total<br>");

	print("----------------------------------<br>");

	print("Z funciones libres<br>");

	print("Efectivo N°    $ $total<br>");

	print("----------------------------------<br>");

	for ($i=0; $i < count($tickets); $i++) { 
		print("N° Ticket". $tickets[$i]['numero_ticket'] . "			    " . $tickets[$i]['total'] . "<br>");
	}

	print("----------------------------------<br>");

	print("Z productos<br>");

	foreach ($productosFormateados as $auxProducto) {
		print($auxProducto['nom_producto'] . "          " . $auxProducto['cant_x_producto'] . "<br>");
			print("                                           $" . ($auxProducto['cant_x_producto'] * $auxProducto['precio_producto']) . "<br><br>");
	}

	print("----------------------------------<br>");

	print("Total          $total<br>");

	print("----------------------------------<br>");

	print("Venta bruta    $ $total<br>");

	print("Venta neta  N° $ $total<br>");

	print("Efectivo Gav   $ $total<br>");

	/*
		Podemos poner también un pie de página
	*/
	//$printer->setJustification(Printer::JUSTIFY_CENTER);
	//print("Muchas gracias por su compra<br>");

}
?>