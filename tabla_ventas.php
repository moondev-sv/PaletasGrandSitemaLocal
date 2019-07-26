<?php
	include("Core/DB.php");
	$BD = new BaseDatos();


		if(($_POST['bandera'])=="recargar"){
				$respuesta = $BD->ejecutar("SELECT producto.idproducto, producto.nom_producto, producto.precio_producto, producto.cant_producto, venta_producto.cant_x_producto FROM `producto` INNER JOIN venta_producto ON producto.idproducto = venta_producto.id_producto");
				$html= "";
				foreach ($respuesta as $key => $value) {
					$html.=" 
					<tr>
						<td>".$value['idproducto']."</td>
						<td>".$value['nom_producto']."</td>
						<td>".$value['cant_producto']."</td>
						<td>".$value['precio_producto']."</td>
						<td></td>
					</tr> ";
				}
				echo $html;
			
		}
	?>