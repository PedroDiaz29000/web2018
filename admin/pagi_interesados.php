<?php

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
		$count_query   = mysqli_query($con,"SELECT count(id) AS numrows from simpatizantes where state = 1 order by registrodate desc ");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT id, CONCAT(name,' ',surnames) se, phone, email, commentary, cast(registrodate as date) registrodate,state 
									from simpatizantes 
									where state = 1 
									order by registrodate desc 
									LIMIT $offset,$per_page ");
		if ($numrows>0){ ?>
		<table class="table table-bordered">
			  <thead>
				<tr>
				  <th WIDTH="20%">Nombre Completo</th>
				  <th WIDTH="13%">Telefono</th>
				  <th WIDTH="15%">Correo</th>
				  <th WIDTH="48%">Comentario</th>
				  <th  WIDTH="20%">Registro</th>
				  <th  WIDTH="2%"> Estado</th>
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
					<td><?php echo $row['se'];?></td>
					<td><?php echo $row['phone']; ?></td> 	<!-- -->				
					<td><?php echo utf8_encode($row['email']);?></td>
					<td><?php echo utf8_encode($row['commentary']);?></td>
					<td><?php echo $row['registrodate'];?></td>
					<td><?php echo '<a href="javascript:delete_('.$row['id'].');"><img src="assets/icons/icons8_Delete_1.ico " title="Eliminar"> </a>'
					?></td>	
				</tr> 
				<?php 
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
