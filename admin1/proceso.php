<?php
date_default_timezone_set("America/Lima");
$marcadeagua="imagenes/logo.png";
function marcadeagua($img_original, $img_marcadeagua, $img_nueva, $calidad)
{
	// obtener datos de la fotografia
	$info_original = getimagesize($img_original);
	$anchura_original = $info_original[0];
	$altura_original = $info_original[1];
	// obtener datos de la "marca de agua"
	$info_marcadeagua = getimagesize($img_marcadeagua);
	$anchura_marcadeagua = $info_marcadeagua[0];
	$altura_marcadeagua = $info_marcadeagua[1];
	// calcular la posición donde debe copiarse la "marca de agua" en la fotografia
	$horizmargen = ($anchura_original - $anchura_marcadeagua) - 10;
	$vertmargen = ($altura_original - $altura_marcadeagua)-10;
	// crear imagen desde el original
	$original = ImageCreateFromJPEG($img_original);
	ImageAlphaBlending($original, true);
	// crear nueva imagen desde la marca de agua
	$marcadeagua = ImageCreateFromPNG($img_marcadeagua);
	// copiar la "marca de agua" en la fotografia
	ImageCopy($original, $marcadeagua, $horizmargen, $vertmargen, 0, 0, $anchura_marcadeagua, $altura_marcadeagua);
	// guardar la nueva imagen
	ImageJPEG($original, $img_nueva, $calidad);
	// cerrar las imágenes
	ImageDestroy($original);
	ImageDestroy($marcadeagua);
	
}

