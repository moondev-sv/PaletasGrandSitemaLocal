<?php
include("Core/DB.php");
$BD = new BaseDatos();
$campos[0] = "idcategoria";
$campos[1] = "nom_categoria";
$valores[0] = "";
$datos = $BD->selectGeneral("categoria");
$html = "";

foreach ($datos as $key => $value) {
	if ($value['estado']==0) {
		$html .="<tr>
				<td>".$value['nom_categoria']."</td>
				<td> <button class='btn btn-success' onclick='obtener(".$value['idcategoria'].")'>Editar</button> 
				<button class='btn btn-danger' onclick='delCat(".$value['idcategoria'].")'>Eliminar</button></td>
			</tr>";
	}
	else{
		$html.="";
	}
	
}


if(($_POST["bandera"])=="eliminar"){
    $res = $BD->ejecutar("UPDATE categoria SET estado = 1 WHERE idcategoria = ".$_POST['id']);
    //echo $res;
    echo 1;
    die();
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
    <title>Categorias</title>
</head>

<body style="background: #34495E;">


    <script>
    function delCat(id) {
        $.post("opciones.php", {
                id: id,
                bandera: "eliminar"
            })
            .done(function(data) {
                if (data == 1) {
                    alert("Hecho");
                    document.location.href = 'categoria.php';
                } else {
                    alert("Error " + data);
                }
            });
    }

    function showCat() {
        $("#modal_add_categorias").modal("show");
    }

    function obtener(id) {
        $("#modal_edit_categorias").modal("show");
        $.post("opciones.php", {
                id: id,
                bandera: "obtener"
            })
            .done(function(data) {
                $("#edit_cat").html(data);
            });
    }

    function editar(id) {
        if($("#nombre_categoria").val() == "")
            alert("introduzca un nombre por favor");
        else
        {
            var nombre = $("#nombre_categoria").val();
            $.post("opciones.php", {
                    id: id,
                    nombre_categoria: nombre,
                    bandera: "editar"
                })
                .done(function(data) {
                    $("#nombre_categoria").val("");
                    $("#edit_cat").html("");
                    alert("se actualizo la categoria");
                    document.location.href = 'categoria.php';
                });
        }

        
    }
    </script>
    <!--estilos contenedores-->
    <style type="text/css">
    .encabezado {
        height: 80px;
        background: #34495E;
    }

    .cuerpo {
        height: 280px;
        background: #F4F6F6;
    }
    </style>
    <div class="text-center">
        <div class="col-12 encabezado bg-light ">
            <?php
			include("Menus/menuCategorias.php")
			?>
        </div>
    </div>
    
    <br><br>
    <div class="container">
        <div class="bg-white">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                    <th>Opcion</th>
                    </tr>
                </thead>
                <?= $html ?>
            </table>
        </div>

    </div>



</body>

</html>