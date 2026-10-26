-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_perpustakaan
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_perpustakaan`;

-- Dumping structure for table db_perpustakaan.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isbn` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `penulis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `penerbit` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `bahasa_buku` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sinopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `format_buku` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi_rak` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `kondisi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_perpustakaan.buku: ~5 rows (approximately)
INSERT INTO `buku` (`id`, `isbn`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `kategori`, `bahasa_buku`, `sinopsis`, `format_buku`, `lokasi_rak`, `stok`, `kondisi`) VALUES
	(1, '9781421519111', 'Vagabond Vol. 1', 'Takehiko Inoue', 'VIZ Media', '2007', 'Komik/Manga', 'English', 'Manga yang mengisahkan perjalanan Shinmen Takezo yang kemudian dikenal sebagai Miyamoto Musashi dalam perjalanan menjadi seorang pendekar besar.', 'Cetak', 'A-01', 3, 'Baik'),
	(2, '9781035072378', 'The Metamorphosis', 'Franz Kafka', 'Macmillan Collector\'s Library', '2026', 'Novel', 'English', 'Kisah Gregor Samsa yang terbangun dan mendapati dirinya telah berubah menjadi makhluk menyerupai serangga, yang kemudian mengubah hubungannya dengan keluarga dan kehidupannya.', 'Cetak', 'B-01', 4, 'Sangat Baik'),
	(3, '9781421506791', 'Slam Dunk Vol. 1', 'Takehiko Inoue', 'VIZ Media', '2008', 'Komik/Manga', 'English', 'Kisah Hanamichi Sakuragi yang awalnya tidak memiliki ketertarikan pada basket, tetapi kemudian mengenal olahraga tersebut dan mulai mengubah kehidupannya.', 'Cetak', 'A-02', 5, 'Baik'),
	(4, '9786026208941', 'Norwegian Wood', 'Haruki Murakami', 'Kepustakaan Populer Gramedia', '2013', 'Novel', 'Indonesia', 'Novel yang mengikuti kisah Toru Watanabe dan kenangannya tentang cinta, persahabatan, kehilangan, serta kehidupan masa mudanya di Tokyo.', 'Cetak', 'B-02', 3, 'Baik'),
	(5, '9789797562984', 'Menciptakan Strategi Keunggulan Bersaing Perguruan Tinggi', 'Eddy Soeryanto Soegoto', 'Graha Ilmu', '2008', 'Pendidikan', 'Indonesia', 'Buku yang membahas strategi dan pengelolaan perguruan tinggi untuk menghadapi persaingan serta meningkatkan keunggulan institusi pendidikan tinggi.', 'Cetak', 'C-01', 2, 'Sangat Baik');

-- Dumping structure for table db_perpustakaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_perpustakaan.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `nama`) VALUES
	(1, 'admin', 'admin123', 'Feryl Alfaro');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
