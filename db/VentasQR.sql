-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2026 a las 21:42:13
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
-- Base de datos: `eventu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `codigo` varchar(50) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `prod_cant` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `QR` varchar(100) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `cat_id`, `codigo`, `producto`, `precio`, `prod_cant`, `imagen`, `QR`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
(1, 1, '1', 'Laptop HP Victus 16-D0023', '4199', 336, 'victus.png', '1.jpg', '2023-10-17 10:25:06', '2024-06-19 22:38:52', NULL, 1),
(2, 1, '2', 'Impresora Multifuncional HP Color LaserJet Pro M283FDW', '2799', 158, 'Impresora.png', '3.jpg', '2023-10-17 10:32:48', '2024-06-15 23:06:54', NULL, 1),
(3, 3, '3', 'Router TP-Link TL-MR6400APAC', '329', 518, 'Router.png', '3.png', '2023-10-17 10:38:07', '2024-06-15 23:07:01', NULL, 1),
(4, 1, '4', 'Adaptador Teraware conector usb 3.0 a RJ45', '79', 408, 'Adaptador Teraware.png', '4.png', '2023-10-17 10:43:03', '2023-11-20 09:44:51', NULL, 1),
(5, 4, '5', 'Lentes de realidad 3d para smartphone', '475', 496, 'Lentes de realidad 3d para smartphone.png', '5.png', '2023-11-27 09:13:28', '2024-06-22 22:30:00', NULL, 1),
(6, 1, '6', 'Procesador Intel Core i7-12700KF 12th generation', '1046', 400, 'intel core 7ma.png', '6 qr.png', '2024-06-15 23:02:03', NULL, NULL, 1),
(7, 1, '7', 'MSI Tarjeta gráfica GeForce RTX 3060', '1592', 854, 'targeta grafica.png', '7 qr.png', '2024-06-15 23:06:20', NULL, NULL, 1),
(8, 2, '8', 'McAfee Protección antivirus', '56', 130, 'Antivirus McAfee.png', '8 qr.png', '2024-06-15 23:13:57', NULL, NULL, 1),
(9, 2, '9', 'Bitdefender Total Security 2024', '60', 321, 'Bitdefender.png', '9 qr.png', '2024-06-15 23:18:47', NULL, NULL, 1),
(10, 3, '10', 'Extensor/amplificador WiFi', '150', 231, 'Extensor-amplificador WiFi.png', '10 qr.png', '2024-06-15 23:27:29', NULL, NULL, 1),
(11, 3, '11', 'Antena Wi-Fi Externa Ajustable TP-Link Archer T3U', '76', 341, 'TP-Link Archer T3U Plus AC1300 .png', '11 qr.png', '2024-06-15 23:33:35', '2024-06-15 23:45:49', NULL, 1),
(12, 1, '12', 'Cámara Olympus E-330', '2303', 156, 'Olympus E-330.png', 'qrcamra.png', '2024-06-15 23:38:14', NULL, NULL, 1),
(13, 4, '13', 'VR Virtual Suite VR Guantes', '670', 432, 'VR Virtual Suite VR Guantes .png', '13 qr.png', '2024-06-15 23:45:23', '2024-06-22 22:36:04', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(50) NOT NULL,
  `cat_des` varchar(500) NOT NULL,
  `est` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `cat_des`, `est`) VALUES
(1, 'Hardware', 'Esta categoría se sumerge en los componentes físicos de la tecnología, desde procesadores y tarjetas gráficas hasta dispositivos de almacenamiento.', 1),
(2, 'Software', 'Programas informáticos y las aplicaciones que dan vida a nuestros dispositivos, desde sistemas operativos hasta aplicaciones especializadas.', 1),
(3, 'Redes y Comunicaciones', 'Engloba productos esenciales como enrutadores, switches, puntos de acceso, firewalls y dispositivos de almacenamiento en red.', 1),
(4, 'Realidad Virtual y Aumentada', 'Esta categoría incluye dispositivos y tecnologías diseñadas para crear experiencias inmersivas en entornos virtuales. Esto abarca desde auriculares y lentes VR hasta aplicaciones,etc.', 1),
(5, ' Electrónica de Consumo', 'Aquí nos enfocamos en los dispositivos electrónicos que forman parte integral de nuestra vida diaria, desde smartphones y dispositivos portátiles hasta dispositivos del hogar conectados, explorando cómo estos gadgets están redefiniendo nuestra forma de vivir, trabajar y jugar.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_compras`
--

