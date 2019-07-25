<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<title>Hello, world!</title>
</head>
<body style="background: #34495E;">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


	<!--estilos contenedores-->
	<style type="text/css">
		.encabezado{height: 80px; background: #34495E;}
		.barra{height: 80px;background:#E5E8E8;}
		.cuerpo{height: 300px; background:#F4F6F6;}
		.background{background: #E5E8E8}

		.form{height: 20%}
	</style>	
	<!--encabezado sin contenido-->
		<div class="">
			<div class="col-12 encabezado"></div>
		</div>	
	<!--Barra de menu opciones-->
	<div class="container">
		<div class="form-row text-center">
		<div class="col-2 barra">
		
		</div>
		<div class="col-7 barra">
			<h2>Pago</h2>
		</div>
		<div class="col-3 py-3 barra">
			<a href="index.php" class="btn btn-danger btn-lg">cancelar</a>

		</div>
		</div>

	<br>
	<!--seccion de proceso de pago-->
		<div class="form-row text-center">
		<div class="col-3 cuerpo">
		</div>

		<div class="col-6 cuerpo background">
			<div class="form">
				<h2>Total a pagar:</h2>
			</div>
			<div class="form-check form-check-inline form">
				<input class="form-check-input" type="radio" name="" id="" value="tarjeta">
				<label class="form-check-label" for="">
					<h5>Tarjeta</h5>
				</label>
			</div>
			<div class="form-check form-check-inline form">
				<input class="form-check-input" type="radio" name="" id="" value="efectivo">
				<label class="form-check-label" for="">
					<h5>Efectivo</h5>
				</label>
			</div>
			<div class="form">
				<input class="form-control form-control-lg" type="text" placeholder="Ingrese pago recibido">
			</div>
			<div class="form">
				<button id="finalizar" type="button" class="btn btn-success btn-lg">Finalizar</button>
			</div>
		</div>

		<div class="col-3 cuerpo">	
		</div>
		
		</div>
	<!--seccion de listado de producto y boton de venta-->

	</div>

<script>
    $(document).ready(function(){
        $('#finalizar').click(function(){
           $.ajax({
               url: 'ticket.php',
               type: 'POST',
               success: function(response){
                   if(response==1){
                       alert('Imprimiendo....');
                   }else{
                       alert('Exito');
                   }
               }
           }); 
        });
    });
</script>

</body>
</html>