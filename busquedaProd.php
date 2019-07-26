<?php
    @session_start();
    require_once 'Core/funcionesGenerales.php';
    require_once 'Core/DB.php';

    if (isset($_POST['cargarProductos'])) {
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
                if (like_match("$palabra%", $copiaDb[$i]['nom_producto'])) {
                    $html .= "<tr><td>" . $copiaDb[$i]['nom_producto'] . "</td><td>$" . $copiaDb[$i]['precio_producto'] . "</td><td>" . $copiaDb[$i]['cant_producto'] . " unidades</td><td>
                    <button type='button' class='btn btn-outline-success Accept Outline Object'
                    data-toggle='modal' data-target='#aggModal' value='" . $i . "' onclick='puente(this);'>Agregar</button></td></tr>";
                }
            }

            echo $html;
        }        
    }
    
    if (isset($_POST['alterarTabla'])) {
        if($_POST['alterarTabla'] == 'agg') {
            $copiaDb = $_POST['copiaDb'];
            $ventaActual = $_POST['ventaActual'];

            $cant = $_POST['cantidad'];
            $posProd = $_POST['posicionProd'];
            $html = "";

            $copiaDb[$posProd]['cant_producto'] -= $cant;
            $ventaActual[$posProd]['cant_producto'] += $cant;

            if ($ventaActual != 0) {
                for ($i=0; $i < count($ventaActual); $i++) { 
                    if ($ventaActual[$i]['cant_producto'] > 0) {
                        $html .= "<tr><td>" . $ventaActual[$i]['nom_producto'] . "</td><td>" . $ventaActual[$i]['cant_producto'] . " unidades</td><td>$1.50</td><td><button type='button' class='btn btn-outline-danger 
                        Cancel Outline Object' data-toggle='modal' value='" . $i . "' onclick='puente(this)' data-target='#delModal'>Eliminar</button></td></tr>";
                    }
                }
            }

            $_POST['copiaDb'] = $copiaDb;
            $_POST['ventaActual'] = $ventaActual;

            echo $html;
        }
    }

    if (isset($_POST['cerrarSesion'])) {
        @session_destroy();
    }


    


?>
