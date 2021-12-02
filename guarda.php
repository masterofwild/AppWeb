<?php
	
	require 'conexion.php';
	
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$telefono = $mysqli->real_escape_string($_POST['telefono']);
	$fecha_nacimiento = $mysqli->real_escape_string($_POST['fecha_nacimiento']);
	$estado_civil = $mysqli->real_escape_string($_POST['estado_civil']);
	
	$sql = "INSERT INTO empleados (nombre, telefono, fecha_nacimiento, estado_civil, activo) VALUES ('$nombre', '$telefono', '$fecha_nacimiento', '$estado_civil', 1)";
	//echo $sql;
	$resultado = $mysqli->query($sql);
	
	if($resultado>0){
		echo 'REGISTRO AGREGADO';
		
		} else {
		echo 'ERROR AL AGREGAR REGISTRO';
	}
	
	echo "<br/><a href='index.php' class='btn btn-primary'>Regresar</a>";
	
?>

