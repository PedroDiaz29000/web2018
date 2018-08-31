<?php

class publicidad{

	public function EstadoPublicidad($id,$idV){
		include("security/db.php");
		$valor='';
		$date = date('Y/m/d h:i:s ', time());
		if($id==1){$valor=0;
		}else{$valor=1;}
		
		$consul='UPDATE noticia SET estado="'.$valor.'",fecha_act="'.$date.'" where id= "'.$idV.'"';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);		
	}

		public function fetch_array($resultado){
		return mysql_fetch_array($resultado);

	}
	
	public function EliminarPublicidad($idV){
		include("security/db.php");
		$valor='';
		$date = date('Y/m/d h:i:s ', time());
		
		$consul='UPDATE noticia SET estado=2 ,fecha_act="'.$date.'" where id= "'.$idV.'"';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);		
	}

	public function list_titulo(){
		include("security/db.php");
		$consul='SELECT id,titulo from noticia where estado=1 ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

	public function buscar_Evento($id){
		include("security/db.php");
		$consul='SELECT id, titulo, detalle from noticia where id="'.$id.'" ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

	public function Editando_Evento($id,$titulo,$detalle){
		include("security/db.php");
		$date = date('Y/m/d h:i:s ', time());		
		$consul='UPDATE noticia SET titulo="'.$titulo.'",detalle="'.$detalle.'" ,fecha_act="'.$date.'" where id= "'.$id.'"';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

	public function Editando_Portada($noticia,$id){
		include("security/db.php");

		$consul1='UPDATE detalle set orden=2 where noticia="'.$noticia.'"';
		$resul = mysql_query($consul1,$cnx);

		$consul2='UPDATE detalle set orden=1  where id="'.$id.'"';
		$resul = mysql_query($consul2,$cnx);

		return $resul;
		mysql_close($cnx);
	}



/*	public function list_titulo(){
		include("security/db.php");
		$consul='SELECT id,titulo from noticia where estado=1 ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	} */


}
