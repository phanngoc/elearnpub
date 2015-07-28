-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2015 at 04:33 PM
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
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `thankyoumessage` text NOT NULL,
  `bookurl` varchar(200) NOT NULL,
  `language_id` int(11) NOT NULL,
  `google_analytic` varchar(200) NOT NULL,
  `page` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `description`, `thankyoumessage`, `bookurl`, `language_id`, `google_analytic`, `page`) VALUES
(1, 'R Programming for Data Science', 'R Programming for Data Science by program', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Thank you message !', 'R-program', 1, '', 0),
(2, 'Exploring ES6', 'Exploring ES6', 'An in-depth book on ECMAScript 6, the new version of JavaScript. The target audience are programmers who already know JavaScript.', 'Thank you for buy item', 'explore-es6', 1, '', 0),
(3, 'MEAN Machine', 'MEAN Machine', 'Become an impressive Node.js, AngularJS, ExpressJS, and MongoDB developer', 'Thank for you buy item', 'mean', 2, '', 200),
(4, 'SurviveJS - Webpack and React', 'SurviveJS - Webpack and React', 'Webpack, a module bundler, and React, a JavaScript library for building UIs are tools a modern web developer should know. In this book you will build a little Kanban application to get familiar with them. After completing the process you have a good starting point for developing your own.', 'Thank for buy message', 'survicejs', 2, '', 200);

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `is_main` int(11) NOT NULL,
  `custom_name` varchar(100) NOT NULL
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
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(300) NOT NULL,
  `book_id` int(11) NOT NULL
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
