-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2016 at 09:36 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iit`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `sl_no` int(10) UNSIGNED NOT NULL,
  `assigned_by` varchar(50) NOT NULL,
  `assigned_to` varchar(50) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `assignment_type` int(11) NOT NULL,
  `assignment_date` date NOT NULL,
  `last_edited` date NOT NULL,
  `current_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`sl_no`, `assigned_by`, `assigned_to`, `assignment_id`, `assignment_type`, `assignment_date`, `last_edited`, `current_status`) VALUES
(75, 'HeadA', 'SubHeadA', 57, 0, '0000-00-00', '0000-00-00', 1),
(76, 'HeadA', 'SubHeadB', 57, 0, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_title` text NOT NULL,
  `task_description` text NOT NULL,
  `task_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_title`, `task_description`, `task_type`) VALUES
(57, 'Task 1', 'A=>[A,B]', 'group');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_type` int(3) NOT NULL,
  `user_state` int(3) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_type`, `user_state`, `task_id`) VALUES
(1, 'HeadA', 'heada@mail.com', 'passheada', 1, 0, 0),
(2, 'HeadB', 'headb@mail.com', 'passheadb', 1, 0, 0),
(3, 'HeadC', 'headc@mail.com', 'passheadc', 1, 0, 0),
(4, 'HeadD', 'headd@mail.com', 'passheadd', 1, 0, 0),
(5, 'SubHeadA', 'subheada@mail.com', 'subheada', 2, -1, 57),
(6, 'SubHeadB', 'subheadb@mail.com', 'subheadb', 2, -1, 57),
(7, 'SubHeadC', 'subheadc@mail.com', 'subheadc', 2, 1, 0),
(8, 'SubHeadD', 'subheadd@mail.com', 'subheadd', 2, 1, 0),
(9, 'SubHeadE', 'subheade@mail.com', 'subheade', 2, 1, 0),
(10, 'SubHeadF', 'subheadf@mail.com', 'subheadf', 2, 1, 0),
(11, 'SubHeadG', 'subheadg@mail.com', 'subheadg', 2, 1, 0),
(12, 'SubHeadH', 'subheadh@mail.com', 'subheadh', 2, 1, 0),
(13, 'SubHeadI', 'subheadi@mail.com', 'subheadi', 2, 1, 0),
(14, 'SubHeadJ', 'subheadj@mail.com', 'subheadj', 2, 1, 0),
(15, 'SubHeadK', 'subheadk@mail.com', 'subheadk', 2, 1, 0),
(16, 'SubHeadL', 'subheadl@mail.com', 'subheadl', 2, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `sl_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
