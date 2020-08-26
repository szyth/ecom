-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2020 at 07:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `super_categories_id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `super_categories_id`, `categories`, `status`) VALUES
(14, 1, 'subCat2', 1),
(17, 2, 'subCat1', 1),
(18, 3, 'subCat3', 1),
(21, 3, 'subCat4', 1),
(22, 3, 'subCat5', 1),
(26, 2, 'subCat6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(2, 'zia', 'zis@test.com', '12467999', 'Help!', '2020-08-04 21:06:06'),
(3, 'syed', 'ziaur.smash1000@gmail.com', '654564616', 'My comment', '2020-08-06 08:41:13'),
(4, '1', 'test@test.com', '8574803737', 'asdsad', '2020-08-07 06:13:51'),
(5, 'Edgy Pattern', 'domains@scrapegoat.tech', '8574803737', 'This is a amessage', '2020-08-07 07:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES
(15, 18, 'Maxi Dress', 4799, 4299, 4, '991190464_1 (1).jpg', 'Women\'s dress', 'Top Fabric - Digital Print Lycra and Slub Silk with Two-Tone Silky Yoke., Inner - Santoon., Bottom - N/A., Dupatta - Two-Tone', '', '', '', 1),
(17, 18, 'New Autumn Maxi', 1299, 1099, 565, '761452992_1 (2).jpg', 'Women Dress', '2016 New Autumn Maxi Women Dress Ladies Blue Knee Length Elegant Casual Shirt Dresses', '', '', '', 1),
(18, 17, 'Pink Sleeveless Halter Neck', 21599, 6599, 8, '605444974_1 (3).jpg', 'Women Bridesmaid Dress', 'Women Bridesmaid Dress Pink Sleeveless Halter Neck High Waist Party Cocktail Dresses', '', '', '', 1),
(19, 17, 'Applecreation Cotton Women\'s Dress', 5499, 4299, 6, '949996431_1 (4).jpg', 'Women\'s Dress', 'Applecreation Cotton Women\'s Dress Material (Dresses 12Drd15011_Navy Blue, Free Size)', '', '', '', 1),
(20, 18, 'VINTAGE COCKTAIL DRESS', 35699, 54599, 10, '738137794_1 (5).jpg', 'Womens dress', 'Formal Maxi Chiffon Slim DressElegant A-line Lace DressesCasual Short Sleeves Evening DressesThe dress is for the evening party, cocktail, work or other formal occasions.Hand wash with cold water, please do not iron.', '', '', '', 1),
(21, 17, 'Faux Georgette Dress', 45499, 1799, 10, '520722288_1 (2).jpeg', 'Womens dress', 'Fabric Details :- Top :- Faux Georgette Embroidery work + Stone\r\nSleeves :- Faux Georgette Embroidery work + Stone\r\nInner :- Santoon\r\nBottom :- Santoon\r\nDupatta :- Nazmin Chiffon with Siqwans Emb.work', '', '', '', 1),
(22, 14, 'Women Gown', 999, 899, 12, '318249750_1 (3).jpeg', 'Women Gown', 'Women Gown Green Dress', '', '', '', 1),
(23, 14, 'Women\'s net', 799, 399, 44, '345573862_1 (6).jpg', 'Women\'s net Dress', 'Royal Export Women\'s net Dress Material', '', '', '', 1),
(24, 14, 'Black Dress', 799, 159, 10, '586252605_1 (4).jpeg', 'Black Dress', 'Women A-line Black Dress', '', '', '', 1),
(25, 14, 'Latest Ladies Dress', 2299, 1299, 10, '329171796_1 (1).jpeg', 'Latest Ladies Dress', 'Specifications:\r\n- Color : Light Blue\r\n- Work : Printed\r\n- Size : S, M, L, XL', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_category`
--

CREATE TABLE `super_category` (
  `id` int(11) NOT NULL,
  `super_category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_category`
--

INSERT INTO `super_category` (`id`, `super_category`, `status`) VALUES
(1, 'Women\'s', 1),
(2, 'Men\'s', 1),
(3, 'Kid\'s', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `added_on`) VALUES
(1, 'zia', 'dfedf33513', 'dwsdad', '554545', '2020-08-04 21:06:06'),
(2, 'zia', 'sf5f5f52f12f', 'zia@e.com', '541233566', '2020-08-04 21:06:06'),
(9, 'dedsad', 'aedsdasa', 'Tesast@Teswwst.Com', '8574803737', '2020-08-08 05:06:43'),
(10, 's', 'sss', 'test@test.com', '8574803737', '2020-08-08 05:56:55'),
(11, 'a', 'a', 'a', 'a', '2020-08-08 06:07:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_category`
--
ALTER TABLE `super_category`
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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `super_category`
--
ALTER TABLE `super_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
