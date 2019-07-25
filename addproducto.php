<?php
include("conexion/conect.php");
if(isset($_POST["guardarpro"])){
	$categorias = $_POST['categoria'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$sql="INSERT INTO productos (idcategoria, nombre, descripcion, precio)
	VALUES('$categorias','$nombre','$descripcion','$precio')";
	$mysqli->query($sql);
	echo "<script type='text/javascript'>alert('registro creado con exito');</script>";
	echo "<script>document.location.href='addproducto.php'</script>";
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
</head>

<body style="background: #34495E;">
	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.cuerpo{height: 600px; background:#F4F6F6;}
	</style>
	<div class="">
		<div class="col-12 encabezado"></div>
	</div>
	<!--Barra de menu opciones-->
	<div class="">
	<?php
		include("barra_herramientas.php")
	?>
	</div>


	<div class="container">
		<div class="form-row">
			<div class="col-3 cuerpo">
			</div>

			<div class="col-6 cuerpo background">
				<form method="post">
					<div class="form">
						<h3>Nuevo Producto</h3>
					</div>
	    			<div class="form-group">
	    				<label for="inputState"><h5>Escoga Categoria</h5></label>
	    				<select id="inputState" name="categoria" class="form-control">
								<?php
		            $sql="SELECT * FROM categorias";
		            $sentencia=$mysqli->query($sql);
								echo "<option value='0'>seleccione una categoria</option>";
					  		while($reg=$sentencia->fetch_assoc()){
		            echo"<option value='$reg[idcategoria]'>$reg[nombrecat]</option>";
		            }
		            ?>
	    				</select>
	    			</div>
					<div class="form-group">
						<label for="" ><h5>Nombre: </h5></label>
							<input type="text" name="nombre" class="form-control" id="" placeholder="Digite nuevo producto">
					</div>
					<div class="form-group">
						<label for="" ><h5>Descripción: </h5></label>
							<input type="text" name="descripcion" class="form-control" id="" placeholder="Descripción del producto">
					</div>
					<div class="form-group">
						<label for="" ><h5>Precio: </h5></label>
							<input type="text" name="precio" class="form-control" id="" placeholder="Digite nuevo precio">
					</div>

					<div class="form-group text-center">
						<input type="submit" class="btn btn-success btn-lg" name="guardarpro" value="finalizar">
					</div>
				</form>
			</div>

			<div class="col-3 cuerpo">
			</div>
		</div>
	</div>





</body>
</html>
