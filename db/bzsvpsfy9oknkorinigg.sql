-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bzsvpsfy9oknkorinigg-mysql.services.clever-cloud.com:3306
-- Generation Time: Nov 17, 2020 at 04:22 AM
-- Server version: 8.0.15-5
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bzsvpsfy9oknkorinigg`
--

-- --------------------------------------------------------

--
-- Table structure for table `barrio`
--

CREATE TABLE `barrio` (
  `ID_barrio` int(11) NOT NULL,
  `nom_barrio` varchar(25) NOT NULL,
  `FK_localidad` int(11) NOT NULL,
  `FK_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `ID_categoria` int(11) NOT NULL,
  `nom_categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`ID_categoria`, `nom_categoria`) VALUES
(1, 'Electricos'),
(2, 'Manuales'),
(3, 'Materiales metalicos'),
(4, 'Materiales no metalicos'),
(5, 'Pinturas'),
(6, 'Cerrajeria');

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_ciudad` int(11) NOT NULL,
  `nom_ciudad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`ID_ciudad`, `nom_ciudad`) VALUES
(1, 'Bogotá'),
(2, 'Medellín'),
(3, 'Cali'),
(4, 'Barranquilla'),
(5, 'Soledad'),
(6, 'Cúcuta'),
(7, 'Soacha'),
(8, 'Ibagué'),
(9, 'Bucaramanga'),
(10, 'Villavicencio'),
(11, 'Santa Marta'),
(12, 'Bello'),
(13, 'Valledupar'),
(14, 'Pereira'),
(15, 'Buenaventura'),
(16, 'Pasto'),
(17, 'Manizales'),
(18, 'Montería'),
(19, 'Neiva'),
(20, 'Monte Alegre');

-- --------------------------------------------------------

--
-- Table structure for table `det_factura`
--

CREATE TABLE `det_factura` (
  `FK_det_factura` int(11) NOT NULL,
  `FK_det_prod` varchar(40) NOT NULL,
  `precio_unt` int(30) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `CF_us` varchar(25) NOT NULL,
  `CF_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `det_factura`
--

INSERT INTO `det_factura` (`FK_det_factura`, `FK_det_prod`, `precio_unt`, `estado`, `cantidad`, `CF_us`, `CF_tipo_doc`) VALUES
(1, '353740283X', 0, '0', 2, '1636012383599', 'CE'),
(2, '176974732X', 0, '', 6, '1695062224499', 'CE'),
(3, '430911542X', 0, '', 9, '1662041247199', 'CC'),
(4, '9774391012', 0, '', 12, '1660062872399', 'CC'),
(5, '8585851732', 0, '', 3, '1668040515399', 'CC'),
(6, '0529063441', 0, '', 6, '1662101568299', 'CC'),
(7, '5574468565', 0, '', 8, '1694050100899', 'CC'),
(8, '6638029436', 0, '', 3, '1628012272099', 'CC'),
(9, '2041172460', 0, '', 2, '1608051762299', 'CC'),
(10, '4884032810', 0, '', 15, '1670072699699', 'CC'),
(11, '7880000739', 0, '', 12, '1676090228999', 'CC'),
(12, '1557972591', 0, '', 16, '1623083099799', 'CC'),
(13, '6691851129', 0, '', 2, '1687060309399', 'CC'),
(14, '509004757X', 0, '', 2, '1654011145999', 'CC'),
(15, '5789389872', 0, '', 2, '1692090422599', 'CC'),
(16, '6254386003', 0, '', 2, '1624060419399', 'CC'),
(17, '9808953743', 0, '', 2, '1651011048199', 'CC'),
(18, '3483863125', 0, '', 2, '1680091992499', 'CC'),
(23, '23dsf', 25000, 'vendido', 1, '1', 'CC'),
(23, '430911542X', 659000, 'vendido', 1, '1', 'CC'),
(23, '4884032810', 49950, 'vendido', 1, '1', 'CC'),
(23, '543543', 25000, 'vendido', 1, '1', 'CC'),
(24, '23dsf', 25000, 'vendido', 1, '1', 'CC'),
(24, '430911542X', 659000, 'vendido', 1, '1', 'CC'),
(24, '4884032810', 49950, 'vendido', 1, '1', 'CC'),
(25, '430911542X', 659000, 'vendido', 1, '1', 'CC'),
(26, '430911542X', 659000, 'vendido', 1, '1', 'CC');

-- --------------------------------------------------------

--
-- Table structure for table `det_orden`
--

