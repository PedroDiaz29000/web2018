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
		
		$titulo=trim(utf8_decode($_POST['titulo']));
		$detalle=trim(utf8_decode($_POST['detalle']));
				
		$resul = Regitro_N($titulo,$detalle, $image);
		if($resul==true){
echo "Se Registro correctamente";
		}else{
echo "Error !!";
		}

		/*
		$statement = $connection->prepare("
			INSERT INTO users (first_name, last_name, image) 
			VALUES (:first_name, :last_name, :image)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		} */
//		$consul="INSERT INTO noticia (titulo,detalle,estado) VALUES() ";
//	}

/*	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE users 
			SET first_name = :first_name, last_name = :last_name, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}*/
}else{
	echo "Alistando para editar";
}

?>