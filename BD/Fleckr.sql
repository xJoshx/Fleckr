-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-06-2013 a las 18:57:58
-- Versión del servidor: 5.5.28
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Fleckr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `ID_ADMIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='El administrador de la página';

--
-- Volcado de datos para la tabla `Admin`
--

INSERT INTO `Admin` (`ID_ADMIN`, `PASS`) VALUES
('Admin1', '1234Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Allow`
--

CREATE TABLE IF NOT EXISTS `Allow` (
  `ID_COLLECTION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_COLLECTION` (`ID_COLLECTION`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Los usuarios que pueden acceder a la colección';

--
-- Volcado de datos para la tabla `Allow`
--

INSERT INTO `Allow` (`ID_COLLECTION`, `ID_USER`) VALUES
('myUserdefault', 'user10'),
('myUserdefault', 'finalUser');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Authorize`
--

CREATE TABLE IF NOT EXISTS `Authorize` (
  `ID_ADMIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PERMITS` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_ADMIN` (`ID_ADMIN`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Los que sean autorizados van aquí. PERMITS = basic, complete';

--
-- Volcado de datos para la tabla `Authorize`
--

INSERT INTO `Authorize` (`ID_ADMIN`, `ID_USER`, `PERMITS`) VALUES
('Admin1', 'user10', 'Basic'),
('Admin1', 'myUser', 'Complete'),
('Admin1', 'finalUser', 'Complete'),
('Admin1', 'user1', 'Basic'),
('Admin1', 'user11', 'Complete');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ban`
--

CREATE TABLE IF NOT EXISTS `Ban` (
  `ID_ADMIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_ADMIN` (`ID_ADMIN`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Aquí aparecen los baneados';

--
-- Volcado de datos para la tabla `Ban`
--

INSERT INTO `Ban` (`ID_ADMIN`, `ID_USER`) VALUES
('Admin1', 'user1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Collections`
--

CREATE TABLE IF NOT EXISTS `Collections` (
  `ID_COLLECTION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PUBLIC` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `DISABLED` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ID_ADMIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Notifications` int(2) NOT NULL,
  `IS_NOTIFIED` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `WIDTH` int(4) NOT NULL,
  `HEIGHT` int(4) NOT NULL,
  PRIMARY KEY (`ID_COLLECTION`),
  KEY `Notifications` (`Notifications`),
  KEY `ID_ADMIN` (`ID_ADMIN`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='La tabla colecciones';

--
-- Volcado de datos para la tabla `Collections`
--

INSERT INTO `Collections` (`ID_COLLECTION`, `PUBLIC`, `DISABLED`, `ID_ADMIN`, `ID_USER`, `Notifications`, `IS_NOTIFIED`, `WIDTH`, `HEIGHT`) VALUES
('California', 'Yes', 'No', 'Admin1', 'myUser', 0, 'No', 256, 256),
('finalUserdefault', 'No', 'No', 'Admin1', 'finalUser', 0, 'No', 0, 0),
('myUserdefault', 'No', 'No', 'Admin1', 'myUser', 0, 'No', 0, 0),
('test', 'No', 'No', 'Admin1', 'myUser', 0, 'No', 64, 64),
('This is punk rock!', 'Yes', 'No', 'Admin1', 'user11', 0, 'No', 512, 512),
('user11default', 'No', 'No', 'Admin1', 'user11', 0, 'No', 0, 0),
('user1default', 'No', 'No', 'Admin1', 'user1', 0, 'No', 0, 0),
('user2default', 'No', 'No', 'Admin1', 'user2', 0, 'No', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Notify`
--

CREATE TABLE IF NOT EXISTS `Notify` (
  `ID_ADMIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CONTENT` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_ADMIN` (`ID_ADMIN`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Las notificaciones son estas';

--
-- Volcado de datos para la tabla `Notify`
--

INSERT INTO `Notify` (`ID_ADMIN`, `ID_USER`, `CONTENT`) VALUES
('Admin1', 'myUser', 'Your collection has been deleted. Reason: continous reports. Plz don''t do it again k thx'),
('Admin1', 'myUser', 'Your collection has been disabled.'),
('Admin1', 'myUser', 'Your collection test has been disabled.'),
('Admin1', 'myUser', 'Your collection California is enabled now. Don''t fail us again ;)'),
('Admin1', 'myUser', 'Your collection delete22 has been deleted. Reason: continous reports. Plz don''t do it again k thx'),
('Admin1', 'myUser', 'Your collection California is enabled now.'),
('Admin1', 'myUser', 'Your collection California has been disabled.'),
('Admin1', 'myUser', 'Your collection California is enabled now.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Photos`
--

CREATE TABLE IF NOT EXISTS `Photos` (
  `ID_PHOTO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `LOCATION` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FILE_NAME` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_PHOTO`),
  KEY `ID_PHOTO` (`ID_PHOTO`),
  KEY `ID_PHOTO_2` (`ID_PHOTO`),
  KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Aquí se guardan las fotos';

--
-- Volcado de datos para la tabla `Photos`
--

INSERT INTO `Photos` (`ID_PHOTO`, `NAME`, `ID_USER`, `LOCATION`, `FILE_NAME`) VALUES
('asdfmyUser', 'asdf', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/notification_University_of_California__Davis.png', 'notification_University_of_California__Davis.png'),
('atlas!user11', 'atlas!', 'user11', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/user11/atlas_losing_grip0.jpg', 'atlas_losing_grip0.jpg'),
('c1myUser', 'c1', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/9d19fc8809bcb1b765e891c331b0c5c5.jpeg', '9d19fc8809bcb1b765e891c331b0c5c5.jpeg'),
('c2myUser', 'c2', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California_am_Kurfuerstendamm-Berlin-Exterior_view-2-6673.jpg', 'California_am_Kurfuerstendamm-Berlin-Exterior_view-2-6673.jpg'),
('c3myUser', 'c3', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California-Flag-icon.png', 'California-Flag-icon.png'),
('c4myUser', 'c4', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California-Icon.png', 'California-Icon.png'),
('c5myUser', 'c5', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California-Victory.png', 'California-Victory.png'),
('c6myUser', 'c6', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California-Zurich-Reception-1-72111.jpg', 'California-Zurich-Reception-1-72111.jpg'),
('c7myUser', 'c7', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/California.png', 'California.png'),
('c8myUser', 'c8', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/d0baddf27c490e4ee20eb5c0f37013af.jpeg', 'd0baddf27c490e4ee20eb5c0f37013af.jpeg'),
('esciffinalUser', 'escif', 'finalUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/finalUser/escif3.jpg', 'escif3.jpg'),
('Kid Dinamite!user11', 'Kid Dinamite!', 'user11', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/user11/bio_photoKidDynamite.jpg', 'bio_photoKidDynamite.jpg'),
('sTrashmyUser', 'sTrash', 'myUser', '/Applications/XAMPP/xamppfiles/htdocs/Fleckr/myUser/washington_january_21_phoenix_suns_point_poster-rb8218407941e4d5c90133cab10285b95_2046_8byvr_512.jpg', 'washington_january_21_phoenix_suns_point_poster-rb8218407941e4d5c90133cab10285b95_2046_8byvr_512.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Report`
--

CREATE TABLE IF NOT EXISTS `Report` (
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_COLLECTION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_COLLECTION` (`ID_COLLECTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Las colecciones reportadas son éstas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Send_mail`
--

CREATE TABLE IF NOT EXISTS `Send_mail` (
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_USER_TO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CONTENT` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_USER_TO` (`ID_USER_TO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Los mensajes entre usuarios para pedir permisos';

--
-- Volcado de datos para la tabla `Send_mail`
--

INSERT INTO `Send_mail` (`ID_USER`, `ID_USER_TO`, `CONTENT`) VALUES
('user10', 'myUser', 'Let me take a look at your collection myUserdefault. Thanks.'),
('user10', 'myUser', 'Let me take a look at your collection test. Thanks.'),
('myUser', 'user10', 'Plz take a look of my collection myUserdefault k thx'),
('finalUser', 'myUser', 'Let me take a look at your collection test. Thanks.'),
('myUser', 'finalUser', 'Plz take a look of my collection myUserdefault k thx'),
('user11', 'finalUser', 'Let me take a look at your collection finalUserdefault. Thanks.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SURNAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGES_DEFAULT` int(2) NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='La tabla de usuarios';

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`ID_USER`, `PASS`, `NAME`, `SURNAME`, `MAIL`, `IMAGES_DEFAULT`) VALUES
('finalUser', 'finalUser', 'Toni', 'Caourier', 'anthony@courier.org', 2),
('myUser', 'myUser', '', '', '', 7),
('user1', 'user1', '', '', '', 5),
('user10', 'user10', 'Peter', 'Griffin', 'Griffin@Friggin.com', 5),
('user11', 'user11', '', '', '', 5),
('user2', 'user2', '', '', '', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User_Collection_Photos`
--

CREATE TABLE IF NOT EXISTS `User_Collection_Photos` (
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_COLLECTION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_PHOTO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_COLLECTION` (`ID_COLLECTION`),
  KEY `ID_PHOTO` (`ID_PHOTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Una relación ternaria entre usuarios, colecciones y fotos';

--
-- Volcado de datos para la tabla `User_Collection_Photos`
--

INSERT INTO `User_Collection_Photos` (`ID_USER`, `ID_COLLECTION`, `ID_PHOTO`) VALUES
('myUser', 'myUserdefault', 'asdfmyUser'),
('myUser', 'myUserdefault', 'sTrashmyUser'),
('myUser', 'California', 'c1myUser'),
('myUser', 'California', 'c2myUser'),
('myUser', 'California', 'c3myUser'),
('myUser', 'California', 'c4myUser'),
('myUser', 'California', 'c5myUser'),
('myUser', 'California', 'c6myUser'),
('myUser', 'California', 'c7myUser'),
('myUser', 'California', 'c8myUser'),
('finalUser', 'finalUserdefault', 'esciffinalUser'),
('user11', 'user11default', 'atlas!user11'),
('user11', 'This is punk rock!', 'Kid Dinamite!user11'),
('user11', 'This is punk rock!', 'atlas!user11');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Allow`
--
ALTER TABLE `Allow`
  ADD CONSTRAINT `allow_ibfk_1` FOREIGN KEY (`ID_COLLECTION`) REFERENCES `Collections` (`ID_COLLECTION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allow_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Authorize`
--
ALTER TABLE `Authorize`
  ADD CONSTRAINT `authorize_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `Admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authorize_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Ban`
--
ALTER TABLE `Ban`
  ADD CONSTRAINT `ban_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `Admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ban_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Collections`
--
ALTER TABLE `Collections`
  ADD CONSTRAINT `collections_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `Admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `collections_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Notify`
--
ALTER TABLE `Notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`ID_ADMIN`) REFERENCES `Admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notify_ibfk_2` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Photos`
--
ALTER TABLE `Photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Report`
--
ALTER TABLE `Report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`ID_COLLECTION`) REFERENCES `Collections` (`ID_COLLECTION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Send_mail`
--
ALTER TABLE `Send_mail`
  ADD CONSTRAINT `send_mail_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `send_mail_ibfk_2` FOREIGN KEY (`ID_USER_TO`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `User_Collection_Photos`
--
ALTER TABLE `User_Collection_Photos`
  ADD CONSTRAINT `user_collection_photos_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `Users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_collection_photos_ibfk_2` FOREIGN KEY (`ID_COLLECTION`) REFERENCES `Collections` (`ID_COLLECTION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_collection_photos_ibfk_3` FOREIGN KEY (`ID_PHOTO`) REFERENCES `Photos` (`ID_PHOTO`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
