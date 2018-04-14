-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2018 at 08:26 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TripBuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_name`) VALUES
('Amsterdam Airport Schiphol'),
('Charles de Gaulle Airport'),
('Dubai International Airport'),
('John F. Kennedy International Airport'),
('Melbourne Airport'),
('Montréal–Pierre Elliott Trudeau International Airport'),
('Murtala Muhammed International Airport'),
('Narita International Airport'),
('Noi Bai International Airport'),
('Rio de Janeiro International Airport');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flightID` varchar(8) NOT NULL,
  `orig_airport` varchar(124) NOT NULL,
  `dest_airport` varchar(124) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flightID`, `orig_airport`, `dest_airport`) VALUES
('AA3423', 'John F. Kennedy International Airport', 'Rio de Janeiro International Airport'),
('AA5382', 'John F. Kennedy International Airport', 'Melbourne Airport'),
('AA6345', 'Rio de Janeiro International Airport', 'John F. Kennedy International Airport'),
('AA9374', 'Melbourne Airport', 'John F. Kennedy International Airport'),
('AC2345', 'Charles de Gaulle Airport', 'Montréal–Pierre Elliott Trudeau International Airport'),
('AC2346', 'Montréal–Pierre Elliott Trudeau International Airport', 'Charles de Gaulle Airport'),
('AF2343', 'Amsterdam Airport Schiphol', 'Charles de Gaulle Airport'),
('AF3423', 'Charles de Gaulle Airport', 'Amsterdam Airport Schiphol'),
('AF5345', 'Charles de Gaulle Airport', 'Murtala Muhammed International Airport'),
('AF5453', 'Murtala Muhammed International Airport', 'Charles de Gaulle Airport'),
('NH1123', 'Narita International Airport', 'Montréal–Pierre Elliott Trudeau International Airport'),
('NH1124', 'Montréal–Pierre Elliott Trudeau International Airport', 'Narita International Airport'),
('NH2353', 'Charles de Gaulle Airport', 'Narita International Airport'),
('NH4509', 'Noi Bai International Airport', 'Narita International Airport'),
('NH5453', 'Narita International Airport', 'Charles de Gaulle Airport'),
('QR2343', 'Dubai International Airport', 'Amsterdam Airport Schiphol'),
('QR2344', 'Amsterdam Airport Schiphol', 'Dubai International Airport'),
('QR3242', 'Montréal–Pierre Elliott Trudeau International Airport', 'Dubai International Airport'),
('QR3243', 'Dubai International Airport', 'Montréal–Pierre Elliott Trudeau International Airport'),
('QR9598', 'Noi Bai International Airport', 'Dubai International Airport'),
('QR9894', 'Dubai International Airport', 'Noi Bai International Airport'),
('VN3085', 'Narita International Airport', 'Noi Bai International Airport'),
('WJ3092', 'John F. Kennedy International Airport', 'Montréal–Pierre Elliott Trudeau International Airport'),
('WJ3093', 'Montréal–Pierre Elliott Trudeau International Airport', 'John F. Kennedy International Airport');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `tripID` varchar(8) NOT NULL,
  `username` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`tripID`, `username`, `type`) VALUES
('10974843', 'admin', 'One-way'),
('23705617', 'test1', 'Multi-city'),
('26229432', 'admin', 'Multi-city'),
('35116947', 'test2', 'One-way'),
('46704407', 'test1', 'Multi-city'),
('73857857', 'test1', 'Round-trip'),
('90403470', 'admin', 'One-way'),
('96798857', 'admin', 'One-way');

-- --------------------------------------------------------

--
-- Table structure for table `tripFlights`
--

CREATE TABLE `tripFlights` (
  `tripID` varchar(8) NOT NULL,
  `flightID` varchar(8) NOT NULL,
  `orderNB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tripFlights`
--

INSERT INTO `tripFlights` (`tripID`, `flightID`, `orderNB`) VALUES
('10974843', 'AF2343', 1),
('23705617', 'AF2343', 2),
('23705617', 'QR2343', 1),
('26229432', 'AC2345', 2),
('26229432', 'AF2343', 1),
('35116947', 'QR2344', 1),
('46704407', 'AC2346', 2),
('46704407', 'QR9598', 1),
('73857857', 'NH4509', 2),
('73857857', 'VN3085', 1),
('90403470', 'QR2344', 1),
('96798857', 'QR2344', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`) VALUES
('admin'),
('test1'),
('test2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_name`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flightID`),
  ADD KEY `fk_orig_airport` (`orig_airport`),
  ADD KEY `fk_dest_airport` (`dest_airport`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`tripID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `tripFlights`
--
ALTER TABLE `tripFlights`
  ADD PRIMARY KEY (`tripID`,`flightID`),
  ADD KEY `flightID` (`flightID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `fk_dest_airport` FOREIGN KEY (`dest_airport`) REFERENCES `airport` (`airport_name`),
  ADD CONSTRAINT `fk_orig_airport` FOREIGN KEY (`orig_airport`) REFERENCES `airport` (`airport_name`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `tripFlights`
--
ALTER TABLE `tripFlights`
  ADD CONSTRAINT `tripflights_ibfk_1` FOREIGN KEY (`tripID`) REFERENCES `trip` (`tripID`),
  ADD CONSTRAINT `tripflights_ibfk_2` FOREIGN KEY (`flightID`) REFERENCES `flight` (`flightID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
