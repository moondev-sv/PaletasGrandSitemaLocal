var totalGlobal=0, vueltoGlobal=Number.parseFloat(0);

function searchProduct() {
    var producto = document.getElementById("txtSearchProduct").value;
    var showResult = document.getElementById("searchResult");
    var result;

    var datos = {
        "producto": producto
    };

    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: datos,
        success: function (Respuesta) {
            //console.log(Respuesta);    
            showResult.innerHTML = Respuesta;
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function total(accion) {
    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: {
            "totalizar": 1
        },
        success: function (Respuesta) {
            //console.log(Respuesta); 
            if (accion == 1) {
                document.getElementById('pagar').value = Respuesta;
                totalPagar = Respuesta;
            } else {
                document.getElementById('subtotal').innerHTML = "Subtotal: $" + Respuesta;
                document.getElementById('total').innerHTML = "Total: $" + Respuesta;
                totalGlobal=Number.parseFloat(Respuesta);
            }
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function pago(element) {
    if (element.value == 10) {
        total(1);
    }

    if(element.value==10)
        document.getElementById('pagar').classList.add("invisible");
    else
        document.getElementById('pagar').classList.remove("invisible");

    document.getElementById('fPago').value = element.value;
}

function realizarCompra(fPago, monto, total) {
    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: {
            "finalizaP" : 1,
            "formaPago" : fPago,
            "monto"     : monto,
            "pagar"     : total
        },
        success: function (Respuesta) {
            //console.log(Respuesta); 
            alert('imprimiento');
            startSale();
            alert("el vuelto es de "+vueltoGlobal.toFixed(2));
            document.getElementById('pagar').value = 0;
            document.getElementById("addResult").innerHTML = "";
            document.getElementById('subtotal').innerHTML = "Subtotal: $0";
            document.getElementById('total').innerHTML = "Total: $0";
            console.log(Respuesta);
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function finalizarPago() {

    if(document.getElementById('pagar').value==0 || document.getElementById('pagar').value==null)
        alert("Ingrese una cantidad mayor que 0");
    else
    {
        $.ajax({
            url: 'busquedaProd.php',
            type: 'POST',
            data: {
                "totalizar": 1
            },
            success: function (Respuesta) {
                
                var totalPagar = Number.parseFloat(Respuesta);

                var pago = Number.parseFloat(document.getElementById('pagar').value);
            
                if (totalPagar > 0) {
                    if (pago < totalPagar) {
                        alert("$"+pago+' no es suficiente pagar el total de: $' + totalPagar);
                    } else {
                        realizarCompra(document.getElementById('fPago').value, pago, totalPagar);
                    }
                }
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }

    
}

function puente(obj) {
    document.getElementById('puente').value = obj.value;
}

function alterarTabla(accion) {

    if (accion === "agg") {
        var cant = document.getElementById('txtCantAgg').value;
    } else {
        var cant = document.getElementById('txtCantDel').value;
    }

    if (cant != "") {
        var id = document.getElementById('puente').value;
        var showResult = document.getElementById("addResult");

        var datos = {
            "alterarTabla": accion,
            "cantidad": cant,
            "posicionProd": id
        };

        $.ajax({
            url: 'busquedaProd.php',
            type: 'POST',
            data: datos,
            success: function (Respuesta) {
                //console.log(Respuesta); 
                if (Respuesta === "1") {
                    alert('no hay suficiente producto');
                } else {

                    showResult.innerHTML = Respuesta;
                    searchProduct();
                    total(2);
                }
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });

        document.getElementById('txtCantAgg').value = "";
        document.getElementById('txtCantDel').value = "";
    }
}

function startSale() {
    var datos = {
        "cargarProductos": 1
    };

    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: datos,
        success: function (Respuesta) {
            //console.log(Respuesta);    
            searchProduct();
        },
        error: function (xhr) {
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}

function validarSiNumero(e) {
    var key = e.charCode;

    if (key < 48 || key > 57) {
        e.preventDefault();
    }
}
function validarPago(e) {
    var key = e.charCode;

    if (key != 46) {
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }
}

function calcularVuelto()
{
    var dineroIngresado = Number.parseFloat(document.getElementById('pagar').value);

    if(dineroIngresado<totalGlobal || document.getElementById('pagar').value==0 || document.getElementById('pagar').value==null)
        document.getElementById('vueltoAlert').innerHTML="La cantidad ingresada es menor a la requerida";
    else
    {
        vueltoGlobal=dineroIngresado-totalGlobal;
        document.getElementById('vueltoAlert').innerHTML="El vuelto es de $"+vueltoGlobal.toFixed(2);
    }
}

function reportX() {

    if(document.getElementById('fechaX').valueAsDate==null)
        alert("Ingrese una fecha valida");
    else
    {
        var datos = {
            "fecha": document.getElementById('fechaX').value
        };
        $.ajax({
            url: 'reporteX.php',
            type: 'POST',
            data: datos,
            success: function(Respuesta) {
                //console.log(Respuesta);    
                console.log(Respuesta);
                alert('imprimiendo');
            },
            error: function(xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }
}

function reportXPantalla() {

    if(document.getElementById('fechaX').valueAsDate==null)
        alert("Ingrese una fecha valida");
    else
    {
        var datos = {
            "fecha": document.getElementById('fechaX').value,
            "imprimirPantalla":true
        };
        $.ajax({
            url: 'reporteX.php',
            type: 'POST',
            data: datos,
            success: function(Respuesta) {
                document.getElementById('impresionPantallaDiv').innerHTML=Respuesta;
            },
            error: function(xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }
}

function reportZ() {
    if(document.getElementById('fechaZ').valueAsDate==null || document.getElementById('fechaFinZ').valueAsDate==null)
        alert("Ingrese un rango de fechas validas");
    else if(document.getElementById('fechaZ').valueAsDate > document.getElementById('fechaFinZ').valueAsDate)
        alert("La fecha inicial no puede ser mayor que la final");
    else
    {
        var datos = {
            "fecha": document.getElementById('fechaZ').value,
            "fecha_fin": document.getElementById('fechaFinZ').value,
            "reporteZ": true
        };

        $.ajax({
            url: 'reporteZ.php',
            type: 'POST',
            data: datos,
            success: function(Respuesta) {
                //console.log(Respuesta);    
                console.log(Respuesta);
                alert('imprimiendo');
            },
            error: function(xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }
}

function reportZPantalla() {
    if(document.getElementById('fechaZ').valueAsDate==null || document.getElementById('fechaFinZ').valueAsDate==null)
        alert("Ingrese un rango de fechas validas");
    else if(document.getElementById('fechaZ').valueAsDate > document.getElementById('fechaFinZ').valueAsDate)
        alert("La fecha inicial no puede ser mayor que la final");
    else
    {
        var datos = {
            "fecha": document.getElementById('fechaZ').value,
            "fecha_fin": document.getElementById('fechaFinZ').value,
            "reporteZ": true,
            "imprimirPantalla":true
        };

        $.ajax({
            url: 'reporteZ.php',
            type: 'POST',
            data: datos,
            success: function(Respuesta) {
                document.getElementById('impresionPantallaDiv').innerHTML=Respuesta;
            },
            error: function(xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    }
}