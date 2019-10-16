-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2016 at 09:27 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_restaurants`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurants_authentication`
--

CREATE TABLE `tbl_restaurants_authentication` (
  `authentication_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `deny_access` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_restaurants_authentication`
--

INSERT INTO `tbl_restaurants_authentication` (`authentication_id`, `username`, `password`, `name`, `role_id`, `is_deleted`, `deny_access`) VALUES
(1, 'admin', '3dba44de6dbf6ad13444799ed798f5b8', 'Admin', 1, 0, 0),
(2, 'guest', '25d55ad283aa400af464c76d713c07ad', 'Guest', 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurants_categories`
--

CREATE TABLE `tbl_restaurants_categories` (
  `category_id` int(11) NOT NULL,
  `category` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_restaurants_categories`
--

INSERT INTO `tbl_restaurants_categories` (`category_id`, `category`, `created_at`, `is_deleted`) VALUES
(1, 'Fast Food', 0, 0),
(2, 'Fast Casual', 0, 0),
(3, 'Casual Dining', 0, 0),
(4, 'Family Style', 0, 0),
(5, 'Fine Dining', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurants_photos`
--

CREATE TABLE `tbl_restaurants_photos` (
  `photo_id` int(11) NOT NULL,
  `photo_url` text NOT NULL,
  `thumb_url` text NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_restaurants_photos`
--

INSERT INTO `tbl_restaurants_photos` (`photo_id`, `photo_url`, `thumb_url`, `restaurant_id`, `created_at`, `is_deleted`) VALUES
(1, 'https://grandshanghai.com.sg/wp-content/uploads/2016/03/IMG-1765a-1024x682.jpg', 'https://media.timeout.com/images/101843813/630/472/image.jpg', 5, 0, 0),
(2, 'http://s3.amazonaws.com/foodspotting-ec2/reviews/3339817/thumb_600.jpg', 'http://s3.amazonaws.com/foodspotting-ec2/reviews/3339817/thumb_600.jpg', 1, 0, 0),
(3, 'https://d2jzxcrnybzkkt.cloudfront.net/uploads/2015/11/Interior_jpg_1448509111.jpg', 'http://www.jimthompsonrestaurant.com/elctfl/branch/thum-2.jpg', 2, 0, 0),
(4, 'https://www1.mastercard.com/content/dam/mastercardoffers/APMEA/platinum-ap/offer-assets/wine-apr-17/PUTIEN_Nex_Singapore/PUTIEN_Nex_Singapore_1392X708.jpg', 'https://www1.mastercard.com/content/dam/mastercardoffers/APMEA/platinum-ap/offer-assets/wine-jan-17/Putien_Vanke_Mall_China/Putien_Vanke_Mall_China_640X400.jpg', 3, 0, 0),
(5, 'http://4.bp.blogspot.com/_IdSQboBHMX4/SxR871k-u_I/AAAAAAAAFAc/svDksEPOyhc/s1600/P1080116.JPG', 'http://www.gayatrirestaurant.com/static/uploads/reserve5.jpg', 4, 0, 0),
(6, 'http://danielfooddiary.com/wp-content/uploads/2016/05/sweechoon15.jpg', 'https://emylogues.files.wordpress.com/2013/08/img_0211.jpg', 1, 0, 0),
(7, 'http://2.bp.blogspot.com/-7fcUEpWJano/ViuehUOe7PI/AAAAAAAASys/KDVzp8HrQm0/s1600/IMG_1755.jpg', 'http://lh6.ggpht.com/_-cDTaEnwUc0/SuziwaIU93I/AAAAAAAADcE/E5_O5OruQZs/s400/DSC00937.JPG', 5, 0, 0),
(8, 'http://d2jzxcrnybzkkt.cloudfront.net/uploads/2013/11/dbslider2_jpg_1383719620.jpg', 'http://d2jzxcrnybzkkt.cloudfront.net/uploads/2013/11/dbslider2_jpg_1383719620.jpg', 1, 0, 0),
(9, 'http://www.chainedesrotisseurs.com/news_online/uploads/images/s_01361/raw/a01%20001.jpg', 'http://www.chainedesrotisseurs.com/news_online/uploads/images/s_01361/raw/a01%20001.jpg', 1, 0, 0),
(10, 'http://www.putien.com/wp-content/uploads/2014/04/outlet_sunway.jpg', 'http://www.putien.com/wp-content/uploads/2014/04/outlet_sunway.jpg', 3, 0, 0),
(11, 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 4, 0, 1),
(12, 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 4, 0, 1),
(13, 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 'https://tctechcrunch2011.files.wordpress.com/2013/05/philz-cupz.jpg', 4, 0, 1),
(14, 'http://www.keepthetime.com/blog/wp-content/uploads/2011/11/tissot_t66171231_heritage_150th_anniversary_watch-590x409.jpg', 'http://www.keepthetime.com/blog/wp-content/uploads/2011/11/tissot_t66171231_heritage_150th_anniversary_watch-590x409.jpg', 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurants_restaurants`
--

CREATE TABLE `tbl_restaurants_restaurants` (
  `restaurant_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `lat` text NOT NULL,
  `lon` text NOT NULL,
  `desc1` text NOT NULL,
  `email` text NOT NULL,
  `website` text NOT NULL,
  `amenities` text NOT NULL,
  `food_rating` float NOT NULL,
  `price_rating` float NOT NULL,
  `featured` int(11) NOT NULL,
  `phone` text NOT NULL,
  `hours` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_restaurants_restaurants`
--

INSERT INTO `tbl_restaurants_restaurants` (`restaurant_id`, `name`, `address`, `lat`, `lon`, `desc1`, `email`, `website`, `amenities`, `food_rating`, `price_rating`, `featured`, `phone`, `hours`, `created_at`, `category_id`, `is_deleted`) VALUES
(1, 'Swee Choon Tim Sum Restaurant Pte Ltd', '191 Jalan Besar, Singapore 208882', '1.308290', '103.856954', 'Restaurant for all ocassions.', 'support@sweechoon.com', 'www.sweechoon.com', 'Parking, Wifi, Credit Card, Lunch, Dinner, Breakfast, Take-out, Dine-in', 3.5, 4.5, 1, '+65 6225 7788', '6:00 PM - 6:00 AM', 1400781610, 3, 0),
(2, 'Jim Thompson', '45 Minden Road, Dempsey Hill, Singapore 248817', '1.305573', '103.815691', 'Good for children.', 'support@jimthompson.com', 'www.jimthompson.com', 'Parking, Wifi, Credit Card, Lunch, Dinner, Breakfast, Take-out, Dine-in', 4, 3, 1, '+65 6475 6088', '6:00 PM - 6:00 AM', 1400781610, 3, 0),
(3, 'PuTien', '127 Kitchener Rd, Singapore 208514', '1.309865', '103.857383', 'For Childrens too.', 'support@putien.com', 'www.putien.com', 'Parking, Wifi, Credit Card, Lunch, Dinner, Breakfast', 4, 3.5, 1, '+65 6295 6358', '11:30 AM - 3:00 PM, 5:30 AM - 11:00 PM', 1400781733, 4, 0),
(4, 'Gayatri Restaurant', '122 Race Course Rd, Singapore 218583', '1.309974', '103.851971', 'We open 24 hrs to serve you.', 'support@gayatrirestaurant.com', 'www.gayatrirestaurant.com?ql=as', 'Parking, Wifi, Credit Card, Lunch, Dinner, Breakfast', 4, 5, 0, '+65 6292 4544', 'Open 24 Hrs', 1400781733, 4, 0),
(5, 'Grand ShangHai Restaurant', '390 Havelock Rd Singapore 169662', '1.299021', '103.834580', 'You will be loving our place, so come and dine with us.', 'support@grandshanghai.com', 'www.grandshanghai.com', 'Parking, Wifi, Credit Card, Can Smoke', 4, 4.5, 1, '+65 6836 6866', '11:30 AM - 3:00 PM, 5:30 AM - 11:00 PM', 1400782952, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_restaurants_authentication`
--
ALTER TABLE `tbl_restaurants_authentication`
  ADD PRIMARY KEY (`authentication_id`);

--
-- Indexes for table `tbl_restaurants_categories`
--
ALTER TABLE `tbl_restaurants_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_restaurants_photos`
--
ALTER TABLE `tbl_restaurants_photos`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `tbl_restaurants_restaurants`
--
ALTER TABLE `tbl_restaurants_restaurants`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_restaurants_authentication`
--
ALTER TABLE `tbl_restaurants_authentication`
  MODIFY `authentication_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_restaurants_categories`
--
ALTER TABLE `tbl_restaurants_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_restaurants_photos`
--
ALTER TABLE `tbl_restaurants_photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_restaurants_restaurants`
--
ALTER TABLE `tbl_restaurants_restaurants`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;