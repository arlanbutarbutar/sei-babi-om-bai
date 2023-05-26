-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Bulan Mei 2023 pada 04.38
-- Versi server: 10.3.38-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhdbfgel_100131`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `tanggal_publikasi` date NOT NULL DEFAULT current_timestamp(),
  `penulis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id_contact`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(4, 'Erin Paulander Otemusu', 'erinpaulander2506@gmail.com', 'Coba', 'Hallo', '2023-05-09 01:24:53', '2023-05-09 01:24:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `image`) VALUES
(4, 'http://127.0.0.1:1010/apps/sei-babi-om-bai/assets/images/gallery/623374299.png'),
(5, 'http://127.0.0.1:1010/apps/sei-babi-om-bai/assets/images/gallery/556180812.jpg'),
(6, 'http://127.0.0.1:1010/apps/sei-babi-om-bai/assets/images/gallery/481614208.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `satuan` varchar(5) NOT NULL DEFAULT 'Kg',
  `nama_makanan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_status`, `image`, `satuan`, `nama_makanan`, `deskripsi`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(4, 2, 'http://erin.tugasakhir.my.id/assets/images/menu/3790922102.jpg', 'Kg', 'Daging Sei Babi', 'Daging Sei Kiloan', 250000, 739, '2023-03-18 15:27:18', '2023-05-16 16:34:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_ditempat`
--

