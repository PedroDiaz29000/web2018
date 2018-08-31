<?php
	//session_start();
	//print_r($_SESSION);exit;
	//if (!isset($_SESSION["s_usu_cod"])) {
		//header("location:login.php");
	//}
	class BD{
//		var $cn;
		//ini_set('mssql.charset', 'UTF-8');
		function conectarBD()
		{
		$cnx= mysql_connect("162.211.86.149","rauldiaz_comas","7bPMyuF(UFVu");
		mysql_select_db('rauldiaz_web2018', $cnx);//reclutando
		} 

		function desconectarBD()
		{
			mysql_close();
		}
		
		function proceso($sql){
		$cnx= mysql_connect("162.211.86.149","rauldiaz_comas","7bPMyuF(UFVu");
		mysql_select_db('rauldiaz_web2018', $cnx);
			//mssql_query("SET CHARACTER SET utf8");
			//mssql_query("SET NAMES utf8");
//			return mssql_query($sql,$this->cn);
			return mysql_query($sql,$cnx);
		mysql_close($cnx);
		}
		
		function consulta($sql){
			//mssql_query("SET CHARACTER SET utf8");
			//mssql_query("SET NAMES utf8");
		$cnx= mysql_connect("162.211.86.149","rauldiaz_comas","7bPMyuF(UFVu");
		mysql_select_db('rauldiaz_web2018', $cnx);
//			return mssql_query($sql,$this->cn);
		return mysql_query($sql,$cnx);
		mysql_close($cnx);
		}
		
		function num_rows($resultado){
			return mysql_num_rows($resultado);
		}
		
		function fetch_row($resultado){
			return mysql_fetch_row($resultado);
		}
		
		function fetch_assoc($resultado){
			return mysql_fetch_assoc($resultado);
		}
		
		function fetch_array($resultado){
			return mysql_fetch_array($resultado);
		}
		
		function result($resultado, $item){
			return mysql_result($resultado, 0, $item);
		}
		function insert_id() { 
			$id = ""; 
			$rs = mysql_query("SELECT @@identity AS id"); 
			if ($row = mysql_fetch_row($rs)) { 
				$id = trim($row[0]); 
			} 
			mysql_free_result($rs); 
			return $id; 
		}
	}
?>