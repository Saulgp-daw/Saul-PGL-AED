-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-01-2024 a las 19:59:20
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Drama'),
(2, 'Biografía'),
(3, 'Musical'),
(4, 'Ciencia Ficción'),
(5, 'Comedia'),
(6, 'Aventura'),
(7, 'Romance'),
(8, 'Acción'),
(9, 'Thriller'),
(10, 'Anime');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `actores` varchar(255) NOT NULL,
  `argumento` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `trailer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `direccion`, `actores`, `argumento`, `imagen`, `trailer`) VALUES
(5, 'Almas en pena de Inisherin', 'Martin McDonagh', 'Colin Farrell, Brendan Gleeson, Kerry Condon, Barry Keoghan', 'Ambientada en una isla remota frente a la costa oeste de Irlanda en 1923...', 'imagen.jpg', 'https://www.youtube.com/watch?v=tgg9HijddIo'),
(6, 'Avatar: El sentido del agua', 'James Cameron', 'Sam Worthington, Zoe Saldana, Sigourney Weaver, Kate Winslet', 'Más de una década después de los acontecimientos de \'Avatar\'...', 'imagen.jpg', 'https://www.youtube.com/watch?v=FSyWAxUg3Go'),
(7, 'Sin novedad en el frente', 'Edward Berger', 'Felix Kammerer, Albrecht Schuch, Aaron Hilmer, Moritz Klaus', 'Relato de las terribles experiencias y la angustia de un joven soldado alemán...', 'imagen.jpg', 'https://www.youtube.com/watch?v=EBk1lXQ7rcY'),
(8, 'El método Williams', 'Reinaldo Marcus Green', 'Will Smith, Aunjanue Ellis, Jon Bernthal, Saniyya Sidney', 'Biopic sobre Richard Williams, un padre inasequible que ayudó a formar a dos de las deportistas más extraordinarias...', 'imagen.jpg', 'https://www.youtube.com/watch?v=LJdOqzZdl5w'),
(9, 'Licorice Pizza', 'Paul Thomas Anderson', 'Alana Haim, Cooper Hoffman, Sean Penn, Bradley Cooper', 'Es la historia de Alana Kane y Gary Valentine, de cómo se conocen, pasan el tiempo juntos y acaban enamorándose en el Valle de San Fernando en 1973', 'imagen.jpg', 'https://www.youtube.com/watch?v=ofnXPwUPENo'),
(10, 'El callejón de las almas perdidas', 'Guillermo del Toro', 'Bradley Cooper, Rooney Mara, Cate Blanchett, Toni Collette', '', 'imagen.jpg', 'https://www.youtube.com/watch?v=8Ths1kLcKd0'),
(11, 'Belfast', 'Kenneth Branagh', 'Jude Hill, Caitriona Balfe, Jamie Dornan, Judi Dench', 'Drama ambientado en la tumultuosa Irlanda del Norte de finales de los años 60...', 'imagen.jpg', 'https://www.youtube.com/watch?v=GTkikkDL6FU'),
(12, 'CODA: Los sonidos del silencio', 'Siân Heder', 'Emilia Jones, Troy Kotsur, Marlee Matlin, Daniel Durant', 'Ruby (Emilia Jones) es el único miembro oyente de una familia de sordos...', 'imagen.jpg', 'https://www.youtube.com/watch?v=iy910WCy5R0'),
(13, 'El poder del perro', 'Jane Campion', 'Benedict Cumberbatch, Jesse Plemons, Kirsten Dunst, Kodi Smit-McPhee', 'Montana, 1925. Los acaudalados hermanos Phil (Cumberbatch) y George Burbank (Plemons) son las dos caras de la misma moneda...', 'imagen.jpg', 'https://www.youtube.com/watch?v=wzTkWBGDeJY'),
(14, 'No mires arriba', 'Adam McKay', 'Leonardo DiCaprio, Jennifer Lawrence, Meryl Streep, Cate Blanchett', 'Kate Dibiasky (Jennifer Lawrence), estudiante de posgrado de Astronomía, y su profesor, el doctor Randall Mindy (Leonardo DiCaprio) hacen un descubrimiento tan asombros como terrorífico...', 'imagen.jpg', 'https://www.youtube.com/watch?v=kWkUg22UbVg'),
(15, 'Drive My Car', 'Ryûsuke Hamaguchi', 'Hidetoshi Nishijima, Tôko Miura, Reika Kirishima, Park Yu-rim', 'Pese a no ser capaz de recuperarse de un drama personal, Yusuke Kafuku, actor y director de teatro, acepta montar la obra \"Tío Vania\" en un festival de Hiroshima...', 'imagen.jpg', 'https://www.youtube.com/watch?v=-ofCqXmgx0E'),
(21, 'Pokemon', 'Ash ketchum', 'tu madre', 'ninguno', 'pokedex_1.png', ''),
(22, 'BladeRunner', 'sdfsdf', 'Ryan Gosling', 'sdfsdf', '4260918.webp', '3rwrwerwer'),
(23, 'aAAAAAAAAA', 'ffsdf', 'sdfsdfdsf', 'sdfsdf', '15724420-jimrdk9u-v4.webp', 'https://www.youtube.com/watch?v=mCdA4bJAGGk&ab_channel=sweetblue.'),
(25, 'Nueva', 'yes', 'yes', 'aaaaa', '15724419-ueavp6zw-v4.webp', 'aaaa'),
(26, 'Test V2', 'ninguna', 'Juluis', 'Marico', 'imagen.jpg', 'string');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula_categoria`
--

