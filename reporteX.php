<?php
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
	Esta funcion imprime un
	ticket de reporte X desde una impresora térmica
*/

function imprimir($total,$cambio, $recibido, $fecha, $numeroTicket, $ventaActual)
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
	$printer->text("X $rangoTiempo\n");
	$printer->text("----------------------------------"."\n");


	$printer->text("Venta bruta    $numeroProductos\n");
	$printer->text("               $ventaBruta\n");

	$printer->text("Venta neta  N° $numeroQueNoSeDeDondeSale\n");
	$printer->text("               $ventaNeta\n");

	$printer->text("Efectivo Gav   $efectivoGav\n");

	$printer->text("Credito        $sinAsignar\n");

	$printer->text("Cheque         $sinAsignar\n");

	$printer->text("Tarj/credito   $sinAsignar\n");

	$printer->text("Tarj/debito    $sinAsignar\n");

	$printer->text("Crid(3)        $sinAsignar\n");

	$printer->text("Crid(4)        $sinAsignar\n");

	$printer->text("----------------------------------\n");

	$printer->text("Devolucion N°  $numeroDevolucion\n");
	$printer->text("               $devolucion\n");

	$printer->text("Cubiertos CT   $numeroCubiertos\n");
	
	$printer->text("Anula ticket N° $numeroAnulados\n");
	$printer->text("               $anulados\n");

	$printer->text("----------------------------------\n");

	$printer->text("TOTAL          $total\n");
	$printer->text("TOTAL EXENTO   $totalExento\n");
	$printer->text("TOTAL Gravado  $total\n");
	$printer->text("TOTAL NOSUJETO $total\n");

	$printer->text("----------------------------------\n");

	$printer->text("X funciones libres\n");

	$printer->text("Numero que no se de donde sale\n");

	$printer->text("Efectivo N°    $numeroEfectivo\n");
	$printer->text("               $efectivo\n");

	$printer->text("Corr     N°    $numeroCorr\n");
	$printer->text("               $corr\n");

	$printer->text("----------------------------------\n");

	$printer->text("X productos\n");

	$printer->text("Numero que no se de donde sale\n");
	

	for ($i=0; $i < 0; $i++)
	{
		//este for recorrera lo devuelto por la DB e imprimira los productos vendidos junto a su cantidad y precio
	}

	$printer->text("----------------------------------\n");

	$printer->text("Total          $numeroTotal\n");
	$printer->text("               $totalProcutosVendidos\n");

	$printer->text("----------------------------------\n");

	$printer->text("X DEPTOS\n");
	$printer->text("               $idDepto\n");

	$printer->text("----------------------------------\n");

	$printer->text("X CAJA/EMPLEADO\n");
	$printer->text("               $idEmpleado\n");

	$printer->text("C03 ...........1\n");

	$printer->text("Venta bruta    $numeroProductos\n");
	$printer->text("               $ventaBruta\n");

	$printer->text("Venta neta  N° $numeroQueNoSeDeDondeSale\n");
	$printer->text("               $ventaNeta\n");

	$printer->text("Efectivo Gav   $efectivoGav\n");

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