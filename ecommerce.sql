-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 07, 2022 at 11:42 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`) VALUES
(1, 'Nike', '2022-08-01 11:27:52'),
(2, 'Adidas', '2022-08-01 11:27:52'),
(3, 'Reebok', '2022-08-01 11:27:52'),
(4, 'Dior', '2022-08-04 15:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` varchar(16) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'waiting' COMMENT 'possible values:: fulfilled == "completed", waiting = "cart still not older than 5 days", abandened = "cart was voluntarily discarded by a user"',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `created_by`, `status`, `created_at`) VALUES
(3, '62eb6142f00a9', 'fulfilled', '2022-08-04 06:06:43'),
(10, '62eb6142f00a9', 'fulfilled', '2022-08-07 10:07:59'),
(11, '62efa446c643f', 'fulfilled', '2022-08-07 11:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart_contents`
--

DROP TABLE IF EXISTS `cart_contents`;
CREATE TABLE IF NOT EXISTS `cart_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart` int(11) NOT NULL COMMENT 'cart id',
  `product` varchar(16) NOT NULL COMMENT 'product sku',
  `colour` varchar(16) NOT NULL,
  `size` varchar(16) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_contents`
--

INSERT INTO `cart_contents` (`id`, `cart`, `product`, `colour`, `size`, `added_at`) VALUES
(17, 3, 'hoo-nik-med-uni', 'Pink', 'M', '2022-08-04 15:38:17'),
(18, 3, 'tsh-adi-med-ink', 'Black', 'S', '2022-08-05 15:44:57'),
(14, 3, 'sho-gb7-nik-bla', 'Brown', '9', '2022-08-04 09:03:00'),
(13, 3, 'sho-gb6-adi-blk', 'Blue', '7', '2022-08-04 09:02:39'),
(12, 3, 'sho-gb6-adi-blk', 'Blue', '7', '2022-08-04 09:01:18'),
(19, 10, 'hoo-nik-med-uni', 'Green', 'M', '2022-08-07 10:08:00'),
(20, 11, 'sho-gb6-adi-blk', 'Black', '7', '2022-08-07 11:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `created_at`) VALUES
(1, 'Shoes', '2022-08-01 11:31:28'),
(2, 'Pants', '2022-08-01 11:31:28'),
(3, 'Hoodies', '2022-08-01 11:31:28'),
(4, 'Shirts', '2022-08-01 11:31:28'),
(5, 'Shorts', '2022-08-01 11:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(16) NOT NULL,
  `cart` varchar(11) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(32) NOT NULL,
  `province` varchar(32) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `branch_code` int(6) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_expiry` varchar(5) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `customer`, `cart`, `street_address`, `zip_code`, `city`, `province`, `phone_number`, `branch_code`, `card_number`, `card_expiry`, `cvv`, `created_at`) VALUES
