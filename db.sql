-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 24, 2019 at 10:58 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kyd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$NA56deKJd7RqbMT1KEdAsebbKl4oN.mTR9FsEvG/r07ivkt8Dw/C.');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `from_date` varchar(800) NOT NULL,
  `to_date` varchar(800) NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `business_id`, `from_date`, `to_date`, `approved`) VALUES
(1, 3, 1, '12/2/2019', '24/2/2019', 1),
(2, 3, 1, '15/2/2019', '24/2/2019', 1),
(3, 3, 1, '10/08/2019', '12/08/2019', 1),
(4, 4, 2, '1212121', '121212', 1),
(5, 4, 1, '1231231', '123123', 1),
(6, 3, 2, '12-12-19', '14-12-19', 1),
(7, 5, 1, '14/09/2019', '21/09/2019', 0),
(8, 5, 1, '', '', 0),
(9, 5, 1, '', '', 0),
(10, 5, 1, '', '', 0),
(11, 5, 1, '', '', 0),
(12, 5, 1, '', '', 0),
(13, 6, 1, '28/09/2019', '30/09/2019', 0),
(14, 8, 2, '19/10/2019', '20/10/2019', 0),
(15, 9, 2, '25/11/2019', '26/11/2019', 0),
(16, 9, 2, '27/11/2019', '28/11/2019', 0),
(17, 9, 2, '28/11/2019', '29/11/2019', 0);

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `location_id` int(11) NOT NULL,
  `image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `description`, `owner_name`, `password`, `email`, `phone`, `address`, `category_id`, `approved`, `location_id`, `image`) VALUES
(1, 'Oasis', 'Hotel business', 'Vakkachan', '$2y$10$Nu2aRiiHbEORjgtMIRbz.e/FaOEoKdL.AEyeAoVH1DJaJeCfsb5s6', 'vakkachan@gmail.com', '932423123', '', 0, 0, 1, '../images/business/KSUM.png'),
(2, 'choice', 'Busienss', 'choice chettan', '$2y$10$YaXJZE2jQsmCL2Rxe1Q/Au.wWQn2hk3OKzTz7vKAVqJsZF2QWL5ou', 'choice@gmail.com', '348432', 'Palakkad', 0, 1, 2, '../images/business/KSUM.png'),
(3, 'KSUM', 'Busienss', 'ksum', '$2y$10$Vs18TYvbPVZcfRq9cyKtNevOwqlhLpXT5rKQY8G5zR1ixjNWdVoBW', 'ksum@gmail.com', '453987', 'KSUM kochi', 4, 0, 1, '../images/business/KSUM.png');

-- --------------------------------------------------------

--
-- Table structure for table `business_users`
--

CREATE TABLE `business_users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Hotel'),
(2, 'Restaurant'),
(4, 'Motel'),
(5, 'Flowers'),
(6, 'train'),
(7, 'bus');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `requested_user` int(11) NOT NULL,
  `image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `approved`, `requested_user`, `image`) VALUES
(1, 'Kochi', 'nummade kochi', 1, 3, '../images/location/kochi.jpg'),
(2, 'Kottayam', 'nummade kottayam', 1, 4, '../images/location/kottayam.jpg'),
(3, 'Kollam', 'kollam is a beautiful place', 0, 5, '../images/location/Kollam.png'),
(4, 'kannur', 'kannur is a beautiful place', 0, 5, '../images/location/kannur.png'),
(5, 'wayanad', 'wayanad is a beautiful place', 0, 5, '../images/location/wayanad.png'),
(6, 'Thrissur', 'Cultural place', 0, 9, '../images/location/Thrissur.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `business_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `description`, `business_id`, `location_id`, `user_id`) VALUES
(1, 'Nice hotel', 'This hotel is very nice to stay', 1, 0, 3),
(23, 'My reviewc', 'my review description ', 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `address`, `email`) VALUES
(3, 'Tony', 'tonytom', 'tonytom', '4353649345', 'house address', 'tony@gmai.com'),
(4, 'gokul', 'gokul', '$2y$10$EaxbEIsoe0WTEj0v2UIHQu.Z5aISoJYEY6gmJJIOc/oqhytLJ9HLa', '3234759347', 'house address2', 'gokul@gmail.com'),
(5, 'Devan', 'devan', '$2y$10$jXYdZCZ.TApaVln/V8AcdOjrf.ROyLYyglAxiKHKVLJr8oWC0f6xq', '9446938317', 'Devan H, kochi', 'devan@perleybrook.com'),
(6, 'Jishad', 'jishad', '$2y$10$jqqY02HE2XpZEAHjhyqMpu1QsYTuV3aYVxi6JYN/plWNxfdc4J2Z2', '3459834', 'Jishad bro house, kochi', 'jishad@gmail.com'),
(7, 'Melson', 'melson', '$2y$10$doNZMBc9rlCUdALMn0X.VeOU/ajc/yaUxYio.ZX1Ouc/Jfya7JvXS', '9348593', 'Melson H', 'melson@gmail.com'),
(8, 'Tony TOm', 'tony', '$2y$10$PLRlMOWr5W3H5CMhSrz2HuN.SU4gReflp6haqrrFMF5Wv6oLoyDVS', '485389', 'tony(h), ettumanoor', 'tony@gmail.com'),
(9, 'Subin', 'subin', '$2y$10$TnHcyugK0rFw3XJwcZFSveaBYPR7lRPINL.lNIDVbXBbKkOV7ocgK', '09324874782', 'KSUM kochi', 'subin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_users`
--
ALTER TABLE `business_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image` (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `business_users`
--
ALTER TABLE `business_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
