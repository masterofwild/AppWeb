<?php
	
	require 'conexion.php';
	
	$sql = "SELECT id, nombre, telefono, fecha_nacimiento, estado_civil FROM empleados WHERE activo=1";
	$resultado = $mysqli->query($sql);
	
?>

<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery.dataTables.min.css">
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery-3.4.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/jquery.dataTables.min.js" ></script>
		
		<title>Empresa</title>
		
		<script>
			$(document).ready(function() {
			$('#tabla').DataTable();
			} );
			
		</script>
		
		<style>
			body {
			background: white;
			}
		</style>
		
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Empleados</h1>
			</div>
			
			<div class="row">
				<a href="nuevo.php" class="btn btn-primary">Registrar</a>
			</div>
			
			<table id="tabla" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Telefono</th>
						<th>Fecha de nacimiento</th>
						<th>Estado civil</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php while($fila = $resultado->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $fila['nombre']; ?></td>
							<td><?php echo $fila['telefono']; ?></td>
							<td><?php echo $fila['fecha_nacimiento']; ?></td>
							<td><?php echo $fila['estado_civil']; ?></td>
							<td><a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning">Editar</a> </td>
							<td><a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger">Eliminar</a> </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
		</div>
	</div>
	
	
</body>
</html>						