header('Content-Type: text/html; charset=UTF-8'); 
require_once("cls/bd.php");
$bd = new BD();
$uploads_dir = 'subidas';
$output_dir = "subidas";
$opcion=$_REQUEST['opcion'];
$hoy= date('Y/m/d h:i:s ', time());
$bd->conectarBD();
switch($opcion){
	case "nuevo":
		$numero=$_REQUEST['txtnumero'];
		$titulo=utf8_encode($_REQUEST['txttitulo']);
		$detalle=utf8_encode($_REQUEST['txtdetalle']);
		$cate=$_REQUEST['txtcate'];
		$hoy =  date('Y/m/d h:i:s ', time());
		$query="insert into noticia(idpersona,titulo,detalle,fecha,categoria,estado,calificacion) values('$numero','$titulo','$detalle','$hoy','$cate','1','0')";
		$bd->proceso($query);
				
		$query1="select MAX(id) as id from noticia";
		$cod=$bd->consulta($query1);
		while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
		$idnuevo=$id;


		$query2="select estado_foto from detalle where noticia=$idnuevo";
		$ord=$bd->consulta($query2);
		while ($roword = $bd->fetch_array($ord)){$orden = $roword["estado_foto"];}
		
	
		if($orden=="")
		{	
		$ruta1="imagenes/actividad_sin_imagen.jpg";
		$query3="insert into detalle(noticia,rutafoto,orden,estado_foto) values('$idnuevo','$ruta1',1,1)";
		$bd->proceso($query3);
		}
			
		$bd->desconectarBD();
		header("location:listanoticia.php");
		break;
	case "nuevofoto":
		$nuevonombre=$_REQUEST['noticia'];
		$maxcod = $bd->result($bd->consulta("SELECT MAX(orden) FROM detalle where noticia=$nuevonombre"), 0);
		$hoy = date('Y/m/d h:i:s ', time());
		$contadordefoto=$maxcod;
		foreach($_FILES['files']['name'] as $i => $name)
			{
				$detallefoto="subidas/$nuevonombre-$contadordefoto.jpg";
				$archivo = $_FILES['files']['tmp_name'][$i];
				if (move_uploaded_file($archivo, "$detallefoto")){
				$d="subidas/$nuevonombre-$contadordefoto.jpg";
				$origen=$d;
				$destino=$d;
				$destino_temporal=tempnam("tmp/","tmp");
			marcadeagua($origen, $marcadeagua, $destino_temporal, 100);	
			// guardamos la imagen
				$fp=fopen($destino,"w");
				fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
				fclose($fp);
					$query="insert into detalle(noticia,rutafoto,orden,estado_foto) values('$nuevonombre','$d','$contadordefoto',2)";
					$bd->proceso($query);
				}
				$contadordefoto=$contadordefoto+1;
							}  
		$bd->desconectarBD();
		header("location:actualizar_foto.php?id=$nuevonombre");
		break;
		
		
	case "actualizar_text":
		$id=$_REQUEST['txtid'];
		$numero=$_REQUEST['txtnumero'];
		$titulo=$_REQUEST['txttitulo'];
		$detalle=$_REQUEST['txtdetalle'];
		$cate=$_REQUEST['txtcate'];
		$hoy = date('Y/m/d h:i:s ', time());//date_format(date_create($hoy),"d-m-Y H:i:s");
		$query="update noticia set idpersona='$numero',titulo='$titulo',detalle='$detalle',fecha_act='$hoy',categoria='$cate' where id=$id";
		$bd->proceso($query);
		$bd->desconectarBD();
		echo "<script>opener.location.reload();window.close();</script>";
		break;
		
		
		
	case "actualizar_fot":
		$elimina=$_REQUEST['elimina'];	
		$codigo=$_REQUEST['codigo'];
		$orden=$_REQUEST['orden'];

if ($_FILES["imagen"]["error"] > 0){
	//echo "ha ocurrido un error";
} else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/png","image/jpg", "image/jpeg", "image/gif");
	if (in_array($_FILES['imagen']['type'], $permitidos)){
		//$ruta = "imagenes/" . $_FILES['imagen']['name'];
		$ruta = "subidas/".$codigo."-".$orden.".jpg" ;
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
//.png)
		$origen=$ruta;
		$destino=$ruta;
		$destino_temporal=tempnam("tmp/","tmp");
		marcadeagua($origen, $marcadeagua, $destino_temporal, 100);	
	

				$fp=fopen($destino,"w");
				fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
						fclose($fp);


			$query="update detalle set rutafoto='$ruta' where noticia=$codigo and orden=$orden";
			//echo $query;
			$bd->proceso($query);
			if ($resultado){
				//echo "el archivo ha sido movido exitosamente";
			} else {
				//echo "ocurrio un error al mover el archivo.";
			}

		}

		else {
			echo $_FILES['imagen']['name'] . ", este archivo existe";
		}
	}
		$bd->desconectarBD();
		header("location:actualizar_foto.php?id=$codigo");
		

		break;

			case "desactivar":
		$id=$_REQUEST['id'];
		$query="update noticia set estado= 0 where id=$id";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:listanoticia.php");
		break;
		case "activar":
		$id=$_REQUEST['id'];
		$query="update noticia set estado= 1 where id=$id";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:listanoticia.php");
		break;

		case "desactiva_fot":
		$id=$_REQUEST['id'];
		$orden=$_REQUEST['orden'];
		$query="update detalle set estado_foto=3 where noticia=$id and orden=$orden";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:actualizar_foto.php?id=$id");
		break;

		case "activa_fot":
		$id=$_REQUEST['id'];
		$orden=$_REQUEST['orden'];
		$query="update detalle set estado_foto=2 where noticia=$id and orden=$orden";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:actualizar_foto.php?id=$id");
		break;

		case "actualizar_padre":
		echo "<script>opener.location.reload();window.close();</script>";
		break;


		case "mover":
		$ruta = "editadas/1-1.jpg" ;
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
		$img=ImageCreateFromPNG($ruta);//ImageCreateFromPNG  ImageCreateFromJpeg
		$ancho = imagesx($img);
		$alto = imagesy($img);

		if ($ancho>1200) {
		$z=$ancho/800;
		$anchon= $ancho/$z;
		$alton=$alto/$z;
		$nuevo = imagecreatetruecolor($anchon,$alton);
		imagecopyresized($nuevo, $img, 0, 0, 0, 0, $anchon, $alton, $ancho, $alto);
		imagejpeg($nuevo,$ruta,100);
		}	
		
		
		header("location:crop.php");
		break;



		case "marca_agua":

		$query1="select MAX(id) as id from noticia";
		$cod=$bd->consulta($query1);
		while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
		$idnuevo=$id+1;
		$query2="select MAX(orden) as orden from detalle where noticia=$idnuevo";
		$ord=$bd->consulta($query2);
		while ($roword = $bd->fetch_array($ord)){$orden = $roword["orden"];}
		$ordennuevo=$orden+1;
		$origen="editadas/2.jpg";
		$destino="subidas/$idnuevo-$ordennuevo.jpg";

		$query3="select count(estado_foto) as estado from detalle where noticia=$idnuevo";
		$ord=$bd->consulta($query3);
		while ($roword = $bd->fetch_array($ord)){$est = $roword["estado"];}
		if ($est==0) {
		$query="insert into detalle(noticia,rutafoto,orden,estado_foto) values('$idnuevo','$destino','$ordennuevo','1')";
		$bd->proceso($query);
		}
		if ($est!=0) {
		$query="insert into detalle(noticia,rutafoto,orden,estado_foto) values('$idnuevo','$destino','$ordennuevo','2')";
		$bd->proceso($query);
		}
		
		$bd->desconectarBD();
		$destino_temporal=tempnam("tmp/","tmp");
		marcadeagua($origen, $marcadeagua, $destino_temporal, 100);	
		$fp=fopen($destino,"w");
		fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
		fclose($fp);
		unlink('editadas/1-1.jpg');
		unlink('editadas/2.jpg');
		header("location:subir_foto.php?id=$idnuevo");
		break;

		
		case "borrar":
		$idb=$_REQUEST['cod'];
		$or=$_REQUEST['or'];
		$nomb=$_REQUEST['nom'];
		$query="delete from detalle where noticia=$idb and orden=$or";
		$bd->proceso($query);
		$bd->desconectarBD();
		unlink("$nomb");
		header("location:subir_foto.php?id=$idb");
		break;
		
		case "mover_act":
		$id=$_REQUEST['codigo'];
		$orden=$_REQUEST['orden'];
		$ruta = "editadas/2-1.jpg" ;
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
		
		$img=ImageCreateFromPNG($ruta);//ImageCreateFromJpeg
		$ancho = imagesx($img);
		$alto = imagesy($img);

		if ($ancho>1200) {
		$z=$ancho/800;
		$anchon= $ancho/$z;
		$alton=$alto/$z;
		$nuevo = imagecreatetruecolor($anchon,$alton);
		imagecopyresized($nuevo, $img, 0, 0, 0, 0, $anchon, $alton, $ancho, $alto);
		imagejpeg($nuevo,$ruta,100);
		}
		header("location:cropact.php?id=$id&orden=$orden");
		break;

		case "marca_aguaact":
		
		$id=$_REQUEST['id'];
		$query2="select MAX(orden) as orden from detalle where noticia=$id";
		$ord=$bd->consulta($query2);
		while ($roword = $bd->fetch_array($ord)){$orden = $roword["orden"];}
		$ordennuevo=$orden+1;
		$origen="editadas/3.jpg";
		$destino="subidas/$id-$ordennuevo.jpg";
		$query="insert into detalle(noticia,rutafoto,orden,estado_foto) values('$id','$destino','$ordennuevo','2')";
		$bd->proceso($query);
		$bd->desconectarBD();
		$destino_temporal=tempnam("tmp/","tmp");
		marcadeagua($origen, $marcadeagua, $destino_temporal, 100);	
		$fp=fopen($destino,"w");
		fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
		fclose($fp);
		unlink('editadas/2-1.jpg');
		unlink('editadas/3.jpg');
		header("location:actualizar_foto.php?id=$id");
		break;

		case "priorizar":
		$id=$_REQUEST['cod'];
		$orden=$_REQUEST['or'];
		$query2="update detalle set estado_foto=2 where noticia=$id and estado_foto not in(3)";
		$bd->proceso($query2);
		$query1="update detalle set estado_foto=1 where noticia=$id and orden=$orden";
		$bd->proceso($query1);
		$bd->desconectarBD();
		header("location:subir_foto.php?id=$id");
		break;

		case "priorizar1":
		$id=$_REQUEST['cod'];
		$orden=$_REQUEST['or'];
		$query2="update detalle set estado_foto=2 where noticia=$id and estado_foto not in(3)";
		$bd->proceso($query2);
		$query1="update detalle set estado_foto=1 where noticia=$id and orden=$orden";
		$bd->proceso($query1);
		$bd->desconectarBD();
		header("location:actualizar_foto.php?id=$id");
		break;

		case "publifoto_guarda":
		$hoy = date('Y/m/d h:i:s ', time());//date_format(date_create($hoy),"d-m-Y H:i:s");
		$query2="select max(codigo) as orden from publicidad";
		$ord=$bd->consulta($query2);
		while ($roword = $bd->fetch_array($ord)){$orden = $roword["orden"];}
		$ordennuevo=$orden+1;
		$ruta="publicidad/banner-$ordennuevo.jpg";
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
		$query="insert into publicidad(codigo,imagen,fecha) values('$ordennuevo','$ruta','$hoy')";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:subir_publi.php?id=$ordennuevo");
		
		
		break;

	case "borrarpubli":
		
		$idb=$_REQUEST['cod'];
		$nomb=$_REQUEST['nom'];
		$query="delete from publicidad where codigo=$idb";
		$bd->proceso($query);
		$bd->desconectarBD();
		unlink("$nomb");
		header("location:subir_publi.php?id=$idb");
		
		
		break;

