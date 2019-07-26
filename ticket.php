<?php


require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
    Aquí, en lugar de "POS" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
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
	$printer->text("----------------------------------"."\n");
	$printer->text("CANT  DESCRIPCION    P.U    TOTAL.\n");
	$printer->text("----------------------------------"."\n");
	/*
		Ahora vamos a imprimir los
		productos
	*/
		$printer->setJustification(Printer::JUSTIFY_LEFT);
	for ($i=0; $i < count($ventaActual); $i++) { 
		if ($ventaActual[$i]['cant_producto'] > 0) {
			$printer->text($ventaActual[$i]['nom_producto'] . "\n");
			$printer->text( $ventaActual[$i]['cant_producto'] . "  pieza    $" . $ventaActual[$i]['precio_producto'] . " $" . ($ventaActual[$i]['precio_producto'] * $ventaActual[$i]['cant_producto']) . "   \n");
		}
	}
	/*
		Terminamos de imprimir
		los productos, ahora va el total
	*/
	$printer->text("-----------------------------"."\n");
	$printer->setJustification(Printer::JUSTIFY_RIGHT);
	$printer->text("RECIBIDO: $" . $recibido . "\n");
	$printer->text("CAMBIO: $" . $cambio . "\n");
	$printer->text("SUBTOTAL: $" . $total . "\n");
	$printer->text("IVA: $00.00\n");
	$printer->text("TOTAL: $" . $total . "\n");


	/*
		Podemos poner también un pie de página
	*/
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("Muchas gracias por su compra\n");



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