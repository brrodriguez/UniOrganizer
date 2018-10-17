

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
(4, 'vyron');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `idAsignatura` int(10) NOT NULL,
  `nombreAsignatura` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
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
(4, '../Views/USUARIO_EDIT_Vista.php', 'USUARIO EDIT'),
(5, '../Views/USUARIO_DELETE_Vista.php', 'USUARIO DELETE'),
(6, '../Views/USUARIO_SHOW_Vista.php', 'USUARIO SHOW'),
(100, '../Views/ASIGNATURA_SHOWALL_Vista.php', 'Asignatura SHOWALL'),
(101, '../Views/ASIGNATURA_DELETE_Vista.php', 'Asignatura DELETE'),
(150, '../Views/CURSO_SHOWALL_Vista.php', 'Curso SHOW ALL'),
(151, '../Views/CURSO_ADD_Vista.php', 'Curso ADD'),
(152, '../Views/CURSO_EDIT_Vista.php', 'Curso EDIT'),
(153, '../Views/CURSO_SHOW_Vista.php', 'Curso SHOW'),
(154, '../Views/CURSO_ASIGN_Vista.php', 'Curso ASIGN'),
(155, '../Views/CURSO_IMPORT_Vista.php', 'Curso ASIGN'),
(156, '../Views/CURSO_DELETE_Vista.php', 'Curso ASIGN'),
(200, '../Views/ALERTA_SHOWALL_Vista.php', 'Alerta SHOWALL'),
(201, '../Views/ALERTA_SHOW_Vista.php', 'Alerta SHOW'),
(202, '../Views/ALERTA_DELETE_Vista.php', 'Alerta DELETE'),
(203, '../Views/ALERTA_ADD_Vista.php', 'Alerta ADD');

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
(3, 'Añadir Usuario', 'Gestion Usuarios'),
(4, 'Modificar Usuario', 'Gestion Usuarios'),
(5, 'Borrar Usuario', 'Gestion Usuario'),
(6, 'Ver Usuario', 'Gestion Usuarios'),
(100, 'Listar Asignaturas', 'Gestion Asignaturas'),
(101, 'Borrar Asignatura', 'Gestion Asignaturas'),
(150, 'Listar Cursos', 'Gestion Cursos'),
(151, 'Añadir Curso', 'Gestion Cursos'),
(152, 'Editar Curso', 'Gestion Cursos'),
(153, 'Ver Curso', 'Gestion Cursos'),
(154, 'Asignar Asignaturas', 'Gestion Cursos'),
(155, 'Importar Curso', 'Gestion Cursos'),
(156, 'Borrar Curso', 'Gestion Cursos'),
(200, 'Listar Alertas', 'Gestion Alertas'),
(201, 'Ver Alerta', 'Gestion Alertas'),
(202, 'Insertar Alerta', 'Gestion Alertas'),
(203, 'Baja Alerta', 'Gestion Alertas');

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
(4, 4),
(5, 5),
(6, 6),
(100, 100),
(101, 101),
(150, 150),
(151, 151),
(152, 152),
(153, 153),
(154, 154),
(155, 155),
(156, 156),
(200, 200),
(201, 201),
(202, 202),
(203, 203);

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
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(6, 2),
(100, 1),
(100, 2),
(101, 1),
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
(155, 1),
(155, 2),
(156, 1),
(156, 2),
(200, 1),
(200, 2),
(201, 1),
(201, 2),
(202, 1),
(202, 2),
(203, 1),
(203, 2);

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
  `asuntoAlerta` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcionAlerta` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`idAlerta`, `asuntoAlerta`, `descripcionAlerta`) VALUES
(1, 'Bienvenido a UniOrganizer', 'Alerta de registro'),
(2, 'Registrado', 'Alerta de registro'),
(3, 'Entrega TAMI', 'Practica 3'),
(4, 'Examen TALF', 'Alerta de examen');



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
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Iván', 'de Dios Fernández', '44488795X', '1994-03-1', '123456789012', 'administracion@gmail.com'),
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
('bruno', 2),
('vyron', 2),
('admin2', 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_cuatrimestre`
--

