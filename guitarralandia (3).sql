-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 04-06-2023 a las 19:54:25
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guitarralandia`
--
CREATE DATABASE IF NOT EXISTS `guitarralandia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `guitarralandia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_categoria_padre` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `img_cat` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_categoria_padre`, `nombre`, `img_cat`, `descripcion`) VALUES
(1, NULL, 'GUITARRAS', NULL, 'Guitarras de 6 cuerdas'),
(2, NULL, 'BAJOS', NULL, 'Bajos de 4, 5 y 6 cuerdas'),
(3, NULL, 'OTRAS', NULL, 'Otros tipos de instrumentos de la familia de las guitarras'),
(8, 1, 'Electrica', 'electricas.png', 'Guitarras electroamplificadas'),
(9, 1, 'Acustica', 'acustica.png', 'Guitarras huecas de cuerdas metálicas'),
(10, 1, 'Clasica', 'clasica.png', 'Guitarras huecas de cuerdas de nylon'),
(11, 2, 'B.Electrico', 'bajoElectrico.png', 'Guitarra Bajo electroamplificado'),
(12, 2, 'B.Acustico', 'bajoAcustico.png', 'Guitarra Bajo con caja de resonancia'),
(13, 3, 'Ukelele', 'ukelele.png', 'guitarrillas asquerosas que suenan como el culo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id_chat` int(11) NOT NULL,
  `id_instrumento` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `id_interesado` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id_chat`, `id_instrumento`, `id_propietario`, `id_interesado`, `fecha_creacion`) VALUES
(20, 2, 2, 1, '2023-05-28 17:25:41'),
(21, 1, 1, 3, '2023-05-28 17:54:50'),
(23, 11, 4, 13, '2023-06-04 17:36:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favoritos` int(11) NOT NULL,
  `id_instrumento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_favoritos`, `id_instrumento`, `id_usuario`, `fecha_creacion`) VALUES
