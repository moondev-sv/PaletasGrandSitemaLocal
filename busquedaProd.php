<?php
    @session_start();
    require_once 'Core/DB.php';
    $_SESSION['ventaActual'] = 0;

    if (isset($_POST['cargarProductos'])) {
        $connection = new BaseDatos();
        $result = $connection->ejecutar("SELECT * FROM producto;");

        $_SESSION['ventaActual'] = ($result != 0) ? $result : 0; 
    }

    if (isset($_POST['producto'])) {
        $prod = $_POST['producto'];
        $connection = new BaseDatos();
        $result = $connection->ejecutar("SELECT * FROM producto WHERE nom_producto LIKE '$prod%'");
        $html = "";
        //echo $result[0]['nom_producto'];

        if ($result != 0) {     
            for ($i=0; $i < count($result); $i++) { 
                $html .= "<tr><td>" . $result[$i]['nom_producto'] . "</td><td>$" . $result[$i]['precio_producto'] . "</td><td>" . $result[$i]['cant_producto'] . " unidades</td><td>
                <button type='button' class='btn btn-outline-success Accept Outline Object'
                data-toggle='modal' data-target='#aggModal' value='" . $result[$i]['idproducto'] . "'>Agregar</button></td></tr>";
            }

            echo $html;
        }        
    }    
?>
