-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 11, 2024 at 12:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcoops`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `description` text CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `image` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `cat_id`, `user_id`, `active`, `image`, `color`, `size`, `price`, `created_at`) VALUES
(1, 'Shoes', 'Puma Shoes', 1, 1, 1, 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?w=500&amp;auto=format&amp;fit=crop&amp;q=60&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHNob2VzfGVufDB8fDB8fHww', 'Blue', '8', 999, '2024-06-10 05:39:10'),
(2, 'Laptop', 'Samsung Laptops', 2, 2, 1, 'https://images.unsplash.com/photo-1618424181497-157f25b6ddd5?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bGFwdG9wJTIwY29tcHV0ZXJ8ZW58MHx8MHx8fDA%3D', 'Silver White', '40', 44999, '2024-06-10 05:40:20'),
(3, 'Wrangler Jeans', 'Denim Partner', 3, 3, 1, 'https://static.aceomni.cmsaceturtle.com/prod/product-image/aceomni/Wrangler/Monobrand/WMJN006341/WMJN006341_1.jpg', 'Grey', '38', 1599, '2024-06-10 05:47:37'),
(4, 'Solid Blue Shirt', 'Light Blue official Shirt', 4, 4, 1, 'https://images.unsplash.com/photo-1620012253295-c15cc3e65df4?q=80&amp;w=1000&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHNoaXJ0c3xlbnwwfHwwfHx8MA%3D%3D', 'Light Blue', '32', 999, '2024-06-10 05:49:56'),
(5, 'Sherwani', 'Men Floral Sherwani', 5, 5, 1, 'https://i.pinimg.com/236x/3b/d8/31/3bd8311cf90c73ac5c1ec9236dc84aa7.jpg', 'Silver', '46', 12999, '2024-06-10 06:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'David Miller', 'miller@gmail.com', '$2y$10$QfdrlOgG.OyU9AOsH.Y5uOE4iozY.8/GGCsVVf4HtXavVjq94waeu'),
(2, 'KSHIRSAGAR BALASAI', 'balasaikshirsagar@gmail.com', '$2y$10$/vMYmfKXTCTH2tv5Y6CuoejOswnpvrkxBvjdKuZRQPDPq2ruF9lk6'),
(3, 'Hardik Pandya', 'hardik@gmail.com', '$2y$10$S/GzNR0Fm6Y6iPN9H/OVl.s1VHAWz782qr/i7UBFqCAgIieHE2xMK'),
(4, 'Krunal Pandya', 'krunal@gmail.com', '$2y$10$LbtOG4yBPX7WJdiPS8M2NuIDcrDHx9mnmkXdNtt4XMTMKUaF/75oG'),
(5, 'Krunal Pandya', 'krunal@gmail.com', '$2y$10$6MgDXGAGwc8x0Ypd8/C0C.nUTTB.3kVyrO4rVxCjKZC9/AKm5b1V.'),
(6, 'Virat Kohli', 'virat@gmail.com', '$2y$10$EtCyAcqhDU2q.ayeh8je/uBRpxz0AyX3tYJRARgFi4eLmuUvBeFA2'),
(8, 'Anushka Sharma', 'anushka@gmail.com', '$2y$10$OdI2yLEfvmhhJz9Z8FuiReUy7G3TkJzwdJ..KlCumCrNDp1Yu4mqS'),
(9, 'Yuzi Chahal', 'chahal@gmail.com', '$2y$10$wn1bwUfVhNNIetFA/JaWc.XS.SUiZ6tXynmzlyPBgPDKVeS9p3KOy'),
(10, 'Mitchell Marsh', 'marsh@gmail.com', '$2y$10$es7KQ09yyHj/4doclpr4q.Gnnh1V719Jmy0XBeonENsQQLNbM7BM.'),
(11, 'Mohit Sharma', 'mohit@gmail.com', '$2y$10$892MQY42JlZkb/RoutS/yOWQnuJX8UxiEZOsHQdM.G7xf8iUm9YXm'),
(12, 'Jasprit Bumrah', 'bumrah@gmail.com', '$2y$10$xAktYpyXZMAiv4uDFcnlQ.4OA1f7mSLBuVqL5m1rd7Us7M45O9wCC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
