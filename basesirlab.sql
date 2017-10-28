-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28-Out-2017 às 01:46
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basesirlab`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios_sala`
--

DROP TABLE IF EXISTS `horarios_sala`;
CREATE TABLE IF NOT EXISTS `horarios_sala` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_sala` int(50) NOT NULL,
  `horario` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `horarios_sala`
--

INSERT INTO `horarios_sala` (`id`, `id_sala`, `horario`) VALUES
(5, 11, '07:00-08:00'),
(6, 11, '08:00-09:00'),
(7, 11, '09:00-10:00'),
(8, 11, '10:00-11:00'),
(9, 13, '08:00-09:00'),
(10, 13, '10:00-11:00'),
(12, 12, '16:30-17:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(50) NOT NULL,
  `id_horario` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `id_usuario`, `id_horario`) VALUES
(1, 10, 5),
(2, 20, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

DROP TABLE IF EXISTS `salas`;
CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id`, `nome`, `codigo`) VALUES
(11, 'LaboratÃ³rio de redes', '15'),
(12, 'LaboratÃ³rio de engenharia de software', '16'),
(13, 'LaboratÃ³rio EAD', '10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `matricula`, `senha`) VALUES
(20, 'Lucas', 'lucas@gmail.com', '22223222', '123456'),
(21, 'Ariel', 'ariel@gmail.com', '11111', '1234567'),
(22, 'Joao', 'joao@gmail.com', '444444', '4444444'),
(23, 'Lucas Amaral', 'lucasamaral@gmail.com', '20121212', '698dc19d489c4e4db73e28a713eab07b'),
(24, 'Lucas Amaral', 'maiara@gmail.com', '000', '15f132ae28f481ba51ff62d141f18425');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
