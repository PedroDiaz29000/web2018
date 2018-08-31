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

function registro($n1,$n2,$n3,$n4,$n5){

	include('/models/simpatizantes.php');
		$Objeto_publicidad = new simpatizantes();
		$result = $Objeto_publicidad->registration($n1,$n2,$n3,$n4,$n5);
			if($result==true){
				echo "Datos Ingresados Correctamente, nos comunicaremos a la breveda posible.";
				die(); }else{echo "Error !!!";
				die();
			}
}

?>