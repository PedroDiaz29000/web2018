<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
//    $con=@mysqli_connect('162.211.86.149', 'rauldiaz_comas', '7bPMyuF(UFVu', 'rauldiaz_web2018');
    $con=@mysqli_connect('localhost', 'root', '', 'web2018');//reclutando
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		include 'pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(n.id)  AS numrows from noticia n inner join detalle d on d.noticia =n.id where n.estado in(1,0) and d.estado_foto=1 and d.orden=1 ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT n.id, n.idpersona, n.titulo,n.detalle, cast( n.fecha as date) fecha, n.estado, d.rutafoto 
									from noticia n
									inner join detalle d on d.noticia =n.id
									where n.estado in(1,0) and d.estado_foto=1 and d.orden=1 
									order by n.fecha desc 
									LIMIT $offset,$per_page ");
		if ($numrows>0){
			?>
		<table class="table table-bordered">
			  <thead>
				<tr>
				  <th WIDTH="2%">N°</th>
				  <th WIDTH="10%">Imagene</th>
				  <th WIDTH="20%">Titulo</th>
				  <th WIDTH="60%">Detalle</th>
				  <th  WIDTH="6%">Fecha</th>
				  <th colspan="3" WIDTH="2%"> Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$estado='';
			while($row = mysqli_fetch_array($query)){				
				if($row['estado']==0){
					$estado='<img src="assets/icons/icons8_High_Priority_1.ico" title="Inactivo"> ';
				}else{
					$estado='<img src="assets/icons/icons8_Protect.ico " title="Activo">';
				}

				?>
				<tr>
					<td><?php echo $row['id'];?></td>
					<td><?php echo "<img src='../".$row['rutafoto']."' style='width:150px;height:100px;'> "; ?></td> 	<!-- -->				
					<td><?php echo utf8_encode($row['titulo']);?></td>
					<td><?php echo utf8_encode($row['detalle']);?></td>
					<td><?php echo $row['fecha'];?></td>
					<td><?php echo '<a href="javascript:state('.$row['estado'].','.$row['id'].');">  '.$estado.' </a>'
					?></td>
					<td>
						<?php echo '<a href="javascript:delete_('.$row['id'].');"><img src="assets/icons/icons8_Delete_1.ico " title="Eliminar"> </a> '
					?>

					</td>

					<td>
						<?php echo '<a href="javascript:editando('.$row['id'].');"  ><img src="assets/icons/icons8_Edit.ico " title="Editar"> </a> '
					?>

					</td>

				</tr> 
				<?php //
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>
