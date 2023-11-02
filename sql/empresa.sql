-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 02-11-2023 a las 12:58:45
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
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) UNSIGNED NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(2, 3, '2023-11-17', 'Cita para recoger pedido'),
(3, 3, '2023-11-02', 'Visita guiada de las instalaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` longtext NOT NULL,
  `fecha` date NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(4, 'Cuidados del cactus Astrophytum myriostigma', '../imagenes/noticias/6542462c1a427_noticia-cactus1.jpg', 'Estas plantas de crecimiento lento suelen usarse en macetas y jardineras y también para rocallas y jardines de cactus y suculentas.\r\n\r\nEl Bonete de obispo puede vivir en una exposición de pleno sol pero prefiere la semisombra evitando el sol directo en las horas centrales del día. A pesar de que podría resistir alguna helada débil es mejor que en invierno no sufra temperaturas por debajo de los 5 ºC.\r\n\r\nEl suelo debería ser bastante arenoso para lo cual podemos mezclar un 50% de arena gruesa, un 25% de mantillo de hojas bien descompuesto o turba y un 25% de tierra de jardín ligera.\r\n\r\nNecesitan menos riegos que la mayoría de los cactus por lo que se aportará agua esperando a que la tierra esté bien seca. En invierno no regar.\r\n\r\nNo precisan de abonados especiales ni de poda.', '2023-11-01', 1),
(5, 'Características de la Echeveria elegans o Rosa de alabastro', '../imagenes/noticias/654246ce31110_noticia-cactus2.jpg', 'Es una planta crasa perteneciente a la familia Crasulácea y es oriunda de México. Dentro del género echeveria se pueden encontrar más de 300 variedades realmente resistentes y decorativas.\r\nEs una suculenta de crecimiento lento que produce rosetas apretadas, sin tallo, que crecen directamente en el suelo. Sus hojas verdes plateadas o azules son gruesas, ovales y carnosas ya que actúan como reservas de agua en épocas de sequía. Esto es lo que le confiere su gran rusticidad.\r\n\r\nLa flor de la Echeveria elegans surge produce entre finales de invierno y principios de primavera y se alarga hasta finales de verano. De la roseta emergen unos tallos con tintes rosados que producen unas flores de color rosa y amarillo.\r\n\r\nCuando el tallo floral esté ya envejecido y seco, suele ser recomendable quitarlo ya que es una fuente de desgaste natural.', '2023-10-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` text NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` enum('Hombre','Mujer','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_nac`, `direccion`, `sexo`) VALUES
(1, 'Antonio', 'García Moreno', 'agm@mail.com', '123456789', '2001-01-01', '', 'Hombre'),
(3, 'Lucía', 'Pérez Morales', 'luciapm@mail.com', '111222333', '1999-05-05', 'calle Madrid 7', 'Mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(10) UNSIGNED NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `rol` enum('admin','user','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(1, 1, 'admin', '7fcf4ba391c48784edde599889d6e3f1e47a27db36ecc050cc92f259bfac38afad2c68a1ae804d77075e8fb722503f3eca2b2c1006ee6f6c7b7628cb45fffd1d', 'admin'),
(3, 3, 'luciapm', 'fd312741fc8704ae825252a01425641d8ff905793c5a2f5920c75529bf92be2bbe86f99beca72653c272c54064c775718f7b2245958c8ee24fb5b76762c6dec9', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `usersData_idUser_citas` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`) USING HASH,
  ADD KEY `usersData_idUser_noticias` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `usersData_idUser_citas` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `usersData_idUser_noticias` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `usersData_idUser_usersLogin` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
