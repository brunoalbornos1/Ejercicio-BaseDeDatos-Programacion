-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 11:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ejercicio`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `ID` int(11) NOT NULL,
  `Fecha` varchar(30) NOT NULL,
  `IDProductos` varchar(15) NOT NULL,
  `IDUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`ID`, `Fecha`, `IDProductos`, `IDUsuario`) VALUES
(1, '2024-07-28', '1', '1'),
(2, '2024-07-28', '2', '2'),
(3, '2024-07-28', '3', '3'),
(4, '2024-07-28', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `ID` varchar(15) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Descripcion`, `Precio`) VALUES
('1', 'Laptop Dell', 'Laptop Dell Inspiron 15 3000 con procesador Intel i5 y 8GB de RAM', 650),
('2', 'Smartphone Samsung', 'Samsung Galaxy S21 con pantalla AMOLED y 128GB de almacenamiento', 800),
('3', 'Auriculares Bose', 'Auriculares Bose QuietComfort 35 II con cancelación de ruido activa', 299),
('4', 'Reloj Inteligente Apple', 'Apple Watch Series 6 con GPS y monitor de frecuencia cardíaca', 399);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID` varchar(15) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID`, `Nombre`, `Password`) VALUES
('1', 'Juan', 'Juan123'),
('2', 'Lucas', 'Lucas123'),
('3', 'Vale', 'Vale123'),
('4', 'Enzo', 'Enzo123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKProducto` (`IDProductos`),
  ADD KEY `FKUsuario` (`IDUsuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`IDProductos`) REFERENCES `productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
