<?php

include('../models/publicidad.php');
$Objeto_publicidad = new publicidad();

$id = $_POST['vl'];
if($id==3){

	$result = $Objeto_publicidad->EstadoPublicidad($_POST["id"],$_POST["id1"]);
		if($result==true){
			echo "Se modifico el estado Correctamente";
		}else{
			echo "Error !!!";
		}
}else if($id==4){
		$result = $Objeto_publicidad->EliminarPublicidad($_POST["id"]);
	if($result==true){
		echo "Se elimino Correctamente";
	}else{
		echo "Error en la eliminación !!!";
	}
	
}else if($id==5){
			$result = $Objeto_publicidad->Editando_Portada($_POST["evento"],$_POST["dm"]);
			if($result==1){
				echo "Se Actualizo Correctamente.";
			}else{
				echo "Error Intente de Nuevo !!!";
			}
}else{echo "Error";}
?>