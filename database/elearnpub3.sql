-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2015 at 06:52 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearnpub`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `date_purchased` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `coupon_code`, `date_purchased`) VALUES
(1, 1, '', '0000-00-00 00:00:00'),
(2, 2, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `teaser` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `thankyoumessage` text NOT NULL,
  `bookurl` varchar(200) NOT NULL,
  `language_id` int(11) NOT NULL,
  `google_analytic` varchar(200) NOT NULL,
  `page` int(11) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `progress` int(11) NOT NULL,
  `stealth_mode` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publisted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `teaser`, `description`, `thankyoumessage`, `bookurl`, `language_id`, `google_analytic`, `page`, `avatar`, `progress`, `stealth_mode`, `created_at`, `updated_at`, `publisted_at`) VALUES
(1, 'R Programming for Data Science', 'R Programming for Data Science by program', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Thank you message !', 'R-program', 1, '', 0, 'asd1.png', 100, 0, '2015-08-04 08:04:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Exploring ES6', 'Exploring ES6', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'An in-depth book on ECMAScript 6, the new version of JavaScript. The target audience are programmers who already know JavaScript.', 'Thank you for buy item', 'explore-es6', 1, '', 0, 'asd2.png', 100, 0, '2015-08-04 08:04:17', '0000-00-00 00:00:00', '2015-08-03 17:00:00'),
(3, 'MEAN Machine', 'MEAN Machine', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Become an impressive Node.js, AngularJS, ExpressJS, and MongoDB developer', 'Thank for you buy item', 'mean', 2, '', 200, 'asd3.png', 100, 0, '2015-08-04 08:04:16', '0000-00-00 00:00:00', '2015-08-03 17:00:00'),
(4, 'SurviveJS - Webpack and React', 'SurviveJS - Webpack and React', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Webpack, a module bundler, and React, a JavaScript library for building UIs are tools a modern web developer should know. In this book you will build a little Kanban application to get familiar with them. After completing the process you have a good starting point for developing your own.', 'Thank for buy message', 'survicejs', 2, '', 200, 'asd4.jpg', 100, 0, '2015-08-04 08:04:15', '0000-00-00 00:00:00', '2015-08-08 17:00:00'),
(5, 'Understanding ECMAScript 6', 'Understanding ECMAScript 6', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'ECMAScript 6 represents the biggest change to the core of JavaScript in the history of the language. Not only does the sixth edition add new object types, but also new syntax and exciting new capabilities. The result of years of study and debate, ECMAScript 6 reached feature complete status in 2014. While it will take a bit of time before all JavaScript environments support ECMAScript 6, it''s still useful to understand what''s coming and which features are available already.\r\n\r\nThis book is a guide for the transition between ECMAScript 5 and 6. It is not specific to any JavaScript environment, so it is equally useful to web developers as it is Node.js developers.\r\n\r\nWhat you''ll learn:\r\n\r\nAll of the changes to the language since ECMAScript 5\r\nHow the new class syntax relates to more familiar JavaScript concepts\r\nWhy iterators and generators are useful\r\nHow arrow functions are differ from regular functions\r\nAdditional options for storing data using sets, maps, and more\r\nThe power of inheriting from native types\r\nWhy people are so excited about promises for asynchronous programming\r\nHow modules will change the way you organize code\r\nThis book is being developed in the open on GitHub. You can visit the project repo to see the latest updates.', 'Thank you for buying book', 'understandinges6', 1, '', 172, 'asd5.png', 100, 0, '2015-08-04 08:04:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Principles of Object-Oriented Programming in JavaScript', 'Principles of Object-Oriented Programming in JavaScript', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'If you’re coming from a more traditional object-oriented language such as C++ or Java, JavaScript might seem like it’s not object-oriented at all. After all, JavaScript has no concept of classes, and you don’t even need to define any objects in order to write code. JavaScript can look just as much like C as it can an object-oriented language depending on how you decide to write it. But don’t be fooled, JavaScript is an incredibly powerful and expressive object-oriented language that puts many design decisions in the hands of you, the developer.\r\n\r\nThis book is an exploration of the object-oriented nature of JavaScript. It is not specific to a particular JavaScript environment, so it’s equally useful for web developers and Node.js developers. The book includes information about ECMAScript 5 and its new capabilities that have changed how you can work with objects in JavaScript.\r\n\r\nWhat you''ll learn:\r\n\r\nThe differences between primitive and reference values\r\nWhat makes JavaScript functions so unique\r\nThe various ways of creating an object\r\nThe difference between data properties and accessor properties using ECMAScript 5\r\nHow to define your own constructors\r\nHow to work with and understand prototypes\r\nVarious inheritance patterns for types and objects\r\nHow to create private and privileged object members\r\nHow to prevent modification of objects using ECMAScript 5 functionality\r\nWant a print version of the book? Purchase Principles of Object-Oriented JavaScript from No Starch Press.', 'Thank you for buying book', 'oopinjavascript', 1, '', 230, 'asd6.png', 100, 0, '2015-08-03 03:20:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `is_main` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `book_id`, `author_id`, `is_main`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 2, 1, 1),
(4, 3, 2, 0),
(5, 3, 3, 1),
(6, 4, 1, 1),
(7, 5, 1, 1),
(8, 6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_bundle`
--

