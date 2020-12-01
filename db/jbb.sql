-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2020 a las 15:56:13
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
  `numero_unidad` varchar(10) NOT NULL,
  `nombre_equipo` varchar(50) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `numero_serial` varchar(30) NOT NULL,
  `estado_equipo` tinyint(1) NOT NULL COMMENT '1:Activo;2:Inactivo',
  `observacion` text NOT NULL,
  `qr_code_img` varchar(250) NOT NULL,
  `qr_code_encryption` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `numero_unidad`, `nombre_equipo`, `fabricante`, `modelo`, `numero_serial`, `estado_equipo`, `observacion`, `qr_code_img`, `qr_code_encryption`) VALUES
(1, 'JBB-00001', 'Camioneta', 'FORD', '3500', '2020-ENERO', 1, 'PRIMER REGISTRO', 'rwetwer', 'wertwert'),
(3, 'JBB-0002', 'Camion', 'Kenworth', '2006', '2345678', 1, 'Segundo registro con codigo QR', 'images/equipos/3_qr_code.png', '3vbLf5PhbRUxoKYGDuP6j7zjmfntN1kugggDWQtQpo1H9BP4rog'),
(4, '', '', '', '', '', 0, '', 'images/equipos/4_qr_code.png', '4FzGjCI9HXLcc2B8Z9Segm2uQ6224CBJFmFWwUsM11o7VFV4lhQ'),
(7, 'JB-0003', 'Impresoa', 'HP-3', 'JET450', '123445667', 1, 'Nuevo registro', 'images/equipos/7_qr_code.png', '7R7h0Bpms5c0ivbVDOOJ4bWB8Acsxy8QK1HJxK6BzXtFL44nALG');

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
(6, 'Manuales', '', 'fa-book ', 4, 2, 1);

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
(1, 1, 4, 99),
(2, 1, 5, 99),
(3, 1, 6, 99),
(8, 2, 0, 99),
(7, 3, 7, 99),
(4, 4, 1, 99),
(5, 4, 2, 99),
(6, 4, 3, 99);

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
(1, 4, 'Enlaces Menu', 'access/menu', 'fa-link', 2, '2020-11-18 19:45:31', 1, 1),
(2, 4, 'Enlaces Submenu', 'access/links', 'fa-link', 3, '2020-11-18 19:45:31', 1, 1),
(3, 4, 'Acceso de roles', 'access/role_access', 'fa-puzzle-piece', 4, '2020-11-18 19:45:31', 1, 1),
(4, 1, 'Usuarios', 'settings/employee/1', 'fa-users', 1, '2020-11-19 06:13:07', 1, 1),
(5, 1, '----------', 'DIVIDER', 'fa-hand-o-up', 2, '2020-11-19 07:07:22', 1, 3),
(6, 1, 'Proveedores', 'settings/company', 'fa-building', 3, '2020-11-19 07:08:43', 1, 1),
(7, 3, 'Buscar', 'equipos', 'fa-ambulance', 1, '2020-11-20 01:29:59', 1, 1);

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
(1, 'DANE', 'Fabian Jaimes', '3156953740', 'fjaimes@dane.gov.co');

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
(1, 'Administrador', 'Se encarga de comfiguracion del sistema. Cargar tabla de Usuarios, tabla de proveedores', 'text-warning', 'dashboard/administrador'),
(2, 'Usuario Consulta', 'Solo tiene acceso a ver información en el sistema. No puede editar ni adicionar nada.', 'text-green', 'dashboard/encargado'),
(3, 'Encargado', 'Usuarios que van a realizar el mantenimiento a los equipos.', 'text-danger', 'dashboard/encargado'),
(4, 'Supervisor', 'Carga en el sistema el plan de mantenimiento, asigna los mantenimientos a los encargados y realiza control de los mantenimientos', 'text-info', 'dashboard/supervisor'),
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema, encargaado de tablas parametricas del sistema', 'text-success', 'dashboard/admin');

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
(1, 'Benjamin', 'Motta', 'Bmottag', '4034089921', 'benmotta@gmail.com', '25446782e2ccaf0afdb03e5d61d0fbb9', 1, 99, 'images/usuarios/thumbs/1.JPG');

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
-- Volcado de datos para la tabla `usuarios_llave_contraseña`
--

INSERT INTO `usuarios_llave_contraseña` (`id_llave`, `fk_id_user_ulc`, `email_user`, `llave`) VALUES
(13, 1, 'benmotta@gmail.com', 'CrOwkwEH06WaqWdkH21I');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD UNIQUE KEY `numero_unidad` (`numero_unidad`),
  ADD UNIQUE KEY `qr_code_encryption` (`qr_code_encryption`),
  ADD KEY `estado_equipo` (`estado_equipo`);

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
  MODIFY `id_equipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_llave_contraseña`
--
ALTER TABLE `usuarios_llave_contraseña`
  MODIFY `id_llave` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

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
