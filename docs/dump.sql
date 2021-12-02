
-- Base de datos: `empresa`
--
USE `empresa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--


CREATE TABLE `empleados` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado_civil` varchar(10) NOT NULL,
  `activo` int NOT NULL
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

