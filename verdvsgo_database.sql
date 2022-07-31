-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verdvsgo_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit_tb`
--

CREATE TABLE `deposit_tb` (
  `id` int(12) NOT NULL,
  `deposit_id` varchar(121) DEFAULT NULL,
  `users_unique_id` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `plan` varchar(121) NOT NULL,
  `coin_type` varchar(121) NOT NULL,
  `amount` varchar(121) NOT NULL DEFAULT '0',
  `interest` varchar(121) NOT NULL DEFAULT '0',
  `referral` varchar(121) NOT NULL,
  `ref_id` varchar(121) NOT NULL,
  `ref` varchar(121) NOT NULL DEFAULT '0',
  `day_counter` varchar(121) NOT NULL DEFAULT '0',
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `image` varchar(121) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan_tb`
--

CREATE TABLE `plan_tb` (
  `id` int(12) NOT NULL,
  `plan_id` varchar(121) NOT NULL,
  `package` varchar(121) NOT NULL,
  `min` varchar(121) NOT NULL,
  `mix` varchar(121) NOT NULL,
  `date` varchar(121) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_tb`
--

INSERT INTO `plan_tb` (`id`, `plan_id`, `package`, `min`, `mix`, `date`) VALUES
(1, '00000', 'Builder Plan', '100', '999', '5'),
(2, '8888', 'Silver Plan', '1000', '4999', '7'),
(3, '7777', 'Diamond Plan', '5000', '9999', '10'),
(4, '6666', 'Ultimate Plan', '10000', '50000', '14'),
(5, '5555', 'Business Plan', '50000', '10000000', '21');

-- --------------------------------------------------------

--
-- Table structure for table `referral_tb`
--

CREATE TABLE `referral_tb` (
  `id` int(12) NOT NULL,
  `referral_id` varchar(121) NOT NULL,
  `users_unique_id` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `plan` varchar(121) NOT NULL,
  `coin_type` varchar(121) NOT NULL,
  `amount` varchar(121) NOT NULL DEFAULT '0',
  `ref_id` varchar(121) NOT NULL,
  `referral` varchar(121) NOT NULL,
  `ref_amount` varchar(121) NOT NULL DEFAULT '0',
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral_tb`
--

INSERT INTO `referral_tb` (`id`, `referral_id`, `users_unique_id`, `username`, `plan`, `coin_type`, `amount`, `ref_id`, `referral`, `ref_amount`, `status`, `created_at`) VALUES
(74, '62d0e664c0489', '6286cba09aed2', 'JJcordeiro', 'Plano Prata', 'Usdt', '1800', '', '', '', 'pending', '2022-07-15 00:00:36.787807'),
(76, '62d0e664c11f6', '6286cba09aed2', 'JJcordeiro', 'Plano Prata', 'Usdt', '120', '6286cb', '627d6f', '', 'pending', '2022-07-15 00:00:36.791236');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(12) NOT NULL,
  `fullname` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `message` varchar(121) NOT NULL,
  `create_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `users_unique_id` varchar(121) NOT NULL,
  `fullname` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `number` varchar(121) NOT NULL,
  `password` varchar(121) NOT NULL,
  `ref_id` varchar(6) NOT NULL,
  `referral` varchar(6) NOT NULL DEFAULT 'non',
  `balance` varchar(121) NOT NULL DEFAULT '0',
  `type_of_user` varchar(12) NOT NULL DEFAULT 'users',
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `image_name` varchar(131) NOT NULL DEFAULT 'prof_icon.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_unique_id`, `fullname`, `username`, `email`, `number`, `password`, `ref_id`, `referral`, `balance`, `type_of_user`, `status`, `created_at`, `image_name`) VALUES
(128, '62d817d5654dc', 'CDCODE', 'cdcode', 'cdcode02@gmail.com', '07046561469', '16c7f43381d04f92f13b25185b0e6eb27ca31a13e6ac45f340f72c96eb6af8d2', '62d817', '<br />', '0', 'admin', 'confirmed', '2022-07-20 15:57:25.454979', 'prof_icon.png'),
(129, '62d87ee17f04c', 'Udoka NOsend money', 'Money', 'moneyman@gmail.com', '07053658670', 'c63dcf4d37f1cff7b6e48ef7b122158296d199fca0de944815e9d506903b5e2e', '62d87e', '<br />', '0', 'users', 'pending', '2022-07-20 23:17:05.534577', 'prof_icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(12) NOT NULL,
  `Bitcoin` varchar(121) NOT NULL,
  `Ethereum` varchar(121) NOT NULL,
  `Perfect` varchar(121) NOT NULL,
  `BNB` varchar(121) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `Bitcoin`, `Ethereum`, `Perfect`, `BNB`) VALUES
(1, 'djhjsbdvjsjklklsklsd', 'ffllsklidcjh', 'sdnda3224355', '89237492893892389');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(12) NOT NULL,
  `withdraw_id` varchar(121) NOT NULL,
  `users_unique_id` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `wallet` varchar(121) NOT NULL,
  `coin_type` varchar(121) NOT NULL,
  `amount` varchar(121) NOT NULL,
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `with_amount`
--

CREATE TABLE `with_amount` (
  `id` int(12) NOT NULL,
  `withdraw_id` varchar(121) NOT NULL,
  `users_unique_id` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `wallet` varchar(121) NOT NULL,
  `coin_type` varchar(121) NOT NULL,
  `amount` varchar(121) NOT NULL,
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `with_bonus`
--

CREATE TABLE `with_bonus` (
  `id` int(12) NOT NULL,
  `withbouns_id` varchar(121) NOT NULL,
  `username` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `wallet` varchar(121) NOT NULL,
  `coin_type` varchar(121) NOT NULL,
  `amount` varchar(121) NOT NULL,
  `status` varchar(121) NOT NULL DEFAULT 'pending',
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposit_tb`
--
ALTER TABLE `deposit_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deposit_id` (`deposit_id`);

--
-- Indexes for table `plan_tb`
--
ALTER TABLE `plan_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_id` (`plan_id`);

--
-- Indexes for table `referral_tb`
--
ALTER TABLE `referral_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_id` (`referral_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_unique_id` (`users_unique_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdraw_id` (`withdraw_id`);

--
-- Indexes for table `with_amount`
--
ALTER TABLE `with_amount`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withdraw_id` (`withdraw_id`);

--
-- Indexes for table `with_bonus`
--
ALTER TABLE `with_bonus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `withbouns_id` (`withbouns_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit_tb`
--
ALTER TABLE `deposit_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `plan_tb`
--
ALTER TABLE `plan_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `referral_tb`
--
ALTER TABLE `referral_tb`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `with_amount`
--
ALTER TABLE `with_amount`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `with_bonus`
--
ALTER TABLE `with_bonus`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
