<?php
//    $con=@mysqli_connect('162.211.86.149', 'rauldiaz_comas', '7bPMyuF(UFVu', 'rauldiaz_web2018');
	  $con=@mysqli_connect('localhost', 'root', '', 'web2018');
	$id=$_POST['page'];

    $consult='SELECT id, rutafoto, estado_foto,orden from detalle  where noticia="'.$id.'" and estado_foto=1';
    $result = mysqli_query($con,$consult);
echo '<table class="table table-bordered">
			  <thead>
				<tr>
				  <th WIDTH="2%">N°</th>
				  <th WIDTH="30%">Imagene</th>

				  <th WIDTH="52%">Seleciconar Principal</th>
				  <th  WIDTH="6%">Activar Foto Principal</th>
				  <th colspan="8" WIDTH="2%"> Estado</th>
				</tr>
			</thead><tbody>';
$orden='';
while($row = mysqli_fetch_array($result)){$cont++;

if($row['estado_foto']==1){
	$estado='<a href="javascript:estate_('.$row['id'].');"><img src="assets/icons/icons8_Protect.ico " title="Activado"> </a>';
}else if($row['rutafoto']==2){
	$estado='<a href="javascript:estate_('.$row['id'].');"><img src="assets/icons/icons8_High_Priority_1.ico " title="Desactivado"> </a>';;
}else{
	$estado='';
}

if ($row['orden']==2) {
	$orden='<a href="javascript:portada('.$row['id'].');"><img src="assets/icons/icons8_Ok_1.ico " title="Activar"> </a>';
}else{
	$orden='<a href="javascript:portada('.$row['id'].');"><img src="assets/icons/icons8_High_Priority_1.ico " title="Activar"> </a>';
}
			echo 	'<tr>
						<th WIDTH="2%">'.$cont.'</th>
						<th WIDTH="30%"><img src="../'.$row['rutafoto'].'" style="width:200px;height:150px;"> </th>

						<th WIDTH="52%"></th>
						<th  WIDTH="6%">'.$orden.'</th>
						<th colspan="8" WIDTH="2%"> '.$estado.'</th>
					</tr>';
}
echo  "</tbody></table>";
// echo '<BR>'.$_POST['page'];			


?>
