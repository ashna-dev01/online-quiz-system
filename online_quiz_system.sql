-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2026 at 09:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_quiz_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_answer` varchar(20) NOT NULL,
  `correct_answer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `attempt_id`, `question_id`, `selected_answer`, `correct_answer`) VALUES
(1, 1, 1, 'option1', 'option1'),
(2, 2, 1, 'option2', 'option1'),
(3, 3, 1, 'option2', 'option1'),
(4, 4, 1, 'option1', 'option1'),
(5, 5, 2, 'option2', 'option1'),
(6, 5, 3, 'option3', 'option1'),
(7, 5, 4, 'option3', 'option3'),
(8, 5, 5, 'option3', 'option2'),
(9, 5, 6, 'option2', 'option2'),
(10, 5, 7, 'option2', 'option2'),
(11, 5, 8, 'option2', 'option2'),
(12, 5, 9, 'option3', 'option3'),
(13, 5, 10, 'option1', 'option3'),
(14, 5, 11, 'option2', 'option2'),
(15, 5, 12, 'option2', 'option2'),
(16, 5, 13, 'option2', 'option2'),
(17, 5, 14, 'option2', 'option2'),
(18, 5, 15, 'option1', 'option1'),
(19, 5, 16, 'option2', 'option2'),
(20, 5, 17, 'option1', 'option2'),
(21, 5, 18, 'option1', 'option2'),
(22, 5, 19, 'option2', 'option2'),
(23, 5, 20, 'option2', 'option2'),
(24, 5, 21, 'option3', 'option1'),
(25, 5, 22, 'option2', 'option2'),
(26, 5, 23, 'option2', 'option2'),
(27, 6, 13, 'option2', 'option2'),
(28, 6, 14, 'option2', 'option2'),
(29, 6, 16, 'option4', 'option2'),
(30, 6, 17, 'option1', 'option2'),
(31, 6, 18, 'option4', 'option2'),
(32, 6, 19, 'option2', 'option2'),
(33, 6, 20, 'option1', 'option2'),
(34, 6, 21, 'option2', 'option1'),
(35, 6, 22, 'option2', 'option2'),
(36, 6, 23, 'option2', 'option2'),
(37, 6, 24, 'option4', 'option3'),
(38, 6, 25, 'option2', 'option1'),
(39, 6, 26, 'option4', 'option1'),
(40, 6, 27, 'option3', 'option3'),
(41, 6, 28, 'option1', 'option2'),
(42, 6, 29, 'option2', 'option2'),
(43, 6, 30, 'option2', 'option2'),
(44, 6, 31, 'option3', 'option2'),
(45, 6, 32, 'option2', 'option3'),
(46, 6, 33, 'option3', 'option2'),
(47, 6, 34, 'option4', 'option2'),
(48, 6, 35, 'option1', 'option2'),
(49, 6, 36, 'option1', 'option2'),
(50, 6, 37, 'option2', 'option3'),
(51, 6, 38, 'option2', 'option4'),
(52, 6, 39, 'option3', 'option3'),
(53, 6, 40, 'option4', 'option2'),
(54, 6, 41, 'option3', 'option3'),
(55, 6, 42, 'option2', 'option2'),
(56, 6, 43, 'option2', 'option3'),
(57, 6, 44, 'option2', 'option2'),
(58, 6, 45, 'option1', 'option3'),
(59, 6, 46, 'option2', 'option4'),
(60, 6, 47, 'option2', 'option2'),
(61, 6, 48, 'option4', 'option2'),
(62, 6, 49, 'option2', 'option2'),
(63, 6, 50, 'option2', 'option2'),
(64, 6, 51, 'option2', 'option3'),
(65, 6, 52, 'option2', 'option3'),
(66, 6, 53, 'option1', 'option3'),
(67, 6, 54, 'option3', 'option2'),
(68, 6, 55, 'option2', 'option2'),
(69, 6, 56, 'option3', 'option2'),
(70, 6, 57, 'option2', 'option3'),
(71, 6, 58, 'option2', 'option2'),
(72, 6, 59, 'option1', 'option3'),
(73, 6, 60, 'option1', 'option2'),
(74, 6, 61, 'option1', 'option3'),
(75, 6, 62, 'option1', 'option3'),
(76, 6, 63, 'option2', 'option3'),
(77, 6, 64, 'option3', 'option3'),
(78, 6, 65, 'option4', 'option3'),
(79, 6, 66, 'option4', 'option3'),
(80, 6, 67, 'option4', 'option2'),
(81, 6, 68, 'option4', 'option3'),
(82, 6, 69, 'option3', 'option3'),
(83, 6, 70, 'option3', 'option2'),
(84, 6, 71, 'option2', 'option2'),
(85, 6, 72, 'option2', 'option3'),
(86, 6, 73, 'option1', 'option4'),
(87, 7, 64, 'option2', 'option3'),
(88, 7, 71, 'option2', 'option2'),
(89, 7, 26, 'option4', 'option1'),
(90, 7, 25, 'option1', 'option1'),
(91, 7, 35, 'option2', 'option2'),
(92, 7, 30, 'option2', 'option2'),
(93, 7, 65, 'option2', 'option3'),
(94, 7, 24, 'option1', 'option3'),
(95, 7, 50, 'option3', 'option2'),
(96, 7, 33, 'option2', 'option2'),
(97, 7, 62, 'option2', 'option3'),
(98, 7, 60, 'option4', 'option2'),
(99, 7, 38, 'option2', 'option4'),
(100, 7, 37, 'option4', 'option3'),
(101, 7, 53, 'option4', 'option3'),
(102, 7, 66, 'option4', 'option3'),
(103, 7, 31, 'option1', 'option2'),
(104, 7, 73, 'option3', 'option4'),
(105, 7, 39, 'option1', 'option3'),
(106, 7, 72, 'option3', 'option3'),
(107, 8, 104, 'option3', 'option3'),
(108, 8, 117, 'option4', 'option2'),
(109, 8, 79, 'option4', 'option4'),
(110, 8, 113, 'option4', 'option4'),
(111, 8, 82, 'option3', 'option3'),
(112, 8, 86, 'option1', 'option2'),
(113, 8, 85, 'option3', 'option2'),
(114, 8, 111, 'option4', 'option2'),
(115, 8, 107, 'option3', 'option2'),
(116, 8, 87, 'option3', 'option1'),
(117, 8, 116, 'option1', 'option4'),
(118, 8, 92, 'option2', 'option3'),
(119, 8, 120, 'option1', 'option3'),
(120, 8, 100, 'option1', 'option2'),
(121, 8, 110, 'option1', 'option3'),
(122, 8, 99, 'option1', 'option4'),
(123, 8, 101, 'option1', 'option1'),
(124, 8, 90, 'option1', 'option2'),
(125, 8, 115, 'option1', 'option2'),
(126, 8, 77, 'option1', 'option3'),
(127, 9, 178, 'option2', 'option2'),
(128, 9, 193, 'option3', 'option3'),
(129, 9, 172, 'option3', 'option3'),
(130, 9, 175, 'option1', 'option2'),
(131, 9, 194, 'option3', 'option2'),
(132, 9, 197, 'option3', 'option3'),
(133, 9, 164, 'option3', 'option3'),
(134, 9, 209, 'option3', 'option3'),
(135, 9, 210, 'option3', 'option3'),
(136, 9, 181, 'option1', 'option1'),
(137, 9, 169, 'option2', 'option2'),
(138, 9, 191, 'option4', 'option3'),
(139, 9, 182, 'option4', 'option2'),
(140, 9, 203, 'option4', 'option3'),
(141, 9, 168, 'option1', 'option2'),
(142, 9, 195, 'option1', 'option2'),
(143, 9, 180, 'option4', 'option1'),
(144, 9, 192, 'option2', 'option1'),
(145, 9, 190, 'option2', 'option3'),
(146, 10, 52, 'option1', 'option3'),
(147, 10, 42, 'option1', 'option2'),
(148, 10, 68, 'option3', 'option3'),
(149, 10, 29, 'option3', 'option2'),
(150, 10, 43, 'option2', 'option3'),
(151, 10, 26, 'option2', 'option1'),
(152, 11, 129, 'option4', 'option2'),
(153, 11, 144, 'option4', 'option2'),
(154, 11, 135, 'option2', 'option2'),
(155, 11, 140, 'option4', 'option3'),
(156, 11, 152, 'option4', 'option3'),
(157, 11, 132, 'option1', 'option3'),
(158, 11, 131, 'option4', 'option1'),
(159, 11, 133, 'option2', 'option4'),
(160, 11, 142, 'option4', 'option2'),
(161, 11, 125, 'option1', 'option2'),
(162, 11, 151, 'option2', 'option4'),
(163, 11, 161, 'option3', 'option2'),
(164, 11, 162, 'option2', 'option2'),
(165, 11, 150, 'option1', 'option2'),
(166, 11, 148, 'option4', 'option2'),
(167, 11, 145, 'option1', 'option3'),
(168, 11, 128, 'option1', 'option3'),
(169, 11, 124, 'option2', 'option1'),
(170, 11, 149, 'option3', 'option2'),
(171, 11, 134, 'option1', 'option2'),
(172, 12, 142, 'option3', 'option2'),
(173, 12, 146, 'option2', 'option2'),
(174, 12, 125, 'option2', 'option2'),
(175, 12, 154, 'option2', 'option3'),
(176, 12, 126, 'option1', 'option3'),
(177, 12, 157, 'option3', 'option3'),
(178, 12, 143, 'option3', 'option2'),
(179, 12, 148, 'option2', 'option2'),
(180, 12, 137, 'option3', 'option3'),
(181, 12, 162, 'option4', 'option2'),
(182, 12, 156, 'option2', 'option2'),
(183, 12, 134, 'option3', 'option2'),
(184, 12, 139, 'option2', 'option1'),
(185, 12, 161, 'option4', 'option2'),
(186, 12, 138, 'option2', 'option2'),
(187, 12, 130, 'option1', 'option3'),
(188, 12, 151, 'option4', 'option4'),
(189, 12, 133, 'option4', 'option4'),
(190, 12, 131, 'option1', 'option1'),
(191, 12, 124, 'unanswered', 'option1'),
(192, 13, 34, 'option3', 'option2'),
(193, 13, 56, 'unanswered', 'option2'),
(194, 13, 26, 'unanswered', 'option1'),
(195, 13, 73, 'unanswered', 'option4'),
(196, 13, 46, 'unanswered', 'option4'),
(197, 13, 38, 'unanswered', 'option4'),
(198, 13, 31, 'unanswered', 'option2'),
(199, 13, 21, 'unanswered', 'option1'),
(200, 13, 33, 'unanswered', 'option2'),
(201, 13, 57, 'unanswered', 'option3'),
(202, 13, 43, 'unanswered', 'option3'),
(203, 13, 60, 'unanswered', 'option2'),
(204, 13, 53, 'unanswered', 'option3'),
(205, 13, 36, 'unanswered', 'option2'),
(206, 13, 18, 'unanswered', 'option2'),
(207, 13, 66, 'unanswered', 'option3'),
(208, 13, 27, 'unanswered', 'option3'),
(209, 13, 20, 'unanswered', 'option2'),
(210, 13, 28, 'unanswered', 'option2'),
(211, 13, 50, 'unanswered', 'option2');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`) VALUES
(1, 'General Knowledge', 'General quiz questions', '2026-07-24 17:18:32'),
(2, 'Programming', 'Programming MCQs', '2026-07-24 17:18:53'),
(3, 'Science', 'Science quiz', '2026-07-24 17:19:17'),
(5, 'Sports', 'Sports question', '2026-07-24 17:20:35');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `correct_answer` enum('option1','option2','option3','option4') NOT NULL DEFAULT current_timestamp(),
  `created at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_answer`, `created at`) VALUES
(1, 2, 'PHP stands for?', 'Personal Home Page', 'Private Home Page', 'Programming Hypertext', 'Page Hyper Processor', 'option1', '2026-07-25 07:02:28'),
(13, 1, 'Which bird is the symbol of peace?', 'Eagle', 'Dove', 'Swan', 'Falcon', 'option2', '2026-08-02 07:51:01'),
(14, 1, 'Which ocean is the smallest?', 'Atlantic', 'Arctic', 'Indian', ' Southern', 'option2', '2026-08-02 07:51:08'),
(16, 1, 'Which city is known as the City of Canals?', ' Amsterdam', 'Venice', 'Copenhagen', ' Bruges', 'option2', '2026-08-02 08:28:12'),
(18, 1, 'Which organ uses the most oxygen in the human body?', ' Heart', 'Brain', 'Liver', ' Lungs', 'option2', '2026-08-02 08:29:59'),
(19, 1, 'Which country invented paper?', ' India', ' China', 'Egypt', ' Greece', 'option2', '2026-08-02 08:30:41'),
(20, 1, 'Which is the fastest land animal?', 'Lion', 'Cheetah', ' Leopard', 'Tiger', 'option2', '2026-08-02 08:31:20'),
(21, 1, 'Which planet rotates on its side?', 'Uranus', 'Saturn', 'Neptune', ' Mars', 'option1', '2026-08-02 08:32:00'),
(22, 1, ' What is the capital of New Zealand?', 'Auckland', 'Wellington', 'Christchurch', ' Hamilton', 'option2', '2026-08-02 08:32:56'),
(23, 1, 'Which country has the most islands in the world?', ' Indonesia', 'Sweden', ' Philippines', 'Japan', 'option2', '2026-08-02 08:33:37'),
(24, 1, 'Which country has the highest number of pyramids?', 'Egypt', 'Mexico', 'Sudan', 'Peru', 'option3', '2026-08-06 17:02:55'),
(25, 1, 'Which is the only letter that does not appear in the periodic table?', 'J', 'Q', 'X', 'Z', 'option1', '2026-08-06 17:02:55'),
(26, 1, 'Which country has the most active volcanoes?', 'Indonesia', 'Japan', 'Chile', 'Iceland', 'option1', '2026-08-06 17:02:55'),
(27, 1, 'Which country has the most time zones?', 'Russia', 'USA', 'France', 'Australia', 'option3', '2026-08-06 17:02:55'),
(28, 1, 'Which is the only mammal capable of true flight?', 'Flying squirrel', 'Bat', 'Penguin', 'Ostrich', 'option2', '2026-08-06 17:02:55'),
(29, 1, 'Which country is known as the Land of a Thousand Lakes?', 'Norway', 'Finland', 'Sweden', 'Canada', 'option2', '2026-08-06 17:02:55'),
(30, 1, 'What is the hardest natural substance on Earth?', 'Quartz', 'Diamond', 'Gold', 'Iron', 'option2', '2026-08-06 17:02:55'),
(31, 1, 'Which is the largest island in the world?', 'Australia', 'Greenland', 'Madagascar', 'Borneo', 'option2', '2026-08-06 17:02:55'),
(32, 1, 'How many hearts does an octopus have?', '1', '2', '3', '4', 'option3', '2026-08-06 17:02:55'),
(33, 1, 'Which metal is liquid at room temperature?', 'Silver', 'Mercury', 'Aluminium', 'Copper', 'option2', '2026-08-06 17:02:55'),
(34, 1, 'Which planet is known as the Red Planet?', 'Venus', 'Mars', 'Jupiter', 'Mercury', 'option2', '2026-08-06 17:02:55'),
(35, 1, 'Which is the longest river in the world?', 'Amazon', 'Nile', 'Yangtze', 'Mississippi', 'option2', '2026-08-06 17:02:55'),
(36, 1, 'Which country gifted the Statue of Liberty to the United States?', 'Germany', 'France', 'Italy', 'Spain', 'option2', '2026-08-06 17:02:55'),
(37, 1, 'What is the capital city of Australia?', 'Sydney', 'Melbourne', 'Canberra', 'Perth', 'option3', '2026-08-06 17:02:55'),
(38, 1, 'Which ocean is the largest?', 'Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean', 'option4', '2026-08-06 17:02:55'),
(39, 1, 'Which gas do plants absorb from the atmosphere?', 'Oxygen', 'Nitrogen', 'Carbon Dioxide', 'Hydrogen', 'option3', '2026-08-06 17:02:55'),
(40, 1, 'Which is the smallest continent by land area?', 'Europe', 'Australia', 'Antarctica', 'South America', 'option2', '2026-08-06 17:02:55'),
(42, 1, 'Which instrument is used to measure atmospheric pressure?', 'Thermometer', 'Barometer', 'Hygrometer', 'Anemometer', 'option2', '2026-08-06 17:02:55'),
(43, 1, 'Which is the tallest mountain in the world above sea level?', 'K2', 'Kangchenjunga', 'Mount Everest', 'Makalu', 'option3', '2026-08-06 17:02:55'),
(44, 1, 'Which country is home to the Great Barrier Reef?', 'New Zealand', 'Australia', 'Indonesia', 'Philippines', 'option2', '2026-08-06 17:02:55'),
(45, 1, 'Who invented the telephone?', 'Thomas Edison', 'Nikola Tesla', 'Alexander Graham Bell', 'Guglielmo Marconi', 'option3', '2026-08-06 17:02:55'),
(46, 1, 'Which is the largest desert in the world?', 'Sahara Desert', 'Arabian Desert', 'Gobi Desert', 'Antarctica', 'option4', '2026-08-06 17:02:55'),
(47, 1, 'Which country is known as the Land of the Rising Sun?', 'China', 'Japan', 'Thailand', 'South Korea', 'option2', '2026-08-06 17:02:55'),
(49, 1, 'Which blood group is known as the universal donor?', 'A+', 'O-', 'AB+', 'B-', 'option2', '2026-08-06 17:02:55'),
(50, 1, 'Which is the smallest country in the world?', 'Monaco', 'Vatican City', 'San Marino', 'Liechtenstein', 'option2', '2026-08-06 17:02:55'),
(51, 1, 'In which year did the first human land on the Moon?', '1965', '1967', '1969', '1971', 'option3', '2026-08-06 17:02:55'),
(52, 1, 'Which is the largest planet in our Solar System?', 'Earth', 'Saturn', 'Jupiter', 'Neptune', 'option3', '2026-08-06 17:02:55'),
(53, 1, 'Which language has the highest number of native speakers in the world?', 'English', 'Hindi', 'Mandarin Chinese', 'Spanish', 'option3', '2026-08-06 17:02:55'),
(54, 1, 'Which country hosted the 2022 FIFA World Cup?', 'Russia', 'Qatar', 'Brazil', 'France', 'option2', '2026-08-06 17:02:55'),
(55, 1, 'What is the chemical symbol for Gold?', 'Ag', 'Au', 'Gd', 'Go', 'option2', '2026-08-06 17:02:55'),
(56, 1, 'Which is the largest mammal in the world?', 'African Elephant', 'Blue Whale', 'Giraffe', 'Whale Shark', 'option2', '2026-08-06 17:02:55'),
(57, 1, 'Which continent has the largest population?', 'Africa', 'Europe', 'Asia', 'North America', 'option3', '2026-08-06 17:02:55'),
(58, 1, 'Who wrote the play \"Romeo and Juliet\"?', 'Charles Dickens', 'William Shakespeare', 'Jane Austen', 'Mark Twain', 'option2', '2026-08-06 17:02:55'),
(59, 1, 'Which is the national currency of Japan?', 'Yuan', 'Won', 'Yen', 'Ringgit', 'option3', '2026-08-06 17:02:55'),
(60, 1, 'Which planet is known for its prominent rings?', 'Jupiter', 'Saturn', 'Uranus', 'Neptune', 'option2', '2026-08-06 17:02:55'),
(61, 1, 'Which organ in the human body pumps blood?', 'Brain', 'Lungs', 'Heart', 'Liver', 'option3', '2026-08-06 17:02:55'),
(62, 1, 'Which is the tallest waterfall in the world?', 'Niagara Falls', 'Victoria Falls', 'Angel Falls', 'Iguazu Falls', 'option3', '2026-08-06 17:02:55'),
(63, 1, 'Which Indian city is known as the \"Silicon Valley of India\"?', 'Hyderabad', 'Chennai', 'Bengaluru', 'Pune', 'option3', '2026-08-06 17:02:55'),
(64, 1, 'Which country is famous for the Eiffel Tower?', 'Italy', 'Germany', 'France', 'Spain', 'option3', '2026-08-06 17:02:55'),
(65, 1, 'What is the smallest prime number?', '0', '1', '2', '3', 'option3', '2026-08-06 17:02:55'),
(66, 1, 'Which gas is most abundant in Earth\'s atmosphere?', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Hydrogen', 'option3', '2026-08-06 17:02:55'),
(67, 1, 'Which is the largest bird in the world?', 'Eagle', 'Ostrich', 'Penguin', 'Albatross', 'option2', '2026-08-06 17:02:55'),
(68, 1, 'Who painted the Mona Lisa?', 'Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Michelangelo', 'option3', '2026-08-06 17:02:55'),
(70, 1, 'Which country is known as the Land of the Thunder Dragon?', 'Nepal', 'Bhutan', 'Mongolia', 'Tibet', 'option2', '2026-08-06 17:02:55'),
(71, 1, 'Which device is used to detect earthquakes?', 'Thermometer', 'Seismograph', 'Barometer', 'Hygrometer', 'option2', '2026-08-06 17:02:55'),
(72, 1, 'Which is the tallest building in the world (as of 2026)?', 'Shanghai Tower', 'Merdeka 118', 'Burj Khalifa', 'One World Trade Center', 'option3', '2026-08-06 17:02:55'),
(73, 1, 'Which vitamin is mainly produced by the human body when exposed to sunlight?', 'Vitamin A', 'Vitamin B12', 'Vitamin C', 'Vitamin D', 'option4', '2026-08-06 17:02:55'),
(74, 2, 'What does HTML stand for?', 'Hyper Text Markup Language', 'High Text Machine Language', 'Hyperlink Text Management Language', 'Home Tool Markup Language', 'option1', '2026-08-06 17:02:55'),
(75, 2, 'Which programming language is primarily used with Flask?', 'Java', 'Python', 'C++', 'PHP', 'option2', '2026-08-06 17:02:55'),
(76, 2, 'Which HTML tag is used to create a hyperlink?', '<link>', '<a>', '<href>', '<url>', 'option2', '2026-08-06 17:02:55'),
(77, 2, 'Which CSS property is used to change the text color?', 'font-color', 'text-color', 'color', 'background-color', 'option3', '2026-08-06 17:02:55'),
(78, 2, 'Which symbol is used to define an ID selector in CSS?', '. (dot)', '# (hash)', '* (asterisk)', '@ (at)', 'option2', '2026-08-06 17:02:55'),
(79, 2, 'Which keyword is used to define a function in Python?', 'func', 'define', 'function', 'def', 'option4', '2026-08-06 17:02:55'),
(80, 2, 'Which SQL command is used to retrieve data from a database?', 'GET', 'SELECT', 'FETCH', 'OPEN', 'option2', '2026-08-06 17:02:55'),
(81, 2, 'Which PHP symbol is used before variable names?', '@', '#', '$', '%', 'option3', '2026-08-06 17:02:55'),
(82, 2, 'Which Git command uploads local commits to GitHub?', 'git commit', 'git clone', 'git push', 'git pull', 'option3', '2026-08-06 17:02:55'),
(83, 2, 'Which data structure follows the Last In, First Out (LIFO) principle?', 'Queue', 'Array', 'Stack', 'Linked List', 'option3', '2026-08-06 17:02:55'),
(84, 2, 'Which HTML tag is used to insert an image?', '<picture>', '<img>', '<image>', '<src>', 'option2', '2026-08-06 17:02:55'),
(85, 2, 'Which CSS property controls the space inside an element\'s border?', 'margin', 'padding', 'spacing', 'border-space', 'option2', '2026-08-06 17:02:55'),
(86, 2, 'Which JavaScript keyword declares a block-scoped variable?', 'var', 'let', 'define', 'constvar', 'option2', '2026-08-06 17:02:55'),
(87, 2, 'Which SQL statement is used to add a new record into a table?', 'INSERT INTO', 'ADD ROW', 'NEW RECORD', 'CREATE ROW', 'option1', '2026-08-06 17:02:55'),
(88, 2, 'Which Python data type is enclosed in square brackets [ ]?', 'Tuple', 'Dictionary', 'List', 'Set', 'option3', '2026-08-06 17:02:55'),
(89, 2, 'Which HTML tag creates an unordered list?', '<ol>', '<ul>', '<li>', '<list>', 'option2', '2026-08-06 17:02:55'),
(90, 2, 'Which Git command downloads a repository from GitHub for the first time?', 'git pull', 'git clone', 'git fetch', 'git init', 'option2', '2026-08-06 17:02:55'),
(91, 2, 'Which SQL clause is used to filter records?', 'ORDER BY', 'GROUP BY', 'WHERE', 'FILTER', 'option3', '2026-08-06 17:02:55'),
(92, 2, 'Which Python function is used to display output on the screen?', 'echo()', 'display()', 'print()', 'output()', 'option3', '2026-08-06 17:02:55'),
(93, 2, 'Which CSS property makes text bold?', 'font-style', 'font-weight', 'text-decoration', 'text-weight', 'option2', '2026-08-06 17:02:55'),
(94, 2, 'Which HTML tag is used to create a table row?', '<td>', '<tr>', '<th>', '<table>', 'option2', '2026-08-06 17:02:55'),
(95, 2, 'Which CSS property is used to change the background color of an element?', 'color', 'background', 'background-color', 'bg-color', 'option3', '2026-08-06 17:02:55'),
(96, 2, 'Which JavaScript function displays a popup message?', 'prompt()', 'alert()', 'message()', 'popup()', 'option2', '2026-08-06 17:02:55'),
(97, 2, 'Which SQL command is used to remove a table from a database?', 'REMOVE TABLE', 'DELETE TABLE', 'DROP TABLE', 'ERASE TABLE', 'option3', '2026-08-06 17:02:55'),
(98, 2, 'Which Python keyword is used to create a loop that repeats while a condition is true?', 'repeat', 'loop', 'while', 'for', 'option3', '2026-08-06 17:02:55'),
(99, 2, 'Which HTML tag is used for the largest heading?', '<h6>', '<head>', '<heading>', '<h1>', 'option4', '2026-08-06 17:02:55'),
(100, 2, 'Which Git command shows the current status of the repository?', 'git info', 'git status', 'git check', 'git log', 'option2', '2026-08-06 17:02:55'),
(101, 2, 'Which SQL command is used to modify existing records?', 'UPDATE', 'MODIFY', 'ALTER', 'CHANGE', 'option1', '2026-08-06 17:02:55'),
(102, 2, 'Which PHP function is commonly used to connect to a MySQL database using MySQLi?', 'mysqli_connect()', 'mysql_open()', 'connect_db()', 'db_connect()', 'option1', '2026-08-06 17:02:55'),
(103, 2, 'Which symbol is used to write a single-line comment in Python?', '//', '', '#', '/* */', 'option3', '2026-08-06 17:02:55'),
(104, 2, 'Which HTML tag is used to create a line break?', '<break>', '<lb>', '<br>', '<newline>', 'option3', '2026-08-06 17:02:55'),
(105, 2, 'Which CSS property is used to round the corners of an element?', 'corner-radius', 'border-round', 'border-radius', 'radius', 'option3', '2026-08-06 17:02:55'),
(106, 2, 'Which JavaScript operator is used for strict equality comparison?', '==', '=', '===', '!=', 'option3', '2026-08-06 17:02:55'),
(107, 2, 'Which SQL clause is used to sort query results?', 'GROUP BY', 'ORDER BY', 'SORT BY', 'ARRANGE BY', 'option2', '2026-08-06 17:02:55'),
(108, 2, 'Which Python keyword is used to define a class?', 'object', 'class', 'define', 'new', 'option2', '2026-08-06 17:02:55'),
(109, 2, 'Which HTML attribute specifies the destination URL of a hyperlink?', 'src', 'link', 'href', 'target', 'option3', '2026-08-06 17:02:55'),
(110, 2, 'Which Git command creates a new local repository?', 'git start', 'git clone', 'git init', 'git create', 'option3', '2026-08-06 17:02:55'),
(111, 2, 'Which SQL command is used to permanently remove records from a table?', 'REMOVE', 'DELETE', 'DROP', 'CLEAR', 'option2', '2026-08-06 17:02:55'),
(112, 2, 'Which PHP function is used to start a session?', 'start_session()', 'session_begin()', 'session_start()', 'begin_session()', 'option3', '2026-08-06 17:02:55'),
(113, 2, 'Which Python function returns the number of items in a list?', 'size()', 'length()', 'count()', 'len()', 'option4', '2026-08-06 17:02:55'),
(114, 2, 'Which HTML tag is used to create a numbered list?', '<ul>', '<ol>', '<li>', '<list>', 'option2', '2026-08-06 17:02:55'),
(115, 2, 'Which CSS property is used to align text horizontally?', 'font-align', 'text-align', 'align', 'horizontal-align', 'option2', '2026-08-06 17:02:55'),
(116, 2, 'Which JavaScript keyword is used to declare a constant variable?', 'var', 'let', 'constant', 'const', 'option4', '2026-08-06 17:02:55'),
(117, 2, 'Which SQL function returns the total number of rows in a table?', 'SUM()', 'COUNT()', 'TOTAL()', 'ROWS()', 'option2', '2026-08-06 17:02:55'),
(118, 2, 'Which Python keyword is used to import a module?', 'include', 'import', 'using', 'require', 'option2', '2026-08-06 17:02:55'),
(119, 2, 'Which HTML tag is used to create a dropdown list?', '<list>', '<input>', '<select>', '<option>', 'option3', '2026-08-06 17:02:55'),
(120, 2, 'Which Git command is used to view the commit history?', 'git history', 'git commits', 'git log', 'git show', 'option3', '2026-08-06 17:02:55'),
(121, 2, 'Which SQL command is used to create a new table?', 'NEW TABLE', 'CREATE TABLE', 'ADD TABLE', 'MAKE TABLE', 'option2', '2026-08-06 17:02:55'),
(122, 2, 'Which PHP function is used to execute a MySQL query using MySQLi?', 'mysqli_query()', 'mysqli_execute()', 'query_mysql()', 'mysql_query()', 'option1', '2026-08-06 17:02:55'),
(123, 2, 'Which Python statement is used to stop a loop immediately?', 'exit', 'stop', 'break', 'continue', 'option3', '2026-08-06 17:02:55'),
(124, 3, 'What is the chemical symbol for Oxygen?', 'O', 'Ox', 'Og', 'On', 'option1', '2026-08-06 17:02:55'),
(125, 3, 'Which planet is known as the Blue Planet?', 'Venus', 'Earth', 'Neptune', 'Uranus', 'option2', '2026-08-06 17:02:55'),
(126, 3, 'What is the largest organ in the human body?', 'Liver', 'Brain', 'Skin', 'Heart', 'option3', '2026-08-06 17:02:55'),
(127, 3, 'Which gas is essential for human respiration?', 'Nitrogen', 'Carbon Dioxide', 'Oxygen', 'Hydrogen', 'option3', '2026-08-06 17:02:55'),
(128, 3, 'Water boils at what temperature at sea level?', '90?C', '95?C', '100?C', '110?C', 'option3', '2026-08-06 17:02:55'),
(129, 3, 'Which blood cells help fight infections?', 'Red blood cells', 'White blood cells', 'Platelets', 'Plasma', 'option2', '2026-08-06 17:02:55'),
(130, 3, 'What is the nearest star to Earth?', 'Sirius', 'Alpha Centauri', 'The Sun', 'Polaris', 'option3', '2026-08-06 17:02:55'),
(131, 3, 'Which vitamin is important for healthy eyesight?', 'Vitamin A', 'Vitamin B12', 'Vitamin C', 'Vitamin D', 'option1', '2026-08-06 17:02:55'),
(132, 3, 'What force keeps planets revolving around the Sun?', 'Magnetism', 'Friction', 'Gravity', 'Electricity', 'option3', '2026-08-06 17:02:55'),
(133, 3, 'Which part of the plant performs photosynthesis?', 'Root', 'Stem', 'Flower', 'Leaf', 'option4', '2026-08-06 17:02:55'),
(134, 3, 'What is the chemical formula of water?', 'CO?', 'H?O', 'O?', 'NaCl', 'option2', '2026-08-06 17:02:55'),
(135, 3, 'Which blood vessel carries oxygenated blood from the heart to the body?', 'Vein', 'Artery', 'Capillary', 'Venule', 'option2', '2026-08-06 17:02:55'),
(136, 3, 'Which planet is known for its prominent rings?', 'Mars', 'Jupiter', 'Saturn', 'Uranus', 'option3', '2026-08-06 17:02:55'),
(137, 3, 'Which gas is the most abundant in Earth\'s atmosphere?', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Hydrogen', 'option3', '2026-08-06 17:02:55'),
(138, 3, 'Which organ filters blood and produces urine?', 'Liver', 'Kidneys', 'Lungs', 'Pancreas', 'option2', '2026-08-06 17:02:55'),
(139, 3, 'Which scientist discovered penicillin?', 'Alexander Fleming', 'Louis Pasteur', 'Marie Curie', 'Gregor Mendel', 'option1', '2026-08-06 17:02:55'),
(140, 3, 'Which is the hardest natural substance?', 'Quartz', 'Iron', 'Diamond', 'Granite', 'option3', '2026-08-06 17:02:55'),
(141, 3, 'Which type of energy is stored in food?', 'Kinetic Energy', 'Chemical Energy', 'Nuclear Energy', 'Sound Energy', 'option2', '2026-08-06 17:02:55'),
(142, 3, 'Which part of the eye controls the amount of light entering the eye?', 'Retina', 'Iris', 'Cornea', 'Optic Nerve', 'option2', '2026-08-06 17:02:55'),
(143, 3, 'Which planet is closest to the Sun?', 'Venus', 'Mercury', 'Earth', 'Mars', 'option2', '2026-08-06 17:02:55'),
(144, 3, 'Which instrument is used to measure temperature?', 'Barometer', 'Thermometer', 'Hygrometer', 'Ammeter', 'option2', '2026-08-06 17:02:55'),
(145, 3, 'What is the SI unit of electric current?', 'Volt', 'Watt', 'Ampere', 'Ohm', 'option3', '2026-08-06 17:02:55'),
(146, 3, 'Which planet is known as the Morning Star?', 'Mars', 'Venus', 'Mercury', 'Jupiter', 'option2', '2026-08-06 17:02:55'),
(147, 3, 'Which part of the human body contains the smallest bones?', 'Hand', 'Foot', 'Ear', 'Nose', 'option3', '2026-08-06 17:02:55'),
(148, 3, 'Which gas is used by plants to prepare food during photosynthesis?', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Helium', 'option2', '2026-08-06 17:02:55'),
(149, 3, 'Which scientist developed the theory of relativity?', 'Isaac Newton', 'Albert Einstein', 'Stephen Hawking', 'Niels Bohr', 'option2', '2026-08-06 17:02:55'),
(150, 3, 'Which organ in the human body produces insulin?', 'Liver', 'Pancreas', 'Kidney', 'Stomach', 'option2', '2026-08-06 17:02:55'),
(151, 3, 'Which vitamin helps in blood clotting?', 'Vitamin A', 'Vitamin C', 'Vitamin D', 'Vitamin K', 'option4', '2026-08-06 17:02:55'),
(152, 3, 'Which metal is the best conductor of electricity?', 'Copper', 'Aluminium', 'Silver', 'Iron', 'option3', '2026-08-06 17:02:55'),
(153, 3, 'Which branch of science deals with the study of living organisms?', 'Physics', 'Chemistry', 'Biology', 'Geology', 'option3', '2026-08-06 17:02:55'),
(154, 3, 'Which gas protects Earth from harmful ultraviolet (UV) rays?', 'Oxygen', 'Nitrogen', 'Ozone', 'Carbon Dioxide', 'option3', '2026-08-06 17:02:55'),
(155, 3, 'What is the pH value of pure water at room temperature?', '5', '6', '7', '8', 'option3', '2026-08-06 17:02:55'),
(156, 3, 'Which planet has the greatest number of known moons (as of 2026)?', 'Jupiter', 'Saturn', 'Uranus', 'Neptune', 'option2', '2026-08-06 17:02:55'),
(157, 3, 'Which blood group is known as the universal recipient?', 'O?', 'A+', 'AB+', 'B+', 'option3', '2026-08-06 17:02:55'),
(158, 3, 'Which vitamin is essential for healthy blood clotting?', 'Vitamin A', 'Vitamin C', 'Vitamin D', 'Vitamin K', 'option4', '2026-08-06 17:02:55'),
(159, 3, 'What is the speed of light in a vacuum?', '300,000 km/s', '150,000 km/s', '3,000 km/s', '30,000 km/s', 'option1', '2026-08-06 17:02:55'),
(160, 3, 'Which instrument is used to measure atmospheric pressure?', 'Thermometer', 'Hygrometer', 'Barometer', 'Anemometer', 'option3', '2026-08-06 17:02:55'),
(161, 3, 'Which planet is often called Earth\'s \"twin\" because of its similar size?', 'Mars', 'Venus', 'Mercury', 'Neptune', 'option2', '2026-08-06 17:02:55'),
(162, 3, 'Which process converts a liquid into a gas at its surface?', 'Condensation', 'Evaporation', 'Freezing', 'Sublimation', 'option2', '2026-08-06 17:02:55'),
(163, 3, 'Which branch of science studies earthquakes?', 'Meteorology', 'Seismology', 'Oceanography', 'Ecology', 'option2', '2026-08-06 17:02:55'),
(164, 5, 'How many players are on the field for one football (soccer) team during a match?', '9', '10', '11', '12', 'option3', '2026-08-06 17:02:55'),
(165, 5, 'Which country won the ICC Men\'s Cricket World Cup in 2023?', 'India', 'Australia', 'England', 'New Zealand', 'option2', '2026-08-06 17:02:55'),
(166, 5, 'Which sport is known as the \"Gentleman\'s Game\"?', 'Tennis', 'Cricket', 'Golf', 'Rugby', 'option2', '2026-08-06 17:02:55'),
(167, 5, 'In which sport is the term \"Love\" used?', 'Cricket', 'Tennis', 'Football', 'Basketball', 'option2', '2026-08-06 17:02:55'),
(168, 5, 'How many rings are there on the Olympic flag?', '4', '5', '6', '7', 'option2', '2026-08-06 17:02:55'),
(169, 5, 'Which country hosted the 2024 Summer Olympics?', 'Japan', 'France', 'China', 'USA', 'option2', '2026-08-06 17:02:55'),
(170, 5, 'Which sport uses a shuttlecock?', 'Table Tennis', 'Badminton', 'Tennis', 'Squash', 'option2', '2026-08-06 17:02:55'),
(171, 5, 'How many players are there in a basketball team on the court at one time?', '5', '6', '7', '8', 'option1', '2026-08-06 17:02:55'),
(172, 5, 'Which country has won the most FIFA World Cup titles (Men\'s)?', 'Germany', 'Italy', 'Brazil', 'Argentina', 'option3', '2026-08-06 17:02:55'),
(173, 5, 'In Formula 1, what color flag signals the end of the race?', 'Red', 'Green', 'Yellow', 'Chequered', 'option4', '2026-08-06 17:02:55'),
(174, 5, 'Which country won the FIFA Men\'s World Cup in 2022?', 'France', 'Brazil', 'Argentina', 'Germany', 'option3', '2026-08-06 17:02:55'),
(175, 5, 'Which sport is played at Wimbledon?', 'Golf', 'Tennis', 'Cricket', 'Hockey', 'option2', '2026-08-06 17:02:55'),
(176, 5, 'Which country invented the game of basketball?', 'Canada', 'England', 'United States', 'Australia', 'option3', '2026-08-06 17:02:55'),
(177, 5, 'In cricket, how many balls are there in one over in international matches?', '5', '6', '8', '10', 'option2', '2026-08-06 17:02:55'),
(178, 5, 'Which Indian cricketer is known as the \"Master Blaster\"?', 'MS Dhoni', 'Sachin Tendulkar', 'Virat Kohli', 'Rohit Sharma', 'option2', '2026-08-06 17:02:55'),
(179, 5, 'Which country hosts the Tour de France cycling race?', 'Italy', 'Spain', 'France', 'Belgium', 'option3', '2026-08-06 17:02:55'),
(180, 5, 'Which sport uses the terms \"birdie\" and \"eagle\"?', 'Golf', 'Badminton', 'Baseball', 'Tennis', 'option1', '2026-08-06 17:02:55'),
(181, 5, 'How many points is a free throw worth in basketball?', '1', '2', '3', '4', 'option1', '2026-08-06 17:02:55'),
(182, 5, 'Which country has won the most ICC Champions Trophy titles?', 'Australia', 'India', 'England', 'Pakistan', 'option2', '2026-08-06 17:02:55'),
(183, 5, 'Which sport is associated with the Davis Cup?', 'Badminton', 'Cricket', 'Tennis', 'Hockey', 'option3', '2026-08-06 17:02:55'),
(185, 5, 'In which sport is the Ryder Cup contested?', 'Tennis', 'Golf', 'Cricket', 'Rugby', 'option2', '2026-08-06 17:02:55'),
(186, 5, 'Which Indian athlete won the gold medal in javelin throw at the Tokyo 2020 Olympics?', 'Milkha Singh', 'Neeraj Chopra', 'Bajrang Punia', 'PV Sindhu', 'option2', '2026-08-06 17:02:55'),
(187, 5, 'How many players are there in a volleyball team on the court?', '5', '6', '7', '8', 'option2', '2026-08-06 17:02:55'),
(188, 5, 'Which country won the ICC Men\'s T20 World Cup in 2024?', 'India', 'Australia', 'England', 'South Africa', 'option1', '2026-08-06 17:02:55'),
(189, 5, 'Which sport is associated with the Thomas Cup?', 'Hockey', 'Badminton', 'Tennis', 'Table Tennis', 'option2', '2026-08-06 17:02:55'),
(190, 5, 'Which country has won the most Olympic gold medals overall?', 'China', 'Russia', 'United States', 'Germany', 'option3', '2026-08-06 17:02:55'),
(191, 5, 'Which chess player became the youngest undisputed World Chess Champion in 2024?', 'Magnus Carlsen', 'Ding Liren', 'Gukesh Dommaraju', 'Hikaru Nakamura', 'option3', '2026-08-06 17:02:55'),
(192, 5, 'Which sport uses a pommel horse?', 'Gymnastics', 'Wrestling', 'Athletics', 'Boxing', 'option1', '2026-08-06 17:02:55'),
(193, 5, 'In cricket, how many runs are awarded for hitting the ball over the boundary without bouncing?', '4', '5', '6', '8', 'option3', '2026-08-06 17:02:55'),
(194, 5, 'Which country won the UEFA Euro 2024 championship?', 'England', 'Spain', 'France', 'Germany', 'option2', '2026-08-06 17:02:55'),
(195, 5, 'In which sport is the term \"hole in one\" used?', 'Cricket', 'Golf', 'Baseball', 'Tennis', 'option2', '2026-08-06 17:02:55'),
(196, 5, 'Which country won the first ICC Cricket World Cup in 1975?', 'Australia', 'West Indies', 'England', 'India', 'option2', '2026-08-06 17:02:55'),
(197, 5, 'Which sport is known as the \"King of Sports\"?', 'Cricket', 'Basketball', 'Football (Soccer)', 'Tennis', 'option3', '2026-08-06 17:02:55'),
(198, 5, 'Which Indian badminton player won a silver medal at the 2016 Rio Olympics?', 'Saina Nehwal', 'PV Sindhu', 'Ashwini Ponnappa', 'Jwala Gutta', 'option2', '2026-08-06 17:02:55'),
(199, 5, 'How long is a standard marathon race?', '40.195 km', '41.195 km', '42.195 km', '43.195 km', 'option3', '2026-08-06 17:02:55'),
(200, 5, 'Which country hosted the FIFA Women\'s World Cup in 2023?', 'France', 'Australia & New Zealand', 'Canada', 'England', 'option2', '2026-08-06 17:02:55'),
(201, 5, 'In which sport would you perform a slam dunk?', 'Volleyball', 'Basketball', 'Handball', 'Rugby', 'option2', '2026-08-06 17:02:55'),
(202, 5, 'Which country has won the most ICC Men\'s Cricket World Cup titles?', 'India', 'Australia', 'England', 'West Indies', 'option2', '2026-08-06 17:02:55'),
(203, 5, 'Which board game is recognized as a sport by the International Olympic Committee?', 'Ludo', 'Monopoly', 'Chess', 'Scrabble', 'option3', '2026-08-06 17:02:55'),
(204, 5, 'Which country won the ICC Men\'s Cricket World Cup in 2011?', 'Australia', 'India', 'Sri Lanka', 'Pakistan', 'option2', '2026-08-06 17:02:55'),
(205, 5, 'Which sport is played with a puck?', 'Cricket', 'Ice Hockey', 'Baseball', 'Rugby', 'option2', '2026-08-06 17:02:55'),
(206, 5, 'What is the maximum score possible with a single dart in darts?', '50', '60', '100', '180', 'option2', '2026-08-06 17:02:55'),
(207, 5, 'Which country has won the most Olympic medals in hockey (men\'s)?', 'Netherlands', 'Australia', 'India', 'Germany', 'option3', '2026-08-06 17:02:55'),
(208, 5, 'In which sport is the term \"checkmate\" used?', 'Tennis', 'Chess', 'Boxing', 'Cricket', 'option2', '2026-08-06 17:02:55'),
(209, 5, 'How many players are there in a standard kabaddi team on the court?', '5', '6', '7', '8', 'option3', '2026-08-06 17:02:55'),
(210, 5, 'Which country hosted the 2018 FIFA World Cup?', 'Germany', 'Brazil', 'Russia', 'Qatar', 'option3', '2026-08-06 17:02:55'),
(211, 5, 'Which athlete is known as the \"Fastest Man Alive\" after setting the 100 m world record?', 'Yohan Blake', 'Carl Lewis', 'Usain Bolt', 'Justin Gatlin', 'option3', '2026-08-06 17:02:55'),
(212, 5, 'Which Grand Slam tennis tournament is played on clay courts?', 'Wimbledon', 'US Open', 'Australian Open', 'French Open', 'option4', '2026-08-06 17:02:55'),
(213, 5, 'Which country won the inaugural FIFA Women\'s World Cup in 1991?', 'Norway', 'Germany', 'United States', 'Sweden', 'option3', '2026-08-06 17:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `attempt_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `category_id`, `score`, `total_questions`, `attempt_date`) VALUES
(1, 1, 2, 1, 1, '2026-07-25 07:22:09'),
(2, 1, 2, 0, 1, '2026-07-25 09:05:25'),
(3, 1, 2, 0, 1, '2026-07-25 13:23:56'),
(4, 1, 2, 1, 1, '2026-07-30 05:16:32'),
(5, 1, 1, 15, 22, '2026-08-02 08:36:40'),
(6, 1, 1, 20, 60, '2026-08-07 06:15:12'),
(7, 1, 1, 6, 20, '2026-08-10 16:27:05'),
(8, 1, 2, 5, 20, '2026-08-10 16:29:26'),
(9, 1, 5, 9, 20, '2026-08-11 15:07:15'),
(10, 1, 1, 1, 20, '2026-08-11 16:02:51'),
(11, 1, 3, 2, 20, '2026-08-11 16:11:51'),
(12, 1, 3, 10, 20, '2026-08-11 16:57:31'),
(13, 1, 1, 0, 20, '2026-08-12 16:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('participant','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Ashna Saleem', 'ashnasaleem25@gmail.com', '$2y$10$e4kRGmUp6bJMDhOOiCgrseAKVXMl3zhWMG1yXj.CtplZUEXXQ0svW', 'participant', '2026-07-24 17:00:51'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$PoJ5SFDLVQIeOJnBgyZAAe3g8WafUIiW3REkoA61.xyFxo0sH3uuC', 'admin', '2026-07-24 17:07:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
