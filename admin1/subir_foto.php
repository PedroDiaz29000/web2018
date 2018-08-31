<?php
session_start();
if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
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

$query="select noticia,rutafoto,orden,estado_foto from detalle where noticia=$id and orden not in (0)";
$noti=$bd->consulta($query);
while ($row = $bd->fetch_array($noti)){
      $codigo = $row["noticia"];
      $orden = $row["orden"];
      $foto = $row["rutafoto"];
      $esta = $row['estado_foto'];
?>
<img src="<?php echo $foto; ?>" width="100" health="100">
  <a href="proceso.php?opcion=borrar&cod=<?php echo $codigo; ?>&or=<?php echo $orden; ?>&nom=<?php echo $foto; ?>" class="tex_activar"> Eliminar</a>
  <?php
if ($esta!=1) {
  ?>
  <form action="proceso.php?opcion=priorizar&cod=<?php echo $codigo; ?>&or=<?php echo $orden; ?>" method="POST">
  	<p class="tex_chek">
    <input type="checkbox" name="txtprimero" value="1" onChange="this.form.submit()">
    [ chek para convertir esta imagen en foto principal ] </p>
  </form>
  <?php
    }
  ?>
<hr>
<br>
<?php }?>

<form action="proceso.php?opcion=mover" method="POST" enctype="multipart/form-data">
<input type="file" name="imagen" id="imagen" onChange="this.form.submit()" accept="image/jpeg"/>


</form>
<div class="listo">
<a href="#" onclick="window.close();" class="tex_listo">LISTO</a>
</div>
</div>

</body>
</html>