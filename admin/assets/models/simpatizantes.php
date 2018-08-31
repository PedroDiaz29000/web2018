<?php
	date_default_timezone_set('America/Lima');
class simpatizantes{

	public function registration($nombre,$apellido,$email,$phone,$comen){
		include("security/db.php");
		$date = date('Y/m/d h:i:s ', time());
		$consul='INSERT INTO simpatizantes(name,surnames, email, phone, commentary,registrodate, state)VALUES("'.$nombre.'","'.$apellido.'","'.$email.'","'.$phone.'","'.$comen.'","'.$date.'",1)';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

	public function lista(){
		include("security/db.php");
		$consul="SELECT id, CONCAT(name,' ',surnames) se, phone, email, commentary, registrodate,state from simpatizantes where state = 1 order by registrodate desc";
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);			
	}

	public function fetch_array($resultado){
		return mysql_fetch_array($resultado);
	}

	public function dalete_registration($id){
		include("security/db.php");
		$consul='UPDATE simpatizantes set state = 0 where id = "'.$id.'" ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);			

	
	}

}
