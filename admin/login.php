
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio de sesión</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <script src="js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="css/sweet-alert.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css"/>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body class="full-cover-background" style="background-image:url(assets/img/maxresdefault.jpg);">
    <div class="form-container">
        <p class="text-center" style="margin-top: 17px;">
           <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
       </p>
       <h4 class="text-center all-tittles" style="margin-bottom: 30px;">inicia sesión con tu cuenta</h4>
       <form id="datos" name="datos" method="POST">
            <div class="group-material-login">
              <input type="text" class="material-login-control" id="usuario">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-account"></i> &nbsp; Nombres</label>
            </div><br>
            <div class="group-material-login">
              <input type="password" id="password" class="material-login-control">
              <span class="highlight-login"></span>
              <span class="bar-login"></span>
              <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label>
            </div>
            <button class="btn-login" type="button" id="ingresar">Ingresar al sistema &nbsp; <i class="zmdi zmdi-arrow-right"></i></button>
        </form>
    </div>  
</body>
</html>
<script type="text/javascript">
  
  $(document).ready(function(){ 
        $("#ingresar").click(function(){
var parametros = {"usuario":$('#usuario').val(),"password":$('#password').val()};
                $.ajax({
                        url:"assets/dt/login.php",                
                        type:"POST",
                        data: parametros,
                        success: function(data){    
                          var n = data.length ;
                        if(n==15){
//                          alert(data);
                          window.location=data;
                        } else{
                            alert(data);                          
                       }       

                       }
                    });
        });
    })
</script>