<?php
    @session_start();

    include_once 'Core/Variables.php';
    include_once 'Core/DB.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venta</title>
    <link rel="stylesheet" type="text/css" href="<?= css ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= css ?>GeneralStyle.css">
    <script src="<?= js ?>Jquery.js"></script>
    <script src="<?= js ?>bootstrap.min.js"></script>
    <script src="<?= js ?>functions.js"></script>
</head>

<body onload="startSale();">
    <input type="hidden" id='puente'>

    <div class="MainContainer">
        <div class="HeaderForm">
            <div class="Object title">
                <h1>Caja Express</h1>
            </div>

            <div class="Object option">
                <button type="button" class="btn btn-outline-primary Normal Outline Object" onclick="window.location.href = 'opciones.php'">Opciones</button>
            </div>
        </div>
    </div>

    <div class="SearchContainer">
        <div class="SubCont Objects">
            <div class="Object">
                <center><input id="txtSearchProduct" placeholder="Buscar un producto..." type="text"
                        class="form-control form-control-sm" onkeyup="searchProduct();"></center>

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
                        <tbody id='searchResult'>
                            <!--<tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button" class="btn btn-outline-primary Normal Outline Object"
                                        data-toggle="modal" data-target="#aggModal">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button" class="btn btn-outline-primary Normal Outline Object"
                                        data-toggle="modal" data-target="#aggModal">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button" class="btn btn-outline-primary Normal Outline Object"
                                        data-toggle="modal" data-target="#aggModal">Agregar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>$1.50</td>
                                <td>10 unidades</td>
                                <td><button type="button" class="btn btn-outline-primary Normal Outline Object"
                                        data-toggle="modal" data-target="#aggModal">Agregar</button></td>
                            </tr>-->
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
                        <tbody id="addResult">
                            <!--<tr>
                                <td>Paleta</td>
                                <td>10 unidades</td>
                                <td>$1.50</td>
                                <td><button type="button" class="btn btn-outline-danger Cancel Outline Object"
                                        data-toggle="modal" data-target="#delModal">Eliminar</button></td>
                            </tr>
                            <tr>
                                <td>Paleta</td>
                                <td>10 unidades</td>
                                <td>$1.50</td>
                                <td><button type="button" class="btn btn-outline-danger Cancel Outline Object"
                                        data-toggle="modal" data-target="#delModal">Eliminar</button></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
                <h4>
                    <p id="subtotal">Subtotal: $0.00</p>
                </h4>
                <h4>
                    <p id="total">Total: $0.00</p>
                </h4>
                <button type="button" class="btn btn-outline-success Accept Outline Object" data-toggle="modal" data-target="#processPayment">Finalizar Venta</button>
                <button type="button" class="btn btn-outline-danger Cancel Outline Object" data-toggle="modal" data-target="#cancelPayment">Cancelar Venta</button>
            </div>
        </div>

    </div>



    <!--MODALES-->
    <div class="modal" id="processPayment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #00a326;">Ingrese el metodo de pago:</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-check" style="margin: 5px;">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="optradio" value="9"
                                checked onchange="pago(this);">Efectivo
                        </label>
                    </div>
                    <div class="form-check" style="margin: 5px;">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="optradio"
                                value="10" onchange="pago(this);">Tarjeta de cr&eacute;dito
                        </label>
                    </div>
                    <input type="hidden" id="fPago" value="9">
                    <center><input id="pagar" value='0' style="margin: 5px;" placeholder="Ingrese el pago recibido" type="text"
                            class="form-control form-control" onkeypress="validarPago(event);"></center>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="finalizarPago();">Finalizar Venta</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="cancelPayment">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #00a326;">Esta seguro que desea cancelar la venta</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-body" style="text-align: center;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100px;">No</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" style="width: 100px;" onclick='window.location.reload(true);'>Si</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="aggModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #00a326;">Ingrese la cantidad de productos que comprara</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <center><input id="txtCantAgg" placeholder="Ingrese la cantidad de productos" type="text"
                            class="form-control form-control" onkeypress="validarSiNumero(event);"></center>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="alterarTabla('agg');">Aceptar</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="delModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #dc3545;">Ingrese la cantidad de productos que eliminara</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <center><input id="txtCantDel" placeholder="Ingrese la cantidad de productos" type="text"
                            class="form-control form-control" onkeypress="validarSiNumero(event);"></center>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="alterarTabla('del');">Aceptar</button>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

<?php

?>