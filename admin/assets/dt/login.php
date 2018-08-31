<?php

include('../models/login.php');
$Objeto_datos = new login();
$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);

if($usuario== ''|| $password== ''){
	echo "Ingresar su usuario y password";
}else{
	$result = $Objeto_datos->Ingreso($usuario,$password);
	if($result==true){
		if($Objeto_datos->num_rows($result)>0){
			session_start();
			 $_SESSION['loggedin'] = 'vd';
			echo "institution.php"; 
		}else{
			echo "Intente de Nuevo";
		}
	}else{
		echo $result;
	}

}

?>