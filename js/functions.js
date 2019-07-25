function searchProduct() {
    var producto = document.getElementById("txtSearchProduct").value;
    var showResult = document.getElementById("searchResult");
    var result;
    
    var datos = {
        "producto": producto
    };

    $.ajax ({
        url             : 'busquedaProd.php',
        type            : 'POST',
        data            : datos,
        success         : function(Respuesta) {
            //console.log(Respuesta);    
            showResult.innerHTML = Respuesta;
        },
        error           : function(xhr){
            alert("An error occured: " + xhr.status + " " + xhr.statusText);
        }
    });
}