-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2016 at 02:59 PM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

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

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` int(12) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `address_receive_good` text NOT NULL,
  `date_purchased` datetime NOT NULL,
  `transaction_complete` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `phone`, `coupon_code`, `address_receive_good`, `date_purchased`, `transaction_complete`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 914081991, '', '', '2015-08-30 09:36:23', 0, NULL, '2016-09-29 09:15:34', '2015-08-30 02:36:23'),
(2, 2, 1664810141, '', '', '2015-08-30 10:36:23', 0, NULL, '2016-09-29 09:15:38', '2015-08-30 03:36:23'),
(4, 1, 435345435, 'wd4f', 'Da Nang', '2015-08-30 08:36:23', 1, NULL, '2016-09-30 02:22:10', '2015-08-30 01:36:23'),
(5, 1, 435345435, 'wd4f', 'Da Nang', '2015-08-30 08:36:47', 0, NULL, '2015-08-30 01:36:47', '2015-08-30 01:36:47'),
(6, 1, 1664810141, '', '', '2015-12-25 07:23:29', 0, NULL, '2015-12-25 00:23:29', '2015-12-25 00:23:29'),
(7, 1, 1664810141, '', '', '2016-08-17 09:52:44', 0, NULL, '2016-08-17 02:52:44', '2016-08-17 02:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
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
  `diravatar` varchar(300) NOT NULL,
  `youtube_url` varchar(100) NOT NULL,
  `vimeo_url` varchar(100) NOT NULL,
  `meta_description` varchar(145) NOT NULL,
  `custom_about_author` text NOT NULL,
  `custom_author_name` varchar(100) NOT NULL,
  `progress` int(11) NOT NULL,
  `release_note` text NOT NULL COMMENT 'The note when publish book to user , it will be sent by email to prospective user',
  `stealth_mode` int(11) NOT NULL,
  `is_published` tinyint(4) NOT NULL,
  `is_publish_sample` tinyint(4) NOT NULL,
  `allow_published` tinyint(4) NOT NULL DEFAULT '0',
  `views_num` int(11) DEFAULT '0',
  `copyright` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `subtitle`, `teaser`, `description`, `thankyoumessage`, `bookurl`, `language_id`, `google_analytic`, `page`, `avatar`, `diravatar`, `youtube_url`, `vimeo_url`, `meta_description`, `custom_about_author`, `custom_author_name`, `progress`, `release_note`, `stealth_mode`, `is_published`, `is_publish_sample`, `allow_published`, `views_num`, `copyright`, `deleted_at`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 'R Programming for Data Science', 'R Programming for Data Science by program', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Thank you message !', 'r-programming-for-data-science', 2, '', 0, 'bfV78zYBis.png', 'bfV78zYBis.png', 'f4r43fe', '5ghr65te', 'me ta des', 'custom about author', 'author custom', 90, '', 0, 1, 1, 0, NULL, NULL, NULL, '2016-10-04 07:13:11', '2016-10-04 00:13:11', '2015-08-03 17:00:00'),
(2, 'Exploring ES6s s', 'Exploring ES6', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'An in-depth book on ECMAScript 6, the new version of JavaScript. The target audience are programmers who already know JavaScript.', 'Thank you for buy item', 'exploring-es6s-s', 1, '', 0, 'PuvTLeMzgm.png', 'PuvTLeMzgm.png', '', '', '', '', '', 100, '', 0, 1, 0, 1, NULL, NULL, NULL, '2016-10-04 07:07:57', '2016-10-04 00:07:57', '2015-08-03 17:00:00'),
(3, 'MEAN Machine', 'MEAN Machine', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Become an impressive Node.js, AngularJS, ExpressJS, and MongoDB developer', 'Thank for you buy item', 'mean', 2, '', 200, '3vOdWtnFhc.png', '3vOdWtnFhc.png', '', '', '', '', '', 100, '', 0, 1, 0, 1, NULL, NULL, NULL, '2016-09-26 08:28:20', '2016-09-26 01:28:20', '2015-08-03 17:00:00'),
(4, 'SurviveJS - Webpack and React', 'SurviveJS - Webpack and React', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'Webpack, a module bundler, and React, a JavaScript library for building UIs are tools a modern web developer should know. In this book you will build a little Kanban application to get familiar with them. After completing the process you have a good starting point for developing your own.', 'Thank for buy message', 'survicejs', 2, '', 200, 'jDJTgPe8n3.jpg', 'jDJTgPe8n3.jpg', '', '', '', '', '', 100, '', 0, 1, 0, 0, NULL, NULL, NULL, '2016-09-26 03:32:30', '0000-00-00 00:00:00', '2015-08-08 17:00:00'),
(5, 'Understanding ECMAScript 6', 'Understanding ECMAScript 6', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'ECMAScript 6 represents the biggest change to the core of JavaScript in the history of the language. Not only does the sixth edition add new object types, but also new syntax and exciting new capabilities. The result of years of study and debate, ECMAScript 6 reached feature complete status in 2014. While it will take a bit of time before all JavaScript environments support ECMAScript 6, it''s still useful to understand what''s coming and which features are available already.\r\n\r\nThis book is a guide for the transition between ECMAScript 5 and 6. It is not specific to any JavaScript environment, so it is equally useful to web developers as it is Node.js developers.\r\n\r\nWhat you''ll learn:\r\n\r\nAll of the changes to the language since ECMAScript 5\r\nHow the new class syntax relates to more familiar JavaScript concepts\r\nWhy iterators and generators are useful\r\nHow arrow functions are differ from regular functions\r\nAdditional options for storing data using sets, maps, and more\r\nThe power of inheriting from native types\r\nWhy people are so excited about promises for asynchronous programming\r\nHow modules will change the way you organize code\r\nThis book is being developed in the open on GitHub. You can visit the project repo to see the latest updates. ECMAScript 6 represents the biggest change to the core of JavaScript in the history of the language. Not only does the sixth edition add new object types, but also new syntax and exciting new capabilities. The result of years of study and debate, ECMAScript 6 reached feature complete status in 2014. While it will take a bit of time before all JavaScript environments support ECMAScript 6, it''s still useful to understand what''s coming and which features are available already. ECMAScript 6 represents the biggest change to the core of JavaScript in the history of the language. Not only does the sixth edition add new object types, but also new syntax and exciting new capabilities. The result of years of study and debate, ECMAScript 6 reached feature complete status in 2014. While it will take a bit of time before all JavaScript environments support ECMAScript 6, it''s still useful to understand what''s coming and which features are available already.', 'Thank you for buying book', 'understandinges6', 1, '', 172, 'bwa9hLYIVP.png', 'bwa9hLYIVP.png', '', '', '', '', '', 100, '', 0, 1, 0, 0, NULL, NULL, NULL, '2016-09-26 03:32:48', '0000-00-00 00:00:00', '2016-08-11 08:26:12'),
(6, 'Principles of Object-Oriented Programming in JavaScript', 'Principles of Object-Oriented Programming in JavaScript', 'ECMAScript 6 is coming, are you ready? There''s a lot of new concepts to learn and understand. Get a headstart with this book!', 'If you’re coming from a more traditional object-oriented language such as C++ or Java, JavaScript might seem like it’s not object-oriented at all. After all, JavaScript has no concept of classes, and you don’t even need to define any objects in order to write code. JavaScript can look just as much like C as it can an object-oriented language depending on how you decide to write it. But don’t be fooled, JavaScript is an incredibly powerful and expressive object-oriented language that puts many design decisions in the hands of you, the developer.\r\n\r\nThis book is an exploration of the object-oriented nature of JavaScript. It is not specific to a particular JavaScript environment, so it’s equally useful for web developers and Node.js developers. The book includes information about ECMAScript 5 and its new capabilities that have changed how you can work with objects in JavaScript.\r\n\r\nWhat you''ll learn:\r\n\r\nThe differences between primitive and reference values\r\nWhat makes JavaScript functions so unique\r\nThe various ways of creating an object\r\nThe difference between data properties and accessor properties using ECMAScript 5\r\nHow to define your own constructors\r\nHow to work with and understand prototypes\r\nVarious inheritance patterns for types and objects\r\nHow to create private and privileged object members\r\nHow to prevent modification of objects using ECMAScript 5 functionality\r\nWant a print version of the book? Purchase Principles of Object-Oriented JavaScript from No Starch Press.', 'Thank you for buying book', 'oopinjavascript', 1, '', 230, 'l9dkh8O7yz.png', 'l9dkh8O7yz.png', '', '', '', '', '', 100, '', 0, 1, 0, 0, NULL, NULL, NULL, '2016-09-26 03:33:12', '0000-00-00 00:00:00', '2015-08-28 02:15:32'),
(17, ' The Node Craftsman Book ', 'An advanced Node.js tutorial ', '', 'Whether it''s Agile or Waterfall, RUP or XP, the software story hasn''t really changed.  We start out with the best of intentions, trying not to repeat the mistakes of the past.  We make a commitment to do things "the right way" this time.\r\n\r\nFast-forward to several years later, and we''re sitting around a conference table discussing what went wrong. How did we accumulate so much technical debt? Should we rewrite the component? Scrap the entire system and start over? Or just deal with the problems and try to keep on going? \r\n\r\nDespite our best efforts with Agile best practices, we get stuck in the software rewrite cycle.  With such a clear vision of the practices for success, why do we still end up with an unmaintainable mess?\r\n\r\nOur software problems are a reflection of our decision-making habits.  We try to improve, but focus on the symptoms in the code, and never fix the decisions that are creating the mess in the first place.  We try to explain the problems to leadership, but the business pressure never lets up -- we start over, but keep repeating the same mistakes.  \r\n\r\nSo how do we turn our projects around?   \r\n\r\nWe can''t see the problems, but we experience their effects.  Disruptions, test maintenance, confusing code, unfamiliar code, and collaboration problems -- they all have a direct impact on developer experience. What if we could make those problems visible?\r\n\r\nIdea Flow Mapping is a technique for visualizing the flow of ideas between the developer and the software.  Similar to how an EKG helps doctors diagnose heart problems, Idea Flow Maps help developers diagnose software problems.  \r\n\r\nOnce we make the pain visible, improvement becomes a systematic data-driven process.  We can:\r\n\r\n1. Identify the biggest problems on our software projects\r\n\r\n2. Make the case to management for improvement\r\n\r\n3. Create a data-driven feedback loop to learn what works\r\n\r\n4. Conquer even the hardest challenges on our software projects\r\n\r\nWith objective feedback on the consequences of our decisions, we can learn how to get better, faster. \r\n', '', 'desd', 1, '', 0, 'question-mark.png', 'question-mark.png', '', '', '', '', '', 0, '', 0, 1, 0, 0, NULL, 'copyright', NULL, '2016-08-19 06:54:07', '2016-08-18 23:54:07', '2015-08-28 02:15:46'),
(18, ' Idea Flow ', 'How to Measure the PAIN in Software Development', '', '\n\nWhether it''s Agile or Waterfall, RUP or XP, the software story hasn''t really changed.  We start out with the best of intentions, trying not to repeat the mistakes of the past.  We make a commitment to do things "the right way" this time.\n\nFast-forward to several years later, and we''re sitting around a conference table discussing what went wrong. How did we accumulate so much technical debt? Should we rewrite the component? Scrap the entire system and start over? Or just deal with the problems and try to keep on going? \n\nDespite our best efforts with Agile best practices, we get stuck in the software rewrite cycle.  With such a clear vision of the practices for success, why do we still end up with an unmaintainable mess?\n\nOur software problems are a reflection of our decision-making habits.  We try to improve, but focus on the symptoms in the code, and never fix the decisions that are creating the mess in the first place.  We try to explain the problems to leadership, but the business pressure never lets up -- we start over, but keep repeating the same mistakes.  \n\nSo how do we turn our projects around?   \n\nWe can''t see the problems, but we experience their effects.  Disruptions, test maintenance, confusing code, unfamiliar code, and collaboration problems -- they all have a direct impact on developer experience. What if we could make those problems visible?\n\nIdea Flow Mapping is a technique for visualizing the flow of ideas between the developer and the software.  Similar to how an EKG helps doctors diagnose heart problems, Idea Flow Maps help developers diagnose software problems.  \n\nOnce we make the pain visible, improvement becomes a systematic data-driven process.  We can:\n\n1. Identify the biggest problems on our software projects\n\n2. Make the case to management for improvement\n\n3. Create a data-driven feedback loop to learn what works\n\n4. Conquer even the hardest challenges on our software projects\n\nWith objective feedback on the consequences of our decisions, we can learn how to get better, faster. \n', '', 'idea-flow ', 1, '', 0, 'PvEgAjhi3R.jpg', 'PvEgAjhi3R.jpg', '', '', '', '', '', 0, 'Thank you for buy book.', 0, 1, 0, 1, NULL, 'copyright', NULL, '2016-09-26 08:15:16', '2016-09-26 01:15:16', '2016-08-11 07:19:25'),
(19, 'Unintended Features', 'Thoughts on thinking and life as a network engineer', '', 'So you’ve decided you want to be a network engineer—or you’re already you a network engineer, and you want to be a better engineer, to rise to the top, to be among the best, to… Well, you get the idea. The question is, how do you get from where you are now to where you want to be? This short volume is designed to answer just that question.', '', 'unintended-features', 1, '', 0, 'question-mark.png', 'question-mark.png', '', '', '', '', '', 0, '', 0, 1, 0, 0, NULL, 'Copyright', NULL, '2016-09-26 03:36:12', '2016-09-23 00:15:30', '2016-08-11 00:19:25'),
(20, 'The Elements of Data Analytic Style', 'efrgthyju', '', '', '', 'elementofdataAnalytic', 1, '', 0, 'BVjWoD63Ap.png', 'BVjWoD63Ap.png', '', '', '', '', '', 0, '', 0, 1, 0, 0, NULL, 'copyright', NULL, '2016-09-26 03:29:38', '2016-09-23 03:09:32', '2015-12-25 03:08:40'),
(21, ' Angular 2 ', 'A Practical Introduction to the new Web Development Platform Angular 2 (Angular.js, Angular.js 2, AngularJS, AngularJS 2, ng2) ', '  This book will be updated continuously until the final Angular 2 release! Learn to write Angular 2 applications from scratch  In this book you''ll learn everything about the new Angular 2 platform by following practical examples. This book starts from scratch and is suitable for beginners. No AngularJS 1.x knowledge is necessary. You just need to have a basic understanding of HTML and JavaScript to follow the easy and practical examples provided. What is Angular 2?  Angular 2 is the next major ', '\r\n\r\nThis book will be updated continuously until the final Angular 2 release!\r\nLearn to write Angular 2 applications from scratch\r\n\r\nIn this book you''ll learn everything about the new Angular 2 platform by following practical examples. This book starts from scratch and is suitable for beginners. No AngularJS 1.x knowledge is necessary. You just need to have a basic understanding of HTML and JavaScript to follow the easy and practical examples provided.\r\nWhat is Angular 2?\r\n\r\nAngular 2 is the next major version of Google''s popular JavaScript-based web framework. Angular 2 is designed for building complex applications for the browser. In contrast to version 1.x, Angular 2 introduces a complete new concept of building web applications. In this book you will learn the basic concepts and explore the new building blocks of Angular by following the practical code examples. \r\nWhat you''ll learn\r\n\r\nThis books guides you through all new aspects of Angular 2. You''ll get a real-world understanding of how Angular 2 can be applied in your own web and mobile applications. You''ll also learn the following:\r\n\r\n    How to build Angular 2 Components\r\n    Using Lifecycle Events to control your application state\r\n    Embedding Templates to create dynamic output\r\n    Implementing interactive Forms\r\n    Understanding and using Pipes\r\n    Using the new Angular 2 Routing System\r\n    Getting to know the concept of Dependency Injection & Services and use it in your Angular 2 application\r\n    Sending and receiving data by using the HTTP client\r\n    Combining the power of Meteor and Angular 2\r\n\r\nUpdates for the upcoming release\r\n\r\nAs Angular 2 is not yet released and only available as a beta version right now some aspects of the framework may change until the final release. Don''t mind. This book will be updated to keep information up to date.  \r\nCode Samples \r\n\r\nCode samples are provided in a GitHub repository to download and use for learning or within your own projects.\r\n\r\nIf you have any questions or comments, please don''t hesitate to get in touch.\r\nBook Sample / Preview\r\n\r\nA book sample in PDF format can be downloaded here.\r\n', '', 'angular2', 1, '', 0, 'ju8K14oryN.png', 'ju8K14oryN.png', '', '', '', '', '', 0, '', 0, 1, 0, 0, NULL, 'copyright', NULL, '2016-09-26 03:30:48', '2016-08-11 01:08:25', '2015-08-27 01:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `is_main` int(11) NOT NULL COMMENT '1 : main , 0 : co-author , 2 : contributor',
  `royalty` int(11) NOT NULL,
  `is_accepted` int(11) NOT NULL COMMENT '0 : not agree, 1 : accepted',
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `book_id`, `author_id`, `is_main`, `royalty`, `is_accepted`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 1, 1, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 2, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 3, 3, 1, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 1, 1, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 5, 1, 1, 0, 0, '', '2015-12-30 03:03:36', '0000-00-00 00:00:00'),
(8, 6, 2, 1, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 10, 2, 0, 1, '', '2015-08-25 06:48:50', '0000-00-00 00:00:00'),
(17, 17, 1, 1, 0, 1, '', '2015-08-27 08:38:56', '0000-00-00 00:00:00'),
(18, 18, 1, 1, 0, 1, '', '2015-08-28 09:15:33', '0000-00-00 00:00:00'),
(19, 19, 1, 1, 0, 1, '', '2015-08-28 09:15:46', '0000-00-00 00:00:00'),
(20, 20, 1, 1, 0, 1, '', '2016-08-11 04:43:03', '0000-00-00 00:00:00'),
(21, 21, 1, 1, 0, 1, '', '2016-08-11 07:50:01', '0000-00-00 00:00:00'),
(22, 20, 3, 0, 33, 0, '', '2016-09-24 04:29:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_bundle`
--