CREATE TABLE `tm_compras` (
  `id` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `producto` varchar(1000) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio` int(100) NOT NULL,
  `Categoria` int(100) NOT NULL,
  `fecha` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_compras`
--

INSERT INTO `tm_compras` (`id`, `correo`, `producto`, `cantidad`, `precio`, `Categoria`, `fecha`) VALUES
('da3f61bc42c2a6c352c7795cf9722d', 'Ramosespinoza@gmail.com', 'Lentes de realidad 3d para smartphone', 1, 475, 4, '2024-06-20 06:20:24.000000'),
('da3f61bc42c2a6c352c7795cf9722d', 'Ramosespinoza@gmail.com', 'MSI Tarjeta gráfica GeForce RTX 3060', 1, 1592, 1, '2024-06-20 06:20:24.000000'),
('da3f61bc42c2a6c352c7795cf9722d', 'Ramosespinoza@gmail.com', 'VR Virtual Suite VR Guantes', 1, 670, 4, '2024-06-20 06:20:24.000000'),
('f34256f4123a4c3bf99b6d4f947687', 'Diegoarevalo@gmail.com', 'Adaptador Teraware conector usb 3.0 a RJ45', 1, 79, 1, '2024-06-20 06:22:36.000000'),
('f34256f4123a4c3bf99b6d4f947687', 'Diegoarevalo@gmail.com', 'MSI Tarjeta gráfica GeForce RTX 3060', 1, 1592, 1, '2024-06-20 06:22:36.000000'),
('f0a8b199f652d6a5729c11b1e101ef', 'Luciachavez@gmail.com', 'Bitdefender Total Security 2024', 1, 60, 2, '2024-06-20 06:24:18.000000'),
('f0a8b199f652d6a5729c11b1e101ef', 'Luciachavez@gmail.com', 'Laptop HP Victus 16-D0023', 1, 4199, 1, '2024-06-20 06:24:18.000000'),
('56d94cb03ed22aa891462c52ea431d', 'martinalvarado@gmail.com', 'Router TP-Link TL-MR6400APAC', 1, 329, 3, '2024-06-20 06:25:36.000000'),
('56d94cb03ed22aa891462c52ea431d', 'martinalvarado@gmail.com', 'Extensor/amplificador WiFi', 1, 150, 3, '2024-06-20 06:25:36.000000'),
('e060d023b92625aa7fd1a9f3d059af', 'Santiagoparedes@gmail.com', 'Cámara Olympus E-330', 1, 2303, 1, '2024-06-20 06:26:54.000000'),
('8956f45db5aec7753d016da458edae', 'valentinaquispe@gmail.com', 'MSI Tarjeta gráfica GeForce RTX 3060', 1, 1592, 1, '2024-05-30 23:27:49.000000'),
('8956f45db5aec7753d016da458edae', 'valentinaquispe@gmail.com', 'Procesador Intel Core i7-12700KF 12th generation', 1, 1046, 1, '2024-05-30 23:27:49.000000'),
('8956f45db5aec7753d016da458edae', 'valentinaquispe@gmail.com', 'MSI Tarjeta gráfica GeForce RTX 3060', 1, 1592, 1, '2024-05-30 23:27:49.000000'),
('8956f45db5aec7753d016da458edae', 'valentinaquispe@gmail.com', 'Procesador Intel Core i7-12700KF 12th generation', 1, 1046, 1, '2024-05-30 23:27:49.000000'),
('a29d3b59132e021a07de0318a1a617', 'luisalcantara@gmail.com\r\n', 'Router TP-Link TL-MR6400APAC', 1, 329, 3, '2024-06-30 23:37:50.000000'),
('a29d3b59132e021a07de0318a1a617', 'luisalcantara@gmail.com\r\n', 'Adaptador Teraware conector usb 3.0 a RJ45', 1, 79, 1, '2024-04-30 23:37:50.000000'),
('1fd29453db7f220f39c11a64cd2404', 'Sanchezjimenez@gmail.com', 'Laptop HP Victus 16-D0023', 1, 4199, 1, '2024-06-30 04:44:03.000000'),
('1fd29453db7f220f39c11a64cd2404', 'Sanchezjimenez@gmail.com', 'Router TP-Link TL-MR6400APAC', 1, 329, 3, '2024-06-30 04:44:03.000000'),
('0292b20f30cb28414cf0b41f484d39', 'test@gmail.com', 'Impresora Multifuncional HP Color LaserJet Pro M283FDW', 1, 2799, 1, '2024-07-01 05:36:27.000000'),
('3735500d859ba6ed986458fdafbd54', 'test@gmail.com', 'Impresora Multifuncional HP Color LaserJet Pro M283FDW', 1, 2799, 1, '2024-07-01 05:37:32.000000'),
('3c8e2a2ff5666a994fb7276ae8fda8', 'test@gmail.com', 'Impresora Multifuncional HP Color LaserJet Pro M283FDW', 1, 2799, 1, '2024-07-01 05:40:53.000000'),
('8cb649271e855603ad825ca5ffea49', 'yesquentineokenner@gmail.com', 'Laptop HP Victus 16-D0023', 1, 4199, 1, '2024-07-02 02:42:34.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `dni` int(8) NOT NULL,
  `user` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `dni`, `user`, `clave`, `tipo`, `fech_crea`, `fech_modi`, `fech_elim`, `estado`) VALUES
(1, 'Administrador', 'Administrador', 11111111, 'admin', 'admin', 1, '2023-06-09 21:34:00', '2023-06-09 19:33:25', NULL, 1),
(24, 'Daniel', 'Huaman', 20020100, 'huaman@gmail.com', '123456', 2, '2024-06-07 23:03:13', NULL, NULL, 1),
(25, 'Valentina', 'Quispe caceres', 23142431, 'valentinaquispe@gmail.com', 'Qu1sp3C@cer3s', 2, '2024-06-18 17:55:40', NULL, NULL, 1),
(26, 'Santiago ', 'Paredes tineo', 43215312, 'Santiagoparedes@gmail.com', 'S@nt14goT!neo', 2, '2024-06-18 17:58:52', NULL, NULL, 1),
(27, 'Martín', 'Alvarado Torres', 27432123, 'martinalvarado@gmail.com', 'M@rt1nAlv@r4do', 2, '2024-06-18 18:00:56', NULL, NULL, 1),
(28, 'Diego ', 'Arevalo Sanchez', 35214542, 'Diegoarevalo@gmail.com', 'D1eg0!Ar3v@lo', 2, '2024-06-18 18:08:21', NULL, NULL, 1),
(29, 'Lucía ', 'Chavez leva', 87654231, 'Luciachavez@gmail.com', 'L@uc1aCh@v3z', 2, '2024-06-18 18:24:16', NULL, NULL, 1),
(30, 'Ramos ', 'Espinoza vega', 77432355, 'Ramosespinoza@gmail.com', 'R@m0sEsp1n0z@', 2, '2024-06-18 18:26:46', NULL, NULL, 1),
(36, 'kenner samir', 'yesquen tineo', 70533020, 'yesquentineokenner@gmail.com', 'Vallejiano123.', 2, '2024-06-30 16:59:58', NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