(10, '62efa446c643f', '11', '1737 ZONE 4', '1431', '35', '3', '0634501133', 580105, '3534345345443535', '11/32', '123', '2022-08-07 11:39:52'),
(9, '62eb6142f00a9', '10', '1737 ZONE 4', '1431', '27', '3', '0611234321', 250655, '354353534', '12/44', '213', '2022-08-07 10:08:49'),
(8, '62eb6142f00a9', '3', '1737 ZONE 4', '1431', '27', '3', '0611234321', 740010, '2332423234234', '11/25', '212', '2022-08-07 09:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `province` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `province`, `added_at`) VALUES
(1, 'Alice', 1, '2022-08-04 17:19:50'),
(2, 'Butterworth', 1, '2022-08-04 17:19:50'),
(3, 'East London', 1, '2022-08-04 17:19:50'),
(4, 'Graaff-Reinet', 1, '2022-08-04 17:19:50'),
(5, 'Grahamstown', 1, '2022-08-04 17:19:50'),
(6, 'King William\'s Town', 1, '2022-08-04 17:19:50'),
(7, 'Mthatha', 1, '2022-08-04 17:19:50'),
(8, 'Port Elizabeth', 1, '2022-08-04 17:19:50'),
(9, 'Queenstown', 1, '2022-08-04 17:19:50'),
(10, 'Uitenhage', 1, '2022-08-04 17:19:50'),
(11, 'Zwelitsha', 1, '2022-08-04 17:19:50'),
(12, 'Bethlehem', 2, '2022-08-04 17:22:35'),
(13, 'Bloemfontein', 2, '2022-08-04 17:22:35'),
(14, 'Jagersfontein', 2, '2022-08-04 17:22:35'),
(15, 'Kroonstad', 2, '2022-08-04 17:22:35'),
(16, 'Odendaalsrus', 2, '2022-08-04 17:22:35'),
(17, 'Parys', 2, '2022-08-04 17:22:35'),
(18, 'Phuthaditjhaba', 2, '2022-08-04 17:22:35'),
(19, 'Sasolburg', 2, '2022-08-04 17:22:35'),
(20, 'Virginia', 2, '2022-08-04 17:22:35'),
(21, 'Welkom', 2, '2022-08-04 17:22:35'),
(22, 'Benoni', 3, '2022-08-04 17:26:56'),
(23, 'Boksburg', 3, '2022-08-04 17:26:56'),
(24, 'Brakpan', 3, '2022-08-04 17:26:56'),
(25, 'Carltonville', 3, '2022-08-04 17:26:56'),
(26, 'Germiston', 3, '2022-08-04 17:26:56'),
(27, 'Johannesburg', 3, '2022-08-04 17:26:56'),
(28, 'Krugersdorp', 3, '2022-08-04 17:26:56'),
(29, 'Pretoria', 3, '2022-08-04 17:26:56'),
(30, 'Randburg', 3, '2022-08-04 17:26:56'),
(31, 'Randfontein', 3, '2022-08-04 17:26:56'),
(32, 'Roodepoort', 3, '2022-08-04 17:26:56'),
(33, 'Soweto', 3, '2022-08-04 17:26:56'),
(34, 'Springs', 3, '2022-08-04 17:26:56'),
(35, 'Vanderbiljpark', 3, '2022-08-04 17:26:56'),
(36, 'Vereeniging', 3, '2022-08-04 17:29:04'),
(37, 'Durban', 4, '2022-08-04 17:29:04'),
(38, 'Empangeni', 4, '2022-08-04 17:29:04'),
(39, 'Ladysmith', 4, '2022-08-04 17:29:04'),
(40, 'Newcastle', 4, '2022-08-04 17:29:04'),
(41, 'Pietermaritzburg', 4, '2022-08-04 17:29:04'),
(42, 'Pinetown', 4, '2022-08-04 17:29:04'),
(43, 'Ulundi', 4, '2022-08-04 17:29:04'),
(44, 'Umlazi', 4, '2022-08-04 17:29:04'),
(45, 'Giyani', 5, '2022-08-04 17:31:00'),
(46, 'Lobowakgomo', 5, '2022-08-04 17:31:00'),
(47, 'Musina', 5, '2022-08-04 17:31:00'),
(48, 'Phalaborwa', 5, '2022-08-04 17:31:00'),
(49, 'Polokwane', 5, '2022-08-04 17:31:00'),
(50, 'Seshego', 5, '2022-08-04 17:31:00'),
(51, 'Sibasa', 5, '2022-08-04 17:31:00'),
(52, 'Thabazimbi', 5, '2022-08-04 17:31:00'),
(53, 'Emalahleni', 6, '2022-08-04 17:32:02'),
(54, 'Nelspruit', 6, '2022-08-04 17:32:02'),
(55, 'Secunda', 6, '2022-08-04 17:32:02'),
(56, 'Klerksdorp', 7, '2022-08-04 17:33:28'),
(57, 'Mahikeng', 7, '2022-08-04 17:33:28'),
(58, 'Mmbatho', 7, '2022-08-04 17:33:28'),
(59, 'Potchesfstroom', 7, '2022-08-04 17:33:28'),
(60, 'Rustenberg', 7, '2022-08-04 17:33:28'),
(61, 'Kimberley', 8, '2022-08-04 17:34:17'),
(62, 'Kuruman', 8, '2022-08-04 17:34:17'),
(63, 'Port Nolloth', 8, '2022-08-04 17:34:17'),
(64, 'Bellville', 9, '2022-08-04 17:36:44'),
(65, 'Cape Town', 9, '2022-08-04 17:36:44'),
(66, 'Constantia', 9, '2022-08-04 17:36:44'),
(67, 'George', 9, '2022-08-04 17:36:44'),
(68, 'Hopefield', 9, '2022-08-04 17:36:44'),
(69, 'Oudtshoorn', 9, '2022-08-04 17:36:44'),
(70, 'Paarl', 9, '2022-08-04 17:36:44'),
(71, 'Simon\'s Town', 9, '2022-08-04 17:36:44'),
(72, 'Stellenbosch', 9, '2022-08-04 17:36:44'),
(73, 'Swellendam', 9, '2022-08-04 17:36:44'),
(74, 'Worcester', 9, '2022-08-04 17:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `category` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `colour` varchar(32) NOT NULL,
  `size` varchar(32) NOT NULL,
  `available_colours` varchar(64) NOT NULL,
  `available_sizes` varchar(64) NOT NULL,
  `target` varchar(8) NOT NULL COMMENT 'men::women::kids',
  `unit` varchar(32) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `category`, `brand`, `colour`, `size`, `available_colours`, `available_sizes`, `target`, `unit`, `price`, `quantity`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'sho-gb7-nik-bla', 'Nike - Flex Experience Run11', 'The Nike Flex Experience Run 11 Next Nature is a lightweight, clean design that feels as good as it looks. The shoes are supportive in all the right ways with movement so natural plus, they\'re made from at least 20% recycled content by weight.', 1, 1, 'Black', '7', 'Black,Brown,Navy', '7,8,9,10,11', 'men', 'pair', 1234.50, 27, 'thumbnail_62e7bf019223d.png', '2022-08-01 13:04:40', '2022-08-04 11:03:00'),
(2, 'sho-gb6-adi-blk', 'TENSAUR RUN SHOES', 'These shoes are the perfect companion for their everyday adventures. Made with a series of recycled materials, and at least 50% recycled content, this product represents just one of our solutions to help end plastic waste.', 1, 2, 'Black', '6', 'Black,Blue', '6,7,8', 'kids', 'pair', 749.90, 20, 'thumbnail_62e7ccc9d52f8.jpg', '2022-08-01 13:04:40', '2022-08-07 13:38:54'),
(3, 'hoo-nik-med-uni', 'Nike White Drip Logo Unisex Hoodie', 'Fabric: Scuba(95% polyester and 5% spandex)\r\nRegular fit\r\nWhite drawstring, front pocket and black inner hood\r\nFabric Weight: 230 g/m².\r\nStitch Color: black or white, automatically matched based on patterns', 3, 1, 'Black', 'M', 'Black,Green,Pink', 'M,L', 'unisex', 'each', 450.00, 23, 'thumbnail_62ebe383b7ad3.jpg', '2022-08-04 15:31:51', '2022-08-07 12:08:00'),
(4, 'hoo-dio-med-uni', 'Dior Unisex Hoodie', 'Fabric: Scuba(95% polyester and 5% spandex)\r\nRegular fit\r\nWhite drawstring, front pocket and black inner hood\r\nFabric Weight: 230 g/m².\r\nStitch Color: black or white, automatically matched based on patterns', 3, 4, 'White', 'M', 'White,Yellow', 'S,M,L,XL', 'unisex', 'each', 759.00, 25, 'thumbnail_62ebe9bbe04be.jpg', '2022-08-04 15:50:08', '2022-08-04 18:14:20'),
(5, 'tsh-adi-med-ink', 'Adidas Ink Icon t-shirt', 'Fabric:100% cotton\r\nRegular fit\r\nMultiple colors available\r\nFabric weight: 180g/m².\r\nPrinting method: Print and Press\r\n', 4, 2, 'Black', 'S', 'White,Black', 'S,M', 'men', 'each', 300.00, 29, 'thumbnail_62ebecc4cbc2c.png', '2022-08-04 16:03:31', '2022-08-05 17:44:57'),
(6, 'sho-ree-med-men', 'Reebok\'s Men\'s Workout Short', '- Best for high intensity training sessions\r\n- Two front open hand pockets\r\n- Cordlock waistband closure: provides ideal fit without any bulk\r\n- Your go-to-gear for any type of workout\r\n- Polyester fabrication\r\n- Best for training\r\n- 9 inch (23 cm) inseam\r\n- Stretch woven fabric\r\n- 100% rec polyester\r\n- Plain weave', 5, 3, 'Black', 'M', 'Black', 'M,L,XL', 'men', 'each', 450.00, 15, 'thumbnail_62ebef6669ed2.jpg', '2022-08-04 16:16:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product`, `path`) VALUES
(1, 1, 'f1c88388fc2a0e38974219115fa1e4f1_62e8dfcd56136.jpg'),
(2, 1, '542c79500bca9a548b184838c1335247_62e8df7c2cf7f.jpg'),
(3, 1, 'a85efe29854fee491919a0ce5e58b916_62e8dfb0ab2e1.jpg'),
(4, 2, 'bc613da426f6efad626e7a8381537208_62e917f9bb1ae.jpg'),
(5, 2, 'b001cf3a416ce692f57e6a7bc69768d7_62e917b5aeae6.jpg'),
(6, 3, '7a67aafa4745b6eafe7a4b5178b3b91d13ec6c067e55be69cc69b95244c139b5.png'),
(7, 3, '9f20331afeb62ffb98f15668a9318f1664bae0cb161437c1b16987fa7acb6645.png'),
(8, 3, '852cec7ffdcea290c23a026197cf80c605b27c4d8ba1760a84c634f9de9a6802.png'),
(9, 4, '7909d3514720564efc7d3087214f374438aa411bf365ccf2bc030caae747cbdf.png'),
(10, 4, '8d1c8c6535d20ff9b1f93d44655b5eab65404fa7e0cb0bc070d60a2b856bb5b2.png'),
(11, 5, 'aede0a7a9e89d0cb5064ba6d158acf7367d6c3c10d681d9b2f7d6ccc94afdd33.png'),
(12, 5, 'd931cf9e25b88847ec3a601215c7cc4bd42984788e7a785ba5bc695e927ba5ee.png'),
(13, 6, '68f03499e6e1a1d25e956c7c61638c2a9e7e83564c6f5f4c4434573d599ab78f.jpg'),
(14, 6, '0ad4792a294f7a6794ce8bd84998c9fed03ad14a0b056d3da79858dc292609ca.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user` varchar(16) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(32) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  PRIMARY KEY (`user`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `user_3` (`user`),
  KEY `user_2` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user`, `street_address`, `zip_code`, `city`, `province`, `country`, `phone_number`) VALUES
('62eb6142f00a9', '1737 ZONE 4', '1431', '27', '3', 'south africa', '0611234321');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `added_at`) VALUES
(1, 'Eastern Cape', '2022-08-04 17:16:38'),
(2, 'Free State', '2022-08-04 17:16:38'),
(3, 'Gauteng', '2022-08-04 17:16:38'),
(4, 'KwaZulu-Natal', '2022-08-04 17:16:38'),
(5, 'Limpopo', '2022-08-04 17:16:38'),
(6, 'Mpumalanga', '2022-08-04 17:16:38'),
(7, 'North West', '2022-08-04 17:16:38'),
(8, 'Northern Cape', '2022-08-04 17:16:38'),
(9, 'Western Cape', '2022-08-04 17:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(16) NOT NULL,
  `names` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `verified` varchar(1) NOT NULL DEFAULT 'N',
  `verification_code` varchar(128) NOT NULL,
  `hasProfile` varchar(1) NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `names`, `email`, `password`, `verified`, `verification_code`, `hasProfile`, `created_at`, `updated_at`) VALUES
('62eb6142f00a9', 'Fana Nkosi', 'fana@mail.com', '$2y$10$IAksKol4UIlW2C/q2dLzJO62zs0OYLi9arTCFoBLiovWhIzxVL.Oe', 'Y', '71ff60b229212783bbe87e2ae9899e2e889ab22ea82945282b9e73f577c6162ae522b129e3583042eaa89b1af7ade2f9a46636287a1db7921a5cdffb50559112', 'Y', '2022-08-04 06:05:43', '2022-08-05 14:51:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