CREATE TABLE `book_bundle` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `royalty` int(11) NOT NULL,
  `accepted` tinyint(4) NOT NULL COMMENT 'check author book accept request which take book to their bundle',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_bundle`
--

INSERT INTO `book_bundle` (`id`, `book_id`, `bundle_id`, `royalty`, `accepted`, `updated_at`, `created_at`) VALUES
(1, 2, 1, 21, 1, '2016-08-18 04:21:03', '0000-00-00 00:00:00'),
(2, 4, 1, 45, 1, '2015-08-19 20:41:18', '2015-08-19 20:41:18'),
(3, 3, 2, 90, 1, '2016-08-18 19:13:32', '2016-08-17 19:13:32'),
(4, 3, 5, 22, 1, '2016-08-18 02:14:36', '2016-08-17 19:13:32'),
(5, 4, 5, 60, 1, '2016-08-17 19:13:42', '2016-08-17 19:13:42'),
(6, 2, 6, 21, 1, '2016-08-18 04:21:03', '0000-00-00 00:00:00'),
(7, 4, 6, 45, 1, '2015-08-19 20:41:18', '2015-08-19 20:41:18'),
(8, 3, 7, 90, 1, '2016-08-18 19:13:32', '2016-08-17 19:13:32'),
(9, 5, 7, 22, 1, '2016-08-18 06:37:15', '2016-08-17 19:13:32'),
(10, 4, 4, 60, 1, '2016-08-18 06:37:15', '2016-08-17 19:13:42'),
(11, 3, 4, 90, 1, '2016-08-18 19:13:32', '2016-08-17 19:13:32'),
(12, 2, 4, 22, 1, '2016-08-18 02:14:36', '2016-08-17 19:13:32'),
(13, 21, 6, 60, 1, '2016-08-17 19:13:42', '2016-08-17 19:13:42'),
(14, 2, 7, 50, 1, '2016-08-18 02:14:36', '2016-08-17 19:13:32'),
(15, 21, 7, 60, 1, '2016-08-18 07:55:45', '2016-08-17 19:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 6),
(4, 2, 6),
(5, 3, 6),
(6, 4, 6),
(7, 5, 6),
(8, 6, 6),
(9, 17, 6),
(10, 18, 6),
(11, 19, 6),
(14, 20, 10),
(15, 20, 12);

-- --------------------------------------------------------

--
-- Table structure for table `book_meta`
--

CREATE TABLE `book_meta` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `metakey` varchar(200) NOT NULL,
  `metavalue` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_resource`
