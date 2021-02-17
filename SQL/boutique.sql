-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2021 at 10:59 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `attribute_value_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `attribute_color` tinytext,
  `attribute_size` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_statut` int(11) NOT NULL,
  `customer_organisation_or_person` varchar(255) COLLATE utf8_bin NOT NULL,
  `customer_firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `customer_lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `customer_country` varchar(2) COLLATE utf8_bin NOT NULL,
  `customer_city` varchar(100) COLLATE utf8_bin NOT NULL,
  `customer_postcode` varchar(100) COLLATE utf8_bin NOT NULL,
  `customer_state` varchar(100) COLLATE utf8_bin NOT NULL,
  `customer_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `customer_adress_line_1` varchar(255) COLLATE utf8_bin NOT NULL,
  `customer_adress_line_2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `customer_adress_line_3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `customer_adress_line_4` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_methods`
--

CREATE TABLE `customer_payment_methods` (
  `customer_payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method_code` int(11) NOT NULL,
  `credit_card_number` bigint(20) NOT NULL,
  `payment_method_details` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_number` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_status_code` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_status_code` int(11) NOT NULL,
  `date_order_placed` date NOT NULL,
  `order_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_item_status_code` int(11) NOT NULL,
  `order_item_quantity` int(11) NOT NULL,
  `order_item_price` float NOT NULL,
  `other_order_item_details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` float NOT NULL,
  `Invoices_invoice_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `product_description` mediumtext NOT NULL,
  `other_product_details` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_has_stock`
--

CREATE TABLE `products_has_stock` (
  `products_product_id` int(11) NOT NULL,
  `Stock_stock_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE `products_image` (
  `product_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `product_image_1` varchar(45) COLLATE utf8_bin NOT NULL,
  `product_image_2` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ref_invoice_status_codes`
--

CREATE TABLE `ref_invoice_status_codes` (
  `invoice_status_code` int(11) NOT NULL,
  `invoice_status_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_order_item_status_codes`
--

CREATE TABLE `ref_order_item_status_codes` (
  `order_item_status_code` int(11) NOT NULL,
  `order_item_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_order_status_codes`
--

CREATE TABLE `ref_order_status_codes` (
  `order_status_code` int(11) NOT NULL,
  `order_status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_payment_methods`
--

CREATE TABLE `ref_payment_methods` (
  `payment_method_code` int(11) NOT NULL,
  `payment_method_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_product_types`
--

CREATE TABLE `ref_product_types` (
  `product_type_id` int(11) NOT NULL,
  `parent_product_type_code` int(11) NOT NULL,
  `product_type_description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `shipment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `shipment_tracking_number` bigint(20) NOT NULL,
  `shipment_date` date NOT NULL,
  `other_shipment_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipment_items`
--

CREATE TABLE `shipment_items` (
  `order_item_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `attribute_value_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`attribute_value_id`),
  ADD KEY `fk_Product_Type_Attribute_Value_Ref_Product_Types1_idx` (`product_type_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  ADD PRIMARY KEY (`customer_payment_id`,`customer_id`),
  ADD KEY `fk_Customer_Payment_Methods_Ref_Payment_Methods1_idx` (`payment_method_code`),
  ADD KEY `fk_Customer_Payment_Methods_Customer1_idx` (`customer_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_number`),
  ADD KEY `fk_Invoices_orders1_idx` (`order_id`),
  ADD KEY `fk_Invoices_Ref_Invoice_Status_Codes1_idx` (`invoice_status_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`,`customer_id`),
  ADD KEY `fk_orders_Ref_Order_Status_Codes1_idx` (`order_status_code`),
  ADD KEY `fk_orders_Customer1_idx` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_Order_Items_orders1_idx` (`order_id`),
  ADD KEY `fk_Order_Items_products1_idx` (`product_id`),
  ADD KEY `fk_Order_Items_Ref_Order_Item_Status_Codes1_idx` (`order_item_status_code`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_Payments_Invoices1_idx` (`Invoices_invoice_number`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_Ref_Product_Types1_idx` (`product_type_id`);

--
-- Indexes for table `products_has_stock`
--
ALTER TABLE `products_has_stock`
  ADD PRIMARY KEY (`products_product_id`,`Stock_stock_id`),
  ADD KEY `fk_products_has_Stock_Stock1_idx` (`Stock_stock_id`),
  ADD KEY `fk_products_has_Stock_products1_idx` (`products_product_id`),
  ADD KEY `fk_products_has_Stock_Order_Items1_idx` (`order_item_id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
  ADD PRIMARY KEY (`product_id`,`attribute_value_id`),
  ADD KEY `fk_products_has_Attribute_Value_Attribute_Value1_idx` (`attribute_value_id`),
  ADD KEY `fk_products_has_Attribute_Value_products1_idx` (`product_id`);

--
-- Indexes for table `ref_invoice_status_codes`
--
ALTER TABLE `ref_invoice_status_codes`
  ADD PRIMARY KEY (`invoice_status_code`);

--
-- Indexes for table `ref_order_item_status_codes`
--
ALTER TABLE `ref_order_item_status_codes`
  ADD PRIMARY KEY (`order_item_status_code`);

--
-- Indexes for table `ref_order_status_codes`
--
ALTER TABLE `ref_order_status_codes`
  ADD PRIMARY KEY (`order_status_code`);

--
-- Indexes for table `ref_payment_methods`
--
ALTER TABLE `ref_payment_methods`
  ADD PRIMARY KEY (`payment_method_code`);

--
-- Indexes for table `ref_product_types`
--
ALTER TABLE `ref_product_types`
  ADD PRIMARY KEY (`product_type_id`),
  ADD KEY `fk_Ref_Product_Types_Ref_Product_Types1_idx` (`parent_product_type_code`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `fk_Shipments_orders1_idx` (`order_id`),
  ADD KEY `fk_Shipments_Invoices1_idx` (`invoice_number`);

--
-- Indexes for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD PRIMARY KEY (`order_item_id`,`shipment_id`),
  ADD KEY `fk_Shipment_Items_Shipments1_idx` (`shipment_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_Stock_Attribute_Value1_idx` (`attribute_value_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `attribute_value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  MODIFY `customer_payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_number` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_invoice_status_codes`
--
ALTER TABLE `ref_invoice_status_codes`
  MODIFY `invoice_status_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_order_item_status_codes`
--
ALTER TABLE `ref_order_item_status_codes`
  MODIFY `order_item_status_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_order_status_codes`
--
ALTER TABLE `ref_order_status_codes`
  MODIFY `order_status_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_payment_methods`
--
ALTER TABLE `ref_payment_methods`
  MODIFY `payment_method_code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ref_product_types`
--
ALTER TABLE `ref_product_types`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `fk_Product_Type_Attribute_Value_Ref_Product_Types1` FOREIGN KEY (`product_type_id`) REFERENCES `ref_product_types` (`product_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_payment_methods`
--
ALTER TABLE `customer_payment_methods`
  ADD CONSTRAINT `fk_Customer_Payment_Methods_Customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Customer_Payment_Methods_Ref_Payment_Methods1` FOREIGN KEY (`payment_method_code`) REFERENCES `ref_payment_methods` (`payment_method_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_Invoices_Ref_Invoice_Status_Codes1` FOREIGN KEY (`invoice_status_code`) REFERENCES `ref_invoice_status_codes` (`invoice_status_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Invoices_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_Customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_Ref_Order_Status_Codes1` FOREIGN KEY (`order_status_code`) REFERENCES `ref_order_status_codes` (`order_status_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_Order_Items_Ref_Order_Item_Status_Codes1` FOREIGN KEY (`order_item_status_code`) REFERENCES `ref_order_item_status_codes` (`order_item_status_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Order_Items_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Order_Items_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_Payments_Invoices1` FOREIGN KEY (`Invoices_invoice_number`) REFERENCES `invoices` (`invoice_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_Ref_Product_Types1` FOREIGN KEY (`product_type_id`) REFERENCES `ref_product_types` (`product_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products_has_stock`
--
ALTER TABLE `products_has_stock`
  ADD CONSTRAINT `fk_products_has_Stock_Order_Items1` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`order_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_Stock_Stock1` FOREIGN KEY (`Stock_stock_id`) REFERENCES `stock` (`stock_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_Stock_products1` FOREIGN KEY (`products_product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products_image`
--
ALTER TABLE `products_image`
  ADD CONSTRAINT `fk_products_has_Attribute_Value_Attribute_Value1` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_value` (`attribute_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_has_Attribute_Value_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ref_product_types`
--
ALTER TABLE `ref_product_types`
  ADD CONSTRAINT `fk_Ref_Product_Types_Ref_Product_Types1` FOREIGN KEY (`parent_product_type_code`) REFERENCES `ref_product_types` (`product_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `fk_Shipments_Invoices1` FOREIGN KEY (`invoice_number`) REFERENCES `invoices` (`invoice_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Shipments_orders1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shipment_items`
--
ALTER TABLE `shipment_items`
  ADD CONSTRAINT `fk_Shipment_Items_Order_Items1` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`order_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Shipment_Items_Shipments1` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`shipment_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_Stock_Attribute_Value1` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_value` (`attribute_value_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
