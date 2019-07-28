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
            alert('imprimiento ');
            startSale();
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
    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: {
            "totalizar": 1
        },
        success: function (Respuesta) {
            //console.log(Respuesta); 
            var totalPagar = Respuesta;

            var pago = document.getElementById('pagar').value;
        
            if (totalPagar > 0) {
                if (pago.trim() === "" || pago < totalPagar) {
                    alert('No es suficiente pagar el total de: $' + totalPagar);
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

function reportX() {
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