<html>
<head>
<title></title>
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
          <?php
          
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();

		  $query1="select MAX(id) as id from noticia";
          $cod=$bd->consulta($query1);
          while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
          $idnuevo=$id+1;



        $query="select rutafoto from detalle where noticia=$idnuevo and orden not in (0)";
        $noti=$bd->consulta($query);
        while ($row = $bd->fetch_array($noti)){
        $foto = $row["rutafoto"];

          ?>
          <img src="<?php echo $foto; ?>" width="100" health="100">
          <?php
          }
          ?>
       

</body>
</html>