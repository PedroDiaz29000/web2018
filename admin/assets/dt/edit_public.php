<?php

include('../models/publicidad.php');
$Objeto_publicidad = new publicidad();


$valor= $_POST['vl'];
	
if($valor==1){
	$result = $Objeto_publicidad->buscar_Evento($_POST["id"]);
		if($result==true){

			while ($fila = $Objeto_publicidad->fetch_array($result)) {
				echo $fila[0].'-'.utf8_encode($fila[1]).'-'.utf8_encode($fila[2]);
			}
		}else{
			echo "Error !!!";}

}else if($valor==2){
		$id=trim($_POST['cu']);
		$titulo=trim(utf8_decode($_POST['title']));
		$detalle=trim(utf8_decode($_POST['detail']));

		if($id=='' || $titulo =='' || $detalle == ''){
			echo "Verificar la Información Ingresada !!!";
		}else{
			$result = $Objeto_publicidad->Editando_Evento($id,$titulo,$detalle);			
			
			if($result==true){
				echo "Se edito Correctamente";
			}else{
				echo "Error Intente de Nuevo !!!";
			}
		}
}else{
	echo "Error !!";
}

?>