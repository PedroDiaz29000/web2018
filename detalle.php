<?php
include_once('admin_/assets/models/publicidad.php');

$VALO = $_GET['vl'];

if(is_numeric($VALO)){
$Objeto_publicidad = new publicidad();
$result = $Objeto_publicidad->ObtenerPublicidadDetalle($VALO);
}else{
  echo "";//No es numero
}
  if($result== true){ 
    $rutasImg='';
    while ($fila = $Objeto_publicidad->fetch_array($result)){
      $titulo=utf8_encode($fila[0]);
      $detalle=utf8_encode($fila[1]);
      $imagen=$fila[2];
      $rutasImg.='<a href="#"><img src="'.$imagen.'" width="578" height="258" alt=""></a>';//<img src="admin1/'.$imagen.'" width="578" height="258" alt=""></a>
    }
    echo $datos;
  }else{echo "Error !!!";}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raúl Díaz Pérez - Alcalde de Comas 2018</title>
  <link rel="icon" type="image/png" href="imagenes/ico-raul.png" />
<script>window.jQuery || document.write('<script src="admin/js/jquery-1.11.2.min.js"><\/script>')</script>
<link href="css/estilos_raul_diaz2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="engine1/orbit.css"/>
</head>
<body>
<div id="barra_azul"></div>
<div id="contenedor">
    <div id="cabecera">
      <div id="logo"><a href="index.php"><img src="imagenes/logo1.png"  alt=""/></a></div>
      <div id="menu_sup">
        <p><a href="index.php"><strong>INICIO</strong></a></p>
        <p><a href="biografia.html">BIOGRAFIA</a> <a href="propuesta.html">PROPUESTAS</a> <a href="contactenos.html">CONTACTENOS</a></p>
      </div>
    </div>
    <div id="banner"><iframe width="1200" height="400" src="slider.html" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
    <div id="bot_redes">
    <p>Unete a la campaña..!</p>
      <img src="imagenes/ico_redes.png" alt="" width="203" height="51" usemap="#Map2"/>
      <map name="Map2">
          <area shape="rect" coords="1,2,75,80" href="https://www.facebook.com/raul.diazperez.16" target="_blank" alt="FACEBOOK">
          <area shape="rect" coords="95,0,150,80" href="https://twitter.com/rauldiaz2018?lang=es" target="_blank" alt="TWITTER">
          <area shape="rect" coords="170,1,230,80" href="https://www.youtube.com/channel/UCIb3TU_1OuC_HA9Su4BVTWQ" target="_blank" alt="YOUTUBE">
      </map>
  </div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.0&appId=256894288396165&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div id="conte_noticias">
      <div class="noticia">

        <div class="noti_img">
  <div id="eventos">
   <div id="responsi">
<?php echo $rutasImg; ?>
   </div>
</div>
        </div>
        <div class="noti_tex">
          <h1><?php echo $titulo; ?></h1>   
          <hr>
        </div>
<div id="detalle">
 <div style="width: 100%; height: 200px; overflow-y: scroll; font-size:14px; ">
  <?php echo $detalle; ?>   
    </div>
</div>
<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/RaulDiazPerez2018" data-width="100%" data-numposts="2"></div>

      </div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--      <div class="noticia"> -->
<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FRaulDiazPerez2018%2F&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
<!--      
  </div> -->

  <div id="bot_propuesta">
      <p>Nuestro Plan de Gobierno</p>
     <a target="_blank" href="http://rauldiaz.com.pe/PLAN_GOBIERNO_2019_2022.pdf"><img src="imagenes/ico_pdf.png"  alt=""/></a>
  </div>
  <div id="noti_destacado">
      <div id="tex_noti_destacado">
    <p>“Haremos<br>
         una ciudad<br>
        para todos”</p></div>
      <div id="img_noti_destacado"><img src="imagenes/noti_destacada.jpg" width="600" height="335" alt=""/>
    </div>
    </div>
  
</div>

<div id="pie1">
  <div id="conte_pie1">
  <p>UNETE A NOSOTROS..! </p>
  </div>
</div>
<div id="pie2">
  <div id="conte_pie2">
    <div id="pie2_izq">
    <div id="lugar">
        <img src="imagenes/ico_lugar.png"  height="26" alt=""/>
        <p> Av. Tupac Amaru 2964 - Comas - Lima</p>
    </div>

    <div id="wasap"> 
        <img src="imagenes/ico_wasap.png"  height="26" alt=""/>
        <p>912 - 308 - 353 </p>
    </div>
    </div>
    <div id="pie2_der">
      <div id="menu_sup">
    <p><a href="index.php"><strong>INICIO</strong></a></p>
        <p><a href="biografia.html">BIOGRAFIA</a> <a href="propuesta.html">PROPUESTAS</a> <a href="contactenos.html">CONTACTENOS</a></p>
    </div>
      <div id="pie_redes"><img src="imagenes/ico_redes.png" alt="" width="203" height="51" usemap="#Map"/>
        <map name="Map">
          <area shape="rect" coords="1,2,51,50" href="https://www.facebook.com/raul.diazperez.16" target="_blank" alt="FACEBOOK">
          <area shape="rect" coords="75,0,129,50" href="https://twitter.com/rauldiaz2018?lang=es" target="_blank" alt="TWITTER">
          <area shape="rect" coords="154,1,206,49" href="https://www.youtube.com/channel/UCIb3TU_1OuC_HA9Su4BVTWQ" target="_blank" alt="YOUTUBE">
        </map>
      </div>
    </div>
  </div>
</div>
</body>
</html>
 <script type="text/javascript" src="engine1/jquery.orbit.js"></script> 
    <script>
$(function () {
  $('#responsi').orbit({bullets: true, fluid: true});
});
</script>