<script src="js/inventario.js"></script>
<div class="container">
    <div class="form-row text-center">
  
        
        <div class="col-2 py-3 barra">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <button class='dropdown-item' onclick="showCat();">Agregar categoria</button>
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


        <div class="col-3 py-3 barra">
            <a href="opciones.php" class="btn btn-primary btn-lg">Volver</a>
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