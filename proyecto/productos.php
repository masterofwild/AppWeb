<?php

require_once("base_datos.php"); // se necesita un archivo externo

    // verificar si es método GET
	if($_SERVER['REQUEST_METHOD'] == 'GET') // consulta de información
	{
		// cotenido de proceso GET
		// Paso 1. Obtener pares clave valor

		// web service 1, Consultar por folio
		// isset() -> determinar si existe una variable o valor
		if(isset($_GET['folio'])) {
			// buscar producto
			$folio = $_GET['folio'];

			// búsqueda por número de folio en base de datos
			$producto = buscar_folio($folio);

			// responder la solicitud
			if ($producto != null) { // si se encontró el producto
				# sí lo encontró
				header('Content-Type: application/json');
				$respuesta = [
					"producto" => (object)[
						"folio" => $producto->folio,
						"nombre" => $producto->nombre,
						"color" => $producto->color,
						"costo" => $producto->costo,
						"unidad_medida" => $producto->unidad_medida,
						"fecha_baja" => $producto->fecha_baja
					]
				];

				// enviando respuesta
				echo json_encode($respuesta);
			} else {
				// no lo encontró
				header('Content-Type: application/json');
				$respuesta = [
					"producto" => (object)[]
				];

				// enviando respuesta
				echo json_encode($respuesta);
			}

		} else {
			// web service 2. Consultar todo

			// obteniendo todos los productos de la base de datos
			$productos = buscar_todo();

			if (is_array($productos) && sizeof($productos) > 0) { // sí tiene elementos (productos)
				// sí hay elementos
				header ('Content-Type: application/json'); // la respuesta es en JSON

				$array_productos = [];
				// obtener todos los productos del resultado de la base de datos
				foreach($productos as $item) { 
					$array_productos[] = $item; // agrego cada producto al arrglo de productos
				}

				$respuesta = [
					"mensaje" => "Proceso exitoso",
					"productos" => $array_productos
				];

				echo json_encode($respuesta);
			} else {
				// no hay elementos
				header ('Content-Type: application/json'); // la respuesta es en JSON
				$respuesta = [
					"mensaje" => "Proceso exitoso",
					"productos" => []
				];

				echo json_encode($respuesta);
			}

		}
		

		// algoritmo o proceso
	} else if($_SERVER['REQUEST_METHOD'] == 'POST') // registrar
	{
		// contenido de proceso POST

		// Paso 1. Obtener valores de la solicitud
		$datos_recibidos = json_decode(
			file_get_contents("php://input")
		);

		$folio = $datos_recibidos->folio;
		$nombre = $datos_recibidos->nombre;
		$color = $datos_recibidos->color;
		$costo = $datos_recibidos->costo;
		$unidad_medida = $datos_recibidos->unidad_medida;
		$fecha_baja = $datos_recibidos->fecha_baja;

		// registrar en la base de datos
		$resultado = insertar($folio, $nombre, $color, $costo, $unidad_medida, $fecha_baja);

		if ($resultado != null) { 
			# Sí se realizó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "Registro exitoso"
			];

			echo json_encode($respuesta);
		} else {
			// no se realizó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "No se pudo registar"
			];

			echo json_encode($respuesta);
		}

	} else if($_SERVER['REQUEST_METHOD'] == 'PUT') // actualizar
	{
		error_log(file_get_contents("php://input"));
		// contenido de proceso PUT
		$datos_recibidos = json_decode(
			file_get_contents("php://input")
		);

		$folio = $datos_recibidos->folio;
		$nombre = $datos_recibidos->nombre;
		$color = $datos_recibidos->color;
		$costo = $datos_recibidos->costo;
		$unidad_medida = $datos_recibidos->unidad_medida;
		$fecha_baja = $datos_recibidos->fecha_baja;
		// procesar algoritmo

		$resultado = actualizar($folio, $nombre, $color, $costo, $unidad_medida, $fecha_baja);

		if ($resultado !=null ) {
			# sí se actualizó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "Actualización correcta"
			];

			echo json_encode($respuesta);
		} else {
			// no se actualizó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "No se pudo actualizar"
			];

			echo json_encode($respuesta);
		}

	} else if($_SERVER['REQUEST_METHOD'] == 'DELETE') // eliminar
	{
		// contenido de proceso DELETE
		$folio = $_GET['folio'];

		$resultado = eliminar($folio);

		if ($resultado != null) {
			# Sí se eliminó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "Eliminación correcta" // agregar a la cadena
			];

			echo json_encode($respuesta);
		} else {
			// no se eliminó
			header ('Content-Type: application/json'); // la respuesta es en JSON

			$respuesta = [
				"mensaje" => "No se pudo eliminar" // agregar a la cadena
			];

			echo json_encode($respuesta);
		}
	} else {
		// procesar error y responder
	}
?>