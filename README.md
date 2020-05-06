# Php-dbms-project
A simple website that shows farmers details and a portal for them to buy and sell produce.<br>
put all files in htdocs folder of xampp<br>
in phpmyadmin, create the following tables:<br>
CREATE TABLE `advisor` (
 `aid` varchar(5) NOT NULL,
 `name` varchar(50) DEFAULT NULL,
 `address` varchar(150) DEFAULT NULL,
 `salary` decimal(10,5) DEFAULT NULL,
 `number` varchar(10) DEFAULT NULL,
 PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `equipment` (
 `eid` varchar(5) NOT NULL,
 `name` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `crop` (
 `cid` varchar(5) NOT NULL,
 `cname` varchar(50) DEFAULT NULL,
 `ctype` varchar(50) DEFAULT NULL,
 `water_req` decimal(10,5) DEFAULT NULL,
 `fid` varchar(5) DEFAULT NULL,
 `sid` varchar(5) DEFAULT NULL,
 PRIMARY KEY (`cid`),
 KEY `sid` (`sid`),
 KEY `fid` (`fid`),
 CONSTRAINT `crop_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `seed` (`sid`),
 CONSTRAINT `crop_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `fertilizer` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `farmer` (
 `fid` varchar(5) NOT NULL,
 `dob` date DEFAULT NULL,
 `name` varchar(50) DEFAULT NULL,
 `gender` char(1) DEFAULT NULL,
 `lid` varchar(5) DEFAULT NULL,
 `aid` varchar(5) DEFAULT NULL,
 `phone` varchar(15) NOT NULL,
 `email` varchar(100) NOT NULL,
 PRIMARY KEY (`fid`),
 KEY `lid` (`lid`),
 KEY `aid` (`aid`),
 CONSTRAINT `farmer_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`),
 CONSTRAINT `farmer_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `advisor` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
 `gender` char(1) COLLATE utf8_unicode_ci NOT NULL,
 `dob` date NOT NULL,
 `area` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `fertilizer` (
 `fid` varchar(5) NOT NULL,
 `name` varchar(50) DEFAULT NULL,
 `type` varchar(20) DEFAULT NULL,
 `npk` varchar(20) DEFAULT NULL,
 PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `sell_seed` (
 `sid` varchar(5) NOT NULL,
 `seedid` varchar(5) NOT NULL,
 `cost` decimal(20,5) DEFAULT NULL,
 PRIMARY KEY (`sid`,`seedid`),
 KEY `seedid` (`seedid`),
 CONSTRAINT `sell_seed_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `supplier` (`sid`),
 CONSTRAINT `sell_seed_ibfk_2` FOREIGN KEY (`seedid`) REFERENCES `seed` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `seed` (
 `sid` varchar(5) NOT NULL,
 `name` varchar(50) DEFAULT NULL,
 `shelf_life` int(11) DEFAULT NULL,
 `str_condn` varchar(50) DEFAULT NULL,
 `soil` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `supplier` (
 `sid` varchar(5) NOT NULL,
 `name` varchar(50) DEFAULT NULL,
 `address` varchar(150) DEFAULT NULL,
 `number` varchar(10) DEFAULT NULL,
 PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `sell_fertilizer` (
 `sid` varchar(5) NOT NULL,
 `fid` varchar(5) NOT NULL,
 `cost` decimal(20,5) DEFAULT NULL,
 PRIMARY KEY (`sid`,`fid`),
 KEY `fid` (`fid`),
 CONSTRAINT `sell_fertilizer_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `supplier` (`sid`),
 CONSTRAINT `sell_fertilizer_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `fertilizer` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `sell_equipment` (
 `sid` varchar(5) NOT NULL,
 `eid` varchar(5) NOT NULL,
 `cost` decimal(20,5) DEFAULT NULL,
 PRIMARY KEY (`sid`,`eid`),
 KEY `eid` (`eid`),
 CONSTRAINT `sell_equipment_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `supplier` (`sid`),
 CONSTRAINT `sell_equipment_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `equipment` (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
CREATE TABLE `location` (
 `lid` varchar(5) NOT NULL,
 `lname` varchar(50) DEFAULT NULL,
 `weather` varchar(50) DEFAULT NULL,
 `soil_type` varchar(50) DEFAULT NULL,
 `pests` varchar(200) DEFAULT NULL,
 `pesticides` varchar(100) DEFAULT NULL,
 PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
