-- Adminer 4.8.3 MySQL 8.0.16 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `partidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_equipo` varchar(20) DEFAULT NULL,
  `modo_juego` varchar(20) DEFAULT NULL,
  `lugar_caida` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jugador1_id` int(11) DEFAULT NULL,
  `jugador2_id` int(11) DEFAULT NULL,
  `jugador3_id` int(11) DEFAULT NULL,
  `jugador4_id` int(11) DEFAULT NULL,
  `muertes_jugador1` int(11) DEFAULT NULL,
  `muertes_jugador2` int(11) DEFAULT NULL,
  `muertes_jugador3` int(11) DEFAULT NULL,
  `muertes_jugador4` int(11) DEFAULT NULL,
  `posicion_final` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jugador1_id` (`jugador1_id`),
  KEY `jugador2_id` (`jugador2_id`),
  KEY `jugador3_id` (`jugador3_id`),
  KEY `jugador4_id` (`jugador4_id`),
  CONSTRAINT `partidas_ibfk_1` FOREIGN KEY (`jugador1_id`) REFERENCES `jugadores` (`id`),
  CONSTRAINT `partidas_ibfk_2` FOREIGN KEY (`jugador2_id`) REFERENCES `jugadores` (`id`),
  CONSTRAINT `partidas_ibfk_3` FOREIGN KEY (`jugador3_id`) REFERENCES `jugadores` (`id`),
  CONSTRAINT `partidas_ibfk_4` FOREIGN KEY (`jugador4_id`) REFERENCES `jugadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2024-03-27 15:36:08
