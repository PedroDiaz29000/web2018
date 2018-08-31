<?php
    session_start();
if(empty($_SESSION['loggedin'])) 
{   header("location: index.php/../..");    }  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Estudiantes</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    
<?php
include('menu.php');
?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/user01.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles">Admin Name</span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="index.html" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li  class="tooltips-general search-book-button" data-href="searchbook.html" data-placement="bottom" title="Buscar libro">
                    <i class="zmdi zmdi-search"></i>
                </li>
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
      
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Lista de Simpatizantes</div>
<div class="outer_div"></div>

                </form>
            </div>
        </div>                
    </div>
</body>
</html>
<script type="text/javascript">
      $(document).ready(function(){
          load(1);
      })

          function load(page){
        var parametros = {"action":"ajax","page":page};
        $("#loader").fadeIn('slow');
        $.ajax({
            url:'pagi_interesados.php',
            data: parametros,
             beforeSend: function(objeto){
            $("#loader").html("<img src='loader.gif'>");
            },
            success:function(data){
                $(".outer_div").html(data).fadeIn('slow');
                $("#loader").html("");
            }
        })
    }


  function delete_($id){
        var mensaje = confirm("Desea Eliminar la publicación");
        if(mensaje){
            var parametros = {
                    'id' : $id,
                };
            $.ajax({
                url:"assets/dt/registro_delete.php",                
                type:"POST",
                data: parametros,
                success: function(data){            
                alert(data);
 load(1);
               }
            });
        }else{alert("Haz denegado la Eliminación !!!");} 
}

</script>