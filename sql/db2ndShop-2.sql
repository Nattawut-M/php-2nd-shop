-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 14, 2020 at 01:47 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2ndshop`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
    ADD PRIMARY KEY (`pc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_purchase`
--
ALTER TABLE `tb_purchase`
    MODIFY `pc_id` int(100) NOT NULL AUTO_INCREMENT;
