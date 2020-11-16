-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 15, 2020 at 03:07 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2ndshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
`pd_id` int(100) NOT NULL,
`pd_name` varchar(255) NOT NULL,
`pd_detail` varchar(255) NOT NULL,
`pd_price` int(100) NOT NULL,
`pd_img` varchar(255) NOT NULL,
`pd_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
`user_id` int(100) NOT NULL,
`type_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`pd_id`, `pd_name`, `pd_detail`, `pd_price`, `pd_img`, `pd_timestamp`, `user_id`, `type_id`) VALUES
(9, 'DELL XPS 15', 'CPU: i7 Gen 11\r\nRAM: 16\r\nSSD: 1TB', 79990, '1_khainui__Dell XPS 15.jpg', '2020-11-14 19:18:41', 1, 3),
(10, 'Lenovo Thinkpad T470', 'CPU: i7\r\nRAM: 8 GB\r\nSSD: 512 GB', 47900, '1_khainui__Lenovo Thinkpad T470 L1.jpg', '2020-11-14 19:27:53', 1, 3),
(11, 'Google Pixel 3XL', 'CPU: Snapdragon 845\r\nRAM: 8GB\r\nROM: 128GB', 24990, '1_khainui__pixel3xl.jpg', '2020-11-15 18:58:02', 1, 2),
(12, 'รถมอเตอร์ไซค์ไฟฟ้า', 'รถมอเตอร์ไซค์ไฟฟ้ารูปแพนด้า', 89990, '1_khainui__รถมอไซค์ไฟฟ้า-แพนด้า.jpg', '2020-11-15 20:23:39', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase`
--

CREATE TABLE `tb_purchase` (
`pc_id` int(100) NOT NULL,
`pc_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
`user_id` int(100) NOT NULL,
`pd` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_role_user`
--

CREATE TABLE `tb_role_user` (
`role_id` int(2) NOT NULL,
`role_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_role_user`
--

INSERT INTO `tb_role_user` (`role_id`, `role_description`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_type_product`
--

CREATE TABLE `tb_type_product` (
`type_id` int(10) NOT NULL,
`type_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_type_product`
--

INSERT INTO `tb_type_product` (`type_id`, `type_description`) VALUES
(1, 'vehicle'),
(2, 'smartphone'),
(3, 'notebook');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
`user_id` int(11) NOT NULL,
`user_fname` varchar(255) NOT NULL,
`user_lname` varchar(255) NOT NULL,
`user_username` varchar(255) NOT NULL,
`user_password` varchar(255) NOT NULL,
`user_email` varchar(255) NOT NULL,
`role_id` int(100) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `user_fname`, `user_lname`, `user_username`, `user_password`, `user_email`, `role_id`) VALUES
(1, 'เอกชัย', 'ไข่นุ้ย', 'khainui', 'khainui', 'khainui@hotmail.com', 2),
(8, 'aim', 'aim', 'aim', 'aim', 'aim@hotmail.com', 1),
(9, 'aimphaka', 'Laungphasab', 'aim123', '1234', 'aim090@gmail.com', 1),
(11, 'aim', 'aim', 'aimza', 'aimza', 'aim@gamil.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `tb_role_user`
--
ALTER TABLE `tb_role_user`
ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_type_product`
--
ALTER TABLE `tb_type_product`
ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
MODIFY `pd_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
MODIFY `pc_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_role_user`
--
ALTER TABLE `tb_role_user`
MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_type_product`
--
ALTER TABLE `tb_type_product`
MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
