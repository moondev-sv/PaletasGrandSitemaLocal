<script src="js/inventario.js"></script>
<div class="container">
    <div class="form-row text-center">
        <div class="col-2 py-3 barra">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reportes
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                    <button class="btn btn-info dropdown-item" data-toggle="modal"
                        data-target="#reporteProductosVendidos" onclick="obtenerProductosVendidosInicial()">Productos
                        Vendidos</button>

                    <button class="btn btn-info dropdown-item" data-toggle="modal" data-target="#reporteDeVentasModal"
                        onclick="obtenerVentasTotalesInicial()">Ventas Totales</button>

                </div>
            </div>
        </div>
        <!-- Modal para impresiones en pantalla -->
        <div class="modal fade" id="impresionesPantallaModal" tabindex="-1" role="dialog"
            aria-labelledby="modal para imprimir en pantalla" aria-hidden="true" style="overflow-y: scroll;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Impresion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="impresionPantallaDiv">
                           

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para reportes de productos vendidos -->
        <div class="modal fade" id="reporteProductosVendidos" tabindex="-1" role="dialog"
            aria-labelledby="modal para reportes de ventas totales" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reporte de productos vendidos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="Table InfoProduct" style="margin-top: 25px;">
                                <h1>Productos Vendidos</h1>
                                <label for="filtroDiaInicial2">
                                    Filtro de fechas:&nbsp;
                                    <input type="date" name="filtroDiaInicial2" id="filtroDiaInicial2" value=""
                                        class="form-control">
                                </label>
                                <label for="filtroDiaFinal2" id="filtroDiaFinalLabel2" class="d-none">&nbsp;-&nbsp;
                                    <input type="date" name="filtroDiaFinal2" id="filtroDiaFinal2" class="form-control">
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="rangoHoras2">
                                    <input type="checkbox" name="rangoHoras2" id="rangoHoras2"
                                        onclick="alternarFiltro2()" class="form-check-input">
                                    Rango de fechas
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button onclick="obtenerProductosTotales()" class="btn btn-success">Filtrar</button>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Numero de Producto</th>
                                            <th>Producto</th>
                                            <th>Cantidad Producto</th>
                                            <th>Cantidad de producto vendido</th>
                                            <th>Precio Unitario</th>
                                            <th>TOTAL producto STOCK</th>
                                            <th>TOTAL producto VENDIDO</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='btblventasTotales2'>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para reportes de ventas totales -->
        <div class="modal fade" id="reporteDeVentasModal" tabindex="-1" role="dialog"
            aria-labelledby="modal para reportes de ventas totales" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reporte de ventas totales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="Table InfoProduct" style="margin-top: 25px;">
                                <h1>Ventas totales</h1>
                                <label for="filtroDiaInicial">
                                    Filtro de fechas:&nbsp;
                                    <input type="date" name="filtroDiaInicial" id="filtroDiaInicial" value=""
                                        class="form-control">
                                </label>
                                <label for="filtroDiaFinal" id="filtroDiaFinalLabel" class="d-none">&nbsp;-&nbsp;
                                    <input type="date" name="filtroDiaFinal" id="filtroDiaFinal" class="form-control">
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="rangoHoras">
                                    <input type="checkbox" name="rangoHoras" id="rangoHoras" onclick="alternarFiltro()"
                                        class="form-check-input">
                                    Rango de fechas
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <button onclick="obtenerVentasTotales()" class="btn btn-success">Filtrar</button>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Numero de ticket</th>
                                            <th>Fecha</th>
                                            <th>Sub-Total</th>
                                            <th>Total</th>
                                            <th>Forma de pago</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='btblventasTotales'>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para cambiar estado de un ticket -->
        <div class="modal fade" id="cambiarEstadoTicketModal" tabindex="-1" role="dialog"
            aria-labelledby="modal para cambiar estado de un ticket" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar estado de ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="" method="POST">
                                <label for="estadoTicket">Seleccione el estado del ticket:
                                    <select name="estadoTicket" id="estadoTicket">
                                        <option value="0">Anulado</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </label>
                                <input type="hidden" name="idTicketHidden" id="idTicketHidden">
                                <input type="submit" name="accion" value="Cambiar estado">
                            </form>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 py-3 barra">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="categoria.php">Ver categorias</a>
                </div>
            </div>
        </div>
        <div class="col-2 py-3 barra">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button class="btn btn-info dropdown-item" data-toggle="modal" data-target="#agregarProductoModal"
                        data-mod="" onclick="obtenerCategorias()">Agregar producto</button>
                </div>
            </div>
        </div>
        <!-- Modal para agregar productos -->
        <div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog"
            aria-labelledby="modal para agregar productos" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar poducto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="" class="form-group">
                        <div class="modal-body">
                            <div class="container">
                                <div class="form-group row">
                                    <label for="categorias" class="col-6">
                                        Seleccione la categoria:
                                        <select id="categorias" name="categorias" class="form-control">
                                            <!--Se cargan automaticamente-->
                                        </select>
                                    </label>
                                    <label for="nombre" class="col-6">Nombre:
                                        <input type="text" id="nombre" name="nombre" required class="form-control">
                                    </label>
                                    <label for="precio" class="col-6">Precio:
                                        <input type="number" min=0 step=0.01 name="precio" id="precio"
                                            class="form-control" required>
                                    </label>
                                    <label for="cantidad" class="col-6">Cantidad:
                                        <input type="number" min=0 step=0.01 name="cantidad" id="cantidad"
                                            class="form-control" required>
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="idModulo" id="modulo">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Agregar producto" name="accion">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal para eliminar productos -->
        <div class="modal fade" id="eliminarProductoModal" tabindex="-1" role="dialog"
            aria-labelledby="modal para eliminar productos" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar poducto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="" class="form-group">
                        <div class="modal-body">
                            <div class="container">
                                <div class="form-group row">
                                    <label for="productosSelect">
                                        Seleccione el producto a eliminar:
                                        <select id="productosSelect" name="productosSelect">
                                            <!--Se cargan automaticamente-->
                                        </select>
                                    </label>

                                </div>
                            </div>
                            <input type="hidden" name="idModulo" id="modulo">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Eliminar producto" name="accion">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal para opciones de producto -->
        <div class="modal fade" id="opcionesProductosModal" tabindex="-1" role="dialog"
            aria-labelledby="Modal para opciones de producto" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Opciones de producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <h3>Aumentar stock</h3>
                            <form action="" method="POST">
                                <label for="cantidadAgregarProducto">Ingrese la cantidad de producto a aumentar:
                                    <input type="number" id="cantidadAgregarProducto" name="cantidadAgregarProducto"
                                        step="0.01" min=1 required>
                                </label>
                                <input type="hidden" id="idProductoAumentar" name="idProductoAumentar" value="">
                                <input type="submit" class="btn btn-info" name="accion" value="Aumentar stock">
                            </form>
                            <h3>Disminuir stock</h3>
                            <form action="" method="POST">
                                <label for="cantidadDisminuirProducto">Ingrese la cantidad de producto a disminuir:
                                    <input type="number" id="cantidadDisminuirProducto" name="cantidadDisminuirProducto"
                                        step="0.01" min=1 required>
                                </label>
                                <input type="hidden" id="idProductoDisminuir" name="idProductoDisminuir" value="">
                                <input type="submit" class="btn btn-warning" name="accion" value="Disminuir stock">
                            </form>
                            <h3>Eliminar producto</h3>
                            <h5 id="confirmacionEliminacion"></h5>
                            <form action="" method="POST">
                                <input type="hidden" id="idProductoEliminar" name="idProductoEliminar" value="">
                                <button class="btn btn-danger" onclick="eliminarProducto(event)" name="accion"
                                    value="Eliminar producto">Eliminar Producto</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-2 py-3 barra">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Caja
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button class="btn btn-info dropdown-item" data-toggle="modal" data-target="#reporteX">Reporte
                        X</button>
                    <button class="btn btn-info dropdown-item" data-toggle="modal" data-target="#reporteZ">Reporte
                        Z</button>

                </div>
            </div>
        </div>


        <!-- Modal para reportes agregar categoria-->
        <div class="modal fade" id="modal_add_categorias" tabindex="-1" role="dialog"
            aria-labelledby="modal para imprimir reportes X" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir una Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="modal-body">
                                <div class="container">
                                    <div class="form">
                                        <h3>Nueva Categoria</h3>
                                    </div>
                                    <form method="post" action="opciones.php" name="form_categorias"
                                        id="form_categorias">
                                        <div class="form-group">
                                            <input type="text" name="nombre" class="form-control" id=""
                                                placeholder="Digite nueva categoria">
                                        </div>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" name="guardar" value="Finalizar"
                            form="form_categorias">
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para reportes X-->
        <div class="modal fade" id="reporteX" tabindex="-1" role="dialog"
            aria-labelledby="modal para imprimir reportes X" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imprimir X</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="modal-body">
                                <div class="container">
                                    <input type="date" name="filtroDiaInicial2" id="fechaX" value=""
                                        class="form-control">
                        <br>
                                    <button onclick="reportX();" class="btn btn-info">Imprimir</button>

                                    <button style="display: none;" onclick="reportXPantalla();" data-dismiss="modal" data-toggle="modal" data-target="#impresionesPantallaModal" class="btn btn-info">Imprimir pantalla solo para desarrollo</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para reportes Z-->
        <div class="modal fade" id="reporteZ" tabindex="-1" role="dialog"
            aria-labelledby="modal para imprimir reportes Z" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imprimir Z</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="modal-body">
                                <div class="container">
                                    Fecha Inicio<input type="date" name="filtroDiaInicial2" id="fechaZ" value=""
                                        class="form-control">
                                        <br>
                                    Fecha Fin<input type="date" name="filtroDiaInicial2" id="fechaFinZ" value=""
                                        class="form-control">
                                        <br>
                                    <button onclick="reportZ();" class="btn btn-info">Imprimir</button>
                                    
                                    <button style="display: none;" onclick="reportZPantalla();" data-dismiss="modal" data-toggle="modal" data-target="#impresionesPantallaModal" class="btn btn-info">Imprimir en pantalla solo para desarrolladores</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-3 py-3 barra">
            <a href="index.php" class="btn btn-primary btn-lg">Listo</a>
        </div>


        <!-- Modal para reportes editar categoria-->
        <div class="modal fade" id="modal_edit_categorias" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar una Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="modal-body">
                                <div class="container">
                                    <div class="form">
                                        <h3>Edita la Categoria</h3>
                                    </div>
                                    <div id="edit_cat">

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>