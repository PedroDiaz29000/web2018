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
</style>
	<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="tit_actualiza">Actualizar imagenes</div>
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
 <img src="<?php echo $foto; ?>" width="100" height="100">
 


    <?php
if ($esta==2) {
  ?>
  <a href="proceso.php?opcion=desactiva_fot&id=<?php echo $codigo; ?>&orden=<?php echo $orden; ?>" class="tex_activar">desactivar</a>
   <?php
    }
    if ($esta==3) {
?>
<a href="proceso.php?opcion=activa_fot&id=<?php echo $codigo; ?>&orden=<?php echo $orden; ?>" class="tex_activar">activar</a>
<?php
    }
	if ($esta==1) { 
?>
<br>
<span class="tex_chek_activo">[ Esta im&aacute;gen es la foto principal ]</span>
<?php
	}
if ($esta!=1) {
  ?>
  <form action="proceso.php?opcion=priorizar1&cod=<?php echo $codigo; ?>&or=<?php echo $orden; ?>" method="POST">
    <p class="tex_chek">
      <input type="checkbox" name="txtprimero" value="1" onChange="this.form.submit()">
      [ chek para convertir esta imagen en foto principal ]</p>
  </form>
  <?php
    }
?>
<hr>

<?php
    }?>

<br>

<form action="proceso.php?opcion=mover_act" method="POST" enctype="multipart/form-data">
  <input type="file" name="imagen" id="imagen" onChange="this.form.submit()"/>
  <input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>" />
  <input type="hidden" name="orden" id="orden" value="<?php echo $orden; ?>" />
 
  </form>


<div class="listo">
<a href="proceso.php?opcion=actualizar_padre" class="tex_listo">LISTO</a>
</div>
</div>
</body>
</html>