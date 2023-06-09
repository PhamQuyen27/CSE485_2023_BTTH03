-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 17, 2023 lúc 03:06 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `member`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `membership_level` varchar(50) NOT NULL DEFAULT 'basic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activation_code`, `is_activated`, `membership_level`) VALUES
(1, 'dungkt', '', 'dungkt@tlu.edu.vn', 'chuoigido', 0, 'basic'),
(2, 'dungkt2', 'abc', 'dungkt2@tlu.edu.vn', 'chuoigido', 0, 'basic'),
(3, 'dungkt3', '900150983cd24fb0d6963f7d28e17f72', 'dungkt3@tlu.edu.vn', 'chuoigido', 0, 'basic'),
(4, 'dungkt4', '$2y$10$1RUgvA5Fqp.5aggifOhege3MhoCU0mf0HLGL9tTmudx', 'dungkt4@tlu.edu.vn', 'chuoigido', 0, 'basic'),
(5, 'dungkt5', '$2y$10$lR3GWppXgmRm9MFKAv7jteoSnMLREWc773n9TJhyewk', 'dungkt5@tlu.edu.vn', 'chuoigido', 1, 'basic'),
(6, 'dungkt6', '$2y$10$vUG/fImnqpWFEfj61opufuojXThKKLdwo0upgIAUBFhM7YXNFR1GC', 'dungkt6@tlu.edu.vn', 'chuoigido', 1, 'admin'),
(7, 'dungkt7', '$2y$10$EuacM60hsR8J8IIuSpg6beT9/G/SjxAtojcTciVPN5sdnrnso7txi', 'dungkt7@tlu.edu.vn', '75b48b698cc3168d372877d57d931a1b3d5205988580880f226738e97b336c71', 1, 'basic'),
(8, 'dungkt8@tlu.edu.vn', '$2y$10$5hHdRUUKgH3bsB79Yr3W.u1usRCVZUspggh8QSPe3HceiqeC/016O', 'dungkt8@tlu.edu.vn', '54f4a82551ce235c04a71b92d080dfcaa6f7977a5275659129b5fab19da79c71', 0, 'basic'),
(9, 'dungkt9', 'abc', 'dungkt9@tlu.edu.vn', 'CHUOIKICHHOAT', 0, 'basic'),
(10, 'dungkt10', '900150983cd24fb0d6963f7d28e17f72', 'dungkt10@tlu.edu.vn', 'CHUOIKICHHOAT', 0, 'basic'),
(11, 'dungkt11', '900150983cd24fb0d6963f7d28e17f72', 'dungkt11@tlu.edu.vn', 'CHUOIKICHHOAT', 0, 'basic'),
(12, 'dungkt12', '$2y$10$mMA92hM5mhMhAnD0Z6TR9.rdvkXF7tBskNhDoPc5K.LgZYEa0PPLu', 'dungkt12@tlu.edu.vn', 'CHUOIKICHHOAT', 0, 'basic'),
(13, 'dungkt13', '$2y$10$TMAH5BMwHldPKfSbihiz/OilG5tArJ2fJpGlG3EwsJSOflX6Lx0bC', 'dungkt13@tlu.edu.vn', 'CHUOIKICHHOAT', 1, 'basic'),
(14, 'dungkt15', '$2y$10$jWMZdnKagMcEHW9bKhrKqulpqior3uxzrDiW6bpCqGdJtedXKjJjy', 'dungkt15@tlu.edu.vn', 'b3c41a99ece2b51357c9aa6c22b0e7a8', 1, 'basic'),
(20, 'quyen2', '$2y$10$GLQ197qlv0EaLg5hlxdHSe2Lau67EM5fxJ90bwmqkGY52ejgrxwlO', 'quyenpham0712@gmail.com', '0031fe94137c72b6751b0ccad741af72', 1, 'basic');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
