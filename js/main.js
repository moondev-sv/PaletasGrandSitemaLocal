$(buscar_datos());


function buscar_datos(consulta){
	$.ajax({
		url: 'app/buscar.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#resultado").html(respuesta);
	})
	.fail(function() {
		console.log("Error");
	})
}


$(document).on('keyup','#buscar',function(){
	var valor =$(this).val();
	if(valor !=""){
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});