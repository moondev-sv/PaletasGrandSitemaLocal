<?php
    include_once 'Core/Variables.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="<?= css ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= css ?>GeneralStyle.css">
    <script src="<?= js ?>Jquery.js"></script>
    <script src="<?= js ?>bootstrap.min.js"></script>
</head>

<body>
    <div class="MainContainer">
        <div class="HeaderForm">
            <div class="Object title">
                <h1>Caja Express</h1>
            </div>

            <div class="Object option">
                <button type="button" class="btn btn-outline-primary Normal Outline Object">Opciones</button>
            </div>
        </div>
    </div>

    <div class="SearchContainer">
        <div class="SubCont Objects">
            <div class="Object">
                <center><input id="txtSearchProduct" placeholder="Buscar un producto..." type="text"
                    class="form-control form-control-sm"></center>

                <div class="Table InfoProduct" style="margin-top: 25px;">
                    <h1>Productos Agregados</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad disponible</th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button"
                                        class="btn btn-outline-primary Normal Outline Object">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button"
                                        class="btn btn-outline-primary Normal Outline Object">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button"
                                        class="btn btn-outline-primary Normal Outline Object">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button"
                                        class="btn btn-outline-primary Normal Outline Object">Agregar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="SubCont Sell">

            <div class="Object">
                <div class="Table InfoProduct" style="margin-top: 25px;">
                    <h1>Productos Agregados</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cant</th>
                                <th>sub</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paleta</td>
                                <td>10 unidades</td>
                                <td>$1.50</td>
                                <td><button type="button"
                                        class="btn btn-outline-danger Cancel Outline Object">Eliminar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>10 unidades</td>
                                <td>$1.50</td>
                                <td><button type="button"
                                        class="btn btn-outline-danger Cancel Outline Object">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4>
                    <p>Subtotal: $0.00</p>
                </h4>
                <h4>
                    <p>Total: $0.00</p>
                </h4>
                <button type="button" class="btn btn-outline-success Accept Outline Object">Finalizar Venta</button>
                <button type="button" class="btn btn-outline-danger Cancel Outline Object">Cancelar Venta</button>
            </div>
        </div>

    </div>
</body>

</html>