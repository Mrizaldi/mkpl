-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2019 pada 07.41
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prjmgm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `projectId` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `board`
--

INSERT INTO `board` (`id`, `name`, `projectId`) VALUES
(1, 'to do', '2'),
(2, 'In Progress', '2'),
(3, 'To Do', '3'),
(4, 'In Progress', '3'),
(5, 'Done', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `clientPhone` varchar(100) NOT NULL,
  `clientAddress` varchar(100) NOT NULL,
  `clientCompany` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id`, `clientName`, `clientPhone`, `clientAddress`, `clientCompany`) VALUES
(1, 'RS Universitas Brawijaya', '0341345963', 'Jl. Soekarno Hatta - Malang', 'Universitas Brawijaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doctambah`
--

CREATE TABLE `doctambah` (
  `id` int(11) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `idproject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `doctambah`
--

INSERT INTO `doctambah` (`id`, `filename`, `idproject`) VALUES
(1, '14_mp-pembuatan-transkrip.pdf', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pic`
--

CREATE TABLE `pic` (
  `id` int(11) NOT NULL,
  `picName` varchar(100) NOT NULL,
  `picPhone` varchar(100) NOT NULL,
  `picMail` varchar(100) NOT NULL,
  `picPosition` varchar(100) NOT NULL,
  `clientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pic`
--

INSERT INTO `pic` (`id`, `picName`, `picPhone`, `picMail`, `picPosition`, `clientId`) VALUES
(1, 'Aliando', '089789678567', 'alala@alala.coli', 'HRD', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `projName` varchar(100) NOT NULL,
  `projStartDate` date NOT NULL,
  `projEndDate` date NOT NULL,
  `projDescription` varchar(512) NOT NULL,
  `projProgress` int(12) NOT NULL,
  `clientId` int(11) NOT NULL,
  `pm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `projName`, `projStartDate`, `projEndDate`, `projDescription`, `projProgress`, `clientId`, `pm`) VALUES
(2, 'Aplikasi Projek PKL', '2019-08-19', '2019-08-21', 'Projek PKL an Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis auteProjek PKL an Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute', 50, 1, 33),
(3, 'Projek Bank', '2019-08-21', '2019-10-22', 'Projek bank baru', 0, 1, 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `task`
--

CREATE TABLE `task` (
  `id` int(12) NOT NULL,
  `name` varchar(128) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `deskripsi` varchar(1024) NOT NULL,
  `status` varchar(64) NOT NULL,
  `projId` varchar(12) NOT NULL,
  `empId` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `task`
--

INSERT INTO `task` (`id`, `name`, `startDate`, `endDate`, `deskripsi`, `status`, `projId`, `empId`) VALUES
(1, 'Task baru', '2019-08-21', '2019-08-23', 'Task baru', '4', '3', 34);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL DEFAULT 'primavisi123',
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(31, 'David Hermansyah', 'davidhermansyah@gmail.com', '087223445667', 'default.jpg', '$2y$10$b55wCiepP/Yo9.QnFwWbLur6iZrfFmbNzWzvo9AQG8ALXsW0NOK86', 1, 1, 1565317827),
(33, 'Beni Dektos Heronimus', 'benidektosh@gmail.com', '085788387939', 'default.jpg', '$2y$10$Aiq0zdU8mPM3cZT2q1znDO1NbdkYv.YgRMI0ksUYdxezjVqdPVmKW', 3, 1, 1565870705),
(34, 'Muhammad Rizaldi', 'muhammadrizaldi98.mr@gmail.com', '085708852382', 'default.jpg', '$2y$10$nJF0gv4O9uGxkKw31jSPIeiXmH6b/585dTDX6ocsLX1kgKIrmtswa', 4, 1, 1565870785),
(35, 'Muhammad Aliyya Ilmi', 'muhammadaliyya19@gmail.com', '085784114468', 'default.jpg', '$2y$10$.09YzmaCnn/DgF.Ph9nqwuBSps3v0q93jFySt8c6S7lkBXKORUHoe', 2, 1, 1565872984),
(38, 'Dustin Jack', 'dustinjack21@yahoo.co.id', '085784114468', 'default.jpg', '$2y$10$yyBfp.4yNB4BmSSHu41Lnu9wig6q7vsn4hxjnse04Tg2dkaY9L7IC', 4, 1, 1567222369);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 2, 1),
(6, 2, 3),
(7, 3, 1),
(8, 3, 3),
(9, 4, 1),
(10, 4, 3),
(11, 5, 1),
(12, 5, 3),
(13, 6, 1),
(14, 6, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Office'),
(3, 'Personal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Support'),
(3, 'Project Manager'),
(4, 'Programmer'),
(5, 'Business Analyst'),
(6, 'Tester');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', '', 'fas fa-tachometer-alt fa-fw', 1),
(2, 3, 'My Profile', 'user/profile', 'fas fa-user fa-fw', 1),
(3, 1, 'Project', 'project', 'fas fa-project-diagram', 1),
(4, 1, 'Client', 'client', 'fas fa-user-friends', 1),
(5, 1, 'Employee', 'employee', 'fas fa-user-cog', 1),
(10, 3, 'Edit Profile', 'user/edit', 'fas fa-user-edit fa-fw', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(7, 'benidektosh@gmail.com', 'ash07Z5/AYwVsx9fgX7qSvk7rTGV6KEcCCAZ7ywxnxE=', 1564498600),
(8, 'muhammadaliyya19@gmail.com', 'T+/9CCOpF8YVa2jsUt0NhintjXrNjtsMmqqSz7mK4bc=', 1564500265),
(9, 'muhammadaliyya19@gmail.com', 'TEnIyFJNliBz1//btaxYj4ZenakDVB+kOhiQE1Ntups=', 1564500546),
(10, 'muhammadaliyya19@gmail.com', 'Qou81/I5ErahuFWzli2bc3F2bQDducKwSmzQ4bDRwgk=', 1564500633),
(11, 'muhammadaliyya19@gmail.com', 'ncsPX2lk0xPlSO7QKmhCmk/QYMeBS6pukYMS90PWNwQ=', 1564501495),
(12, 'muhammadaliyya19@gmail.com', 'SOTI4lKZe0pqNw+axLpnXjVrw/OLUXzt3h0a7dU9S4k=', 1564503405),
(13, 'muhammadaliyya19@gmail.com', 'EdBh2GkxpjxltM86UR3Yw3YvUIDgYFXBplph5w5a5Qo=', 1564503510),
(14, 'muhammadaliyya19@gmail.com', 'qPMnXmB2tWIvnoMujnjOqhgEKzRWL7nRmCw5RISqn4k=', 1564505122),
(15, 'muhammadaliyya19@gmail.com', 'uUuI944zrm/RD8+XU6jSf/1Eyw7ZWofw/0c/OAWPqRc=', 1564543933),
(16, 'muhammadaliyya19@gmail.com', 'nmi8s6uGiLYgQg2cKXLjUMVSmY+tE3O/+TzyEtVCJlE=', 1564544040),
(17, 'muhammadaliyya19@gmail.com', 'eI+IfVq34K90+CQFphwjE9+zWjZCR6D+T+NXSha9srA=', 1564544149),
(18, 'davidhermansyah@gmail.com', 'q9lD0GtzfkGEKFv2lT90L5iNhdLBNZVM7ePI3bOZf+Y=', 1565317827),
(19, 'muhammadaliyya19@gmail.com', 'pY6ARoD70dR2f1393T0Rg4B99VQ6u01KGHWV0yvkxGk=', 1565317953),
(20, 'benidektosh@gmail.com', 'WaBmw+i5563ZPN7C0FaepvAkyaoKbtXSEPVb7noKpks=', 1565870705),
(21, 'muhammadrizaldi98.mr@gmail.com', 'GI3Z3sOH2j2nanB2opdQpfaaijDaqYmssRmAJVjxn94=', 1565870785),
(22, 'muhammadaliyya19@gmail.com', 'EcxLKC5INf7BFZo3n6OIZEIhpVtLRX9HqFwis65TZrA=', 1565872984),
(23, 'dustinjack21@yahoo.co.id', 'WI+3EiFVVYzLGOPI2RJVn19XjDjUaKL7Tw/nfctXxUE=', 1567222194),
(24, 'dustinjack21@yahoo.co.id', 'O39G3nxTwyLGBH9/+R8vq9flZkEI+ub4fFQqXG77YeI=', 1567222235),
(25, 'dustinjack21@yahoo.co.id', 'SwTaVCZa15lsiisp//14ZyBynVh+nP6zHCVa6Ro3O2Q=', 1567222369);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doctambah`
--
ALTER TABLE `doctambah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientId` (`clientId`);

--
-- Indeks untuk tabel `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `doctambah`
--
ALTER TABLE `doctambah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pic`
--
ALTER TABLE `pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `task`
--
ALTER TABLE `task`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
