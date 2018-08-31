<?php

class login{

	function Ingreso($usuario,$password){
		include("security/db.php");
		$consul='SELECT * from acceso where usuario="'.$usuario.'" and clave="'.$password.'" ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

		function num_rows($resultado){
			return mysql_num_rows($resultado);
		}

}	
?>