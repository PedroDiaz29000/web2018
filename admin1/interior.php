<?php 
date_default_timezone_set("America/Lima");
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();
$id=$_REQUEST['id'];
$query="select n.id,n.idpersona,n.titulo,n.detalle,n.fecha,d.rutafoto,n.categoria, n.calificacion from noticia n, detalle d where n.id=d.noticia and n.id=$id";
$noti=$bd->consulta($query);
$codigo="";$numero="";$titulo="";$detalle="";$fecha="";$foto="";$categoriav="";
$calificacion="";
while ($row = $bd->fetch_array($noti)){
            $codigo = $row["id"];
            $numero = $row["idpersona"];
			$titulo = ucfirst($row["titulo"]);
            $detalle = ucfirst($row["detalle"]);
			$fecha = $row["fecha"];
            $fotonoti = $row["rutafoto"];
			$categoriav = $row["categoria"];
			$calificacion = $row["calificacion"];
			$calificacion++;
			$query_calificacion="update noticia set calificacion=$calificacion where id=$codigo";
			$calificacion_ejecuta=$bd->proceso($query_calificacion);
			$dia = date_format(date_create($fecha),"d");
			$mes = date_format(date_create($fecha),"m");
			switch($mes)
			{	case "1":$mes="Ene";break;
				case 2:$mes="Feb";break;
				case 3:$mes="Mar";break;
				case 4:$mes="Abr";break;
				case 5:$mes="May";break;
				case 6:$mes="Jun";break;
				case 7:$mes="Jul";break;
				case 8:$mes="Ago";break;
				case 9:$mes="Sep";break;
				case 10:$mes="Oct";break;
				case 11:$mes="Nov";break;
				case 12:$mes="Dic";break;
				default:break;
			}
			$anio=date_format(date_create($fecha),"Y");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="canonical" href="http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>" />

<!-- meta google plus -->
<html itemscope itemtype="http://schema.org/Other">
<meta itemprop="name" content="<?php echo $titulo;?>">
<meta itemprop="description" content="<?php echo (strlen($detalle)<=100) ? $detalle : substr($detalle, 0,100)."...";?>">
<meta itemprop="image" content="http://www.municarabayllo.gob.pe/whatsapp/<?php echo $fotonoti;?>">
<!-- end meta google plus. -->

<meta charset="utf-8">

<!-- METAS FACeBOOK---->
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>" />
<meta property="og:title" content="<?php echo $titulo;?>" />
<meta property="og:description" content="<?php echo (strlen($detalle)<=100) ? $detalle : substr($detalle, 0,100)."...";?>" />
<meta property="og:image" content="http://www.municarabayllo.gob.pe/whatsapp/<?php echo $fotonoti;?>" />
<!-- END  meta facxebook-->

<!-- METAS twitter-->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@whatsapp-carabayllo" />
<meta name="twitter:creator" content="@Municipalidad de Carabayllo" />
<meta name="twitter:domain" content="http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>" />
<meta name="twitter:description" content="<?php echo (strlen($detalle)<=100) ? $detalle : substr($detalle, 0,100)."...";?>" />
<!-- END  meta twitter-->




<title><?php echo $titulo;?></title>



<style type="text/css"></style>
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/responsiveslides.css">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <link rel="stylesheet" href="css/orbit.css"/>
<script type="text/javascript" src="js/jquery.orbit.js"></script>
	
<script type="text/javascript">
			$(window).load(function() {
			$('#responsive').orbit({bullets: true, fluid: true});
			});
		</script>

  <script src="js/responsiveslides.min.js"></script>
  <script>
    // You can also use "$(window).load(function() {"
    $(function () {

      // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 800
      });
    });
  </script>
</head>

<body>


<!--inicio plugin face-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--fin plug face-->


<div id="cabecera">

	<div id="banner"><a href="index.php"><img src="imagenes/banner_whatsapp.jpg" width="1200" height="300" /></a></div>

</div>

