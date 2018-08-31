<?php
date_default_timezone_set('America/Lima');
class publicidad{
	
	public function ObtenerPublicidadDetalle($id){
		include("security/db.php");
			$consul='SELECT n.titulo,n.detalle,d.rutafoto  from noticia n
					inner join detalle d on d.noticia =n.id
					where n.id= "'.$id.'" and d.estado_foto !=3 ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);
	}

	public function fetch_array($resultado){
		return mysql_fetch_array($resultado);

	}

	public function list_titulo(){
		include("security/db.php");
		$consul='SELECT id,titulo from noticia where estado=1 ';
		$resul = mysql_query($consul,$cnx);
		return $resul;
		mysql_close($cnx);

	}

}
