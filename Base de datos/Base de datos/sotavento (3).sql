-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2024 a las 18:23:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sotavento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alumno_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `curp` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(4) DEFAULT NULL,
  `Fecha_alta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `actualización` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alumno_id`, `nombre`, `primer_apellido`, `segundo_apellido`, `matricula`, `curp`, `fecha_nacimiento`, `sexo`, `Fecha_alta`, `actualización`) VALUES
(1, 'Omar ', 'Rivas', 'Perez', '21009758', 'RIPO020203HVZVRMA0', '2002-02-03', 'M', '2024-03-16 17:18:11', NULL),
(2, 'Carlos Alberto', 'Molina', 'Canseco', '121305866', 'MOCG010922HVEMLR00', '2001-09-22', 'X', '2024-03-16 17:18:11', NULL),
(3, 'Miguel Angel', 'Garduza', 'Aburto', '21009759', 'GAAM001128HVERGB00', '2000-11-28', 'M', '2024-03-16 17:18:11', NULL),
(4, 'Leonel', 'Leon', 'Flores', '21009760', 'LELL020123XOCOONN00', '2002-01-23', 'M', '2024-03-16 17:18:11', NULL),
(5, 'Jesus Aaron', 'Ramirez', 'Villegas', '21009731', 'RAVJ020715HGRMLS00', '2002-07-15', 'M', '2024-03-16 17:18:11', NULL),
(6, 'Gerson Jael ', 'Sahagun', 'Camacho', '21009761', 'CASA020825HVEMRH00', '2002-08-25', 'M', '2024-03-16 17:18:11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `asistencia` varchar(50) NOT NULL,
  `horario_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos_qr`
--

CREATE TABLE `codigos_qr` (
  `id_codigo` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `used` tinyint(1) DEFAULT NULL,
  `fec_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE `facultades` (
  `facultad_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(255) DEFAULT NULL,
  `usuario_actualizacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`facultad_id`, `nombre`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`) VALUES
(1, 'Ingeniería en Sistemas', '2024-03-01 00:51:29', '2024-03-01 00:54:30', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `grupo_id` int(11) NOT NULL,
  `clave_grupo` varchar(255) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `semestre_id` int(11) DEFAULT NULL,
  `facultad_id` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(255) DEFAULT NULL,
  `usuario_actualizacion` varchar(255) DEFAULT NULL,
  `materia_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`grupo_id`, `clave_grupo`, `nombre`, `semestre_id`, `facultad_id`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`, `materia_id`) VALUES
(1, '8510', NULL, 1, 1, '2024-03-01 01:02:00', '2024-03-11 23:20:23', 'admin', 'admin', 1),
(2, '7510', NULL, 2, 1, '2024-03-06 19:49:25', '2024-03-11 23:20:23', NULL, NULL, 2),
(3, '9510', NULL, 3, 1, '2024-03-06 19:49:25', '2024-03-11 23:20:23', NULL, NULL, 3),
(4, '6510', NULL, 4, 1, '2024-03-06 19:51:43', '2024-03-11 23:20:23', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_asistencia`
--

CREATE TABLE `historial_asistencia` (
  `historial_id` int(11) NOT NULL,
  `asistencia_id` int(11) DEFAULT NULL,
  `estatus_anterior` varchar(50) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_actualizacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `horario_id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `profesor_id` int(11) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(255) DEFAULT NULL,
  `usuario_actualizacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`horario_id`, `grupo_id`, `materia_id`, `profesor_id`, `hora_inicio`, `hora_fin`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`) VALUES
(15, 1, 1, 1, '17:00:00', '19:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(16, 1, 1, 1, '15:00:00', '17:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(17, 1, 2, 2, '13:00:00', '15:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(18, 1, 2, 2, '13:00:00', '15:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(19, 1, 3, 3, '13:00:00', '15:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(20, 1, 3, 3, '15:00:00', '17:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(21, 1, 4, 4, '13:00:00', '15:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(22, 1, 4, 4, '13:00:00', '15:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(23, 1, 5, 5, '15:00:00', '17:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(24, 1, 5, 5, '15:00:00', '17:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(25, 1, 6, 6, '15:00:00', '17:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(26, 1, 6, 6, '17:00:00', '19:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(27, 1, 7, 7, '17:00:00', '19:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin'),
(28, 1, 7, 7, '17:00:00', '19:00:00', '2024-03-01 01:08:28', '2024-03-01 01:08:28', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `facultad_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(50) DEFAULT NULL,
  `usuario_actualizacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `facultad_id`, `nombre`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`) VALUES
(1, 1, 'Arquitectura de Computadoras', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(2, 1, 'Base de Datos Avanzadas', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(3, 1, 'Desarrollo de Emprendedores', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(4, 1, 'Ingeniería de Software', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(5, 1, 'Inteligencia Artificial', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(6, 1, 'Robótica', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(7, 1, 'Técnicas de Calidad de Software', '2024-03-01 01:04:39', '2024-03-01 01:04:39', 'admin', 'admin'),
(8, 1, 'Administración de proyectos de informática', '2024-03-06 19:56:07', '2024-03-06 19:59:22', NULL, NULL),
(9, 1, 'Arquitectura de desarrollo de software', '2024-03-06 19:58:20', '2024-03-06 19:59:22', NULL, NULL),
(10, 1, 'Compiladores', '2024-03-06 19:58:20', '2024-03-06 19:59:22', NULL, NULL),
(11, 1, 'Control digital', '2024-03-06 19:58:20', '2024-03-06 19:59:22', NULL, NULL),
(12, 1, 'Digital común', '2024-03-06 19:58:20', '2024-03-06 19:59:22', NULL, NULL),
(13, 1, 'Lenguaje ensamblador', '2024-03-06 19:58:20', '2024-03-06 19:59:22', NULL, NULL),
(14, 1, 'Sociedad y desarrollo de mexico', '2024-03-06 19:58:20', '2024-03-06 19:59:30', NULL, NULL),
(15, 1, 'Costos y presupuestos', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(16, 1, 'ELectricidad y magnetismo', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(17, 1, 'Estructura de datos', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(18, 1, 'Fundamentos de base de datos', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(19, 1, 'Mercadeo de software', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(20, 1, 'Programación de interfacez', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(21, 1, 'Sociedad y desarrollo en el mundo', '2024-03-06 20:02:42', '2024-03-06 20:02:42', NULL, NULL),
(22, 1, 'Administración de centros de computo', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL),
(23, 1, 'Comercialización de software', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL),
(24, 1, 'Desarrollo de aplicaciones avanzadas en internet', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL),
(25, 1, 'Redes de telecomunicaciones', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL),
(26, 1, 'Seminario de investigación aplicada', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL),
(27, 1, 'Sistemas digitales para comunicaciones', '2024-03-06 20:05:48', '2024-03-06 20:05:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `asistencia_id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(50) DEFAULT NULL,
  `usuario_actualizacion` varchar(50) DEFAULT NULL,
  `profesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`asistencia_id`, `alumno_id`, `grupo_id`, `materia_id`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`, `profesor_id`) VALUES
(1, 1, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(2, 2, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(3, 3, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(4, 4, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(5, 5, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(6, 6, 1, 1, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 1),
(7, 1, 1, 2, '2024-03-15 01:15:28', '2024-03-15 01:15:28', NULL, NULL, 2),
(8, 2, 1, 2, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 2),
(9, 3, 1, 2, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 2),
(10, 4, 1, 2, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 2),
(11, 5, 1, 2, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 2),
(12, 6, 1, 2, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 2),
(13, 1, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(14, 2, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(15, 3, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(16, 4, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(17, 5, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(18, 6, 1, 3, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 3),
(19, 1, 1, 4, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 4),
(20, 2, 1, 4, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 4),
(21, 3, 1, 4, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 4),
(22, 4, 1, 4, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 4),
(23, 5, 1, 4, '2024-03-15 01:15:29', '2024-03-15 01:15:29', NULL, NULL, 4),
(24, 6, 1, 4, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 4),
(25, 1, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(26, 2, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(27, 3, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(28, 4, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(29, 5, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(30, 6, 1, 5, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 5),
(31, 1, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(32, 2, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(33, 3, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(34, 4, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(35, 5, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(36, 6, 1, 6, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 6),
(37, 1, 1, 7, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 7),
(38, 2, 1, 7, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 7),
(39, 3, 1, 7, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 7),
(40, 4, 1, 7, '2024-03-15 01:15:30', '2024-03-15 01:15:30', NULL, NULL, 7),
(41, 5, 1, 7, '2024-03-15 01:15:31', '2024-03-15 01:15:31', NULL, NULL, 7),
(42, 6, 1, 7, '2024-03-15 01:15:31', '2024-03-15 01:15:31', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `Descripcion`) VALUES
(1, 'Estudiante'),
(2, 'Profesor'),
(3, 'Administrativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `profesor_id` int(11) NOT NULL,
  `facultad_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(4) DEFAULT NULL,
  `curp` varchar(20) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(50) DEFAULT NULL,
  `usuario_actualizacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`profesor_id`, `facultad_id`, `nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `sexo`, `curp`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`) VALUES
(1, 1, 'Emmanuel', 'Terán', 'Ríos', '1980-05-12', 'M', 'TEREMM801512HTCRN01', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(2, 1, 'Gilberto', 'Huerta', 'Ramos', '1975-08-18', 'M', 'HUERAM750818HTCLL02', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(3, 1, 'Oscar', 'Jara', 'Morales', '1982-10-25', 'M', 'JAMOOS821025HTCRSR03', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(4, 1, 'Abel', 'Ramírez', 'Figueroa', '1978-03-30', 'M', 'RAFIAB780330HTCRBL04', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(5, 1, 'José Ángel', 'Castillo', 'Torres', '1983-07-15', 'M', 'CASTJAT830715HTCRRR0', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(6, 1, 'Bryan Argennis', 'Sahagun', 'Camacho', '1981-11-28', 'M', 'SAHCBR811128HTCRMH06', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin'),
(7, 1, 'Marco Antonio', 'Valdivieso', 'Rodríguez', '1976-06-20', 'M', 'VALROM760620HTCRRC07', '2024-03-01 01:06:08', '2024-03-06 20:14:03', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres`
--

CREATE TABLE `semestres` (
  `semestre_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `facultad_id` int(11) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_alta` varchar(255) DEFAULT NULL,
  `usuario_actualizacion` varchar(255) DEFAULT NULL,
  `id_materia` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `semestres`
--

INSERT INTO `semestres` (`semestre_id`, `nombre`, `facultad_id`, `fecha_alta`, `fecha_actualizacion`, `usuario_alta`, `usuario_actualizacion`, `id_materia`) VALUES
(1, 'Octavo Semestre', 1, '2024-03-01 00:54:43', '2024-03-01 01:01:54', 'admin', 'admin', 0),
(2, 'Septimo semestre', 1, '2024-03-06 19:42:03', '2024-03-06 19:42:38', NULL, NULL, 0),
(3, 'Noveno semestre', 1, '2024-03-06 19:42:03', '2024-03-06 19:42:38', NULL, NULL, 0),
(4, 'Sexto semestre', 1, '2024-03-06 19:51:08', '2024-03-06 19:51:08', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `fecha_ult_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fec_alta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fec_modif` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alumno_id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id` (`alumno_id`) USING BTREE,
  ADD KEY `horario_id` (`horario_id`) USING BTREE;

--
-- Indices de la tabla `codigos_qr`
--
ALTER TABLE `codigos_qr`
  ADD PRIMARY KEY (`id_codigo`),
  ADD KEY `fk_codigos_qr_usuario` (`id_usuario`),
  ADD KEY `id_materia` (`Id_materia`);

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`facultad_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo_id`),
  ADD KEY `semestre_id` (`semestre_id`) USING BTREE,
  ADD KEY `materia_id` (`materia_id`) USING BTREE,
  ADD KEY `facultad_id` (`facultad_id`) USING BTREE;

--
-- Indices de la tabla `historial_asistencia`
--
ALTER TABLE `historial_asistencia`
  ADD PRIMARY KEY (`historial_id`),
  ADD KEY `asistencia_id` (`asistencia_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`horario_id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`asistencia_id`),
  ADD KEY `alumno_id` (`alumno_id`),
  ADD KEY `grupo_id` (`grupo_id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `profesor_id` (`profesor_id`) USING BTREE;

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`profesor_id`);

--
-- Indices de la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`semestre_id`),
  ADD KEY `facultad_id` (`facultad_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `perfil_id` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alumno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigos_qr`
--
ALTER TABLE `codigos_qr`
  MODIFY `id_codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `facultad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `grupo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historial_asistencia`
--
ALTER TABLE `historial_asistencia`
  MODIFY `historial_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `horario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `asistencia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `profesor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `semestres`
--
ALTER TABLE `semestres`
  MODIFY `semestre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`horario_id`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`);

--
-- Filtros para la tabla `codigos_qr`
--
ALTER TABLE `codigos_qr`
  ADD CONSTRAINT `codigos_qr_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `codigos_qr_ibfk_2` FOREIGN KEY (`Id_materia`) REFERENCES `materias` (`materia_id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`semestre_id`),
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`facultad_id`),
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`);

--
-- Filtros para la tabla `historial_asistencia`
--
ALTER TABLE `historial_asistencia`
  ADD CONSTRAINT `historial_asistencia_ibfk_1` FOREIGN KEY (`asistencia_id`) REFERENCES `matricula` (`asistencia_id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`),
  ADD CONSTRAINT `horarios_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`),
  ADD CONSTRAINT `horarios_ibfk_3` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`profesor_id`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`alumno_id`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`grupo_id`),
  ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`),
  ADD CONSTRAINT `matricula_ibfk_4` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`profesor_id`);

--
-- Filtros para la tabla `semestres`
--
ALTER TABLE `semestres`
  ADD CONSTRAINT `semestres_ibfk_1` FOREIGN KEY (`facultad_id`) REFERENCES `facultades` (`facultad_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
