<?php
session_start();
if(empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>
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
$query="select n.id,n.idpersona,n.titulo,n.detalle,n.fecha,n.categoria from noticia n where n.id=$id";
$noti=$bd->consulta($query);
$numero="";$titulo;$detalle="";$fecha="";$fotonoti="";
while ($row = $bd->fetch_array($noti)){
			$codigo = $row["id"];
            $numero = $row["idpersona"];
			$titulo = $row["titulo"];
            $detalle=$row["detalle"];
			$fecha = $row["fecha"];
			$categoria=$row["categoria"];
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

 <div class="tit_actualiza">Actualizar Noticias</div>
 
 <div class="caja_actualiza">

 <!--<form action="grabarnoticia.php?opcion=actualizar_text" method="get">-->
 <form action="proceso.php?opcion=actualizar_text" method="post" onsubmit="cerrar_ventana()">
<input  type="hidden" size="3" id="combo1"  name="txtid" value="<?php echo $id; ?>" readonly />
<!--
<br>
<div class="text_actualiza_noticias">Numero Whatsapp</div>
<input placeholder="Escriba el numero de Whatsapp" class="solo-numero" type="text" name="txtnumero" id="txtnumero" autofocus value="<?php echo $numero; ?>" required maxlength="9"/>
-->
<br><br>
<div class="text_actualiza_noticias">Titulo</div>

<textarea  name="txttitulo" id="txttitulo" cols="100" rows="2" onkeypress="validaCaractaer(event);"><?php echo ucfirst($titulo); ?></textarea>

<br><br>
<div class="text_actualiza_noticias">Descripcción de la noticia</div>

<textarea name="txtdetalle" id="txtdetalle" cols="100" rows="6" onkeypress="validaCaractaer(event);"><?php echo $detalle; ?></textarea>
<br>
<!-- <div class="text_actualiza_noticias">Categoria de la Noticia</div> -->
<!--
			<select id="txtcate" name="txtcate">
			<?php
				/*
$t1 = str_replace("_"," ",$categoria);
$t2=ucfirst($t1); */
				?>
				<option value="<?php // echo $categoria; ?>"><?php // echo $t2; ?> </option>
				<?php
				/*
$querycat="select categoria from categoria where categoria not in('$categoria')";
$ct=$bd->consulta($querycat);
while ($rowc = $bd->fetch_array($ct)){

$cte=$rowc["categoria"];

$texto = str_replace("_"," ",$cte);
$tec=ucfirst($texto); */
				?>
				
  				<option value="<?php// echo $cte; ?>"> <?php //echo $tec; ?></option>
				<?php
		//		}
 				?>
  				</select>
  				-->
			<br><br><br>
			<input name="btnactualizar" class="btn btn-primary" type="submit" value="Actualizar" />
			
			<div id="status"></div>
			
			
		</form>
	</div>











<script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
<script>

 
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#data').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
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
	
	//$(document).on("change",".fileinput",function(){
		//readURL(this);
				
			//var as=$(this).css('color', 'red');alert(as);
			//var ssd=$(".fileinput").attr('val');alert(ssd);
			//var as1=$(this).attr('src',$(".fileinput").attr('value'));alert(as1);
		//var as=$(this).find( ".previa" ).attr('src');
		//alert(as);
		//alert($(this).parents().get(1);//attr('src'));
		//var src = $(this).attr('src');
		//$(".previa").attr("src","img/origen_2.jpg");

		//var parent3 = $(this).get(0).(".previa").attr('src');
		//alert(parent3);
		//var parent = $(this).parents().get(1);//row
		//alert(parent);
		//var parent2 = $(this).parents().get(0);//cell
		//alert(parent2);
		//$(parent).find(".previa").attr('src', src);
	//});
	
	// Evento que selecciona filas y las elimina 
	$("#eliminafoto").on('click', function(){
		$("#tabla").find("tr:gt(0)").remove();
	});
	
	
		
       
});
      $(function () {
        /*$('.solo-numero').keyup(function (){
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
	  function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
   $('#img_destino').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
 
$("#txtfoto").change(function(){
 mostrarImagen(this);
});
    
	
function validaCaractaer(pEvent){
if (pEvent.keyCode==222) //esta es la letra '
{
pEvent.keyCode = 0; //Cuando le haces esto le impides la escritura del caracter en la caja
}
}	
</script>
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


</body>
</html>