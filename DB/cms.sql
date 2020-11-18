-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 12:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`) VALUES
(6, 'MObiles'),
(7, 'Books'),
(8, 'Laptops');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `image`, `comment`, `status`) VALUES
(1, 1234567890, 'azam', 'ikram', 55, 'azamikram919@gmail.com', 'images.png', 'Sfxasxaekenweerqwnernqw;ernqiwrkwnfirkwifwerwerhwuierhwierhuiwerhwhriwheuirhuiwrhihwihq hqw rihwriq hwi qiuwrh iqwh ihweri uq iwrhqh riqiwhriqwh ihqi fkadfSDFBaskfbs ', 'approve'),
(2, 1234567890, 'john', 'doe', 55, 'john@gmail.com', 'images.png', 'Sfxasxaekenweerqwnernqw;ernqiwrkwnfirkwifwerwerhwuierhwierhuiwerhwhriwheuirhuiwrhihwihq hqw rihwriq hwi qiuwrh iqwh ihweri uq iwrhqh riqiwhriqwh ihqi fkadfSDFBaskfbs ', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_image` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `post_data` text NOT NULL,
  `views` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `title`, `author`, `author_image`, `image`, `categories`, `tags`, `post_data`, `views`, `status`) VALUES
(32, 1592201783, 'azamikram', 'xaimikram', '383_Wpbeginner-512.png', 'bitcoin-cryptocurrency5k-ne.jpg', 'Laptops', 'what is loram ipsum', '<p>what is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsumwhat is loram ipsum</p>', 12, 'publish'),
(36, 1592208613, 'john', 'xaimikram', '383_Wpbeginner-512.png', '06_preview7.png', 'Laptops', '$title = $row [\'title\'];', '<pre style=\"background-color: #2b2b2b; color: #a9b7c6; font-family: \'Courier New\'; font-size: 13.5pt;\"><span style=\"color: #9876aa; background-color: #232525;\">$title </span><span style=\"background-color: #232525;\">= </span><span style=\"color: #9876aa; background-color: #232525;\">$row </span><span style=\"background-color: #232525;\">[</span><span style=\"color: #6a8759; background-color: #232525;\">\'title\'</span><span style=\"background-color: #232525;\">]</span><span style=\"color: #cc7832; background-color: #232525;\">;</span>$title <span style=\"font-size: 13.5pt; background-color: #232525;\">= </span><span style=\"font-size: 13.5pt; color: #9876aa; background-color: #232525;\">$row </span><span style=\"font-size: 13.5pt; background-color: #232525;\">[</span><span style=\"font-size: 13.5pt; color: #6a8759; background-color: #232525;\">\'title\'</span><span style=\"font-size: 13.5pt; background-color: #232525;\">]</span><span style=\"font-size: 13.5pt; color: #cc7832; background-color: #232525;\">;</span>$title <span style=\"font-size: 13.5pt; background-color: #232525;\">= </span><span style=\"font-size: 13.5pt; color: #9876aa; background-color: #232525;\">$row </span><span style=\"font-size: 13.5pt; background-color: #232525;\">[</span><span style=\"font-size: 13.5pt; color: #6a8759; background-color: #232525;\">\'title\'</span><span style=\"font-size: 13.5pt; background-color: #232525;\">]</span><span style=\"font-size: 13.5pt; color: #cc7832; background-color: #232525;\">;</span></pre>', 12, 'publish'),
(37, 1592217779, 'What is Lorem Ipsum?', 'xaimikram', '383_Wpbeginner-512.png', 'download (2).jpg', 'Laptops', 'zsd', '<p><strong style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 12, 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discription` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `discription`, `image`) VALUES
(8, 'azamikram', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', '06_preview7.png'),
(10, 'john', '                 HLo n sfndNA KD A IQU  i I i i isi vi iwfiweifuiefufi i ihiuefwif iwefiw fiwf               ', 'download (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_rname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `salt` varchar(255) NOT NULL DEFAULT '$2y$10$quickbrownfoxjumpsover',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `first_name`, `last_rname`, `username`, `email`, `image`, `password`, `role`, `details`, `salt`, `created_at`) VALUES
(33, 0, 'xaim', 'ikram', 'xaimikram', 'xaim@gmail.com', '383_Wpbeginner-512.png', '123', 'admin', '', '$2y$10$quickbrownfoxjumpsover', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
