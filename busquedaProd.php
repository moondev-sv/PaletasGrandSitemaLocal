<?php
    require_once 'Core/DB.php';

    if (isset($_POST['producto'])) {
        $prod = $_POST['producto'];
        $connection = new BaseDatos();
        $result = $connection->ejecutar("SELECT * FROM producto WHERE nom_producto LIKE '$prod%'");
        $html = "";
        //echo $result[0]['nom_producto'];

        if ($result != 0) {     
            for ($i=0; $i < count($result); $i++) { 
                $html .= "<tr><td>" . $result[$i]['nom_producto'] . "</td><td>" . $result[$i]['pre_producto'] . "</td><td>" . $result[$i]['cant'] . " unidades</td><td>
                <button type='button' class='btn btn-outline-danger Cancel Outline Object'
                data-toggle='modal' data-target='#delModal' value='" . $result[$i]['id_producto'] . "'>Eliminar</button></td></tr>";
            }

            echo $html;
        }        
    }    
?>
