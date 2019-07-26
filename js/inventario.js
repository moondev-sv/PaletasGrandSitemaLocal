function obtenerCategorias()
{
	$.ajax({
        type      : 'post',
        url       : 'inventario.php',
        data      : {accion: "obtenerCategorias"},
        Async	  : false,
        success   : function(respuesta)
        {
        	var obj=JSON.parse(respuesta);

    	  	//alert(obj.length);

         	var select=document.getElementById("categorias"); 

         	for (var i = 0; i < select.length; i++) {
         		select.remove(0);
         	}

         	for (var i = 0; i < obj.length; i++) {
         		var option = document.createElement("option");
				option.text = obj[i].nom_categoria;
				option.value=obj[i].idcategoria;
				select.add(option);
         	}
        }
    });
}

function obtenerProductosctivos()
{
	$.ajax({
        type      : 'post',
        url       : 'inventario.php',
        data      : {accion: "obtenerProductosctivos"},
        Async	  : false,
        success   : function(respuesta)
        {
        	var obj=JSON.parse(respuesta);

    	  	//alert(obj.length);

         	var select=document.getElementById("productosSelect"); 

         	for (var i = 0; i < select.length; i++) {
         		select.remove(0);
         	}

         	for (var i = 0; i < obj.length; i++) {
         		var option = document.createElement("option");
				option.text = obj[i].nom_producto;
				option.value=obj[i].idproducto;
				select.add(option);
         	}
        }
    });
}

function obtenerVentasTotales()
{
	var fecha = new Date();

	var fechaInicial = document.getElementById('filtroDiaInicial');
	
	var aux = Date.UTC(fecha.getFullYear() , fecha.getMonth(), fecha.getDate());

	fechaInicial.valueAsNumber=aux;


	$.ajax({
	        type      : 'post',
	        url       : 'inventario.php',
	        data      : {accion: "obtenerVentasTotales"},
	        Async	  : false,
	        success   : function(respuesta)
	        {
	        	var obj=JSON.parse(respuesta);

	    	  	//alert(obj.length);

	         	var select=document.getElementById("productosSelect"); 

	         	for (var i = 0; i < select.length; i++) {
	         		select.remove(0);
	         	}

	         	for (var i = 0; i < obj.length; i++) {
	         		var option = document.createElement("option");
					option.text = obj[i].nom_producto;
					option.value=obj[i].idproducto;
					select.add(option);
	         	}
	        }
	    });
}

function alternarFiltro()
{
	var lblFiltro = document.getElementById('filtroDiaFinalLabel');

	if(lblFiltro.classList.contains('d-none'))
		lblFiltro.classList.remove('d-none');
	else
		lblFiltro.classList.add('d-none');
}