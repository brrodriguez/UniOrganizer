

DROP DATABASE IF EXISTS `uniorganizer`;
CREATE DATABASE IF NOT EXISTS `uniorganizer` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `uniorganizer`;
GRANT ALL PRIVILEGES ON * . * TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2018 a las 22:35:45
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `UniOrganizer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `idCalendario` int(10) NOT NULL,
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`idCalendario`, `username`) VALUES
(1, 'admin'),
(2, 'admin2'),
(3, 'bruno'),
(4, 'vyron'),
(5, 'uniorganizer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `idAsignatura` int(10) NOT NULL,
  `nombreAsignatura` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionAsignatura` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`idAsignatura`, `nombreAsignatura`, `descripcionAsignatura`) VALUES
(1, 'TAMI', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence'),
(2, 'TALF', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence'),
(3, 'DAI', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence'),
(4, 'ACII', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence'),
(5, 'TCL', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence'),
(6, 'SI', 'Asignatura centrada en la utilizacion de bases de datos y en la creacion de Bussines inteligence');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `idPagina` int(10) NOT NULL,
  `linkPagina` varchar(55) COLLATE utf8_spanish_ci NOT NULL,
  `nombrePagina` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`idPagina`, `linkPagina`, `nombrePagina`) VALUES
(1, '../Views/USUARIO_SHOWALL_Vista.php', 'USUARIO SHOWALL'),
(2, '../Views/USUARIO_SELECT_Vista.php', 'USUARIO SELECT'),
(3, '../Views/USUARIO_ADD_Vista.php', 'USUARIO ADD'),
(6, '../Views/USUARIO_EDIT_Vista.php', 'USUARIO EDIT'),
(9, '../Views/USUARIO_DELETE_Vista.php', 'USUARIO DELETE'),
(14, '../Views/USUARIO_SHOW_Vista.php', 'USUARIO SHOW'),
(100, '../Views/ASIGNATURA_SHOWALL_Vista.php', 'Asignatura SHOWALL'),
(101, '../Views/ASIGNATURA_ADD_Vista.php', 'Asignatura ADD'),
(102, '../Views/ASIGNATURA_DELETE_Vista.php', 'Asignatura DELETE'),
(103, '../Views/ASIGNATURA_EDIT_Vista.php', 'Asignatura EDIT'),
(150, '../Views/CURSO_SHOWALL_Vista.php', 'Curso SHOW ALL'),
(151, '../Views/CURSO_ADD_Vista.php', 'Curso ADD'),
(152, '../Views/CURSO_EDIT_Vista.php', 'Curso EDIT'),
(153, '../Views/CURSO_SHOWCURRENT_Vista.php', 'Curso SHOW'),
(154, '../Views/CURSO_ASIGN_Vista.php', 'Curso ASIGN'),
(200, '../Views/ALERTA_SHOWALL_Vista.php', 'Alerta SHOW ALL'),
(201, '../Views/ALERTA_SHOW_Vista.php', 'Alerta SHOW'),
(202, '../Views/ALERTA_SELECT_Vista.php', 'Alerta SELECT'),
(203, '../Views/ALERTA_ADD_Vista.php', 'Alerta ADD'),
(204, '../Views/ALERTA_DELETE_Vista.php', 'Alerta DELETE'),
(300, '../Views/CALENDARIO_ADD_Vista.php', 'CALENDARIO ADD'),
(301, '../Views/CALENDARIO_SHOWALL_Vista.php', 'CALENDARIO SHOWALL'),
(302, '../Views/CALENDARIO_EDIT_Vista.php', 'CALENDARIO EDIT'),
(303, '../Views/CALENDARIO_SHOW_Vista.php', 'CALENDARIO SHOW'),
(304, '../Views/CALENDARIO_SHOWCURRENT_Vista.php', 'CALENDARIO SHOWCURRENT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionalidad`
--

CREATE TABLE `funcionalidad` (
  `idFuncionalidad` int(10) NOT NULL,
  `nombreFuncionalidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `categoriaFuncionalidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionalidad`
--

INSERT INTO `funcionalidad` (`idFuncionalidad`, `nombreFuncionalidad`, `categoriaFuncionalidad`) VALUES
(1, 'Listar Usuarios', 'Gestion Usuarios'),
(2, 'Seleccionar Usuarios', 'Gestion Usuarios'),
(3, 'A?adir Usuario', 'Gestion Usuarios'),
(6, 'Modificar Usuario', 'Gestion Usuarios'),
(9, 'Borrar Usuario', 'Gestion Usuario'),
(14, 'Ver Usuario', 'Gestion Usuarios'),
(100, 'Listar Asignaturas', 'Gestion Asignaturas'),
(101, 'A?adir Asignatura', 'Gestion Asignaturas'),
(102, 'Borrar Asignatura', 'Gestion Asignaturas'),
(103, 'Modificar Asignatura', 'Gestion Asignaturas'),
(150, 'Listar Cursos', 'Gestion Cursos'),
(151, 'A?adir Curso', 'Gestion Cursos'),
(152, 'Editar Curso', 'Gestion Cursos'),
(153, 'Ver Curso', 'Gestion Cursos'),
(154, 'Asignar Asignaturas', 'Gestion Cursos'),
(200, 'Listar Alertas', 'Gestion Alertas'),
(201, 'Consultar Alerta', 'Gestion Alertas'),
(202, 'Ver Alerta', 'Gestion Alertas'),
(203, 'Insertar Alerta', 'Gestion Alertas'),
(204, 'Baja Alerta', 'Gestion Alertas'),
(300, 'Alta Calendario', 'Gestion Calendarios'),
(301, 'Consultar Calendario', 'Gestion Calendarios'),
(302, 'Modificar Calendario', 'Gestion Calendarios'),
(303, 'Filtrar Calendario', 'Gestion Calendarios'),
(304, 'Consulta Calendario', 'Gestion Calendarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionalidad_pagina`
--

CREATE TABLE `funcionalidad_pagina` (
  `idFuncionalidad` int(10) NOT NULL,
  `idPagina` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionalidad_pagina`
--

INSERT INTO `funcionalidad_pagina` (`idFuncionalidad`, `idPagina`) VALUES
(1, 1),
(2, 2),
(3, 3),
(6, 6),
(9, 9),
(14, 14),
(100, 100),
(101, 101),
(102, 102),
(103, 103),
(150, 150),
(151, 151),
(152, 152),
(153, 153),
(154, 154),
(200, 200),
(201, 201),
(202, 202),
(203, 203),
(204, 204),
(300, 300),
(301, 301),
(302, 302),
(303, 303),
(304, 304);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionalidad_rol`
--

CREATE TABLE `funcionalidad_rol` (
  `idFuncionalidad` int(10) NOT NULL,
  `idRol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `funcionalidad_rol`
--

INSERT INTO `funcionalidad_rol` (`idFuncionalidad`, `idRol`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(6, 1),
(6, 2),
(9, 1),
(14, 1),
(14, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(150, 1),
(150, 2),
(151, 1),
(151, 2),
(152, 1),
(152, 2),
(153, 1),
(153, 2),
(154, 1),
(154, 2),
(200, 1),
(200, 2),
(201, 1),
(201, 2),
(202, 1),
(202, 2),
(203, 1),
(203, 2),
(204, 1),
(204, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(10) NOT NULL,
  `nombreCurso` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionCurso` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idCalendario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idCurso`, `nombreCurso`, `descripcionCurso`, `idCalendario`) VALUES
(1, 'Cuarto año', 'Asignaturas que curso en mi cuarto año de carrera', 4),
(2, 'Primero', 'Asignaturas de primero de carrera', 3),
(3, 'Segundo', 'Asignaturas de segundo de carrera', 1),
(4, 'Tercer año', 'Asignaturas cursadas en mi tercer año', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura_curso`
--

CREATE TABLE `asignatura_curso` (
  `idCurso` int(10) NOT NULL,
  `idAsignatura` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `asignatura_curso` (`idCurso`, `idAsignatura`) VALUES
(4, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerta`
--

CREATE TABLE `alerta` (
  `idAlerta` int(10) NOT NULL,
  `idCalendario` int(10) NOT NULL,
  `fechaHora` timestamp NOT NULL,
  `asuntoAlerta` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionAlerta` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`idAlerta`, `idCalendario`, `fechaHora`, `asuntoAlerta`, `descripcionAlerta`) VALUES
(1, 2, '2018-01-07 11:00:00', 'Bienvenido a UniOrganizer', 'Alerta de registro'),
(2, 2, '2018-01-07 12:00:00', 'Registrado', 'Alerta de registro'),
(3, 1, '2018-01-07 13:00:00', 'Entrega TAMI', 'Practica 3'),
(4, 2, '2018-01-07 14:00:00', 'Examen TALF', 'Alerta de examen');



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(10) NOT NULL,
  `nombreRol` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipoUsuario` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `niu` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`username`, `password`, `tipoUsuario`, `nombre`, `apellidos`, `dni`, `fechaNac`, `niu`, `email`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Iván', 'de Dios Fernández', '44488795X', '1994-03-26', '123456789012', 'administracion@gmail.com'),
('bruno', 'e3928a3bc4be46516aa33a79bbdfdb08', 2, 'Bruno', 'Romero Rodriguez', '45147231W', '1995-10-10', '234123456734', 'brrodriguez@gmail.com'),
('vyron', '9dafe1b7ef8477287cc4ff5cf99d1fa1', 2, 'Héctor', 'Otero Rodríguex', '44495311V', '1990-01-12', '100000342347', 'vyronboss@hotmail.com'),
('admin2', '220a15a78a728aa88fcf45d009705d96', 1, 'Alberto', 'Porral Framiñán', '54064900L', '1992-09-17', '105004536221', 'albertoporral@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `username` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`username`, `idRol`) VALUES
('admin', 1),
('uniorganizer', 1),
('bruno', 2),
('vyron', 2),
('admin2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_horas`
--

CREATE TABLE `calendario_horas` (
  `idCalendario` int(10) NOT NULL,
  `idHora` int(10) NOT NULL,
  `idDia` int(10) NOT NULL,
  `idMes` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario_horas`
--

INSERT INTO `calendario_horas` (`idCalendario`, `idHora`, `idDia`, `idMes`) VALUES
(3, 1, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerta_hora`
--

CREATE TABLE `alerta_hora` (
  `idAlerta` int(10) NOT NULL,
  `idHora` int(10) NOT NULL,
  `idDia` int(10) NOT NULL,
  `idMes` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
--
-- Volcado de datos para la tabla `alerta_hora`
--

INSERT INTO `alerta_hora` (`idAlerta`, `idHora`, `idDia`, `idMes`) VALUES
(1, 1, 2, 4);

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `idCalendario` (`idCalendario`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`idAsignatura`);
  
  --
-- Indices de la tabla `asignatura_curso`
--
ALTER TABLE `asignatura_curso`
  ADD PRIMARY KEY (`idCurso`, `idAsignatura`),
  ADD KEY `idCurso` (`idCurso`),
  ADD KEY `idAsignatura` (`idAsignatura`);

--
-- Indices de la tabla `funcionalidad`
--
ALTER TABLE `funcionalidad`
  ADD PRIMARY KEY (`idFuncionalidad`);

--
-- Indices de la tabla `funcionalidad_pagina`
--
ALTER TABLE `funcionalidad_pagina`
  ADD PRIMARY KEY (`idFuncionalidad`,`idPagina`),
  ADD KEY `idFuncionalidad` (`idFuncionalidad`),
  ADD KEY `idPagina` (`idPagina`);

--
-- Indices de la tabla `funcionalidad_rol`
--
ALTER TABLE `funcionalidad_rol`
  ADD PRIMARY KEY (`idFuncionalidad`,`idRol`),
  ADD KEY `idFuncionalidad` (`idFuncionalidad`),
  ADD KEY `idRol` (`idRol`);
  
--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`idCalendario`),
  ADD KEY `username` (`username`);
  
--
-- Indices de la tabla `calendario_horas`
--
ALTER TABLE `calendario_horas`
  ADD PRIMARY KEY (`idCalendario`, `idHora`, `idDia`, `idMes`),
  ADD KEY `idCalendario` (`idCalendario`),
  ADD KEY `idHora` (`idHora`),
  ADD KEY `idDia` (`idDia`),
  ADD KEY `idMes` (`idMes`);

--
-- Indices de la tabla `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`idAlerta`),
  ADD KEY `idCalendario` (`idCalendario`);
  
--
-- Indices de la tabla `alerta_hora`
--
ALTER TABLE `alerta_hora`
  ADD PRIMARY KEY (`idAlerta`, `idHora`, `idDia`, `idMes` ),
  ADD KEY `idAlerta` (`idAlerta`),
  ADD KEY `idHora` (`idHora`),
  ADD KEY `idDia` (`idDia`),
  ADD KEY `idMes` (`idMes`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`idPagina`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);
  
--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `tipoUsuario` (`tipoUsuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`username`,`idRol`),
  ADD KEY `usuario_rol_ibfk_2` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `idAsignatura` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `funcionalidad`
--
ALTER TABLE `funcionalidad`
  MODIFY `idFuncionalidad` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT de la tabla `Alerta`
--
ALTER TABLE `alerta`
  MODIFY `idAlerta` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `idPagina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `idCalendario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
  
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
  
--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `idRol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_rol_ibfk_1` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `funcionalidad_pagina`
--
ALTER TABLE `funcionalidad_pagina`
  ADD CONSTRAINT `funcionalidad_pagina_ibfk_1` FOREIGN KEY (`idFuncionalidad`) REFERENCES `funcionalidad` (`idFuncionalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionalidad_pagina_ibfk_2` FOREIGN KEY (`idPagina`) REFERENCES `pagina` (`idPagina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `funcionalidad_rol`
--
ALTER TABLE `funcionalidad_rol`
  ADD CONSTRAINT `funcionalidad_rol_ibfk_1` FOREIGN KEY (`idFuncionalidad`) REFERENCES `funcionalidad` (`idFuncionalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionalidad_rol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alerta`
--
ALTER TABLE `alerta`
  ADD CONSTRAINT `alerta_ibfk_1` FOREIGN KEY (`idCalendario`) REFERENCES `calendario` (`idCalendario`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- Filtros para la tabla `asignatura_curso`
--
ALTER TABLE `asignatura_curso`
  ADD CONSTRAINT `asignatura_curso_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignatura_curso_ibfk_2` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`idCalendario`) REFERENCES `calendario` (`idCalendario`) ON DELETE CASCADE ON UPDATE CASCADE;
  

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
