<div class="container">
	<div class="form-row text-center">
		<div class="col-2 py-3 barra">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				<button id="btngroupdrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reportes
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="ventas.php">Productos Vendidos</a>
					<button class="btn btn-info" data-toggle="modal" data-target="#reporteDeVentasModal"
					data-mod="" onclick="obtenerVentasTotalesInicial()">Ventas Totales</button>
				</div>
			</div>
		</div>
		<!-- Modal para reportes de ventas totales -->
		<div class="modal fade" id="reporteDeVentasModal" tabindex="-1" role="dialog" aria-labelledby="modal para reportes de ventas totales" aria-hidden="true">
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
									<input type="date" name="filtroDiaInicial" id="filtroDiaInicial" value="">
								</label>

								<label for="filtroDiaFinal" id="filtroDiaFinalLabel" class="d-none">&nbsp;-&nbsp;
									<input type="date" name="filtroDiaFinal" id="filtroDiaFinal">
								</label>

								&nbsp;&nbsp;&nbsp;&nbsp;
								<label for="rangoHoras">
									<input type="checkbox" name="rangoHoras" id="rangoHoras" onclick="alternarFiltro()">
									Rango de fechas
								</label>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<button onclick="obtenerVentasTotales()">Filtrar</button>


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
		<div class="modal fade" id="cambiarEstadoTicketModal" tabindex="-1" role="dialog" aria-labelledby="modal para cambiar estado de un ticket" aria-hidden="true">
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
										<option value="0">Activo</option>
										<option value="1">Anulado</option>
										<option value="2">Devolucion</option>
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
				data-mod="" onclick="obtenerProductosctivos()">Eliminar Producto</a>
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
								<label for="precio">Precio:
									<input type="number" min=0 step=0.01 name="precio" id="precio">
								</label>
								<label for="cantidad">Cantidad:
									<input type="number" min=0 step=0.01 name="cantidad" id="cantidad">
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