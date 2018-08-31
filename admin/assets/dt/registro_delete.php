<?php
include('../models/simpatizantes.php');
$id= $_POST['id'];

if(is_numeric($id)){
	
	$Objeto_publicidad = new simpatizantes();
	$result = $Objeto_publicidad->dalete_registration($id);
		if($result==true){
			echo "Se elimino Correctamente.";die(); 
			}else{echo "Error !!!";die();
			}
}else{echo "Error !!!";} 
?>