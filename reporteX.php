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
$idventa = $connection->ejecutar("select id_venta from ticket where fecha between '$fecha 00:00:00' AND '$fecha 23:59:59' AND estado = 1");

if ($idventa != 0) {
	for ($i=0; $i < count($idventa); $i++) { 
		$connection = new BaseDatos();
		$productos[] = $connection->ejecutar("select producto.nom_producto, venta_producto.cant_x_producto, producto.precio_producto, venta.total
		from venta_producto 
		inner join producto on producto.idproducto = venta_producto.id_producto
		inner join venta on venta.idventa = venta_producto.id_venta where venta.idventa = " . $idventa[$i]['id_venta'] . ";");
	
		for ($j=0; $j < count($productos[$i]); $j++) { 
			$total += (double) $productos[$i][$j]['cant_x_producto'] * $productos[$i][$j]['precio_producto'];
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

if (count($productos) > 0) {
	imprimir($productos, $fecha, $MaxTicketN, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo);
	$connection = new BaseDatos();
	$connection->ejecutar("insert into reporte(tipo_reporte, exento, gravado, nogravado, venta_neta, venta_bruta, fecha_reporte, fecha_fin_reporte, numero_ticket)
							values(1, $total, $total, 0, $total, $total, $fecha, $fechaFin, $MaxTicketN)");
}

function imprimir($productos, $fecha, $numeroTicket, $total, $fechaFin, $cantAnulados, $totalAnulados, $totaTarlCredito, $totalEfectivo)
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
	$printer->text("Reporte X\n");
	$printer->text("X $fecha - ". date("h:i:s") . "\n");
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

	$printer->text("X funciones libres\n");

	$printer->text("Efectivo N°    $ $total\n");

	$printer->text("----------------------------------\n");

	$printer->text("X productos\n");
	
	for ($i=0; $i < count($productos); $i++) { 
		for ($j=0; $j < count($productos[$i]); $j++) {
			$printer->text($productos[$i][$j]['nom_producto'] . "          " . $productos[$i][$j]['cant_x_producto'] . "\n");
			$printer->text("                                           $" . ($productos[$i][$j]['cant_x_producto'] * $productos[$i][$j]['precio_producto']) . "\n\n");
		}
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
?>