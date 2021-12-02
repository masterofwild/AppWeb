
create database curso_ws;

use curso_ws;

create table productos (
	id int not null auto_increment primary key,
	folio   varchar(20) not null,
	nombre varchar(100) not null,
	color varchar(100) not null,
	costo  decimal(5, 2) not null,
	unidad_medida varchar(100) not null,
	fecha_baja date default null
);
