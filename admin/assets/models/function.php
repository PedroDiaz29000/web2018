<?php
date_default_timezone_set('America/Lima');
function upload_image()
{
	if(isset($_FILES["user_image"])){
		$varl ='';
		include('db.php');
		$consul='SELECT noticia FROM contador';
		$resul = mysql_query($consul,$cnx);
		while($reg=mysql_fetch_array($resul)){$varD = $reg['noticia'];}
		$varl=$varD+1;
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = ($varl).'-'.date('Y').'.' . $extension[1];
		$destination = '../subidas/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		$actu =' UPDATE contador SET noticia="'.$varl.'"';
		$actuC = mysql_query($actu,$cnx);
		mysql_close($cnx);
		$ruta = "subidas/".$new_name; 
		return $ruta;
	}
} //echo date('Y');

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM users WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM users");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function Regitro_N($titulo,$detalle,$imagen){
	include('db.php');
	$date = date('Y/m/d h:i:s ', time());
		$resul='';
		$U_id='';
		
		$consul='INSERT INTO noticia(titulo,detalle,estado,fecha)VALUES("'.$titulo.'","'.$detalle.'",1,"'.$date.'")';
		$resul = mysql_query($consul,$cnx);

		$consul='SELECT max(id) as id from noticia';
		$resul = mysql_query($consul,$cnx);		
		while($U_id=mysql_fetch_array($resul)){$varD = $U_id['id'];}

		$consul='INSERT INTO detalle(noticia, rutafoto,orden,estado_foto)VALUES("'.$varD.'","'.$imagen.'",1,1)';
		$resul = mysql_query($consul,$cnx);
//-- select last_insert_id();
		return $resul;
		mysql_close($cnx);
}

function estado($id,$idV){
	$valor='';
	$date = date('Y/m/d h:i:s ', time());
	if($id==1){$valor=0;
	}else{$valor=1;}
	
	$consul='UPDATE noticia SET estado="'.$valor.'",fecha_act="'.$date.'" ';
	$resul = mysql_query($consul,$cnx);
	return $resul;
	mysql_close($cnx);
}	

?>