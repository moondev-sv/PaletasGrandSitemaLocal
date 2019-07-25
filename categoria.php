<?php
include("Core/DB.php");
$BD = new BaseDatos();
$campos[0] = "id_categoria";
$campos[1] = "nom_categoria";
$valores[0] = "";
$datos = $BD->selectGeneral("categoria");
$html = "";
foreach ($datos as $key => $value) {
	$html .="<tr>
				<td>".$value['nom_categoria']."</td>
				<td> <button onclick='obtener(".$value['id_categoria'].")'>Editar</button>,<button onclick='eliminar(".$value['id_categoria'].")'>Eliminar</button></td>
			</tr>";

}
//----------------------------------------------------------
//--------------------------PARA GUARDAR UNA NUEVA CATEGORIA
//----------------------------------------------------------
if(isset($_POST["guardar"])){
	$nombre = $_POST['nombre'];
	$valores[1] =$nombre;

	if ($BD->insert("categoria",$campos,$valores)==1)
	{
		echo "<script type='text/javascript'>alert('categoria guardada')</script>";
		echo "<script>document.location.href='categoria.php'</script>";
	}
	else{
		echo "<script type='text/javascript'>alert('error')</script>";
	}
}
//----------------------------------------------------------
//--------------------------PARA ELIMINAR UNA CATEGORIA
//----------------------------------------------------------
if(($_POST["bandera"])=="eliminar"){
	$id = $_POST['id'];
	$BD->deleteGeneral("categoria","id_categoria",$id);
	echo 1;
}
//----------------------------------------------------------
//--------------------------PARA SELECCIONAR UN ITEM
//----------------------------------------------------------
if(($_POST["bandera"])=="obtener"){
	$id = $_POST['id'];
	$resultado = $BD->selectbyidGeneral("categoria","id_categoria",$id);
	$html ="";
	foreach ($resultado as $key => $value) {
		$html .="
		<input id='nombre_categoria' value='".$value['nom_categoria']."'></input>
		<button onclick='editar(".$value['id_categoria'].")'>Actualizar</button>
	";
	}
}
//----------------------------------------------------------
//--------------------------PARA ACTUALIZAR
//----------------------------------------------------------
if(($_POST["bandera"])=="editar"){
	$id = $_POST['id'];
	$nombre = $_POST['nombre_categoria'];
	$respuesta = $BD->ejecutar("UPDATE categoria SET nom_categoria = '$nombre' WHERE id_categoria = $id");
	echo $respuesta;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	<title>*</title>
</head>

<body style="background: #34495E;">
<script>
	 function obtener(id){
			$.post( "", { id: id, bandera: "obtener"})
				.done(function( data ) {
					$("#edit").html(data);
				});
		}
		function editar(id){
			var nombre = $("#nombre_categoria").val();
			alert(nombre);
			$.post( "", { id: id,nombre_categoria: nombre,bandera: "editar"})
				.done(function( data ) {
					alert(data);
					$("#nombre_categoria").val("");
					$("#edit").html("");
				});
		}
		function eliminar(id){
			$.post( "", { id: id, bandera: "eliminar"})
				.done(function( data ) {
					
					if (data == 1){
						alert("Hecho");
					}else{
						alert("Error");
					}
				});
		}
</script>
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
				<br>
				
		</div>
		<div id="edit">

		</div>
		<div class="bg-white">
				<table>
					<tr>
						<td>Nombre</td>
						<td>Opcion</td>
					</tr>
					<?= $html ?>
				</table>
			</div>
		
	</div>



</body>
</html>
