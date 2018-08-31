<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = 590;
  $targ_h = 518;
	$jpeg_quality = 60;

	$src = 'editadas/1-1.jpg';
	$img_r = ImageCreateFromPNG($src); //imagecreatefromjpeg ImageCreateFromPNG
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
  imagejpeg($dst_r,'editadas/2.jpg',$jpeg_quality);  
header("location:proceso.php?opcion=marca_agua");
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Cropping Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
  
  
  <script type="text/javascript">

 var api;
 
  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio: 1.14,
      onSelect: updateCoords,
	  bgOpacity: 0.5,
      bgColor: 'black',
      addClass: 'jcrop-light'
    },function(){
      api = this;
      api.setSelect([0,0,590,518]);
      api.setOptions({ bgFade: true });
      api.ui.selection.addClass('jcrop-selection');
    });
    });
   function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }


</style>
<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css">
</head>
<body>

	<!-- This is the image we're attaching Jcrop to -->
		<img src="editadas/1-1.jpg" id="cropbox" />

		<!-- This is the form that our event handler fills -->
		<form action="crop.php" method="post" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="submit" value=" Recortar la Imágen " class="btn btn-large btn-inverse" /><span class="tex_activar">[ Esta imagen sera recortada a 590 de ancho x 518 de alto ]</span>
		</form>

		

	
	</body>

</html>
