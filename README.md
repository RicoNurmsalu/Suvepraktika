# Klassijuhataja päevik

![alt text](https://github.com/RicoNurmsalu/Suvepraktika/blob/main/Pics/Login.PNG)






# Eesmärk
Tehtud veebiprogramm on tehtud õppenõustaja töö lihtsustamiseks. Rakendus lahendab õppenõustaja senimaani keerukat tööd meilide saatmisel ning õpilaste kuvamisel. Lisaks aitab rakendus saada parema ülevaate õpilaste olukorrast läbi siltide. Rakenduse põhifunktsionaalsus ongi koondatud tudengite sildistamise ümber.

# Viide instituudile
Rakendus on tehtud digitehnoloogiate instituudis 1. aasta informaatika tudengite poolt tarkvaraarenduse projekti raames.

# Kasutatud tehnoloogiad
HTML 5.0
PHP 8.0.7
Hack 
Javascript ES2021
CSS 2.1

# Paigaldusjuhised
* Lae alla kõik failid repositooriumist (peale Litsents.txt, ReadME.md ja Pics kaust).
* Pane serverisse public_html-i.
* Loo MySQL andmebaas alloleva skripti abil.

# Andmebaasi tabelite skriptid
`-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2021 at 04:16 AM
-- Server version: 10.2.25-MariaDB
-- PHP Version: 7.4.20

CREATE DATABASE IF NOT EXISTS `if20_pille_suvepraktika` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `if20_pille_suvepraktika`;

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `student_student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `uliopilaskood` int(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `personal_email` varchar(30) NOT NULL,
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `student_tag`
--

CREATE TABLE `student_tag` (
  `student_tag_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `tag_color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;`


# Projekti loojad

Pille Allvee, Anna-Stiina Laidna, Kaarel Eelmäe ja Rico Angel Nurmsalu.

# Litsents
[Litsents.txt](https://github.com/RicoNurmsalu/Suvepraktika/files/6671933/Litsents.txt)
