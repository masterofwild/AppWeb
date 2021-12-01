$(document).ready(function(){
	// se manda llamar en cuanto carga la página
	obtener_productos();

	// botón agregar - mostrar formulario para registrar
	$("#btn_agregar").click(function() {
		$("#formulario").attr('hidden', false);
		$("#btn_guardar").attr('hidden', false);
		limpiar_formulario();
	});

	// accion de registro (web service)
	$("#btn_guardar").click(function() {
		registrar_producto();
	});

	// accion de edición (web service)
	$("#btn_editar").click(function() {
		actualiza_producto();
	});
});


/* LIMPIAR EL FORMULARIO */
function limpiar_formulario() {
	
}

function obtener_productos() {
	// COMPLETAR - CONFIGURAR LA SOLICITUD AJAX
	$.ajax({
        url: '/proyecto/productos.php', // Dónde está mi web service
        type: "GET", // MÉTODO DE ACCESO
        dataType: "JSON", // FORMATO DE LOS DATOS
        success: function (data) {
        	// COMPLETAR - VERIFICAR QUE EXISTAN LOS PRODUCTOS
            if (data.productos) {
            	// COMPLETAR - LOS DATOS EN LA TABLA
                mostrar_productos(data.productos);
            } else {
            	$("#tbl_body").html("<tr><td colspan='6' class='text-center'>No se encontraron productos</td></tr>");
            }
        },
        error: function (xhr, status) {
            alert("Ha ocurrido un error! " + status);
            console.log(xhr);
        }
    });
}

function mostrar_productos(productos) {
	let html = '';
	for (let index in productos) {
		html += "<tr class='text-center'>" +
				"<td>"+productos[index].folio+"</td>" +
				"<td>"+productos[index].nombre+"</td>" +
				"<td>"+productos[index].color+"</td>" +
				"<td>"+productos[index].costo+"</td>" +
				"<td>"+productos[index].unidad_medida+"</td>" +
				"<td>"+productos[index].fecha_baja+"</td>" +
				"<td><button type=\"button\" class=\"btn btn-sm btn-warning\" onclick=\"cargar_producto('"+productos[index].folio+"')\">Editar</button>" +
				"<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"eliminar_producto('"+productos[index].folio+"')\">Eliminar</button></td>" +
			"</tr>";
	}

	$("#tbl_body").html(html);
}

function registrar_producto() {
	// COMPLETAR - DEFINIR EL JSON A ENVIAR CON LOS DATOS DEL PRODUCTO
	let json_producto = {
    	folio: $("#folio").val(),
        nombre: $("#nombre").val(),
        color: $("#color").val(),
        costo: $("#costo").val(),
        unidad_medida: $("#unidad_medida").val(),
        fecha_baja: $("#fecha_baja").val()
    };

	$.ajax({
        url: '/proyecto/productos.php',
        type: "POST",
        // COMPLETAR - ENVIAR EL JSON DEL PRODUCTO
        data: JSON.stringify(json_producto), // CONVERTIR EN STRING JSON
        success: function (data) {
        	// COMPLETAR - PROCESAR RESPUESTA
            alert(data.mensaje);

            // cargar de nuevo la página
            location.reload();
        },
        error: function (xhr, status) {
            alert("Ha ocurrido un error! " + status);
            console.log(xhr);
        }
    });
}

function cargar_producto(folio) {
	$("#formulario").attr('hidden', false);
	$("#btn_guardar").attr('hidden', true);
	$("#btn_editar").attr('hidden', false);

	$.ajax({
        url: '/proyecto/productos.php',
        type: "GET",
        // COMPLETAR - ENVIAR EL FOLIO
        data: {
            folio: folio
        },
        success: function (data) {
        	// COMPLETAR - VERIFICAR QUE EXISTA EL PRODUCTO
            if (data.producto) {
            	let producto = data.producto;
                // COMPLETAR - CARGAR LOS DATOS EN EL FORMULARIO
                $("#folio").val(producto.folio);
                $("#nombre").val(producto.nombre);
                $("#color").val(producto.color);
                $("#costo").val(producto.costo);
                $("#unidad_medida").val(producto.unidad_medida);
                $("#fecha_baja").val(producto.fecha_baja);
            } else {
            	alert('No se encontró el producto');
            }
        },
        error: function (xhr, status) {
            alert("Ha ocurrido un error! " + status);
            console.log(xhr);
        }
    });
}

function actualiza_producto() {
	// COMPLETAR - DEFINIR EL JSON A ENVIAR CON LOS DATOS DEL PRODUCTO
	let json_producto = {
        folio: $("#folio").val(),
        nombre: $("#nombre").val(),
        color: $("#color").val(),
        costo: $("#costo").val(),
        unidad_medida: $("#unidad_medida").val(),
        fecha_baja: $("#fecha_baja").val()
    };

	$.ajax({
        url: '/proyecto/productos.php',
        type: "PUT",
        // COMPLETAR - ENVIAR EL JSON DEL PRODUCTO
        data: JSON.stringify(json_producto), // CONVERTIR EN STRING JSON
        success: function (data) {
        	// COMPLETAR - PROCESAR RESPUESTA
            alert(data.mensaje);

            location.reload();
        },
        error: function (xhr, status) {
            alert("Ha ocurrido un error! " + status);
            console.log(xhr);
        }
    });
}

function eliminar_producto(folio) {
	if (confirm('¿Está seguro de eliminar el producto con folio: ' + folio + '?')) {
		$.ajax({
			// COMPLETAR - ENVIAR EL FOLIO EN LA URL
	        url: '/proyecto/productos.php?folio=' + folio,
	        type: "DELETE",
	        success: function (data) {
	        	// COMPLETAR - PROCESAR RESPUESTA
                alert(data.mensaje);

                location.reload();
	            
	        },
	        error: function (xhr, status) {
	            alert("Ha ocurrido un error! " + status);
	            console.log(xhr);
	        }
	    });
	} else {
		return false;
	}
}