-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2020 at 10:51 AM
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
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `email`, `mobile`, `status`) VALUES
(1, 'admin', 'admin', 0, '', '', 1),
(2, 'zia', 'zia', 1, 'zia@zia.com', '9862145789', 1),
(3, 'shayan', 'shayan', 1, 'shayan@shayan.com', '9632668745', 1),
(4, 'areeb', 'areeb', 1, 'areeb@areeb.com', '9213653248', 1);

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
(14, 1, 'Kurtis, Tunics and Tops', 1),
(17, 2, 'subCat1', 1),
(18, 3, 'T-Shirts', 1),
(21, 3, 'Jeans', 1),
(22, 3, 'Track Pants and Pyjamas', 1),
(26, 2, 'Indian and Fusion Wear and Fusion Wear', 1);

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `order_status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES
(1, 17, 'Home', 987456321, '544 Balaganj', 'lko', 226001, 'cod', 24, 'success', 1, '2020-08-30 07:14:35'),
(2, 17, 'Zaa', 564563125, '6559/52 Balaganj', 'lko', 226001, 'cod', 1698, 'success', 1, '2020-09-01 10:37:15'),
(3, 17, 'a', 564563125, '6559/52 Balaganj', 'lko', 226001, 'cod', 159, 'success', 1, '2020-09-01 06:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 28, 1, 1),
(2, 1, 29, 1, 23),
(3, 2, 25, 1, 1299),
(4, 2, 23, 1, 399),
(5, 0, 24, 1, 159),
(6, 0, 25, 1, 1299),
(7, 0, 15, 1, 4299),
(8, 3, 24, 1, 159),
(9, 0, 24, 1, 159),
(10, 0, 23, 1, 399),
(11, 0, 22, 4, 899),
(12, 0, 24, 1, 159),
(13, 0, 19, 1, 4299),
(14, 0, 24, 1, 159);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Cancelled'),
(5, 'Complete');

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
  `brand` varchar(70) NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` smallint(6) NOT NULL,
  `fabric` varchar(20) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `brand`, `color`, `size`, `fabric`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `added_by`, `status`) VALUES
(15, 18, 'Maxi Dress', 4799, 4299, 4, '991190464_1 (1).jpg', 'BIBA', 'brown', 32, 'VELVET', 'Women\'s dress', 'Top Fabric - Digital Print Lycra and Slub Silk with Two-Tone Silky Yoke., Inner - Santoon., Bottom - N/A., Dupatta - Two-Tone', '', '', '', 0, 1),
(17, 18, 'New Autumn Maxi', 1299, 1099, 565, '761452992_1 (2).jpg', 'LEVIS', 'black', 34, 'CHIFFON', 'Women Dress', '2016 New Autumn Maxi Women Dress Ladies Blue Knee Length Elegant Casual Shirt Dresses', '', '', '', 0, 1),
(18, 17, 'Pink Sleeveless Halter Neck', 21599, 6599, 8, '605444974_1 (3).jpg', 'AURELIA', 'pink', 36, 'COTTON', 'Women Bridesmaid Dress', 'Women Bridesmaid Dress Pink Sleeveless Halter Neck High Waist Party Cocktail Dresses', '', '', '', 0, 1),
(19, 17, 'Applecreation Cotton Women\'s Dress', 5499, 4299, 6, '949996431_1 (4).jpg', 'BIBA', 'blue', 38, 'DENIM', 'Women\'s Dress', 'Applecreation Cotton Women\'s Dress Material (Dresses 12Drd15011_Navy Blue, Free Size)', '', '', '', 0, 1),
(20, 18, 'VINTAGE COCKTAIL DRESS', 35699, 54599, 10, '738137794_1 (5).jpg', 'H&M', 'blue', 40, 'POPLIN', 'Womens dress', 'Formal Maxi Chiffon Slim DressElegant A-line Lace DressesCasual Short Sleeves Evening DressesThe dress is for the evening party, cocktail, work or other formal occasions.Hand wash with cold water, please do not iron.', '', '', '', 0, 1),
(21, 17, 'Faux Georgette Dress', 45499, 1799, 10, '520722288_1 (2).jpeg', 'FABINDIA', 'green', 32, 'COTTON', 'Womens dress', 'Fabric Details :- Top :- Faux Georgette Embroidery work + Stone\r\nSleeves :- Faux Georgette Embroidery work + Stone\r\nInner :- Santoon\r\nBottom :- Santoon\r\nDupatta :- Nazmin Chiffon with Siqwans Emb.work', '', '', '', 0, 1),
(22, 14, 'Women Gown', 999, 899, 12, '318249750_1 (3).jpeg', 'WESTSIDE', 'blue', 36, 'VELVET', 'Women Gown', 'Women Gown Green Dress', '', '', '', 0, 1),
(23, 14, 'Women\'s net', 799, 399, 44, '345573862_1 (6).jpg', 'FABINDIA', 'brown', 40, 'CHIFFON', 'Women\'s net Dress', 'Royal Export Women\'s net Dress Material', '', '', '', 0, 1),
(24, 14, 'Black Dress', 799, 159, 10, '586252605_1 (4).jpeg', 'H&M', 'gray', 38, 'POPLIN', 'Black Dress', 'Women A-line Black Dress', '', '', '', 0, 1),
(25, 14, 'Latest Ladies Dress', 2299, 1299, 10, '329171796_1 (1).jpeg', 'WESTSIDE', 'green', 34, 'COTTON', 'Latest Ladies Dress', 'Specifications:\r\n- Color : Light Blue\r\n- Work : Printed\r\n- Size : S, M, L, XL', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(32) NOT NULL,
  `access` int(10) UNSIGNED DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `pending` double NOT NULL,
  `notes` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `vendor_id`, `date`, `amount`, `pending`, `notes`) VALUES
(8, 4, '2020-09-09 07:40:55', 0, 25999, '12 orders from mr Amit'),
(9, 2, '2020-09-18 07:08:39', 2599, 458, 'nothing');

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
(11, 'a', 'a', 'a', 'a', '2020-08-08 06:07:20'),
(15, 'a', 'a', 'admin@book.htb', '54', '2020-08-28 12:38:47'),
(16, 'admin', 'admin', 'a@a.comss', '6465', '2020-08-28 12:45:20'),
(17, 'Zia', 'zia', 'adrger@a.comss', '56', '2020-08-29 02:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_docs`
--

CREATE TABLE `vendor_docs` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `aadhar_card` varchar(250) NOT NULL,
  `pan_card` varchar(250) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_docs`
--

INSERT INTO `vendor_docs` (`id`, `vendor_id`, `aadhar_card`, `pan_card`, `added_on`) VALUES
(2, 4, '304636264_aadhar.jpeg', '360000863_pan.jpg', '2020-09-09 10:30:58'),
(4, 2, '818936043_aadhar.jpeg', '374842669_aadhar.jpg', '2020-09-09 10:29:16');

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_category`
--
ALTER TABLE `super_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_docs`
--
ALTER TABLE `vendor_docs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `super_category`
--
ALTER TABLE `super_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vendor_docs`
--
ALTER TABLE `vendor_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
