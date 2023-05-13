-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2023 a las 06:38:35
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_perla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `ID_Account` varchar(5) NOT NULL,
  `Customer` varchar(5) NOT NULL,
  `AccountNumber` varchar(16) NOT NULL,
  `CVV` int(4) NOT NULL,
  `DueDate` date NOT NULL,
  `Balance` int(11) NOT NULL,
  `AccountType` varchar(50) NOT NULL,
  `OpeningDate` date NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`ID_Account`, `Customer`, `AccountNumber`, `CVV`, `DueDate`, `Balance`, `AccountType`, `OpeningDate`, `Status`) VALUES
('CBC13', 'BC440', '8207523131443849', 453, '2026-03-11', 1500, 'Ahorros', '2023-03-01', 'Activo'),
('CBC92', 'BC440', '4697741874632649', 223, '2027-03-16', 3000, 'Corriente', '2023-03-14', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branchmanagers`
--

CREATE TABLE `branchmanagers` (
  `ID_BranchManagers` varchar(5) NOT NULL,
  `BranchManager` varchar(5) NOT NULL,
  `BranchOffice` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `branchmanagers`
--

INSERT INTO `branchmanagers` (`ID_BranchManagers`, `BranchManager`, `BranchOffice`) VALUES
('13931', 'EF707', 'LA876');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branchoffices`
--

CREATE TABLE `branchoffices` (
  `ID_BranchOffice` varchar(5) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Municipality` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `branchoffices`
--

INSERT INTO `branchoffices` (`ID_BranchOffice`, `Department`, `Municipality`, `Address`) VALUES
('LA876', 'La Libertad', 'Antiguo Cuscatlán', 'La Libertad, Antiguo Cuscatlán'),
('SS289', 'San Salvador', 'San Salvador', 'San Salvador, San Salvador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `ID_Cliente` varchar(5) NOT NULL,
  `Names` varchar(100) NOT NULL,
  `Surnames` varchar(100) NOT NULL,
  `DUI` varchar(10) NOT NULL,
  `Salary` int(11) NOT NULL,
  `Residence` varchar(255) NOT NULL,
  `PhoneNumber` varchar(9) NOT NULL,
  `UserAccount` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`ID_Cliente`, `Names`, `Surnames`, `DUI`, `Salary`, `Residence`, `PhoneNumber`, `UserAccount`) VALUES
('BC440', 'Bryan Steven', 'Cornejo Zavala', '86839141-1', 2000, 'San Salvador', '1234-5678', 'BC440'),
('CR380', 'Cesar Elias', 'Rodas Gonzales', '47808888-2', 780, 'La Libertad', '1234-5678', 'CR380');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `ID_Employee` varchar(5) NOT NULL,
  `Names` varchar(100) NOT NULL,
  `Surnames` varchar(100) NOT NULL,
  `DUI` varchar(10) NOT NULL,
  `PhoneNumber` varchar(9) NOT NULL,
  `Position` varchar(5) NOT NULL,
  `HiringType` varchar(100) NOT NULL,
  `Residence` varchar(255) NOT NULL,
  `BranchOffice` varchar(5) NOT NULL,
  `UserAccount` varchar(5) DEFAULT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`ID_Employee`, `Names`, `Surnames`, `DUI`, `PhoneNumber`, `Position`, `HiringType`, `Residence`, `BranchOffice`, `UserAccount`, `Status`) VALUES
('AV502', 'Angie Michelle', 'Valencia Ramos', '87539451-2', '1234-5678', 'CJ202', 'Fijo', 'San Salvador', 'SS289', 'AV520', 'Activo'),
('DC242', 'Diego Ernesto', 'Chevez Montes', '46688156-1', '1234-5678', 'GG302', 'Fijo', 'San Salvador', 'SS289', 'DC242', 'Activo'),
('EF707', 'Erick Eduardo', 'Fuentes García', '15518687-1', '1234-5678', 'GS684', 'Fijo', 'La Libertad', 'LA876', 'EF702', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lendings`
--

CREATE TABLE `lendings` (
  `ID_Lending` varchar(5) NOT NULL,
  `Moneylender` varchar(5) NOT NULL,
  `TotalAmount` double NOT NULL,
  `Interest` varchar(50) NOT NULL,
  `Amount` double NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lendings`
--

INSERT INTO `lendings` (`ID_Lending`, `Moneylender`, `TotalAmount`, `Interest`, `Amount`, `Status`) VALUES
('PCR93', 'CR380', 1030, '3%', 1000, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `ID_Payment` varchar(5) NOT NULL,
  `ID_Lending` varchar(5) NOT NULL,
  `Payment` double NOT NULL,
  `CurrentLending` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`ID_Payment`, `ID_Lending`, `Payment`, `CurrentLending`) VALUES
('12926', 'PCR93', 60, 970);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `ID_Position` varchar(5) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`ID_Position`, `Position`, `Description`, `Salary`) VALUES
('AF777', 'Asesor Financiero', '...', 500),
('CJ202', 'Cajero', 'Persona que tiene por oficio llevar el control de caja y atender los pagos y cobros en ciertos establecimientos', 450),
('GG302', 'Gerente General', 'Persona encargada de aceptar o rechazar las acciones de personal\r\ngeneradas por el gerente de sucursal', 2500),
('GS684', 'Gerente de sucursal', 'Persona encargada de las actividades administrativas de la sucursal del\r\nbanco', 780),
('PL651', 'Personal de Limpieza', '...', 380),
('RC816', 'Recepcionistas', '...', 480),
('SC166', 'Secretarias', '...', 480);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_Role` varchar(5) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_Role`, `Role`, `Description`) VALUES
('CJ922', 'Cajero', '..'),
('CL670', 'Cliente', '...'),
('DP121', 'Dependiente', '...'),
('GG129', 'Gerente General', '...'),
('GS181', 'Gerente de Sucursal', '..');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `ID_Transaction` varchar(5) NOT NULL,
  `OwnAccount` varchar(5) NOT NULL,
  `DateRealization` date NOT NULL,
  `CompletionTime` time NOT NULL,
  `Balance` double NOT NULL,
  `PaymentConcept` varchar(255) NOT NULL,
  `CurrentBalance` double NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transactions`
--

INSERT INTO `transactions` (`ID_Transaction`, `OwnAccount`, `DateRealization`, `CompletionTime`, `Balance`, `PaymentConcept`, `CurrentBalance`, `Status`) VALUES
('TBC62', 'CBC92', '2023-03-04', '16:31:16', 50, 'PayPal', 3050, 'Realizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_User` varchar(5) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Role` varchar(5) NOT NULL,
  `Mail` varchar(100) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_User`, `Username`, `Role`, `Mail`, `Password`, `RegistrationDate`, `Status`) VALUES
('AV520', 'Angie.Valencia', 'CJ922', 'angie.valencia@gmail.com', 'passwd123', '2023-03-13', 'Activo'),
('BC440', 'Bryan.Cornejo', 'DP121', 'bryan.cornejo@gmail.com', 'passwd123', '2023-03-13', 'Activo'),
('CR380', 'Cesar.Rodas', 'CL670', 'rodas.gonzales@gmail.com', 'passwd123', '2023-03-13', 'Activo'),
('DC242', 'Diego.Chevez', 'GG129', 'diego.chevez@gmail.com', 'passwd123', '2023-03-13', 'Activo'),
('EF702', 'Erick.Fuentes', 'GS181', 'erick.fuentes@gmail.com', 'passwd123', '2023-03-13', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID_Account`),
  ADD UNIQUE KEY `AccountNumber` (`AccountNumber`),
  ADD UNIQUE KEY `CVV` (`CVV`),
  ADD KEY `Customer` (`Customer`);

--
-- Indices de la tabla `branchmanagers`
--
ALTER TABLE `branchmanagers`
  ADD PRIMARY KEY (`ID_BranchManagers`),
  ADD KEY `BranchOffice` (`BranchOffice`),
  ADD KEY `BranchManager` (`BranchManager`);

--
-- Indices de la tabla `branchoffices`
--
ALTER TABLE `branchoffices`
  ADD PRIMARY KEY (`ID_BranchOffice`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD KEY `UserAccount` (`UserAccount`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID_Employee`),
  ADD UNIQUE KEY `DUI` (`DUI`),
  ADD KEY `UserAccount` (`UserAccount`),
  ADD KEY `Position` (`Position`),
  ADD KEY `BranchOffice` (`BranchOffice`);

--
-- Indices de la tabla `lendings`
--
ALTER TABLE `lendings`
  ADD PRIMARY KEY (`ID_Lending`),
  ADD KEY `Moneylender` (`Moneylender`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID_Payment`),
  ADD KEY `ID_Lending` (`ID_Lending`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`ID_Position`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Role`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID_Transaction`),
  ADD KEY `OwnAccount` (`OwnAccount`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `Mail` (`Mail`),
  ADD KEY `Role` (`Role`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`Customer`) REFERENCES `customers` (`ID_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `branchmanagers`
--
ALTER TABLE `branchmanagers`
  ADD CONSTRAINT `branchmanagers_ibfk_1` FOREIGN KEY (`BranchManager`) REFERENCES `employees` (`ID_Employee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `branchmanagers_ibfk_2` FOREIGN KEY (`BranchOffice`) REFERENCES `branchoffices` (`ID_BranchOffice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`UserAccount`) REFERENCES `users` (`ID_User`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`UserAccount`) REFERENCES `users` (`ID_User`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`Position`) REFERENCES `positions` (`ID_Position`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`BranchOffice`) REFERENCES `branchoffices` (`ID_BranchOffice`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lendings`
--
ALTER TABLE `lendings`
  ADD CONSTRAINT `lendings_ibfk_1` FOREIGN KEY (`Moneylender`) REFERENCES `customers` (`ID_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ID_Lending`) REFERENCES `lendings` (`ID_Lending`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`OwnAccount`) REFERENCES `accounts` (`ID_Account`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `roles` (`ID_Role`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
