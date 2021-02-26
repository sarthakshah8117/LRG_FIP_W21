-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2021 at 11:40 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_pass` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(50) NOT NULL DEFAULT 'no',
  `last_login` varchar(80) NOT NULL,
  `login_success` int(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_ip`, `last_login`, `login_success`) VALUES
(1, 'jaskaran', 'jas', ' lY4gfqkh/65V0UHj6nnaAZ9MsEd1bz4++hxGK1+534KSWp5StJB7ocL2Ud4BAkPWo54XjbhxFiB77RyD8zyVJg==', 'jaskaran_walia25@yahoo.in', '2021-02-12 13:58:12', '::1', '', 0),
(16, 'jas1', 'admin', 'MTltrG3ux/a+n9FMqhl1IUMbRX/Wu/S30aBNOfebYNj9nAeEA3KSenLEl2+zMXihQwZTP6D6Wp27w+xLMA79fA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 12:13:03', '::1', '', 0),
(17, 'test', 'test', 'hdUdmCP1ac8SdKP+qd+TAcDiQVnI+g2yeCW/gA10DI3bIiFA4nTNp6FPZNndLbTpofSmcjOLw9YaL+2m+mzn3w==', 'jaskaran_walia25@yahoo.in', '2021-02-15 12:54:54', '::1', '', 0),
(18, 'test email', 'test', 'Go5AXBW0C6EPtOvUSoUkWfaq3ll54dV79Hj+ZVedsy74X8bKsIguhQ7DHPKXfB9VufI/aPj8cbg7uP0RrOY5Jg==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:04:22', 'no', '', 0),
(19, 'Jaskaran', 'admin', 'qul+/3r7IKkcZBR4MyCL0bxoVL/Mba2Kre9WhuyE3gNLXRQ2pyq3XOE1pQmzyX+5UkA56Ky2YsVgO21C0QYJOw==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:16:29', 'no', '', 0),
(20, 'Jaskaran', 'admin', 'UQet9WBT771Y2zfDagSozKOSWm3WHCASVakYS08PpVKt6Kmgy7Tj4qw7/JkDK0qtoUlVA6TTVG5nQWmOyCrhXA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:23:32', 'no', '', 0),
(21, 'jas', 'admintest', 'ETF+zhXoibyf3AeDC3iUBqqvfQrZ2e95AeL3mrxd30jCqtxSX1RtZjStDXxkpuBm8nFNtayEfn7P/BINrdv5JA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 17:28:13', '::1', '', 0),
(22, 'Jaskaran', 'user1', 'dI3kGVtmAou8wG4AKFRIg8rnzgNkxglDhMIgkqoJ8aHIbSG9B+SNKqkfncSZZ0Gsij980heTG0hGhl+TttQySw==', 'jaskaran_walia25@yahoo.in', '2021-02-17 20:57:59', 'no', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