CREATE TABLE `pelicula_categoria` (
  `id` int NOT NULL,
  `pelicula_id` int DEFAULT NULL,
  `categoria_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pelicula_categoria`
--

INSERT INTO `pelicula_categoria` (`id`, `pelicula_id`, `categoria_id`) VALUES
(9, 5, 1),
(10, 5, 9),
(11, 6, 4),
(12, 6, 6),
(13, 7, 1),
(14, 7, 8),
(15, 8, 2),
(16, 8, 7),
(17, 9, 1),
(18, 9, 5),
(19, 10, 10),
(25, 21, 5),
(26, 22, 1),
(27, 22, 4),
(28, 23, 1),
(33, 25, 1),
(34, 25, 4),
(35, 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `rol`, `active`, `hash`, `email`) VALUES
(7, 'root', '$2a$10$WvhH/Cgd2cVElEEQfeF.8uOQci5KDn9bXP1vlxQBmI5pOmpkcOJ9i', 'ROLE_ADMIN', NULL, NULL, NULL),
(12, 'lui', '$2a$10$0xezsvQnVm/I.DOTqprt9esmD4wava7gVY/oZB2HlaUz.ZaJP7sa2', 'ROLE_USER', NULL, NULL, NULL),
(28, 'saul', '$2a$10$gMpLBPfYqEmo3Ilf97DOm.HH1WRnDbO5dKCeSIiBqrQtdKysp8HBW', 'ROLE_USER', 1, 'eyJhbGciOiJIUzI1NiJ9.eyJhdXRob3JpdGllcyI6IjEyMzQiLCJzdWIiOiJzYXVsIiwiZXhwIjoxNzA1MTY1MjMzfQ.acoOnkSWn_WmKzFPLndPWT2dqBhcYgZex6TpuSr7s7I', 'saulgp4a@gmail.com'),
(29, 'pepe', '$2a$10$gMpLBPfYqEmo3Ilf97DOm.HH1WRnDbO5dKCeSIiBqrQtdKysp8HBW', 'ROLE_ADMIN', 1, 'eyJhbGciOiJIUzI1NiJ9.eyJhdXRob3JpdGllcyI6IjEyMzQiLCJzdWIiOiJzYXVsIiwiZXhwIjoxNzA1MTY1MjMzfQ.acoOnkSWn_WmKzFPLndPWT2dqBhcYgZex6TpuSr7s7I', 'saulgp4a@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pelicula_categoria`
--
ALTER TABLE `pelicula_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelicula_id` (`pelicula_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `pelicula_categoria`
--
ALTER TABLE `pelicula_categoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula_categoria`
--
ALTER TABLE `pelicula_categoria`
  ADD CONSTRAINT `pelicula_categoria_ibfk_1` FOREIGN KEY (`pelicula_id`) REFERENCES `peliculas` (`id`),
  ADD CONSTRAINT `pelicula_categoria_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
