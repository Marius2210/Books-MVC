-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2025 a las 23:03:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_libros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id`, `nombre`, `nacionalidad`, `imagen`) VALUES
(3, 'William Shakespeare', 'Inglés', 'public/imagenesAutores/Shakespeare.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `categoria` enum('Terror','Ciencia Ficción','Romance','Poesía') NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `categoria`, `fecha_compra`, `imagen`) VALUES
(13, 'La Odisea', 'Homero', 'Ciencia Ficción', '2025-04-28', 'public/imagenesLibros/Odisea.jpg'),
(14, 'Fahrenheit 451', 'Ray Bradbury', 'Ciencia Ficción', '2025-03-11', 'public/imagenesLibros/fahrenhei451.jpeg'),
(15, 'Yo, robot', 'Isaac Asimov', 'Ciencia Ficción', '2025-05-01', 'public/imagenesLibros/yorobot.jpeg'),
(16, 'It', 'Stephen King', 'Terror', '2025-03-05', 'public/imagenesLibros/it.jpeg'),
(19, 'Romeo y Julieta', 'William Shakespeare', 'Romance', '2025-03-26', 'public/imagenesLibros/romeoyjulieta.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librosdeseos`
--

CREATE TABLE `librosdeseos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `categoria` enum('Terror','Ciencia Ficción','Romance','Poesía') NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `librosdeseos`
--

INSERT INTO `librosdeseos` (`id`, `titulo`, `autor`, `categoria`, `fecha_compra`, `imagen`) VALUES
(4, 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Ciencia Ficción', '2025-05-29', 'public/imagenesLibros/DonQuijote.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'Marius', 'marius@ejemplo.com', '$2y$10$th5RMx4mSytYKkrUB2bZ8OkETPlbA.Y61EdbkfsOBgFLSFVVk3F4.'),
(2, 'Ernesto', 'ernesto@gmail.com', '$2y$10$DJrZWQLx4bAIwnx.xlnYFeR4cA6Ans59VbbDdc4sAJD/c2o4jCGYK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `librosdeseos`
--
ALTER TABLE `librosdeseos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `librosdeseos`
--
ALTER TABLE `librosdeseos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
