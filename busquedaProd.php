<?php
    @session_start();
    require_once 'Core/funcionesGenerales.php';
    require_once 'Core/DB.php';
    require_once 'ticket.php';

    if (isset($_POST['finalizaP'])) {
        $copiaDb = $_SESSION['copiaDb'];
        $ventaActual = $_SESSION['ventaActual'];

        $fPago = $_POST['formaPago'];
        $total = $_POST['pagar'];
        $recibido = $_POST['monto'];
        $fecha = date('Y-m-d h:i:s');
        
        if (((double)$recibido > $total)) {
            $cambio = $recibido - $total;
        } else {
            $cambio = 0;
        }

        $connection = new BaseDatos();
        $connection->ejecutar("INSERT INTO venta(id_formapago,total,subtotal) VALUES($fPago, $total, $total);");
        $connection = new BaseDatos();
        $idVenta = $connection->ejecutar("SELECT max(idventa) as 'id' FROM venta");

        $ultimaVenta = $idVenta[0]['id'];

        for ($i=0; $i < count($copiaDb); $i++) { 
            $connection = new BaseDatos();
            $connection->ejecutar("UPDATE producto SET cant_producto = " . $copiaDb[$i]['cant_producto'] . " WHERE idproducto = " . $copiaDb[$i]['idproducto'] . ";");
        }

        for ($i=0; $i < count($ventaActual); $i++) { 
            if ($ventaActual[$i]['cant_producto'] > 0) {
                $connection = new BaseDatos();
                $connection->ejecutar("INSERT INTO venta_producto(id_venta,id_producto,cant_x_producto) VALUES($ultimaVenta, " . $ventaActual[$i]['idproducto'] . ", " . $ventaActual[$i]['cant_producto'] . ");");
    
            }
        }

        $connection = new BaseDatos();
        $tiket = $connection->ejecutar("select * from ticket where idticket = (select max(idticket) from ticket);"); 
        $MaxTicketN = 0;
        $MaxTicketN += $tiket[0]['numero_ticket'];
        $MaxTicketN++;

        $connection = new BaseDatos();
        $connection->ejecutar("INSERT INTO ticket(estado, fecha, numero_ticket, id_venta) VALUES(1, '" . $fecha . "' , " . $MaxTicketN . ", " . $ultimaVenta . ")");
   
        imprimir($total,$cambio, $recibido, $fecha, $MaxTicketN, $ventaActual);
    }

    if (isset($_POST['cargarProductos'])) {
        @session_destroy();
        @session_start();

        $_SESSION['ventaActual'] = 0;
        $_SESSION['copiaDb'] = 0;
        $connection = new BaseDatos();
        $result = $connection->ejecutar("SELECT * FROM producto;");

        $_SESSION['copiaDb'] = ($result != 0) ? $result : 0;
        
        if ($result != 0) {
            $_SESSION['ventaActual'] = $result;

            for ($i=0; $i < count($result); $i++) { 
                $_SESSION['ventaActual'][$i]['cant_producto'] = 0;
            }
        }
    }

    if (isset($_POST['producto'])) {
        $copiaDb = $_SESSION['copiaDb'];
        $palabra = $_POST['producto'];
        $html = "";

        if ($copiaDb != 0) {     
            for ($i=0; $i < count($copiaDb); $i++) { 
                if (like_match("$palabra%", $copiaDb[$i]['nom_producto']) && $copiaDb[$i]['estado'] == 1 && $copiaDb[$i]['cant_producto'] > 0) {
                    $html .= "<tr><td>" . $copiaDb[$i]['nom_producto'] . "</td><td>$" . $copiaDb[$i]['precio_producto'] . "</td><td>" . $copiaDb[$i]['cant_producto'] . " unidades</td><td>
                    <button type='button' class='btn btn-outline-success Accept Outline Object'
                    data-toggle='modal' data-target='#aggModal' value='" . $i . "' onclick='puente(this);'>Agregar</button></td></tr>";
                }
            }

            echo $html;
        }        
    }

    if (isset($_POST['totalizar'])) {
        $ventaActual = $_SESSION['ventaActual'];
        $total = 0;

        if ($ventaActual != 0) {
            for ($i=0; $i < count($ventaActual); $i++) { 
                $total += (double) ($ventaActual[$i]['precio_producto'] * $ventaActual[$i]['cant_producto']);
            }
    
            echo $total;
        }
    }
    
    if (isset($_POST['alterarTabla'])) {
        if($_POST['alterarTabla'] == 'agg') {
            $copiaDb = $_SESSION['copiaDb'];
            $ventaActual = $_SESSION['ventaActual'];

            $cant = $_POST['cantidad'];
            $posProd = $_POST['posicionProd'];
            $html = "";

            if ($copiaDb[$posProd]['cant_producto'] - $cant < 0) {
                echo "1";
            } else {
                $copiaDb[$posProd]['cant_producto'] -= $cant;
                $ventaActual[$posProd]['cant_producto'] += $cant;
    
    
                if ($ventaActual != 0) {
                    for ($i=0; $i < count($ventaActual); $i++) { 
                        if ($ventaActual[$i]['cant_producto'] > 0) {
                            $html .= "<tr><td>" . $ventaActual[$i]['nom_producto'] . "</td><td>" . $ventaActual[$i]['cant_producto'] . " unidades</td><td>$" . ($ventaActual[$i]['precio_producto'] * $ventaActual[$i]['cant_producto']) . "</td><td><button type='button' class='btn btn-outline-danger 
                            Cancel Outline Object' data-toggle='modal' value='" . $i . "' onclick='puente(this)' data-target='#delModal'>Eliminar</button></td></tr>";
                        }
                    }
                }
    
                $_SESSION['copiaDb'] = $copiaDb;
                $_SESSION['ventaActual'] = $ventaActual;
    
                echo $html;
            }

        } else if ($_POST['alterarTabla'] == 'del') {
            $copiaDb = $_SESSION['copiaDb'];
            $ventaActual = $_SESSION['ventaActual'];

            $cant = $_POST['cantidad'];
            $posProd = $_POST['posicionProd'];
            $html = "";

            if ($ventaActual[$posProd]['cant_producto'] - $cant < 0) {
                echo "1";
            } else {
                $copiaDb[$posProd]['cant_producto'] += $cant;
                $ventaActual[$posProd]['cant_producto'] -= $cant;
    
    
                if ($ventaActual != 0) {
                    for ($i=0; $i < count($ventaActual); $i++) { 
                        if ($ventaActual[$i]['cant_producto'] > 0) {
                            $html .= "<tr><td>" . $ventaActual[$i]['nom_producto'] . "</td><td>" . $ventaActual[$i]['cant_producto'] . " unidades</td><td>$" . ($ventaActual[$i]['precio_producto'] * $ventaActual[$i]['cant_producto']) . "</td><td><button type='button' class='btn btn-outline-danger 
                            Cancel Outline Object' data-toggle='modal' value='" . $i . "' onclick='puente(this)' data-target='#delModal'>Eliminar</button></td></tr>";
                        }
                    }
                }
    
                $_SESSION['copiaDb'] = $copiaDb;
                $_SESSION['ventaActual'] = $ventaActual;
    
                echo $html;
            }
        }
    }
?>
