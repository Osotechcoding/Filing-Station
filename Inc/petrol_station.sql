CREATE TABLE `petrol_station`.`admin_tbl` ( `adminId` INT NOT NULL AUTO_INCREMENT , `admin_name` VARCHAR(100) NULL DEFAULT NULL , `username` VARCHAR(50) NULL DEFAULT NULL , `email` VARCHAR(100) NULL DEFAULT NULL , `pwd` VARCHAR(255) NULL DEFAULT NULL , `access_token` VARCHAR(20) NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '0' , `login_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `logout_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`adminId`)) ENGINE = InnoDB;
--
CREATE TABLE `petrol_station`.`bank_saving_tbl` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `amount` DOUBLE NULL DEFAULT NULL , `bank` VARCHAR(100) NULL DEFAULT NULL , `note` TEXT NULL DEFAULT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
----

CREATE TABLE `petrol_station`.`fuel_tbl` ( `fId` INT NOT NULL AUTO_INCREMENT , `fuel_type` VARCHAR(255) NULL DEFAULT NULL , `litres` INT(11) NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1=available, 2=low,3=not available' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`fId`)) ENGINE = InnoDB;

---
CREATE TABLE `petrol_station`.`price_control_tbl` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `fuel_id` INT(11) NULL DEFAULT NULL , `litre_price` DOUBLE NULL DEFAULT NULL , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-----
CREATE TABLE `petrol_station`.`sales_remit` ( `sales_id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `staff_id` INT(11) NULL DEFAULT NULL , `pump_id` INT(5) NULL DEFAULT NULL , `litre_price` DOUBLE NULL DEFAULT NULL , `litre_sold` DOUBLE NULL DEFAULT NULL , `total` DOUBLE NULL DEFAULT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sales_id`)) ENGINE = InnoDB;

---
CREATE TABLE `petrol_station`.`total_sales_rem` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `amount` DOUBLE NULL DEFAULT NULL , `litres` DOUBLE NULL DEFAULT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

--
CREATE TABLE `petrol_station`.`pumps_tbl` ( `pumpId` INT NOT NULL AUTO_INCREMENT , `pump_desc` VARCHAR(50) NULL DEFAULT NULL , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`pumpId`)) ENGINE = InnoDB;

----
CREATE TABLE `petrol_station`.`allocate_meter_tbl` ( `aId` INT UNSIGNED NOT NULL AUTO_INCREMENT , `attendant_id` INT(11) NULL DEFAULT NULL , `pump` INT(5) NULL DEFAULT NULL , `before_sales` DOUBLE NULL DEFAULT NULL , `after_sales` DOUBLE NULL DEFAULT NULL , `price_per_litre` DOUBLE NULL DEFAULT NULL , `volume_sold` DOUBLE NULL DEFAULT NULL COMMENT 'volume sold is in litre' , `total_amount` DOUBLE NULL DEFAULT NULL , `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , `loss_amount` DOUBLE NULL DEFAULT NULL , PRIMARY KEY (`aId`)) ENGINE = InnoDB;

---
---
CREATE TABLE `petrol_station`.`staff_tbl` ( `staff_id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `full_name` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(100) NULL DEFAULT NULL , `phone` VARCHAR(50) NULL DEFAULT NULL , `address` TEXT NULL DEFAULT NULL , `designation` VARCHAR(100) NULL DEFAULT NULL , `status` TINYINT(1) NULL DEFAULT '1' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`staff_id`)) ENGINE = InnoDB;

---
---
CREATE TABLE `petrol_station`.`price_control_history` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `fId` INT(11) NOT NULL , `price` DOUBLE NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
----

CREATE TABLE `petrol_station`.`two_factor_auth` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `email` VARCHAR(100) NULL DEFAULT NULL , `secret_question` TEXT NULL DEFAULT NULL , `secret_answer` VARCHAR(255) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

---
ALTER TABLE `admin_tbl` ADD `token_expire` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
---
ALTER TABLE `pumps_tbl` ADD `pcode` VARCHAR(20) NULL DEFAULT NULL AFTER `pump_desc`;
---
ALTER TABLE `pumps_tbl` ADD `status` VARCHAR(20) NULL DEFAULT NULL AFTER `pcode`;
---

CREATE TABLE `petrol_station`.`orders` ( `order_id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `fuel` INT(11) NULL DEFAULT NULL , `litres` DOUBLE NULL DEFAULT NULL , `supplier` INT(11) NULL DEFAULT NULL , `cost_amount` DOUBLE NULL DEFAULT NULL , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`order_id`)) ENGINE = InnoDB;
---
---

CREATE TABLE `petrol_station`.`suppliers` ( `sId` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `phone` VARCHAR(50) NULL DEFAULT NULL , `mobile` VARCHAR(50) NULL DEFAULT NULL , `email` VARCHAR(100) NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '1' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`sId`)) ENGINE = InnoDB;
-----
---
CREATE TABLE `petrol_station`.`credit_customer` ( `cId` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `phone` VARCHAR(50) NULL DEFAULT NULL , `email` VARCHAR(100) NULL DEFAULT NULL , `address` TEXT NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '1' , `created_at` DATE NULL DEFAULT NULL , PRIMARY KEY (`cId`)) ENGINE = InnoDB;
----
----
CREATE TABLE `petrol_station`.`credit_sales` ( `credit_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `seller_id` INT(11) NULL DEFAULT NULL , `buyer_id` INT(11) NULL DEFAULT NULL , `pump_id` INT(5) NULL DEFAULT NULL , `fuel_id` INT(5) NULL DEFAULT NULL , `litre` DOUBLE NULL DEFAULT NULL , `amount` DOUBLE NULL DEFAULT NULL , `status` TINYINT(1) NOT NULL DEFAULT '0' , `sold_date` DATE NULL DEFAULT NULL , PRIMARY KEY (`credit_id`)) ENGINE = InnoDB;
---