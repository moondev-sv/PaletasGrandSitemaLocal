<div class="container">
	<div class="form-row text-center">
		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reportes
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    				<a class="dropdown-item" href="ventas.php">Productos Vendidos</a>
    				<a class="dropdown-item" href="vent-total.php">Ventas Totales</a>
    			</div>
			</div>
		</div>

		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Categorias
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="categoria.php">Agregar categoria</a>
					<a class="dropdown-item" href="addproducto.php">Eliminar categoria</a>
    				<a class="dropdown-item" href="productos.php">Ver categorias</a>
    			</div>
			</div>
		</div>

		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Productos
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<button class="btn btn-info" data-toggle="modal" data-target="#agregarProductoModal"
                                data-mod="" onclick="obtenerCategorias()">Agregar producto</button>
					<button class="btn btn-info" data-toggle="modal" data-target="#eliminarProductoModal"
                                data-mod="" onclick="obtenerProductos()">Eliminar Producto</a>
    			</div>
			</div>
		</div>

		<!-- Modal para agregar productos -->
		<div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog" aria-labelledby="modal para agregar productos"
		     aria-hidden="true">
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

									<label for="categorias">
										Seleccione la categoria:
										<select id="categorias" name="categorias">
											<!--Se cargan automaticamente-->
										</select>
									</label>

									<label for="nombre">Nombre:
										<input type="text" id="nombre" name="nombre" required>
									</label>

									<label for="descripcion">Descripcion:
										<input type="text" name="descripcion" id="descripcion" required>
									</label>

									<label for="precio">Precio:
										<input type="number" min=0 step=0.01 name="precio" id="precio">
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
		<div class="modal fade" id="eliminarProductoModal" tabindex="-1" role="dialog" aria-labelledby="modal para eliminar productos"
		     aria-hidden="true">
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



		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Caja
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    				<a class="dropdown-item" href="reportes.php">Reportes Z, X</a>
    				<a class="dropdown-item" href="admincaja.php">Operaciones caja</a>
    			</div>
			</div>
		</div>

		<div class="col-3 py-3 barra">
			<a href="index.php" class="btn btn-primary btn-lg">Listo</a>
		</div>
	</div>
</div>