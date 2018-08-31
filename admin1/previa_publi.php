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

$id=$_REQUEST['id'];

		  /*$query1="select MAX(id) as id from actividad";
          $cod=$bd->consulta($query1);
          while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
          $idnuevo=$id+1;
*/


        $query="select imagen from publicidad where codigo=$id";
        $noti=$bd->consulta($query);
        while ($row = $bd->fetch_array($noti)){
        $foto = $row["imagen"];

          ?>
          <img src="<?php echo $foto; ?>" width="100" health="100">
          <?php
          }
          ?>
       

</body>
</html>