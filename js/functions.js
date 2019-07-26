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

function total() {
    $.ajax({
        url: 'busquedaProd.php',
        type: 'POST',
        data: {"totalizar": 1},
        success: function (Respuesta) {
            //console.log(Respuesta); 
            document.getElementById('subtotal').innerHTML = "Subtotal: $" + Respuesta;
            document.getElementById('total').innerHTML = "Total: $" + Respuesta;
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
    var cant = document.getElementById('txtCantAgg').value;

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
                    total();
                }
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });

        document.getElementById('txtCantAgg').value = "";
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