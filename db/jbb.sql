-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2021 a las 15:09:35
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jbb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(10) NOT NULL,
  `numero_inventario` varchar(10) NOT NULL,
  `fk_id_dependencia` int(10) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `numero_serial` varchar(30) NOT NULL,
  `fk_id_tipo_equipo` int(1) NOT NULL,
  `estado_equipo` tinyint(1) NOT NULL COMMENT '1:Activo;2:Inactivo',
  `observacion` text NOT NULL,
  `qr_code_img` varchar(250) NOT NULL,
  `qr_code_encryption` varchar(60) NOT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `valor_comercial` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `numero_inventario`, `fk_id_dependencia`, `marca`, `modelo`, `numero_serial`, `fk_id_tipo_equipo`, `estado_equipo`, `observacion`, `qr_code_img`, `qr_code_encryption`, `fecha_adquisicion`, `valor_comercial`) VALUES
(1, '14853', 7, 'Chevrolet ', '2017', '3GNFL7E51HS559955', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/1_qr_code.png', '1FDs8vd21acPIz8bqrhKApdqdTjuxgBTJrs2eS1UmEwlwiwSdbc', '2016-10-12', 98205975),
(2, '14854', 7, 'Nissan', '2017', '3N6CD33B2ZK365122', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/2_qr_code.png', '2jnpWRXLbDdCG8v9QrKJGlR84UXIKqzkhNH9CLm7eScoSMxWn0k', '2016-10-12', 106070140),
(3, '16901', 7, 'Toyota', '2007', '9FH11UJ9079012119', 1, 1, 'Inventario Yezid', 'images/equipos/QR/3_qr_code.png', '3e0L1EUhaZIM0OZ9tdkon8brO7Auo7jL58GE7wg6V1GvqFwinHb', '2006-10-12', 35550000),
(4, '16989', 7, 'Toyota- Hilux', '1996', 'RN1067012769', 1, 1, 'Inventario Yezid', 'images/equipos/QR/4_qr_code.png', '4XnvRyFKtJVZPPzzyRdPYzr1QkgpYtoP0kENJh5D8mQHESej8y4', '1995-10-12', 5400000),
(5, '17129', 7, 'Volkswagen', '2018', '9536G8247JR812344', 1, 1, 'Inventario Yezid', 'images/equipos/QR/5_qr_code.png', '5PiIEUliY7PzZdS0ZDyUCaMNPfv25S1wQ1AlKAwxMlrdNH3N4mM', '2017-10-12', 145443776),
(6, '17710', 7, 'Renault', '2020', '93YMAF4CELJ079626', 1, 1, 'Inventario Yezid', 'images/equipos/QR/6_qr_code.png', '6jxt7Cevdl0j5MHgHuUZh93iOWBxbOTTyXG1FHKKaJuLBwasNvY', '2019-10-12', 252542668),
(7, '17615', 7, 'Chevrolet ', '2020', '9GDFVR345LB008406', 1, 1, 'Inventaro Yezid', 'images/equipos/QR/7_qr_code.png', '7sVXiSAcnge43sw3X0d1p4N8IHCo4LLAlN5cfX5ZRz6kuvJgAc0', '2019-10-12', 215769798),
(8, 'JBB-210002', 7, 'IHM Ignacio Gomez', '15H - 2 4 - Bomba Centrifuga', '97500330', 2, 1, 'Requiere cambió de tablero. La tubería de descarga presenta fuga, requiere cambio de todos los acoples de descarga. Requiere nueva base de soporte.						\r\n						\r\n						', 'images/equipos/QR/8_qr_code.png', '8o55FZnUiVhnFLtO0Jjvg22gMuuvdhVNuo5ukma8YWP2Ba9Plpq', '1989-10-12', 0),
(9, 'JBB-210001', 7, 'Pedrollo', 'CP 21OC - Bomba Centrifuga', '03-15', 2, 1, 'Se encuentra embebida en el concreto, por lo cúal no es posible desmontar. En caso de un correctivo es necesario demoler la base. En el momento no presenta inconvenientes.			\r\n			', 'images/equipos/QR/9_qr_code.png', '9yco2AL3eLHezXBQkPUqqmVGMCEEaDsX0Sq1NDMoDpS8TQxXBn5', '1989-10-12', 0),
(10, 'JBB-210003', 7, 'Pedrollo', 'Dm 20 N - Bomba Sumergible', '100522', 2, 1, 'Requiere embobinado nuevo', 'images/equipos/QR/10_qr_code.png', '10ofiGdyY9pVD6clvzxPHYk4mDakVn67mg6yRlK6wMonBWf1hnZz', '2017-10-12', 0),
(11, 'JBB-210004', 7, 'Pedrollo', 'JC Rm 1B - Bomba centrífuga ', 'Esta borrado', 2, 1, 'Completamente inoperante. Se encuentra totalmente sulfatada. Requiere cambio de capacitor. Embobinado nuevo. Ventilador nuevo. Tornillería nueva', 'images/equipos/QR/11_qr_code.png', '11UUIhnssFMIHN6qK83skU61GCQVfkT6PDnY1wBe3CPevu5Ywt6r', '2014-10-12', 0),
(12, 'JBB-210005', 7, 'Altamira (no verifi)', 'Se desconoce', 'Se desconoce', 2, 1, '', 'images/equipos/QR/12_qr_code.png', '12yWLEH7E1LN91xRJJJrbLLRWA0ZMGt737bimakfMpNT8Jgw8y3W', '2016-10-12', 0),
(13, 'JBB-210006', 7, 'Altamira', 'MSQA4 23230', '2200007892-0148', 2, 1, 'Bomba inactica. Sistema electrónico completo. Bomba fuera de servicio. Requiere cambio de motor.', 'images/equipos/QR/13_qr_code.png', '13tZiwQ19BfJvn9BT7mWFVJA8LzNMDgWOEmWu39rVo1D5dG14xad', '2018-10-12', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_control_combustible`
--

CREATE TABLE `equipos_control_combustible` (
  `id_equipo_control_combustible` int(10) NOT NULL,
  `fk_id_equipo_combustible` int(10) NOT NULL,
  `kilometros_actuales` varchar(10) NOT NULL,
  `cantidad` varchar(20) NOT NULL,
  `fecha_combustible` datetime NOT NULL,
  `fk_id_operador_combustible` int(10) NOT NULL,
  `tipo_consumo` tinyint(4) NOT NULL,
  `valor` float NOT NULL,
  `labor_realizada` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_detalle_bomba`
--

CREATE TABLE `equipos_detalle_bomba` (
  `id_equipo_detalle_bomba` int(10) NOT NULL,
  `fk_id_equipo_bomba` int(10) NOT NULL,
  `dimension` varchar(50) NOT NULL,
  `motor_frecuencia` varchar(20) NOT NULL,
  `motor_velocidad` varchar(20) NOT NULL,
  `motor_voltaje` varchar(10) NOT NULL,
  `potencia` varchar(10) NOT NULL,
  `consumo` varchar(10) NOT NULL,
  `hmax` varchar(10) NOT NULL,
  `succion` varchar(10) NOT NULL,
  `salida` varchar(30) NOT NULL,
  `qmax` varchar(10) NOT NULL,
  `color` varchar(30) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `caracteristicas` text NOT NULL,
  `condiciones_operacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_detalle_bomba`
--

INSERT INTO `equipos_detalle_bomba` (`id_equipo_detalle_bomba`, `fk_id_equipo_bomba`, `dimension`, `motor_frecuencia`, `motor_velocidad`, `motor_voltaje`, `potencia`, `consumo`, `hmax`, `succion`, `salida`, `qmax`, `color`, `peso`, `caracteristicas`, `condiciones_operacion`) VALUES
(1, 8, '40x25x30 cm', '60 Hz', '3375 rpm', '220 V', '2,4 Hp', '7A', '45 m', '1,5\"', '1,5\"', '90 It/min', 'Naranja', '20 kg', 'En hierro', 'Funciona para succionar agua del reservorio y el túnel de propagación.\r\nSe activa manualmente 3 veces por semana durante una hora. 					'),
(2, 9, '40x25x30 cm', '60 Hz', '3450 rpm', '220 V', '3 Hp', '6,4 A', '45 m', '1,5\"', '1\"', '250 gpm ', 'Azul', '25,3 kg', 'En hierro', 'Funciona para succionar agua del reservorio y regar el invernadero.\r\nSe activa manualmente 3 veces por semana durante una hora. 									\r\n			'),
(3, 10, 'h=34 x d=20 cm', '60 Hz', '3450 rpm ', '220 V', '1 Hp', '5 A', '19 mts', '', '1.5\"', '250 It/min', 'Plata metálico ', '10 kg', 'Bomba sumergible metálica para aguas ligeramente turbias', 'Funciona para evacuar fluidos del biodigestor (posiblemente lixiviados).\r\nNo se encuentra en uso. El biodigestor está fuera de funcionamiento.'),
(4, 11, '37x18x18 cm', '60 Hz', '3455 rpm', '110 V', '0,7 Hp', '6,6 A', '41 m', '1\"', '1\"', '50 It/min', 'Azul', '12 kg', 'En acero', 'La función consiste en circular agua en el sud cerca al lago principal.\r\nTotalmente inoperante. Tablero de encendido sin energía.'),
(5, 12, '', '60 Hz', '', '', 'Hp', '', '', 'N.A.', '1\"', 'gpm', 'Metálico', 'kg', 'En acero', 'Funciona evacuar las aguas que recibe de la zona y regar el herbal (función que no realiza).\r\nPermanece inundada. Requiere de otros equipos para poder evacuar el agua.'),
(6, 13, 'h= 1m x d= 10cm', '60 Hz', '3450rpm', '230V', '2 Hp', '7,6 A', '150m', 'N.A.', '4\"', '', 'Metálico', '15 kg', 'En acero\r\nBomba sumergible tipo bala', 'Funciona para regar el sector de páramo (función que no realiza).\r\nEstos equipo diseñado para operar en condición vertical. Opera en sentido horizontal.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_detalle_vehiculo`
--

CREATE TABLE `equipos_detalle_vehiculo` (
  `id_equipo_detalle_vehiculo` int(10) NOT NULL,
  `fk_id_equipo` int(10) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `linea` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `fk_id_clase_vechiculo` tinyint(1) NOT NULL,
  `fk_id_tipo_carroceria` tinyint(1) NOT NULL,
  `combustible` tinyint(1) NOT NULL COMMENT '1:Gasolina; 2: Diesel',
  `capacidad` varchar(20) NOT NULL,
  `servicio` varchar(20) NOT NULL,
  `numero_motor` varchar(30) NOT NULL,
  `multas` tinyint(1) NOT NULL COMMENT '1:Si; 2:No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_detalle_vehiculo`
--

INSERT INTO `equipos_detalle_vehiculo` (`id_equipo_detalle_vehiculo`, `fk_id_equipo`, `placa`, `linea`, `color`, `fk_id_clase_vechiculo`, `fk_id_tipo_carroceria`, `combustible`, `capacidad`, `servicio`, `numero_motor`, `multas`) VALUES
(2, 3, 'OBI160', 'Land Cruiser', 'Blanco Artico', 2, 3, 1, '5 personas', 'Oficial', '3433948', 2),
(3, 1, 'OKZ805', 'Captiva Sport', 'Gris mercurio', 1, 1, 1, '5 pasajeros', 'Oficial', 'CHS559955', 2),
(4, 2, 'OKZ764', 'NP300 FRONTIER', 'Blanco', 1, 2, 2, '5 pasajeros', 'Oficial', 'YD25-648189P', 2),
(5, 4, 'BHH611', 'Hilux', 'Roja Bordeaux perlad', 1, 2, 1, '6 personas ', 'Oficial', '4160354', 2),
(6, 5, 'OLO377', 'Constellation-31-330', 'Blanco Geada', 3, 4, 2, '10000 Kg/P', 'Oficial', '0154865A174859', 2),
(7, 6, 'GCW769', 'Nuevo Master', 'Blanco Calma', 4, 5, 1, '20', 'Oficial', 'M9TC678C031094', 2),
(8, 7, 'GCW724', 'FVR', 'Blanco Calma', 5, 6, 2, '2', 'Oficial', '6HK1-224577', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_fotos`
--

CREATE TABLE `equipos_fotos` (
  `id_equipo_foto` int(10) NOT NULL,
  `fk_id_equipo_foto` int(10) NOT NULL,
  `fk_id_user_ef` int(10) NOT NULL,
  `equipo_foto` varchar(250) NOT NULL,
  `fecha_foto` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_fotos`
--

INSERT INTO `equipos_fotos` (`id_equipo_foto`, `fk_id_equipo_foto`, `fk_id_user_ef`, `equipo_foto`, `fecha_foto`, `descripcion`) VALUES
(2, 1, 0, 'images/equipos/1.PNG', '2020-12-16', ''),
(3, 1, 1, 'images/equipos/formulario_equipos.png', '2021-01-19', 'Imagen principal'),
(4, 11, 1, 'images/equipos/SUDS_1.png', '2021-01-22', 'Imagen principal'),
(5, 12, 1, 'images/equipos/SUDS_2.png', '2021-01-22', 'Imagen principal'),
(6, 13, 1, 'images/equipos/SUDS_3.png', '2021-01-22', 'Imagen principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_localizacion`
--

CREATE TABLE `equipos_localizacion` (
  `id_equipo_localizacion` int(10) NOT NULL,
  `fk_id_equipo_localizacion` int(10) NOT NULL,
  `fk_id_user_localizacion` int(10) NOT NULL,
  `localizacion` varchar(200) NOT NULL,
  `fecha_localizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_localizacion`
--

INSERT INTO `equipos_localizacion` (`id_equipo_localizacion`, `fk_id_equipo_localizacion`, `fk_id_user_localizacion`, `localizacion`, `fecha_localizacion`) VALUES
(1, 1, 0, 'Ibague- Barrio palermo - Manzana 8', '2020-12-24'),
(2, 1, 0, 'Bogotá - Jardin Botanico', '2020-12-18'),
(3, 1, 0, 'Taller del centro - CAD', '2021-01-19'),
(4, 1, 1, 'Jardín Botánico', '2021-01-19'),
(5, 9, 1, 'Cuarto junto al reservorio detrás del túnel de propagación', '2020-10-02'),
(6, 8, 1, 'Cuarto junto al reservorio detrás del tunel de propagación', '2020-10-12'),
(7, 10, 1, 'Zona de Compostaje, biodigestor.', '2020-01-21'),
(8, 11, 1, 'Sud Cerca al lago principal', '2020-02-27'),
(9, 12, 1, 'Sud Herbal', '2020-02-26'),
(10, 13, 1, 'Sud páramo', '2020-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_poliza`
--

CREATE TABLE `equipos_poliza` (
  `id_equipo_poliza` int(10) NOT NULL,
  `fk_id_equipo_poliza` int(10) NOT NULL,
  `fk_id_user_poliza` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_poliza` varchar(30) NOT NULL,
  `estado_poliza` tinyint(4) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspection_vehiculos`
--

CREATE TABLE `inspection_vehiculos` (
  `id_inspection_vehiculos` int(10) NOT NULL,
  `fk_id_user_responsable` int(10) NOT NULL,
  `fk_id_equipo_vehiculo` int(10) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `horas_actuales_vehiculo` int(10) NOT NULL,
  `radiador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_refrigeracion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tension_correa_ventilacion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `manometro_temperatura` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `persiana` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `signature` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `tanque_combustible` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tuberia_baja_presion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `grifo` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `vaso_sedimentacion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_aire` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_combustible` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `prefiltro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `filtro_aire_tipo_seco` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pre_calentador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `acelerador_manual` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `acelerador_aire` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `ahogador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `consumo_acpm` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapon_carter` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_motor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `presion_aceite_motor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador_presion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_drenaje_caja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bombillo_tablero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bomba_hidraulica` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_electrolito` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bornes_bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `terminales` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `seguro_bateria` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `caja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_celdas` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `conexiones_alternador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `regulador_corriente` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `indicador_tablero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `luz_testigo` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `horometro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `interruptor` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `farolas_delanteras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `farolas_traseras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pedal_embrague` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tolerancia_pedal` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `engrase_sistema` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_baja` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_alta` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `selector_velocidad` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `esfera_palanca` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `barra_tiro` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bloqueador` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_diferencial` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta_diferencial` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pesas_delanteras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pesas_traseras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `pernos_delanteros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_control_posicion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `palanca_control_automatico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `nivel_aceite_hidraulico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `bayoneta_hidraulico` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tuberia_conduccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `radiador_enfriado` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `brazos_levante` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `cadenas_tensoras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `mangueras` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tonillo_nivelados` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `guardafangos` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `asiento` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `capot` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `caja_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `brazo_direccion` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `barra_principal` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `soporte_delantero` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tolerancia_frenos` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `freno_mano` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `tapa_rueda_delantera` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `rines_traseros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A',
  `rines_delanteros` tinyint(1) NOT NULL COMMENT '0:Mal Estado; 1:Buen estado; 99:N/A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_correctivo`
--

CREATE TABLE `mantenimiento_correctivo` (
  `id_correctivo` int(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `fk_id_equipo_correctivo` int(10) NOT NULL,
  `fk_id_user_correctivo` int(10) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `consideracion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_correctivo`
--

INSERT INTO `mantenimiento_correctivo` (`id_correctivo`, `fecha`, `fk_id_equipo_correctivo`, `fk_id_user_correctivo`, `descripcion`, `consideracion`, `estado`) VALUES
(1, '2021-01-26 21:11:57', 4, 1, 'El motor no arranca', 'Revisar con el fabricante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_correctivo_fotos`
--

CREATE TABLE `mantenimiento_correctivo_fotos` (
  `id_foto_danio` int(10) NOT NULL,
  `fk_id_correctivo` int(10) NOT NULL,
  `ruta_foto` varchar(250) NOT NULL,
  `fecha_foto_danio` date NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_preventivo`
--

CREATE TABLE `mantenimiento_preventivo` (
  `id_preventivo` int(10) NOT NULL,
  `fk_id_tipo_equipo_preventivo` int(1) NOT NULL,
  `fk_id_frecuencia` int(10) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_preventivo`
--

INSERT INTO `mantenimiento_preventivo` (`id_preventivo`, `fk_id_tipo_equipo_preventivo`, `fk_id_frecuencia`, `descripcion`, `estado`) VALUES
(1, 1, 1, 'algo', 1),
(2, 2, 1, 'algo mas', 1),
(3, 2, 4, 'pruebas de guardado', 1),
(4, 1, 7, 'mas pruebas', 1),
(5, 2, 5, 'ultima prueba', 1),
(6, 1, 7, 'otra mas', 1),
(7, 3, 4, 'Prueba Mensual', 1),
(8, 2, 4, 'Limpieza general', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `id_orden_trabajo` int(10) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `fk_id_mantenimiento` int(10) NOT NULL,
  `tipo_mantenimiento` tinyint(4) NOT NULL COMMENT '1:Correctivo;2:Preventivo',
  `fk_id_user_orden` int(10) NOT NULL,
  `fk_id_user_encargado` int(10) NOT NULL,
  `informacion_adicional` text NOT NULL,
  `ultimo_estado` int(1) NOT NULL COMMENT '1:Asignada;2:Solucionada;3:Cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_trabajo`
--

INSERT INTO `orden_trabajo` (`id_orden_trabajo`, `fecha_asignacion`, `fk_id_mantenimiento`, `tipo_mantenimiento`, `fk_id_user_orden`, `fk_id_user_encargado`, `informacion_adicional`, `ultimo_estado`) VALUES
(1, '2021-01-27', 1, 1, 1, 4, 'Primer registro de una orden trabajo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo_estado`
--

CREATE TABLE `orden_trabajo_estado` (
  `id_orden_trabajo_estado` int(10) NOT NULL,
  `fk_id_orden_trabajo_estado` int(10) NOT NULL,
  `fk_id_user_ote` int(10) NOT NULL,
  `fecha_registro_estado` datetime NOT NULL,
  `informacion_adicional_estado` text NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_clase_vehiculo`
--

CREATE TABLE `param_clase_vehiculo` (
  `id_clase_vechiculo` tinyint(1) NOT NULL,
  `clase_vehiculo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_clase_vehiculo`
--

INSERT INTO `param_clase_vehiculo` (`id_clase_vechiculo`, `clase_vehiculo`) VALUES
(1, 'Camioneta'),
(2, 'Campero'),
(3, 'Volqueta '),
(4, 'Van'),
(5, 'Camión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_dependencias`
--

CREATE TABLE `param_dependencias` (
  `id_dependencia` int(10) NOT NULL,
  `dependencia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_dependencias`
--

INSERT INTO `param_dependencias` (`id_dependencia`, `dependencia`) VALUES
(1, 'Dirección'),
(2, 'Oficina Asesora Jurídica'),
(3, 'Oficina de Control Interno'),
(4, 'Oficina Asesora de Planeación'),
(5, 'Secretaría General y de Control Disciplinario'),
(6, 'Subdirección Científica'),
(7, 'Subdirección Técnica Operativa'),
(8, 'Oficina de Arborización Urbana'),
(9, 'Subdirección Educativa y Cultural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_frecuencia`
--

CREATE TABLE `param_frecuencia` (
  `id_frecuencia` int(10) NOT NULL,
  `frecuencia` varchar(50) CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `param_frecuencia`
--

INSERT INTO `param_frecuencia` (`id_frecuencia`, `frecuencia`, `estado`) VALUES
(1, 'Diaria', 1),
(2, 'Semanal', 1),
(3, 'Quincenal', 1),
(4, 'Mensual', 1),
(5, 'Trimestral', 1),
(6, 'Semestral', 1),
(7, 'Anual', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu`
--

CREATE TABLE `param_menu` (
  `id_menu` int(3) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_url` varchar(200) NOT NULL DEFAULT '0',
  `menu_icon` varchar(50) NOT NULL,
  `menu_order` int(1) NOT NULL,
  `menu_type` tinyint(1) NOT NULL COMMENT '1:Left; 2:Top',
  `menu_state` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active; 2:Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu`
--

INSERT INTO `param_menu` (`id_menu`, `menu_name`, `menu_url`, `menu_icon`, `menu_order`, `menu_type`, `menu_state`) VALUES
(1, 'Configuración', '', 'fa-gear', 2, 2, 1),
(2, '', '', 'fa-user', 6, 2, 1),
(3, 'Equipos', '', 'fa-truck', 1, 2, 1),
(4, 'Administrar acceso sistema', '', 'fa-cogs', 5, 2, 1),
(5, 'Dashboard ADMIN', 'dashboard/admin', 'fa-dashboard', 1, 1, 1),
(6, 'Manuales', '', 'fa-book ', 4, 2, 1),
(7, 'Mantenimiento', '', 'fa-wrench', 3, 1, 1),
(8, 'Calendario', 'dashboard/calendar', 'fa-calendar', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_access`
--

CREATE TABLE `param_menu_access` (
  `id_access` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `fk_id_link` int(3) NOT NULL,
  `fk_id_role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_access`
--

INSERT INTO `param_menu_access` (`id_access`, `fk_id_menu`, `fk_id_link`, `fk_id_role`) VALUES
(14, 1, 4, 1),
(1, 1, 4, 99),
(15, 1, 5, 1),
(2, 1, 5, 99),
(16, 1, 6, 1),
(3, 1, 6, 99),
(34, 2, 19, 1),
(28, 2, 19, 99),
(35, 2, 20, 1),
(29, 2, 20, 99),
(36, 2, 21, 1),
(30, 2, 21, 99),
(37, 2, 22, 1),
(31, 2, 22, 99),
(18, 3, 7, 1),
(7, 3, 7, 99),
(38, 3, 17, 1),
(26, 3, 17, 99),
(39, 3, 18, 1),
(27, 3, 18, 99),
(4, 4, 1, 99),
(5, 4, 2, 99),
(6, 4, 3, 99),
(9, 4, 8, 99),
(10, 4, 9, 99),
(17, 5, 0, 1),
(20, 5, 0, 99),
(25, 6, 12, 1),
(11, 6, 12, 99),
(12, 6, 13, 99),
(13, 6, 14, 99),
(23, 7, 15, 1),
(21, 7, 15, 99),
(33, 8, 0, 1),
(32, 8, 0, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_menu_links`
--

CREATE TABLE `param_menu_links` (
  `id_link` int(3) NOT NULL,
  `fk_id_menu` int(3) NOT NULL,
  `link_name` varchar(100) NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `link_icon` varchar(50) NOT NULL,
  `order` int(1) NOT NULL,
  `date_issue` datetime NOT NULL,
  `link_state` tinyint(1) NOT NULL COMMENT '1:Active;2:Inactive',
  `link_type` tinyint(1) NOT NULL COMMENT '1:System URL;2:Complete URL; 3:Divider; 4:Complete URL, Videos; 5:Complete URL, Manuals'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_menu_links`
--

INSERT INTO `param_menu_links` (`id_link`, `fk_id_menu`, `link_name`, `link_url`, `link_icon`, `order`, `date_issue`, `link_state`, `link_type`) VALUES
(1, 4, 'Enlaces Menú', 'access/menu', 'fa-link', 1, '2020-11-18 19:45:31', 1, 1),
(2, 4, 'Enlaces Submenú', 'access/links', 'fa-link', 2, '2020-11-18 19:45:31', 1, 1),
(3, 4, 'Acceso Roles', 'access/role_access', 'fa-puzzle-piece', 4, '2020-11-18 19:45:31', 1, 1),
(4, 1, 'Usuarios', 'settings/employee/1', 'fa-users', 1, '2020-11-19 06:13:07', 1, 1),
(5, 1, '----------', 'DIVIDER', 'fa-hand-o-up', 2, '2020-11-19 07:07:22', 1, 3),
(6, 1, 'Proveedores', 'settings/company', 'fa-building', 3, '2020-11-19 07:08:43', 1, 1),
(7, 3, 'Buscar', 'equipos', 'fa-search', 1, '2020-11-20 01:29:59', 1, 1),
(8, 4, '----------', 'DIVIDER', 'fa-pin', 3, '2020-12-01 17:19:46', 1, 3),
(9, 4, 'Descripción Roles', 'dashboard/rol_info', 'fa-info', 5, '2020-12-01 17:22:23', 1, 1),
(12, 6, 'Manual de Usuario', 'http://[::1]/jbb/files/MANUAL_DE_USUARIO.pdf', 'fa-hand-o-up', 1, '2020-12-01 19:04:26', 1, 5),
(13, 6, 'Cargar Manuales', 'access/manuals', 'fa-book', 25, '2020-12-01 19:10:25', 1, 1),
(14, 6, 'DIVIDER', '----------', 'fa-pin', 24, '2020-12-01 19:11:24', 1, 3),
(15, 7, 'Preventivo', 'mantenimiento/preventivo', 'fa-wrench', 1, '2020-12-11 12:13:55', 1, 1),
(16, 7, 'Correctivo', 'mantenimiento/correctivo', 'fa-wrench', 2, '2020-12-11 12:14:41', 2, 1),
(17, 3, '----------', 'DIVIDER', 'fa_pruebas', 2, '2021-01-15 02:29:48', 1, 3),
(18, 3, 'Equipos Inactivos', 'equipos/inactivos', 'fa-unlink', 3, '2021-01-15 02:32:20', 1, 1),
(19, 2, 'Perfil Usuario', 'usuarios/detalle', 'fa-user', 1, '2021-01-15 03:02:00', 1, 1),
(20, 2, 'Cambiar Contraseña', 'usuarios', 'fa-lock', 2, '2021-01-15 03:07:14', 1, 1),
(21, 2, '----------', 'DIVIDER', 'fa-borrar', 3, '2021-01-15 03:09:40', 1, 3),
(22, 2, 'Salir', 'menu/salir', 'fa-sign-out', 4, '2021-01-15 03:10:36', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_proveedores`
--

CREATE TABLE `param_proveedores` (
  `id_proveedor` int(3) NOT NULL,
  `nombre_proveedor` varchar(120) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `numero_celular` varchar(12) NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_proveedores`
--

INSERT INTO `param_proveedores` (`id_proveedor`, `nombre_proveedor`, `contacto`, `numero_celular`, `email`) VALUES
(1, 'Proveedor', 'Xxxxx Xxxxxxx', '3156666666', 'xxxxxx@xxxx.gov.co');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_role`
--

CREATE TABLE `param_role` (
  `id_role` int(1) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `style` varchar(50) NOT NULL,
  `dashboard_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_role`
--

INSERT INTO `param_role` (`id_role`, `role_name`, `description`, `style`, `dashboard_url`) VALUES
(1, 'Administrador', 'Se encarga de comfiguracion del sistema. Cargar tabla de Usuarios, tabla de proveedores', 'text-warning', 'dashboard/admin'),
(2, 'Usuario Consulta', 'Solo tiene acceso a ver información en el sistema. No puede editar ni adicionar nada.', 'text-green', 'dashboard/encargado'),
(3, 'Encargado', 'Usuarios que van a realizar el mantenimiento a los equipos.', 'text-danger', 'dashboard/encargado'),
(4, 'Supervisor', 'Carga en el sistema el plan de mantenimiento, asigna los mantenimientos a los encargados y realiza control de los mantenimientos', 'text-info', 'dashboard/supervisor'),
(5, 'Operador - Conductor', 'Conductores de vehículos, falta definir su rol en el sistema', 'text-violeta', 'dashboard/conductor'),
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema, encargaado de tablas parametricas del sistema', 'text-success', 'dashboard/admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_carroceria`
--

CREATE TABLE `param_tipo_carroceria` (
  `id_tipo_carroceria` tinyint(1) NOT NULL,
  `tipo_carroceria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipo_carroceria`
--

INSERT INTO `param_tipo_carroceria` (`id_tipo_carroceria`, `tipo_carroceria`) VALUES
(1, 'Wagon'),
(2, 'Doble cabina'),
(3, 'Cabinado'),
(4, 'Platon'),
(5, 'Station Wagon'),
(6, 'Volco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipo_equipos`
--

CREATE TABLE `param_tipo_equipos` (
  `id_tipo_equipo` int(1) NOT NULL,
  `tipo_equipo` varchar(50) NOT NULL,
  `formulario_especifico` varchar(50) NOT NULL,
  `metodo_guardar` varchar(50) NOT NULL,
  `enlace_inspeccion` varchar(100) NOT NULL,
  `formulario_inspeccion` varchar(100) NOT NULL,
  `tabla_inspeccion` varchar(100) NOT NULL,
  `id_tabla_inspeccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipo_equipos`
--

INSERT INTO `param_tipo_equipos` (`id_tipo_equipo`, `tipo_equipo`, `formulario_especifico`, `metodo_guardar`, `enlace_inspeccion`, `formulario_inspeccion`, `tabla_inspeccion`, `id_tabla_inspeccion`) VALUES
(1, 'Vehículos', 'equipos_detalle_vehiculo', 'guardarInfoEspecificaVehiculo', '/inspection/add_vehiculos_inspection', 'form_1_vehiculos', 'inspection_vehiculos', 'id_inspection_vehiculos'),
(2, 'Bomba', 'equipos_detalle_bomba', 'guardarInfoEspecificaBomba', '/inspection/add_vehiculos_inspection', '', '', ''),
(3, 'Maquinaria', 'equipos_detalle_vehiculo', 'guardarInfoEspecificaVehiculo', '/inspection/vehiculos', 'form_1_vehiculos', 'inpection_vehiculos', 'id_inspection_vehiculos'),
(4, 'Equipo', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `movil` varchar(12) NOT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT 0 COMMENT '0: newUser; 1:active; 2:inactive',
  `fk_id_user_role` int(1) NOT NULL DEFAULT 7 COMMENT '99: Super Admin;',
  `photo` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `first_name`, `last_name`, `log_user`, `movil`, `email`, `password`, `state`, `fk_id_user_role`, `photo`) VALUES
(1, 'Benjamin', 'Motta', 'Bmottag', '4034089921', 'benmotta@gmail.com', '25446782e2ccaf0afdb03e5d61d0fbb9', 1, 99, 'images/usuarios/thumbs/1.JPG'),
(2, 'Administrador', 'Administrador', 'admin', '234523425', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, 1, ''),
(3, 'Pedro', 'Manrrique', 'pmanrrique', '3015549911', 'pmanrrique@gmail.com', '25f9e794323b453885f5181f1b624d0b', 0, 5, ''),
(4, 'Encargado', 'Encargado', 'encargado', '3156123456', 'encargado@jbb.com.co', 'e10adc3949ba59abbe56e057f20f883e', 0, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_llave_contraseña`
--

CREATE TABLE `usuarios_llave_contraseña` (
  `id_llave` int(10) NOT NULL,
  `fk_id_user_ulc` int(10) NOT NULL,
  `email_user` varchar(70) NOT NULL,
  `llave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `numero_unidad` (`numero_inventario`),
  ADD UNIQUE KEY `qr_code_encryption` (`qr_code_encryption`),
  ADD KEY `estado_equipo` (`estado_equipo`),
  ADD KEY `fk_id_dependencia` (`fk_id_dependencia`) USING BTREE,
  ADD KEY `fk_id_tipo_equipo` (`fk_id_tipo_equipo`);

--
-- Indices de la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  ADD PRIMARY KEY (`id_equipo_control_combustible`),
  ADD KEY `fk_id_equipo_combustible` (`fk_id_equipo_combustible`),
  ADD KEY `fk_id_conductor_combustible` (`fk_id_operador_combustible`);

--
-- Indices de la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  ADD PRIMARY KEY (`id_equipo_detalle_bomba`),
  ADD KEY `fk_id_equipo_bomba` (`fk_id_equipo_bomba`);

--
-- Indices de la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  ADD PRIMARY KEY (`id_equipo_detalle_vehiculo`),
  ADD KEY `fk_id_clase_vechiculo` (`fk_id_clase_vechiculo`),
  ADD KEY `fk_id_tipo_carroceria` (`fk_id_tipo_carroceria`),
  ADD KEY `fk_id_equipo` (`fk_id_equipo`);

--
-- Indices de la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  ADD PRIMARY KEY (`id_equipo_foto`),
  ADD KEY `fk_id_equipo_foto` (`fk_id_equipo_foto`),
  ADD KEY `fk_id_user_ef` (`fk_id_user_ef`);

--
-- Indices de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  ADD PRIMARY KEY (`id_equipo_localizacion`),
  ADD KEY `fk_id_equipo_localizacion` (`fk_id_equipo_localizacion`),
  ADD KEY `fk_id_user_localizacion` (`fk_id_user_localizacion`);

--
-- Indices de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  ADD PRIMARY KEY (`id_equipo_poliza`),
  ADD KEY `fk_id_equipo_poliza` (`fk_id_equipo_poliza`),
  ADD KEY `fk_id_user_poliza` (`fk_id_user_poliza`);

--
-- Indices de la tabla `inspection_vehiculos`
--
ALTER TABLE `inspection_vehiculos`
  ADD PRIMARY KEY (`id_inspection_vehiculos`),
  ADD KEY `fk_id_user_responsable` (`fk_id_user_responsable`),
  ADD KEY `fk_id_equipo_vehiculo` (`fk_id_equipo_vehiculo`);

--
-- Indices de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  ADD PRIMARY KEY (`id_correctivo`),
  ADD KEY `fk_id_equipo` (`fk_id_equipo_correctivo`),
  ADD KEY `fk_id_user_correctivo` (`fk_id_user_correctivo`);

--
-- Indices de la tabla `mantenimiento_correctivo_fotos`
--
ALTER TABLE `mantenimiento_correctivo_fotos`
  ADD PRIMARY KEY (`id_foto_danio`),
  ADD KEY `fk_id_correctivo` (`fk_id_correctivo`);

--
-- Indices de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  ADD PRIMARY KEY (`id_preventivo`),
  ADD KEY `fk_id_tipo_equipo_preventivo` (`fk_id_tipo_equipo_preventivo`),
  ADD KEY `fk_id_frecuencia` (`fk_id_frecuencia`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`id_orden_trabajo`),
  ADD KEY `fk_id_mantenimiento` (`fk_id_mantenimiento`),
  ADD KEY `tipo_mantenimiento` (`tipo_mantenimiento`),
  ADD KEY `fk_id_user_orden` (`fk_id_user_orden`),
  ADD KEY `fk_id_user_encargado` (`fk_id_user_encargado`);

--
-- Indices de la tabla `orden_trabajo_estado`
--
ALTER TABLE `orden_trabajo_estado`
  ADD PRIMARY KEY (`id_orden_trabajo_estado`),
  ADD KEY `fk_id_orden_trabajo_estado` (`fk_id_orden_trabajo_estado`),
  ADD KEY `fk_id_user_ote` (`fk_id_user_ote`);

--
-- Indices de la tabla `param_clase_vehiculo`
--
ALTER TABLE `param_clase_vehiculo`
  ADD PRIMARY KEY (`id_clase_vechiculo`);

--
-- Indices de la tabla `param_dependencias`
--
ALTER TABLE `param_dependencias`
  ADD PRIMARY KEY (`id_dependencia`);

--
-- Indices de la tabla `param_frecuencia`
--
ALTER TABLE `param_frecuencia`
  ADD PRIMARY KEY (`id_frecuencia`);

--
-- Indices de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_type` (`menu_type`);

--
-- Indices de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD PRIMARY KEY (`id_access`),
  ADD UNIQUE KEY `indice_principal` (`fk_id_menu`,`fk_id_link`,`fk_id_role`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `fk_id_role` (`fk_id_role`),
  ADD KEY `fk_id_link` (`fk_id_link`);

--
-- Indices de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD PRIMARY KEY (`id_link`),
  ADD KEY `fk_id_menu` (`fk_id_menu`),
  ADD KEY `link_type` (`link_type`);

--
-- Indices de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `param_role`
--
ALTER TABLE `param_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `param_tipo_carroceria`
--
ALTER TABLE `param_tipo_carroceria`
  ADD PRIMARY KEY (`id_tipo_carroceria`);

--
-- Indices de la tabla `param_tipo_equipos`
--
ALTER TABLE `param_tipo_equipos`
  ADD PRIMARY KEY (`id_tipo_equipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `perfil` (`fk_id_user_role`);

--
-- Indices de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  ADD PRIMARY KEY (`id_llave`),
  ADD KEY `fk_id_user_ulc` (`fk_id_user_ulc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  MODIFY `id_equipo_control_combustible` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  MODIFY `id_equipo_detalle_bomba` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  MODIFY `id_equipo_detalle_vehiculo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  MODIFY `id_equipo_foto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  MODIFY `id_equipo_localizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  MODIFY `id_equipo_poliza` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inspection_vehiculos`
--
ALTER TABLE `inspection_vehiculos`
  MODIFY `id_inspection_vehiculos` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  MODIFY `id_correctivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_correctivo_fotos`
--
ALTER TABLE `mantenimiento_correctivo_fotos`
  MODIFY `id_foto_danio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  MODIFY `id_preventivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  MODIFY `id_orden_trabajo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo_estado`
--
ALTER TABLE `orden_trabajo_estado`
  MODIFY `id_orden_trabajo_estado` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `param_clase_vehiculo`
--
ALTER TABLE `param_clase_vehiculo`
  MODIFY `id_clase_vechiculo` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `param_dependencias`
--
ALTER TABLE `param_dependencias`
  MODIFY `id_dependencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `param_frecuencia`
--
ALTER TABLE `param_frecuencia`
  MODIFY `id_frecuencia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  MODIFY `id_proveedor` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `param_role`
--
ALTER TABLE `param_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `param_tipo_carroceria`
--
ALTER TABLE `param_tipo_carroceria`
  MODIFY `id_tipo_carroceria` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `param_tipo_equipos`
--
ALTER TABLE `param_tipo_equipos`
  MODIFY `id_tipo_equipo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  MODIFY `id_llave` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`fk_id_dependencia`) REFERENCES `param_dependencias` (`id_dependencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`fk_id_tipo_equipo`) REFERENCES `param_tipo_equipos` (`id_tipo_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  ADD CONSTRAINT `equipos_control_combustible_ibfk_1` FOREIGN KEY (`fk_id_equipo_combustible`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  ADD CONSTRAINT `equipos_detalle_bomba_ibfk_1` FOREIGN KEY (`fk_id_equipo_bomba`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_1` FOREIGN KEY (`fk_id_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_2` FOREIGN KEY (`fk_id_tipo_carroceria`) REFERENCES `param_tipo_carroceria` (`id_tipo_carroceria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipos_detalle_vehiculo_ibfk_3` FOREIGN KEY (`fk_id_clase_vechiculo`) REFERENCES `param_clase_vehiculo` (`id_clase_vechiculo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  ADD CONSTRAINT `equipos_fotos_ibfk_1` FOREIGN KEY (`fk_id_equipo_foto`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  ADD CONSTRAINT `equipos_localizacion_ibfk_1` FOREIGN KEY (`fk_id_equipo_localizacion`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  ADD CONSTRAINT `equipos_poliza_ibfk_1` FOREIGN KEY (`fk_id_equipo_poliza`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  ADD CONSTRAINT `param_menu_access_ibfk_1` FOREIGN KEY (`fk_id_role`) REFERENCES `param_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `param_menu_access_ibfk_2` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  ADD CONSTRAINT `param_menu_links_ibfk_1` FOREIGN KEY (`fk_id_menu`) REFERENCES `param_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