CREATE TABLE `horario_cuatrimestre` (
  `idHorarioCuatrimestre` int(11) NOT NULL,
  `diaInicio` date NOT NULL,
  `diaFin` date NOT NULL,
  `nombreCuatrimestre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horario_cuatrimestre`

insert into `horario_cuatrimestre` (`idHorarioCuatrimestre`, `diaInicio`, `diaFin`, `nombreCuatrimestre`) values
(1, '2018-9-15', '2019-1-15', 'Primer'),
(2, '2019-1-16', '2019-6-15', 'Segundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_horario`
--

CREATE TABLE `rango_horario` (
  `idRangoHorario` int(11) NOT NULL,
  `nombreDia` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `horaApertura` time NOT NULL,
  `horaCierre` time NOT NULL,
  `idHorarioCuatrimestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rango_horario`
--
insert into `rango_horario` (`idRangoHorario`, `nombreDia`, `horaApertura`, `horaCierre`, `idHorarioCuatrimestre`) values
(1, 'Lunes', '9:00', '18:00', 1),
(2, 'Martes', '9:00', '18:00', 1),
(3, 'Miércoles', '9:00', '18:00', 1),
(4, 'Jueves', '9:00', '18:00', 1),
(5, 'Viernes', '9:00', '18:00', 1),
(6, 'Lunes', '9:00', '18:00', 2),
(7, 'Martes', '9:00', '18:00', 2),
(8, 'Miércoles', '9:00', '18:00', 2),
(9, 'Jueves', '9:00', '18:00', 2),
(10, 'Viernes', '9:00', '18:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_posibles`
--

CREATE TABLE `horas_posibles` (
  `idHoraPosible` int(11) NOT NULL,
  `dia` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `idRangoHorario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `horas_posibles`
--
insert into `horas_posibles` (`idHoraPosible`,`dia`, `horaInicio`, `horaFin`,`idRangoHorario`) values
(1,'2018-10-1', '9:00', '10:00', 1),
(2,'2018-10-1', '10:00', '11:00', 1),
(3,'2018-10-1', '11:00', '12:00', 1),
(4,'2018-10-1', '12:00', '13:00', 1),
(5,'2018-10-1', '13:00', '14:00', 1),
(6,'2018-10-1', '14:00', '15:00', 1),
(7,'2018-10-1', '15:00', '16:00', 1),
(8,'2018-10-1', '16:00', '17:00', 1),
(9,'2018-10-1', '17:00', '18:00', 1),
(10,'2018-10-2', '9:00', '10:00', 2),
(11,'2018-10-2', '10:00', '11:00', 2),
(12,'2018-10-2', '11:00', '12:00', 2),
(13,'2018-10-2', '12:00', '13:00', 2),
(14,'2018-10-2', '13:00', '14:00', 2),
(15,'2018-10-2', '14:00', '15:00', 2),
(16,'2018-10-2', '15:00', '16:00', 2),
(17,'2018-10-2', '16:00', '17:00', 2),
(18,'2018-10-2', '17:00', '18:00', 2),
(19,'2018-10-3', '9:00', '10:00', 3),
(20,'2018-10-3', '10:00', '11:00', 3),
(21,'2018-10-3', '11:00', '12:00', 3),
(22,'2018-10-3', '12:00', '13:00', 3),
(23,'2018-10-3', '13:00', '14:00', 3),
(24,'2018-10-3', '14:00', '15:00', 3),
(25,'2018-10-3', '15:00', '16:00', 3),
(26,'2018-10-3', '16:00', '17:00', 3),
(27,'2018-10-3', '17:00', '18:00', 3),
(28,'2018-10-4', '9:00', '10:00', 4),
(29,'2018-10-4', '10:00', '11:00', 4),
(30,'2018-10-4', '11:00', '12:00', 4),
(31,'2018-10-4', '12:00', '13:00', 4),
(32,'2018-10-4', '13:00', '14:00', 4),
(33,'2018-10-4', '14:00', '15:00', 4),
(34,'2018-10-4', '15:00', '16:00', 4),
(35,'2018-10-4', '16:00', '17:00', 4),
(36,'2018-10-4', '17:00', '18:00', 4),
(37,'2018-10-5', '9:00', '10:00', 5),
(38,'2018-10-5', '10:00', '11:00', 5),
(39,'2018-10-5', '11:00', '12:00', 5),
(40,'2018-10-5', '12:00', '13:00', 5),
(41,'2018-10-5', '13:00', '14:00', 5),
(42,'2018-10-5', '14:00', '15:00', 5),
(43,'2018-10-5', '15:00', '16:00', 5),
(44,'2018-10-5', '16:00', '17:00', 5),
(45,'2018-10-5', '17:00', '18:00', 5),
(46,'2018-10-8', '9:00', '10:00', 1),
(47,'2018-10-8', '10:00', '11:00', 1),
(48,'2018-10-8', '11:00', '12:00', 1),
(49,'2018-10-8', '12:00', '13:00', 1),
(50,'2018-10-8', '13:00', '14:00', 1),
(51,'2018-10-8', '14:00', '15:00', 1),
(52,'2018-10-8', '15:00', '16:00', 1),
(53,'2018-10-8', '16:00', '17:00', 1),
(54,'2018-10-8', '17:00', '18:00', 1),
(55,'2018-10-9', '9:00', '10:00', 2),
(56,'2018-10-9', '10:00', '11:00', 2),
(57,'2018-10-9', '11:00', '12:00', 2),
(58,'2018-10-9', '12:00', '13:00', 2),
(59,'2018-10-9', '13:00', '14:00', 2),
(60,'2018-10-9', '14:00', '15:00', 2),
(61,'2018-10-9', '15:00', '16:00', 2),
(62,'2018-10-9', '16:00', '17:00', 2),
(63,'2018-10-9', '17:00', '18:00', 2),
(64,'2018-10-10', '9:00', '10:00', 3),
(65,'2018-10-10', '10:00', '11:00', 3),
(66,'2018-10-10', '11:00', '12:00', 3),
(67,'2018-10-10', '12:00', '13:00', 3),
(68,'2018-10-10', '13:00', '14:00', 3),
(69,'2018-10-10', '14:00', '15:00', 3),
(70,'2018-10-10', '15:00', '16:00', 3),
(71,'2018-10-10', '16:00', '17:00', 3),
(72,'2018-10-10', '17:00', '18:00', 3),
(73,'2018-10-11', '9:00', '10:00', 4),
(74,'2018-10-11', '10:00', '11:00', 4),
(75,'2018-10-11', '11:00', '12:00', 4),
(76,'2018-10-11', '12:00', '13:00', 4),
(77,'2018-10-11', '13:00', '14:00', 4),
(78,'2018-10-11', '14:00', '15:00', 4),
(79,'2018-10-11', '15:00', '16:00', 4),
(80,'2018-10-11', '16:00', '17:00', 4),
(81,'2018-10-11', '17:00', '18:00', 4),
(82,'2018-10-12', '9:00', '10:00', 5),
(83,'2018-10-12', '10:00', '11:00', 5),
(84,'2018-10-12', '11:00', '12:00', 5),
(85,'2018-10-12', '12:00', '13:00', 5),
(86,'2018-10-12', '13:00', '14:00', 5),
(87,'2018-10-12', '14:00', '15:00', 5),
(88,'2018-10-12', '15:00', '16:00', 5),
(89,'2018-10-12', '16:00', '17:00', 5),
(90,'2018-10-12', '17:00', '18:00', 5),
(91,'2018-10-15', '9:00', '10:00', 1),
(92,'2018-10-15', '10:00', '11:00', 1),
(93,'2018-10-15', '11:00', '12:00', 1),
(94,'2018-10-15', '12:00', '13:00', 1),
(95,'2018-10-15', '13:00', '14:00', 1),
(96,'2018-10-15', '14:00', '15:00', 1),
(97,'2018-10-15', '15:00', '16:00', 1),
(98,'2018-10-15', '16:00', '17:00', 1),
(99,'2018-10-15', '17:00', '18:00', 1),
(100,'2018-10-16', '9:00', '10:00', 2),
(101,'2018-10-16', '10:00', '11:00', 2),
(102,'2018-10-16', '11:00', '12:00', 2),
(103,'2018-10-16', '12:00', '13:00', 2),
(104,'2018-10-16', '13:00', '14:00', 2),
(105,'2018-10-16', '14:00', '15:00', 2),
(106,'2018-10-16', '15:00', '16:00', 2),
(107,'2018-10-16', '16:00', '17:00', 2),
(108,'2018-10-16', '17:00', '18:00', 2),
(109,'2018-10-17', '9:00', '10:00', 3),
(110,'2018-10-17', '10:00', '11:00', 3),
(111,'2018-10-17', '11:00', '12:00', 3),
(112,'2018-10-17', '12:00', '13:00', 3),
(113,'2018-10-17', '13:00', '14:00', 3),
(114,'2018-10-17', '14:00', '15:00', 3),
(115,'2018-10-17', '15:00', '16:00', 3),
(116,'2018-10-17', '16:00', '17:00', 3),
(117,'2018-10-17', '17:00', '18:00', 3),
(118,'2018-10-18', '9:00', '10:00', 4),
(119,'2018-10-18', '10:00', '11:00', 4),
(120,'2018-10-18', '11:00', '12:00', 4),
(121,'2018-10-18', '12:00', '13:00', 4),
(122,'2018-10-18', '13:00', '14:00', 4),
(123,'2018-10-18', '14:00', '15:00', 4),
(124,'2018-10-18', '15:00', '16:00', 4),
(125,'2018-10-18', '16:00', '17:00', 4),
(126,'2018-10-18', '17:00', '18:00', 4),
(127,'2018-10-19', '9:00', '10:00', 5),
(128,'2018-10-19', '10:00', '11:00', 5),
(129,'2018-10-19', '11:00', '12:00', 5),
(130,'2018-10-19', '12:00', '13:00', 5),
(131,'2018-10-19', '13:00', '14:00', 5),
(132,'2018-10-19', '14:00', '15:00', 5),
(133,'2018-10-19', '15:00', '16:00', 5),
(134,'2018-10-19', '16:00', '17:00', 5),
(135,'2018-10-19', '17:00', '18:00', 5),
(136,'2018-10-22', '9:00', '10:00', 1),
(137,'2018-10-22', '10:00', '11:00', 1),
(138,'2018-10-22', '11:00', '12:00', 1),
(139,'2018-10-22', '12:00', '13:00', 1),
(140,'2018-10-22', '13:00', '14:00', 1),
(141,'2018-10-22', '14:00', '15:00', 1),
(142,'2018-10-22', '15:00', '16:00', 1),
(143,'2018-10-22', '16:00', '17:00', 1),
(144,'2018-10-22', '17:00', '18:00', 1),
(145,'2018-10-23', '9:00', '10:00', 2),
(146,'2018-10-23', '10:00', '11:00', 2),
(147,'2018-10-23', '11:00', '12:00', 2),
(148,'2018-10-23', '12:00', '13:00', 2),
(149,'2018-10-23', '13:00', '14:00', 2),
(150,'2018-10-23', '14:00', '15:00', 2),
(151,'2018-10-23', '15:00', '16:00', 2),
(152,'2018-10-23', '16:00', '17:00', 2),
(153,'2018-10-23', '17:00', '18:00', 2),
(154,'2018-10-24', '9:00', '10:00', 3),
(155,'2018-10-24', '10:00', '11:00', 3),
(156,'2018-10-24', '11:00', '12:00', 3),
(157,'2018-10-24', '12:00', '13:00', 3),
(158,'2018-10-24', '13:00', '14:00', 3),
(159,'2018-10-24', '14:00', '15:00', 3),
(160,'2018-10-24', '15:00', '16:00', 3),
(161,'2018-10-24', '16:00', '17:00', 3),
(162,'2018-10-24', '17:00', '18:00', 3),
(163,'2018-10-25', '9:00', '10:00', 4),
(164,'2018-10-25', '10:00', '11:00', 4),
(165,'2018-10-25', '11:00', '12:00', 4),
(166,'2018-10-25', '12:00', '13:00', 4),
(167,'2018-10-25', '13:00', '14:00', 4),
(168,'2018-10-25', '14:00', '15:00', 4),
(169,'2018-10-25', '15:00', '16:00', 4),
(170,'2018-10-25', '16:00', '17:00', 4),
(171,'2018-10-25', '17:00', '18:00', 4),
(172,'2018-10-26', '9:00', '10:00', 5),
(173,'2018-10-26', '10:00', '11:00', 5),
(174,'2018-10-26', '11:00', '12:00', 5),
(175,'2018-10-26', '12:00', '13:00', 5),
(176,'2018-10-26', '13:00', '14:00', 5),
(177,'2018-10-26', '14:00', '15:00', 5),
(178,'2018-10-26', '15:00', '16:00', 5),
(179,'2018-10-26', '16:00', '17:00', 5),
(180,'2018-10-26', '17:00', '18:00', 5),
(181,'2018-10-29', '9:00', '10:00', 1),
(182,'2018-10-29', '10:00', '11:00', 1),
(183,'2018-10-29', '11:00', '12:00', 1),
(184,'2018-10-29', '12:00', '13:00', 1),
(185,'2018-10-29', '13:00', '14:00', 1),
(186,'2018-10-29', '14:00', '15:00', 1),
(187,'2018-10-29', '15:00', '16:00', 1),
(188,'2018-10-29', '16:00', '17:00', 1),
(189,'2018-10-29', '17:00', '18:00', 1),
(190,'2018-10-30', '9:00', '10:00', 2),
(191,'2018-10-30', '10:00', '11:00', 2),
(192,'2018-10-30', '11:00', '12:00', 2),
(193,'2018-10-30', '12:00', '13:00', 2),
(194,'2018-10-30', '13:00', '14:00', 2),
(195,'2018-10-30', '14:00', '15:00', 2),
(196,'2018-10-30', '15:00', '16:00', 2),
(197,'2018-10-30', '16:00', '17:00', 2),
(198,'2018-10-30', '17:00', '18:00', 2),
(199,'2018-10-31', '9:00', '10:00', 3),
(200,'2018-10-31', '10:00', '11:00', 3),
(201,'2018-10-31', '11:00', '12:00', 3),
(202,'2018-10-31', '12:00', '13:00', 3),
(203,'2018-10-31', '13:00', '14:00', 3),
(204,'2018-10-31', '14:00', '15:00', 3),
(205,'2018-10-31', '15:00', '16:00', 3),
(206,'2018-10-31', '16:00', '17:00', 3),
(207,'2018-10-31', '17:00', '18:00', 3),
(208,'2018-10-4', '9:00', '10:00', 4),
(209,'2018-10-4', '10:00', '11:00', 4),
(210,'2018-10-4', '11:00', '12:00', 4),
(211,'2018-10-4', '12:00', '13:00', 4),
(212,'2018-10-4', '13:00', '14:00', 4),
(213,'2018-10-4', '14:00', '15:00', 4),
(214,'2018-10-4', '15:00', '16:00', 4),
(215,'2018-10-4', '16:00', '17:00', 4),
(216,'2018-10-4', '17:00', '18:00', 4),
(217,'2018-10-5', '9:00', '10:00', 5),
(218,'2018-10-5', '10:00', '11:00', 5),
(219,'2018-10-5', '11:00', '12:00', 5),
(220,'2018-10-5', '12:00', '13:00', 5),
(221,'2018-10-5', '13:00', '14:00', 5),
(222,'2018-10-5', '14:00', '15:00', 5),
(223,'2018-10-5', '15:00', '16:00', 5),
(224,'2018-10-5', '16:00', '17:00', 5),
(300,'2018-09-19', '16:00', '17:00', 3),
(301,'2018-09-20', '16:00', '17:00', 4),
(302,'2018-09-24', '16:00', '17:00', 1),
(303,'2018-09-18', '16:00', '17:00', 2);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_horas`
--

CREATE TABLE `calendario_horas` (
  `idCalendarioHoras` int(11) NOT NULL,
  `idCalendario` int(11) NOT NULL,
  `idAsignatura` int(11),
  `idCurso` int(11),
  `idHoraPosible` int(11) NOT NULL,
  `idAlerta` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario_horas`
--
insert into `calendario_horas` (`idCalendarioHoras`, `idCalendario`, `idAsignatura`, `idCurso`, `idHoraPosible`, `idAlerta`) values
  (200, 1, NULL, NULL, 300, 3),
  (201, 1, NULL, NULL, 301, 3),
  (202, 1, NULL, NULL, 302, 3),
  (203, 1, NULL, NULL, 303, 3),
  (1, 1, 1, 3, 1, NULL),
  (2, 1, NULL, NULL, 2, 1),
  (3, 1, 3, 3, 3, NULL),
  (4, 1, 4, 4, 4, NULL),
  (5, 1, 5, 3, 5, NULL),
  (6, 1, 6, 4, 6, NULL),
  (7, 1, 1, 3, 7, NULL),
  (8, 1, 2, 4, 8, NULL),
  (9, 1, 3, 3, 9, NULL),
  (10, 2, NULL, NULL, 10, 2),
  (11, 2, 5, 3, 11, NULL),
  (12, 2, 6, 4, 12, NULL),
  (13, 2, 1, 3, 13, NULL),
  (14, 2, 2, 4, 14, NULL),
  (15, 2, 3, 3, 15, NULL),
  (16, 2, 4, 4, 16, NULL),
  (17, 2, 5, 3, 17, NULL),
  (18, 2, 6, 4, 18, NULL),
  (19, 2, 1, 3, 19, NULL),
  (20, 3, 2, 4, 20, NULL),
  (21, 3, 3, 3, 21, NULL),
  (22, 3, 4, 4, 22, NULL),
  (23, 3, 5, 3, 23, NULL),
  (24, 3, 6, 4, 24, NULL),
  (25, 3, 1, 3, 25, NULL),
  (26, 3, 2, 4, 26, NULL),
  (27, 3, 3, 3, 27, NULL),
  (28, 3, 4, 4, 28, NULL),
  (29, 3, 5, 3, 29, NULL),
  (30, 4, 6, 4, 30, NULL),
  (31, 4, 1, 3, 31, NULL),
  (32, 4, 2, 4, 32, NULL),
  (33, 4, 3, 3, 33, NULL),
  (34, 4, 4, 4, 34, NULL),
  (35, 4, 5, 3, 35, NULL),
  (36, 4, 6, 4, 36, NULL),
  (37, 4, 1, 3, 37, NULL),
  (38, 4, 2, 4, 38, NULL),
  (39, 4, 3, 3, 39, NULL),
  (40, 1, 4, 4, 40, NULL),
  (41, 1, 5, 3, 41, NULL),
  (42, 1, 6, 4, 42, NULL),
  (43, 1, 1, 3, 43, NULL),
  (44, 1, 2, 4, 44, NULL),
  (45, 2, 3, 3, 45, NULL),
  (46, 3, 4, 4, 46, NULL),
  (47, 4, 5, 3, 47, NULL),
  (48, 1, 6, 4, 48, NULL),
  (49, 2, 1, 3, 49, NULL),
  (50, 2, 2, 4, 50, NULL),
  (51, 2, 3, 3, 51, NULL),
  (52, 3, 4, 4, 52, NULL),
  (53, 4, 5, 3, 53, NULL),
  (54, 1, 6, 4, 54, NULL),
  (55, 3, 1, 3, 55, NULL),
  (56, 3, 2, 4, 56, NULL),
  (57, 2, 3, 3, 57, NULL),
  (58, 3, 4, 4, 58, NULL),
  (59, 4, 5, 3, 59, NULL),
  (60, 1, 6, 4, 60, NULL),
  (61, 4, 1, 3, 61, NULL),
  (62, 4, 2, 4, 62, NULL),
  (63, 2, 3, 3, 63, NULL),
  (64, 3, 4, 4, 64, NULL),
  (65, 4, 5, 3, 65, NULL),
  (66, 1, 6, 4, 66, NULL),
  (67, 1, 1, 3, 67, NULL),
  (68, 2, 2, 4, 68, NULL),
  (69, 2, 3, 3, 69, NULL),
  (70, 3, 4, 4, 70, NULL),
  (71, 4, 5, 3, 71, NULL),
  (72, 1, 6, 4, 72, NULL),
  (73, 2, 3, 3, 73, NULL),
  (74, 3, 4, 4, 74, NULL),
  (75, 4, 5, 3, 75, NULL),
  (76, 1, 6, 4, 76, NULL),
  (77, 3, 1, 3, 77, NULL),
  (78, 3, 2, 4, 78, NULL),
  (79, 2, 3, 3, 79, NULL),
  (80, 3, 4, 4, 80, NULL),
  (81, 4, 5, 3, 81, NULL),
  (82, 1, 6, 4, 82, NULL),
  (83, 3, 1, 3, 83, NULL),
  (84, 4, 2, 4, 84, NULL),
  (85, 4, 3, 3, 85, NULL),
  (86, 3, 4, 4, 86, NULL),
  (87, 4, 5, 3, 87, NULL),
  (88, 1, 6, 4, 88, NULL),
  (89, 1, 1, 3, 89, NULL),
  (90, 1, 2, 4, 90, NULL);

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
-- Indices de la tabla `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`idAlerta`);
  

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
-- Indices de la tabla `horario_cuatrimestre`
--
ALTER TABLE `horario_cuatrimestre`
 ADD PRIMARY KEY (`idHorarioCuatrimestre`);
 
--
-- Indices de la tabla `rango_horario`
--
ALTER TABLE `rango_horario`
 ADD PRIMARY KEY (`idRangoHorario`),
 ADD KEY `idHorarioCuatrimestre` (`idHorarioCuatrimestre`);
 
--
-- Indices de la tabla `horas_posibles`
--
ALTER TABLE `horas_posibles`
 ADD PRIMARY KEY (`idHoraPosible`),
 ADD KEY `idRangoHorario` (`idRangoHorario`);

--
-- Indices de la tabla `calendario_horas`
--
ALTER TABLE `calendario_horas`
 ADD PRIMARY KEY(`idCalendarioHoras`),
 ADD KEY `idCalendario` (`idCalendario`),
 ADD KEY `idAsignatura` (`idAsignatura`),
 ADD KEY `idCurso` (`idCurso`),
 ADD KEY `idHoraPosible` (`idHoraPosible`),
 ADD KEY `idAlerta` (`idAlerta`);
 
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
-- AUTO_INCREMENT de la tabla `horario_cuatrimestre`
--
ALTER TABLE `horario_cuatrimestre`
  MODIFY `idHorarioCuatrimestre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rango_horario`
--
ALTER TABLE `rango_horario`
  MODIFY `idRangoHorario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horas_posibles`
--
ALTER TABLE `horas_posibles`
  MODIFY `idHoraPosible` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calendario_horas`
--
ALTER TABLE `calendario_horas`
  MODIFY `idCalendarioHoras` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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

  --
-- constraints for table `rango_horario`
--
ALTER TABLE `rango_horario`
  ADD CONSTRAINT `rango_horario_ibfk_1` FOREIGN KEY (`idHorarioCuatrimestre`) REFERENCES `horario_cuatrimestre` (`idHorarioCuatrimestre`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- constraints for table `horas_posibles`
--
ALTER TABLE `horas_posibles`
  ADD CONSTRAINT `horas_posibles_ibfk_1` FOREIGN KEY (`idRangoHorario`) REFERENCES `rango_horario` (`idRangoHorario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- constraints for table `calendario_horas`
--
ALTER TABLE `calendario_horas`
  ADD CONSTRAINT `calendario_horas_ibfk_1` FOREIGN KEY (`idCalendario`) REFERENCES `calendario` (`idCalendario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendario_horas_ibfk_2` FOREIGN KEY (`idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendario_horas_ibfk_3` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendario_horas_ibfk_4` FOREIGN KEY (`idHoraPosible`) REFERENCES `horas_posibles` (`idHoraPosible`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendario_horas_ibfk_5` FOREIGN KEY (`idAlerta`) REFERENCES `alerta` (`idAlerta`) ON DELETE CASCADE ON UPDATE CASCADE;  

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