CREATE TABLE `det_orden` (
  `FK_ord` int(11) NOT NULL,
  `FK_prod` varchar(40) NOT NULL,
  `cantidad_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `det_orden`
--

INSERT INTO `det_orden` (`FK_ord`, `FK_prod`, `cantidad_prod`) VALUES
(1, '353740283X', 1),
(2, '176974732X', 1),
(3, '430911542X', 1),
(4, '9774391012', 2),
(5, '8585851732', 3),
(6, '0529063441', 1),
(7, '5574468565', 1),
(8, '6638029436', 1);

-- --------------------------------------------------------

--
-- Table structure for table `det_producto`
--

CREATE TABLE `det_producto` (
  `FK_prod` varchar(40) NOT NULL,
  `FK_rut` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `num_fac_ing` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `det_producto`
--

INSERT INTO `det_producto` (`FK_prod`, `FK_rut`, `fecha`, `num_fac_ing`) VALUES
('0529063441', '353721273', '2019-06-14', '0523793441'),
('1557972591', '411070291', '2019-09-14', '1557412591'),
('176974732X', '719875909', '2019-10-14', '176515932X'),
('2041172460', '478267154', '2019-10-14', '2011172460'),
('3483863125', '632873939', '2019-04-14', '3469325125'),
('353740283X', '17468875', '2019-12-14', '353744583X'),
('430911542X', '759451251', '2019-08-14', '430947842X'),
('4884032810', '769976670', '2019-12-14', '4884999810'),
('509004757X', '882813547', '2019-03-14', '522204757X'),
('5574468565', '178890276', '2019-02-14', '5574168565'),
('5789389872', '763011374', '2019-04-14', '5789879872'),
('6254386003', '296342653', '2019-07-14', '6159686003'),
('6638029436', '481796032', '2019-06-14', '6123429436'),
('6691851129', '647278225', '2019-07-14', '6691866629'),
('7880000739', '550507862', '2019-11-14', '7881963739'),
('8585851732', '130382612', '2019-07-14', '8585111732'),
('9774391012', '684382518', '2019-07-14', '9798741012'),
('9808953743', '467487188', '2019-03-14', '9807777743');

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `direccion` (
  `ID_dir` int(11) NOT NULL,
  `dir` varchar(25) NOT NULL,
  `CF_us` varchar(25) DEFAULT NULL,
  `CF_tipo_doc` varchar(5) DEFAULT NULL,
  `CF_rut` varchar(20) DEFAULT NULL,
  `FK_barrio` int(11) NOT NULL,
  `FK_Localidad` int(11) NOT NULL,
  `FK_Ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empresa_provedor`
--

CREATE TABLE `empresa_provedor` (
  `ID_rut` varchar(20) NOT NULL,
  `nom_empresa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empresa_provedor`
--

INSERT INTO `empresa_provedor` (`ID_rut`, `nom_empresa`) VALUES
('130382612', 'Eyegate Pharmaceuticals, Inc'),
('17468875', 'Tuberias S.A.S'),
('178890276', 'Avista Corporation'),
('296342653', 'Kearny Financial'),
('353721273', 'Celgene Corporation'),
('390737614', 'EW Scripps Company'),
('411070291', 'Graco Inc'),
('464978345', 'Virtus Global Multi-Sector Income Fund'),
('467487188', 'Vident International Equity Fund'),
('478267154', 'BlackRock Energy and Resources Trust'),
('481796032', 'Artesian Resources Corporation'),
('550507862', 'Antero Midstream Partners LP'),
('632873939', 'WisdomTree Interest'),
('647278225', 'NICE Ltd'),
('684382518', 'Ekso Bionics Holdings, Inc'),
('719875909', 'Nomad Foods Limited'),
('759451251', 'Citigroup Inc'),
('763011374', 'Amplify Snack Brands, inc'),
('769976670', 'ProPetro Holding Corp'),
('784044923', 'Banco Santander SA'),
('882813547', 'First Trust Rising Dividend Achievers ETF');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `ID_factura` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `FK_c_tipo_pago` int(11) NOT NULL,
  `claveTransaccion` varchar(200) DEFAULT NULL,
  `PaypalDatos` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`ID_factura`, `total`, `fecha`, `status`, `iva`, `FK_c_tipo_pago`, `claveTransaccion`, `PaypalDatos`) VALUES
(1, 2700, '2018-12-04', NULL, 8, 1, NULL, NULL),
(2, 9800, '2018-12-23', NULL, 4, 1, NULL, NULL),
(3, 3250, '2019-08-16', NULL, 4, 1, NULL, NULL),
(4, 8380, '2019-08-17', NULL, 5, 1, NULL, NULL),
(5, 4710, '2019-07-19', NULL, 1, 1, NULL, NULL),
(6, 6010, '2019-02-02', NULL, 5, 2, NULL, NULL),
(7, 3700, '2019-09-28', NULL, 3, 2, NULL, NULL),
(8, 3030, '2019-02-16', NULL, 4, 3, NULL, NULL),
(9, 6400, '2018-12-30', NULL, 9, 3, NULL, NULL),
(10, 9140, '2019-10-18', NULL, 8, 4, NULL, NULL),
(11, 9000, '2018-12-20', NULL, 7, 1, NULL, NULL),
(12, 5080, '2019-05-13', NULL, 6, 1, NULL, NULL),
(13, 1200, '2019-10-19', NULL, 9, 1, NULL, NULL),
(14, 7000, '2019-10-12', NULL, 9, 1, NULL, NULL),
(15, 1670, '2019-01-08', NULL, 0, 1, NULL, NULL),
(16, 5780, '2019-09-23', NULL, 4, 1, NULL, NULL),
(17, 8590, '2019-06-23', NULL, 7, 3, NULL, NULL),
(18, 1840, '2019-02-03', NULL, 10, 1, NULL, NULL),
(19, 6970, '2019-01-19', NULL, 2, 1, NULL, NULL),
(20, 3600, '2019-07-05', NULL, 8, 1, NULL, NULL),
(21, 758950, '2020-10-18', 'pendiente', 7, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba'),
(22, 758950, '2020-10-18', 'pendiente', 144200, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba'),
(23, 758950, '2020-10-18', 'pendiente', 144200, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba'),
(24, 733950, '2020-10-18', 'pendiente', 139450, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba'),
(25, 659000, '2020-10-18', 'pendiente', 125210, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba'),
(26, 659000, '2020-10-18', 'pendiente', 125210, 5, 'fl8bit8uaqr732n3u66blh5a6c', 'genericaPrueba');

-- --------------------------------------------------------

--
-- Table structure for table `localidad`
--

CREATE TABLE `localidad` (
  `ID_localidad` int(11) NOT NULL,
  `nom_localidad` varchar(25) NOT NULL,
  `FK_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `localidad`
--

INSERT INTO `localidad` (`ID_localidad`, `nom_localidad`, `FK_ciudad`) VALUES
(1, 'Usaquén', 1),
(2, 'Chapinero', 1),
(3, 'Santa Fe', 1),
(4, 'San Cristóbal', 1),
(5, 'Kennedy', 1),
(6, 'Tunjuelito', 1),
(7, 'Bosa', 1),
(8, 'Fontibón', 1),
(9, 'Engativá', 1),
(10, 'Suba', 1),
(11, 'Barrios Unidos', 1),
(12, 'Teusaquillo', 1),
(13, 'Los Mártires', 1),
(14, 'Antonio Nariño', 1),
(15, 'Puente Aranda', 1),
(16, 'La Candelaria', 1),
(17, 'Rafael Uribe Uribe', 1),
(18, 'Ciudad Bolívar', 1),
(19, 'Usme', 1),
(20, 'Sumapaz', 1),
(21, 'No hay registros', 2),
(22, 'No hay registros', 3),
(23, 'No hay registros', 4),
(24, 'No hay registros', 5),
(25, 'No hay registros', 6),
(26, 'No hay registros', 7),
(27, 'No hay registros', 8),
(28, 'No hay registros', 9),
(29, 'No hay registros', 10),
(30, 'No hay registros', 11),
(31, 'No hay registros', 12),
(32, 'No hay registros', 13),
(33, 'No hay registros', 14),
(34, 'No hay registros', 15),
(35, 'No hay registros', 16),
(36, 'No hay registros', 17),
(37, 'No hay registros', 18),
(38, 'No hay registros', 19),
(39, 'No hay registros', 20);

-- --------------------------------------------------------

--
-- Table structure for table `log_error`
--

CREATE TABLE `log_error` (
  `ID_error` int(11) NOT NULL,
  `descrip_error` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_error`
--

INSERT INTO `log_error` (`ID_error`, `descrip_error`, `fecha`, `hora`) VALUES
(1, 'Error correo electronico no valido', '2018-12-04', '14:14:00'),
(2, 'Error en la contraseña por favor digitela de nuevo', '2019-07-05', '13:24:54'),
(3, 'su solicitud requiere elevacion', '2019-02-03', '15:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `modific`
--

CREATE TABLE `modific` (
  `ID_modifc` int(11) NOT NULL,
  `descrip` varchar(200) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_doc` varchar(5) NOT NULL,
  `FK_modific` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modific`
--

INSERT INTO `modific` (`ID_modifc`, `descrip`, `fecha`, `hora`, `FK_us`, `FK_doc`, `FK_modific`) VALUES
(31, 'Usario modificado ID 1662041247199', '2020-11-15', '04:25:24', '1', 'CC', 4),
(32, 'Usario modificado ID 1234', '2020-11-15', '06:01:40', '1', 'CC', 4),
(33, 'Usario modificado ID 111', '2020-11-15', '06:04:48', '1', 'CC', 4),
(34, 'Usario modificado ID 111', '2020-11-15', '06:09:00', '1', 'CC', 4),
(35, 'Usario modificado ID 1651011048199', '2020-11-15', '06:22:00', '1', 'CC', 4),
(36, 'Usario modificado ID 1624060419399', '2020-11-15', '07:21:11', '1', 'CC', 4),
(37, 'Usario modificado ID 2', '2020-11-16', '10:00:20', '2', 'CC', 4),
(38, 'Usario eliminado ID 1676090228999', '2020-11-16', '10:50:30', '1', 'CC', 2),
(39, 'Usario modificado ID 111', '2020-11-16', '11:06:27', '1', 'CC', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

CREATE TABLE `notificacion` (
  `ID_not` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `FK_rol` int(3) NOT NULL,
  `FK_not` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificacion`
--

INSERT INTO `notificacion` (`ID_not`, `estado`, `descript`, `FK_rol`, `FK_not`) VALUES
(2, '0', NULL, 1, 8),
(3, '1', NULL, 1, 9),
(4, '0', NULL, 2, 3),
(5, '0', NULL, 2, 3),
(6, '0', NULL, 6, 10),
(7, '0', NULL, 3, 4),
(8, '0', NULL, 3, 5),
(9, '0', NULL, 4, 5),
(10, '0', NULL, 4, 2),
(11, '0', NULL, 4, 2),
(12, '0', NULL, 5, 11),
(15, '0', '1033710734', 1, 1),
(18, '1', '1', 1, 1),
(19, '1', '2', 1, 1),
(23, '1', '3', 1, 1),
(24, '0', '4', 1, 1),
(25, '0', '5', 1, 1),
(26, '0', '4', 1, 1),
(27, '1', '5', 1, 1),
(28, '1', '6', 1, 1),
(29, '0', '1234', 1, 1),
(30, '0', '111', 1, 1),
(31, '1', '5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orden_entrada`
--

CREATE TABLE `orden_entrada` (
  `ID_ord` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fact_prov` varchar(40) DEFAULT NULL,
  `CF_rol` int(3) NOT NULL,
  `CF_rol_us` varchar(25) NOT NULL,
  `CF_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orden_entrada`
--

INSERT INTO `orden_entrada` (`ID_ord`, `fecha_ingreso`, `fact_prov`, `CF_rol`, `CF_rol_us`, `CF_tipo_doc`) VALUES
(1, '2019-12-14', 'f113', 1, '1636012383599', 'CE'),
(2, '2020-02-14', 'f115', 2, '1695062224499', 'CE'),
(3, '2020-02-18', 'f116', 2, '1662041247199', 'CC'),
(4, '2020-04-25', 'f117', 2, '1660062872399', 'CC'),
(5, '2020-05-30', 'f118', 4, '1668040515399', 'CC'),
(6, '2020-08-08', 'f119', 4, '1694050100899', 'CC'),
(7, '2020-01-28', 'f120', 4, '1628012272099', 'CC'),
(8, '2020-03-22', 'f121', 4, '1670072699699', 'CC');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `ID_prod` varchar(40) NOT NULL,
  `nom_prod` varchar(30) NOT NULL,
  `val_prod` int(11) NOT NULL,
  `stok_prod` int(11) NOT NULL,
  `estado_prod` varchar(20) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `img` varchar(40) DEFAULT NULL,
  `CF_categoria` int(11) NOT NULL,
  `CF_tipo_medida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`ID_prod`, `nom_prod`, `val_prod`, `stok_prod`, `estado_prod`, `descript`, `img`, `CF_categoria`, `CF_tipo_medida`) VALUES
('0529063441', 'Martillo', 35950, 3, 'estandar', 'producto AAA', 'martillo.jpg', 2, 4),
('1557972591', 'Llave', 22900, 5, 'promocion', 'producto AAA', 'llave.jpg', 2, 4),
('176974732X', 'Trenzadora', 716000, 5, 'estandar', 'producto AAA', 'trenzadora.png', 1, 4),
('2041172460', 'Compresor', 79950, 10, 'estandar', 'producto AAA', 'compresor.png', 1, 4),
('23dsf', 'Segueta', 25000, 20, 'Promoción', NULL, 'SEGUETA.jpg', 3, 1),
('353740283X', 'Destornillador', 89900, 1, 'estandar', 'producto AAA', 'destornillador.png', 2, 4),
('430911542X', 'Pulidora', 659000, 6, 'estandar', 'producto AAA', 'pulidora.png', 3, 4),
('4884032810', 'Linterna', 49950, 7, 'promocion', 'producto AAA', 'linterna.png', 1, 4),
('509004757X', 'Remachadora', 114900, 6, 'promocion', 'producto AAA', 'remachadora.jpg', 2, 4),
('543543', 'Ponchadora', 25000, 20, 'Promoción', NULL, 'ponchadora.jpg', 2, 1),
('5574468565', 'Taladro', 99950, 2, 'estandar', 'producto AAA', 'taladro.png', 1, 4),
('5789389872', 'VinilBlanco', 134900, 4, 'promocion', 'producto AAA', 'vinilBlanco.png', 5, 4),
('6254386003', 'Laca', 259900, 1, 'promocion', 'producto AAA', 'laca.jpg', 5, 4),
('6638029436', 'Pegadit', 9950, 7, 'estandar', 'producto AAA', 'pegadit.png', 5, 4),
('6691851129', 'Puntilla', 13900, 1, 'promocion', 'producto AAA', 'puntilla.jpg', 3, 4),
('7880000739', 'Sierra', 559900, 3, 'promocion', 'producto AAA', 'sierra.png', 1, 4),
('8585851732', 'Alicates', 59950, 1, 'estandar', 'producto AAA', 'alicates.png', 2, 4),
('9774391012', 'Pinzas', 124950, 8, 'estandar', 'producto AAA', 'pinzas.png', 2, 4),
('98022222111', 'Cemento', 29900, 8, 'promocion', 'producto AAA', 'cemento.jpg', 4, 4),
('9808922111', 'Ladrillos', 29900, 8, 'promocion', 'producto AAA', 'ladrillo.jpg', 4, 4),
('9808953743', 'Cerrojo', 29900, 8, 'promocion', 'producto AAA', 'cerrojo.jpg', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `puntos`
--

CREATE TABLE `puntos` (
  `Id_puntos` int(11) NOT NULL,
  `puntos` int(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `puntos`
--

INSERT INTO `puntos` (`Id_puntos`, `puntos`, `fecha`, `FK_us`, `FK_tipo_doc`) VALUES
(1, 50, '1990-08-15', '1636012383599', 'CE'),
(2, 45, '1998-08-15', '1695062224499', 'CE'),
(3, 35, '2003-05-15', '1662041247199', 'CC'),
(4, 35, '2003-05-15', '1662041247199', 'CC'),
(5, 23, '2004-05-06', '1668040515399', 'CC'),
(6, 22, '2012-05-06', '1662101568299', 'CC'),
(7, 44, '2013-05-06', '1694050100899', 'CC'),
(8, 33, '2014-05-06', '1628012272099', 'CC'),
(9, 100, '2015-05-06', '1608051762299', 'CC'),
(10, 120, '2016-05-06', '1670072699699', 'CC'),
(11, 33, '2017-05-06', '1676090228999', 'CC'),
(12, 200, '2018-05-06', '1623083099799', 'CC'),
(13, 2, '2018-10-06', '1687060309399', 'CC'),
(14, 20, '2018-01-06', '1654011145999', 'CC'),
(15, 203, '2018-01-07', '1692090422599', 'CC'),
(16, 3, '2019-01-07', '1624060419399', 'CC'),
(17, 5, '2020-01-09', '1651011048199', 'CC'),
(18, 15, '2021-01-09', '1680091992499 ', 'CC'),
(19, 22, '2021-01-10', '1691012831199 ', 'CC'),
(20, 2, '2021-01-04', '1698091149999 ', 'CC'),
(22, 2, '2020-10-17', '3', 'CC'),
(25, 2, '2020-10-17', '4', 'CC'),
(26, 2, '2020-10-17', '5', 'CC'),
(27, 2, '2020-10-17', '6', 'CC'),
(28, 2, '2020-11-15', '1234', 'CC'),
(29, 2, '2020-11-15', '111', 'CC'),
(30, 2, '2020-11-16', '5', 'CC');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `ID_rol_n` int(11) NOT NULL,
  `nom_rol` varchar(25) NOT NULL,
  `acronimo` varchar(5) NOT NULL,
  `permisos` varchar(300) NOT NULL,
  `token` varchar(300) NOT NULL,
  `FK_not` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`ID_rol_n`, `nom_rol`, `acronimo`, `permisos`, `token`, `FK_not`) VALUES
(1, 'Administrador', 'A', '01,0101,0102,0103,0104,02,0201,0202,0203,0204,0205,0206,0207,0208,0209,0210,03,0301,0302,0303,04,0401,0402,0403,0404,0405,0406,05', '', NULL),
(2, 'Bodega', 'B', '01,0101,0102,02,03,0301,0302,0303,0304,0305,0306,04,0401,0402,0403,0404,05', '', NULL),
(3, 'Supervisor', 'S', '01,0101,0102,02,04,0401,0402,05,0501,0502,0503,06', '', NULL),
(4, 'Ventas', 'V', '01,0101,0102,02,03,0301,0302,0303,0305,04,0401,0402,0403,05', '', NULL),
(5, 'Proveedor', 'P', '01,0101,0102,02,03,04,05', '', NULL),
(6, 'Cliente', 'C', '01,0101,0102,02,03,04,05', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `FK_rol` int(3) NOT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rol_usuario`
--

INSERT INTO `rol_usuario` (`FK_rol`, `FK_us`, `FK_tipo_doc`, `fecha_asignacion`, `estado`) VALUES
(1, '1', 'CC', '2020-10-17', '1'),
(1, '1033710734', 'CC', '2020-10-15', '1'),
(1, '1234', 'CC', '2020-11-15', '0'),
(1, '1636012383599', 'CE', '2019-02-17', '1'),
(1, '1691012831199', 'CC', '2019-08-16', '1'),
(1, '1698091149999', 'CC', '2019-01-24', '1'),
(1, '2244', 'CC', '2020-10-11', '0'),
(1, '765', 'CC', '2020-10-12', '0'),
(2, '1133', 'CC', '2020-10-11', '0'),
(2, '1624060419399', 'CC', '2019-03-02', '1'),
(2, '1654011145999', 'CC', '2019-04-05', '1'),
(2, '1660062872399', 'CC', '2019-08-06', '0'),
(2, '1662041247199', 'CC', '2018-12-28', '0'),
(2, '1692090422599', 'CC', '2018-12-17', '1'),
(2, '1695062224499', 'CE', '2018-01-12', '0'),
(2, '2', 'CC', '2020-10-17', '1'),
(2, '9', 'CC', '2020-10-12', '0'),
(3, '1662101568299', 'CC', '2018-11-19', '1'),
(3, '3', 'CC', '2020-10-17', '1'),
(4, '10', 'CC', '2020-10-12', '0'),
(4, '1608051762299', 'CC', '2019-05-16', '1'),
(4, '1623083099799', 'CC', '2019-03-05', '1'),
(4, '1628012272099', 'CC', '2019-03-25', '1'),
(4, '1651011048199', 'CC', '2019-10-21', '1'),
(4, '1668040515399', 'CC', '2019-02-13', '0'),
(4, '1670072699699', 'CC', '2019-08-10', '1'),
(4, '1676090228999', 'CC', '2019-05-20', '1'),
(4, '1680091992499', 'CC', '2019-02-18', '1'),
(4, '1687060309399', 'CC', '2019-09-25', '1'),
(4, '1694050100899', 'CC', '2019-05-13', '1'),
(4, '4', 'CC', '2020-10-17', '1'),
(5, '5', 'CC', '2020-10-17', '1'),
(6, '111', 'CC', '2020-11-15', '0'),
(6, '6', 'CC', '2020-10-17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `servidor_correo`
--

CREATE TABLE `servidor_correo` (
  `ID_SC` int(11) NOT NULL,
  `tipo_correo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servidor_correo`
--

INSERT INTO `servidor_correo` (`ID_SC`, `tipo_correo`) VALUES
(1, 'Gmail'),
(2, 'yahoo'),
(3, 'Outlook'),
(4, 'hotmail');

-- --------------------------------------------------------

--
-- Table structure for table `telefono`
--

CREATE TABLE `telefono` (
  `ID_tel` int(11) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `CF_us` varchar(25) DEFAULT NULL,
  `CF_tipo_doc` varchar(5) DEFAULT NULL,
  `CF_rut` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telefono`
--

INSERT INTO `telefono` (`ID_tel`, `tel`, `CF_us`, `CF_tipo_doc`, `CF_rut`) VALUES
(8, '+86(473)137-9500', '1636012383599', 'CE', '464978345'),
(9, '386(519)326-3151', '1695062224499', 'CE', '390737614'),
(10, '256 (505) 724-8984', '1662041247199', 'CC', '719875909'),
(11, '36 (728) 143-1515', '1660062872399', 'CC', '759451251'),
(12, '41 (286) 669-9579', '1668040515399', 'CC', '684382518'),
(13, '27 (368) 471-4280', '1662101568299', 'CC', '130382612'),
(14, '351 (119) 356-1557', '1694050100899', 'CC', '353721273'),
(15, '7 (262) 871-2576', '1628012272099', 'CC', '178890276'),
(16, '381 (185) 638-3496', '1608051762299', 'CC', '481796032'),
(17, '86 (696) 820-0759', '1670072699699', 'CC', '478267154'),
(18, '95 (545) 769-9359', '1676090228999', 'CC', '769976670'),
(19, '53 (132) 144-3736', '1623083099799', 'CC', '550507862'),
(20, '7 (799) 725-1823', '1687060309399', 'CC', '411070291'),
(21, '62 (278) 290-8760', '1654011145999', 'CC', '647278225'),
(22, '385 (310) 959-9458', '1692090422599', 'CC', '882813547'),
(23, '212 (122) 197-5348', '1624060419399', 'CC', '763011374'),
(24, '63 (377) 587-2050', '1651011048199', 'CC', '296342653'),
(25, '420 (598) 165-5534', '1680091992499', 'CC', '467487188'),
(26, '62 (234) 945-8534', '1691012831199', 'CC', '632873939'),
(27, '62 (829) 578-0489', '1698091149999', 'CC', '784044923'),
(28, '312 577 25 67', '3', NULL, NULL),
(29, '312 674 37 44', '4', NULL, NULL),
(30, '322 577 45 89', '5', NULL, NULL),
(31, '355 986 39 23', '4', NULL, NULL),
(32, '311 376 45 78', '5', NULL, NULL),
(33, '311 577 94 00', '6', NULL, NULL),
(34, 'fdsaf', '1234', NULL, NULL),
(35, 'sadsdaf', '111', NULL, NULL),
(36, '311 567 78 39', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_doc`
--

CREATE TABLE `tipo_doc` (
  `ID_acronimo` varchar(5) NOT NULL,
  `nom_doc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_doc`
--

INSERT INTO `tipo_doc` (`ID_acronimo`, `nom_doc`) VALUES
('CC', 'Cedula'),
('CE', 'Documento de extranjeria'),
('TI', 'Tarjeta de identidad');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_medida`
--

CREATE TABLE `tipo_medida` (
  `ID_medida` int(11) NOT NULL,
  `nom_medida` varchar(35) NOT NULL,
  `acron_medida` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_medida`
--

INSERT INTO `tipo_medida` (`ID_medida`, `nom_medida`, `acron_medida`) VALUES
(1, 'nanometro', 'nn'),
(2, 'milimetro', 'mm'),
(3, 'centimetro', 'cm'),
(4, 'metro', 'mts'),
(5, 'pulgada', 'inch'),
(6, 'Unidad', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_modific`
--

CREATE TABLE `tipo_modific` (
  `ID_t_modific` int(11) NOT NULL,
  `nom_modific` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_modific`
--

INSERT INTO `tipo_modific` (`ID_t_modific`, `nom_modific`) VALUES
(1, 'add_update'),
(2, 'add_delete'),
(3, 'add_insert'),
(4, 'add_update, cuenta de usuario');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_not`
--

CREATE TABLE `tipo_not` (
  `ID_tipo_not` int(11) NOT NULL,
  `nom_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_not`
--

INSERT INTO `tipo_not` (`ID_tipo_not`, `nom_tipo`) VALUES
(1, 'Activacion cuenta'),
(2, 'Solicitud producto'),
(3, 'Alerta producto agotado'),
(4, 'Informe mensual'),
(5, 'Reporte de ventas mensual'),
(6, 'Ventas muy bajas'),
(7, 'Error persistente en plataforma'),
(8, 'Se elimino producto'),
(9, 'Bloqueo de cuenta por contraseña'),
(10, 'Promociones'),
(11, 'Pedido');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `ID_tipo_pago` int(11) NOT NULL,
  `nom_tipo_pago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_pago`
--

INSERT INTO `tipo_pago` (`ID_tipo_pago`, `nom_tipo_pago`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta credito'),
(3, 'Tarjeta debito'),
(4, 'Bono oferta'),
(5, 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_us` varchar(25) NOT NULL,
  `nom1` varchar(20) NOT NULL,
  `nom2` varchar(20) DEFAULT NULL,
  `ape1` varchar(20) NOT NULL,
  `ape2` varchar(20) DEFAULT NULL,
  `fecha` date NOT NULL,
  `pass` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_us`, `nom1`, `nom2`, `ape1`, `ape2`, `fecha`, `pass`, `foto`, `correo`, `FK_tipo_doc`) VALUES
('1', 'Javier', '', 'Reyes', 'Neira', '2020-10-09', '$2y$10$SQSweKHj3eNarPZAQoEoAuc3ZiKNq1axcrb3aNaXOimBQNFk9yDPW', 'jav.png', 'jav-rn@hotmail.com', 'CC'),
('111', 'David', 'Garzon', 'Perez', 'Perez', '2020-11-02', '$2y$10$/uhh/UKds2VnpSWBJNztzu.k7CuS4lDumxFFNBm/yrI3juZYsUyBi', 'user-icon1.jpg', 'elfabiancho01@gmail.com', 'CC'),
('1234', 'Miguel', 'Daniel', 'Perez', 'Herrera', '2020-12-11', '$2y$10$1fnI32bugk722ZUanQwDDu4PhyQj1eKenbaFkwj5vBP8Ber8atbE6', 'user-icon1.jpg', 'eljav@gmail.com', 'CC'),
('1608051762299', 'Thor Alias', 'hijo de odin ', 'Mayer', 'ragnarok', '1989-04-18', '1234', 'us.png', 'eu.tellus@augue.com', 'CC'),
('1624060419399', 'Carlos', 'Dario', 'Flynn', 'Morris', '1982-07-19', 'PVJ34CMM2DX', 'us.png', 'Curabitur@velitAliquamnisl.edu', 'CC'),
('1628012272099', 'Dacey', 'Chanda', 'Gates', 'Foreman', '1995-09-02', 'MWX02YMX4GM', 'us.png', 'cursus.vestibulum@Vivamusnon.edu', 'CC'),
('1636012383599', 'Irma', 'Rosalyn', 'Mullen', 'Cote', '1990-08-15', 'IKC07VII1NL', 'usm.png', 'pulvinar.arcu.et@Nullatinciduntneque.org', 'CE'),
('1651011048199', 'Rajah', 'Gage', 'Barry', 'Daza', '1987-12-19', 'BSZ77PRI6GH', 'us.png', 'lobortis.Class@egestasurna.ca', 'CC'),
('1654011145999', 'Mollie', 'Jacqueline', 'Murphy', 'Henderson', '1997-12-14', 'KDF36PDZ2DU', 'us.png', 'nisi.magna@Nuncmauris.edu', 'CC'),
('1662041247199', 'Marcela', 'Daniela', 'Morris', 'Howell', '1988-09-19', 'JPC81QFH3JG', 'usm.png', 'Donec.est@temporeratneque.net', 'CC'),
('1662101568299', 'Quin', 'Paki', 'Ford', 'Hahn', '1992-07-28', 'GMU34EQF1NR', 'us.png', 'semper.tellus.id@Proinvelnisl.ca', 'CC'),
('1668040515399', 'Salvador', 'Samuel', 'Stevens', 'Perez', '1995-07-21', 'PWL76KXQ4FG', 'us.png', 'libero.lacus.varius@Quisque.co.uk', 'CC'),
('1676090228999', 'James', 'Oprah', 'Dickerson', 'Turner', '1988-11-25', 'TUB17VSF8MZ', 'us.png', 'ut.molestie@morbitristiquesenectus.co.uk', 'CC'),
('1687060309399', 'Kylynn', 'Aubrey', 'Daniel', NULL, '1990-01-11', 'YDS91KRH4PL', 'us.png', 'mattis@eu.com', 'CC'),
('1694050100899', 'Jeremy', 'Miryam', 'Hahn', 'Trujillo', '1990-04-11', 'SGU29VRZ0IS', 'usm.png', 'nec@adipiscinglobortisrisus.net', 'CC'),
('2', 'Fabian', 'Pepito', 'Perez', 'Del Carmen', '2020-10-23', '$2y$10$tceRlw0LoTN2T.cp/aKv5.ufo.wjhXJi5aaExd4N9QYf6KaBxp.U2', 'RockF.png', 'elfabiancho01@gmail.com', 'CC'),
('3', 'Alejandro', 'Daniel', 'Daza', 'Perez', '2020-10-30', '$2y$10$pxCbE3ot3TRMhaydl5LHxO3v4It4932HWIFbCk1Aywy2D8sodwVCq', 'al.png', 'Alejandro@gmail.com', 'CC'),
('4', 'Francisco', 'Roberto', 'Aguirre', 'Ayala', '2020-10-31', '$2y$10$62YVUv7w3/zPTYWe4SocpePBZ2u6VNk7Yya4qey8XWKmlNFvd44.2', 'usf.png', 'francisco@gmail.com', 'CC'),
('5', 'Pepito', 'Richar', 'Ramirez', 'Daza', '2020-11-06', '$2y$10$sFSjJ2EczPgz16BzzDwPLOoW56p2QjrrLW6bmvFVKmTENotzb7ZVe', 'user-icon1.jpg', 'pepito@gmail.com', 'CC'),
('6', 'Daniela', 'Milena', 'Echeverría', 'Fraga', '2020-10-30', '$2y$10$uJ59CIp7vZSAis30sGG2DOWmM4Huz5716IoQGE34g3ujEtKDTrdPe', 'Us001.jpg', 'mile@gmail.com', 'CC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`ID_barrio`,`FK_localidad`,`FK_ciudad`),
  ADD KEY `FK_Localidad_FK_ciudad` (`FK_localidad`,`FK_ciudad`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_categoria`);

--
-- Indexes for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_ciudad`);

--
-- Indexes for table `det_factura`
--
ALTER TABLE `det_factura`
  ADD PRIMARY KEY (`FK_det_factura`,`FK_det_prod`),
  ADD KEY `FK_det_factura_1` (`FK_det_prod`),
  ADD KEY `CF_us_CF_tipo_doc` (`CF_us`,`CF_tipo_doc`);

--
-- Indexes for table `det_orden`
--
ALTER TABLE `det_orden`
  ADD PRIMARY KEY (`FK_ord`,`FK_prod`),
  ADD KEY `FK_prod` (`FK_prod`);

--
-- Indexes for table `det_producto`
--
ALTER TABLE `det_producto`
  ADD PRIMARY KEY (`FK_prod`,`FK_rut`),
  ADD KEY `FK_rut` (`FK_rut`);

--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_dir`,`FK_barrio`,`FK_Localidad`,`FK_Ciudad`),
  ADD KEY `CF_us_CF_tipo_doc_2` (`CF_us`,`CF_tipo_doc`),
  ADD KEY `CF_rut_1` (`CF_rut`),
  ADD KEY `FK_barrio_FK_Localidad_FK_Ciudad` (`FK_barrio`,`FK_Localidad`,`FK_Ciudad`);

--
-- Indexes for table `empresa_provedor`
--
ALTER TABLE `empresa_provedor`
  ADD PRIMARY KEY (`ID_rut`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_factura`),
  ADD KEY `tipo_pago` (`FK_c_tipo_pago`);

--
-- Indexes for table `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`ID_localidad`,`FK_ciudad`),
  ADD KEY `FK_ciudad` (`FK_ciudad`);

--
-- Indexes for table `log_error`
--
ALTER TABLE `log_error`
  ADD PRIMARY KEY (`ID_error`);

--
-- Indexes for table `modific`
--
ALTER TABLE `modific`
  ADD PRIMARY KEY (`ID_modifc`),
  ADD KEY `FK_tipo_doc_modific` (`FK_us`,`FK_doc`),
  ADD KEY `FK_modific` (`FK_modific`);

--
-- Indexes for table `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`ID_not`),
  ADD KEY `FK_rol_notificacion` (`FK_rol`),
  ADD KEY `FK_tipo_notificacion` (`FK_not`);

--
-- Indexes for table `orden_entrada`
--
ALTER TABLE `orden_entrada`
  ADD PRIMARY KEY (`ID_ord`),
  ADD KEY `CF_rol_CF_rol_us_CF_tipo_doc` (`CF_rol`,`CF_rol_us`,`CF_tipo_doc`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_prod`),
  ADD KEY `CF_categoria` (`CF_categoria`),
  ADD KEY `CF_tipo_medida` (`CF_tipo_medida`);

--
-- Indexes for table `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`Id_puntos`,`FK_us`,`FK_tipo_doc`),
  ADD KEY `FK_tipo_doc_puntos` (`FK_us`,`FK_tipo_doc`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_rol_n`);

--
-- Indexes for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`FK_rol`,`FK_us`,`FK_tipo_doc`),
  ADD KEY `FK_us_FK_tipo_doc` (`FK_us`,`FK_tipo_doc`);

--
-- Indexes for table `servidor_correo`
--
ALTER TABLE `servidor_correo`
  ADD PRIMARY KEY (`ID_SC`);

--
-- Indexes for table `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`ID_tel`),
  ADD KEY `CF_us_CF_tipo_doc_1` (`CF_us`,`CF_tipo_doc`),
  ADD KEY `CF_rut` (`CF_rut`);

--
-- Indexes for table `tipo_doc`
--
ALTER TABLE `tipo_doc`
  ADD PRIMARY KEY (`ID_acronimo`);

--
-- Indexes for table `tipo_medida`
--
ALTER TABLE `tipo_medida`
  ADD PRIMARY KEY (`ID_medida`);

--
-- Indexes for table `tipo_modific`
--
ALTER TABLE `tipo_modific`
  ADD PRIMARY KEY (`ID_t_modific`);

--
-- Indexes for table `tipo_not`
--
ALTER TABLE `tipo_not`
  ADD PRIMARY KEY (`ID_tipo_not`);

--
-- Indexes for table `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`ID_tipo_pago`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_us`,`FK_tipo_doc`),
  ADD KEY `FK_tipo_doc` (`FK_tipo_doc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barrio`
--
ALTER TABLE `barrio`
  MODIFY `ID_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ID_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID_dir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `localidad`
--
ALTER TABLE `localidad`
  MODIFY `ID_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `log_error`
--
ALTER TABLE `log_error`
  MODIFY `ID_error` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modific`
--
ALTER TABLE `modific`
  MODIFY `ID_modifc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orden_entrada`
--
ALTER TABLE `orden_entrada`
  MODIFY `ID_ord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `puntos`
--
ALTER TABLE `puntos`
  MODIFY `Id_puntos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_rol_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `servidor_correo`
--
ALTER TABLE `servidor_correo`
  MODIFY `ID_SC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `telefono`
--
ALTER TABLE `telefono`
  MODIFY `ID_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tipo_medida`
--
ALTER TABLE `tipo_medida`
  MODIFY `ID_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipo_modific`
--
ALTER TABLE `tipo_modific`
  MODIFY `ID_t_modific` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipo_not`
--
ALTER TABLE `tipo_not`
  MODIFY `ID_tipo_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `ID_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `FK_Localidad_FK_ciudad` FOREIGN KEY (`FK_localidad`,`FK_ciudad`) REFERENCES `localidad` (`ID_localidad`, `FK_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `det_factura`
--
ALTER TABLE `det_factura`
  ADD CONSTRAINT `CF_us_CF_tipo_doc` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_det_factura` FOREIGN KEY (`FK_det_factura`) REFERENCES `factura` (`ID_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_det_factura_1` FOREIGN KEY (`FK_det_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `det_orden`
--
ALTER TABLE `det_orden`
  ADD CONSTRAINT `FK_ord` FOREIGN KEY (`FK_ord`) REFERENCES `orden_entrada` (`ID_ord`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prod` FOREIGN KEY (`FK_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `det_producto`
--
ALTER TABLE `det_producto`
  ADD CONSTRAINT `FK_prod_1` FOREIGN KEY (`FK_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rut` FOREIGN KEY (`FK_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `CF_rut_1` FOREIGN KEY (`CF_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_us_CF_tipo_doc_2` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_barrio_FK_Localidad_FK_Ciudad` FOREIGN KEY (`FK_barrio`,`FK_Localidad`,`FK_Ciudad`) REFERENCES `barrio` (`ID_barrio`, `FK_localidad`, `FK_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `tipo_pago` FOREIGN KEY (`FK_c_tipo_pago`) REFERENCES `tipo_pago` (`ID_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `FK_ciudad` FOREIGN KEY (`FK_ciudad`) REFERENCES `ciudad` (`ID_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modific`
--
ALTER TABLE `modific`
  ADD CONSTRAINT `FK_modific` FOREIGN KEY (`FK_modific`) REFERENCES `tipo_modific` (`ID_t_modific`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipo_doc_modific` FOREIGN KEY (`FK_us`,`FK_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `FK_rol_notificacion` FOREIGN KEY (`FK_rol`) REFERENCES `rol` (`ID_rol_n`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipo_notificacion` FOREIGN KEY (`FK_not`) REFERENCES `tipo_not` (`ID_tipo_not`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orden_entrada`
--
ALTER TABLE `orden_entrada`
  ADD CONSTRAINT `CF_rol_CF_rol_us_CF_tipo_doc` FOREIGN KEY (`CF_rol`,`CF_rol_us`,`CF_tipo_doc`) REFERENCES `rol_usuario` (`FK_rol`, `FK_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `CF_categoria` FOREIGN KEY (`CF_categoria`) REFERENCES `categoria` (`ID_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_tipo_medida` FOREIGN KEY (`CF_tipo_medida`) REFERENCES `tipo_medida` (`ID_medida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `FK_tipo_doc_puntos` FOREIGN KEY (`FK_us`,`FK_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `FK_rol` FOREIGN KEY (`FK_rol`) REFERENCES `rol` (`ID_rol_n`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_us_FK_tipo_doc` FOREIGN KEY (`FK_us`,`FK_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `CF_rut` FOREIGN KEY (`CF_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_us_CF_tipo_doc_1` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_tipo_doc` FOREIGN KEY (`FK_tipo_doc`) REFERENCES `tipo_doc` (`ID_acronimo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
