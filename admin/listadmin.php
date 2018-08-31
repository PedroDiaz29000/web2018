<?php
    session_start();
if(empty($_SESSION['loggedin'])) 
{ 
 header("location: index.php/../..");    
}  

include_once('assets/models/publicidad.php');
$Objeto_publicidad = new publicidad();
$result = $Objeto_publicidad->list_titulo();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <title>Institución</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- -->  
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script> <!-- -->
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script><!-- -->
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
                <li style="color:#fff; cursor:default;" id="CLOSE_">
                    <span class="all-tittles">Cerrar Sesión</span>
                </li>
    
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>
                <div class="container-fluid">
            <div class="container-flat-form">

<select class="form-control" id="list_im">
  <option value="0" >Titulo</option>
<?php
    while ($fila = $Objeto_publicidad->fetch_array($result)) {
?>

  <option value=<?php echo $fila[0]; ?> ><?php echo utf8_encode($fila[1]); ?></option>

<?php } ?>
</select>

            </div>
        </div>

                <div class="container-fluid">
            <div class="container-flat-form">
              

                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Nueva Publicacion</button> 
                <form>
                    <div class="row">    
        <div class="col-xs-12">
        <h3> <center>Lista de Publicaciones de Imagenes  </center></h3>

                <div class="outer_div"></div><!-- Datos ajax Final -->
        </div>
           

               
                       </div>
                   </div>
               </form>
            </div>
        </div>
    </div>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registro de </h4>
                </div>
                <div class="modal-body">
 
                    <label>Seleccionar la imagene</label>
                    <input type="file" name="user_image" id="user_image" />
                    <span id="user_uploaded_image"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Agregar" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>

    <script>
    $(document).ready(function(){

        $('#add_button').hide()
lista_F(0);
    $(document).on('submit', '#user_form', function(event){
event.preventDefault();

        var area = $('#user_id').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if(extension != '')
        {
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ // Valida la extención de los archivos
                alert("Imagen Invalido");
                $('#user_image').val('');
                return false;
            }
        }   
        if(area != ''){
            $.ajax({
                url:"insert_Imagen.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){ 
                    var n = data.length;
                    if(n>10){
                         lista_F(area);
//                            var titulo = $('#titulo').val('');
//                            var detalle = $('#detalle').val('');
                            var extension = $('#user_image').val('');
                        $('#userModal').modal('hide');
                            alert(data);
                    }else{
                            alert(data);
                    }
               }
            });
        }else{alert("Verificar si el area se seleciono correctamente.");return false;
        }
    });

  $('#list_im').click(function(){
   var valor = $('#list_im').val();
   if(valor==0){
        $('#add_button').hide()
   }else{
    $('#add_button').show();    
   }
   lista_F(valor);
  })

function lista_F($id){
     var valor = $id; 
        var parametros = {"page":valor};
        $.ajax({
            url:'list_ima.php',
            type:'POST',
            data: parametros,
            success:function(data){
                $(".outer_div").html(data);
                $('#user_id').val(valor);
            }
        })
}

$("#CLOSE_").click(function(){
    window.location='close.php';
})

    });

    function state($id,$id1){
        var mensaje = confirm("Desea Cambiar el estado de la Publicación");
        if(mensaje){
            var parametros = {
                    'id' : $id,
                    'id1' : $id1,
                    'vl' : 3
                };
            $.ajax({
                url:"assets/dt/publicidad.php",                
                type:"POST",
                data: parametros,
                success: function(data){            
                alert(data);
                load(); 
               }
            });
        }else{alert("Haz denegado la operation!");}
    }

function delete_($id){
        var mensaje = confirm("Desea Eliminar la publicación");
        if(mensaje){
            var parametros = {
                    'id' : $id,
                    'vl' : 4
                };
            $.ajax({
                url:"assets/dt/publicidad.php",                
                type:"POST",
                data: parametros,
                success: function(data){            
                alert(data);
                load(); 
               }
            });
        }else{alert("Haz denegado la Eliminación !!!");}
}

function portada($id){
    var parametros = {'vl' : 5,
                        'evento' : $('#list_im').val(),
                        'dm': $id
        };
            $.ajax({
                url:"assets/dt/publicidad.php",                
                type:"POST",
                data: parametros,
                success: function(data){            
                alert(data);

     var valor = $('#list_im').val(); 
        var parametros = {"page":valor};
        $.ajax({
            url:'list_ima.php',
            type:'POST',
            data: parametros,
            success:function(data){
                $(".outer_div").html(data);
                $('#user_id').val(valor);
            }
        })
               }
            });
}


    </script>
