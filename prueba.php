<?php
$valor='';
$valor =  $_REQUEST['vli'];
	# conectare la base de datos
//   $con=@mysqli_connect('162.211.86.149', 'rauldiaz_comas', '7bPMyuF(UFVu', 'rauldiaz_web2018');//reclutando
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
		$per_page = intval($valor); //4; //la cantidad de registros que desea mostrar
		$adjacents  = 4; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/
		$count_query   = mysqli_query($con,"SELECT count(n.id) numrows from noticia n inner join detalle d on d.noticia =n.id where n.estado =1 and d.estado_foto=1 and d.orden=1");
		if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
		$total_pages = ceil($numrows/$per_page);
		$reload = 'index.php';
		//consulta principal para recuperar los datos
		$query = mysqli_query($con,"SELECT n.id,n.titulo, d.rutafoto 
									from noticia n
									inner join detalle d on d.noticia =n.id
									where n.estado =1 and d.estado_foto=1 and d.orden=1
									order by n.fecha desc 
									LIMIT $offset,$per_page ");
		$do = "SELECT n.id,n.titulo, d.rutafoto 
									from noticia n
									inner join detalle d on d.noticia =n.id
									where n.estado =1 and d.estado_foto=1 and d.orden=1
									order by n.fecha desc 
									LIMIT $offset,$per_page";
		if ($numrows>0){
?>
		<table class="table table-bordered">
<?			while($row = mysqli_fetch_array($query)){				
				?>

      <div class="noticia">
        <div class="noti_img"><img src=<?php echo $row['rutafoto']; ?> width="578" height="280" /></div> <!-- 'admin1/'. -->
        <div class="noti_tex"><br>
          <h1><?php echo utf8_encode($row['titulo']); ?></h1>
          <h2>mas detalle [ <a href="detalle.php?vl= <?php echo $row['id']; ?> ">ver más</a> ]</h2> 
        </div>
      </div>
				<?php 
			}
			?>
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

