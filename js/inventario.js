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

function obtenerProductos()
{
	$.ajax({
        type      : 'post',
        url       : 'inventario.php',
        data      : {accion: "obtenerProductos"},
        Async	  : false,
        success   : function(respuesta)
        {
        	var btblProductos = document.getElementById('btblProductos');

        	btblProductos.innerHTML=respuesta;
        }
    });
}

function colocarIdProducto(idProducto)
{
	document.getElementById('idProductoAumentar').value=idProducto;
	document.getElementById('idProductoDisminuir').value=idProducto;
	document.getElementById('idProductoEliminar').value=idProducto;
}

var eliminar=false;
function eliminarProducto(e)
{
	if(!eliminar)
	{
		e.preventDefault();
		document.getElementById('confirmacionEliminacion').innerHTML="¿Esta seguro que desea eliminar el producto? Esta acción no se puede deshacer";
		eliminar=true;
	}	
}


function obtenerVentasTotalesInicial()
{
	var fecha = new Date();

	var fechaInicial = document.getElementById('filtroDiaInicial');
	
	var aux = Date.UTC(fecha.getFullYear() , fecha.getMonth(), fecha.getDate());

	fechaInicial.valueAsNumber=aux;


	$.ajax({
	        type      : 'post',
	        url       : 'inventario.php',
	        data      : {accion: "obtenerVentasTotales", fecha : fecha.getFullYear() +"-"+ (fecha.getMonth()+1) 
	        				+"-"+ fecha.getDate()},
	        Async	  : false,
	        success   : function(respuesta)
	        {
	        	var btblventasTotales = document.getElementById('btblventasTotales');

	        	btblventasTotales.innerHTML=respuesta;
	        }
	    });
}

function obtenerVentasTotales()
{
	if(document.getElementById('rangoHoras').checked)
	{
		if(document.getElementById('filtroDiaInicial').valueAsDate==null || document.getElementById('filtroDiaFinal').valueAsDate==null)
			alert("Ingrese fechas correctas en ambos campos");
		else if(document.getElementById('filtroDiaInicial').valueAsDate > document.getElementById('filtroDiaFinal').valueAsDate)
			alert("La fecha inicial no puede ser mayor que la final");
		else
		{
			$.ajax({
		        type      : 'post',
		        url       : 'inventario.php',
		        data      : {	accion: "obtenerVentasTotalesRangoFechas", 
		        				fechaInicial : document.getElementById('filtroDiaInicial').value,
		        				fechaFinal : document.getElementById('filtroDiaFinal').value},
		        Async	  : false,
		        success   : function(respuesta)
		        {
		        	var btblventasTotales = document.getElementById('btblventasTotales');

		        	btblventasTotales.innerHTML=respuesta;
		        }
		    });
		}
	}
	else
	{
		if(document.getElementById('filtroDiaInicial').valueAsDate==null)
			alert("Ingrese una fecha correcta");
		else
		{
			$.ajax({
		        type      : 'post',
		        url       : 'inventario.php',
		        data      : {accion: "obtenerVentasTotales", 
		        				fecha : document.getElementById('filtroDiaInicial').value},
		        Async	  : false,
		        success   : function(respuesta)
		        {
		        	var btblventasTotales = document.getElementById('btblventasTotales');

		        	btblventasTotales.innerHTML=respuesta;
		        }
	    	});
		}
	}
}

function alternarFiltro()
{
	var lblFiltro = document.getElementById('filtroDiaFinalLabel');

	if(lblFiltro.classList.contains('d-none'))
		lblFiltro.classList.remove('d-none');
	else
		lblFiltro.classList.add('d-none');
}


/***************************************************************** */



function obtenerProductosVendidosInicial()
{
	var fecha = new Date();

	var fechaInicial = document.getElementById('filtroDiaInicial2');
	
	var aux = Date.UTC(fecha.getFullYear() , fecha.getMonth(), fecha.getDate());

	fechaInicial.valueAsNumber=aux;


	$.ajax({
	        type      : 'post',
	        url       : 'inventario.php',
	        data      : {accion: "obtenerProductosTotales", fecha : fecha.getFullYear() +"-"+ (fecha.getMonth()+1) 
	        				+"-"+ fecha.getDate()},
	        Async	  : false,
	        success   : function(respuesta)
	        {
	        	var btblventasTotales = document.getElementById('btblventasTotales2');

	        	btblventasTotales.innerHTML=respuesta;
	        }
	    });
}

function obtenerProductosTotales()
{
	if(document.getElementById('rangoHoras2').checked)
	{
		if(document.getElementById('filtroDiaInicial2').valueAsDate==null || document.getElementById('filtroDiaFinal2').valueAsDate==null)
			alert("Ingrese fechas correctas en ambos campos");
		else if(document.getElementById('filtroDiaInicial2').valueAsDate > document.getElementById('filtroDiaFinal2').valueAsDate)
			alert("La fecha inicial no puede ser mayor que la final");
		else
		{
			$.ajax({
		        type      : 'post',
		        url       : 'inventario.php',
		        data      : {	accion: "obtenerProcutosTotalesRangoFechas", 
		        				fechaInicial : document.getElementById('filtroDiaInicial2').value,
		        				fechaFinal : document.getElementById('filtroDiaFinal2').value},
		        Async	  : false,
		        success   : function(respuesta)
		        {
		        	var btblventasTotales = document.getElementById('btblventasTotales2');

		        	btblventasTotales.innerHTML=respuesta;
		        }
		    });
		}
		
	}
	else
	{
		if(document.getElementById('filtroDiaInicial2').valueAsDate==null)
			alert("Ingrese una fecha correcta");
		else
		{
			$.ajax({
		        type      : 'post',
		        url       : 'inventario.php',
		        data      : {accion: "obtenerProductosTotales", 
		        				fecha : document.getElementById('filtroDiaInicial2').value},
		        Async	  : false,
		        success   : function(respuesta)
		        {
		        	var btblventasTotales = document.getElementById('btblventasTotales2');

		        	btblventasTotales.innerHTML=respuesta;
		        }
		    });
		}
		
	}
}

function alternarFiltro2()
{
	var lblFiltro = document.getElementById('filtroDiaFinalLabel2');

	if(lblFiltro.classList.contains('d-none'))
		lblFiltro.classList.remove('d-none');
	else
		lblFiltro.classList.add('d-none');
}

function asignarIdTicket(idTicket)
{
	document.getElementById('idTicketHidden').value=idTicket;
	
}