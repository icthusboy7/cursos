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
  `section` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  PRIMARY KEY (`pk_audit`),
  KEY `FK_audit_usuarios` (`fk_usuario`),
  CONSTRAINT `FK_audit_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla cursos.audit: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `audit` DISABLE KEYS */;
INSERT INTO `audit` (`pk_audit`, `created_at`, `section`, `description`, `fk_usuario`) VALUES
	(1, '2015-08-14 16:00:44', 'Crear cursos', 'ID:1, Nombre: d, Estado: 1', 4),
	(2, '2015-08-14 16:02:18', 'Crear cursos', 'Nombre: ggb, Estado: 1', 4),
	(3, '2015-08-14 16:03:38', 'Crear cursos', 'Nombre: ggb, Estado: 1', 4),
	(4, '2015-08-14 16:03:50', 'Crear cursos', 'Nombre: ggb, Estado: 1', 4),
	(5, '2015-08-14 16:15:18', 'Crear cursos', 'Nombre: htt, Estado: 1', 4),
	(6, '2015-08-15 01:26:42', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(7, '2015-08-15 01:28:59', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(8, '2015-08-15 12:06:28', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(9, '2015-08-15 12:11:01', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(10, '2015-08-15 12:11:11', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(11, '2015-08-15 12:13:48', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código', 4),
	(12, '2015-08-15 12:18:57', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código: 35, Nombre del curso: htt1, Estado: Activo <br> Valores nuevos -> Nombre del curso: , Estado: Activo', 4),
	(13, '2015-08-15 12:19:55', 'Editar cursos', 'Código editado:35 <br> Valores anteriores ->Código: 35, Nombre del curso: htt2, Estado: Activo <br> Valores nuevos -> Nombre del curso: , Estado: Activo', 4),
	(14, '2015-08-15 13:33:54', 'Eliminar cursos', 'Se ha eliminado el curso con los siguientes valores:\r\n						                    </br>Código: 34, Nombre del curso: ggb, Estado: Activo', 4),
	(15, '2015-08-15 14:01:06', 'Eliminar cursos', 'Se ha eliminado el curso con los siguientes valores:\r\n							</br>Código: 4, Nombre del curso: prueba2, Estado: Activo', 4),
	(16, '2015-08-15 14:04:15', 'Eliminar cursos', '', 4),
	(17, '2015-08-15 21:43:00', 'Crear Temas', 'Nombre: TEMA1, Estado: 1, Curso: htt3', 4),
	(18, '2015-08-15 21:44:54', 'Crear Temas', 'Nombre: TEMA1, Estado: 1, Curso: htt3', 4),
	(19, '2015-08-15 22:07:46', 'Editar temas', 'Código editado: <br>  <br> Valores nuevos -> Nombre del tema: , Estado: Activo, , Curso: htt3', 4),
	(20, '2015-08-15 22:19:38', 'Editar temas', 'Código editado:2 <br> Valores anteriores ->Código: 2, Nombre del tema: TEMA1, Estado: Activo, Curso: htt3 <br> Valores nuevos -> Nombre del tema: , Estado: Activo, , Curso: htt3', 4),
	(21, '2015-08-15 22:22:38', 'Editar temas', 'Código editado:2 <br> Valores anteriores ->Código: 2, Nombre del tema: TEMA1, Estado: Activo, Curso: htt3 <br> Valores nuevos -> Nombre del tema: , Estado: Activo, , Curso: htt3', 4),
	(22, '2015-08-15 22:23:58', 'Editar temas', 'Código editado:2 <br> Valores anteriores ->Código: 2, Nombre del tema: TEMA2, Estado: Activo, Curso: htt3 <br> Valores nuevos -> Nombre del tema: TEMA3, Estado: Activo, Curso: htt3', 4),
	(23, '2015-08-15 22:25:29', 'Crear Temas', 'Nombre: tema4, Estado: 2, Curso: htt3', 4),
	(24, '2015-08-15 22:25:50', 'Editar temas', 'Código editado:3 <br> Valores anteriores ->Nombre del tema: tema4, Estado: Inactivo, Curso: htt3 <br> Valores nuevos -> Nombre del tema: tema5, Estado: Activo, Curso: htt3', 4),
	(25, '2015-08-15 22:28:29', 'Editar temas', 'Código editado:2 <br> Valores anteriores ->Nombre del tema: TEMA3, Estado: Activo, Curso: htt3 <br> Valores nuevos -> Nombre del tema: TEMA3, Estado: Inactivo, Curso: htt3', 4),
	(26, '2015-08-16 11:02:46', 'Crear Temas', 'Nombre: tema5, Estado: 1, Curso: ggb', 4),
	(27, '2015-08-16 11:03:08', 'Crear Temas', 'Nombre: tema6, Estado: 1, Curso: ggb', 4),
	(28, '2015-08-16 11:03:31', 'Editar temas', 'Código editado:4 <br> Valores anteriores ->Nombre del tema: tema5, Estado: Activo, Curso: ggb <br> Valores nuevos -> Nombre del tema: tema55, Estado: Activo, Curso: ggb', 4),
	(29, '2015-08-16 11:04:03', 'Eliminar temas', '', 4),
	(30, '2015-08-16 11:11:24', 'Eliminar temas', '', 4),
	(31, '2015-08-16 11:12:55', 'Eliminar temas', '', 4),
	(32, '2015-08-16 11:13:27', 'Eliminar temas', 'Se ha eliminado el tema con los siguientes valores:\r\n							</br>Código: , Nombre del tema: tema55, Estado: Activo, Curso: ggb', 4),
	(33, '2015-08-16 11:14:17', 'Eliminar cursos', 'Se ha eliminado el curso con los siguientes valores:\r\n							</br>Código: 31, Nombre del curso: d, Estado: Activo', 4),
	(34, '2015-08-16 11:14:40', 'Editar cursos', 'Código editado:30 <br> Valores anteriores ->Código: 30, Nombre del curso: d, Estado: Activo <br> Valores nuevos -> Nombre del curso: , Estado: Inactivo', 4),
	(35, '2015-08-16 11:14:49', 'Eliminar cursos', 'Se ha eliminado el curso con los siguientes valores:\r\n							</br>Código: 30, Nombre del curso: d, Estado: Inactivo', 4);
/*!40000 ALTER TABLE `audit` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `pk_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.cursos: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`pk_curso`, `nombre`, `status`) VALUES
	(1, 'curso2', 1),
	(5, 'ggyyt', 1),
	(6, 'ldkgkg', 1),
	(7, 'ffgg', 1),
	(8, 'gghh', 1),
	(9, 'bbvv', 1),
	(10, 'nnmm', 1),
	(12, 'ddf', 1),
	(13, 'sdfdgf', 1),
	(14, 'dfg', 1),
	(15, 'dfg', 1),
	(16, 'dfg', 1),
	(17, 'prueba555', 1),
	(18, 'w', 1),
	(19, 'gg', 2),
	(20, 'hhggi', 1),
	(21, 'rr', 1),
	(22, 'pr1', 1),
	(23, 'pr1', 1),
	(24, 'pr1', 1),
	(25, 'pr1', 1),
	(26, 't', 1),
	(27, 'c', 1),
	(28, 'v', 1),
	(29, 'v', 1),
	(32, 'ggb', 1),
	(33, 'ggb', 1),
	(35, 'htt3', 1);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.cursos_usuarios
