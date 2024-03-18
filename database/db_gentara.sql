-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2024 at 08:36 AM
-- Server version: 10.2.3-MariaDB-log
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gentara`
--

-- --------------------------------------------------------

--
-- Table structure for table `cta`
--

CREATE TABLE `cta` (
  `id` int(13) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `link` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cta`
--

INSERT INTO `cta` (`id`, `nama`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Whatsapp', 'wa.me/+6281369439939', '2024-03-14 10:53:41', '2024-03-14 15:49:22'),
(2, 'Telegram', 'te.me/siupil', '2024-03-15 04:49:11', '2024-03-15 04:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `nama`, `deskripsi`, `alt_text`, `gambar`, `created_at`, `updated_at`) VALUES
(5, 'Bukitasam', 'Logo Bukitasam', 'Logo Bukitasam', '4ebb7308ae6d496cfb95f21992a41a7d.png', '2024-03-11 22:19:18', '2024-03-11 22:19:18'),
(9, 'Sinarmas', 'Logo Sinarmas', 'Logo Sinarmas', '4a19ebeca58f7fe7f2d2e1681f4f3f1b.png', '2024-03-11 22:26:32', '2024-03-11 22:26:32'),
(10, 'Adaro', 'Logo Adaro', 'Logo Adaro', 'a38b7c628e0521f655c396b72e9b76f3.png', '2024-03-13 14:52:33', '2024-03-13 14:52:33'),
(11, 'MNC', 'Logo MNC', 'Logo MNC', 'e9e3f7a933c68c6795f9f36290f66d8b.png', '2024-03-13 15:12:52', '2024-03-13 15:12:52'),
(12, 'Babacoal', 'Logo babacoal', 'Logo babacoal', 'ddcaf352db4a63b13d30e49a52d65eda.png', '2024-03-14 00:47:40', '2024-03-14 00:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `isi` text NOT NULL,
  `penulis` varchar(225) NOT NULL,
  `tanggal_posting` varchar(13) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `judul`, `isi`, `penulis`, `tanggal_posting`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Sistem Manajemen Pertambangan', 'How do you create compelling presentations that wow your colleagues and impress your managers?', 'Olivia Rhye', '2024-03-09', 'Image.png', '2024-03-09 08:54:02', '2024-03-09 08:54:02'),
(4, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', 'a100fa02a468b4147f5bec5bba097d9d.png', '2024-03-09 10:12:17', '2024-03-09 10:12:17'),
(5, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', 'ccc5697124a5fbf0f18b96f33b525f4c.png', '2024-03-09 10:35:52', '2024-03-09 10:35:52'),
(6, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', '33d6dfe431dae4779145c35558736c60.png', '2024-03-09 10:38:03', '2024-03-09 10:38:03'),
(7, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', 'cd9ab9d901889318160144676af45ea5.png', '2024-03-09 10:38:25', '2024-03-09 10:38:25'),
(8, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', 'ce0c9af13c839ad937600a23744ab249.png', '2024-03-09 10:40:17', '2024-03-09 10:40:17'),
(9, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', 'ac55121653d674128db6d261c2ee8ab8.png', '2024-03-09 10:54:40', '2024-03-09 10:54:40'),
(10, 'Sistem tambang', 'tetststtstsst', 'test', '03-09-2024', '59520b99b323b979a7b48500c1a4195b.png', '2024-03-09 17:12:59', '2024-03-09 17:12:59'),
(11, 'Sistem tambang modern', 'lalalalalala', 'test', '03-09-2024', '5cb1e90fbf754092b6a571ddac192389.png', '2024-03-09 17:20:02', '2024-03-09 17:20:02'),
(12, 'Sistem tambang modern', 'lalalalalala', 'test', '03-09-2024', '27cfea964ed8d9824d0a546ae7fc5fca.png', '2024-03-09 17:36:02', '2024-03-09 17:36:02'),
(13, 'Sistem tambang modern', 'lalalalalala', 'test', '03-09-2024', '1eaaaf11c15a56f5de42d545758da915.png', '2024-03-10 01:50:18', '2024-03-10 01:50:18'),
(14, 'Sistem tambang modern', 'lalalalalala', 'test', '03-09-2024', '34db033ec738b45182bcca10235a90d2.png', '2024-03-11 21:54:43', '2024-03-11 21:54:43'),
(15, 'Sistem tambang modern', 'lalalalalala', 'test', '03-09-2024', '8aac3ead0bd8dffbd325ac8efe92ddf8.png', '2024-03-11 22:02:13', '2024-03-11 22:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `judul`, `isi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Mining Service & Rental', 'Menyewakan alat penambangan, pengukuran & pemantauan', 'bcb0f8f7ac366503485c1507cf5ca65a.png', '2024-03-12 04:43:38', '2024-03-12 04:43:38'),
(2, 'Mining Service & Rental', 'Menyewakan alat penambangan, pengukuran & pemantauan', 'fa284680e846e21720318c110db1a396.png', '2024-03-12 04:44:19', '2024-03-12 04:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(125) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'iwan', 'dediaye@gmail.com', 'Iwanaja', '$2y$10$./EsWwOx.MsKRXmF2JOvve9WE0AfO50G7ZVctBqwhf5gJQQLc/UVe', 'admin', 'only_face.png', '2024-03-02 11:25:51', '2024-03-02 11:25:51'),
(6, 'aji', 'aji@gmail.com', 'ajiaja', '$2y$10$phSU5MH8/oKYWLytfsB/l./O.Pq3ICYYaGPxDrNxukcBOpE66Vpty', 'admin', NULL, '2024-03-06 08:03:57', '2024-03-06 08:03:57'),
(7, 'tia', 'qwe@gmail.com', 'qwe', '$2y$10$GWclKj3dDK.vpsxL1gptEej5lkF43niGy01b3PTvw2Yu1k8o68U.C', 'admin', NULL, '2024-03-06 09:12:04', '2024-03-06 09:12:04'),
(8, 'qwe', 'ani@gmail.com', 'qaq', '$2y$10$..yoNzrWHIGlZFgvQ2D84emEMH6ArrtdLcAPLg6gRjcWIyHNJHv/m', '', NULL, '2024-03-06 09:13:18', '2024-03-06 09:13:18'),
(9, 'tiaaja', 'tiaaja@gmail.com', 'tiaja', '$2y$10$ox10lIClpW8D0fLOD4xdSOeQFl9GQbkDqax848Ag5ZnXi4oO6A/NW', 'user', NULL, '2024-03-06 09:22:41', '2024-03-06 09:22:41'),
(10, 'lala', 'lala@gmail.com', 'lala', '$2y$10$JyoEkR3C7QdR0GX6AauzPee6UY738SzZgkZ3fN4E1eysXVgo.FPy6', 'user', NULL, '2024-03-06 02:27:51', '2024-03-06 09:27:51'),
(11, 'Ujangpare', 'ujangajaa@gmail.com', 'akjs', '$2y$10$AmTH3aZl09Pmw7HvwQ6FR.TVdsTWk7CaRFhJQ0i/nbF/xcYrpMySS', 'admin', NULL, '2024-03-06 03:15:03', '2024-03-06 10:15:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cta`
--
ALTER TABLE `cta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cta`
--
ALTER TABLE `cta`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
