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
                    data-toggle='modal' data-target='#aggModal' value='" . $i . "'>Agregar</button></td></tr>";
                }
            }

            echo $html;
        }        
    }
    
    if (isset($_POST['agregarProducto'])) {
        # code...
    }

    if (isset($_POST['cerrarSesion'])) {
        @session_destroy();
    }
?>
