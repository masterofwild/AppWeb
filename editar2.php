<?php
	
	require 'conexion.php';
	
	$id = $mysqli->real_escape_string($_POST['id']);
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$telefono = $mysqli->real_escape_string($_POST['telefono']);
	$fecha_nacimiento = $mysqli->real_escape_string($_POST['fecha_nacimiento']);
	$estado_civil = $mysqli->real_escape_string($_POST['estado_civil']);
	
	$sql = "UPDATE empleados SET nombre='$nombre', telefono='$telefono',fecha_nacimiento='$fecha_nacimiento',estado_civil='$estado_civil' WHERE id=$id ";
	$resultado = $mysqli->query($sql);
	
	if($resultado>0){
		echo 'REGISTRO MODIFICADO';
		} else {
		echo 'ERROR AL MODIFICAR REGISTRO';
	}
	
	echo "<br/><a href='index.php' class='btn btn-primary'>Regresar</a>";
	
?>

