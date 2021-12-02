<?php
	
	require 'conexion.php';
	
	$id = $mysqli->real_escape_string($_GET['id']);
	
	$sql = "SELECT nombre, telefono, fecha_nacimiento, estado_civil FROM empleados WHERE id=$id LIMIT 1";
	$resultado = $mysqli->query($sql);
	
	$fila = $resultado->fetch_assoc();
	
	
	
?>

<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<title>Empresa</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h1>Empleados</h1>
			</div>
			
			<div class="row">
				<div class="col-md-8">
					<form id="registro" name="registro" method="POST" action="editar2.php" autocomplete="off">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre" value="<?php echo $fila['nombre']; ?>" autofocus required>
							<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
						</div>
						
						<div class="form-group">
							<label for="telefono">Telefono</label>
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce el telefono" value="<?php echo $fila['telefono']; ?>" required>
						</div>
						
						<div class="form-group">
							<label for="fecha_nacimiento">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento']; ?>" placeholder="Introduce la fecha nacimiento" required>
						</div>
						
						<div class="form-group">
							<label for="estado_civil">Estado civil</label>
							<select id="estado_civil" name="estado_civil" class="form-control" required>
								<option value="SOLTERO" <?php if('SOLTERO' == $fila['estado_civil']) { echo 'selected'; } ?>>SOLTERO</option>
								<option value="CASADO" <?php if('CASADO' == $fila['estado_civil']) { echo 'selected'; } ?>>CASADO</option>
								<option value="OTRO" <?php if('OTRO' == $fila['estado_civil']) { echo 'selected'; } ?>>OTRO</option>
							</select>
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary" id="guarda" name="guarda" type="submit">Guarda</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery-3.4.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
	</body>
</html>				