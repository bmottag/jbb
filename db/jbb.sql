-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2020 a las 02:36:17
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
-- Estructura de tabla para la tabla `param_proveedores`
--

CREATE TABLE `param_proveedores` (
  `id_proveedor` int(3) NOT NULL,
  `nombre_proveedor` varchar(120) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `numero_celular` varchar(12) NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(8, 'Settings', '', 'fa-gear', 3, 2, 1),
(9, 'Manuals', '', 'fa-book ', 4, 2, 1),
(10, 'Logout', 'menu/salir', 'fa-sign-out', 6, 2, 1),
(11, 'Dashboard ADMIN', 'dashboard/admin', 'fa-dashboard', 1, 1, 1),
(12, 'Manage System Acces', '', 'fa-cogs', 5, 2, 1),
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
(209, 1, 1, 3),
(184, 1, 1, 4),
(177, 1, 1, 5),
(156, 1, 1, 6),
(2, 1, 1, 7),
(297, 1, 1, 99),
(252, 1, 2, 2),
(157, 1, 2, 6),
(3, 1, 2, 7),
(298, 1, 2, 99),
(185, 1, 3, 4),
(299, 1, 3, 99),
(316, 2, 0, 2),
(186, 2, 0, 4),
(315, 2, 0, 5),
(312, 2, 0, 6),
(304, 2, 0, 7),
(296, 2, 0, 99),
(210, 3, 4, 3),
(187, 3, 4, 4),
(163, 3, 4, 5),
(158, 3, 4, 6),
(4, 3, 4, 7),
(294, 3, 4, 99),
(211, 3, 5, 3),
(188, 3, 5, 4),
(164, 3, 5, 5),
(159, 3, 5, 6),
(5, 3, 5, 7),
(295, 3, 5, 99),
(189, 4, 0, 4),
(178, 4, 0, 5),
(160, 4, 0, 6),
(6, 4, 0, 7),
(293, 4, 0, 99),
(249, 5, 6, 2),
(212, 5, 6, 3),
(190, 5, 6, 4),
(165, 5, 6, 5),
(161, 5, 6, 6),
(7, 5, 6, 7),
(290, 5, 6, 99),
(250, 5, 7, 2),
(213, 5, 7, 3),
(166, 5, 7, 5),
(168, 5, 7, 6),
(291, 5, 7, 99),
(251, 5, 8, 2),
(214, 5, 8, 3),
(167, 5, 8, 5),
(292, 5, 8, 99),
(191, 6, 9, 4),
(287, 6, 9, 99),
(192, 6, 10, 4),
(288, 6, 10, 99),
(193, 6, 11, 4),
(289, 6, 11, 99),
(240, 7, 12, 2),
(215, 7, 12, 3),
(179, 7, 12, 5),
(263, 7, 12, 99),
(239, 7, 13, 2),
(216, 7, 13, 3),
(194, 7, 13, 4),
(262, 7, 13, 99),
(238, 7, 14, 2),
(217, 7, 14, 3),
(195, 7, 14, 4),
(261, 7, 14, 99),
(237, 7, 15, 2),
(218, 7, 15, 3),
(181, 7, 15, 5),
(260, 7, 15, 99),
(236, 7, 16, 2),
(219, 7, 16, 3),
(196, 7, 16, 4),
(259, 7, 16, 99),
(235, 7, 17, 2),
(220, 7, 17, 3),
(180, 7, 17, 5),
(258, 7, 17, 99),
(234, 7, 18, 2),
(221, 7, 18, 3),
(197, 7, 18, 4),
(257, 7, 18, 99),
(233, 7, 19, 2),
(222, 7, 19, 3),
(198, 7, 19, 4),
(256, 7, 19, 99),
(232, 7, 20, 2),
(223, 7, 20, 3),
(199, 7, 20, 4),
(255, 7, 20, 99),
(231, 7, 21, 2),
(224, 7, 21, 3),
(182, 7, 21, 5),
(254, 7, 21, 99),
(241, 8, 22, 2),
(317, 8, 22, 3),
(264, 8, 22, 99),
(242, 8, 23, 2),
(314, 8, 23, 5),
(265, 8, 23, 99),
(243, 8, 24, 2),
(266, 8, 24, 99),
(225, 8, 25, 2),
(169, 8, 25, 6),
(267, 8, 25, 99),
(268, 8, 26, 99),
(200, 8, 27, 4),
(269, 8, 27, 99),
(201, 8, 28, 4),
(270, 8, 28, 99),
(244, 8, 29, 2),
(226, 8, 29, 3),
(202, 8, 29, 4),
(271, 8, 29, 99),
(245, 8, 30, 2),
(227, 8, 30, 3),
(272, 8, 30, 99),
(248, 8, 31, 2),
(228, 8, 31, 3),
(273, 8, 31, 99),
(246, 8, 32, 2),
(229, 8, 32, 3),
(203, 8, 32, 4),
(274, 8, 32, 99),
(247, 8, 33, 2),
(230, 8, 33, 3),
(204, 8, 33, 4),
(275, 8, 33, 99),
(313, 8, 34, 4),
(276, 8, 34, 99),
(205, 8, 35, 4),
(277, 8, 35, 99),
(278, 8, 36, 99),
(279, 8, 37, 99),
(280, 8, 38, 99),
(281, 8, 39, 99),
(282, 8, 40, 99),
(206, 8, 41, 4),
(283, 8, 41, 99),
(207, 8, 42, 4),
(284, 8, 42, 99),
(113, 9, 45, 2),
(92, 9, 45, 3),
(71, 9, 45, 4),
(50, 9, 45, 5),
(29, 9, 45, 6),
(9, 9, 45, 7),
(134, 9, 45, 99),
(114, 9, 46, 2),
(93, 9, 46, 3),
(72, 9, 46, 4),
(51, 9, 46, 5),
(30, 9, 46, 6),
(10, 9, 46, 7),
(135, 9, 46, 99),
(115, 9, 47, 2),
(94, 9, 47, 3),
(73, 9, 47, 4),
(52, 9, 47, 5),
(31, 9, 47, 6),
(11, 9, 47, 7),
(136, 9, 47, 99),
(116, 9, 48, 2),
(95, 9, 48, 3),
(74, 9, 48, 4),
(53, 9, 48, 5),
(32, 9, 48, 6),
(12, 9, 48, 7),
(137, 9, 48, 99),
(117, 9, 49, 2),
(96, 9, 49, 3),
(75, 9, 49, 4),
(54, 9, 49, 5),
(33, 9, 49, 6),
(13, 9, 49, 7),
(138, 9, 49, 99),
(118, 9, 50, 2),
(97, 9, 50, 3),
(76, 9, 50, 4),
(55, 9, 50, 5),
(34, 9, 50, 6),
(14, 9, 50, 7),
(139, 9, 50, 99),
(119, 9, 51, 2),
(98, 9, 51, 3),
(77, 9, 51, 4),
(56, 9, 51, 5),
(35, 9, 51, 6),
(15, 9, 51, 7),
(140, 9, 51, 99),
(120, 9, 52, 2),
(99, 9, 52, 3),
(78, 9, 52, 4),
(57, 9, 52, 5),
(36, 9, 52, 6),
(16, 9, 52, 7),
(141, 9, 52, 99),
(121, 9, 53, 2),
(100, 9, 53, 3),
(79, 9, 53, 4),
(58, 9, 53, 5),
(37, 9, 53, 6),
(17, 9, 53, 7),
(142, 9, 53, 99),
(122, 9, 54, 2),
(101, 9, 54, 3),
(80, 9, 54, 4),
(59, 9, 54, 5),
(38, 9, 54, 6),
(18, 9, 54, 7),
(143, 9, 54, 99),
(123, 9, 55, 2),
(102, 9, 55, 3),
(81, 9, 55, 4),
(60, 9, 55, 5),
(39, 9, 55, 6),
(19, 9, 55, 7),
(144, 9, 55, 99),
(124, 9, 56, 2),
(103, 9, 56, 3),
(82, 9, 56, 4),
(61, 9, 56, 5),
(40, 9, 56, 6),
(20, 9, 56, 7),
(145, 9, 56, 99),
(125, 9, 57, 2),
(104, 9, 57, 3),
(83, 9, 57, 4),
(62, 9, 57, 5),
(41, 9, 57, 6),
(21, 9, 57, 7),
(146, 9, 57, 99),
(126, 9, 58, 2),
(105, 9, 58, 3),
(84, 9, 58, 4),
(63, 9, 58, 5),
(42, 9, 58, 6),
(8, 9, 58, 7),
(147, 9, 58, 99),
(127, 9, 59, 2),
(106, 9, 59, 3),
(85, 9, 59, 4),
(64, 9, 59, 5),
(43, 9, 59, 6),
(22, 9, 59, 7),
(148, 9, 59, 99),
(128, 9, 60, 2),
(107, 9, 60, 3),
(86, 9, 60, 4),
(65, 9, 60, 5),
(44, 9, 60, 6),
(23, 9, 60, 7),
(149, 9, 60, 99),
(129, 9, 61, 2),
(108, 9, 61, 3),
(87, 9, 61, 4),
(66, 9, 61, 5),
(45, 9, 61, 6),
(24, 9, 61, 7),
(150, 9, 61, 99),
(130, 9, 62, 2),
(109, 9, 62, 3),
(88, 9, 62, 4),
(67, 9, 62, 5),
(46, 9, 62, 6),
(25, 9, 62, 7),
(151, 9, 62, 99),
(131, 9, 63, 2),
(110, 9, 63, 3),
(89, 9, 63, 4),
(68, 9, 63, 5),
(47, 9, 63, 6),
(26, 9, 63, 7),
(152, 9, 63, 99),
(132, 9, 64, 2),
(111, 9, 64, 3),
(90, 9, 64, 4),
(69, 9, 64, 5),
(48, 9, 64, 6),
(27, 9, 64, 7),
(153, 9, 64, 99),
(133, 9, 65, 2),
(112, 9, 65, 3),
(91, 9, 65, 4),
(70, 9, 65, 5),
(49, 9, 65, 6),
(28, 9, 65, 7),
(154, 9, 65, 99),
(307, 9, 69, 2),
(305, 9, 69, 3),
(308, 9, 69, 4),
(311, 9, 69, 5),
(310, 9, 69, 6),
(306, 9, 69, 7),
(309, 9, 69, 99),
(172, 10, 0, 2),
(170, 10, 0, 3),
(173, 10, 0, 4),
(174, 10, 0, 5),
(175, 10, 0, 6),
(176, 10, 0, 7),
(171, 10, 0, 99),
(300, 11, 0, 99),
(286, 12, 44, 99),
(301, 12, 66, 99),
(302, 12, 67, 99),
(303, 12, 68, 99),
(1, 13, 0, 7),
(155, 14, 0, 6),
(162, 15, 0, 5),
(183, 16, 0, 4),
(208, 17, 0, 3),
(253, 18, 0, 2);

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
(1, 1, 'Payroll', 'payroll/add_payroll', 'fa-location-arrow', 1, '2020-03-31 15:22:39', 2, 1),
(2, 1, 'Hauling', 'hauling/add_hauling', 'fa-truck', 2, '2020-03-31 15:28:14', 2, 1),
(3, 1, 'PPE Inspection', 'more/ppe_inspection', 'fa-wrench', 3, '2020-03-31 16:23:32', 2, 1),
(4, 3, 'Near miss report', 'incidences/near_miss', 'fa-ambulance', 1, '2020-03-31 16:25:30', 2, 1),
(5, 3, 'Incident/Accident report', 'incidences/incident', 'fa-ambulance', 2, '2020-03-31 16:27:10', 2, 1),
(6, 5, 'Add/Edit', 'workorders', 'fa-money', 1, '2020-03-31 16:28:27', 2, 1),
(7, 5, 'Search', 'workorders/search', 'fa-money', 2, '2020-03-31 16:29:22', 2, 1),
(8, 5, 'Search Income', 'workorders/search_income', 'fa-money', 3, '2020-03-31 16:30:09', 2, 1),
(9, 6, 'New Day Off', 'dayoff/newDayoffList', 'fa-calendar', 1, '2020-03-31 16:34:24', 2, 1),
(10, 6, 'Approved Day Off', 'dayoff/approvedDayoffList', 'fa-calendar', 2, '2020-03-31 16:35:23', 2, 1),
(11, 6, 'Denied Day Off', 'dayoff/deniedDayoffList', 'fa-calendar', 3, '2020-03-31 16:36:11', 2, 1),
(12, 7, 'Payroll Report', 'https://v-contracting.ca/app/public/reportico/run.php?project=Payroll&execute_mode=MENU', 'fa-book', 1, '2020-03-31 16:41:39', 2, 2),
(13, 7, 'Incidences Report', 'https://v-contracting.ca/app/public/reportico/run.php?project=Incidences&execute_mode=MENU', 'fa-ambulance', 2, '2020-03-31 16:42:57', 2, 2),
(14, 7, 'Maintenance Report', 'https://v-contracting.ca/app/public/reportico/run.php?project=Maintenance&execute_mode=MENU', 'fa-flag', 3, '2020-03-31 16:44:31', 2, 2),
(15, 7, '----------', 'DIVIDER', 'fa-check', 4, '2020-03-31 16:57:20', 2, 3),
(16, 7, 'FLHA Report', 'report/searchByDateRange/safety', 'fa-life-saver', 5, '2020-03-31 17:04:02', 2, 1),
(17, 7, 'Hauling Report', 'report/searchByDateRange/hauling', 'fa-truck', 6, '2020-03-31 17:05:03', 2, 1),
(18, 7, 'Pickups & Trucks Inspection Report', 'report/searchByDateRange/dailyInspection', 'fa-search', 7, '2020-03-31 17:06:12', 2, 1),
(19, 7, 'Construction Equipment Inspection Report', 'report/searchByDateRange/heavyInspection', 'fa-search', 8, '2020-03-31 17:06:54', 2, 1),
(20, 7, 'Special Equipment Inspection Report', 'report/searchByDateRange/specialInspection', 'fa-search', 9, '2020-03-31 17:07:34', 2, 1),
(21, 7, 'Work Order Report', 'report/searchByDateRange/workorder', 'fa-money', 10, '2020-03-31 17:08:32', 2, 1),
(22, 8, 'Employee', 'settings/employee/1', 'fa-users', 1, '2020-03-31 17:09:23', 1, 1),
(23, 8, 'Job Code/Name', 'admin/job', 'fa-briefcase', 2, '2020-03-31 17:10:00', 2, 1),
(24, 8, '----------', 'DIVIDER', 'fa-check', 3, '2020-03-31 17:11:25', 2, 3),
(25, 8, 'Planning', 'programming', 'fa-briefcase', 4, '2020-03-31 17:15:02', 2, 1),
(26, 8, '----------', 'DIVIDER', 'fa-check', 5, '2020-03-31 17:15:49', 2, 3),
(27, 8, 'Hazard', 'admin/hazard', 'fa-medkit', 6, '2020-03-31 17:16:36', 2, 1),
(28, 8, 'Hazard Activity', 'admin/hazardActivity', 'fa-suitcase', 7, '2020-03-31 17:18:40', 2, 1),
(29, 8, '----------', 'DIVIDER', 'fa-check', 8, '2020-03-31 17:19:11', 1, 3),
(30, 8, 'Company', 'settings/company', 'fa-building', 9, '2020-03-31 17:20:00', 1, 1),
(31, 8, '----------', 'DIVIDER', 'fa-check', 10, '2020-03-31 17:20:35', 2, 3),
(32, 8, 'Vehicle - VCI', 'admin/vehicle/1', 'fa-automobile', 11, '2020-03-31 17:21:22', 2, 1),
(33, 8, 'Rentals', 'admin/vehicle/2', 'fa-automobile', 12, '2020-03-31 17:22:25', 2, 1),
(34, 8, 'Vehicle stock', 'admin/stock', 'fa-slack', 13, '2020-03-31 17:23:15', 2, 1),
(35, 8, '----------', 'DIVIDER', 'fa-check', 14, '2020-03-31 17:23:48', 2, 3),
(36, 8, 'Material Type', 'admin/material', 'fa-tint', 15, '2020-03-31 17:24:36', 2, 1),
(37, 8, 'Employee Type', 'admin/employeeType', 'fa-flag-o', 16, '2020-03-31 17:26:13', 2, 1),
(38, 8, '----------', 'DIVIDER', 'fa-check', 17, '2020-03-31 17:27:07', 2, 3),
(39, 8, 'Templates', 'template/templates', 'fa-users', 18, '2020-03-31 17:27:40', 2, 1),
(40, 8, '----------', 'DIVIDER', 'fa-check', 19, '2020-03-31 17:28:25', 2, 3),
(41, 8, 'Videos links', 'enlaces/videos', 'fa-hand-o-up', 20, '2020-03-31 17:29:08', 2, 1),
(42, 8, 'Manuals links', 'enlaces/manuals', 'fa-hand-o-up', 21, '2020-03-31 17:29:50', 2, 1),
(44, 12, 'User acces info', 'dashboard/info', 'fa-hand-o-up', 1, '2020-03-31 17:31:59', 2, 1),
(45, 9, 'Jobs Info intro', 'https://youtu.be/Wx_oYuq6jbQ', 'fa-hand-o-up', 3, '2018-04-02 23:53:18', 2, 4),
(46, 9, 'Tool Box intro', 'https://youtu.be/FZ3ufnhe460', 'fa-hand-o-up', 4, '2018-04-02 00:00:00', 2, 4),
(47, 9, 'Emergency Respond Plan', 'https://youtu.be/f9oA8sKcrDQ', 'fa-hand-o-up', 5, '2018-04-02 23:53:18', 2, 4),
(48, 9, 'Job Hazars Assessment', 'https://youtu.be/hn9aZHqvZLg', 'fa-hand-o-up', 6, '2018-04-02 23:53:18', 2, 4),
(49, 9, 'Field Level Hazard Assessment', 'https://youtu.be/LlfE3ngW7Cw', 'fa-hand-o-up', 7, '2018-04-02 23:53:18', 2, 4),
(50, 9, 'Job Site Orientation', 'https://youtu.be/MJHgpawD7MA', 'fa-hand-o-up', 8, '2018-04-02 23:53:18', 2, 4),
(51, 9, 'Locates intro', 'https://youtu.be/klkB19sx4gI', 'fa-hand-o-up', 9, '2018-04-02 23:53:18', 2, 4),
(52, 9, 'Environmental site inspection', 'https://youtu.be/u8rnqijcwaE', 'fa-hand-o-up', 10, '2018-04-02 23:53:18', 2, 4),
(53, 9, 'VCI app intro', 'https://youtu.be/qb2RSngYPkE', 'fa-hand-o-up', 11, '2018-04-02 23:53:18', 2, 4),
(54, 9, 'Days Off', 'https://youtu.be/d75r8JZRNSI', 'fa-hand-o-up', 12, '2018-04-02 23:53:18', 2, 4),
(55, 9, 'Work orders daily basis', 'https://youtu.be/v8NRb72GLkU', 'fa-hand-o-up', 13, '2018-04-02 23:53:18', 2, 4),
(56, 9, 'Near miss, incident, accident report', 'https://youtu.be/P8o2hilMBkY', 'fa-hand-o-up', 14, '2018-04-02 23:53:18', 2, 4),
(57, 9, 'Hauling Cards', 'https://youtu.be/jx4I866NjHY', 'fa-hand-o-up', 15, '2018-04-02 23:53:18', 2, 4),
(58, 9, 'Health & Safety Manual', 'https://v-contracting.ca/app/files/Health_and_safety_manual_Sept__14,2018.pdf', 'fa-hand-o-up', 1, '2018-04-27 10:00:00', 2, 5),
(59, 9, 'VCI Time Stamp', 'https://youtu.be/uFc_cG53ywc', 'fa-hand-o-up', 16, '2018-05-01 09:29:09', 2, 4),
(60, 9, 'QR inspections ', 'https://youtu.be/EbhrYwKErXc', 'fa-hand-o-up', 17, '2018-05-01 09:44:21', 2, 4),
(61, 9, 'CDL pre-trip inspection', 'https://youtu.be/IsiVy0M3YSU', 'fa-hand-o-up', 18, '2019-04-20 16:08:57', 2, 4),
(62, 9, 'Heavy Equipment inspections', 'https://youtu.be/0bAw7J7gHD0', 'fa-hand-o-up', 19, '2019-04-20 16:10:41', 2, 4),
(63, 9, 'Pickups Daily Inspections', 'https://youtu.be/XNFBYneqyAY', 'fa-hand-o-up', 20, '2019-04-20 16:11:59', 2, 4),
(64, 9, 'Cargo Securement', 'https://youtu.be/w-qhcF7SrgE', 'fa-hand-o-up', 21, '2019-04-20 16:14:49', 2, 4),
(65, 9, 'Securing Heavy equipment', 'https://youtu.be/VTH16hiQZ4M', 'fa-hand-o-up', 22, '2019-04-20 20:11:04', 2, 4),
(66, 12, 'Menu', 'access/menu', 'fa-link', 2, '2020-04-01 15:12:21', 1, 1),
(67, 12, 'Links', 'access/links', 'fa-link', 3, '2020-04-01 15:13:09', 1, 1),
(68, 12, 'Role Access', 'access/role_access', 'fa-puzzle-piece', 4, '2020-04-01 15:15:01', 1, 1),
(69, 9, '----------', 'DIVIDER', 'fa-hand-o-up', 2, '2020-04-03 08:31:36', 2, 3);

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
-- Estructura de tabla para la tabla `user`
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
-- Indices de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

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
-- AUTO_INCREMENT de la tabla `param_proveedores`
--
ALTER TABLE `param_proveedores`
  MODIFY `id_proveedor` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `param_menu`
--
ALTER TABLE `param_menu`
  MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `param_menu_access`
--
ALTER TABLE `param_menu_access`
  MODIFY `id_access` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT de la tabla `param_menu_links`
--
ALTER TABLE `param_menu_links`
  MODIFY `id_link` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `param_role`
--
ALTER TABLE `param_role`
  MODIFY `id_role` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `user`
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
