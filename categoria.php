<?php
include("Core/DB.php");
$BD = new BaseDatos();
$campos[0] = "idcategoria";
$campos[1] = "nom_categoria";
$valores[0] = "";
$datos = $BD->selectGeneral("categoria");
$html = "";
foreach ($datos as $key => $value) {
	$html .="<tr>
				<td>".$value['nom_categoria']."</td>
				<td> <button class='btn btn-success' onclick='obtener(".$value['idcategoria'].")'>Editar</button> <button class='btn btn-danger' onclick='eliminar(".$value['idcategoria'].")'>Eliminar</button></td>
			</tr>";
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/GeneralStyle.css">
	<script src="js/Jquery.js"></script>
	<script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<title>*</title>
</head>

<body style="background: #34495E;">

<script>
	function modal_add_cat(){
    $("#modal_add_categorias").modal("show");
	}
	 function obtener(id){
		$("#modal_edit_categorias").modal("show");
			$.post( "opciones.php", { id: id, bandera: "obtener"})
				.done(function( data ) {
					$("#edit_cat").html(data);
				});
		}
		function editar(id){
			var nombre = $("#nombre_categoria").val();
			$.post( "opciones.php", { id: id,nombre_categoria: nombre,bandera: "editar"})
				.done(function( data ) {
					$("#nombre_categoria").val("");
					$("#edit_cat").html("");
					document.location.href='categoria.php';
				});
		}
		function eliminar(id){
			$.post( "opciones.php", { id: id, bandera: "eliminar"})
				.done(function( data ) {
					if (data == 1){
						alert("Hecho");
						document.location.href='categoria.php';
					}else{
						alert("Error"+data);
					}
				});
		}
</script>
	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.cuerpo{height: 280px; background:#F4F6F6;}
	</style>
	<div class="text-center">
		<div class="col-12 encabezado bg-light ">
			<?php
			include("Menus/menuInventario.php")
			?>
		</div>
	</div>
	
	<div class="container">
		<div class="bg-white">
				<table class="table table-row table-bordered text-center">
					<tr class="thead-dark">
						<th>Nombre</th>
						<th>Opcion</th>
					</tr>
					<?= $html ?>
				</table>
			</div>
		
	</div>



</body>
</html>
