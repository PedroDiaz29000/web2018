<?php
date_default_timezone_set("America/Lima");
// maximo por pagina
$limit = 10;
//echo "limite por pagina = ".$limit."<br>";
// pagina pedida
if (isset($_GET['pag'])){
   $pag = (int) $_GET["pag"]; 
   //echo "pagina = ".$pag."<br>";
   if ($pag < 1){ 
            $pag = 1; 
			$verprimero=false;
			//echo "pagina = ".$pag."<br>";
   } 
}else{
    $pag = 1;
	//echo "pagina = ".$pag."<br>";
}
$offset = ($pag-1) * $limit;
//echo "offset = ".$offset."<br>";
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();
?>
<?php
$categoria=$_REQUEST['cate'];
$buscar=$_REQUEST['bus'];
$cate_sql="";
$cate_total="";
$bus_sql="";
$bus_total="";
$sql_total="";

if($categoria=="")$cate_total=" where estado=1";

if($buscar=="")$bus_total=" where estado=1";

if($categoria!=""){$cate_sql=" and N.categoria='$categoria'";$cate_total=" where categoria='$categoria' and estado=1";
$sqlTotal = "SELECT count(*) as total from noticia ".$cate_total;
}


if($buscar!=""){$bus_sql=" and (N.titulo like '%$buscar%' or N.detalle like '%$buscar%')";
$bus_total=" where estado=1 and (titulo like '%$buscar%' or detalle like '%$buscar%')";
$sqlTotal = "SELECT count(*) as total from noticia ".$bus_total;
}

$sql = "SELECT * FROM (SELECT ROW_NUMBER() OVER(ORDER BY N.fecha desc) RowNr, N.id,N.titulo,N.fecha,D.rutafoto FROM noticia N,detalle D ";
$sql.="where N.id=d.noticia and D.estado_foto=1 and N.estado=1".$cate_sql.$bus_sql.") t WHERE RowNr BETWEEN ".($offset+1)." AND ".($limit*$pag);






if($categoria=="" && $buscar=="")$sqlTotal="SELECT count(*) as total from noticia where estado=1";
$rs = $bd->consulta($sql);
$rsTotal = $bd->consulta($sqlTotal);
$rowTotal = $bd->fetch_assoc($rsTotal);
// Total de registros sin limit
$total = $rowTotal["total"];
if($total==0){
?>
<style type="text/css">
#noseencontro {
	float: left;
	height: 150px;
	width: 100%;
	text-align: center;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #333;
	padding-top: 50px;
	background-color: #FFF;
}
</style>


<div id="noseencontro">
No se encontraron resultados para esa palabra...
</div>



<?

exit;}


?>
<?php
		 $conta=1;
		while($row=$bd->fetch_assoc($rs))
		{
			$id = $row["id"];
            $name =  ucfirst($row["titulo"]);//utf8_encode();
			$fecha = $row["fecha"];
			$foto = $row["rutafoto"];
			$dia=date_format(date_create($fecha),"d");
			$mes=date_format(date_create($fecha),"m");
			switch($mes)
			{	case "1":$mes="Ene";break;
				case 2:$mes="Feb";break;
				case 3:$mes="Mar";break;
				case 4:$mes="Abr";break;
				case 5:$mes="May";break;
				case 6:$mes="Jun";break;
				case 7:$mes="Jul";break;
				case 8:$mes="Ago";break;
				case 9:$mes="Sep";break;
				case 10:$mes="Oct";break;
				case 11:$mes="Nov";break;
				case 12:$mes="Dic";break;
				default:break;
			}
			$anio=date_format(date_create($fecha),"Y");

			if(($conta==1) || ($conta==2) || ($conta==3) || ($conta==6) || ($conta==7) || ($conta==8)){
			?>
			<a href="interior.php?id=<?php echo $id?>">
			<div class="actividad_vertical">
				<div class="foto"><img src="<?php echo $foto; ?>" width="285" height="250"/>
				</div>
				<div class="fon_fecha_vertical">
					<div class="fecha">
						<p class="dia_actividad"><?php echo $dia; ?></p>
						<p class="mes_actividad"><?php echo $mes; ?></p>	
					</div>
					<div class="mas_v"><img src="imagenes/mas_vertical.jpg" width="40" height="85" /></div>
				</div>
				<div class="tit_actividad_vertical">
					<p><?php echo $name; ?></p>
				</div>
			</div>
			</a>
			<?php
			}
			else if(($conta==4) || ($conta==5) || ($conta==9) || ($conta==10)){
			?>
			<a href="interior.php?id=<?php echo $id?>">
			<div class="actividad_horizontal">
				<div class="foto_actividad"><img src="<?php echo $foto; ?>" width="285" height="250"/>
				</div>
				<div class="tit_actividad_horizontal">
					<p><?php echo $name; ?></p>
				</div>
				<div class="fon_fecha_horizontal">
					<div class="fecha_horizontal">
						<p class="dia_actividad_h"><?php echo $dia; ?></p>
						<p class="mes_actividad_h"><?php echo $mes; ?></p>	
					</div>
					<div class="mas_h">
					<img src="imagenes/mas_horizontal.jpg" width="78" height="30" />
					</div>
				</div>
			</div>
			</a>
			<?php
			}
			$conta++;
		}		 
      ?>

<!--inicio paginacion-->
<div id="paginacion">
    <div class="nun_total">
		<div class="bot_izq">
		<img src="imagenes/bot_pag_izquierda.png" width="30" height="31" alt="bot_izquierda" />
		</div>
		
		
		<div class="caja_numeros">
		
		
		<div >
		<?php
         $totalPag = ceil($total/$limit);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
		 ?>
		 
		 <?php 
			if($buscar!=""){ ?>
				<a href="?pag=<?php echo $i; ?>&bus=<?php echo $buscar; ?>" class="bot_num"><?php echo $i; ?></a>
			<?php }
			elseif($categoria!=""){ ?>
				<a href="?pag=<?php echo $i; ?>&cate=<?php echo $categoria; ?>" class="bot_num"><?php echo $i; ?></a>
			<?php }
			if(($buscar=="") && ($categoria=="")){ ?>
				<a href="?pag=<?php echo $i; ?>" class="bot_num"><?php echo $i; ?></a>
			<?php }
         }
		?>
		
		</div>
		
		
		</div>            
		<div class="bot_der"><img src="imagenes/bot_pag_derecha.png" width="30" height="31" alt="bot_derecha" /></div>
    </div>
</div>
<!--fin paginacion-->

