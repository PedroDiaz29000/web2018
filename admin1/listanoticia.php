<?php
session_start();
if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

//session_start();
//echo $_SESSION['user_rol'].'<br>--------------------------------';

        require_once("cls/bd.php");
        $bd = new BD();
        $bd->conectarBD();  
        $query="select n.id,n.idpersona,n.titulo,n.detalle,n.fecha,d.rutafoto,n.estado from noticia n, detalle d where n.id=d.noticia and d.estado_foto=1 order by n.fecha desc";
        $noti=$bd->consulta($query);
         ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador de Actividades | Whatsapp Carabayllo</title>
<style type="text/css"></style>
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

</head>
<body>

<div id="cabecera">
	<div id="banner"><img src="" width="1200" height="300" /></div> <!-- imagenes/banner_whatsapp.jpg -->
</div>


<!--inicio de cuerpo-->
<div id="cuerpo_adm">

  <div id="menu_adm">
        <div class="inicio"><a href="listanoticia.php"><img src="imagenes/boton_inicio.jpg" width="144" height="37" /></a>
      </div>
        <div class="nuevo"><a href="registro_noticia.php"><img src="imagenes/boton_nuevo.jpg" width="144" height="37" /></a>
        </div>
<!--         <div class="salir"><a href="lista_publi.php"><img src="imagenes/boton_publicidad.jpg" width="144" height="37" /></a></div>--> 
    <div class="salir"><a href="salir.php"><img src="imagenes/boton_salir.jpg" width="144" height="37" /></a>
        </div>
    <div class="tit_adm">
        Administrador de Actividades
        </div>
  </div>
  
  <div class="tabla">
    <table id="lista" class="order-column" width="1200" border="0" cellspacing="3" cellpadding="3">
     <thead>
      <tr class="tit_tabla_adm">
        <td width="50" bgcolor="#555555">id</td>
<!--        <td width="130" bgcolor="#555555">N° Celular</td> -->
        <td width="260" bgcolor="#555555">Titular</td>
        <td width="300" bgcolor="#555555">Detalle</td>
        <td width="120" bgcolor="#555555">Fecha</td>
        <td width="100" bgcolor="#555555">Foto</td>
        <td width="174" bgcolor="#555555">Opción</td>
      </tr>
    </thead>
    <tbody>
      <?php
 while ($row = $bd->fetch_array($noti)){
         
            $id = $row["id"];
            $idpersona= $row["idpersona"];
            $titulo = $row["titulo"];
            $detalle= $row["detalle"];
            $fecha = $row["fecha"];
            $foto = $row["rutafoto"];
      $estado = $row["estado"];


if($estado==1){
      ?>

      <tr>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo $id; ?></td>
<!--        <td bgcolor="#eee" class="tex_tabla_adm"><?php ///echo $idpersona; ?></td> -->
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo utf8_encode($titulo); ?></td>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo (strlen($detalle)<=100) ? $detalle : substr($detalle, 0,100)."...";?></td>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo $fecha; ?></td>
        <td bgcolor="#eee">
        <a class="tooltipWrapper" onClick="window.open('actualizar_foto.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 700,left='+(screen.width/2-425)+',top=50')">
        <img src="<?php echo $foto; ?>" width="100" height="88" style="cursor:pointer"/><span class="tooltip">Editar imagenes</span></a></td>
        <td align="center" bgcolor="#eee">
        <a onClick="window.open('actualizar_noticia.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 700,left='+(screen.width/2-425)+',top=50')">
        <img src="imagenes/boton_editar.png" width="144" height="33" style="cursor:pointer"/></a><br />
         <a href="proceso.php?opcion=desactivar&id=<?php echo $id;?>">
        <img src="imagenes/boton_activado.png" width="144" height="33" /><FFD2D2</td>
      </tr>
<?php 
}
 else if($estado==0){

?>

      <tr>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $id; ?></td>
<!--        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php // echo $idpersona; ?></td> -->
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $titulo; ?></td>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo (strlen($detalle)<=100) ? $detalle : substr($detalle, 0,100)."...";?></td>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $fecha; ?></td>
        <td bgcolor="#FFD2D2">
        <a class="tooltipWrapper" onClick="window.open('actualizar_foto.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 650,left='+(screen.width/2-425)+',top=50')">
        <img src="<?php echo $foto; ?>" width="100" height="88" style="cursor:pointer"/><span class="tooltip">Click para editar la foto</span></a></td>
        <td align="center" bgcolor="#FFD2D2">
          <a onClick="window.open('actualizar_noticia.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 650,left='+(screen.width/2-425)+',top=50')">
          <img src="imagenes/boton_editar.png" width="144" height="33" style="cursor:pointer"/></a><br />
          <a href="proceso.php?opcion=activar&id=<?php echo $id;?>">
          <img src="imagenes/boton_desactivado.png" width="144" height="33" /></a></td>
        </tr>
      <?php } }?>
    </tbody>
      <tr>
        <td colspan="7" bgcolor="#555">&nbsp;</td>
      </tr>
    </table>
  </div>
   </div>
<!--fin de cuerpo-->
<script type="text/javascript">
      $(function () {
         $('#lista').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "order": [[ 0, "desc" ]],
          "bInfo": true,
          "bAutoWidth": false,
      	  "oLanguage": {
            "oPaginate": { 
                "sPrevious": "Anterior", 
                "sNext": "Siguiente", 
                "sLast": "Ultima", 
                "sFirst": "Primera" 
                  }, 
            "sInfoFiltered": " - filtrando de _MAX_ registros",
            "sLengthMenu": 'Mostrar <select>'+ 
            '<option value="-1">Todos</option>'+ 
            '</select> registros', 
            "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)",
            "sSearch": "Buscar:",
            "sInfoEmpty": "No hay resultados de búsqueda", 
            "sZeroRecords": "No hay registros a mostrar"
                    
        }});
      });
    </script>
<!--inicio de pie-->
<div id="pie">
	<div id="barrita_verde">
	</div>
    <div id="creditos">
    	<img src="imagenes/creditos.png" width="475" height="89" />
    </div>
</div>
<!--fin de pie-->

</body>
</html>
