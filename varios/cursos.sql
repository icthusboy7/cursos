-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.27 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para cursos
CREATE DATABASE IF NOT EXISTS `cursos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cursos`;


-- Volcando estructura para tabla cursos.audit
CREATE TABLE IF NOT EXISTS `audit` (
  `pk_audit` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `action` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  PRIMARY KEY (`pk_audit`),
  KEY `FK_audit_usuarios` (`fk_usuario`),
  CONSTRAINT `FK_audit_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla cursos.audit: ~147 rows (aproximadamente)
/*!40000 ALTER TABLE `audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `pk_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.cursos: ~28 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.cursos_usuarios
CREATE TABLE IF NOT EXISTS `cursos_usuarios` (
  `fk_curso` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_admin` int(11) NOT NULL,
  `fecha_asignacion` datetime DEFAULT NULL,
  PRIMARY KEY (`fk_curso`,`fk_usuario`),
  KEY `FK_usuarios` (`fk_usuario`),
  KEY `FK_admin` (`fk_admin`),
  CONSTRAINT `FK_admin` FOREIGN KEY (`fk_admin`) REFERENCES `usuarios` (`pk_usuario`),
  CONSTRAINT `FK_cursos` FOREIGN KEY (`fk_curso`) REFERENCES `cursos` (`pk_curso`),
  CONSTRAINT `FK_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.cursos_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.ficheros
CREATE TABLE IF NOT EXISTS `ficheros` (
  `pk_fichero` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(11) NOT NULL,
  `fk_tema` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `directorio` varchar(80) COLLATE utf8_bin NOT NULL,
  `fecha_upload` datetime NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_fichero`),
  KEY `FK_ficheros_usuarios` (`fk_usuario`),
  KEY `FK_ficheros_temas` (`fk_tema`),
  CONSTRAINT `FK_ficheros_temas` FOREIGN KEY (`fk_tema`) REFERENCES `temas` (`pk_tema`),
  CONSTRAINT `FK_ficheros_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.ficheros: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `ficheros` DISABLE KEYS */;
/*!40000 ALTER TABLE `ficheros` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `pk_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.perfiles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`pk_perfil`, `nombre`, `status`) VALUES
	(1, 'Administrador', 1),
	(2, 'Alumno', 1);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.temas
CREATE TABLE IF NOT EXISTS `temas` (
  `pk_tema` int(11) NOT NULL AUTO_INCREMENT,
  `fk_curso` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_tema`),
  KEY `FK_temas_cursos` (`fk_curso`),
  CONSTRAINT `FK_temas_cursos` FOREIGN KEY (`fk_curso`) REFERENCES `cursos` (`pk_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.temas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `pk_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `fk_perfil` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `verification` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_usuario`),
  KEY `fk_perfil` (`fk_perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`fk_perfil`) REFERENCES `perfiles` (`pk_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.usuarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`pk_usuario`, `fk_perfil`, `nombre`, `usuario`, `password`, `verification`, `email`, `status`) VALUES
	(1, 1, 'Antonio Jurado', 'toni', 'c72d8d3aaac76423d12dcf28962b6269', 'Q2lsYW50cm8x', 'tonijurado@cilantroit.com', 1),
	(2, 2, 'VICTOR BACA', 'isai', '8031378560d02dfe8d473091661dac83', 'cHJ1ZWJhMQ==', 'isaionline@hotmail.com', 1);
	
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
