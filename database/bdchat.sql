-- SQLBook: Code
-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdmijostore
CREATE DATABASE IF NOT EXISTS `bdmijostore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdmijostore`;

-- Volcando estructura para tabla bdmijostore.caracteristica
CREATE TABLE IF NOT EXISTS `caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `sistema_operativo` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `camara_posterior` varchar(100) DEFAULT NULL,
  `camara_frontal` varchar(50) DEFAULT NULL,
  `bateria` varchar(100) DEFAULT NULL,
  `almacenamiento` varchar(100) DEFAULT NULL,
  `pantalla` varchar(100) DEFAULT NULL,
  `procesador` varchar(100) DEFAULT NULL,
  `carga_rapida` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_caracteristica_producto` (`producto_id`),
  CONSTRAINT `fk_caracteristica_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdmijostore.caracteristica: ~24 rows (aproximadamente)
INSERT INTO `caracteristica` (`id`, `producto_id`, `sistema_operativo`, `ram`, `camara_posterior`, `camara_frontal`, `bateria`, `almacenamiento`, `pantalla`, `procesador`, `carga_rapida`) VALUES
	(1, 1, 'Android 13', '8GB', '48 MP', '16 MP', '5000 mAh', '128GB', '6.67 pulgadas Full HD+', 'Qualcomm Snapdragon 695', 'Sí'),
	(2, 2, 'Android 12', '4GB', '50 MP', '5 MP', '5000 mAh', '64GB', '6.71 pulgadas HD+', 'MediaTek Helio G85', 'No'),
	(3, 3, 'Android 13', '6GB', '50 MP', '8 MP', '5000 mAh', '128GB', '6.6 pulgadas Full HD+', 'MediaTek Dimensity 700', 'Sí'),
	(4, 4, 'Android 12', '3GB', '13 MP', '5 MP', '4000 mAh', '32GB', '6.5 pulgadas HD+', 'Unisoc SC9863A', 'No'),
	(5, 5, 'Android 13', '6GB', '48 MP', '16 MP', '5000 mAh', '128GB', '6.43 pulgadas Full HD+', 'Qualcomm Snapdragon 680', 'Sí'),
	(6, 6, 'Android 13', '8GB', '108 MP', '32 MP', '5000 mAh', '256GB', '6.67 pulgadas Full HD+', 'Qualcomm Snapdragon 778G', 'Sí'),
	(7, 7, 'Android 13', '6GB', '50 MP', '13 MP', '5000 mAh', '128GB', '6.5 pulgadas Full HD+', 'Exynos 1280', 'Sí'),
	(8, 8, 'Android 13', '8GB', '50 MP', '32 MP', '5000 mAh', '128GB', '6.4 pulgadas Full HD+', 'Exynos 1380', 'Sí'),
	(9, 9, 'Android 13', '12GB', '200 MP', '12 MP', '5000 mAh', '256GB', '6.8 pulgadas QHD+', 'Qualcomm Snapdragon 8 Gen 2', 'Sí'),
	(10, 10, 'Android 13', '4GB', '50 MP', '13 MP', '5000 mAh', '64GB', '6.6 pulgadas Full HD+', 'Exynos 850', 'No'),
	(11, 11, 'Android 13', '8GB', '50 MP', '12 MP', '3900 mAh', '128GB', '6.1 pulgadas Full HD+', 'Qualcomm Snapdragon 8 Gen 2', 'Sí'),
	(12, 12, 'Android 13', '6GB', '48 MP', '16 MP', '5000 mAh', '128GB', '6.7 pulgadas Full HD+', 'Qualcomm Snapdragon 695', 'Sí'),
	(13, 13, 'Android 12', '3GB', '13 MP', '5 MP', '4000 mAh', '32GB', '6.1 pulgadas HD+', 'Unisoc SC9863A', 'No'),
	(14, 14, 'Android 13', '6GB', '50 MP', '8 MP', '5000 mAh', '128GB', '6.6 pulgadas Full HD+', 'MediaTek Dimensity 700', 'Sí'),
	(15, 15, 'Android 12', '3GB', '13 MP', '5 MP', '4000 mAh', '32GB', '6.1 pulgadas HD+', 'Unisoc SC9863A', 'No'),
	(16, 16, 'Android 12', '4GB', '13 MP', '8 MP', '4000 mAh', '64GB', '6.5 pulgadas HD+', 'MediaTek Helio G25', 'No'),
	(17, 17, 'Android 12', '3GB', '13 MP', '5 MP', '5000 mAh', '32GB', '6.5 pulgadas HD+', 'Unisoc SC9863A', 'No'),
	(18, 18, 'Android 12', '4GB', '50 MP', '8 MP', '5000 mAh', '64GB', '6.5 pulgadas Full HD+', 'MediaTek Helio G85', 'No'),
	(19, 19, 'Android 13', '4GB', '50 MP', '13 MP', '5000 mAh', '64GB', '6.5 pulgadas Full HD+', 'MediaTek Dimensity 700', 'Sí'),
	(20, 20, 'Android 13', '6GB', '50 MP', '8 MP', '6000 mAh', '128GB', '6.7 pulgadas Full HD+', 'Qualcomm Snapdragon 695', 'Sí'),
	(21, 21, 'Android 13', '6GB', '50 MP', '16 MP', '5000 mAh', '128GB', '6.5 pulgadas Full HD+', 'Qualcomm Snapdragon 480', 'Sí'),
	(22, 22, 'Android 13', '8GB', '108 MP', '32 MP', '5000 mAh', '256GB', '6.7 pulgadas Full HD+', 'Qualcomm Snapdragon 778G', 'Sí'),
	(23, 23, 'Android 13', '6GB', '64 MP', '16 MP', '5000 mAh', '128GB', '6.6 pulgadas Full HD+', 'MediaTek Dimensity 1080', 'Sí'),
	(24, 24, 'Android 13', '8GB', '64 MP', '16 MP', '5000 mAh', '128GB', '6.7 pulgadas Full HD+', 'MediaTek Dimensity 700', 'Sí');

-- Volcando estructura para tabla bdmijostore.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdmijostore.categoria: ~4 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `nombre`) VALUES
	(1, 'Xiaomi'),
	(2, 'Samsung'),
	(3, 'Honor'),
	(4, 'Motorola');


-- Volcando estructura para tabla bdmijostore.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `descuento` DECIMAL(5, 2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdmijostore.producto: ~24 rows (aproximadamente)
INSERT INTO `producto` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `descuento`, `fecha`, `imagen`, `color`) VALUES
	(1, 1, '14T', 'Smartphone con buen rendimiento y precio competitivo, adecuado para usuarios exigentes.', 299.99, 50, NULL, '2024-11-26', '14T.png', 'gris'),
	(2, 1, 'Redmi 13C', 'Dispositivo básico pero eficiente, ideal para principiantes o usuarios ocasionales.', 199.99, 70, NULL, '2024-11-26', 'Redmi 13C.png', 'azul'),
	(3, 1, 'Redmi 14C', 'Mejoras en rendimiento y cámara, diseñado para tareas cotidianas y fotografía casual.', 249.99, 60, NULL, '2024-11-26', 'Redmi 14C.png', 'negro'),
	(4, 1, 'Redmi A3', 'Teléfono asequible y eficiente, perfecto para quienes buscan calidad a bajo costo.', 149.99, 76, NULL, '2024-11-26', 'Redmi A3.png', 'verde'),
	(5, 1, 'Redmi Note 13', 'Smartphone funcional con diseño atractivo y rendimiento equilibrado para aplicaciones y juegos.', 349.99, 40, NULL, '2024-11-26', 'Redmi Note 13.png', 'azul'),
	(6, 1, 'Redmi Note 13 Pro Plus', 'Modelo de alta gama con excelente rendimiento, ideal para gaming y multitarea avanzada.', 449.99, 30, NULL, '2024-11-26', 'Redmi Note 13 Pro Plus.png', 'blanco'),
	(7, 2, 'A35 Samsung', 'Smartphone versátil con buen rendimiento y batería confiable, perfecto para usuarios promedio.', 299.99, 50, NULL, '2024-11-26', 'A35 Samsung.png', 'lila'),
	(8, 2, 'A54 Samsung', 'Dispositivo con cámara mejorada y mayor capacidad de almacenamiento, ideal para fotografía y videos.', 399.99, 16, NULL, '2024-11-26', 'A54 Samsung.png', 'negro'),
	(9, 2, 'S23 Ultra', 'Teléfono de alta gama con diseño premium, excelente cámara y rendimiento excepcional.', 999.99, 20, NULL, '2024-11-26', 'S23 Ultra.png', 'verde'),
	(10, 2, 'Samsung A14', 'Modelo básico pero funcional, perfecto para quienes necesitan un dispositivo asequible.', 199.99, 80, NULL, '2024-11-26', 'Samsung A14.png', 'negro'),
	(11, 2, 'Samsung S23', 'Compacto y poderoso, con características avanzadas y diseño moderno.', 899.99, 25, NULL, '2024-11-26', 'Samsung S23.png', 'negro'),
	(12, 3, '90 Lite', 'Smartphone moderno con diseño delgado, excelente cámara y rendimiento eficiente para uso diario.', 299.99, 50, NULL, '2024-11-26', '90 Lite.png', 'plata'),
	(13, 3, 'H200', 'Teléfono confiable con características básicas, ideal para quienes buscan funcionalidad sin complicaciones.', 199.99, 70, NULL, '2024-11-26', 'H200.png', 'aquamarino'),
	(14, 3, 'Magic 6 Lite', 'Dispositivo equilibrado, con batería duradera y buen rendimiento para aplicaciones y entretenimiento.', 349.99, 40, NULL, '2024-11-26', 'Magic 6 Lite.png', 'plata'),
	(15, 3, 'X7B', 'Modelo económico con funciones esenciales, adecuado para llamadas y redes sociales.', 149.99, 79, NULL, '2024-11-26', 'X7B.png', 'plata'),
	(16, 3, 'X8B', 'Compacto y funcional, perfecto para quienes buscan un dispositivo práctico a un precio accesible.', 249.99, 60, NULL, '2024-11-26', 'X8B.png', 'plata'),
	(17, 4, 'Moto G04', 'Teléfono de gama básica, ideal para usuarios que necesitan un dispositivo sencillo y funcional.', 199.99, 70, NULL, '2024-11-26', 'Moto G04.png', 'naranja'),
	(18, 4, 'Moto G04S', 'Versión mejorada con mejor cámara y almacenamiento, perfecto para tareas cotidianas.', 249.99, 60, NULL, '2024-11-26', 'Moto G04S.png', 'negro'),
	(19, 4, 'Moto G14', 'Dispositivo práctico y duradero, con diseño resistente y funcionalidad versátil.', 299.99, 50, NULL, '2024-11-26', 'Moto G14.png', 'lila'),
	(20, 4, 'Moto G24 Power', 'Destaca por su gran batería, ideal para usuarios que requieren larga duración en su día a día.', 349.99, 40, NULL, '2024-11-26', 'Moto G24 Power.png', 'celeste'),
	(21, 4, 'Moto G53', 'Smartphone rápido con pantalla fluida, adecuado para quienes buscan calidad sin exceder su presupuesto.', 399.99, 30, NULL, '2024-11-26', 'Moto G53.png', 'azul'),
	(22, 4, 'Moto G84', 'Dispositivo de gama media-alta, ideal para multitarea y rendimiento destacado en aplicaciones.', 499.99, 25, NULL, '2024-11-26', 'Moto G84.png', 'morado'),
	(23, 4, 'Moto G54', 'Teléfono con buena relación calidad-precio, ofreciendo buen desempeño y diseño atractivo.', 449.99, 30, NULL, '2024-11-26', 'Moto G54.png', 'negro'),
	(24, 4, 'Moto G85', 'Modelo potente y versátil, ideal para quienes buscan un teléfono con características avanzadas.', 599.99, 20, NULL, '2024-11-26', 'Moto G85.png', 'azul');

-- Volcando estructura para tabla bdmijostore.promocion
CREATE TABLE IF NOT EXISTS `promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descuento_porcentaje` decimal(5,2) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `tipo_promocion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promocion_producto` (`producto_id`),
  KEY `fk_promocion_tipo_promocion` (`tipo_promocion_id`),
  CONSTRAINT `fk_promocion_producto` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  CONSTRAINT `fk_promocion_tipo_promocion` FOREIGN KEY (`tipo_promocion_id`) REFERENCES `tipo_promocion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdmijostore.promocion: ~5 rows (aproximadamente)
INSERT INTO `promocion` (`id`, `producto_id`, `fecha_inicio`, `fecha_fin`, `descuento_porcentaje`, `activo`, `tipo_promocion_id`) VALUES
	(1, 15, '2024-11-01', '2024-11-30', 15.00, 1, 1),
	(2, 14, '2024-11-05', '2024-11-15', 20.00, 1, 2),
	(3, 13, '2024-11-10', '2024-11-25', 10.00, 1, 3),
	(4, 12, '2024-11-01', '2024-11-15', 5.00, 1, 4),
	(5, 11, '2024-11-15', '2024-11-30', 25.00, 1, 5);

-- Volcando estructura para tabla bdmijostore.tipo_promocion
CREATE TABLE IF NOT EXISTS `tipo_promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla bdmijostore.tipo_promocion: ~6 rows (aproximadamente)
INSERT INTO `tipo_promocion` (`id`, `nombre`) VALUES
	(1, 'Descuentos por Fiestas Patrias'),
	(2, 'Black Friday'),
	(3, 'Cyber Monday'),
	(4, 'Back to School'),
	(5, 'Promociones de Día del Trabajador'),
	(6, 'Promoción de Fin de Año');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