--

CREATE TABLE `book_resource` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_wishlist`
--

CREATE TABLE `book_wishlist` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_wishlist`
--

INSERT INTO `book_wishlist` (`id`, `book_id`, `user_id`) VALUES
(3, 2, 1),
(4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `bundleurl` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `minimum` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(4) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`id`, `title`, `bundleurl`, `description`, `minimum`, `user_id`, `updated_at`, `created_at`, `published_at`, `is_published`, `deleted_at`) VALUES
(1, 'title bundle 1', 'titlebundle1', 'day la description bundle 1', 20, 2, '2016-10-02 00:22:21', '2015-12-30 03:16:13', '2015-12-30 03:16:13', 1, NULL),
(4, 'title bundle 4', 'urlbundle4', 'This is description of bundle', 44, 1, '2016-09-29 00:24:25', '2015-12-28 21:35:05', '2016-08-14 21:18:01', 1, NULL),
(5, 'title bundle 5', 'bundle5', 'This is description of bundle', 45, 1, '2016-08-18 02:11:39', '2015-12-28 21:35:05', '2016-08-14 21:18:01', 1, NULL),
(6, 'title bundle 6', 'bundle6', 'This is description of bundle', 55, 1, '2016-08-18 02:11:39', '2015-12-28 21:35:05', '2016-08-14 21:18:01', 1, NULL),
(7, 'title bundle 7', 'bundle7', 'This is description of bundle', 22, 1, '2016-09-26 21:21:30', '2015-12-28 21:35:05', '2016-08-14 21:18:01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `item_id`, `type`, `count`, `bill_id`, `unit_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 1800, NULL, '2015-08-27 08:38:56', '2016-08-20 18:31:59'),
(2, 2, 1, 1, 1, 1800, NULL, '2015-08-27 08:38:56', '2016-08-16 19:33:44'),
(3, 3, 1, 1, 2, 1800, NULL, '2015-08-27 08:38:56', '2016-08-21 01:12:42'),
(4, 2, 1, 1, 2, 1800, NULL, '2015-08-27 08:38:56', '2016-08-19 02:22:19'),
(5, 2, 1, 1, 5, 1800, NULL, '2015-08-20 08:38:56', '2016-08-17 15:13:32'),
(6, 5, 1, 1, 6, 1400, NULL, '2015-08-16 07:38:56', '2016-08-16 04:00:40'),
(7, 1, 1, 1, 6, 2300, NULL, '2016-08-16 02:52:44', '2016-08-20 05:22:46'),
(8, 4, 1, 3, 4, 4000, NULL, '2015-08-21 08:38:56', '2016-08-16 21:51:48'),
(9, 5, 1, 2, 4, 500, NULL, '2015-08-27 08:38:56', '2016-08-16 04:10:46'),
(10, 6, 1, 5, 6, 3000, NULL, '2015-08-15 08:38:56', '2016-08-15 10:18:25'),
(11, 2, 1, 2, 7, 1900, NULL, '2016-08-17 02:52:44', '2016-08-20 21:59:50'),
(12, 5, 1, 3, 7, 140, NULL, '2016-08-17 02:52:44', '2016-08-15 14:03:53'),
(13, 6, 1, 1, 7, 595, NULL, '2016-08-17 02:52:44', '2016-08-21 11:19:57'),
(14, 1, 2, 2, 1, 1800, NULL, '2015-08-27 08:38:56', '2016-08-17 21:28:05'),
(15, 4, 2, 1, 1, 1800, NULL, '2015-08-27 08:38:56', '2016-08-20 07:53:35'),
(16, 5, 2, 1, 2, 1800, NULL, '2015-08-27 08:38:56', '2016-08-17 08:20:34'),
(17, 6, 2, 1, 2, 1800, NULL, '2015-08-27 08:38:56', '2016-08-18 08:18:35'),
(18, 7, 2, 1, 5, 1800, NULL, '2015-08-20 08:38:56', '2016-08-17 23:31:15'),
(19, 1, 2, 1, 6, 1400, NULL, '2015-08-16 08:38:56', '2016-08-20 03:40:31'),
(20, 4, 2, 1, 6, 2300, NULL, '2015-08-17 04:38:56', '2016-08-18 02:48:51'),
(21, 5, 2, 3, 4, 4000, NULL, '2015-08-16 03:38:56', '2016-08-15 10:02:40'),
(22, 6, 2, 2, 4, 500, NULL, '2015-08-27 08:38:56', '2016-08-15 00:46:49'),
(23, 7, 2, 5, 6, 3000, NULL, '2015-08-19 08:38:56', '2016-08-21 04:46:05'),
(24, 1, 2, 2, 7, 1900, NULL, '2016-08-17 02:52:44', '2016-08-18 04:30:01'),
(25, 4, 2, 3, 7, 140, NULL, '2016-08-17 02:52:44', '2016-08-19 15:11:48'),
(26, 5, 2, 1, 7, 595, NULL, '2016-08-17 02:52:44', '2016-08-14 21:28:58'),
(27, 6, 2, 1, 7, 1400, NULL, '2015-08-16 08:38:56', '2016-08-14 20:49:27'),
(28, 5, 2, 2, 6, 2300, NULL, '2015-08-16 08:38:56', '2016-08-14 22:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Academic'),
(2, 'Agile'),
(3, 'Biographies'),
(4, 'Business and econimics'),
(5, 'Cookbooks'),
(6, 'Creative Non-fiction'),
(7, 'Culture'),
(8, 'General'),
(9, 'History'),
(10, 'Music'),
(11, 'Internet'),
(12, 'Phylosophy');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `book_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `parent` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_note` varchar(200) NOT NULL,
  `book_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `unit` text NOT NULL,
  `limitcount` int(11) NOT NULL,
  `is_actived` tinyint(4) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_note`, `book_id`, `number`, `unit`, `limitcount`, `is_actived`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'DFDSD', 'Chirismate day', 20, 18, '%', 20, 1, '2016-09-26 11:03:25', '2016-09-30 11:03:31', '2016-09-25 04:48:23', '2016-09-24 21:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `extrafiles`
--

CREATE TABLE `extrafiles` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `link` varchar(80) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `is_attached` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extrafiles`
--

INSERT INTO `extrafiles` (`id`, `name`, `link`, `extra_id`, `is_attached`, `updated_at`, `created_at`) VALUES
(16, 'Dac-Nhan-Tam-Dale-Carnegie.prc', '5zuAUM60tu.prc', 1, 1, '2015-08-22 02:32:51', '2015-08-21 21:06:33'),
(19, 'The-gioi-phang-Thomas-L.-Friedman.prc', 'ozVS9QFgQ8.prc', 1, 1, '2015-08-22 07:26:35', '2015-08-22 07:26:35'),
(20, 'cauchuyenmotgiacmo.pdf', 'LpYnehm9p3.pdf', 1, 1, '2015-08-22 07:33:28', '2015-08-22 07:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `package_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `name`, `description`, `package_id`, `updated_at`, `created_at`) VALUES
(1, 'extra1', 'mo ta extra1 them vao', 1, '2015-08-22 07:33:21', '2015-08-22 02:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `filebooks`
--

CREATE TABLE `filebooks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `book_id` int(11) NOT NULL,
  `is_sample` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filebooks`
--

INSERT INTO `filebooks` (`id`, `name`, `link`, `content`, `book_id`, `is_sample`, `updated_at`, `created_at`) VALUES
(58, 'saasfd.txt', 'saasf.txt', '---\n__Advertisement :)__\n\n- __[pica](https://nodeca.github.io/pica/demo/)__ - high quality and fast image\n  resize in browser.\n- __[babelfish](https://github.com/nodeca/babelfish/)__ - developer friendly\n  i18n with plurals support and easy syntax.\n\nYou will like those projects!\n\n---\n\n# h1 Heading\n## h2 Heading\n### h3 Heading\n#### h4 Heading\n##### h5 Heading\n###### h6 Heading\n\n\n## Horizontal Rules\n\n___\n\n---\n\n***\n\n\n## Typographic replacements\n\nEnable typographer option to see result.\n\n(c) (C) (r) (R) (tm) (TM) (p) (P) +-\n\ntest.. test... test..... test?..... test!....\n\n!!!!!! ???? ,,\n\nRemarkable -- awesome\n\n"Smartypants, double quotes"\n\n''Smartypants, single quotes''\n\n\n## Emphasis\n\n**This is bold text**\n\n__This is bold text__\n\n*This is italic text*\n\n_This is italic text_\n\n~~Deleted text~~\n\nSuperscript: 19^th^\n\nSubscript: H~2~O\n\n++Inserted text++\n\n==Marked text==\n\n\n## Blockquotes\n\n\n> Blockquotes can also be nested...\n>> ...by using additional greater-than signs right next to each other...\n> > > ...or with spaces between arrows.\n\n\n## Lists\n\nUnordered\n\n+ Create a list by starting a line with `+`, `-`, or `*`\n+ Sub-lists are made by indenting 2 spaces:\n  - Marker character change forces new list start:\n    * Ac tristique libero volutpat at\n    + Facilisis in pretium nisl aliquet\n    - Nulla volutpat aliquam velit\n+ Very easy!\n\nOrdered\n\n1. Lorem ipsum dolor sit amet\n2. Consectetur adipiscing elit\n3. Integer molestie lorem at massa\n\n\n1. You can use sequential numbers...\n1. ...or keep all the numbers as `1.`\n\nStart numbering with offset:\n\n57. foo\n1. bar\n\n\n## Code\n\nInline `code`\n\nIndented code\n\n    // Some comments\n    line 1 of code\n    line 2 of code\n    line 3 of code\n\n\nBlock code "fences"\n\n```\nSample text here...\n```\n\nSyntax highlighting\n\n``` js\nvar foo = function (bar) {\n  return bar++;\n};\n\nconsole.log(foo(5));\n```\n\n## Tables\n\n| Option | Description |\n| ------ | ----------- |\n| data   | path to data files to supply the data that will be passed into templates. |\n| engine | engine to be used for processing templates. Handlebars is the default. |\n| ext    | extension to be used for dest files. |\n\nRight aligned columns\n\n| Option | Description |\n| ------:| -----------:|\n| data   | path to data files to supply the data that will be passed into templates. |\n| engine | engine to be used for processing templates. Handlebars is the default. |\n| ext    | extension to be used for dest files. |\n\n\n## Links\n\n[link text](http://dev.nodeca.com)\n\n[link with title](http://nodeca.github.io/pica/demo/ "title text!")\n\nAutoconverted link https://github.com/nodeca/pica (enable linkify to see)\n\n\n## Images\n\n![Minion](https://octodex.github.com/images/minion.png)\n![Stormtroopocat](https://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")\n\nLike links, Images also have a footnote style syntax\n\n![Alt text][id]\n\nWith a reference later in the document defining the URL location:\n\n[id]: https://octodex.github.com/images/dojocat.jpg  "The Dojocat"\n\n\n## Footnotes\n\nFootnote 1 link[^first].\n\nFootnote 2 link[^second].\n\nInline footnote^[Text of inline footnote] definition.\n\nDuplicated footnote reference[^second].\n\n[^first]: Footnote **can have markup**\n\n    and multiple paragraphs.\n\n[^second]: Footnote text.\n\n\n## Definition lists\n\nTerm 1\n\n:   Definition 1\nwith lazy continuation.\n\nTerm 2 with *inline markup*\n\n:   Definition 2\n\n        { some code, part of Definition 2 }\n\n    Third paragraph of definition 2.\n\n_Compact style:_\n\nTerm 1\n  ~ Definition 1\n\nTerm 2\n  ~ Definition 2a\n  ~ Definition 2b\n\n\n## Abbreviations\n\nThis is HTML abbreviation example.\n\nIt converts "HTML", but keep intact partial entries like "xxxHTMLyyy" and so on.\n\n*[HTML]: Hyper Text Markup Language\n', 1, 1, '2015-12-25 03:50:29', '2015-08-10 00:51:02'),
(59, 'asfrehg.txt', 'asfrehg.txt', '#sadasfef', 1, 0, '2015-08-30 19:51:04', '2015-08-10 00:51:15'),
(60, 'sample1.txt', 'sample1.txt', '', 8, 0, '2015-08-31 02:52:21', '0000-00-00 00:00:00'),
(61, 'sample2.txt', 'sample2.txt', '', 8, 0, '2015-08-31 02:52:21', '0000-00-00 00:00:00'),
(62, 'sample3.txt', 'sample3.txt', '', 8, 0, '2015-08-31 02:52:21', '0000-00-00 00:00:00'),
(63, 'sample1.txt', 'sample1.txt', '', 4, 0, '2015-12-25 02:11:19', '0000-00-00 00:00:00'),
(64, 'sample2.txt', 'sample2.txt', '', 4, 0, '2015-12-25 02:11:19', '0000-00-00 00:00:00'),
(65, 'sample3.txt', 'sample3.txt', '', 4, 0, '2015-12-25 02:11:19', '0000-00-00 00:00:00'),
(66, 'sample1.txt', 'sample1.txt', '', 3, 0, '2015-12-25 02:21:18', '0000-00-00 00:00:00'),
(67, 'sample2.txt', 'sample2.txt', '', 3, 0, '2015-12-25 02:21:18', '0000-00-00 00:00:00'),
(68, 'sample3.txt', 'sample3.txt', '', 3, 0, '2015-12-25 02:21:18', '0000-00-00 00:00:00'),
(69, 'sample1.txt', 'sample1.txt', '', 2, 0, '2015-12-25 02:35:01', '0000-00-00 00:00:00'),
(70, 'sample2.txt', 'sample2.txt', '', 2, 0, '2015-12-25 02:35:01', '0000-00-00 00:00:00'),
(71, 'sample3.txt', 'sample3.txt', '', 2, 0, '2015-12-25 02:35:01', '0000-00-00 00:00:00'),
(72, 'sample1.txt', 'sample1.txt', '', 17, 0, '2016-08-09 10:37:52', '0000-00-00 00:00:00'),
(73, 'sample2.txt', 'sample2.txt', '', 17, 0, '2016-08-09 10:37:52', '0000-00-00 00:00:00'),
(74, 'sample3.txt', 'sample3.txt', '', 17, 0, '2016-08-09 10:37:52', '0000-00-00 00:00:00'),
(75, 'sample1.txt', 'sample1.txt', '', 20, 0, '2016-08-11 07:30:12', '0000-00-00 00:00:00'),
(76, 'sample2.txt', 'sample2.txt', '', 20, 0, '2016-08-11 07:30:12', '0000-00-00 00:00:00'),
(77, 'sample3.txt', 'sample3.txt', '', 20, 0, '2016-08-11 07:30:12', '0000-00-00 00:00:00'),
(78, 'sample1.txt', 'sample1.txt', '', 21, 0, '2016-08-11 07:51:22', '0000-00-00 00:00:00'),
(79, 'sample2.txt', 'sample2.txt', '', 21, 0, '2016-08-11 07:51:22', '0000-00-00 00:00:00'),
(80, 'sample3.txt', 'sample3.txt', '', 21, 0, '2016-08-11 07:51:22', '0000-00-00 00:00:00'),
(81, 'sample1.txt', 'sample1.txt', '', 18, 0, '2016-08-18 07:42:48', '0000-00-00 00:00:00'),
(82, 'sample2.txt', 'sample2.txt', '', 18, 0, '2016-08-18 07:42:48', '0000-00-00 00:00:00'),
(83, 'sample3.txt', 'sample3.txt', '', 18, 0, '2016-08-18 07:42:48', '0000-00-00 00:00:00'),
(84, 'sample1.txt', 'sample1.txt', '', 19, 0, '2016-09-23 07:15:33', '0000-00-00 00:00:00'),
(85, 'sample2.txt', 'sample2.txt', '', 19, 0, '2016-09-23 07:15:33', '0000-00-00 00:00:00'),
(86, 'sample3.txt', 'sample3.txt', '', 19, 0, '2016-09-23 07:15:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `identity` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `user_send` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `landingpage`
--

CREATE TABLE `landingpage` (
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

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2015-05-27 07:36:24', '2015-06-11 20:39:47'),
(2, 'Japanese', 'jp', 0, '2015-05-27 07:36:36', '2015-06-11 10:25:37'),
(3, 'France', 'fr', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Autralia', 'au', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `minimumprice` float NOT NULL,
  `suggestedprice` float NOT NULL,
  `description` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `minimumprice`, `suggestedprice`, `description`, `url`, `quantity`, `book_id`, `coupon_id`, `updated_at`, `created_at`) VALUES
(1, 'name 1', 22, 35, 'asdasd', 'slasdsa', 3, 1, 0, '2015-08-22 08:22:53', '2015-08-20 02:28:41'),
(3, 'Package 3 in 1 Unintended Features', 33, 22, 'Description package 3 in 1 Unintended Features', 'package-3-in-1-unintended-features', 2, 19, 0, '2016-09-28 19:08:27', '2016-09-23 01:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `popularity`
--

CREATE TABLE `popularity` (
  `id` int(11) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `action` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `popularity`
--

INSERT INTO `popularity` (`id`, `identity`, `item_id`, `type`, `action`, `created_at`, `updated_at`) VALUES
(1, '1', 6, 1, 1, '2016-08-11 03:31:56', '2016-08-11 03:31:56'),
(2, '127.0.0.1', 2, 1, 1, '2016-08-11 19:07:32', '2016-08-11 19:07:32'),
(3, '127.0.0.1', 2, 1, 1, '2016-08-11 19:07:46', '2016-08-11 19:07:46'),
(4, '127.0.0.1', 6, 1, 1, '2016-08-11 19:10:28', '2016-08-11 19:10:28'),
(5, '127.0.2.1', 5, 1, 1, '2016-08-11 19:10:28', '2016-08-11 19:10:28'),
(6, '127.0.2.2', 3, 1, 1, '2016-08-11 19:10:28', '2016-08-11 19:10:28'),
(7, '127.0.0.1', 1, 1, 1, '2016-08-12 01:13:42', '2016-08-12 01:13:42'),
(8, '1', 4, 1, 1, '2016-08-16 02:13:11', '2016-08-16 02:13:11'),
(9, '1', 4, 1, 1, '2016-08-16 02:20:29', '2016-08-16 02:20:29'),
(10, '1', 4, 1, 1, '2016-08-16 02:48:07', '2016-08-16 02:48:07'),
(11, '1', 4, 1, 1, '2016-08-16 02:51:40', '2016-08-16 02:51:40'),
(12, '1', 4, 1, 1, '2016-08-16 02:51:43', '2016-08-16 02:51:43'),
(13, '1', 4, 1, 1, '2016-08-16 02:51:59', '2016-08-16 02:51:59'),
(14, '1', 4, 1, 1, '2016-08-16 02:52:03', '2016-08-16 02:52:03'),
(15, '1', 4, 1, 1, '2016-08-16 02:53:27', '2016-08-16 02:53:27'),
(16, '1', 4, 1, 1, '2016-08-16 02:53:29', '2016-08-16 02:53:29'),
(17, '1', 4, 1, 1, '2016-08-16 02:54:46', '2016-08-16 02:54:46'),
(18, '1', 4, 1, 1, '2016-08-16 02:54:47', '2016-08-16 02:54:47'),
(19, '1', 4, 1, 1, '2016-08-16 02:57:12', '2016-08-16 02:57:12'),
(20, '1', 4, 1, 1, '2016-08-16 02:57:54', '2016-08-16 02:57:54'),
(21, '1', 4, 1, 1, '2016-08-16 02:57:56', '2016-08-16 02:57:56'),
(22, '1', 4, 1, 1, '2016-08-16 03:02:49', '2016-08-16 03:02:49'),
(23, '1', 4, 1, 1, '2016-08-16 03:02:51', '2016-08-16 03:02:51'),
(24, '1', 4, 1, 1, '2016-08-16 03:04:19', '2016-08-16 03:04:19'),
(25, '1', 4, 1, 1, '2016-08-16 03:08:19', '2016-08-16 03:08:19'),
(26, '127.0.0.1', 2, 1, 1, '2016-08-16 03:10:40', '2016-08-16 03:10:40'),
(27, '1', 2, 1, 1, '2016-08-16 03:13:46', '2016-08-16 03:13:46'),
(28, '1', 2, 1, 1, '2016-08-16 19:22:09', '2016-08-16 19:22:09'),
(29, '1', 5, 1, 1, '2016-08-17 01:48:32', '2016-08-17 01:48:32'),
(30, '1', 6, 1, 1, '2016-08-17 01:49:01', '2016-08-17 01:49:01'),
(38, '::1', 4, 2, 1, '2016-08-21 21:09:49', '2016-08-21 21:09:49'),
(39, '1', 4, 2, 1, '2016-08-21 21:10:00', '2016-08-21 21:10:00'),
(40, '::1', 0, 1, 1, '2016-09-19 21:55:02', '2016-09-19 21:55:02'),
(41, '::1', 0, 1, 1, '2016-09-23 00:08:52', '2016-09-23 00:08:52'),
(42, '::1', 0, 1, 1, '2016-09-23 00:10:02', '2016-09-23 00:10:02'),
(43, '::1', 0, 1, 1, '2016-09-23 00:13:01', '2016-09-23 00:13:01'),
(44, '::1', 0, 1, 1, '2016-09-23 00:13:08', '2016-09-23 00:13:08'),
(45, '1', 6, 1, 1, '2016-09-25 20:28:02', '2016-09-25 20:28:02'),
(46, '1', 20, 1, 1, '2016-09-25 20:28:11', '2016-09-25 20:28:11'),
(47, '1', 20, 1, 1, '2016-09-25 20:59:02', '2016-09-25 20:59:02'),
(48, '1', 20, 1, 1, '2016-09-25 21:08:16', '2016-09-25 21:08:16'),
(49, '1', 20, 1, 1, '2016-09-25 21:09:36', '2016-09-25 21:09:36'),
(50, '1', 20, 1, 1, '2016-09-25 21:15:25', '2016-09-25 21:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `minimumprice` float NOT NULL,
  `suggestedprice` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `item_id`, `type`, `minimumprice`, `suggestedprice`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 2300, 2501, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(2, 2, 1, 1800, 2000, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(3, 3, 1, 1200, 1500, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(4, 4, 1, 1001, 1600, '2016-10-02 01:04:02', '0000-00-00 00:00:00'),
(5, 5, 1, 1400, 1600, '2016-08-16 10:28:11', '0000-00-00 00:00:00'),
(6, 6, 1, 500, 800, '2016-08-16 10:28:11', '0000-00-00 00:00:00'),
(7, 17, 1, 0, 0, '2016-08-16 10:28:11', '2015-08-27 01:38:56'),
(8, 18, 1, 0, 0, '2016-08-16 10:28:11', '2015-08-28 02:15:33'),
(9, 19, 1, 0, 0, '2016-08-16 10:28:11', '2015-08-28 02:15:46'),
(10, 20, 1, 0, 0, '2016-08-16 10:28:11', '2016-08-10 21:43:03'),
(11, 21, 1, 12, 15, '2016-08-16 10:28:11', '2016-08-11 00:50:01'),
(12, 1, 2, 2300, 2501, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(13, 4, 2, 1800, 2000, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(14, 5, 2, 1200, 1500, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(15, 6, 2, 1000, 1600, '2016-08-16 10:26:53', '0000-00-00 00:00:00'),
(16, 7, 2, 1400, 1600, '2016-08-16 10:28:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
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

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Author'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state_bundle`
--

CREATE TABLE `state_bundle` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statusbook`
--

CREATE TABLE `statusbook` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `blurb` text,
  `is_locked` tinyint(4) DEFAULT '0',
  `twitter_id` varchar(60) DEFAULT NULL,
  `github` varchar(60) DEFAULT NULL,
  `googleplus` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `role_id`, `avatar`, `blurb`, `is_locked`, `twitter_id`, `github`, `googleplus`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'phann123', 'ngoc', 'phan', 'phann123@yahoo.com', '$2a$08$CuOIJtTYyyImsCdf2P6izeLdX3kXcrM1vWcPBREj9NdUEX3qh0ngm', 2, 'default-avatar.png', 'Janelle is a NFJS Tour Speaker, author of the book, Idea Flow: How to Measure the PAIN in Software Development, and founder of Open Mastery, a free-to-join industry peer mentorship network focused on data-driven software mastery.\n\nShe founded Open Mastery to rally the industry in working together, and learning together to break down the wall of ignorance between managers and developers that drives our software projects into the ground.  By making the pain visible with Idea Flow, we have a universal definition of effective practice, a universal language for sharing our experiences, and an opportunity to learn together like never before.  Open Mastery is about taking the industry to a whole new level of effectiveness by working together.\n\nAside from Open Mastery, Janelle has been working with New Iron for the last 10 years, as a developer, consultant, and now as CTO.   Her development background is specialized in data-intensive analytic systems from financial core processors to factory automation, supply chain optimization and statistical process control (SPC).  Her consulting work has focused on Continuous Delivery infrastructure, database automation, test automation strategies, and helping companies identify and solve their biggest problems.\n', 0, 'twdsd', 'phaan2', 'egrt', 'A7zTNy8hasr44BvtJhJIXhivciejeyCffQpMMex5MhfZM5PIk4QoHlhTtxI7', '2016-10-04 07:31:49', '2016-10-04 00:31:49'),
(2, 'tony', 'Lam', 'Tuan', 'lequidon.1993@gmail.com', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', 0, '', '', '', '', '2016-09-29 04:52:59', '2016-09-28 21:52:59'),
(3, 'leduong', 'duong', 'le thanh', 'suc@gmail.com', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', 0, '', '', '', '', '2016-09-21 03:10:48', '0000-00-00 00:00:00'),
(4, 'tuansds', 'Tuan', 'Vuong Van', 'vuongvan@gmail.com', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'Roger D. Peng is an Associate Professor of Biostatistics at the Johns Hopkins Bloomberg School of Public Health. He is also a Co-Founder of the Johns Hopkins Data Science Specialization, which has enrolled over 1.5 million students, and the Simply Statistics blog where he writes about statistics for the general public. Roger can be found on Twitter and GitHub @rdpeng.', 0, '', '', '', '', '2016-09-21 03:10:50', '0000-00-00 00:00:00'),
(10, 'tuananh', 'tuan anh', 'phan', 'rtg@df.dfgd', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'asddasd', 0, 'aliman', 'gitton', 'tuananh', '', '2016-09-26 09:11:27', '2015-08-25 18:17:31'),
(11, 'phantuan', 'tuan', 'phan', 'tuan@gmail.com', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'asddasd', 0, 'aliman', 'gitton', 'tuananh', '', '2016-09-26 09:11:31', '2015-08-25 18:17:31'),
(12, 'nguyentruong', 'truong', 'nguyen', 'tuante@gmail.com', '$2y$10$/kTyAFKciIDImKe8GW2w..7XxCuXMV1DZ5WigoVyXQHKYwXd7QqCu', 1, 'default-avatar.png', 'asddasd', 0, 'aliman', 'gitton', 'tuananh', '', '2016-09-21 03:10:52', '2015-08-25 18:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_read_book`
--

CREATE TABLE `user_read_book` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` varchar(45) DEFAULT NULL,
  `is_can_read` tinyint(4) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
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
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_meta`
--
ALTER TABLE `book_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_resource`
--
ALTER TABLE `book_resource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_wishlist`
--
ALTER TABLE `book_wishlist`
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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `extrafiles`
--
ALTER TABLE `extrafiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
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
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popularity`
--
ALTER TABLE `popularity`
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
-- Indexes for table `state_bundle`
--
ALTER TABLE `state_bundle`
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
-- Indexes for table `user_read_book`
--
ALTER TABLE `user_read_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `book_bundle`
--
ALTER TABLE `book_bundle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `book_meta`
--
ALTER TABLE `book_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_resource`
--
ALTER TABLE `book_resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_wishlist`
--
ALTER TABLE `book_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `extrafiles`
--
ALTER TABLE `extrafiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `filebooks`
--
ALTER TABLE `filebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `popularity`
--
ALTER TABLE `popularity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state_bundle`
--
ALTER TABLE `state_bundle`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_read_book`
--
ALTER TABLE `user_read_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
