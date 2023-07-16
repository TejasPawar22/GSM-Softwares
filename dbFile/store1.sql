-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 07:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0,
  `company_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`, `company_id`) VALUES
(1, 'Apple', 1, 1, ''),
(2, 'Google', 1, 1, ''),
(3, 'OnePlus', 1, 1, ''),
(4, 'Oppo', 1, 1, ''),
(5, 'Vivo', 1, 1, ''),
(6, 'Xiaomi', 1, 1, ''),
(7, 'Samsung', 1, 1, ''),
(8, 'sony', 1, 2, '6667'),
(9, 'Tanishq', 1, 1, '6667'),
(10, 'PNG', 1, 1, '6667'),
(11, 'Tanishq', 1, 1, '5656'),
(12, 'Abc', 1, 1, '6667'),
(13, 'bbb', 1, 1, '6667');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0,
  `company_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`, `company_id`) VALUES
(1, 'Android', 1, 1, ''),
(2, 'IOS', 1, 1, ''),
(3, 'Windows', 1, 1, ''),
(4, 'Ring', 2, 1, '6667'),
(5, 'Coin', 1, 2, '6667'),
(6, 'Coin', 1, 1, '6667'),
(7, 'GoldChain', 1, 1, '6667'),
(8, 'Ring', 1, 1, '5656'),
(9, 'Chain', 1, 1, '6667'),
(10, 'god', 1, 1, '6667');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_city` varchar(255) NOT NULL,
  `c_phno` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `listing_status` varchar(255) NOT NULL,
  `c_gst_no` varchar(255) NOT NULL,
  `c_description` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_photo` text NOT NULL,
  `owner_sign_photo` text NOT NULL,
  `company_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `reg_no`, `c_name`, `c_address`, `c_city`, `c_phno`, `c_email`, `listing_status`, `c_gst_no`, `c_description`, `owner_name`, `owner_photo`, `owner_sign_photo`, `company_logo`) VALUES
(30, '6667', 'Spidersweb', 'pune\r\nPune', 'pcmc', '1234567', 'spiderswebs2244@gmail.com', 'active', 'aaa77', 'gload software', 'rahul', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `Invoice_No` varchar(255) NOT NULL,
  `Invoice_Date` date NOT NULL DEFAULT current_timestamp(),
  `Client_Name` varchar(255) NOT NULL,
  `ClientContactNo.` varchar(255) NOT NULL,
  `GrandTotal` int(255) NOT NULL,
  `Discount` int(255) NOT NULL,
  `GST` int(255) NOT NULL,
  `PaidAmount` int(255) NOT NULL,
  `DueAmount` int(255) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0,
  `company_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `Invoice_No`, `Invoice_Date`, `Client_Name`, `ClientContactNo.`, `GrandTotal`, `Discount`, `GST`, `PaidAmount`, `DueAmount`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`, `company_id`) VALUES
(1, '', '2023-06-04', '', '', 0, 0, 0, 0, 0, 1, 3, '1', '84999', '84999.00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_purity` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_weight` varchar(255) NOT NULL,
  `product_gm` varchar(255) NOT NULL,
  `product_date` date NOT NULL DEFAULT current_timestamp(),
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `company_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `product_purity`, `product_type`, `product_code`, `product_weight`, `product_gm`, `product_date`, `rate`, `active`, `status`, `company_id`) VALUES
(1, 'Mi 11X Pro 128 GB, 8 GB RAM, Cosmic Black, Smartphone', 'Mi-11X-Pro-Smart-Phones-491996699-i-1-1200Wx1200H.jpg', 6, 1, '100', '', '', '', '', '', '2023-06-04', '38999', 2, 2, ''),
(2, 'Apple iPhone 12 Pro 256 GB, Pacific Blue', 'Apple-12-Pro-Smartphones-491901565-i-1-1200Wx1200H.jpg', 1, 2, '40', '', '', '', '', '', '2023-06-04', '124700', 2, 2, ''),
(3, 'Samsung Galaxy Z Flip 256 GB, 8 GB RAM', 'Samsung-Galaxy-Z-Flip-Purple-8-256-7-3-SmartPhone-491666900-i-1-1200Wx1200H.jpg', 7, 1, '46', '', '', '', '', '', '2023-06-04', '84999', 1, 1, ''),
(4, 'Gold Coin', 'Screenshot 2023-06-03 130926.png', 1, 3, '20', '', '', '', '', '', '2023-06-04', '22000', 2, 2, '6667'),
(5, 'gold coin lakshmi devi', 'Screenshot 2023-06-03 130926.png', 2, 1, '5', '50', 'coin', '002', '40g', '50g', '2023-06-04', '3000', 2, 2, '6667'),
(6, 'Lakshmi Gold Coin', 'Screenshot 2023-06-03 130926.png', 9, 6, '10', '24k', 'coin', '099', '100gm', 'NA', '2023-06-05', '4000', 1, 1, '6667'),
(7, 'goldring', 'Screenshot 2023-06-03 130926.png', 11, 8, '100', '24k', 'ring', '123ring', '10gm', 'Male', '2023-06-05', '10000', 1, 1, '5656'),
(8, 'chain', 'WhatsApp Image 2023-06-05 at 13.03.58.jpg', 9, 7, '100', '24k', 'chain', '1234', '10gm', 'female', '2023-06-05', '12000', 1, 1, '6667'),
(9, 'god', 'WhatsApp Image 2023-06-05 at 13.03.59.jpg', 9, 6, '100', '24k', 'god', '123', '10gm', 'female', '2023-06-05', '10000', 1, 1, '6667');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `company_id`) VALUES
(30, 'shital', '27f9d0c1d6139076d95bcdc9ce6912b0', 'spiderswebs2244@gmail.com', '6667');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
