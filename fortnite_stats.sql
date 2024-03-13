-- Adminer 4.8.3 MySQL 8.0.16 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `estadisticas`;
CREATE TABLE `estadisticas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `muertes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_partida` (`id_partida`),
  KEY `id_jugador` (`id_jugador`),
  CONSTRAINT `estadisticas_ibfk_2` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id`),
  CONSTRAINT `estadisticas_ibfk_3` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `jugadores`;
CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `partidas`;
CREATE TABLE `partidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `tipo_equipo` varchar(255) NOT NULL,
  `modo_juego` varchar(255) NOT NULL,
  `lugar_caida` varchar(255) NOT NULL,
  `posicion_final` int(11) NOT NULL,
  `numero_partida` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_numero_partida` (`numero_partida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2024-03-12 16:38:50
