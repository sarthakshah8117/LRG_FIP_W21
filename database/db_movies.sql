-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2021 at 03:44 PM
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
-- Database: `db_movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `lrg_members`
--

DROP TABLE IF EXISTS `lrg_members`;
CREATE TABLE IF NOT EXISTS `lrg_members` (
  `id` varchar(20) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `email_id` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lrg_partners`
--

DROP TABLE IF EXISTS `lrg_partners`;
CREATE TABLE IF NOT EXISTS `lrg_partners` (
  `user_id` varchar(15) NOT NULL,
  `partner_name` varchar(50) NOT NULL,
  `partner_image` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lrg_partners`
--

INSERT INTO `lrg_partners` (`user_id`, `partner_name`, `partner_image`) VALUES
('1', 'alliance', 'alliance.jpg'),
('2', 'hockeycanada', 'hockeycanada.jpg'),
('3', 'OHA', 'OHA.jpg'),
('4', 'OHF', 'OHF.jpg'),
('5', 'OMHA', 'OMHA.jpg'),
('6', 'OWHA_a', 'OWHA_a.jpg'),
('7', 'sportability', 'sportability.jpg');

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
  `last_login` varchar(100) NOT NULL,
  `login_success` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_ip`, `last_login`, `login_success`) VALUES
(1, 'jaskaran', 'jas', ' lY4gfqkh/65V0UHj6nnaAZ9MsEd1bz4++hxGK1+534KSWp5StJB7ocL2Ud4BAkPWo54XjbhxFiB77RyD8zyVJg==', 'jaskaran_walia25@yahoo.in', '2021-02-12 13:58:12', '::1', '', 0),
(16, 'jas1', 'admin', 'MTltrG3ux/a+n9FMqhl1IUMbRX/Wu/S30aBNOfebYNj9nAeEA3KSenLEl2+zMXihQwZTP6D6Wp27w+xLMA79fA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 12:13:03', '::1', '2021-02-26 10:02:54am', 2),
(17, 'test', 'test', 'hdUdmCP1ac8SdKP+qd+TAcDiQVnI+g2yeCW/gA10DI3bIiFA4nTNp6FPZNndLbTpofSmcjOLw9YaL+2m+mzn3w==', 'jaskaran_walia25@yahoo.in', '2021-02-15 12:54:54', '::1', '', 0),
(18, 'test email', 'test', 'Go5AXBW0C6EPtOvUSoUkWfaq3ll54dV79Hj+ZVedsy74X8bKsIguhQ7DHPKXfB9VufI/aPj8cbg7uP0RrOY5Jg==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:04:22', 'no', '', 0),
(19, 'Jaskaran', 'admin', 'qul+/3r7IKkcZBR4MyCL0bxoVL/Mba2Kre9WhuyE3gNLXRQ2pyq3XOE1pQmzyX+5UkA56Ky2YsVgO21C0QYJOw==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:16:29', 'no', '', 2),
(20, 'Jaskaran', 'admin', 'UQet9WBT771Y2zfDagSozKOSWm3WHCASVakYS08PpVKt6Kmgy7Tj4qw7/JkDK0qtoUlVA6TTVG5nQWmOyCrhXA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 13:23:32', 'no', '', 2),
(21, 'jas', 'admintest', 'ETF+zhXoibyf3AeDC3iUBqqvfQrZ2e95AeL3mrxd30jCqtxSX1RtZjStDXxkpuBm8nFNtayEfn7P/BINrdv5JA==', 'jaskaran_walia25@yahoo.in', '2021-02-15 17:28:13', '::1', '', 0),
(22, 'Jaskaran', 'user1', 'dI3kGVtmAou8wG4AKFRIg8rnzgNkxglDhMIgkqoJ8aHIbSG9B+SNKqkfncSZZ0Gsij980heTG0hGhl+TttQySw==', 'jaskaran_walia25@yahoo.in', '2021-02-17 20:57:59', 'no', '', 0),
(25, 'flora', 'flora', 'FB3kJ31gLoNNTTZn9bxT5w28LzADzRlHoWW1xx8DaTtOk6pFUz7O7HNSKaMU01Ha8Ggq3g6Amt7GqvbdYF3GzA==', 'jaskaran_walia25@yahoo.in', '2021-02-26 14:52:50', 'no', '26-02-2021, 09:52 am', 1),
(26, 'flora', 'flora', 'G7t2TChas947RWjAAyuWWvPnWf3sWIjSPdh69C7aoyLO/35fXJr2VUJI02Cq87pcM9MwUUsFFNnAB0eqXTuaYQ==', 'jaskaran_walia25@yahoo.in', '2021-02-26 14:54:32', 'no', '26-02-2021, 09:54 am', 1),
(27, 'flora', 'flora', 'LJoBs4X9lXOd19E0wGiq7ryqCtWwdbxQPNfb8wSsRzMuQCbD9tDc0VXyRviuq7iOCElWje+XaVJM5uHyHQvtTg==', 'jaskaran_walia25@yahoo.in', '2021-02-26 14:54:57', 'no', '26-02-2021, 09:54 am', 1),
(28, 'LRG', 'LRG', '6qdaRaPzeuw0GKxyYkaGwU+8TAovoVZF0vG0L0CsMNbpA5MPl6PQ+YKR9YO0waM5xaTfa20as14a59yRiZuGKQ==', 'jaskaran_walia25@yahoo.in', '2021-02-26 15:03:38', 'no', '26-02-2021, 10:03 am', 1),
(29, 'LRG', 'LRG', 'xpLei97uJ7vaZtP2H+HjOmz6E4X8JvWsDbGmdtnZZP0DFYKQPLl73abh0T3MH6RKpoA2ydxt7bcs4YvHT4EfTw==', 'jaskaran_walia25@yahoo.in', '2021-02-26 15:06:34', 'no', '26-02-2021, 10:06 am', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
