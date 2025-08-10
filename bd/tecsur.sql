-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.5.25-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para tecsur
CREATE DATABASE IF NOT EXISTS `tecsur` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `tecsur`;

-- Volcando estructura para tabla tecsur.adjunto_racs
CREATE TABLE IF NOT EXISTS `adjunto_racs` (
  `c_rac` int(11) NOT NULL,
  `c_adjunto_rac` int(11) NOT NULL AUTO_INCREMENT,
  `x_path` text NOT NULL,
  `x_documento` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_adjunto_rac`),
  KEY `c_rac` (`c_rac`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `adjunto_racs_ibfk_1` FOREIGN KEY (`c_rac`) REFERENCES `racs` (`c_rac`),
  CONSTRAINT `adjunto_racs_ibfk_2` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.adjunto_racs: ~3 rows (aproximadamente)
INSERT IGNORE INTO `adjunto_racs` (`c_rac`, `c_adjunto_rac`, `x_path`, `x_documento`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 2, 'upload', '20240618161.png', '1', '2024-06-18 21:53:27', 1),
	(2, 3, 'upload', '20240618161.png', '1', '2024-06-18 21:55:18', 1),
	(3, 4, 'upload', '202406191224443.png', '1', '2024-06-19 17:24:44', 3);

-- Volcando estructura para tabla tecsur.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `c_area` int(11) NOT NULL AUTO_INCREMENT,
  `x_area` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_area`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.areas: ~6 rows (aproximadamente)
INSERT IGNORE INTO `areas` (`c_area`, `x_area`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'ÁREA DE TECNOLOGÍA DE LA INFORMACIÓN', '1', '2024-05-20 08:34:59', 1),
	(2, 'ÁREA DE CONTABILIDAD', '1', '2024-05-20 09:01:00', 1),
	(3, 'ÁREA DE LOGÍSTICA', '1', '2024-05-20 09:01:13', 1),
	(4, 'GERENCIA GENERAL', '0', '2024-05-20 09:04:30', 1),
	(5, 'ÁREA DE ALMACÉN', '1', '2024-06-05 05:36:20', 1),
	(6, 'ÁREA DE MARKETING', '1', '2024-06-18 13:09:19', 1);

-- Volcando estructura para tabla tecsur.aud_adjunto_racs
CREATE TABLE IF NOT EXISTS `aud_adjunto_racs` (
  `c_rac` int(11) NOT NULL,
  `c_adjunto_rac` int(11) NOT NULL,
  `x_path` text NOT NULL,
  `x_documento` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_adjunto_racs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_areas
CREATE TABLE IF NOT EXISTS `aud_areas` (
  `c_area` int(11) NOT NULL,
  `x_area` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_areas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_cargos
CREATE TABLE IF NOT EXISTS `aud_cargos` (
  `c_cargo` smallint(6) NOT NULL,
  `x_cargo` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_cargos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_categorias
CREATE TABLE IF NOT EXISTS `aud_categorias` (
  `c_categoria` int(11) NOT NULL,
  `x_categoria` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_categorias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_login
CREATE TABLE IF NOT EXISTS `aud_login` (
  `c_usuario` int(11) NOT NULL,
  `x_usuario` char(9) NOT NULL,
  `x_password` text NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_login: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_perfiles
CREATE TABLE IF NOT EXISTS `aud_perfiles` (
  `c_perfil` smallint(6) NOT NULL,
  `x_perfil` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_perfiles: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_racs
CREATE TABLE IF NOT EXISTS `aud_racs` (
  `c_rac` int(11) NOT NULL,
  `c_tipo_estandar` smallint(6) NOT NULL,
  `c_categoria` int(11) NOT NULL,
  `c_area_registra` int(11) NOT NULL,
  `c_area_atiende` int(11) NOT NULL,
  `c_usuario_registra` int(11) NOT NULL,
  `c_usuario_atiende` int(11) NOT NULL,
  `n_sst` int(11) NOT NULL,
  `x_ubicacion` text NOT NULL,
  `x_descripcion` text NOT NULL,
  `x_recomendacion` text NOT NULL,
  `x_elemento` text NOT NULL,
  `l_atencion` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_racs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_tipo_documentos
CREATE TABLE IF NOT EXISTS `aud_tipo_documentos` (
  `c_tipo_documento` smallint(6) NOT NULL,
  `x_documento` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_tipo_documentos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_tipo_estandares
CREATE TABLE IF NOT EXISTS `aud_tipo_estandares` (
  `c_tipo_estandar` smallint(6) NOT NULL,
  `x_tipo_estandar` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_tipo_estandares: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.aud_usuarios
CREATE TABLE IF NOT EXISTS `aud_usuarios` (
  `c_usuario` int(11) NOT NULL,
  `c_perfil` smallint(6) NOT NULL,
  `c_cargo` smallint(6) NOT NULL,
  `c_tipo_documento` smallint(6) NOT NULL,
  `c_area` int(11) NOT NULL,
  `x_numero_doc` text NOT NULL,
  `x_nombre` text NOT NULL,
  `x_ap_paterno` text NOT NULL,
  `x_ap_materno` text NOT NULL,
  `x_correo` text NOT NULL,
  `l_estado` char(1) NOT NULL,
  `f_registro` datetime NOT NULL,
  `c_auditor` int(11) NOT NULL,
  `aud_estado` char(1) NOT NULL,
  `aud_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.aud_usuarios: ~0 rows (aproximadamente)

-- Volcando estructura para tabla tecsur.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `c_cargo` smallint(6) NOT NULL AUTO_INCREMENT,
  `x_cargo` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_cargo`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.cargos: ~6 rows (aproximadamente)
INSERT IGNORE INTO `cargos` (`c_cargo`, `x_cargo`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'INGENIERO DE SISTEMAS', '1', '2024-05-20 08:50:17', 1),
	(2, 'CONTADOR PÚBLICO', '1', '2024-05-20 09:02:37', 1),
	(3, 'GERENTE DE COMPRAS', '1', '2024-05-20 09:02:37', 1),
	(4, 'GERENTE GENERAL', '0', '2024-05-20 09:04:09', 1),
	(5, 'SASs', '0', '2024-06-06 00:01:19', 1),
	(6, 'DIRECTOR DE OPERACIONES', '1', '2024-06-18 13:10:13', 1);

-- Volcando estructura para tabla tecsur.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `c_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `x_categoria` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_categoria`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.categorias: ~12 rows (aproximadamente)
INSERT IGNORE INTO `categorias` (`c_categoria`, `x_categoria`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'VEHÍCULOS', '1', '2024-05-20 08:42:21', 1),
	(2, 'INSTALACIONES (ESTRUC, OFICINAS. ALMACENES, ELÉCTRICAS)', '1', '2024-05-20 08:46:47', 1),
	(3, 'EQUIPOS, HERRAMIENTAS Y/O MÁQUINAS', '1', '2024-05-20 08:46:47', 1),
	(4, 'SEÑALIZACIÓN', '1', '2024-05-20 08:46:47', 1),
	(5, 'ORDEN Y LIMPIEZA', '1', '2024-05-20 08:46:47', 1),
	(6, 'MOBILIARIO (SILLAS, MESAS, ESCRITORIOS, ESTANTES)', '1', '2024-05-20 08:46:47', 1),
	(7, 'MANEJO DE RESIDUOS (PELIGROSO / NO PELIGROSO)', '1', '2024-05-20 08:46:47', 1),
	(8, 'ELEMENTOS DE EMERGENCIA (EXTINTOR, BOTIQUIN, CAMILLAS)', '1', '2024-05-20 08:46:47', 1),
	(9, 'EQUIPO DE PROTECCIÓN PERSONAL (EPP)', '1', '2024-05-20 08:46:47', 1),
	(10, 'MANIPULACIÓN DE CARGAS (CON EQUIPO Y/O MANUAL)', '1', '2024-05-20 08:46:47', 1),
	(11, 'OTROS', '1', '2024-05-20 08:46:47', 1),
	(12, 'DOCUMENTOS RELACIONADOS A LA ACTIVIDAD', '1', '2024-05-20 08:46:47', 1);

-- Volcando estructura para tabla tecsur.login
CREATE TABLE IF NOT EXISTS `login` (
  `c_usuario` int(11) NOT NULL,
  `x_usuario` char(9) NOT NULL,
  `x_password` text NOT NULL,
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_usuario`),
  UNIQUE KEY `x_usuario` (`x_usuario`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.login: ~5 rows (aproximadamente)
INSERT IGNORE INTO `login` (`c_usuario`, `x_usuario`, `x_password`, `f_registro`, `c_auditor`) VALUES
	(1, 'U11111111', '$2y$10$DWLrzBwNCLXqVbRp5oNbEOHMdFLCk64lMUKtfjzsSj4fs7SvSVzIC', '2024-05-20 08:55:30', 1),
	(2, 'U2222222', '$2y$10$ERiaoMLbBuvAe5iXsGq8m.soVXksTNvIPF8N7Cd4XLHZitAhnfsw6', '2024-05-20 08:55:30', 1),
	(3, 'U33333333', '$2y$10$iKF8OJVZLJys0XriaQvnKO4/IjZVel.qMkr4xIM1G4Tkt0qWS6SGC', '2024-05-20 08:55:46', 1),
	(4, 'P44444444', '$2y$10$ERiaoMLbBuvAe5iXsGq8m.soVXksTNvIPF8N7Cd4XLHZitAhnfsw6', '2024-05-20 09:25:02', 1),
	(5, 'U76857524', '$2y$10$DWLrzBwNCLXqVbRp5oNbEOHMdFLCk64lMUKtfjzsSj4fs7SvSVzIC', '2024-06-18 16:24:57', 1);

-- Volcando estructura para tabla tecsur.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `c_perfil` smallint(6) NOT NULL AUTO_INCREMENT,
  `x_perfil` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_perfil`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.perfiles: ~3 rows (aproximadamente)
INSERT IGNORE INTO `perfiles` (`c_perfil`, `x_perfil`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'ADMINISTRADOR DE SISTEMA', '1', '2024-05-20 08:39:24', 1),
	(2, 'COLABORADOR', '1', '2024-05-20 09:11:28', 1),
	(3, 'CONSULTA', '1', '2024-05-20 09:11:28', 1);

-- Volcando estructura para tabla tecsur.racs
CREATE TABLE IF NOT EXISTS `racs` (
  `c_rac` int(11) NOT NULL AUTO_INCREMENT,
  `c_tipo_estandar` smallint(6) NOT NULL,
  `c_categoria` int(11) NOT NULL,
  `c_area_registra` int(11) NOT NULL,
  `c_area_atiende` int(11) DEFAULT NULL,
  `c_usuario_registra` int(11) NOT NULL,
  `c_usuario_atiende` int(11) DEFAULT NULL,
  `n_sst` int(11) NOT NULL,
  `x_ubicacion` text NOT NULL,
  `x_descripcion` text NOT NULL,
  `x_recomendacion` text NOT NULL,
  `x_elemento` text NOT NULL,
  `l_atencion` char(1) DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `f_reporte` date DEFAULT NULL,
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_rac`),
  KEY `c_tipo_estandar` (`c_tipo_estandar`),
  KEY `c_categoria` (`c_categoria`),
  KEY `c_area_registra` (`c_area_registra`),
  KEY `c_area_atiende` (`c_area_atiende`),
  KEY `c_usuario_registra` (`c_usuario_registra`),
  KEY `c_usuario_atiende` (`c_usuario_atiende`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `racs_ibfk_1` FOREIGN KEY (`c_tipo_estandar`) REFERENCES `tipo_estandares` (`c_tipo_estandar`),
  CONSTRAINT `racs_ibfk_2` FOREIGN KEY (`c_categoria`) REFERENCES `categorias` (`c_categoria`),
  CONSTRAINT `racs_ibfk_3` FOREIGN KEY (`c_area_registra`) REFERENCES `areas` (`c_area`),
  CONSTRAINT `racs_ibfk_5` FOREIGN KEY (`c_usuario_registra`) REFERENCES `usuarios` (`c_usuario`),
  CONSTRAINT `racs_ibfk_7` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.racs: ~3 rows (aproximadamente)
INSERT IGNORE INTO `racs` (`c_rac`, `c_tipo_estandar`, `c_categoria`, `c_area_registra`, `c_area_atiende`, `c_usuario_registra`, `c_usuario_atiende`, `n_sst`, `x_ubicacion`, `x_descripcion`, `x_recomendacion`, `x_elemento`, `l_atencion`, `f_registro`, `f_reporte`, `c_auditor`) VALUES
	(1, 1, 5, 1, 5, 1, 0, 1234, 'PRIMER PISO', 'ORDEN Y LIMPIEZA', 'Se coordino con mantenimiento.', 'ORDEN Y LIMPIEZA', '1', '2024-06-18 21:53:27', '2024-06-17', 3),
	(2, 1, 5, 1, 5, 1, 0, 1234, 'PRIMER PISO', 'ORDEN Y LIMPIEZA', 'Restricciones en la consola', 'ORDEN Y LIMPIEZA', '1', '2024-06-18 21:55:18', '2024-06-17', 3),
	(3, 2, 6, 5, 1, 3, 0, 12, 'INFORMATICA', 'DESCRIPCION INFORMATICA', '', 'PC', '0', '2024-06-19 17:24:44', '2024-06-19', 3);

-- Volcando estructura para tabla tecsur.tipo_documentos
CREATE TABLE IF NOT EXISTS `tipo_documentos` (
  `c_tipo_documento` smallint(6) NOT NULL AUTO_INCREMENT,
  `x_documento` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_tipo_documento`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `tipo_documentos_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.tipo_documentos: ~3 rows (aproximadamente)
INSERT IGNORE INTO `tipo_documentos` (`c_tipo_documento`, `x_documento`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'DOCUMENTO NACIONAL DE IDENTIDAD', '1', '2024-05-20 08:38:06', 1),
	(2, 'PASAPORTE', '1', '2024-05-20 08:38:06', 1),
	(3, 'CARNET DE EXTRANJERIA', '1', '2024-05-20 08:38:18', 1);

-- Volcando estructura para tabla tecsur.tipo_estandares
CREATE TABLE IF NOT EXISTS `tipo_estandares` (
  `c_tipo_estandar` smallint(6) NOT NULL AUTO_INCREMENT,
  `x_tipo_estandar` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_tipo_estandar`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `tipo_estandares_ibfk_1` FOREIGN KEY (`c_auditor`) REFERENCES `usuarios` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.tipo_estandares: ~2 rows (aproximadamente)
INSERT IGNORE INTO `tipo_estandares` (`c_tipo_estandar`, `x_tipo_estandar`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 'ACTO SUBESTÁNDAR', '1', '2024-05-20 08:40:53', 1),
	(2, 'CONDICIÓN SUBESTÁNDAR', '1', '2024-05-20 08:40:53', 1);

-- Volcando estructura para tabla tecsur.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `c_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `c_perfil` smallint(6) NOT NULL,
  `c_cargo` smallint(6) NOT NULL,
  `c_tipo_documento` smallint(6) NOT NULL,
  `c_area` int(11) NOT NULL,
  `x_numero_doc` text NOT NULL,
  `x_nombre` text NOT NULL,
  `x_ap_paterno` text NOT NULL,
  `x_ap_materno` text NOT NULL,
  `x_correo` text NOT NULL,
  `l_estado` char(1) NOT NULL DEFAULT '0',
  `f_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `c_auditor` int(11) NOT NULL,
  PRIMARY KEY (`c_usuario`),
  KEY `c_perfil` (`c_perfil`),
  KEY `c_cargo` (`c_cargo`),
  KEY `c_tipo_documento` (`c_tipo_documento`),
  KEY `c_area` (`c_area`),
  KEY `c_auditor` (`c_auditor`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`c_perfil`) REFERENCES `perfiles` (`c_perfil`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`c_area`) REFERENCES `areas` (`c_area`),
  CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`c_cargo`) REFERENCES `cargos` (`c_cargo`),
  CONSTRAINT `usuarios_ibfk_5` FOREIGN KEY (`c_usuario`) REFERENCES `login` (`c_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla tecsur.usuarios: ~5 rows (aproximadamente)
INSERT IGNORE INTO `usuarios` (`c_usuario`, `c_perfil`, `c_cargo`, `c_tipo_documento`, `c_area`, `x_numero_doc`, `x_nombre`, `x_ap_paterno`, `x_ap_materno`, `x_correo`, `l_estado`, `f_registro`, `c_auditor`) VALUES
	(1, 1, 1, 1, 1, '11111111', 'LUIS', 'CENTENO', 'CENTENO', 'U1111111@github.com', '1', '2024-05-20 08:56:09', 1),
	(2, 2, 2, 2, 1, '22222222', 'LUIS', 'CENTENO', 'CENTENO', 'U2222222@github.com', '1', '2024-05-22 09:19:35', 1),
	(3, 2, 3, 1, 5, '33333333', 'LUIS', 'CENTENO', 'CENTENO', 'U33333333@github.com', '1', '2024-05-22 09:19:35', 1),
	(4, 3, 4, 1, 4, '44444444', 'LUIS', 'CENTENO', 'CENTENO', 'P44444444@github.com', '1', '2024-05-22 09:26:25', 1),
	(5, 3, 6, 1, 1, '55555555', 'LUIS', 'CENTENO', 'CENTENO', 'U55555555@github.com', '1', '2024-06-18 16:24:57', 1);

-- Volcando estructura para vista tecsur.uvw_usuarioarea
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `uvw_usuarioarea` (
	`c_usuario` INT(11) NOT NULL,
	`c_area` INT(11) NOT NULL,
	`x_area` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_nombre` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_paterno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_materno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_correo` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`l_estado` CHAR(1) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista tecsur.uvw_usuariocargo
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `uvw_usuariocargo` (
	`c_usuario` INT(11) NOT NULL,
	`c_cargo` SMALLINT(6) NOT NULL,
	`x_cargo` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_nombre` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_paterno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_materno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_correo` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`l_estado` CHAR(1) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista tecsur.uvw_usuariodocumento
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `uvw_usuariodocumento` (
	`c_usuario` INT(11) NOT NULL,
	`c_tipo_documento` SMALLINT(6) NOT NULL,
	`x_documento` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_numero_doc` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_nombre` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_paterno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_materno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_correo` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`l_estado` CHAR(1) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista tecsur.uvw_usuarioperfil
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `uvw_usuarioperfil` (
	`c_usuario` INT(11) NOT NULL,
	`c_perfil` SMALLINT(6) NOT NULL,
	`x_perfil` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_nombre` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_paterno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_ap_materno` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`x_correo` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`l_estado` CHAR(1) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `uvw_usuarioarea`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `uvw_usuarioarea` AS SELECT `u`.`c_usuario` AS `c_usuario`, `u`.`c_area` AS `c_area`, `a`.`x_area` AS `x_area`, `u`.`x_nombre` AS `x_nombre`, `u`.`x_ap_paterno` AS `x_ap_paterno`, `u`.`x_ap_materno` AS `x_ap_materno`, `u`.`x_correo` AS `x_correo`, `u`.`l_estado` AS `l_estado` FROM (`areas` `a` join `usuarios` `u` on(`a`.`c_area` = `u`.`c_area`)) ;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `uvw_usuariocargo`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `uvw_usuariocargo` AS SELECT `u`.`c_usuario` AS `c_usuario`, `u`.`c_cargo` AS `c_cargo`, `c`.`x_cargo` AS `x_cargo`, `u`.`x_nombre` AS `x_nombre`, `u`.`x_ap_paterno` AS `x_ap_paterno`, `u`.`x_ap_materno` AS `x_ap_materno`, `u`.`x_correo` AS `x_correo`, `u`.`l_estado` AS `l_estado` FROM (`cargos` `c` join `usuarios` `u` on(`c`.`c_cargo` = `u`.`c_cargo`)) ;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `uvw_usuariodocumento`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `uvw_usuariodocumento` AS SELECT `u`.`c_usuario` AS `c_usuario`, `u`.`c_tipo_documento` AS `c_tipo_documento`, `td`.`x_documento` AS `x_documento`, `u`.`x_numero_doc` AS `x_numero_doc`, `u`.`x_nombre` AS `x_nombre`, `u`.`x_ap_paterno` AS `x_ap_paterno`, `u`.`x_ap_materno` AS `x_ap_materno`, `u`.`x_correo` AS `x_correo`, `u`.`l_estado` AS `l_estado` FROM (`tipo_documentos` `td` join `usuarios` `u` on(`td`.`c_tipo_documento` = `u`.`c_tipo_documento`)) ;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `uvw_usuarioperfil`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `uvw_usuarioperfil` AS SELECT `u`.`c_usuario` AS `c_usuario`, `u`.`c_perfil` AS `c_perfil`, `p`.`x_perfil` AS `x_perfil`, `u`.`x_nombre` AS `x_nombre`, `u`.`x_ap_paterno` AS `x_ap_paterno`, `u`.`x_ap_materno` AS `x_ap_materno`, `u`.`x_correo` AS `x_correo`, `u`.`l_estado` AS `l_estado` FROM (`perfiles` `p` join `usuarios` `u` on(`p`.`c_perfil` = `u`.`c_perfil`)) ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
