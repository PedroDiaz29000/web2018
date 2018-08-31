<?php
session_start();
if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once("cls/bd.php");
$bd = new BD();
//$bd->conectarBD();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

 <script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nuevo registro de actividad | Whatsapp Carabayllo</title>
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
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css" />
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
        Administrador de Actividades</div>
  </div>
  
  <div class="tit_nuevo">
  Ingresar nuevo registro de actividad   
  </div>
  <div class="caja_nuevo">
  <form class="formu" action="proceso.php?opcion=nuevo" method="POST" enctype="multipart/form-data">
<!--        <div class="text_campo">
        NÚMERO WHATSAPP
      </div>
        <div class="numero">
          <label for="textfield"></label>
          <input placeholder="Solo numeros" class="solo-numero" type="text" name="txtnumero" id="txtnumero" autofocus required maxlength="9"/>
        </div> -->
        <div class="text_campo">
        TÍTULO
      </div>
        <div class="numero">
          <label for="textfield2"></label>
          <input name="txttitulo" type="text" id="txttitulo" size="125" />
        </div>
        <div class="text_descripcion">
        DESCRIPCIÓN
        </div>
        <div class="descripcion">
        <textarea name="txtdetalle" id="txtdetalle" cols="150" rows="10"></textarea>
        </div>
        <div class="agregar_foto">
          <?php
          $query1="select MAX(id) as id from noticia";
          $cod=$bd->consulta($query1);
          while ($rowcod = $bd->fetch_array($cod)){$id = $rowcod["id"];}
          $idnuevo=$id+1;
          ?>
        <a onClick="window.open('subir_foto.php?id=<?php echo $idnuevo; ?>', 'popup', 'location=no, width = 800, height = 650,left='+(screen.width/2-425)+',top=50')">
        <img src="imagenes/boton_agregar.png" width="144" height="33" /></a>
        </div>



       
          <div class="caragar_imagen" id="imagen">  </div>

<!--      <div class="text_categorias">
        SELECCIONE CATEGORIA
		</div> -->
<!--
        <div class="categorias">
          <label for="select"></label>
          <select name="txtcate" id="txtcate" onchange="this.nextElementSibling.value=this.value">

            <? /*
            $querycate="select categoria from categoria";
            $cate=$bd->consulta($querycate);
            while ($row = $bd->fetch_array($cate)){
           
            $catego = $row["categoria"];
            $te4 = str_replace("_"," ",$catego);
            $rescat=ucfirst($te4);

             $te5 = str_replace(" ","_",$te4);

*/
            ?>
            <option value="<?php // echo $te5; ?>"><?php // echo $te4; ?></option>
            <?php //} ?>
          </select>
      	</div> -->
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
    
</div>
<!--fin de cuerpo-->
<script src="js/jquery.js"></script>
<script type="text/javascript">

CKEDITOR.replace( 'txtdetalle',
{
toolbar :
[
['Styles', 'Format'],

['Bold', 'Italic', '-', 'NumberedList',
'BulletedList']
]
} );

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
<script>

$(function () {
// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
  $("#nuevafoto").on('click', function(){
    $("#tabla tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla tbody");
  });
 
  // Evento que selecciona la fila y la elimina 
  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
  //cambiar foto
  
  $(".fileinput").on('change', function(){
    readURL(this);
  
  });
  
  $(".lista").on('click', function(){
    $(location).attr('href', 'listanoticia.php');
  });
  $("#eliminafoto").on('click', function(){
    $("#tabla").find("tr:gt(0)").remove();
  });

});

 $(function () {
/*        $('.solo-numero').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
          }); */
    $('.solo-letra').keyup(function (){
            this.value = (this.value + '').replace(/[^a-zA-Z]/g, '');
          });
    $('.solo-nombre').keyup(function (){
            this.value = (this.value + '').replace(/[^a-zA-Z ñ Ñ ]/g, '');
          });
    $('.solo-direccion').keyup(function (){
            this.value = (this.value + '').replace(/[^a-zA-Z 0-9.]/g, '');
          });
      });

</script>
<script >
function actualiza(){
    $("#imagen").load("previa.php");
  }
setInterval( "actualiza()", 1000 );
</script>

</body>
</html>
