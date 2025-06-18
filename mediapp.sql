-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 18-06-2025 a las 03:30:05
-- Versión del servidor: 11.5.2-MariaDB
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mediapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargos` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cargo` longtext DEFAULT NULL,
  `est_cargo` int(11) DEFAULT NULL,
  `opc_catalogo` int(11) DEFAULT NULL,
  `opc_usuarios` int(11) DEFAULT NULL,
  `opc_proveedores` int(11) DEFAULT NULL,
  `opc_ventas` int(11) DEFAULT NULL,
  `opc_compras` int(11) DEFAULT NULL,
  `opc_productos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cargos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargos`, `nom_cargo`, `est_cargo`, `opc_catalogo`, `opc_usuarios`, `opc_proveedores`, `opc_ventas`, `opc_compras`, `opc_productos`) VALUES
(1, 'Administrador', 1, 1, 1, 1, 1, 1, 1),
(2, 'Vendedor', 1, 1, 0, 0, 1, 1, 0),
(3, 'Almacenero', 1, 0, 0, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cliente` longtext DEFAULT NULL,
  `apePa_cliente` longtext DEFAULT NULL,
  `apeMa_cliente` longtext DEFAULT NULL,
  `correo_cliente` longtext DEFAULT NULL,
  `user_cliente` longtext DEFAULT NULL,
  `pass_cliente` longtext DEFAULT NULL,
  `est_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nom_cliente`, `apePa_cliente`, `apeMa_cliente`, `correo_cliente`, `user_cliente`, `pass_cliente`, `est_cliente`) VALUES
(1, 'Personal', '...', '...', '...', 'personal', 'personal123', 1),
(2, 'Carlos', 'Pérez', 'Ramírez', 'carlos.perez@gmail.com', 'carlos_pr', 'C@rl0sP3', 1),
(3, 'Luisa', 'Sánchez', 'Mendoza', 'luisa.sanchez@gmail.com', 'luisa_sm', 'Lui$4_2024', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` float(10,2) DEFAULT NULL,
  `subtotal` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`,`id_producto`,`id_venta`),
  KEY `fk_detalle_venta_ventas1_idx` (`id_venta`),
  KEY `fk_detalle_venta_productos1_idx` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_producto`, `id_venta`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 1, 1, 8.00, 8.00),
(2, 5, 1, 1, 10.50, 10.50),
(3, 2, 2, 1, 10.50, 10.50),
(5, 4, 3, 3, 4.00, 12.00),
(6, 3, 4, 1, 25.00, 25.00),
(10, 1, 6, 2, 8.00, 16.00),
(11, 2, 6, 1, 10.50, 10.50),
(12, 6, 6, 1, 18.50, 18.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos_almacen`
--

DROP TABLE IF EXISTS `movimientos_almacen`;
CREATE TABLE IF NOT EXISTS `movimientos_almacen` (
  `id_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `cant_ingreso` int(11) DEFAULT NULL,
  `pre_uni_ingreso` float(10,2) DEFAULT NULL,
  `fech_ingreso` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ingreso`,`id_producto`,`id_proveedor`),
  KEY `fk_movimientos_almacen_productos1_idx` (`id_producto`,`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `movimientos_almacen`
--

INSERT INTO `movimientos_almacen` (`id_ingreso`, `id_producto`, `id_proveedor`, `cant_ingreso`, `pre_uni_ingreso`, `fech_ingreso`) VALUES
(1, 1, 1, 100, 3.20, '2024-05-28 08:00:00'),
(2, 2, 1, 80, 4.50, '2024-05-28 08:00:00'),
(3, 3, 1, 50, 15.00, '2024-05-28 08:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `nom_producto` longtext DEFAULT NULL,
  `desc_producto` longtext DEFAULT NULL,
  `precio_venta` float(10,2) DEFAULT NULL,
  `precio_compra` float(10,2) DEFAULT NULL,
  `stock` longtext DEFAULT NULL,
  `est_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`,`id_proveedor`),
  KEY `fk_productos_proveedores1_idx` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_proveedor`, `nom_producto`, `desc_producto`, `precio_venta`, `precio_compra`, `stock`, `est_producto`) VALUES
(1, 1, 'Paracetamol 500mg', 'Tabletas x 10 unidades', 8.00, 5.00, '150', 1),
(2, 1, 'Ibuprofeno 400mg', 'Tabletas x 12 unidades', 10.50, 7.00, '100', 1),
(3, 1, 'Amoxicilina 250mg', 'Cápsulas x 15 unidades', 25.00, 18.00, '80', 1),
(4, 2, 'Jabón Antibacterial', 'Barra 90g', 3.50, 2.00, '200', 1),
(5, 2, 'Alcohol en Gel', 'Botella 250ml', 12.00, 8.00, '118', 1),
(6, 2, 'Protector Solar SPF50', 'Tubo 60ml', 35.00, 25.00, '60', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nom_proveedor` longtext DEFAULT NULL,
  `dir_proveedor` longtext DEFAULT NULL,
  `cel_proveedor` longtext DEFAULT NULL,
  `email_proveedor` longtext DEFAULT NULL,
  `est_proveedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nom_proveedor`, `dir_proveedor`, `cel_proveedor`, `email_proveedor`, `est_proveedor`) VALUES