case "nuevapubli":
		
		$idb=$_REQUEST['id'];
		$url=$_REQUEST['txtenlace'];
		$query1="update publicidad set url='$url',estado='1' where codigo='$idb'";
		$bd->proceso($query1);
		$bd->desconectarBD();
	 header("location:lista_publi.php");
	break;

case "desactiva_publi":
		
		$idb=$_REQUEST['id'];
		$query1="update publicidad set estado='0' where codigo='$idb'";
		$bd->proceso($query1);
		$bd->desconectarBD();
	 header("location:lista_publi.php");
	break;
     case "activa_publi":
		$idb=$_REQUEST['id'];
		$query1="update publicidad set estado='1' where codigo='$idb'";
		$bd->proceso($query1);
		$bd->desconectarBD();
	 header("location:lista_publi.php");
	break;

case "publifoto_act":

		$idb=$_REQUEST['id'];
		$ruta="publicidad/banner-$idb.jpg";
		$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
		$query="update publicidad set imagen='$ruta' where codigo='$idb'";
		$bd->proceso($query);
		$bd->desconectarBD();
		header("location:act_publi.php?id=$idb");
	break;

		case "enl_act":

		$idb=$_REQUEST['txtid'];
		$enlace=$_REQUEST['txtenlace'];
		$query="update publicidad set url='$enlace' where codigo='$idb'";
		$bd->proceso($query);
		$bd->desconectarBD();
		echo "<script>opener.location.reload();window.close();</script>";
	break;


	default: break;
}			
?>