<?php
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();
//$id=$_REQUEST['id'];
$id=$_REQUEST['id'];
?>

<html>
<head>
  <title></title>
  <style type="text/css">
#formreg {
  color: #FFF;
  border: 0;
  background-color: #FFF;
}
#nuevafoto,#eliminafoto {
  color: #FFF;
  border: 0;
  background-color: #FFF;
}
.fila-base{ display: none; }

#codigo,#orden{
color:#FFFFFF;
text-color:#FFFFFF;
background-color: #FFFFFF;
border-width:0;
}

</style>
  <link href="css/whatsapp_css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="tit_actualiza">Subir imagenes</div>
<div class="caja_actualiza">
<?php

$query="select codigo,url,imagen,estado from publicidad where codigo=$id and estado not in (0)";
$noti=$bd->consulta($query);
while ($row = $bd->fetch_array($noti)){
      $codigo = $row["codigo"];
      $url = $row["url"];
      $foto = $row["imagen"];
      $esta = $row['estado'];
?>
<img src="<?php echo $foto; ?>" width="100" health="100">
  <a href="proceso.php?opcion=borrarpubli&cod=<?php echo $codigo; ?>&nom=<?php echo $foto; ?>" class="tex_activar"> Eliminar</a>
  <?php
 }

$query5="select count(codigo) as num from publicidad where codigo=$id";
$n=$bd->consulta($query5);
while ($rown= $bd->fetch_array($n)){ $nu=$rown['num'];}
if ($nu==0) {
  ?>

<form action="proceso.php?opcion=publifoto_guarda" method="POST" enctype="multipart/form-data">
<input type="file" name="imagen" id="imagen" onChange="this.form.submit()" accept="image/jpeg"/>

<?php 
}
?>




</form>
<div class="listo">
<a href="#" onclick="window.close();" class="tex_listo">LISTO</a>
</div>
</div>

</body>
</html>