(1, 'Farmacéutica Salud Plus', 'Av. Los Médicos 123, Lima', '987654321', 'contacto@saludplus.com', 1),
(2, 'Distribuidora Boticas Perú', 'Calle Farmacia 456, Arequipa', '912345678', 'ventas@boticasperu.com', 1),
(3, 'Laboratorio VitaFarma', 'Jr. Medicinas 789, Trujillo', '934567890', 'info@vitafarma.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargos` int(11) NOT NULL,
  `user_usuario` longtext DEFAULT NULL,
  `pass_usuario` longtext DEFAULT NULL,
  `nom_usuario` longtext DEFAULT NULL,
  `apePa_usuario` longtext DEFAULT NULL,
  `apeMa_usuario` longtext DEFAULT NULL,
  `email_usuario` longtext DEFAULT NULL,
  `cel_usuario` longtext DEFAULT NULL,
  `edad_usuario` int(11) DEFAULT NULL,
  `fc_re_usuario` datetime DEFAULT NULL,
  `est_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuarios`,`id_cargos`),
  KEY `fk_usuarios_cargos_idx` (`id_cargos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `id_cargos`, `user_usuario`, `pass_usuario`, `nom_usuario`, `apePa_usuario`, `apeMa_usuario`, `email_usuario`, `cel_usuario`, `edad_usuario`, `fc_re_usuario`, `est_usuario`) VALUES
(1, 1, 'jeison', 'jeison123', 'Jeison', 'Gonzales', 'Mendoza', 'jeison@gmail.com', '902571030', 20, '2025-06-17 11:20:58', 1),
(2, 3, 'kevin', 'kevin123', 'Kevin', 'Lino', 'Jimenez', 'kevin@gmail.com', '943714354', 20, '2025-06-17 12:10:11', 1),
(5, 2, 'jperez', '123456', 'Juan', 'Perez', 'Gomez', 'juan@gmail.com', '999123456', 30, '2025-06-17 17:52:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `total_venta` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_venta`,`id_cliente`,`id_usuarios`),
  KEY `fk_ventas_usuarios1_idx` (`id_usuarios`),
  KEY `fk_ventas_cliente1_idx` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `id_usuarios`, `fecha_venta`, `total_venta`) VALUES
(1, 1, 2, '2024-06-01 09:15:00', 18.50),
(2, 1, 2, '2024-06-01 10:30:00', 32.00),
(3, 1, 2, '2024-06-01 12:45:00', 12.00),
(4, 1, 2, '2024-06-02 08:20:00', 25.50),
(5, 1, 2, '2024-06-02 11:10:00', 8.00),
(6, 2, 2, '2024-06-02 14:00:00', 45.00);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_productos1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalle_venta_ventas1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `movimientos_almacen`
--
ALTER TABLE `movimientos_almacen`
  ADD CONSTRAINT `fk_movimientos_almacen_productos1` FOREIGN KEY (`id_producto`,`id_proveedor`) REFERENCES `productos` (`id_producto`, `id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_proveedores1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_cargos` FOREIGN KEY (`id_cargos`) REFERENCES `cargos` (`id_cargos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuarios1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