<!--inicio de cuerpo-->
<div id="cuerpo">

  <!--inicio de publi-->
  <div id="publi">

    <div id="aviso">

    <div id="responsive">
    	<?php 
			$query8="select url,imagen from publicidad where estado='1'";
          	$pub=$bd->consulta($query8);
            while ($rowd = $bd->fetch_array($pub)){
            $ur = $rowd["url"];
            $im= $rowd["imagen"];
    	 ?>
    <a href="<?php echo $ur; ?>" target="_blank"><img src="<?php echo $im; ?>" width="285" height="400" alt="<?php echo $im; ?>"></a>
    <?php } ?>
    </div>

    </div>

    <div id="lomejor">
        <div class="tit_lomejor">
        Lo más visto de whatsapp 
        </div>
        <?php
                $query="select top 3 n.id,n.titulo,d.rutafoto,n.calificacion from noticia n,detalle d where n.id=d.noticia and d.estado_foto=1 order by calificacion desc";
                $noti=$bd->consulta($query);
                $con=0;
            while ($row = $bd->fetch_array($noti)){
            $con=$con+1;
            $id = $row["id"];
            $titu = ucfirst($row["titulo"]);
            $fo = $row["rutafoto"];
                ?>  
<a href="interior.php?id=<?php echo $id?>">
        <div class="lomejor<?php echo $con;?>">
            <div class="num_lomejor">
            <img src="imagenes/num_lomejor<?php echo $con;?>.png" width="47" height="118" /> </div>
            <div class="tex_lomejor">
            <?php echo $titu;?>
            </div>
            <div class="foto_lomejor">
            <img src="<?php echo $fo;?>" width="122" height="108" /> </div>    
        </div>
            </a>
       <?php }?>
        
    </div>

   <div id="categorias">
    
        <div class="categorias_tit">
        Principales Categorias
        </div>
        <div class="categorias_barra1">
        </div>
        <?

			$querycate="select categoria, count(*) as cantidad from noticia where estado = 1 group by categoria order by cantidad desc";
            $cate=$bd->consulta($querycate);
            $con=0;
            while ($row = $bd->fetch_array($cate)){
            $con=$con+1;
            $categoria1= $row["categoria"];
            $cantidad = $row["cantidad"];
			$fon_lista="#313140";
			switch($con) 
			{
			case 1:
				$fon_lista="#313140";
			break;
			case 2:
				$fon_lista="#424251";
			break;
			case 3:
				$fon_lista="#535362";
			break;
			case 4:
				$fon_lista="#646473";
			break;
			case 5:
				$fon_lista="#757584";
			break;
			default:
				$fon_lista="#868695";
			}
$te4 = str_replace("_"," ",$categoria1);
$rescat=ucfirst($te4);
			
			
            
		?>

		<a href="index.php?cate=<?php echo $categoria1?>">
        <div class="categorias_lista" style="background:<?php echo $fon_lista; ?>">
        	<div class="nombre_categoria">
			
            	<li style=""><?php echo $rescat; ?></li>
            </div>
            <div class="numero_categoria">
            	[<?php echo $cantidad;?>]
            </div>
        </div>
    </a>
        <? } ?>
        <div class="categorias_barra2">
        </div>
    
    </div>
  </div>    
  <!--fin de publi-->

	<!--inicio diseño de actividad detalle-->
  <div class="actividad_detalle">
     
		<div class="barrita_naranja">
		</div>
		<div class="tit_detalle">
        <span  itemprop="name"><?php echo $titulo; ?></span>
		</div>
		<div class="foto_detalle">
			<ul class="rslides">
			<?php  
				$queryfotof="select rutafoto from detalle where noticia='$codigo' and estado_foto not in(3) order by estado_foto";
				$fotof=$bd->consulta($queryfotof);
				
				while ($rowf = $bd->fetch_array($fotof)){
				$fotofinal=base64_encode($$rowf['rutafoto']);
				
				?>
				<li><img itemprop="image" src="<?php echo $rowf['rutafoto']?>" width='592' height='518'></li>
				<?php
				}
			?>
			</ul>
		</div>
		<div class="fecha_detalle">
            	<p class="dia_actividad"><?php echo $dia; ?></p>
            	<p class="mes_actividad"><?php echo $mes; ?></p>
		</div> 
   	   <div class="texto_detalle">
		<?php echo $detalle; ?>
        <hr>
	   Participa y colabora, si observas una situación parecida en nuestro distrito envíanos tu denuncia a través de nuestro <strong>WhatsApp Carabayllo</strong> al número <strong>981-398-520.</strong></div>
       <div class="barrita_naranja">
       </div>
	</div>
	<!--fin diseño de actividad detalle-->

    <!--inicio de centro-->
	<div id= "centro">
		<div id= "tit_centro">
        Comentar 
		</div>
        <div id= "comentario_facebook">
            <div class="fb-comments" data-href="http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>" data-width="285" data-numposts="1" data-colorscheme="light"></div>
        </div>
		<div id= "tit_centro">
        Compartir 
		</div>
		<div id= "compartir_redes">
            <div id= "redes_gmas">
				<a href="#" onClick="window.open('https://plus.google.com/share?url=http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>', 'popup', 'width = 600, height = 700,left='+(screen.width/2-425)+',top=50')">
        <img src="imagenes/google_ico.png" WIDTH="50" HEIGHT="50">
        </a>
		       </div>
          <div id= "redes_face">
           <a href="#" onClick="window.open('http://facebook.com/sharer.php?u=http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=<?php echo $codigo;?>', 'popup', 'width = 600, height = 700,left='+(screen.width/2-425)+',top=50')">
            <img src="imagenes/face_ico.png" WIDTH="50" HEIGHT="50">
			</a> 			
			  </div>
            <div id= "redes_tweter">
			<?php $li= urlencode("http://www.municarabayllo.gob.pe/whatsapp/interior.php?id=$codigo");?>
              <a href="#" onClick="window.open('http://twitter.com/home?status=<?php echo $titulo."  Mas información en ".$li." - @whatsappcarabayllo";?>', 'popup', 'width = 600, height = 700,left='+(screen.width/2-425)+',top=50')">
            <img src="imagenes/twitter_ico.png" WIDTH="50" HEIGHT="50">
            </a>
            </div>
        </div>
		

        <div id= "tit_centro">
        También ver... 
		</div>
		<?php 
		$tambiencount="select count(n.categoria) as numero from noticia n, detalle d where n.estado =1 and n.id=d.noticia and n.id NOT IN ('$codigo') and n.categoria='$categoriav' and d.estado_foto=1";
		
		$tvercount=$bd->consulta($tambiencount);
		while ($rowtvercount = $bd->fetch_array($tvercount)){$numero = $rowtvercount["numero"];}
		$numero=$numero;
			
		
		//echo $tambien;
		$randon1=rand(5, 15);
		$randon2=rand(15, 25);
		if($numero==0){
			$tambien="select top 2 n.id,n.idpersona,n.titulo,n.detalle,n.fecha,d.rutafoto,n.categoria from noticia n, detalle d where n.estado =1 and n.id=d.noticia and n.id NOT IN ('$codigo') and d.estado_foto=1";
		}
		if($numero==1){
			$tambien="select top 2 n.id,n.idpersona,n.titulo,n.detalle,n.fecha,d.rutafoto,n.categoria from noticia n, detalle d where n.estado =1 and n.id=d.noticia and n.id NOT IN ('$codigo') and d.estado_foto=1";
		}
		if($numero>=2){
			$tambien="select top 2 n.id,n.idpersona,n.titulo,n.detalle,n.fecha,d.rutafoto,n.categoria from noticia n, detalle d where n.estado =1 and n.id=d.noticia and n.id NOT IN ('$codigo') and n.categoria='$categoriav' and d.estado_foto=1";
		}
		
		$tver=$bd->consulta($tambien);
		while ($rowtv = $bd->fetch_array($tver)){
			$diatv=date_format(date_create($rowtv['fecha']),"d");
			$mestv=date_format(date_create($rowtv['fecha']),"m");
			switch($mestv)
			{	case 1:$mestv="Ene";break;
				case 2:$mestv="Feb";break;
				case 3:$mestv="Mar";break;
				case 4:$mestv="Abr";break;
				case 5:$mestv="May";break;
				case 6:$mestv="Jun";break;
				case 7:$mestv="Jul";break;
				case 8:$mestv="Ago";break;
				case 9:$mestv="Sep";break;
				case 10:$mestv="Oct";break;
				case 11:$mestv="Nov";break;
				case 12:$mestv="Dic";break;
				default:break;
			}
			$aniotv=date_format(date_create($fecha),"Y");
		?>
		<!--inicio diseño de actividad-->
		<a href="interior.php?id=<?php echo $rowtv['id'] ?>">
         <div class="actividad_vertical_detalle">
            <div class="foto"><img src="http://www.municarabayllo.gob.pe/whatsapp/<?php echo $rowtv['rutafoto'] ?>" width="285" height="250"/>
            </div>
            <div class="fon_fecha_vertical">
        	<div class="fecha">
            	<p class="dia_actividad"><?php echo $diatv; ?></p>
            	<p class="mes_actividad"><?php echo $mestv; ?></p>	
		  	</div>
            <div class="mas_v"><img src="imagenes/mas_vertical.jpg" width="40" height="85" /></div>
		</div>
           <div class="tit_actividad_vertical">
                <p><?php echo $rowtv['titulo']; ?></p>
           </div>
        </div>
		</a>
		<!--fin diseño de actividad-->
		<?php
		}
		?>
        
		
		
		
  </div>
    <!--fin de centro-->
    
</div>
<!--fin de cuerpo-->


<!--inicio de pie-->

<div id="pie">
	<div id="barrita_verde">
	</div>
    <div id="creditos"> <a href="index.php"><img src="imagenes/creditos.png" width="475" height="89" /></a>
    </div>
</div>

<!--fin de pie-->
<script src="js/responsiveslides.js"></script>
<script>
  $(function() {
    
	$(".rslides").responsiveSlides({
  auto: true,             // Boolean: Animate automatically, true or false
  speed: 500,            // Integer: Speed of the transition, in milliseconds
  timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
  pager: false,           // Boolean: Show pager, true or false
  nav: false,             // Boolean: Show navigation, true or false
  random: false,          // Boolean: Randomize the order of the slides, true or false
  pause: false,           // Boolean: Pause on hover, true or false
  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
  prevText: "Previous",   // String: Text for the "previous" button
  nextText: "Next",       // String: Text for the "next" button
  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
  manualControls: "",     // Selector: Declare custom pager navigation
  namespace: "rslides",   // String: Change the default namespace used
  before: function(){},   // Function: Before callback
  after: function(){}     // Function: After callback
});
  });
</script>




</body>
</html>
