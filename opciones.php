<?php 

$accion=$_POST['accion'];

if($accion=="Agregar producto")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();

	$nombre=$_POST['nombre'];
	$idCategoria=$_POST['categorias'];
	$descripcion=$_POST['descripcion'];
	$precio=$_POST['precio'];


	$resultado=$conexion->ejecutar("INSERT into producto values (null, $idCategoria, '$nombre','$descripcion',$precio,0)");

	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	else
	{
		echo "Se registro el producto";
	}
}
elseif($accion=="Eliminar producto")
{
	require_once('Core/DB.php');

	$conexion=new BaseDatos();


	$idProducto=$_POST['productosSelect'];

	$resultado=$conexion->ejecutar("DELETE from producto where id_producto=$idProducto and cantidad_producto=0");

	if(gettype($resultado)=="string")
	{
		echo "Error: $resultado";
	}
	elseif($resultado==0)
	{
		echo "No puede eliminar un porducto que aun esta en inventario. Reduzca su cantidad a cero";
	}
	else
	{
		echo "Se elimino el producto";
	}
}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>*</title>

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/inventario.js"></script>
	

</head>

<body style="background: #34495E;">	
	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.cuerpo{height: 280px; background:#F4F6F6;}
		.barra{height: 80px;background:#E5E8E8;}

	</style>	

	<!--encabezado sin contenido-->
	<div class="">
		<div class="col-12 encabezado"></div>
	</div>	
	<!--Barra de menu opciones-->
	<div class="">
		<div class="container">
			<div class="form-row text-center">
				<div class="col-3 barra">
				</div>

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
	</div>

	<!--seccion de la tabla de reportes-->
	<div class="container">
		<div class="form-row text-center">
		<div class="col-12 cuerpo">
			
			<table class="table table-striped">
  				<thead>
    			<tr>
      				<th scope="col">Codigo</th>
      				<th scope="col">Producto</th>
      				<th scope="col">Precio</th>
      				<th scope="col">Cantidad</th>
      				<th scope="col">Total</th>
    			</tr>
  				</thead>
  				<tbody>
    			<tr>
    				<th scope="row">0000</th>
    				<td>paletaq</td>
    				<td>0.50</td>
    				<td>3</td>
    				<td>1.50</td>
    			</tr>
    			<tr>
    				<th scope="row">0001</th>
    				<td>paleto</td>
    				<td>0.25</td>
    				<td>1</td>
    				<td>0.25</td>
    			</tr>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</body>
</html>
