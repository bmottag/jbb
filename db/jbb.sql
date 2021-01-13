-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2021 a las 21:12:53
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
  `fecha_adquisicion` date NOT NULL,
  `valor_comercial` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `numero_inventario`, `fk_id_dependencia`, `marca`, `modelo`, `numero_serial`, `fk_id_tipo_equipo`, `estado_equipo`, `observacion`, `qr_code_img`, `qr_code_encryption`, `fecha_adquisicion`, `valor_comercial`) VALUES
(1, '14853', 7, 'Chevrolet ', '2019', '3GNFL7E51HS559955', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/1_qr_code.png', '1FDs8vd21acPIz8bqrhKApdqdTjuxgBTJrs2eS1UmEwlwiwSdbc', '1979-10-12', 10300500),
(2, '14854', 7, 'Nissan', '2017', '3N6CD33B2ZK365122', 1, 1, 'Inventario Yezid ', 'images/equipos/QR/2_qr_code.png', '2jnpWRXLbDdCG8v9QrKJGlR84UXIKqzkhNH9CLm7eScoSMxWn0k', '0000-00-00', 0),
(3, '16901', 7, 'Toyota', '2007', '9FH11UJ9079012119', 1, 1, 'Inventario Yezid', 'images/equipos/QR/3_qr_code.png', '3e0L1EUhaZIM0OZ9tdkon8brO7Auo7jL58GE7wg6V1GvqFwinHb', '0000-00-00', 0),
(4, '16989', 7, 'Toyota- Hilux', '1996', 'RN1067012769', 1, 1, 'Inventario Yezid', 'images/equipos/QR/4_qr_code.png', '4XnvRyFKtJVZPPzzyRdPYzr1QkgpYtoP0kENJh5D8mQHESej8y4', '0000-00-00', 0),
(5, '17129', 7, 'Volkswagen', '2018', '9536G8247JR812344', 1, 1, 'Inventario Yezid', 'images/equipos/QR/5_qr_code.png', '5PiIEUliY7PzZdS0ZDyUCaMNPfv25S1wQ1AlKAwxMlrdNH3N4mM', '0000-00-00', 0),
(6, '17710', 7, 'Renault', '2020', '93YMAF4CELJ079626', 1, 1, 'Inventario Yezid', 'images/equipos/QR/6_qr_code.png', '6jxt7Cevdl0j5MHgHuUZh93iOWBxbOTTyXG1FHKKaJuLBwasNvY', '0000-00-00', 0),
(7, '17615', 7, 'Chevrolet ', '2020', '9GDFVR345LB008406', 1, 1, 'Inventaro Yezid', 'images/equipos/QR/7_qr_code.png', '7sVXiSAcnge43sw3X0d1p4N8IHCo4LLAlN5cfX5ZRz6kuvJgAc0', '0000-00-00', 0),
(8, 'JBB.210001', 7, 'Pedrollo', 'JC Rm 1B', '00000', 2, 1, 'Bomba Autocebante centrífuga', 'images/equipos/QR/8_qr_code.png', '8o55FZnUiVhnFLtO0Jjvg22gMuuvdhVNuo5ukma8YWP2Ba9Plpq', '0000-00-00', 0);

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
  `fk_id_conductor_combustible` int(10) NOT NULL,
  `valor` float NOT NULL,
  `observacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_control_combustible`
--

INSERT INTO `equipos_control_combustible` (`id_equipo_control_combustible`, `fk_id_equipo_combustible`, `kilometros_actuales`, `cantidad`, `fecha_combustible`, `fk_id_conductor_combustible`, `valor`, `observacion`) VALUES
(1, 1, '48000', '100 Litros', '2020-12-17 22:04:30', 1, 150000, 'Falto dinero para llenar los tanques, solicitar la tarjeta');

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
  `salida` varchar(10) NOT NULL,
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
(1, 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
(2, 3, 'dbh 923', 'nose', 'amarillo', 5, 3, 1, '5 personas', 'publico', 'sferqwer234234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_fotos`
--

CREATE TABLE `equipos_fotos` (
  `id_equipo_foto` int(10) NOT NULL,
  `fk_id_equipo_foto` int(10) NOT NULL,
  `equipo_foto` varchar(250) NOT NULL,
  `fecha_foto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_fotos`
--

INSERT INTO `equipos_fotos` (`id_equipo_foto`, `fk_id_equipo_foto`, `equipo_foto`, `fecha_foto`) VALUES
(2, 1, 'images/equipos/1.PNG', '2020-12-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_localizacion`
--

CREATE TABLE `equipos_localizacion` (
  `id_equipo_localizacion` int(10) NOT NULL,
  `fk_id_equipo_localizacion` int(10) NOT NULL,
  `localizacion` varchar(200) NOT NULL,
  `fecha_localizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_localizacion`
--

INSERT INTO `equipos_localizacion` (`id_equipo_localizacion`, `fk_id_equipo_localizacion`, `localizacion`, `fecha_localizacion`) VALUES
(1, 1, 'Ibague- Barrio palermo - Manzana 8', '2020-12-24'),
(2, 1, 'Bogotá - Jardin Botanico', '2020-12-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_poliza`
--

CREATE TABLE `equipos_poliza` (
  `id_equipo_poliza` int(10) NOT NULL,
  `fk_id_equipo_poliza` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_poliza` varchar(30) NOT NULL,
  `estado_poliza` tinyint(4) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos_poliza`
--

INSERT INTO `equipos_poliza` (`id_equipo_poliza`, `fk_id_equipo_poliza`, `fecha_inicio`, `fecha_vencimiento`, `numero_poliza`, `estado_poliza`, `descripcion`) VALUES
(3, 1, '2021-01-01', '2022-01-19', 'AC-34-X', 1, 'Primer poliza'),
(4, 1, '2021-01-06', '2021-01-06', 'ASDFASDFADS', 1, 'ultima poliza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_correctivo`
--

CREATE TABLE `mantenimiento_correctivo` (
  `id_correctivo` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fk_id_equipo` int(10) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_correctivo`
--

INSERT INTO `mantenimiento_correctivo` (`id_correctivo`, `fecha_inicio`, `fk_id_equipo`, `descripcion`, `estado`) VALUES
(1, '2020-12-01', 1, 'pruebas', 1),
(2, '2020-12-31', 1, 'pruebas hoy', 1),
(3, '2020-12-31', 8, 'otra prueba', 1),
(4, '2020-12-15', 1, 'ultima prueba', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_preventivo`
--

CREATE TABLE `mantenimiento_preventivo` (
  `id_preventivo` int(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fk_id_tipo_equipo` int(1) NOT NULL,
  `fk_id_frecuencia` int(10) NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mantenimiento_preventivo`
--

INSERT INTO `mantenimiento_preventivo` (`id_preventivo`, `fecha_inicio`, `fk_id_tipo_equipo`, `fk_id_frecuencia`, `descripcion`, `estado`) VALUES
(1, '2020-12-01', 1, 1, 'algo', 1),
(2, '2020-12-01', 2, 1, 'algo mas', 1),
(3, '2010-01-01', 2, 4, 'pruebas de guardado', 1),
(4, '2010-01-01', 1, 7, 'mas pruebas', 1),
(5, '2020-12-01', 2, 5, 'ultima prueba', 1),
(6, '2020-12-01', 1, 7, 'otra mas', 1);

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
(1, 'Configuración', '', 'fa-gear', 1, 2, 1),
(2, 'Salir', 'menu/salir', 'fa-sign-out', 6, 2, 1),
(3, 'Equipos', '', 'fa-truck', 2, 1, 1),
(4, 'Administrar acceso sistema', '', 'fa-cogs', 5, 2, 1),
(5, 'Dashboard ADMIN', 'dashboard/admin', 'fa-dashboard', 1, 1, 1),
(6, 'Manuales', '', 'fa-book ', 4, 2, 1),
(7, 'Mantenimiento', '', 'fa-wrench', 3, 1, 1);

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
(19, 2, 0, 1),
(8, 2, 0, 99),
(18, 3, 7, 1),
(7, 3, 7, 99),
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
(24, 7, 16, 1),
(22, 7, 16, 99);

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
(7, 3, 'Buscar', 'equipos', 'fa-ambulance', 1, '2020-11-20 01:29:59', 1, 1),
(8, 4, '----------', 'DIVIDER', 'fa-pin', 3, '2020-12-01 17:19:46', 1, 3),
(9, 4, 'Descripción Roles', 'dashboard/rol_info', 'fa-info', 5, '2020-12-01 17:22:23', 1, 1),
(12, 6, 'Manual de Usuario', 'http://[::1]/jbb/files/MANUAL_DE_USUARIO.pdf', 'fa-hand-o-up', 1, '2020-12-01 19:04:26', 1, 5),
(13, 6, 'Cargar Manuales', 'access/manuals', 'fa-book', 25, '2020-12-01 19:10:25', 1, 1),
(14, 6, 'DIVIDER', '----------', 'fa-pin', 24, '2020-12-01 19:11:24', 1, 3),
(15, 7, 'Preventivo', 'mantenimiento/preventivo', 'fa-wrench', 1, '2020-12-11 12:13:55', 1, 1),
(16, 7, 'Correctivo', 'mantenimiento/correctivo', 'fa-wrench', 2, '2020-12-11 12:14:41', 1, 1);

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
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema, encargaado de tablas parametricas del sistema', 'text-success', 'dashboard/admin'),
(100, 'Conductor', 'Conductores de vehículos, falta definir su rol en el sistema', 'text-purpura', 'dashboard/conductor');

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
(1, 'Vehículos', 'equipos_detalle_vehiculo', 'guardarInfoEspecificaVehiculo', '/inspection/vehiculos', 'form_1_vehiculos', 'inpection_vehiculos', 'id_inspection_vehiculos'),
(2, 'Bomba', 'equipos_detalle_bomba', 'guardarInfoEspecificaBomba', '', '', '', '');

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
(3, 'Pedro', 'Manrrique', 'pmanrrique', '3015549911', 'pmanrrique@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 100, '');

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
  ADD KEY `fk_id_conductor_combustible` (`fk_id_conductor_combustible`);

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
  ADD KEY `fk_id_equipo_foto` (`fk_id_equipo_foto`);

--
-- Indices de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  ADD PRIMARY KEY (`id_equipo_localizacion`),
  ADD KEY `fk_id_equipo_localizacion` (`fk_id_equipo_localizacion`);

--
-- Indices de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  ADD PRIMARY KEY (`id_equipo_poliza`),
  ADD KEY `fk_id_equipo_poliza` (`fk_id_equipo_poliza`);

--
-- Indices de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  ADD PRIMARY KEY (`id_correctivo`);

--
-- Indices de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  ADD PRIMARY KEY (`id_preventivo`);

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
  MODIFY `id_equipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos_control_combustible`
--
ALTER TABLE `equipos_control_combustible`
  MODIFY `id_equipo_control_combustible` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_bomba`
--
ALTER TABLE `equipos_detalle_bomba`
  MODIFY `id_equipo_detalle_bomba` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `equipos_detalle_vehiculo`
--
ALTER TABLE `equipos_detalle_vehiculo`
  MODIFY `id_equipo_detalle_vehiculo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos_fotos`
--
ALTER TABLE `equipos_fotos`
  MODIFY `id_equipo_foto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos_localizacion`
--
ALTER TABLE `equipos_localizacion`
  MODIFY `id_equipo_localizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipos_poliza`
--
ALTER TABLE `equipos_poliza`
  MODIFY `id_equipo_poliza` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_correctivo`
--
ALTER TABLE `mantenimiento_correctivo`
  MODIFY `id_correctivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_preventivo`
--
ALTER TABLE `mantenimiento_preventivo`
  MODIFY `id_preventivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  MODIFY `id_proveedor` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `param_role`
--
ALTER TABLE `param_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `param_tipo_carroceria`
--
ALTER TABLE `param_tipo_carroceria`
  MODIFY `id_tipo_carroceria` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `param_tipo_equipos`
--
ALTER TABLE `param_tipo_equipos`
  MODIFY `id_tipo_equipo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  MODIFY `id_llave` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