CREATE TABLE IF NOT EXISTS `book_bundle` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `royalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_resource`
--

CREATE TABLE IF NOT EXISTS `book_resource` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE IF NOT EXISTS `bundles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `bundleurl` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `minimum` int(11) NOT NULL,
  `suggested` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `book_id`, `count`, `bill_id`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1),
(3, 3, 1, 2),
(4, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_sample` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_note` varchar(200) NOT NULL,
  `number` int(11) NOT NULL,
  `unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE IF NOT EXISTS `extra` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filebooks`
--

CREATE TABLE IF NOT EXISTS `filebooks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `book_id` int(11) NOT NULL,
  `is_sample` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filebooks`
--

INSERT INTO `filebooks` (`id`, `name`, `link`, `content`, `book_id`, `is_sample`, `updated_at`, `created_at`) VALUES
(43, 'sample1.txt', '1/sample1.txt', '', 1, 0, '2015-08-07 07:30:47', '0000-00-00 00:00:00'),
(44, 'sample2.txt', '1/sample2.txt', '', 1, 1, '2015-08-07 08:07:58', '0000-00-00 00:00:00'),
(45, 'sample3.txt', '1/sample3.txt', '', 1, 0, '2015-08-07 07:30:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE IF NOT EXISTS `invitation` (
  `id` int(11) NOT NULL,
  `identity` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `user_send` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `landingpage`
--

CREATE TABLE IF NOT EXISTS `landingpage` (
  `id` int(11) NOT NULL,
  `youtube_url` varchar(100) NOT NULL,
  `vimeo_url` varchar(100) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `about` text NOT NULL,
  `isshowreadcount` int(11) NOT NULL,
  `feedback_display` int(11) NOT NULL,
  `statusbook_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL,
  `language_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2015-05-27 07:36:24', '2015-06-11 20:39:47'),
(2, 'Japanese', 'jp', 0, '2015-05-27 07:36:36', '2015-06-11 10:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minimum` int(11) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `quatity` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL,
  `item_id` varchar(50) NOT NULL,
  `minimumprice` int(11) NOT NULL,
  `suggestedprice` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `item_id`, `minimumprice`, `suggestedprice`) VALUES
(1, 'bo|1', 2300, 2500),
(2, 'bo|2', 1800, 2000),
(3, 'bo|3', 1200, 1500),
(4, 'bo|4', 1000, 1600),
(5, 'bo|5', 1400, 1600),
(6, 'bo|6', 500, 800);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(300) NOT NULL,
  `book_id` int(11) NOT NULL,
  `function` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statusbook`
--

CREATE TABLE IF NOT EXISTS `statusbook` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `blurb` text NOT NULL,
  `twitter_id` varchar(60) NOT NULL,
  `github` varchar(60) NOT NULL,
  `googleplus` varchar(60) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `role_id`, `avatar`, `blurb`, `twitter_id`, `github`, `googleplus`, `remember_token`, `created_at`, `update_at`) VALUES
(1, 'phann123', 'ngoc', 'phan', 'phann123@yahoo.com', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', 'twdsd', 'phaan2', '', '', '2015-07-30 10:56:00', '0000-00-00 00:00:00'),
(2, 'tony', 'phan', 'nhan', 'lequidon.1993@gmail.com', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', '', '', '', '', '2015-07-30 10:56:00', '0000-00-00 00:00:00'),
(3, 'leduong', 'duong', 'le thanh', 'suc@gmail.com', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', '', '', '', '', '2015-07-30 10:57:26', '0000-00-00 00:00:00'),
(4, 'tuansds', 'Tuan', 'Vuong Van', 'vuongvan@gmail.com', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', '', '', '', '', '2015-07-30 10:57:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_bundle`
--
ALTER TABLE `book_bundle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_resource`
--
ALTER TABLE `book_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filebooks`
--
ALTER TABLE `filebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landingpage`
--
ALTER TABLE `landingpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statusbook`
--
ALTER TABLE `statusbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `book_bundle`
--
ALTER TABLE `book_bundle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_resource`
--
ALTER TABLE `book_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extra`
--
ALTER TABLE `extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `filebooks`
--
ALTER TABLE `filebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `landingpage`
--
ALTER TABLE `landingpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `statusbook`
--
ALTER TABLE `statusbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
