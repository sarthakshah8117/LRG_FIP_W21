-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2021 at 06:26 PM
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
-- Database: `lrg_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partners`
--

DROP TABLE IF EXISTS `tbl_partners`;
CREATE TABLE IF NOT EXISTS `tbl_partners` (
  `user_id` varchar(20) NOT NULL,
  `partner_name` varchar(255) NOT NULL,
  `partner_image` varchar(244) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_partners`
--

INSERT INTO `tbl_partners` (`user_id`, `partner_name`, `partner_image`) VALUES
('1', 'alliance', 'alliance.jpg'),
('2', 'hockeycanada', '	\r\nhockeycanada.jpg'),
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
  `user_lname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `priviledge` varchar(255) NOT NULL,
  `user_pass` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` int(11) NOT NULL,
  `expiry` varchar(20) NOT NULL,
  `user_ip` varchar(50) NOT NULL DEFAULT 'no',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_lname`, `position`, `user_name`, `priviledge`, `user_pass`, `user_email`, `user_date`, `last_login`, `expiry`, `user_ip`, `status`) VALUES
(1, 'jaskaran', 'singh', 'backend developer', 'singh', 'admin', 'b8QOTmBqGpM80wMXxv0aN0z9dhiikL1trvG4f3cPFRztUKDeiUD58+nuYeCTj1ql6lzPsBVMRK+NHmgnDfbhog==', 'jaskaransingh9669@gmail.com', '2021-03-25 18:25:59', 1616696084, '1922331600', '::1', 1),
(5, 'carl', 'vink', 'president', 'carl vink', 'admin', 'zmszh9TNJwPRn77wkDEO0HLe5IPo5WHyoHPrVOGSh9g1o2/q7JVfpphIbZWb9Nf7E42UxqttCyNfVex+hVv6TA==', 'president@londonrefereesgroup.com', '2021-03-25 07:57:30', 1616659022, '1922331600', '::1', 1),
(6, 'joe', 'masse', 'vice president', 'joe', 'admin', 'DoaE/9gLDwhoEbNuIA2Sh2cE351hliaJqCJrThROZlQ7wEDuor4ZVcek1wosUNpf2t4QVfhrKQGWxOvo9e0l7w==', 'vp@londonrefereesgroup.com', '2021-03-25 17:32:17', 1616693465, '1922331600', '::1', 1),
(7, 'rob', 'neable', 'treasurer', 'rob', 'admin', 'ktEyNRhwpJ2S/KBNhsq4P0Vqsp6Ea1ty9n4ENELzPTP1C3aCK7c3qVTXUAoeRdJkOwImQ8JchPq7nAU4eqkxBg==', 'tresurer@londonrefereesgroup.com', '2021-03-25 17:34:52', 1616693692, '1922331600', '::1', 1),
(8, 'john', 'bray', 'secretary', 'john', 'admin', 'aWzt8KtfzRqj2OtoSy7Rcb4qdro1iveuUd2ECnnhu1BqoXYZEahlG2/Eoaots6Aw8W/VOTc3Z7aD6DAPpMQbdg==', 'secretary@londonrefereesgroup.com', '2021-03-25 17:40:33', 1616694033, '1922331600', '::1', 1),
(9, 'bob', 'wright', 'ric', 'bob', 'admin', 'hc2DHmGNcWQM41zbEyQTdlYTkVfVqBAfhSZ1JN/AyHPqKjITNbYSJzjgnXgopxP62ymI2FYuEqMfSuDU1a2wJQ==', 'ric@londonrefereesgroup.com', '2021-03-25 17:52:59', 1616694779, '1922331600', '::1', 1),
(10, 'paul', 'raes', 'rep 1', 'paul', 'admin', 'lxw4XL8XC9j+S8U9XfLIt6Qqcel1SwhA7gVQ7euS00ylf56lfbRjPX6M3U6YIXhsqqNQ/88pNQ5ak8yqj/9x9A==', 'rep1@londonrefereesgroup.com', '2021-03-25 17:56:41', 1616695001, '1922331600', '::1', 1),
(11, 'mel', 'alexander', 'rep 2', 'mel', 'admin', 'mJJacI6/+Lyg5P0V+BAn/ILi4p6h8Ypvx5WEtRMAFl3ECTG2b2/LFCoXsh++LqeYpvvNl0GoxrDtS4OfjtHFxw==', 'rep2@londonrefereesgroup.com', '2021-03-25 18:01:27', 1616695287, '1922331600', '::1', 1),
(12, 'marc', 'giroux', 'assignor 1', 'marc', 'admin', '+o5MAaOaTJR4cWjri8YI7Cyjl6d9fwM0sr9lPWUUZb+qLS4drvJpiC8F7zWfqapFcVbTnoQLomQPKXO9n9/R9w==', 'assignor1@londonrefereesgroup.com', '2021-03-25 18:05:59', 1616695535, '1922331600', '::1', 1),
(13, 'jamie', 'dewar', 'assignor 2', 'jamie', 'admin', '3pYbLSsoZnLzdrWudsMcP+s1mcnD0aJrBt3qmeePgMvGF34qJpITANSG0F6e3odNi78zhNRgEFJiyKzxcOHCpw==', 'assignor2@londonrefereesgroup.com', '2021-03-25 18:08:04', 1616695684, '1922331600', '::1', 1),
(15, 'paul', 'schofield', 'scheduler', 'schofield', 'admin', 'umXhNThTBnBH1rfnfy+qsEzGY+lp354ISJcKcKpul9N9LH0y6HaaQJgws3WzrePpkw1q3XWyKsP3fMdPLgImTA==', 'scheduler@londonrefereesgroup.com', '2021-03-25 18:15:44', 1616696144, '1922331600', '::1', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