CREATE TABLE IF NOT EXISTS `cursos_usuarios` (
  `fk_curso` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_admin` int(11) NOT NULL,
  `fecha_asignacion` timestamp NULL DEFAULT NULL,
  `directorio` varchar(80) COLLATE utf8_bin NOT NULL,
  `fecha_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fk_curso`,`fk_usuario`),
  KEY `FK_usuarios` (`fk_usuario`),
  KEY `FK_admin` (`fk_admin`),
  CONSTRAINT `FK_admin` FOREIGN KEY (`fk_admin`) REFERENCES `usuarios` (`pk_usuario`),
  CONSTRAINT `FK_cursos` FOREIGN KEY (`fk_curso`) REFERENCES `cursos` (`pk_curso`),
  CONSTRAINT `FK_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.cursos_usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.ficheros
CREATE TABLE IF NOT EXISTS `ficheros` (
  `pk_fichero` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(11) NOT NULL,
  `fk_tema` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_bin NOT NULL,
  `directorio` varchar(80) COLLATE utf8_bin NOT NULL,
  `fecha_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_fichero`),
  KEY `FK_ficheros_usuarios` (`fk_usuario`),
  KEY `FK_ficheros_temas` (`fk_tema`),
  CONSTRAINT `FK_ficheros_temas` FOREIGN KEY (`fk_tema`) REFERENCES `temas` (`pk_tema`),
  CONSTRAINT `FK_ficheros_usuarios` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`pk_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.ficheros: ~0 rows (aproximadamente)
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
	(1, 'cambio1', 1),
	(2, 'prueba2', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.temas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
INSERT INTO `temas` (`pk_tema`, `fk_curso`, `nombre`, `status`) VALUES
	(1, 1, 'tema1', 1),
	(2, 35, 'TEMA3', 2),
	(3, 35, 'tema5', 1),
	(5, 32, 'tema6', 1);
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;


-- Volcando estructura para tabla cursos.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `pk_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `fk_perfil` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_bin NOT NULL,
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pk_usuario`),
  KEY `fk_perfil` (`fk_perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`fk_perfil`) REFERENCES `perfiles` (`pk_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla cursos.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`pk_usuario`, `fk_perfil`, `nombre`, `usuario`, `password`, `email`, `status`) VALUES
	(1, 2, 'prueba', 'prueba2', 'c72d8d3aaac76423d12dcf28962b6269', NULL, 1),
	(2, 1, 'prueba22', '', '', NULL, 1),
	(3, 1, 'prueba33', '', '', NULL, 1),
	(4, 1, 'prueba', 'prueba1', 'c72d8d3aaac76423d12dcf28962b6269', 'isaionline@gmail.com', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
