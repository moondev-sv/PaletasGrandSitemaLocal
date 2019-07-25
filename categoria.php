<?php
include("conexion/conect.php");
$sql="SELECT * FROM categorias";
$sentencia=$mysqli->query($sql);
if(isset($_POST["guardar"])){
$nombre = $_POST['nombre'];
$sql="INSERT INTO categorias (nombrecat)
VALUES('$nombre')";
$mysqli->query($sql);
echo "<script type='text/javascript'>alert('categoria guarda')</script>";
echo "<script>document.location.href='categoria.php'</script>";
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
		.cuerpo{height: 280px; background:#F4F6F6;}
	</style>
	<div class="">
		<div class="col-12 encabezado">
		</div>
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
				<div class="form">
					<h3>Nueva Categoria</h3>
				</div>
				<form method="post">
					<div class="form-group">
						<label for="" ><h5>Nombre: </h5></label>
							<input type="text" name="nombre" class="form-control" id="" placeholder="Digite nueva categoria">
					</div>
					<div class="form-group text-center">
						<input type="submit" class="btn btn-success btn-lg" name="guardar" value="Finalizar">
					</div>
				</div>
				</form>


			<div class="col-3 cuerpo">
			</div>
		</div>
	</div>



</body>
</html>
