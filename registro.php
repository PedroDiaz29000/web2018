<?php
function secureSQL( $strVar ){
     $banned = array("select", "drop", ";", "--", "insert","delete", "xp_","update");
    for ($i = 0 ;$i <=  strlen($banned);$i++) { 
            $strVar = str_replace( $banned[$i], "'",$strVar);      
	  }
      $final = str_replace( "'", "",$strVar)  ;
     $secureSQL = $final;
	return 	  $secureSQL;
}
$nombre= secureSQL(trim(utf8_decode($_POST['nombre'])));
$apellido = secureSQL(trim(utf8_decode ($_POST['apellido'])));
$email = secureSQL(trim(utf8_decode($_POST['Email'])));
$telefono = secureSQL(trim($_POST['Telefono']));
$comentario = secureSQL(trim(utf8_decode($_POST['comentarios'])));

if(!empty($nombre) && !empty($apellido) && !empty($email) && !empty($telefono) && !empty($comentario)){
		include_once('admin/assets/models/simpatizantes.php');
		$Objeto_registro = new simpatizantes();
		$result = $Objeto_registro->registration($nombre,$apellido,$email,$telefono,$comentario);
		if($result==true){
			echo "Se Ingreso sus Datos Correctamente, nos comunicaremos a la breveda posible.";
			die();
		}else{echo "Error !!!";die();}
}else{
	echo "Tiene que llenar los campos solicitados";
	die();
}	

?>