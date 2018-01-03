-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2018 at 03:03 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aero_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `chapter_name` text NOT NULL,
  `category` tinyint(1) NOT NULL COMMENT '0--> material, 1--> test',
  `sequence` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `id_module`, `chapter_name`, `category`, `sequence`, `created_at`, `updated_at`) VALUES
(1, 2, 'Chapter 1', 0, 0, '2017-12-29 12:30:55', '2017-12-29 12:30:55'),
(2, 2, 'Online Test', 1, 1, '2017-12-29 14:14:22', '2017-12-29 14:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `files_materials`
--

CREATE TABLE `files_materials` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files_materials`
--

INSERT INTO `files_materials` (`id`, `id_material`, `name`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'nama file', 'url file', '2017-12-29 13:37:42', '2017-12-29 13:37:42'),
(2, 1, 'file 2', 'url 2', '2017-12-29 14:06:02', '2017-12-29 14:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '0' COMMENT '0 --> public, 1--> job_family, 2-->department',
  `id_department` int(11) DEFAULT NULL,
  `id_job_family` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `content`, `created_by`, `category`, `id_department`, `id_job_family`, `created_at`, `updated_at`) VALUES
(1, 'forum 1', 'content forum 1', 1, 0, NULL, NULL, '2017-12-30 13:17:03', '2017-12-30 13:17:03'),
(2, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(3, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(4, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(5, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(6, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(7, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(8, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(9, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(10, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28'),
(11, 'forum 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 0, NULL, NULL, '2018-01-01 12:23:28', '2018-01-01 12:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `forum_attachments`
--

CREATE TABLE `forum_attachments` (
  `id` int(11) NOT NULL,
  `id_forum` int(11) NOT NULL,
  `attachment_name` text NOT NULL,
  `attachment_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(11) NOT NULL,
  `id_forum` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `id_forum`, `created_by`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Comments 1', 'Content comments 1', '2017-12-30 13:20:26', '2017-12-30 13:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comment_attachments`
--

CREATE TABLE `forum_comment_attachments` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `attachment_name` text NOT NULL,
  `attachment_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_viewers`
--

CREATE TABLE `forum_viewers` (
  `id` int(11) NOT NULL,
  `id_forum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `id_chapter`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'deskripsi material 1', '2017-12-29 13:35:12', '2017-12-29 13:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `modul_trainings`
--

CREATE TABLE `modul_trainings` (
  `id` int(11) NOT NULL,
  `modul_name` varchar(100) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `is_publish` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul_trainings`
--

INSERT INTO `modul_trainings` (`id`, `modul_name`, `id_parent`, `is_active`, `description`, `is_publish`, `created_at`, `updated_at`) VALUES
(1, 'Modul Training 1', 0, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2017-12-29 10:10:01', '2017-12-29 10:10:01'),
(2, 'Training 1', 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2017-12-29 10:24:12', '2017-12-29 10:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `newses`
--

CREATE TABLE `newses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_publish` tinyint(1) NOT NULL DEFAULT '0',
  `flag_active` tinyint(1) NOT NULL DEFAULT '0',
  `url_image` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newses`
--

INSERT INTO `newses` (`id`, `title`, `created_by`, `content`, `is_publish`, `flag_active`, `url_image`, `created_at`, `updated_at`) VALUES
(1, 'Title 1', 1, 'content title 1', 0, 1, NULL, '2017-12-29 15:08:57', '2017-12-29 17:36:11'),
(2, 'news 2', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:45', '2018-01-01 02:44:45'),
(3, 'news 3', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:45', '2018-01-01 02:44:45'),
(4, 'news 4', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:46', '2018-01-01 02:44:46'),
(5, 'news 5', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:46', '2018-01-01 02:44:46'),
(6, 'news 6', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:46', '2018-01-01 02:44:46'),
(7, 'news 7', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, NULL, '2018-01-01 02:44:46', '2018-01-01 02:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `news_attachments`
--

CREATE TABLE `news_attachments` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `attachment_name` text NOT NULL,
  `attachment_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_attachments`
--

INSERT INTO `news_attachments` (`id`, `id_news`, `attachment_name`, `attachment_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'name attachment', 'url attachment', '2017-12-29 15:40:46', '2017-12-29 15:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id`, `id_news`, `created_by`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'coms title', 'conten coms', '2017-12-29 15:41:40', '2017-12-29 15:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `news_comment_attachments`
--

CREATE TABLE `news_comment_attachments` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `attachment_name` text NOT NULL,
  `attachment_url` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_comment_attachments`
--

INSERT INTO `news_comment_attachments` (`id`, `id_comment`, `attachment_name`, `attachment_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'attach 1', 'url attach', '2017-12-29 15:42:28', '2017-12-29 15:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `news_viewers`
--

CREATE TABLE `news_viewers` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `url_file` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `id_test`, `question_text`, `url_file`, `created_at`, `updated_at`) VALUES
(1, 1, 'ini pertanyaannya ?', NULL, '2017-12-29 14:21:44', '2017-12-29 14:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `option_text` text NOT NULL,
  `is_true` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `id_question`, `option_text`, `is_true`, `created_at`, `updated_at`) VALUES
(1, 1, 'jawaban benar', 1, '2017-12-29 14:26:25', '2017-12-29 14:26:25'),
(2, 1, 'jawaban salah', 0, '2017-12-29 14:26:25', '2017-12-29 14:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `raports`
--

CREATE TABLE `raports` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `raport_title` text NOT NULL,
  `url_file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `second_title` text,
  `url_image` text,
  `flag_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `created_by`, `title`, `second_title`, `url_image`, `flag_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Slider 1', 'Second Title Slider 1', NULL, 1, '2017-12-29 23:50:34', '2017-12-29 17:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `id_chapter` int(11) NOT NULL,
  `description` text,
  `time` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `id_chapter`, `description`, `time`, `created_at`, `updated_at`) VALUES
(1, 2, 'ini online test', 20, '2017-12-29 14:20:37', '2017-12-29 14:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `remember_token` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user1', 'user1@aerofood.com', 'user1', '$2y$10$ULk9KrZFQBOEdbIwS7A9jeUdxb9eqxpy7iNlFvWPXZ7AYJ1Mlri3S', 'udZArlGSti70TAlKUM6RkDNaj8VvzoRCjCBDVXi4QoxCaeHtpUJH5i7swZT8', '2017-12-31 03:14:41', '2017-12-31 03:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_chapter_records`
--

CREATE TABLE `user_chapter_records` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_chapter_training` int(11) NOT NULL,
  `is_finish` tinyint(1) NOT NULL,
  `id_module_training` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_chapter_records`
--

INSERT INTO `user_chapter_records` (`id`, `id_user`, `id_chapter_training`, `is_finish`, `id_module_training`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, '2018-01-02 00:05:47', '2018-01-02 02:32:26'),
(2, 1, 2, 1, 2, '2018-01-02 00:05:47', '2018-01-02 18:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_test_records`
--

CREATE TABLE `user_test_records` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_option` int(11) DEFAULT NULL,
  `is_true` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_test_records`
--

INSERT INTO `user_test_records` (`id`, `id_user`, `id_test`, `id_question`, `id_option`, `is_true`, `created_at`, `updated_at`) VALUES
(61, 1, 1, 1, 1, 1, '2018-01-02 18:59:06', '2018-01-02 18:59:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files_materials`
--
ALTER TABLE `files_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_attachments`
--
ALTER TABLE `forum_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comment_attachments`
--
ALTER TABLE `forum_comment_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_viewers`
--
ALTER TABLE `forum_viewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul_trainings`
--
ALTER TABLE `modul_trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newses`
--
ALTER TABLE `newses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_attachments`
--
ALTER TABLE `news_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_comment_attachments`
--
ALTER TABLE `news_comment_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_viewers`
--
ALTER TABLE `news_viewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raports`
--
ALTER TABLE `raports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chapter_records`
--
ALTER TABLE `user_chapter_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_test_records`
--
ALTER TABLE `user_test_records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files_materials`
--
ALTER TABLE `files_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forum_attachments`
--
ALTER TABLE `forum_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum_comment_attachments`
--
ALTER TABLE `forum_comment_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_viewers`
--
ALTER TABLE `forum_viewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `modul_trainings`
--
ALTER TABLE `modul_trainings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newses`
--
ALTER TABLE `newses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_attachments`
--
ALTER TABLE `news_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_comment_attachments`
--
ALTER TABLE `news_comment_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_viewers`
--
ALTER TABLE `news_viewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `raports`
--
ALTER TABLE `raports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_chapter_records`
--
ALTER TABLE `user_chapter_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_test_records`
--
ALTER TABLE `user_test_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
