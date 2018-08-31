<?php
session_start();
require_once("cls/bd.php");
$bd = new BD();
$bd->conectarBD();
$mensaje="";
$bd->conectarBD();
if(isset($_POST['enviar'])){
	$user=$_POST['tex_usuario'];
	$pass=$_POST['tex_clave'];
	$query="select usuario,clave,rol from acceso where usuario='$user' and clave='$pass'";

	$existe=$bd->consulta($query);

	while ($row=$bd->fetch_array($existe)){
	$usu=trim($row[0]);
	$contra=trim($row[1]);
	$rol=trim($row[1]);
	}

/*
	$row=$bd->fetch_array($existe);
	$usu=trim($row['usuario']);
	$contra=trim($row['clave']);
	$rol=trim($row['rol']); */

	if($user==$usu && $pass==$contra)
	{
		$_SESSION['user_id']=$usu;
		$_SESSION['user_pass']=$contra;
		$_SESSION['user_rol']=$rol;
		header("Location:listanoticia.php");
	}elseif($user!=$usu && $pass!=$contra){
	//header("Location:login.php");
	$mensaje="Usuario y/o Clave incorrectas...!";}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login | Whatsapp Carabayllo</title>

<link href="css/whatsapp_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="login_completo">
	<div id="login">
    <form id="formulario_whatsapp" class="form-signin" action="login.php" method="POST" autocomplete="Off">
    	<div class="logo"></div>
        <div class="usuario">
        <label></label><input type="text" id="tex_usuario" name="tex_usuario"  placeholder="" required autofocus>
    	</div>
        <div class="clave">
        <label></label><input type="password" id="tex_clave" name="tex_clave"  placeholder="" required>
    	</div>
        <div class="boton_entrar">
			<button id="enviar" type="submit" form="formulario_whatsapp" name="enviar"><img src="imagenes/boton_entrar.png" ></button>
    	</div>
      <div class="mensaje_error">
        <span><?php echo $mensaje; ?></span>
    	</div>
    </form>   
     
    </div>
</div>
</body>
</html>