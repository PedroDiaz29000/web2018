<style>
#combo{
	
	background-color: #FFFFFF;
	border-width:0;
}
#combo1{
color:#FFFFFF;
	text-color:#FFFFFF;
	background-color: #FFFFFF;
	border-width:0;
}
</style>
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css">
<?php
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();
$id=$_REQUEST['id'];
 $query="select codigo,url,imagen,estado,fecha from publicidad where codigo=$id";
 $noti=$bd->consulta($query);
$numero="";$titulo;$detalle="";$fecha="";$fotonoti="";
while ($row = $bd->fetch_array($noti)){
			$id = $row["codigo"];
            $enlace= $row["url"];
            $fecha = $row["fecha"];
            $foto = $row["imagen"];
            $estado = $row["estado"];

            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<title>DETALLE DE NOTICIA</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.verdiv {
			color: white;
			background:blue;
			width:600px;
			height:400px;
		}
		.noverdiv {
			color: blue;
			background:white;
			width:0px;
			height:0px;
		}
		.fila-base{ display: none; } /* fila base oculta */
	</style>
	<script>
	
	function cerrar_ventana(){
	window.parent.opener.location.href();
	window.close();
		
	}
	</script>
</head>
<body>

 <div class="tit_actualiza">Actualizar enlace</div>
 
 <div class="caja_actualiza">

 <!--<form action="grabarnoticia.php?opcion=actualizar_text" method="get">-->
 <form action="proceso.php?opcion=enl_act" method="post" onsubmit="cerrar_ventana()">
<input  type="hidden" size="3" id="combo1"  name="txtid" value="<?php echo $id; ?>" readonly />
 
 <div class="text_campo">
        Enlace:
      </div>
        <div class="numero">
          <label for="textfield2"></label>
          <input name="txtenlace" type="text" id="txtenlace" size="80" value="<?php echo $enlace; ?>" autocomplete="on" />
        </div>

  				
			<br><br><br>
			<input name="btnactualizar" class="btn btn-primary" type="submit" value="Actualizar" />
			
			
					
		</form>
	</div>
</body>
</html>