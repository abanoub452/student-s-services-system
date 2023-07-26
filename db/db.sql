-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptedstudentdata`
--

CREATE TABLE `acceptedstudentdata` (
  `StudentCode` int(11) NOT NULL DEFAULT 161746,
  `ArbName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `StudentID` varchar(15) DEFAULT NULL,
  `image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `acceptedstudentdata`
--

INSERT INTO `acceptedstudentdata` (`StudentCode`, `ArbName`, `StudentID`, `image`) VALUES
(1920001, 'احمد', NULL, NULL),
(1920002, 'جورج وجدى', NULL, NULL),
(1920004, 'ابانوب ناصر ابراهيم', NULL, NULL),
(1920403, 'مينا وجدى سمير ', NULL, NULL),
(1920499, 'بيشوى فايز رشدى ', NULL, NULL),
(2021004, 'جورج', NULL, NULL),
(2122403, 'مريم', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_data`
--

CREATE TABLE `application_data` (
  `app_id` tinyint(4) NOT NULL,
  `app_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Uni_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Faculty_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Program_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Faculty-Uni_logo` varchar(50) DEFAULT NULL,
  `Program_logo` varchar(50) DEFAULT NULL,
  `Faculty_Dean` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Post_grad_vice_dean` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_affairs_vice_dean` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Program_coordinator` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `application_data`
--

INSERT INTO `application_data` (`app_id`, `app_name`, `Uni_name`, `Faculty_name`, `Program_name`, `Faculty-Uni_logo`, `Program_logo`, `Faculty_Dean`, `Post_grad_vice_dean`, `st_affairs_vice_dean`, `Program_coordinator`) VALUES
(1, 'النظام الإلكتروني لإدارة شئون أعضاء هيئة التدريس', 'جامعة حلوان', 'كلية التجارة وإدارة الأعمال', 'BIS برنامج نظم معلومات الأعمال', 'Facultylogo.jpg', 'program.png', 'أ.د. حسام الرفاعي', 'أ.د. هند عودة', 'أ.د. أماني فاخر', 'أ.م.د. رشا فرغلى');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseCode` varchar(6) NOT NULL,
  `CourseName` varchar(50) NOT NULL,
  `CourseArbName` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PreRequiset` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `StudentCode` int(11) NOT NULL,
  `CourseCode` varchar(6) NOT NULL DEFAULT '',
  `Semester` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Grade` varchar(4) DEFAULT NULL,
  `GroupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `Department_id` tinyint(4) NOT NULL,
  `Department_ar_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Department_eng_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Department_id`, `Department_ar_name`, `Department_eng_name`) VALUES
(1, 'قسم المحاسبة', 'Accounting Department'),
(2, 'قسم إدارة الأعمال', 'Management Department'),
(3, 'قسم الاقتصاد والتجارة الخارجية', 'Economics & Foreign Trade Depa'),
(4, 'قسم الإحصاء', 'Statistical Department'),
(5, 'قسم العلوم السياسية', 'Political Science Department'),
(6, 'قسم نظم المعلومات', 'Information Systems Department'),
(7, 'شعبه عامه', 'General Major');

-- --------------------------------------------------------

--
-- Table structure for table `doctorscourse`
--

CREATE TABLE `doctorscourse` (
  `id` int(11) NOT NULL,
  `DoctorCode` int(4) NOT NULL,
  `CourseCode` varchar(6) NOT NULL,
  `SemesterCode` int(11) NOT NULL,
  `semesterYear` int(11) NOT NULL,
  `group` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors_account`
--

CREATE TABLE `doctors_account` (
  `DoctorCode` int(11) NOT NULL,
  `Doctor_ar_Name` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Doctor_eng_Name` varchar(50) NOT NULL,
  `National_id` varchar(14) DEFAULT NULL,
  `Mobile` varchar(10) DEFAULT NULL,
  `Academic_Mail` varchar(80) DEFAULT NULL,
  `Personal_Mail` varchar(80) DEFAULT NULL,
  `DoctorJob` tinyint(4) NOT NULL COMMENT 'ref to doctor job table',
  `University` tinyint(4) NOT NULL COMMENT 'ref to universities table',
  `Faculty` tinyint(4) NOT NULL COMMENT 'ref to faculties table',
  `Department` tinyint(4) NOT NULL COMMENT 'ref to departments table',
  `Type` tinyint(4) DEFAULT NULL COMMENT 'ref to doctor type table',
  `UserName` varchar(20) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Doctor_image` varchar(50) DEFAULT NULL,
  `is_enable` varchar(3) NOT NULL DEFAULT 'Yes' COMMENT 'yes or no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_jobs`
--

CREATE TABLE `doctor_jobs` (
  `Doctor_job_id` tinyint(4) NOT NULL,
  `Doctor_job_ar_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Doctor_job_eng_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor_jobs`
--

INSERT INTO `doctor_jobs` (`Doctor_job_id`, `Doctor_job_ar_name`, `Doctor_job_eng_name`) VALUES
(1, 'استاذ', 'Professor'),
(2, 'استاذ مساعد', 'Associate Professor'),
(3, 'مدرس', 'Lecturer'),
(4, 'مدرس مساعد', 'lecturer Assistant'),
(5, 'معيد', 'Teaching Assistant'),
(6, 'استاذ متفرغ', '-'),
(7, 'استاذ مساعد متفرغ', '-'),
(8, 'مدرس متفرغ', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_types`
--

CREATE TABLE `doctor_types` (
  `Doctor_type_id` tinyint(4) NOT NULL,
  `Doctor_type_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor_types`
--

INSERT INTO `doctor_types` (`Doctor_type_id`, `Doctor_type_name`) VALUES
(1, 'داخلى - كلية'),
(2, 'داخلي - جامعة'),
(3, 'منتدب - عضو هيئة تدريس'),
(4, 'منتدب - خبير');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `Faculty_id` tinyint(4) NOT NULL,
  `Faculty_ar_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Faculty_eng_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`Faculty_id`, `Faculty_ar_name`, `Faculty_eng_name`) VALUES
(1, 'كلية التجارة وإدارة الأعمال', 'Faculty of Commerce & Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `p60_tablename`
--

CREATE TABLE `p60_tablename` (
  `attribute1` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p63_announcement`
--

CREATE TABLE `p63_announcement` (
  `message_id` int(11) NOT NULL,
  `message_text` text DEFAULT NULL,
  `message_image` text DEFAULT NULL,
  `message_date` datetime DEFAULT NULL,
  `level` int(11) NOT NULL,
  `message_by` tinyint(4) NOT NULL,
  `student_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_announcement`
--

INSERT INTO `p63_announcement` (`message_id`, `message_text`, `message_image`, `message_date`, `level`, `message_by`, `student_level`) VALUES
(50, 'message', '1687540268cover.png', '2023-06-23 20:11:08', 6, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `p63_complain`
--

CREATE TABLE `p63_complain` (
  `complain_id` int(11) NOT NULL,
  `complain_text` text DEFAULT NULL,
  `complain_type` varchar(50) DEFAULT NULL,
  `complain_date` datetime DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `respond_status_id` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `complain_respond` text DEFAULT NULL,
  `respond_date` date DEFAULT NULL,
  `seen_complain_date` datetime DEFAULT NULL,
  `respond_by` tinyint(4) DEFAULT NULL,
  `complain_status_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_complain`
--

INSERT INTO `p63_complain` (`complain_id`, `complain_text`, `complain_type`, `complain_date`, `sid`, `respond_status_id`, `image`, `complain_respond`, `respond_date`, `seen_complain_date`, `respond_by`, `complain_status_id`) VALUES
(18, 'complain', 'اخري', '2023-06-23 20:06:26', 1920403, NULL, '1687539986cover.png', 'تم التعديل', '2023-06-23', '2023-06-23 20:20:34', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `p63_complain_respond`
--

CREATE TABLE `p63_complain_respond` (
  `complain_respond_id` int(11) NOT NULL,
  `complain_respond_text` text DEFAULT NULL,
  `respond_date` datetime DEFAULT NULL,
  `respond_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p63_complain_status`
--

CREATE TABLE `p63_complain_status` (
  `respond_status_id` int(11) NOT NULL,
  `respond_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_complain_status`
--

INSERT INTO `p63_complain_status` (`respond_status_id`, `respond_status`) VALUES
(1, 'تم الارسال وفي انتظار الرد'),
(2, 'تم النظر في الشكوى وفي انتظار الرد'),
(3, 'تم الرد على الشكوى');

-- --------------------------------------------------------

--
-- Table structure for table `p63_order`
--

CREATE TABLE `p63_order` (
  `order_id` int(11) NOT NULL,
  `payment_code` int(11) DEFAULT NULL,
  `scan_order_img` text DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `addressed_to` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `apply_date` datetime DEFAULT current_timestamp(),
  `send_pay_code_date` datetime DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `check_receipt_date` datetime DEFAULT NULL,
  `finish_order_date` datetime DEFAULT NULL,
  `reject_order_date` datetime DEFAULT NULL,
  `receive_order_date` datetime DEFAULT NULL,
  `reject_receipt_date` datetime DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) NOT NULL DEFAULT 1,
  `receipt_image` text DEFAULT NULL,
  `soft_copy` varchar(30) NOT NULL,
  `done_by_user` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_order`
--

INSERT INTO `p63_order` (`order_id`, `payment_code`, `scan_order_img`, `order_quantity`, `addressed_to`, `notes`, `student_id`, `apply_date`, `send_pay_code_date`, `payment_date`, `check_receipt_date`, `finish_order_date`, `reject_order_date`, `receive_order_date`, `reject_receipt_date`, `service_id`, `order_status_id`, `receipt_image`, `soft_copy`, `done_by_user`) VALUES
(135, 58585858, '1687539513cover1.png', NULL, 'البنك الاهلى', '', 1920403, '2023-06-23 19:56:28', '2023-06-23 19:57:03', '2023-06-23 19:57:26', '2023-06-23 19:57:53', '2023-06-23 19:58:33', NULL, '2023-06-23 19:58:53', NULL, 1, 5, '16875394461.jpg', 'نعم', 6);

-- --------------------------------------------------------

--
-- Table structure for table `p63_order_statuses`
--

CREATE TABLE `p63_order_statuses` (
  `order_status_id` int(11) NOT NULL,
  `order_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_order_statuses`
--

INSERT INTO `p63_order_statuses` (`order_status_id`, `order_status`) VALUES
(1, 'في انتظار ارسال كود الدفع'),
(2, 'تم ارسال كود الدفع وفي انتظار مراجعة الايصال في حالة رفعه'),
(3, 'جاري العمل بها'),
(4, 'تم الانتهاء منها'),
(5, 'تم استلامها'),
(6, 'مرفوض لعدم سداد المصروفات'),
(7, 'عدم وضوح صوره الايصال برجاء ارسال صوره اخرى');

-- --------------------------------------------------------

--
-- Table structure for table `p63_services`
--

CREATE TABLE `p63_services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_services`
--

INSERT INTO `p63_services` (`service_id`, `service_name`, `fees`) VALUES
(1, 'اثبات قيد', 110),
(2, 'شهاده تخرج', 410),
(3, 'اثبات قيد باللغه الانجليزيه', 220),
(4, 'بيان درجات', 210),
(5, 'بيان درجات باللغه الانجليزيه', 410),
(6, 'افاده دراسه باللغه الانجليزيه', 300),
(7, 'بيان حاله', 200),
(8, 'ايقاف قيد عن تيرم دراسى ', 1000),
(9, 'ايقاف قيد عن سنه دراسيه ', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `p63_student`
--

CREATE TABLE `p63_student` (
  `student_id` int(11) NOT NULL,
  `arb_name` varchar(30) DEFAULT NULL,
  `eng_name` varchar(30) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `gpa` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_student`
--

INSERT INTO `p63_student` (`student_id`, `arb_name`, `eng_name`, `phone`, `level`, `gpa`) VALUES
(1920001, 'احمد', 'ahmed', 12568456, 6, 3.56),
(1920002, 'جورج وجدى', 'george wagdy', 120123456, 5, 3.46),
(1920004, 'ابانوب ناصر ابراهيم', 'Abanoub Nasser', 1226364389, 4, 3.99),
(1920403, 'مينا وجدي سمير', 'Mina Wagdy Samir', 1208485452, 4, 3.98),
(1920499, 'بيشوي فايز رشدي ', 'Bishoy Fayez Roushy', 120123456, 4, 3.97),
(2021004, 'جورج ', 'george', 122656555, 3, 3.99),
(2122403, 'مريم', 'mariam', 1226354447, 2, 3.56);

-- --------------------------------------------------------

--
-- Table structure for table `p63_student_level`
--

CREATE TABLE `p63_student_level` (
  `student_level` int(11) NOT NULL,
  `level_text` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p63_student_level`
--

INSERT INTO `p63_student_level` (`student_level`, `level_text`) VALUES
(1, 'المستوى الاول '),
(2, 'المستوى الثانى  '),
(3, 'المستوى التالت'),
(4, 'المستوى الرابع'),
(5, 'الخريجين'),
(6, 'كل المستويات'),
(7, 'كل المستويات و الخريجين');

-- --------------------------------------------------------

--
-- Table structure for table `p63_student_order`
--

CREATE TABLE `p63_student_order` (
  `student_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `apply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(66) NOT NULL,
  `address` varchar(77) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `address`, `phone`) VALUES
(33, 'ff', 'dd', 33);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `uni_id` tinyint(4) NOT NULL,
  `uni_ar_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uni_eng_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`uni_id`, `uni_ar_name`, `uni_eng_name`) VALUES
(1, 'جامعة حلوان', 'Helwan University');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` tinyint(4) NOT NULL,
  `user_ar_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type_id` tinyint(4) NOT NULL,
  `added_date` datetime NOT NULL,
  `added_by` tinyint(4) NOT NULL,
  `Notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_enable` varchar(3) NOT NULL DEFAULT 'Yes' COMMENT 'yes or no',
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_ar_name`, `username`, `password`, `user_type_id`, `added_date`, `added_by`, `Notes`, `is_enable`, `image`) VALUES
(1, 'محمد عبد السلام', 'mohamed Abd Elsalam ', '123', 1, '2023-03-09 15:28:23', 1, NULL, 'Yes', '1.jpg'),
(2, 'احمد', 'ahmed', '321', 2, '2023-05-21 22:39:21', 1, NULL, 'Yes', ''),
(5, 'انجى يحى', 'Engy Yahia', '456', 1, '2023-05-31 12:44:21', 0, NULL, 'Yes', '2.jpg'),
(6, 'ايمن ', 'Ayman ', '654', 2, '2023-05-31 12:44:21', 0, NULL, 'Yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_types`
--

CREATE TABLE `users_types` (
  `user_type_id` tinyint(4) NOT NULL,
  `user_type_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_types`
--

INSERT INTO `users_types` (`user_type_id`, `user_type_name`) VALUES
(1, 'Admin'),
(2, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acceptedstudentdata`
--
ALTER TABLE `acceptedstudentdata`
  ADD PRIMARY KEY (`StudentCode`),
  ADD KEY `StudentCode` (`StudentCode`);

--
-- Indexes for table `application_data`
--
ALTER TABLE `application_data`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseCode`),
  ADD KEY `FK_pre` (`PreRequiset`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`StudentCode`,`CourseCode`,`Semester`,`Year`),
  ADD KEY `Semester` (`Semester`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `CourseCode` (`CourseCode`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`Department_id`);

--
-- Indexes for table `doctorscourse`
--
ALTER TABLE `doctorscourse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesteryear` (`semesterYear`),
  ADD KEY `DoctorCode` (`DoctorCode`),
  ADD KEY `CourseCode` (`CourseCode`),
  ADD KEY `SemesterCode` (`SemesterCode`);

--
-- Indexes for table `doctors_account`
--
ALTER TABLE `doctors_account`
  ADD PRIMARY KEY (`DoctorCode`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Indexes for table `doctor_jobs`
--
ALTER TABLE `doctor_jobs`
  ADD PRIMARY KEY (`Doctor_job_id`);

--
-- Indexes for table `doctor_types`
--
ALTER TABLE `doctor_types`
  ADD PRIMARY KEY (`Doctor_type_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`Faculty_id`);

--
-- Indexes for table `p63_announcement`
--
ALTER TABLE `p63_announcement`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `level` (`level`),
  ADD KEY `level_2` (`level`),
  ADD KEY `message_by` (`message_by`),
  ADD KEY `message_by_2` (`message_by`),
  ADD KEY `student_level` (`student_level`);

--
-- Indexes for table `p63_complain`
--
ALTER TABLE `p63_complain`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `sid` (`sid`),
  ADD KEY `complain_respond_id` (`respond_status_id`),
  ADD KEY `complain_respond_id_2` (`respond_status_id`),
  ADD KEY `respond_status_id` (`respond_status_id`),
  ADD KEY `complain_status_id` (`complain_status_id`),
  ADD KEY `respond_by` (`respond_by`),
  ADD KEY `respond_by_2` (`respond_by`);

--
-- Indexes for table `p63_complain_respond`
--
ALTER TABLE `p63_complain_respond`
  ADD PRIMARY KEY (`complain_respond_id`);

--
-- Indexes for table `p63_complain_status`
--
ALTER TABLE `p63_complain_status`
  ADD PRIMARY KEY (`respond_status_id`),
  ADD KEY `respond_status_id` (`respond_status_id`);

--
-- Indexes for table `p63_order`
--
ALTER TABLE `p63_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `service_id_2` (`service_id`),
  ADD KEY `service_id_3` (`service_id`),
  ADD KEY `order_status_id` (`order_status_id`),
  ADD KEY `done_by_user` (`done_by_user`);

--
-- Indexes for table `p63_order_statuses`
--
ALTER TABLE `p63_order_statuses`
  ADD PRIMARY KEY (`order_status_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Indexes for table `p63_services`
--
ALTER TABLE `p63_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `p63_student`
--
ALTER TABLE `p63_student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_id_2` (`student_id`),
  ADD KEY `student_id_3` (`student_id`),
  ADD KEY `student_id_4` (`student_id`),
  ADD KEY `student_id_5` (`student_id`),
  ADD KEY `student_id_6` (`student_id`),
  ADD KEY `level` (`level`),
  ADD KEY `student_id_7` (`student_id`);

--
-- Indexes for table `p63_student_level`
--
ALTER TABLE `p63_student_level`
  ADD PRIMARY KEY (`student_level`),
  ADD KEY `student_level` (`student_level`);

--
-- Indexes for table `p63_student_order`
--
ALTER TABLE `p63_student_order`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `student_id_2` (`student_id`),
  ADD KEY `order_id_2` (`order_id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`),
  ADD KEY `user_id_4` (`user_id`),
  ADD KEY `user_id_5` (`user_id`),
  ADD KEY `user_id_6` (`user_id`);

--
-- Indexes for table `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`user_type_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_data`
--
ALTER TABLE `application_data`
  MODIFY `app_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `Department_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctorscourse`
--
ALTER TABLE `doctorscourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors_account`
--
ALTER TABLE `doctors_account`
  MODIFY `DoctorCode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_jobs`
--
ALTER TABLE `doctor_jobs`
  MODIFY `Doctor_job_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_types`
--
ALTER TABLE `doctor_types`
  MODIFY `Doctor_type_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `Faculty_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `p63_announcement`
--
ALTER TABLE `p63_announcement`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `p63_complain`
--
ALTER TABLE `p63_complain`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `p63_complain_status`
--
ALTER TABLE `p63_complain_status`
  MODIFY `respond_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p63_order`
--
ALTER TABLE `p63_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `p63_order_statuses`
--
ALTER TABLE `p63_order_statuses`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `p63_services`
--
ALTER TABLE `p63_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `p63_student_level`
--
ALTER TABLE `p63_student_level`
  MODIFY `student_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `uni_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `user_type_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p63_announcement`
--
ALTER TABLE `p63_announcement`
  ADD CONSTRAINT `p63_announcement_ibfk_1` FOREIGN KEY (`level`) REFERENCES `p63_student` (`level`),
  ADD CONSTRAINT `p63_announcement_ibfk_2` FOREIGN KEY (`message_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `p63_announcement_ibfk_3` FOREIGN KEY (`student_level`) REFERENCES `p63_student_level` (`student_level`);

--
-- Constraints for table `p63_complain`
--
ALTER TABLE `p63_complain`
  ADD CONSTRAINT `p63_complain_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `p63_student` (`student_id`),
  ADD CONSTRAINT `p63_complain_ibfk_2` FOREIGN KEY (`respond_status_id`) REFERENCES `p63_complain_respond` (`complain_respond_id`),
  ADD CONSTRAINT `p63_complain_ibfk_3` FOREIGN KEY (`complain_status_id`) REFERENCES `p63_complain_status` (`respond_status_id`),
  ADD CONSTRAINT `p63_complain_ibfk_4` FOREIGN KEY (`respond_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `p63_order`
--
ALTER TABLE `p63_order`
  ADD CONSTRAINT `p63_order_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `p63_student` (`student_id`),
  ADD CONSTRAINT `p63_order_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `p63_services` (`service_id`),
  ADD CONSTRAINT `p63_order_ibfk_3` FOREIGN KEY (`order_status_id`) REFERENCES `p63_order_statuses` (`order_status_id`),
  ADD CONSTRAINT `p63_order_ibfk_4` FOREIGN KEY (`done_by_user`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `p63_student`
--
ALTER TABLE `p63_student`
  ADD CONSTRAINT `p63_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `acceptedstudentdata` (`StudentCode`);

--
-- Constraints for table `p63_student_order`
--
ALTER TABLE `p63_student_order`
  ADD CONSTRAINT `p63_student_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `p63_order` (`order_id`),
  ADD CONSTRAINT `p63_student_order_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `p63_student` (`student_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `users_types` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
