-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 06:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrol_station`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `adminId` int(11) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `access_token` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `token_expire` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`adminId`, `admin_name`, `username`, `email`, `pwd`, `access_token`, `status`, `login_time`, `logout_time`, `created_at`, `token_expire`) VALUES
(1, 'Admin', 'admin', 'admin@psms.com', '$2y$10$W2K4ZGLgKnGSaKiwteiA1uwIHTObe/kLWRjmEhD//GURQoT69PVxC', 'SaKiwteiA1uwIHTObe', 0, '2022-03-05 16:55:44', '2022-03-05 16:55:44', '2022-03-05 17:55:44', '2022-03-05 17:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `allocate_meter_tbl`
--

CREATE TABLE `allocate_meter_tbl` (
  `aId` int(10) UNSIGNED NOT NULL,
  `attendant_id` int(11) DEFAULT NULL,
  `pump` int(5) DEFAULT NULL,
  `fuel_id` int(5) DEFAULT NULL,
  `before_sales` double DEFAULT NULL,
  `after_sales` double DEFAULT NULL,
  `price_per_litre` double DEFAULT NULL,
  `volume_sold` double DEFAULT NULL COMMENT 'volume sold is in litre',
  `total_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `loss_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocate_meter_tbl`
--

INSERT INTO `allocate_meter_tbl` (`aId`, `attendant_id`, `pump`, `fuel_id`, `before_sales`, `after_sales`, `price_per_litre`, `volume_sold`, `total_amount`, `date`, `loss_amount`) VALUES
(1, 1, 1, 1, 1321, 1331, 170, 10, 1700, '2022-03-10', NULL),
(2, 1, 1, 1, 1234, 1259, 170, 25, 4250, '2022-03-12', NULL),
(3, 1, 1, 1, 3432, 3452, 200, 20, 4000, '2022-03-14', NULL),
(4, 1, 1, 1, 4531, 4552, 200, 21, 4200, '2022-03-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_saving_tbl`
--

CREATE TABLE `bank_saving_tbl` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(1) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_saving_tbl`
--

INSERT INTO `bank_saving_tbl` (`id`, `admin_id`, `amount`, `bank`, `note`, `created_at`) VALUES
(1, 1, 55000, 'First Bank Plc', 'I took the some of fifty five thousand naira only to First Bank Plc', '2022-03-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `credit_customer`
--

CREATE TABLE `credit_customer` (
  `cId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_customer`
--

INSERT INTO `credit_customer` (`cId`, `name`, `phone`, `email`, `address`, `user_type`, `status`, `created_at`) VALUES
(1, 'Adeyinka Adeola', '09087654321', 'ade@gmail.com', 'somewhere sango Ota Ogun State', 'Government', 1, '2022-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `credit_sales`
--

CREATE TABLE `credit_sales` (
  `credit_id` int(11) UNSIGNED NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `pump_id` int(5) DEFAULT NULL,
  `fuel_id` int(5) DEFAULT NULL,
  `litre` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `price` double DEFAULT NULL,
  `pstatus` tinyint(1) NOT NULL DEFAULT 0,
  `sold_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credit_sales`
--

INSERT INTO `credit_sales` (`credit_id`, `seller_id`, `buyer_id`, `pump_id`, `fuel_id`, `litre`, `amount`, `price`, `pstatus`, `sold_date`) VALUES
(1, 1, 1, 1, 1, 15, 3000, 200, 0, '2022-03-14'),
(2, 1, 1, 1, 1, 10, 2000, 200, 0, '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_tbl`
--

CREATE TABLE `fuel_tbl` (
  `fId` int(11) NOT NULL,
  `fuel_type` varchar(255) DEFAULT NULL,
  `litres` int(11) DEFAULT NULL,
  `stat` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=available, 2=low,3=not available',
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel_tbl`
--

INSERT INTO `fuel_tbl` (`fId`, `fuel_type`, `litres`, `stat`, `created_at`) VALUES
(1, 'Petrol', 930, 1, '2022-03-01'),
(2, 'Diesel', 33263, 1, '2022-03-02'),
(3, 'Gas', 120, 1, '2022-05-01'),
(4, 'Kerosene', 245, 1, '2022-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `fuel` int(11) DEFAULT NULL,
  `litres` double DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `cost_amount` double DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `fuel`, `litres`, `supplier`, `cost_amount`, `created_at`) VALUES
(1, 2, 33000, 2, 4000000, '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `passcode_tbl`
--

CREATE TABLE `passcode_tbl` (
  `code_id` int(1) NOT NULL,
  `pass_key` varchar(20) NOT NULL,
  `admin_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passcode_tbl`
--

INSERT INTO `passcode_tbl` (`code_id`, `pass_key`, `admin_email`) VALUES
(1, 'psms12345!@', 'admin@psms.com');

-- --------------------------------------------------------

--
-- Table structure for table `price_control_history`
--

CREATE TABLE `price_control_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `fId` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_control_history`
--

INSERT INTO `price_control_history` (`id`, `fId`, `price`, `created_at`) VALUES
(1, 1, 170, '2022-03-12 19:31:35'),
(2, 2, 280, '2022-03-12 19:31:35'),
(3, 3, 800, '2022-03-12 19:31:35'),
(4, 4, 320, '2022-03-12 19:31:35'),
(5, 1, 200, '2022-03-15 12:22:13'),
(6, 2, 280, '2022-03-15 12:22:14'),
(7, 3, 800, '2022-03-15 12:22:14'),
(8, 4, 320, '2022-03-15 12:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `price_control_tbl`
--

CREATE TABLE `price_control_tbl` (
  `id` int(10) UNSIGNED NOT NULL,
  `fuel_id` int(11) DEFAULT NULL,
  `litre_price` double DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_control_tbl`
--

INSERT INTO `price_control_tbl` (`id`, `fuel_id`, `litre_price`, `created_at`) VALUES
(1, 1, 165, '2022-03-01'),
(2, 2, 200, '2022-03-02'),
(3, 3, 650, '2022-03-02'),
(4, 4, 300, '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `pumps_tbl`
--

CREATE TABLE `pumps_tbl` (
  `pumpId` int(11) NOT NULL,
  `fuel` int(5) DEFAULT NULL,
  `pump_desc` varchar(50) DEFAULT NULL,
  `pcode` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pumps_tbl`
--

INSERT INTO `pumps_tbl` (`pumpId`, `fuel`, `pump_desc`, `pcode`, `status`, `created_at`) VALUES
(1, 1, 'COMBO X', 'XGT-0031', 'active', '2022-03-10'),
(2, 2, 'Basukka Z', 'BXK-002', 'active', '2022-03-15'),
(3, 3, 'Xpress B', 'BRT-027', 'active', '2022-03-15'),
(4, 4, 'Master P', 'MTX-901', 'active', '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `sales_remit`
--

CREATE TABLE `sales_remit` (
  `sales_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `pump_id` int(5) DEFAULT NULL,
  `litre_price` double DEFAULT NULL,
  `litre_sold` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fuel_id` int(5) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_remit`
--

INSERT INTO `sales_remit` (`sales_id`, `staff_id`, `pump_id`, `litre_price`, `litre_sold`, `total`, `fuel_id`, `created`) VALUES
(1, 1, 1, 170, 10, 1700, 1, '2022-03-10'),
(2, 1, 1, 170, 25, 4250, 1, '2022-03-12'),
(3, 1, 1, 200, 20, 1000, 1, '2022-03-14'),
(4, 1, 1, 200, 21, 2200, 1, '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `staff_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `qualification` varchar(200) DEFAULT NULL,
  `regNo` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`staff_id`, `full_name`, `email`, `phone`, `address`, `designation`, `qualification`, `regNo`, `status`, `created_at`) VALUES
(1, 'Ademola Adesoji', 'staff@psms.com', '07033315307', 'Sango Ota Ogun State', 'Attendant', 'OND Holder', 'PSMS96422', 1, '2022-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sId` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `total_sales_rem`
--

CREATE TABLE `total_sales_rem` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `litres` double DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `two_factor_auth`
--

CREATE TABLE `two_factor_auth` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `secret_question` text DEFAULT NULL,
  `secret_answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `two_factor_auth`
--

INSERT INTO `two_factor_auth` (`id`, `email`, `secret_question`, `secret_answer`) VALUES
(1, 'admin@psms.com', 'Where did you meet your spouse?', 'Ikere');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `allocate_meter_tbl`
--
ALTER TABLE `allocate_meter_tbl`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `bank_saving_tbl`
--
ALTER TABLE `bank_saving_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_customer`
--
ALTER TABLE `credit_customer`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `credit_sales`
--
ALTER TABLE `credit_sales`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `fuel_tbl`
--
ALTER TABLE `fuel_tbl`
  ADD PRIMARY KEY (`fId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `passcode_tbl`
--
ALTER TABLE `passcode_tbl`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `price_control_history`
--
ALTER TABLE `price_control_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_control_tbl`
--
ALTER TABLE `price_control_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pumps_tbl`
--
ALTER TABLE `pumps_tbl`
  ADD PRIMARY KEY (`pumpId`);

--
-- Indexes for table `sales_remit`
--
ALTER TABLE `sales_remit`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sId`);

--
-- Indexes for table `total_sales_rem`
--
ALTER TABLE `total_sales_rem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `two_factor_auth`
--
ALTER TABLE `two_factor_auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allocate_meter_tbl`
--
ALTER TABLE `allocate_meter_tbl`
  MODIFY `aId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_saving_tbl`
--
ALTER TABLE `bank_saving_tbl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credit_customer`
--
ALTER TABLE `credit_customer`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `credit_sales`
--
ALTER TABLE `credit_sales`
  MODIFY `credit_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fuel_tbl`
--
ALTER TABLE `fuel_tbl`
  MODIFY `fId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passcode_tbl`
--
ALTER TABLE `passcode_tbl`
  MODIFY `code_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `price_control_history`
--
ALTER TABLE `price_control_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price_control_tbl`
--
ALTER TABLE `price_control_tbl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pumps_tbl`
--
ALTER TABLE `pumps_tbl`
  MODIFY `pumpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_remit`
--
ALTER TABLE `sales_remit`
  MODIFY `sales_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `staff_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `total_sales_rem`
--
ALTER TABLE `total_sales_rem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `two_factor_auth`
--
ALTER TABLE `two_factor_auth`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
