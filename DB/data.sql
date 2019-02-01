-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2019 at 12:11 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sales_dashboard`
--

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `date_entered`, `date_modified`, `modified_user`, `name`, `is_parent`, `parent`, `address`, `db_name`, `password`, `username`, `status`, `deleted`) VALUES
('0559e16c-a5d9-40c3-b013-1b7530c2a1a5', '2019-01-18 12:18:22', '2019-01-18 12:18:22', '123456hgf', 'مازندران', 1, 'blank', '192.168.1.10', '4AGT', 'eff38075129fecc68c2d1df9eddb668e', 'sa', 'Active', 0),
('1ee1cd97-48c1-4ae1-aba2-59e055a8b0f0', '2019-01-18 12:19:38', '2019-02-01 05:48:40', '123456hgf', 'رامسر', 0, '0559e16c-a5d9-40c3-b013-1b7530c2a1a5', '2.144.129.241', 'Retail', 'Pa_12345', 'sa', 'Active', 0),
('81435004-8f1e-40dc-aacd-4f21c23706f4', '2019-01-18 12:19:06', '2019-02-01 05:50:10', '123456hgf', 'محمود آباد', 0, '0559e16c-a5d9-40c3-b013-1b7530c2a1a5', '5.134.193.177', 'Retail', 'Pa_12345', 'sa', 'Active', 0),
('aa41b1fe-b60d-4454-9c25-f3de0c63cf5d', '2019-01-18 12:17:39', '2019-01-18 12:17:39', '123456hgf', 'تهران', 1, 'blank', '192.168.1.9', '4AGT', 'eff38075129fecc68c2d1df9eddb668e', 'sa', 'Active', 0),
('ca38687b-e412-4f4a-8750-2d25d3679233', '2019-01-18 12:21:19', '2019-02-01 05:58:44', '123456hgf', 'فردوسی', 0, 'aa41b1fe-b60d-4454-9c25-f3de0c63cf5d', '89.40.247.184', 'Retail', 'Pa_12345', 'sa', 'Active', 0);

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`category`, `name`, `value`) VALUES
('sale_server', 'address', '2.144.129.29'),
('sale_server', 'database', '4AGT'),
('sale_server', 'password', 'Pa_12345'),
('sale_server', 'username', 'sa');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `is_admin`, `access`, `date_entered`, `date_modified`, `modified_user`, `status`, `deleted`, `avatar`) VALUES
('123456hgf', 'agt', 'e10adc3949ba59abbe56e057f20f883e', 'ابوالفضل', 'غفاری', 'agt2020@yahoo.com', '09128997081', 1, '1', '2018-12-28 00:00:00', '2019-01-03 14:47:39', '123456hgf', 1, 0, NULL),
('hnfghgffg6', 'iman', 'e10adc3949ba59abbe56e057f20f883e', 'ایمان', 'شعاری', '', '', 0, 'eyJhbmFseXRpY3MiOjEsInNhbGVzX3RhYmxlIjoxLCJicmFuY2hlcyI6MCwib3JkZXJzIjoxfQ==', '2018-12-28 00:00:00', '2019-01-18 12:46:05', '123456hgf', 1, 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
