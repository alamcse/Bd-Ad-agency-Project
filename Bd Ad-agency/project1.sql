-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2015 at 10:17 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE IF NOT EXISTS `tbl_about` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `about_description` text NOT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`about_id`, `about_description`) VALUES
(1, '<p style="text-align: justify;"><span style="font-size:18px">Welcome to BD.Ad-Agency Web Site</span></p>\r\n\r\n<p style="text-align: justify;">For small businesses to thrive, especially in a tight economy, it is beneficial to be recognized in the marketplace and to differentiate themselves from the competition. One way to accomplish this is through the use of advertising. Our&nbsp;advertising agency can work with a business to develop a campaign that can help create name and brand recognition to potential customers.</p>\r\n\r\n<p style="text-align: justify;">Our <a href="http://localhost/pp">BD.Ad-Agency</a> Site&nbsp;will work with the business to develop a campaign. This can involve everything from coming up with a promotional theme, determining the proper media to use, creating the ads, and even negotiating the prices for purchasing the advertising with the various media. This can be extremely beneficial to the business owner who has little or no advertising knowledge or has only used one type of media.</p>\r\n\r\n<p style="text-align: justify;">Our advertising agency will work with the business to develop a campaign. This can involve everything from coming up with a promotional theme, determining the proper media to use, creating the ads, and even negotiating the prices for purchasing the advertising with the various media. This can be extremely beneficial to the business owner who has little or no advertising knowledge or has only used one type of media.</p>\r\n\r\n<p style="text-align: justify;">With many small business owners being pressed for time, it is often not feasible for them to carve the necessary time out of their busy day to create a full-blown advertising campaign, even if they possess the expertise to do so. Also, if they don&rsquo;t know what they are doing, they can end up spending a lot of money on advertising that proves to be ineffective. While hiring an agency can result in an additional expense, this can be offset by the return on the investment resulting from a well-planned and executed campaign.</p>\r\n\r\n<p style="text-align: justify;">We&nbsp;can be instrumental in helping a business develop a recognized brand. Agency artists can develop logos and other design features that can become of a part of the business&rsquo;s advertising. It can also help with tailoring the brand so the business can meet the unique challenges of marketing the brand on the Internet.</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(1, 'Technology'),
(2, 'Modern Business'),
(11, 'Electronics Device'),
(12, 'Mobile Phone'),
(13, 'Desktop'),
(14, 'Laptop'),
(15, 'Camera');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` text NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`contact_id`, `contact`) VALUES
(1, '<p>Jessore</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer`
--

CREATE TABLE IF NOT EXISTS `tbl_footer` (
  `footer_id` int(11) NOT NULL AUTO_INCREMENT,
  `footer_description` varchar(255) NOT NULL,
  PRIMARY KEY (`footer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_footer`
--

INSERT INTO `tbl_footer` (`footer_id`, `footer_description`) VALUES
(1, 'All Right Reserve Our BD. Ad-Ajency 2015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_description` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_price` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `tag_id` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_timestamp` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_title`, `post_description`, `post_image`, `post_price`, `cat_id`, `tag_id`, `post_date`, `post_timestamp`, `userid`) VALUES
(26, 'Samsung Smart Phone', '<p>This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.This is Samsang smart phone post description.</p>\r\n', '26.jpg', '12000tk', 12, '4', '2015-10,31', '1446246000', 1),
(27, 'Micromax Smart Phone', '<p>This is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phoneThis is post description of micromax smart phone</p>\r\n', '27.jpg', '8000tk', 12, '5,4', '2015-10,31', '1446246000', 4),
(28, 'Laptop HP', '<p>This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.This is post description of laptop hp core i5.</p>\r\n', '28.jpg', '52000tk', 14, '3', '2015-10,31', '1446246000', 3),
(29, 'Phone', '<p>This is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phoneThis is the post description of the phone</p>\r\n', '29.jpg', '8000tk', 11, '6,3,5,7,8,4', '2015-10,31', '1446246000', 1),
(30, 'Samsung Gellaxy', '<p>This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.This is admin post description.</p>\r\n', '30.jpg', '8000tk', 11, '4', '2015-10,31', '1446246000', 0),
(31, 'Camera', '<p>This is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the cameraThis is post description of the camera</p>\r\n', '31.jpg', '2000tk', 15, '7', '2015-10,31', '1446246000', 4),
(32, 'Pendrive 8GB', '<p>This is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendriveThis is post description of pendrive</p>\r\n', '32.jpg', '400tk', 1, '8', '2015-10,31', '1446246000', 4),
(33, 'Desktop Computer', '<p>This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.This is post description of desktop computer.</p>\r\n', '33.jpg', '35000tk', 13, '6', '2015-10,31', '1446246000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`userid`, `name`, `username`, `password`, `email`, `city`, `division`, `phone`) VALUES
(1, 'Alamgir Hossain Alam', 'alam', 'alam', 'alamgir.just@gmail.com', 'Naogaon', 'Rajshahi', '01746332406'),
(2, 'CSE JUST', 'cse11', 'cse11', 'justcse11@gmail.com', 'Jessore', 'Khulna', '01557732036'),
(3, 'Jewel Rana', 'jewel', 'jewel', 'jewelrotno@gmail.com', 'Khulna', 'Rajshahi', '01738206021'),
(4, 'Monir', 'monir', 'monir', 'monirgebt@gmail.com', 'Jessore', 'Khulna', '01793093458'),
(5, 'afridi', 'shaon', '1111', 'afridi.just11@gmail.com', 'Jessore', 'Khulna', '01726991560');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`tag_id`, `tag_name`) VALUES
(3, 'Laptop'),
(4, 'Smart Phone'),
(5, 'Mobile Phone'),
(6, 'Desktop'),
(7, 'Others'),
(8, 'Pen Drive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
