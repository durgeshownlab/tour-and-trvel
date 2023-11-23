-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 01:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_and_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `banner_name` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `banner_text` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `package_id`, `banner_name`, `banner_image`, `banner_text`, `is_deleted`, `time_stamp`) VALUES
(5, 4, 'Fabulous Bangaluru', '65489c102683e9.45981954.jpg', 'Destination of Distinction', 0, '2023-11-06 07:55:15'),
(6, 5, 'Rishikesh Tourism', '6548a488076690.00859158.jpg', 'Capital of Yoga and Meditation', 0, '2023-11-06 08:32:08'),
(7, 6, 'Magical Goa', '6548a4bba08b15.38961712.jpg', 'White Sand Beaches of', 0, '2023-11-06 08:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `icon`, `banner`, `is_deleted`, `timestamp`) VALUES
(3, 'Adventure', '65434a80896372.98060603.jpg', '65434a808944b9.93433516.png', '', 0, '2023-11-02 07:06:40'),
(4, 'Air Rides', '65434af7321a88.66377232.jpg', '65434af731f602.00880584.png', '', 0, '2023-11-02 07:08:39'),
(5, 'Beaches', '65434b6ecac542.93061686.jpg', '65434b6ecaa570.64122589.png', '', 0, '2023-11-02 07:10:38'),
(6, 'Cruises', '65434ba80b0cb7.16445780.jpg', '65434ba80ae735.65666002.png', '', 0, '2023-11-02 07:11:36'),
(7, 'Tracking', '65434c15f12c84.17279875.jpg', '65434c15f10990.20847651.png', '', 0, '2023-11-02 07:13:25'),
(8, 'Wildlife', '65434c45ef20b0.71162806.jpg', '65434c45eefb13.65609360.png', '', 0, '2023-11-02 07:14:13'),
(9, 'test3', '6545e850ba3595.31855766.jpg', '6545e850bb1676.80357826.jpg', '6545e850bbefb0.59591477.jpg', 1, '2023-11-04 06:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `package_id`, `comment_text`, `rating`, `is_deleted`, `timestamp`) VALUES
(1, 1, 6, 'We cant thank the staff enough for all they did to make our honeymoon a paradise holiday to remember. Everything was perfect and nothing was too much trouble', 5, 0, '2023-11-03 12:43:24'),
(21, 2, 6, 'this is test review for testing take it easy', 5, 0, '2023-11-04 11:50:52'),
(22, 2, 4, 'test comment', 4, 0, '2023-11-04 12:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `mobile`, `email`, `message`, `is_deleted`, `timestamp`) VALUES
(1, 'sdffd', '3452522525', 'Durgesh@gmail.com', 'asdfsfd', 0, '2023-11-09 10:47:16'),
(2, 'we', '3452522525', 'Durgesh@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque modi consectetur est ipsam dicta debitis totam molestias voluptatum commodi accusamus, nihil ullam et iusto sequi quis explicabo? Suscipit, quaerat similique?', 0, '2023-11-14 05:53:28'),
(3, 'test', '3452522525', 'Durgesh_test@gmail.com', 'dasd', 0, '2023-11-16 05:19:56'),
(4, 'sdaf', '1233131231', 'DURGESHKUMARRAJ62@GMAIL.COM', 'asdDS', 0, '2023-11-16 05:23:02'),
(5, 'gsdfg', '1234564782', 'DURGESHKUMARRAJ62@GMAIL.COM', 'asf', 0, '2023-11-16 05:24:17'),
(6, 'sdf', '3452522525', 'Durgesh@gmail.com', 'asdf', 0, '2023-11-16 09:51:44'),
(7, 'asdf', '3452522525', 'Durgesh@gmail.com', 'sdf', 0, '2023-11-16 09:52:10'),
(8, 'jhon drak', '3452522525', 'Durgesh@gmail.com', 'dd', 0, '2023-11-16 09:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `destination_state`
--

CREATE TABLE `destination_state` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `state_text` text NOT NULL,
  `min_temp` int(11) NOT NULL,
  `max_temp` int(11) NOT NULL,
  `state_image` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination_state`
--

INSERT INTO `destination_state` (`id`, `state_id`, `state_text`, `min_temp`, `max_temp`, `state_image`, `banner_image`, `is_deleted`, `timestamp`) VALUES
(2, 33, 'Uttarakhand, nestled in the Himalayas, seamlessly blends spirituality and natural beauty. From sacred rivers to vibrant festivals, it\'s a captivating synthesis of tradition and awe-inspiring landscapes.', 3, 22, '6549e121798ab3.55589134.jpg', '6549e12182d911.53610251.jpg', 0, '2023-11-07 06:27:53'),
(3, 10, 'Goa, a coastal paradise, effortlessly combines vibrant beach life with a rich tapestry of cultural festivities. From sandy shores to lively festivals, it\'s a harmonious blend of relaxation and vibrant traditions.', 12, 35, '6549e0b79938a3.70440484.jpg', '6549e0b7997142.81559518.jpg', 0, '2023-11-07 07:01:11'),
(4, 15, 'Karnataka, a diverse canvas, harmonizes historical richness with natural beauty. From ancient heritage sites to lush landscapes, it\'s a captivating fusion of culture and scenic splendor.', 14, 40, '6549e10c9aa490.27444286.jpg', '6549e10c9adeb8.03022350.jpg', 0, '2023-11-07 07:02:36'),
(5, 6, 'Chandigarh', 45, 35, '654a1ff08109b9.86820481.jpeg', '654a1ff08199c2.00700269.jpeg', 0, '2023-11-07 11:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_person` int(11) NOT NULL,
  `package_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `tour_date` date NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `package_id`, `order_id`, `transaction_id`, `name`, `mobile`, `email`, `no_person`, `package_price`, `total_price`, `tour_date`, `booking_date`, `payment_type`, `payment_status`, `order_status`, `is_canceled`, `is_deleted`, `timestamp`) VALUES
(4, 1, 6, 'ORDER_654DBBB44AB38', NULL, 'asdf', '', 'asdf@dfg.ghjfd', 3, 0, 0, '2023-11-17', '2023-11-10 10:42:20', 'cod', 'success', 'order placed', 0, 0, '2023-11-10 05:12:20'),
(5, 1, 6, 'ORDER_654DBC2B0B5DC', NULL, 'jhon drak', '', 'Durgesh@gmail.com', 34, 0, 0, '2023-11-12', '2023-11-10 10:44:19', 'cod', 'pending', 'order placed', 0, 0, '2023-11-10 05:14:19'),
(6, 1, 6, 'ORDER_654DBC94D312E', NULL, 'jhon drak', '3452522525', 'Durgesh@gmail.com', 34, 0, 0, '2023-11-30', '2023-11-10 10:46:04', 'cod', 'pending', 'order placed', 0, 0, '2023-11-10 05:16:04'),
(7, 2, 4, 'ORDER_654DC3422C446', NULL, 'Durgesh Kumar', '3452522525', 'durgeshkumarraj62@gmail.com', 3, 450, 1350, '2023-11-16', '2023-11-10 11:14:34', 'cod', 'pending', 'order placed', 0, 0, '2023-11-10 05:44:34'),
(8, 2, 4, 'ORDER_654DC3AD12F6F', NULL, 'Durgesh Kumar', '1234567892', 'DURGESHKUMARRAJ62@GMAIL.COM', 2, 450, 900, '2023-11-11', '2023-11-10 11:16:21', 'cod', 'pending', 'order placed', 0, 0, '2023-11-10 05:46:21'),
(9, 2, 4, 'ORDER_654DC3E1E02B7', NULL, 'Durgesh Kumar', '1231241415', 'DURGESHKUMARRAJ62@GMAIL.COM', 3, 450, 1350, '2023-11-11', '2023-11-10 11:17:13', 'cod', 'success', 'pending', 0, 0, '2023-11-10 05:47:13'),
(10, 3, 4, 'ORDER_654DF579E84F5', NULL, 'domain vishal', '9315918493', 'admin@gmail.com', 5, 450, 2250, '2023-11-15', '2023-11-10 14:48:49', 'cod', 'success', 'order placed', 0, 0, '2023-11-10 09:18:49'),
(11, 3, 4, 'ORDER_654DF598A56CB', NULL, 'domain vishal', '9315918493', 'admin@gmail.com', 4, 450, 1800, '2023-11-13', '2023-11-03 14:49:20', 'cod', 'success', 'order placed', 0, 0, '2023-11-10 09:19:20'),
(12, 3, 4, 'ORDER_654DF5D1446D4', NULL, 'domain vishal', '9315918493', 'infobatman38@gmail.com', 4, 450, 1800, '2023-11-15', '2023-11-10 14:50:17', 'online', 'success', 'order placed', 0, 0, '2023-11-10 09:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `old_price` bigint(11) NOT NULL,
  `new_price` bigint(11) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `tour_duration` int(11) NOT NULL,
  `best_month` varchar(255) NOT NULL,
  `included` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'normal',
  `location_link` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `category_id`, `name`, `description`, `old_price`, `new_price`, `main_image`, `banner_image`, `country`, `state`, `city`, `tour_duration`, `best_month`, `included`, `type`, `location_link`, `is_deleted`, `timestamp`) VALUES
(4, 3, 'Fabulous Bangaluru', 'Bengaluru is considered to be one of the fastest-growing global major | Bengaluru is considered to be one of the fastest-growing global major', 500, 450, '6549bee7eb8e05.77741539.jpg', '6548ac73a18227.79782846.jpg', 'India', 'Karnataka', 'Bangluru', 2, 'Aug - Oct', 'Food, Travel, Air Fare, Tour Guide, Accommodation', 'normal', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d497698.7766528832!2d77.30058084756958!3d12.954458668638413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1699609874414!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2023-11-03 05:26:59'),
(5, 3, 'Rishikesh Tourism', 'Rishikesh is a small serene town famous for meditation and yoga. It is Gateway | Rishikesh is a small serene town famous for meditation and yoga. It is Gateway', 950, 950, '6549bf09109322.31665628.jpg', '6548ac9e9d9750.22602910.jpg', 'India', 'Uttarakhand', 'Rishikesh', 5, 'Apr - May', 'Food, Travel, Air Fare, Tour Guide, Accommodation', 'normal', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55235.59735363471!2d78.2293230514934!3d30.08774656552854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39093e67cf93f111%3A0xcc78804a6f941bfe!2sRishikesh%2C%20Uttarakhand!5e0!3m2!1sen!2sin!4v1699603084781!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2023-11-03 05:54:16'),
(6, 5, 'Goa Beach', 'Göreme is a town in the Cappadocia region of central Turkey. Just east of town', 1000, 1000, '6549bfaae4dca5.73037716.jpg', '6545dbad660bb0.95232302.jpg', 'India', 'Goa', 'Kochi', 3, 'Mar - Apr', 'Food, Travel, Air Fare, Tour Guide, Accommodation', 'normal', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d492024.4477222575!2d73.22999545000002!3d15.541293400000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfc1ff898a0d13%3A0x1735bbea7072cd75!2sGoa%20Beaches!5e0!3m2!1sen!2sin!4v1699609971555!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2023-11-03 10:59:09'),
(7, 5, 'sdfasdf', 'fgasfsd', 334, 33, '654dfa514b4ec3.45845151.png', '654dfa514badb7.64962287.png', 'India', 'Andhra Pradesh', 'Begusarai', 9, 'Apr - May', 'Food, Travel, Air Fare, Tour Guide, Accommodation', 'normal', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d492024.4477222575!2d73.22999545000002!3d15.541293400000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfc1ff898a0d13%3A0x1735bbea7072cd75!2sGoa%20Beaches!5e0!3m2!1sen!2sin!4v1699609971555!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 0, '2023-11-10 09:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`id`, `package_id`, `image_path`, `is_deleted`, `timestamp`) VALUES
(5, 1, '654242b90e50a8.98838534.jpg', 0, '2023-11-01 12:21:13'),
(6, 1, '654244516c7669.96472282.jpg', 0, '2023-11-01 12:28:01'),
(8, 2, '6542446f950e72.72226331.jpg', 0, '2023-11-01 12:28:31'),
(9, 2, '6542446f95d550.95922291.jpg', 0, '2023-11-01 12:28:31'),
(11, 3, '6542453272b667.22951076.jpg', 0, '2023-11-01 12:31:46'),
(12, 3, '65424532735116.39746458.jpg', 0, '2023-11-01 12:31:46'),
(13, 4, '654484a3ef7e56.15039784.jpg', 0, '2023-11-03 05:26:59'),
(14, 5, '65448b0810bbb5.73154066.jpg', 0, '2023-11-03 05:54:16'),
(15, 6, '6544d27d95e999.73946267.jpg', 0, '2023-11-03 10:59:09'),
(17, 6, '6544d27d96f9c2.19885036.jpg', 0, '2023-11-03 10:59:09'),
(18, 6, '6545dbb78de6b2.47444832.jpg', 0, '2023-11-04 05:50:47'),
(19, 6, '6545dbb78e7c54.36374957.jpg', 0, '2023-11-04 05:50:47'),
(21, 7, '654dfa514d6065.54789162.png', 0, '2023-11-10 09:39:29'),
(22, 7, '654dfa514de273.65659153.png', 0, '2023-11-10 09:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `is_deleted`, `timestamp`) VALUES
(1, 'Andaman and Nicobar Islands', 0, '2023-11-07 04:56:36'),
(2, 'Andhra Pradesh', 0, '2023-11-07 04:56:36'),
(3, 'Arunachal Pradesh', 0, '2023-11-07 04:56:36'),
(4, 'Assam', 0, '2023-11-07 04:56:36'),
(5, 'Bihar', 0, '2023-11-07 04:56:36'),
(6, 'Chandigarh', 0, '2023-11-07 04:56:36'),
(7, 'Chhattisgarh', 0, '2023-11-07 04:56:36'),
(8, 'Dadra and Nagar Haveli and Daman and Diu', 0, '2023-11-07 04:56:36'),
(9, 'Delhi', 0, '2023-11-07 04:56:36'),
(10, 'Goa', 0, '2023-11-07 04:56:36'),
(11, 'Gujarat', 0, '2023-11-07 04:56:36'),
(12, 'Haryana', 0, '2023-11-07 04:56:36'),
(13, 'Himachal Pradesh', 0, '2023-11-07 04:56:36'),
(14, 'Jharkhand', 0, '2023-11-07 04:56:36'),
(15, 'Karnataka', 0, '2023-11-07 04:56:36'),
(16, 'Kerala', 0, '2023-11-07 04:56:36'),
(17, 'Lakshadweep', 0, '2023-11-07 04:56:36'),
(18, 'Madhya Pradesh', 0, '2023-11-07 04:56:36'),
(19, 'Maharashtra', 0, '2023-11-07 04:56:36'),
(20, 'Manipur', 0, '2023-11-07 04:56:36'),
(21, 'Meghalaya', 0, '2023-11-07 04:56:36'),
(22, 'Mizoram', 0, '2023-11-07 04:56:36'),
(23, 'Nagaland', 0, '2023-11-07 04:56:36'),
(24, 'Odisha', 0, '2023-11-07 04:56:36'),
(25, 'Puducherry', 0, '2023-11-07 04:56:36'),
(26, 'Punjab', 0, '2023-11-07 04:56:36'),
(27, 'Rajasthan', 0, '2023-11-07 04:56:36'),
(28, 'Sikkim', 0, '2023-11-07 04:56:36'),
(29, 'Tamil Nadu', 0, '2023-11-07 04:56:36'),
(30, 'Telangana', 0, '2023-11-07 04:56:36'),
(31, 'Tripura', 0, '2023-11-07 04:56:36'),
(32, 'Uttar Pradesh', 0, '2023-11-07 04:56:36'),
(33, 'Uttarakhand', 0, '2023-11-07 04:56:36'),
(34, 'West Bengal', 0, '2023-11-07 04:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'customer',
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'user.png',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `user_type`, `password`, `user_image`, `time_stamp`) VALUES
(1, 'durgesh kumar', '7894561230', 'durgesh@gmail.com', 'customer', '12', 'user.png', '2023-10-11 10:04:49'),
(2, 'test', '1234567899', 'admin@gmail.com', 'admin', 'admin', 'user.png', '2023-11-01 06:49:40'),
(3, 'domain vishal', '9585485464', 'land@gmail.com', 'customer', '0123', 'user.png', '2023-11-10 09:18:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_state`
--
ALTER TABLE `destination_state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `destination_state`
--
ALTER TABLE `destination_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `destination_state`
--
ALTER TABLE `destination_state`
  ADD CONSTRAINT `destination_state_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