(72, 11, 13, '2023-06-04 17:36:24'),
(73, 21, 13, '2023-06-04 17:42:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrumentos`
--

CREATE TABLE `instrumentos` (
  `id_instrumento` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_instrumento` varchar(50) NOT NULL,
  `marca_instrumento` varchar(50) DEFAULT NULL,
  `modelo_instrumento` varchar(50) DEFAULT NULL,
  `descripcion_instrumento` varchar(200) DEFAULT NULL,
  `estado_instrumento` varchar(50) DEFAULT NULL,
  `precio_instrumento` decimal(10,2) NOT NULL,
  `imagenes_instrumento` varchar(200) DEFAULT NULL,
  `fecha_publicacion_instrumento` timestamp NOT NULL DEFAULT current_timestamp(),
  `disponible` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instrumentos`
--

INSERT INTO `instrumentos` (`id_instrumento`, `id_categoria`, `id_usuario`, `nombre_instrumento`, `marca_instrumento`, `modelo_instrumento`, `descripcion_instrumento`, `estado_instrumento`, `precio_instrumento`, `imagenes_instrumento`, `fecha_publicacion_instrumento`, `disponible`) VALUES
(1, 8, 1, 'PRS Santana SE ', 'Paul Reed Smith', 'Santana SE SY 2017', 'Nueva PRS!', 'NUEVA', '800.00', 'santana_adolfo.jpeg', '2023-04-22 17:58:32', '0'),
(2, 9, 1, 'Acustica Nxt', 'Eko', 'Acustica electrificada', 'Es la guitarra de mi amigo Toti', 'usada', '890.00', 'acustica_adolfo.jpeg', '2023-04-22 18:03:13', '0'),
(3, 10, 1, 'Tomas Leal', 'Tomas Leal', 'Handmade', 'Es la guitarra de Diego que tiene Javi en su casa.', 'Seminueva', '650.00', 'clasica_adolfo.jpeg', '2023-04-22 18:03:13', '0'),
(4, 13, 1, 'Ukelele', 'Martin Smith', 'Soprano', 'Ukelele azul en muy buen estado.', 'Seminuevo', '200.00', 'ukelele_adolfo.jpeg', '2023-04-22 18:03:13', '0'),
(5, 8, 2, 'Ibanez 335', 'Ibanez', '335', 'Suena a rayos encendidos', 'usado', '350.00', '335_primo_miky.jpg\r\n', '2023-04-22 18:12:09', '0'),
(6, 8, 2, 'ESP LTD 1000', 'ESP', 'LTD', 'Esta guapísima. Es el modelo mate.', 'Nueva', '800.00', 'electrica_mateo.jpeg', '2023-04-22 18:12:09', '0'),
(7, 11, 3, 'Danelectro', 'Danelectro', 'Magnetic', 'Esta como nuevo y pesa muy poco.', 'Seminuevo', '300.00', 'bajo1.jpeg', '2023-04-22 18:12:09', '0'),
(8, 11, 3, 'Epiphone sg', 'Epiphone', 'Sg', 'Está mas quemao que el palo un churrero.', 'Usado', '400.00', 'bajo2.jpeg', '2023-06-04 16:59:48', '0'),
(9, 11, 3, 'Thunderbird', 'Gipson', 'Thunderbird', 'Lleva mas tralla que un futbolin.', 'Usado', '800.00', 'bajo3.jpeg', '2023-06-04 17:02:11', '0'),
(10, 12, 3, 'Ibanez acoustic', 'Ibanez', 'Acustico', 'Es un clásico que nunca falla.', 'Usado', '400.00', 'bajoacustico1.jpeg', '2023-06-04 17:03:42', '0'),
(11, 8, 4, 'Fender Blacky', 'Fender', 'Stratocaster', 'Rascador carey.', 'Nueva', '900.00', 'blacky_toti.jpg', '2023-06-04 17:05:43', '1'),
(12, 10, 4, 'Tomas Leal', 'Tomas Leal', 'Lutier', 'Es del año 1963.', 'Muy bien cuidada', '1000.00', 'clasica_toti.jpg', '2023-06-04 17:07:52', '0'),
(13, 9, 4, 'Fender', 'Acustica', 'Acustica', 'La compró en Ibiza.', 'Usado', '100.00', 'acustica1_toti.jpg', '2023-06-04 17:11:06', '0'),
(14, 9, 4, 'Sigma', 'Sigma', 'Acustica', 'Sonido muy cálido.', 'Nueva', '300.00', 'acustica2_toti.jpg', '2023-06-04 17:11:06', '0'),
(15, 9, 4, 'Samick', 'Samick', 'Acustica', 'Sonido coreano.', 'Nueva', '350.00', 'acustica3_toti.jpg', '2023-06-04 17:12:28', '0'),
(16, 8, 12, 'Fender Stratocaster', 'Fender', 'Stratocaster cream', 'Made in USA 1999.', 'Muy bien cuidada', '900.00', 'strato_bienve.jpg', '2023-06-04 17:16:18', '0'),
(17, 8, 12, 'Gibson Goldtop', 'Gibson', 'Les Paul Goldtop', '1986', 'Usada', '1600.00', 'goldtop_bienve.jpeg', '2023-06-04 17:16:18', '0'),
(18, 8, 12, 'Fender Telecaster 77', 'Fender', 'Telecaster 77', 'Suena a autocaravana de Arkansas.', 'Tiene historia', '1400.00', 'electrica_bienve.jpeg', '2023-06-04 17:18:50', '0'),
(19, 10, 12, 'Lutier', 'Lutier', 'Cedro', 'Caja palosanto tapa cedro.', 'Nueva', '2000.00', 'clasica1_bienve.jpeg', '2023-06-04 17:18:50', '0'),
(20, 10, 12, 'Lutier', 'Lutier', 'Abeto', 'Caja palosanto Rio y tapa abeto.', 'Muy bien cuidada', '1800.00', 'clasica2_bienve.jpeg', '2023-06-04 17:21:10', '0'),
(21, 10, 12, 'Lutier', 'Lutier', 'Pino', 'Caja palosanto India y tapa de pino', 'Nueva', '1600.00', 'clasica3_bienve.jpeg', '2023-06-04 17:21:10', '0'),
(22, 9, 10, 'Fender acustica', 'Fender', 'Acustica', 'Gama media. 12 cuerdas.', 'Muy bien cuidada', '600.00', 'fender_acustica_victor.jpeg', '2023-06-04 17:24:41', '0'),
(23, 8, 10, 'Jackson', 'Jackson', 'Stratocaster', 'Se le notan los años.', 'Usada', '400.00', 'Jackson_victor.jpeg', '2023-06-04 17:24:41', '0'),
(24, 8, 10, 'Ibanez', 'Ibanez', 'Semicaja', 'Perfecta para Jazz.', 'Usada', '800.00', 'ibanez_victor.jpeg', '2023-06-04 17:25:55', '0'),
(25, 9, 11, 'Neon', 'Neon', 'Lights', 'Buena para ensayos.', 'Nueva', '500.00', 'acustica_Javi_Nieto.jpg', '2023-06-04 17:29:11', '0'),
(26, 8, 11, 'Diego Neon', 'Diego Neon', 'Telecaster', 'Truño considerable.', 'Desquintada', '100.00', 'electrica_javi_nieto.jpg', '2023-06-04 17:29:11', '0'),
(27, 13, 11, 'Ukelele Fronko', 'Fronko', 'Ukelele', 'Es azul.', 'Malo', '50.00', 'ukelele_javi_nieto.jpg', '2023-06-04 17:30:47', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_chat` int(11) NOT NULL,
  `id_emisor` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_chat`, `id_emisor`, `mensaje`, `fecha_envio`) VALUES
(103, 23, 13, 'Hola buenas tardes, me harias una rebaja?', '2023-06-04 17:36:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_instrumento` int(11) DEFAULT NULL,
  `id_interesado` int(11) DEFAULT NULL,
  `leida` enum('0','1') DEFAULT '0',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `tipo_notificacion` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `id_usuario`, `id_instrumento`, `id_interesado`, `leida`, `fecha_creacion`, `tipo_notificacion`) VALUES
(64, 4, 11, 13, '1', '2023-06-04 19:37:04', '1'),
(65, 13, 11, 4, '1', '2023-06-04 19:40:04', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorías`
--

CREATE TABLE `subcategorías` (
  `id_subcategoria` int(11) NOT NULL,
  `id_subcategoria_padre` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `img_subcat` varchar(200) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorías`
--

INSERT INTO `subcategorías` (`id_subcategoria`, `id_subcategoria_padre`, `nombre`, `img_subcat`, `descripcion`) VALUES
(1, 8, 'Stratocaster', 'stratocaster.jpg', 'Guitarra corte stratocsaster'),
(2, 8, 'Telecaster', 'telecaster.jpg', 'Guitarras corte telecaster'),
(3, 8, 'SingleCut', 'singleCut.jpg', 'Guitarras corte Les Paul'),
(4, 8, 'DobleCut', 'dobleCut.jpg', 'Guitarras corte SG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_transaccion` int(11) NOT NULL,
  `id_instrumento` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `precio_transaccion` decimal(10,2) NOT NULL,
  `fecha_transaccion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id_transaccion`, `id_instrumento`, `id_vendedor`, `id_comprador`, `precio_transaccion`, `fecha_transaccion`) VALUES
(83, 11, 4, 13, '900.00', '2023-06-04 17:40:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `pass`, `direccion`, `telefono`, `fecha_creacion`, `admin`) VALUES
(1, 'Adolfo', 'adolfolmo@correo.com', '$2y$10$6wJN0EQkbdPuBpk3AV/AWOkYUKB2Vz73eD4DRgj.CZJqP5NuOG8u2', 'C/ Calleja, s/n tu tía', '56565656', '2023-04-02 17:07:25', 1),
(2, 'JManuel', 'jmanuel@welljob.com', '$2y$10$NSqEFMgcdrsVI47jI.uIau4UwanD8vnKex2uYCBblohI1aseknr3a', 'Calle Virgen de Loreto 10', '666555444', '2023-04-03 18:47:44', 1),
(3, 'Helios', 'heliossnchz@mail.com', '$2y$10$SNWzoPNft4Kj0mFMG1JVvOtvUWAobjx39Q2mJm1wlsR0wJDTMGeEy', 'Plaza Las Flores 12', '666121212', '2023-04-03 18:48:37', 0),
(4, 'Toti', 'toti@hotmail.com', '$2y$10$tqYUzKD1Y9zM5/GNIsCgmO822Badn7ZySVwHQmd69IGrY4E11wI4q', 'Calle Mayor 32', '655746554', '2023-04-03 18:49:28', 0),
(10, 'Victor', 'viktor@gmail.com', '$2y$10$tqYUzKD1Y9zM5/GNIsCgmO822Badn7ZySVwHQmd69IGrY4E11wI4q', 'Calle Santiago 18', '686154848', '2023-06-04 16:30:10', 0),
(11, 'JaviNieto', 'javieto@hotmail.es', '$2y$10$y7FOiA.3Dpo/464gy8168.VLXapLaknFGpPlZlS/VGwdunMVpKBBC', 'Camino Manolos 35', '968251478', '2023-06-04 16:31:27', 0),
(12, 'Bienve', 'bienvito@gmail.com', '$2y$10$sHMh87rDGdfcR18N9R6.4.BOKR9oBqddYw/UeEsWeylWXt/qsMNEW', 'Avenida Remedios 03', '968545474', '2023-06-04 16:32:17', 0),
(13, 'Peligros', 'pdmartinez@ucam.edu', '$2y$10$wh4kSSLJDVk6LqOd1MM/CuT54aSRBXEr4DFrg7HVUkGFeSL3QFHyG', 'Calle Ucam 11', '632101010', '2023-06-04 16:32:45', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_padre` (`id_categoria_padre`);

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `fk_instrumento` (`id_instrumento`),
  ADD KEY `fk_propietario` (`id_propietario`),
  ADD KEY `fk_intereado` (`id_interesado`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favoritos`),
  ADD KEY `favoritos_ibfk_1` (`id_instrumento`),
  ADD KEY `favoritos_ibfk_2` (`id_usuario`);

--
-- Indices de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  ADD PRIMARY KEY (`id_instrumento`,`id_usuario`),
  ADD KEY `fk_instrumentos_categorias` (`id_categoria`),
  ADD KEY `fk_instrumentos_usuarios` (`id_usuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_chat` (`id_chat`),
  ADD KEY `fk_usuario` (`id_emisor`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_instrumento` (`id_instrumento`),
  ADD KEY `id_interesado` (`id_interesado`);

--
-- Indices de la tabla `subcategorías`
--
ALTER TABLE `subcategorías`
  ADD PRIMARY KEY (`id_subcategoria`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_instrumento` (`id_instrumento`,`id_vendedor`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_comprador` (`id_comprador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favoritos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  MODIFY `id_instrumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `subcategorías`
--
ALTER TABLE `subcategorías`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_padre` FOREIGN KEY (`id_categoria_padre`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `fk_instrumento` FOREIGN KEY (`id_instrumento`) REFERENCES `instrumentos` (`id_instrumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_intereado` FOREIGN KEY (`id_interesado`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_propietario` FOREIGN KEY (`id_propietario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_instrumento`) REFERENCES `instrumentos` (`id_instrumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_3` FOREIGN KEY (`id_instrumento`) REFERENCES `instrumentos` (`id_instrumento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  ADD CONSTRAINT `fk_instrumentos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_instrumentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_chat` FOREIGN KEY (`id_chat`) REFERENCES `chats` (`id_chat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_emisor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`id_instrumento`) REFERENCES `instrumentos` (`id_instrumento`),
  ADD CONSTRAINT `notificaciones_ibfk_3` FOREIGN KEY (`id_interesado`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`id_instrumento`,`id_vendedor`) REFERENCES `instrumentos` (`id_instrumento`, `id_usuario`),
  ADD CONSTRAINT `transacciones_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `transacciones_ibfk_3` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
