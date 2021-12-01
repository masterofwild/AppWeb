<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','curso_ws');

function conectar() {
	try {
		// Ejecutamos las variables y aplicamos UTF8
		return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	} catch (PDOException $e) {
		exit("Error: " . $e->getMessage());
	}
}

function buscar_todo() {
	$connect = conectar();
	$sql = "SELECT * FROM productos"; 
	$query = $connect -> prepare($sql); 
	$query -> execute(); 
	$results = $query -> fetchAll(PDO::FETCH_OBJ); 
	
	if (is_array($results)) {
		return $results;
	} else {
		return false;
	}
}

function buscar_folio($folio) {
	$connect = conectar();
	$sql = "SELECT * FROM productos where folio = :folio"; 
	$query = $connect->prepare($sql);
	$query->bindParam(':folio', $folio);
	$query->execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ); 

	if (isset($results[0]) && is_array($results)) {
		return $results[0];
	} else {
		return false;
	}
}

function insertar($folio, $nombre, $color, $costo, $unidad_medida, $fecha_baja = null) {
	$connect = conectar();
	$sql="
		insert into productos(
			folio,
			nombre,
			color,
			costo,
			unidad_medida,
			fecha_baja
		) values (
			:folio,
			:nombre,
			:color,
			:costo,
			:unidad_medida,
			:fecha_baja
		)";

	$sql = $connect->prepare($sql);

	$sql->bindParam(':folio', $folio);
	$sql->bindParam(':nombre', $nombre);
	$sql->bindParam(':color', $color);
	$sql->bindParam(':costo', $costo);
	$sql->bindParam(':unidad_medida', $unidad_medida);
	$sql->bindParam(':fecha_baja', $fecha_baja);

	$sql->execute();

	$id_insertado = $connect->lastInsertId();

	$connect = null;

	return ($id_insertado) ? true : false;
}

function actualizar($folio, $nombre, $color, $costo, $unidad_medida, $fecha_baja = null) {
	$connect = conectar();
	$sql="
		update productos set 
			nombre = :nombre,
			color = :color,
			costo = :costo,
			unidad_medida = :unidad_medida,
			fecha_baja = :fecha_baja
		where folio = :folio";

	$sql = $connect->prepare($sql);

	$sql->bindParam(':nombre', $nombre);
	$sql->bindParam(':color', $color);
	$sql->bindParam(':costo', $costo);
	$sql->bindParam(':unidad_medida', $unidad_medida);
	$sql->bindParam(':fecha_baja', $fecha_baja);
	$sql->bindParam(':folio', $folio);

	$sql->execute();

	$connect = null;

	return ($sql->rowCount() > 0) ? true : false;
}

function eliminar($folio) {
	$connect = conectar();
	$sql="delete from productos where folio = :folio";

	$sql = $connect->prepare($sql);
	$sql->bindParam(':folio', $folio);

	$sql->execute();

	$connect = null;

	return ($sql->rowCount() > 0) ? true : false;
}

?>