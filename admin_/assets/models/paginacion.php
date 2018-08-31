<?php

class BD{
    
    function proceso($sql){
		include("security/db.php");
      	return mysql_query($sql,$cnx);
    	mysql_close($cnx);
    }
    
    function consulta($sql){
		include("security/db.php");
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