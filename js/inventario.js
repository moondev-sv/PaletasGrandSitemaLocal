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
				option.value=obj[i].id_categoria;
				select.add(option);
         	}
        }
    });
}

function obtenerProductos()
{
	$.ajax({
        type      : 'post',
        url       : 'inventario.php',
        data      : {accion: "obtenerProductos"},
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
				option.value=obj[i].id_producto;
				select.add(option);
         	}
        }
    });
}