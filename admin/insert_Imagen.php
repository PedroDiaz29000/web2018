<?php
//include('db.php');
include('function.php');

if(isset($_POST["operation"]))
{

//	if($_POST["operation"] == "Add"){
$resul='';
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}

		$resul = insert_imagenes($_POST['user_id'], $image);
		if($resul==true){
echo "Se Registro correctamente";
		}else{
echo "Error !!";
		}

}else{
	echo "Alistando para editar";
}

?>