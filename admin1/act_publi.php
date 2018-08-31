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


div.upload {
    width: 157px;
    height: 57px;
    background: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRR2qn2tYxfrGMxcC85OttehDp5rk_idtlxJcrdw9wkfeiQjcZxhg);
    overflow: hidden;
}

div.upload input {
    display: block !important;
    width: 157px !important;
    height: 57px !important;
    opacity: 0 !important;
    overflow: hidden !important;
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
  
  <?php
 }
  ?>

<form action="proceso.php?opcion=publifoto_act&id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
  <div class="upload">
       <input type="file" value="actualizar imagen" name="imagen" id="imagen" onChange="this.form.submit()" accept="image/jpeg"/>
    </div>






</form>
<div class="listo">
<a href="proceso.php?opcion=actualizar_padre" class="tex_listo">LISTO</a>
</div>
</div>

</body>
</html>