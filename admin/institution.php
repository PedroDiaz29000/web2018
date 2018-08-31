<?php
    session_start();
if(empty($_SESSION['loggedin'])) { 
 header("location: index.php/../..");} 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <title>Institución</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- -->  
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
                <br>
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Nueva Publicacion</button>
                <form>
                    <div class="row">    
        <div class="col-xs-12">
        <h3> <center>Lista de Publicaciones </center></h3>
                <div class="outer_div"></div>
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
                    <h4 class="modal-title"><center><div id="titu_detalle"></div> </center> </h4>
                </div>
                <div class="modal-body">
                    <label>Ingresar el Titulo</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" />
                    <br />
                    <label>Ingresar Detalle</label>
<!--                    <input type="text" name="last_name" id="last_name" class="form-control" /> -->
    <textarea class="form-control" rows="8" name="detalle" id="detalle"></textarea>
                    <br />
                    <label id="imagen_users">Seleccionar la imagene</label>
                    <input type="file" name="user_image" id="user_image" />
                    <span id="user_uploaded_image"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Agregar" />
                    <input type="button" name="action" id="editarInfor" class="btn btn-success" value="Editar" />
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

        load(1);

    $(document).on('submit', '#user_form', function(event){
event.preventDefault();

        var titulo = $('#titulo').val();
        var detalle = $('#detalle').val();
        var extension = $('#user_image').val().split('.').pop().toLowerCase();
        if(extension != '')
        {
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){ // Valida la extención de los archivos
                alert("Imagen Invalido");
                $('#user_image').val('');
                return false;
            }
        }   
        if(titulo != '' && detalle != ''){
            $.ajax({
                url:"insert.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data){ 
                    var n = data.length;
                    if(n>10){
                            load();                            
                            var titulo = $('#titulo').val('');
                            var detalle = $('#detalle').val('');
                            var extension = $('#user_image').val('');
                        $('#userModal').modal('hide');
                            alert(data);
                    }else{
                            alert(data);
                    }
               }
            });
        }else{
            alert("Ingrese la Información Solicitada.");
            return false;
        }
    });

    $('#add_button').click(function(){
        $('#user_image').show();
        $('#imagen_users').show();    
        $('#action').show();    
        $('#editarInfor').hide();   
        $('#titu_detalle').html('');      
        $('#titu_detalle').html('Registro de Nuevo Evento');      
clear_();
    })
  
  $("#editarInfor").click(function(){
        var titulo = $('#titulo').val().trim();
        var detalle = $('#detalle').val().trim();

        if(titulo != '' && detalle != ''){
                var parametros = {'vl' : 2,
                'cu' : $("#user_id").val(),
                'title' : titulo,
                'detail' : detalle
                        };
                $.ajax({
                        url:"assets/dt/edit_public.php",                
                        type:"POST",
                        data: parametros,
                        success: function(data){            
                            alert(data);
                             $('#userModal').modal('hide');
                             clear_();
                            load(); 
                       }
                    });
        }else{ alert('Tiene que llenar los campos Solicitados');}
  })

$("#CLOSE_").click(function(){ window.location='close.php'; })

    });


    function load(page){
        var parametros = {"action":"ajax","page":page};
        $("#loader").fadeIn('slow');
        $.ajax({
            url:'paises_ajax.php',
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

function editando($id){
clear_();
    $('#user_image').hide();
    $('#imagen_users').hide();    
    $('#action').hide();    
    $('#editarInfor').show();            
    $('#userModal').modal('show');
    $('#titu_detalle').html('');      
    $('#titu_detalle').html('Editar Información');      
            var parametros = {'id' : $id,'vl' : 1
                };
        $.ajax({
                url:"assets/dt/edit_public.php",                
                type:"POST",
                data: parametros,
                success: function(data){            
                    var str =data;
                    var res = str.split("-");
                    $("#user_id").val(res[0]);
                    $("#titulo").val(res[1]);
                    $("#detalle").val(res[2]);
               }
            });

}

function clear_(){
    $("#user_id").val('');
    $("#titulo").val('');
    $("#detalle").val('');
    $('#user_image').val('');
}



</script>
