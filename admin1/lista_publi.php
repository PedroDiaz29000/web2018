<?php
        require_once("cls/bd.php");
        $bd = new BD();
        $bd->conectarBD();  
        $query="select codigo,url,imagen,estado,fecha from publicidad";
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
</head>
<body>

<div id="cabecera">
	<div id="banner"><img src="imagenes/banner_whatsapp.jpg" width="1200" height="300" /></div>
</div>


<!--inicio de cuerpo-->
<div id="cuerpo_adm">

  <div id="menu_adm">
        <div class="inicio"><a href="listanoticia.php"><img src="imagenes/boton_inicio.jpg" width="144" height="37" /></a>
      </div>
        <div class="nuevo"><a href="registro_noticia.php"><img src="imagenes/boton_nuevo.jpg" width="144" height="37" /></a>
        </div>
         <div class="salir"><a href="lista_publi.php"><img src="imagenes/boton_publicidad.jpg" width="144" height="37" /></a>
        </div>     
        
    <div class="salir"><a href="salir.php"><img src="imagenes/boton_salir.jpg" width="144" height="37" /></a>
        </div>       
       
        
    <div class="tit_adm">
        Administrador de Actividades
        </div>
  </div>

<div class="tit_nuevo">
  Ingresar Nueva Publicidad   
  </div>
  <div class="caja_nuevo">
     <?php 
          $query1="select MAX(codigo) as id from publicidad";
          $cod=$bd->consulta($query1);
          while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
          $idnuevo=$id+1;
          ?>
  <form class="formu" action="proceso.php?opcion=nuevapubli&id=<?php echo $idnuevo;?>" method="POST" enctype="multipart/form-data">
            
        <div class="text_campo">
        Enlace:
      </div>
        <div class="numero">
          <label for="textfield2"></label>
          <input name="txtenlace" type="text" id="txtenlace" size="100" autocomplete="on" />
        </div>

       
        <div class="agregar_foto">
         
        <a onClick="window.open('subir_publi.php?id=<?php echo $idnuevo; ?>', 'popup', 'location=no, width = 800, height = 650,left='+(screen.width/2-425)+',top=50')">
        <img src="imagenes/boton_agregar.png" width="144" height="33" /></a>
        </div>

       
          <div class="caragar_imagen" id="imagen">  </div>

     <div class="separa">
        <hr>
        </div>
    <div class="centra_boton">
            <div class="grabar">
         <button type="submit" id="formreg"> <img src="imagenes/boton_grabar.png" width="106" height="36" /></button>
                </div>
            <div class="borrar">
              <button type="reset" id="formreg"> <img src="imagenes/boton_borar.png" width="129" height="36" /></button>
                
            </div>
    </div>
  </form>
  </div>

















  
  <div class="tabla">
    <table id="lista" class="order-column" width="1200" border="0" cellspacing="3" cellpadding="3">
     <thead>
      <tr class="tit_tabla_adm">
        <td width="50" bgcolor="#555555">id</td>
        <td width="130" bgcolor="#555555">enlace</td>
        <td width="130" bgcolor="#555555">fecha</td>
        <td width="100" bgcolor="#555555">Foto</td>
        <td width="174" bgcolor="#555555">Opción</td>
      </tr>
    </thead>
    <tbody>
      <?php
 while ($row = $bd->fetch_array($noti)){
         
            $id = $row["codigo"];
            $enlace= $row["url"];
            $fecha = $row["fecha"];
            $foto = $row["imagen"];
            $estado = $row["estado"];


if($estado==1){
      ?>

      <tr>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo $id; ?></td>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo $enlace; ?></td>
        <td bgcolor="#eee" class="tex_tabla_adm"><?php echo $fecha; ?></td>
        <td bgcolor="#eee">
        <a class="tooltipWrapper" onClick="window.open('act_publi.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 700,left='+(screen.width/2-425)+',top=50')">
        <img src="<?php echo $foto; ?>" width="80" height="100" style="cursor:pointer"/><span class="tooltip">Editar imagenes</span></a></td>
        <td align="center" bgcolor="#eee">
        <a onClick="window.open('act_en.php?id=<?php echo $id;?>', 'popup', 'location=no,scrollbars=0, width = 800, height = 280,left='+(screen.width/2-425)+',top=50')">
        <img src="imagenes/boton_editar.png" width="144" height="33" style="cursor:pointer"/></a><br />
         <a href="proceso.php?opcion=desactiva_publi&id=<?php echo $id;?>">
        <img src="imagenes/boton_activado.png" width="144" height="33" /></td>
      </tr>
<?php 
}
 else if($estado==0){

?>

      <tr>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $id; ?></td>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $enlace; ?></td>
        <td bgcolor="#FFD2D2" class="tex_tabla_adm"><?php echo $fecha; ?></td>
        <td bgcolor="#FFD2D2">
        <a class="tooltipWrapper" onClick="window.open('actualizar_foto.php?id=<?php echo $id;?>', 'popup', 'location=no, width = 800, height = 650,left='+(screen.width/2-425)+',top=50')">
        <img src="<?php echo $foto; ?>" width="80" height="100" style="cursor:pointer"/><span class="tooltip">Click para editar la foto</span></a></td>
        <td align="center" bgcolor="#FFD2D2">
          <a onClick="window.open('act_en.php?id=<?php echo $id;?>', 'popup', 'location=no,scrollbars=0, width = 800, height =280,left='+(screen.width/2-425)+',top=50')">
          <img src="imagenes/boton_editar.png" width="144" height="33" style="cursor:pointer"/></a><br />
          <a href="proceso.php?opcion=activa_publi&id=<?php echo $id;?>">
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

<script >
function actualiza(){
    $("#imagen").load("previa_publi.php?id=<?php echo $idnuevo;?>");
  }
setInterval( "actualiza()", 1000 );
</script>


</body>
</html>