CREATE TABLE `menu_ditempat` (
  `id_menu_ditempat` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nama_menu` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_ditempat`
--

INSERT INTO `menu_ditempat` (`id_menu_ditempat`, `image`, `nama_menu`, `deskripsi`, `created_at`, `updated_at`) VALUES
(6, 'http://erin.tugasakhir.my.id/assets/images/menu/2047055446.jpg', 'Sambal Luat', 'Sambal luat khas daging sei gratis sepaket dengan pesanan anda', '2023-05-09 10:10:12', '2023-05-09 11:46:13'),
(7, 'http://erin.tugasakhir.my.id/assets/images/menu/1705320713.jpg', 'Nasi Putih Dan Lauk Tambahan', 'Tersedia juga nasi putih dengan lauk tambahan ada bermacam macam dengan harga disesuaikan ditempat', '2023-05-09 11:42:40', '2023-05-09 11:42:40'),
(8, 'http://erin.tugasakhir.my.id/assets/images/menu/3843803272.jpg', 'Rusuk Babi', 'Salah satu menu ditempat yaitu rusuk babi yang bisa dipesan ditempat dan dinikmati bersama', '2023-05-22 10:47:42', '2023-05-22 10:47:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_status`
--

CREATE TABLE `menu_status` (
  `id_status` int(11) NOT NULL,
  `status_menu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_status`
--

INSERT INTO `menu_status` (`id_status`, `status_menu`) VALUES
(1, 'Draft'),
(2, 'Publik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_pemesanan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `alamat_pengirim` text NOT NULL,
  `totalberat` int(11) NOT NULL,
  `provinsi` varchar(225) NOT NULL,
  `distrik` varchar(225) NOT NULL,
  `tipe` varchar(225) NOT NULL,
  `kodepos` varchar(225) NOT NULL,
  `ekspedisi` varchar(225) NOT NULL,
  `paket` varchar(225) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_pemesanan`, `id_ongkir`, `alamat_pengirim`, `totalberat`, `provinsi`, `distrik`, `tipe`, `kodepos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`) VALUES
(1, 34, 'Jln W.J Lalamentik No.95', 2000, 'Nusa Tenggara Timur (NTT)', 'Kupang', 'Kota', '85119', 'jne', 'CTC', 22000, '1-2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_order` varchar(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_order`, `id_menu`, `id_user`, `id_status`, `nama`, `alamat`, `jumlah`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 'XNSG70R68C', 4, 4, 3, 'Arlan Butar Butar', 'Jln W.J Lalamentik No.95', 2, 250000, 544000, '2023-05-27 04:29:29', '2023-05-27 04:29:29');

--
-- Trigger `pemesanan`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER UPDATE ON `pemesanan` FOR EACH ROW BEGIN
	UPDATE menu SET stok = stok-NEW.jumlah WHERE id_menu=NEW.id_menu;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_status`
--

CREATE TABLE `pemesanan_status` (
  `id_status` int(11) NOT NULL,
  `status_pemesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan_status`
--

INSERT INTO `pemesanan_status` (`id_status`, `status_pemesanan`) VALUES
(1, 'Belum Dibayar'),
(2, 'Pending'),
(3, 'Sudah Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ui_about`
--

CREATE TABLE `ui_about` (
  `id_about` int(11) NOT NULL,
  `about_us` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ui_about`
--

INSERT INTO `ui_about` (`id_about`, `about_us`) VALUES
(1, '<p>Sei Babi Om Ba&#39;i merupakan salah satu kuliner khas dari Kelurahan Teunbaun Kecamatan Amarasi Barat Kabupaten Kupang yang sangat terkenal di Nusa Tenggara Timur. Sei Babi merupakan makanan yang terbuat dari daging babi yang diolah dengan bumbu-bumbu khas daerah tersebut.</p>\r\n\r\n<p>Ketika memasuki Kota Kupang, aroma harum dari Sei Babi sudah dapat tercium dari kejauhan. Sei Babi biasanya dihidangkan dengan nasi putih, sambal dan sayuran segar. Rasanya yang gurih dan sedikit pedas membuat Sei Babi menjadi makanan yang sangat disukai oleh masyarakat setempat maupun wisatawan yang berkunjung ke Kota Kupang.</p>\r\n\r\n<p>Selain sebagai kuliner khas, Sei Babi juga memiliki nilai historis yang cukup tinggi. Konon, Sei Babi sudah ada sejak zaman kolonial Belanda dan menjadi salah satu makanan favorit mereka. Hingga saat ini, Sei Babi masih menjadi bagian dari kekayaan kuliner Kota Kupang yang harus dicicipi oleh siapa saja yang berkunjung ke daerah ini.</p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT 3,
  `id_status` int(2) NOT NULL DEFAULT 2,
  `en_user` varchar(35) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `telp` char(12) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_status`, `en_user`, `username`, `email`, `password`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '', '', '2023-03-04 12:05:48', '2023-03-04 12:05:48'),
(4, 3, 1, '1816629146', 'Arlan Butar Butar', 'arlan270899@gmail.com', '$2y$10$QFev3HqaaQQsZjqswkEzYuzSqp.mcQ9GAOv9W9tSgCpd8A07EXDaa', '08113827421', 'Jln W.J Lalamentik No.95', '2023-03-15 11:16:47', '2023-05-09 09:59:18'),
(7, 3, 1, '2274407099', 'Erin Paulander Otemusu', 'erinotemusu2506@gmail.com', '$2y$10$oAMRtIvq1RkXSxII4Bq/O.qHMrj6eID6Rg1qogZm/fEvhjsLdC3OC', '085337026271', 'Kupang', '2023-05-08 23:21:11', '2023-05-08 23:21:11'),
(8, 2, 1, '2384472697', 'Erin Otemusu', 'erinpaulander2506@gmail.com', '$2y$10$NkB5HUMJm5QeQFkOoU/IW.8NGyy/2EKOg9miafHt9xplZjKcXwG7C', '081936980859', 'Kupang', '2023-05-09 11:33:17', '2023-05-09 11:34:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Owner'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_status`
--

CREATE TABLE `users_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_status`
--

INSERT INTO `users_status` (`id_status`, `status`) VALUES
(1, 'Aktif'),
(2, 'Belum Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `link_yt` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id_video`, `link_yt`) VALUES
(1, 'https://www.youtube.com/watch?v=1tZ5qrZ3_xU'),
(2, 'https://www.youtube.com/watch?v=_2mdc8R60u4'),
(4, 'https://www.youtube.com/watch?v=8ywuQKOKXP4'),
(5, 'https://www.youtube.com/watch?v=xUmwJMaE9S4'),
(6, 'https://www.youtube.com/watch?v=GjjzMY9J5Es'),
(7, 'https://www.youtube.com/watch?v=2E_lQjtfdfM');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `keranjang_ibfk_2` (`id_user`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `menu_ditempat`
--
ALTER TABLE `menu_ditempat`
  ADD PRIMARY KEY (`id_menu_ditempat`);

--
-- Indeks untuk tabel `menu_status`
--
ALTER TABLE `menu_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `pemesanan_status`
--
ALTER TABLE `pemesanan_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `ui_about`
--
ALTER TABLE `ui_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `menu_ditempat`
--
ALTER TABLE `menu_ditempat`
  MODIFY `id_menu_ditempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `menu_status`
--
ALTER TABLE `menu_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_status`
--
ALTER TABLE `pemesanan_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ui_about`
--
ALTER TABLE `ui_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_status`
--
ALTER TABLE `users_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `menu_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD CONSTRAINT `ongkir_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `pemesanan_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `users_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
