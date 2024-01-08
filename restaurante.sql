-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2024 a las 09:39:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `nombre_categoria`, `imagen`) VALUES
(1, 'Entrantes', 'assets/images/carta/categorias/entrantes.jpg'),
(2, 'Ensaladas', 'assets/images/carta/categorias/ensalada2.jpg'),
(3, 'Arroces', 'assets/images/carta/categorias/arroces.jpg'),
(4, 'Brasa', 'assets/images/carta/categorias/brasa.jpg'),
(5, 'Carnes', 'assets/images/carta/categorias/carne.webp'),
(6, 'Pescados', 'assets/images/carta/categorias/pescado.jpg'),
(7, 'Bebidas', 'assets/images/carta/categorias/bebidas.webp'),
(8, 'Postres', 'assets/images/carta/categorias/postres.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `detalle_pedido_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_producto` int(3) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`detalle_pedido_id`, `pedido_id`, `producto_id`, `cantidad_producto`, `subtotal`) VALUES
(16, 11, 18, 2, 21.50),
(19, 12, 10, 3, 24.30),
(21, 12, 25, 2, 25.60),
(23, 13, 5, 1, 12.50),
(24, 14, 6, 1, 13.75),
(25, 14, 14, 1, 10.75),
(26, 15, 3, 1, 7.99),
(27, 15, 7, 3, 21.87),
(30, 20, 5, 1, 12.50),
(31, 21, 5, 1, 12.50),
(32, 21, 3, 1, 7.50),
(33, 22, 5, 1, 12.50),
(34, 22, 3, 1, 7.50),
(35, 22, 18, 1, 10.75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `coste_total` decimal(10,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `usuario_id`, `fecha`, `coste_total`, `estado`) VALUES
(11, 12, '2023-12-15 16:47:52', 21.50, 'En preparación'),
(12, 12, '2023-12-15 17:06:17', 49.90, 'Entregado'),
(13, 12, '2024-01-03 19:34:15', 15.50, 'En preparación'),
(14, 12, '2024-01-03 19:39:08', 24.50, 'En preparación'),
(15, 12, '2024-01-04 18:05:37', 29.86, 'En preparación'),
(20, 12, '2024-01-06 20:12:34', 15.50, 'En preparación'),
(21, 12, '2024-01-07 17:49:41', 23.00, 'En preparación'),
(22, 12, '2024-01-07 17:58:18', 33.75, 'En preparación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `coste_base` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descuento` decimal(4,2) NOT NULL,
  `envio_gratis` tinyint(1) NOT NULL,
  `opiniones` int(4) DEFAULT NULL,
  `estrellas` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `categoria_id`, `nombre_producto`, `descripcion`, `coste_base`, `imagen`, `descuento`, `envio_gratis`, `opiniones`, `estrellas`) VALUES
(3, 1, 'Espaguetis con tomate', 'Espaguetis con salsa de tomate.', 7.50, 'assets/images/carta/espaguetis.png', 0.00, 1, 8, 4),
(4, 1, 'Calamares rebozados', 'Calamares a la romana acompañados de salsa de ajo.', 13.50, 'assets/images/carta/calamares.png', 0.00, 1, 4, 4),
(5, 1, 'Tostadas con salmón', 'Tostadas integrales con salmón, aguacate y rúcula.', 12.50, 'assets/images/carta/tostadas_salmon.png', 0.00, 0, 12, 4),
(6, 1, 'Jamón ibérico', 'Plato de jamón ibérico de 5 bellotas.', 13.75, 'assets/images/carta/jamon.png', 0.00, 1, 6, 4),
(7, 2, 'Ensalada vegetal', 'Ensalada de brotes tiernes, tomate, cebolla y apio.', 8.10, 'assets/images/carta/ensalada_vegetal.png', 0.90, 1, 9, 3),
(8, 2, 'Ensalada César', 'Ensalada César con pollo y nuestra rica salsa.', 9.90, 'assets/images/carta/ensalada_cesar.png', 0.90, 0, 4, 4),
(9, 2, 'Ensalada de pasta y atún', 'Ensalada fresca de pasta y atún con tomates cherry.', 9.05, 'assets/images/carta/ensalada_pasta.png', 0.90, 1, 12, 4),
(10, 2, 'Ensalada de patata', 'Ensalada de patata con mayonesa y taquitos de bacon.', 9.00, 'assets/images/carta/ensalada_patata.png', 0.90, 1, 3, 4),
(11, 3, 'Paella', 'Paella de marisco con limones para poner al gusto.', 13.00, 'assets/images/carta/paella.png', 0.00, 1, 8, 4),
(12, 3, 'Arroz negro', 'Arroz negro con sepia y calamares.', 12.00, 'assets/images/carta/arroz_negro.png', 0.00, 0, 11, 4),
(13, 3, 'Risotto de setas', 'Risotto de setas con champiñones a la plancha.', 10.75, 'assets/images/carta/risotto.png', 0.00, 0, 5, 4),
(14, 3, 'Arroz a la cubana', 'Arroz con tomate, un huevo frito y un plátano frito.', 10.75, 'assets/images/carta/arroz_cubana.png', 0.00, 1, 9, 4),
(15, 4, 'Entrecot a la brasa', 'Entrecot a la brasa acompañado de champiñones salteados y espárragos a la brasa.', 18.50, 'assets/images/carta/entrecot_brasa.png', 0.00, 1, 13, 4),
(16, 4, 'Butifarras a la brasa', 'Butifarras de Olot cocinadas a la brasa.', 11.50, 'assets/images/carta/butifarra_brasa.png', 0.00, 1, 4, 4),
(17, 4, 'Pollo a la brasa', 'Medio pollo a la brasa.', 10.75, 'assets/images/carta/pollo_brasa.png', 0.00, 1, 7, 4),
(18, 4, 'Dorada a la brasa', 'Dorada fresca a la brasa.', 10.75, 'assets/images/carta/dorada_brasa.png', 0.00, 1, 10, 4),
(19, 5, 'Cerdo frito y verduras', 'Cerdo frito acompañado de patatas al horno y ensalada con tomate.', 11.30, 'assets/images/carta/cerdo_frito.png', 0.00, 0, 14, 4),
(20, 5, 'Estofado de ternera', 'Estofado de ternera cómo lo hacía tu abuela, bien rico y tierno.', 10.75, 'assets/images/carta/estofado.png', 0.00, 1, 8, 4),
(21, 5, 'Milanesa con patatas', 'Milanesa de ternera acompañada de patatas fritas, ensalada y limón para echar a gusto.', 10.75, 'assets/images/carta/milanesa.png', 0.00, 1, 4, 4),
(22, 5, 'Pollo al ajillo con patatas', 'Pollo con salsa al ajillo y patatas fritas.', 10.75, 'assets/images/carta/pollo_ajillo.png', 0.00, 1, 7, 4),
(23, 6, 'Fish and chips', 'Merluza rebozada acompañada de patatas fritas y salsa de guacamole.', 10.50, 'assets/images/carta/fish_chips.png', 0.00, 0, 9, 3),
(24, 6, 'Bacalao al pil pil', 'Bacalao al horno con salsa pil pil en bandeja de barro.', 13.50, 'assets/images/carta/bacalao_pil_pil.png', 0.00, 1, 2, 4),
(25, 6, 'Sepia a la plancha', '', 12.80, 'assets/images/carta/sepia_plancha.png', 0.00, 1, 7, 4),
(26, 6, 'Salmón al horno', 'Salmón al horno acompañado de cuscús y limón.', 15.75, 'assets/images/carta/salmon.png', 0.00, 1, 11, 4),
(27, 7, 'Agua Font Vella 1.5L', 'Botella de agua Font Vella de 1,5 litros.', 2.50, 'assets/images/carta/agua.png', 0.00, 1, 2, 4),
(28, 7, 'Estrella-Damm 0.33cl', 'Lata de Estrella-Damm de 0,33cl.', 2.50, 'assets/images/carta/estrella.png', 0.00, 1, 2, 4),
(29, 7, 'Coca-Cola 0.33cl', 'Lata de Coca-Cola de 0,33cl.', 2.50, 'assets/images/carta/coca_cola.png', 0.00, 1, 3, 4),
(30, 7, 'Dehesa de Luna', '', 9.00, 'assets/images/carta/vino.png', 0.00, 1, 5, 4),
(31, 8, 'Crema catalana', 'Tarrina de crema catalana con azúcar quemado por encima.', 5.75, 'assets/images/carta/crema_catalana.png', 0.00, 1, 9, 4),
(32, 8, 'Yogurt con frutos rojos', 'Yogurt natural con frutos rojos y nueces.', 4.50, 'assets/images/carta/yogurt.png', 0.00, 1, 12, 4),
(33, 8, 'Tiramisú', 'Tiramisú con cacao espolvoreado.', 6.00, 'assets/images/carta/tiramisu.png', 0.00, 1, 4, 4),
(34, 8, 'Arroz con leche', 'Arroz con leche con canela.', 5.00, 'assets/images/carta/arroz_leche.png', 0.00, 1, 11, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `puntos_fidelidad` int(11) DEFAULT NULL,
  `area_responsable` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `rol_id`, `nombre`, `apellidos`, `direccion`, `email`, `telefono`, `password`, `puntos_fidelidad`, `area_responsable`) VALUES
(12, 2, 'Pedro', 'Martínez ', 'Calle random, 3', '1@1.com', 650333123, '$2y$10$liw75m3rzLGigFWPfDAjO.7VfsdMmEA.Y9upAtkgd2GdpX9B3Hyee', 20, NULL),
(14, 1, 'Rubén', 'Jordán García', 'Pepepepe', 'admin@admin.com', 123456789, '$2y$10$Q74lHMIGxpyCix/0w04/u.BH/HGG7DrzMk1hu5UXxoVVGp/DXzcue', NULL, 'Administración');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`detalle_pedido_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `detalle_pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
