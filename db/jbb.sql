-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2020 a las 07:26:49
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
(1, 'Record Task(s)', '', 'fa-edit', 2, 1, 1),
(2, 'Jobs Info', '', 'fa-briefcase', 3, 1, 1),
(3, 'Incidences', '', 'fa-ambulance', 4, 1, 1),
(4, 'Day Off', '', 'fa-calendar', 5, 1, 1),
(5, 'Work Orders', '', 'fa-money', 6, 1, 1),
(6, 'Manage Day Off', '', 'fa-calendar', 1, 2, 1),
(7, 'Reports', '', 'fa-list-alt', 2, 2, 1),
(8, 'Configuración', '', 'fa-gear', 3, 2, 1),
(9, 'Manuals', '', 'fa-book ', 4, 2, 1),
(10, 'Salir', 'menu/salir', 'fa-sign-out', 6, 2, 1),
(11, 'Dashboard ADMIN', 'dashboard/admin', 'fa-dashboard', 1, 1, 1),
(12, 'Administrar acceso sistema', '', 'fa-cogs', 5, 2, 1),
(13, 'Dashboard', 'dashboard', 'fa-dashboard', 1, 1, 1),
(14, 'Dashboard Supervisor', 'dashboard/supervisor', 'fa-dashboard', 1, 1, 1),
(15, 'Dashboard Work order', 'dashboard/work_order', 'fa-dashboard', 1, 1, 1),
(16, 'Dashboard Safety&Maintenance', 'dashboard/safety', 'fa-dashboard', 1, 1, 1),
(17, 'Dashboard Accounting', 'dashboard/accounting', 'fa-dashboard', 1, 1, 1),
(18, 'Dashboard Management', 'dashboard/management', 'fa-dashboard', 1, 1, 1);

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
(4, 8, 4, 99),
(6, 8, 5, 99),
(7, 8, 6, 99),
(5, 10, 0, 99),
(1, 12, 1, 99),
(2, 12, 2, 99),
(3, 12, 3, 99);

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
(1, 12, 'Menu', 'access/menu', 'fa-link', 2, '2020-11-18 19:45:31', 1, 1),
(2, 12, 'Enlaces', 'access/links', 'fa-link', 3, '2020-11-18 19:45:31', 1, 1),
(3, 12, 'Acceso de roles', 'access/role_access', 'fa-puzzle-piece', 4, '2020-11-18 19:45:31', 1, 1),
(4, 8, 'Usuarios', 'settings/employee/1', 'fa-users', 1, '2020-11-19 06:13:07', 1, 1),
(5, 8, '----------', 'DIVIDER', 'fa-hand-o-up', 2, '2020-11-19 07:07:22', 1, 3),
(6, 8, 'Proveedores', 'settings/company', 'fa-building', 3, '2020-11-19 07:08:43', 1, 1);

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
(2, 'Management user', 'Dashboard: timestam, lashauling recors, le quito safety y le quito inspecciones\nRecord Task: Hauling\n----------------------------\n* Work order:\n\n    Todo work orders\n    Fabian me especifica permisos en esta parte\n\n----------------------------\nReports: Incidences Report\nReports: Pickups & Trucks Inspection Report\nReports: Construction Equipment Inspection Report\nReports: Work Order Report\n----------------------------\nSettings: Employee ---> solo puede ver, no puede modificar\nSettings: Vehicles ---> solo puede ver, no puede modificar', 'text-green', 'dashboard/management'),
(3, 'Accounting user', 'Dashboard: timestam, lashauling recors, le quito safety y le quito inspecciones\nRecord Task: Payroll\nIncidences\nDay off (Ask for)\n----------------------------\n* Work order:\n\n    Todo work orders\n    Solo puede editar work orders que estan en revised, sento to the client y close, de resto solo las ve\n\n----------------------------\nReports: Payroll Report\nReports: Incidences Report\nReports: Maintenace Report\nReports: FLHA Report\nReports: Hauling Report\nReports: Hauling Report\nReports: Pickups & Trucks Inspection Report\nReports: Construction Equipment Inspection Report\nReports: Work Order Report\n----------------------------\nSettings: Planning ---> solo puede ver, no puede modificar\nSettings: Company\nSettings: Vehicles ---> de mantenimiento solo puede verlo, no editarlo ni adicionar ', 'text-danger', 'dashboard/accounting'),
(4, 'Safety&Maintenance user', 'Dashboard: Le muestro notificaciones de futuros mantenimientos\r\nRecord Task: Payroll\r\nRecord Task: PPE inspection\r\n* Jobs info\r\n----------------------------\r\nEn jha solo dar permisos a safety\r\n----------------------------\r\nIncidences\r\nDay off (Ask for)\r\n----------------------------\r\n* Work order:\r\n\r\n    Pueden solo crear workorders y ver las que crearon\r\n    No puede cambiar estado de la work order\r\n    No puede tener acceso a enlace search ni search income\r\n    Quitar boton save and send to the client\r\n    Quitar boton asign rate ----perfil work order y acounting\r\n\r\n----------------------------\r\nDay off (Approval)\r\nReports: Incidences Report\r\nReports: Maintenace Report\r\nReports: FLHA Report\r\nReports: Hauling Report\r\nReports: Pickups & Trucks Inspection Report\r\nReports: Construction Equipment Inspection Report\r\nReports: Special Equipment Inspection Report\r\n----------------------------\r\nSettings: Hazard\r\nSettings: Hazard activity\r\nSettings: Vehicles\r\nSettings: Link to videos\r\nSettings: Link to manuals\r\n----------------------------\r\nManuals', 'text-info', 'dashboard/safety'),
(5, 'Work order user', ' Record Task: Payroll\r\nIncidences\r\nDay off (Ask for)\r\n----------------------------\r\n* Work order:\r\n\r\n    CAMBIA ESTADO A REVISADA\r\n    Workorders el estado solo puede cambiar de on field a in progress y de in progress a revised\r\n    Si esta revisada solo la puede ver no la puede editar\r\n\r\n----------------------------\r\nReports: Payroll Report\r\nReports: Hauling Report\r\nReports: Work Order Report', 'text-warning', 'dashboard/work_order'),
(6, 'Supervisor user', 'Dashboard: payroll todos los registros, todas las inspecciones\r\nRecord Task: Payroll\r\nRecord Task: Hauling\r\nIncidences\r\nDay off (Ask for)\r\n----------------------------\r\n* Work order:\r\n\r\n    Puede buscar work orders\r\n    Puede editar cualquiera simpere y cuando este en on field\r\n    Si esta en otro estado solo la puede ver no la puede editar\r\n    No puede aign rate\r\n    No pueden descargar invoice\r\n    En settings puede ir a planning\r\n    Reportes no tiene acceso\r\n    No tienen accesos a ppe inspeccion\r\n\r\n----------------------------\r\nManuals', 'text-success', 'dashboard/supervisor'),
(7, 'Basic user', 'Dashboard: payroll solo sus registros, inspecciones solo sus inspecciones\r\nRecord Task: Payroll\r\nRecord Task: Hauling\r\nIncidences\r\nDay off (Ask for)\r\n----------------------------\r\n* Work order:\r\n\r\n    Pueden solo crear workorders y ver las que crearon\r\n    No puede cambiar estado de la work order\r\n    No puede tener acceso a enlace search ni search income\r\n    Quitar boton save and send to the client\r\n    Quitar boton asign rate ----perfil work order y acounting\r\n\r\n----------------------------\r\nManuals', 'text-primary', 'dashboard'),
(99, 'SUPER ADMIN', 'Con acceso a todo el sistema', 'text-success', 'dashboard/admin');

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
(1, 'Benjamin', 'Motta', 'Bmottag', '4034089921', 'benmotta@gmail.com', '692ddae9648cb57da15cd58912131fed', 1, 99, 'images/employee/thumbs/1.jpg');

--
-- Índices para tablas volcadas
--

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
  ADD KEY `perfil` (`fk_id_user_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
