<?php
    @session_start();
    require_once 'Core/DB.php';
    $_SESSION['pruebaDB'] = 0;

    $connection = new BaseDatos();
    $result = $connection->ejecutar('SELECT * FROM producto');
    $_SESSION['pruebaDB'] = $result;

    echo "<table>";

    if ($result != 0) {
        for ($i=0; $i < count($result); $i++) { 
            echo "<tr><td>" . $result[$i]['idproducto'] . " - " . $result[$i]['nom_producto'] . "</td>
            <td>json: " . $_SESSION['pruebaDB'][$i]['idproducto'] . " - json: " . $_SESSION['pruebaDB'][$i]['nom_producto'] . "</td></tr>";
        }
    }

    echo "</table>";
?>