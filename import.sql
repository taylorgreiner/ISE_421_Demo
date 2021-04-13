-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2021 at 07:21 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ManCo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assets`
--

CREATE TABLE `Assets` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `in_use` tinyint(1) NOT NULL,
  `install_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Assets`
--

INSERT INTO `Assets` (`id`, `name`, `cost`, `in_use`, `install_date`) VALUES
(1, 'CNC Machine', '100001.00', 1, '2021-04-01'),
(2, 'Lathe 2', '25000.00', 25, '2020-07-01'),
(3, 'Mixer', '10000.00', 0, '2021-04-14'),
(4, 'CNC Machine #2', '1.00', 0, '2021-04-17'),
(5, 'Lathe', '342.00', 1, '2021-04-13'),
(17, 'test', '1000.00', 1, '2021-04-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assets`
--
ALTER TABLE `Assets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assets`
--
ALTER TABLE `Assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
