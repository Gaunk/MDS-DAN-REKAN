-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 06:48 AM
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
-- Database: `kantor_hukum`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(13, 'kjkj', 'pengacara@yahoo.com', 'llkl', 'okokoko', '2025-11-30 17:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_dokumen_perkara`
--

CREATE TABLE `tabel_dokumen_perkara` (
  `id` int(11) NOT NULL,
  `id_perkara` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(300) NOT NULL,
  `kategori` enum('gugatan','jawaban','pembuktian','surat_kuasa','lainnya','pjh') DEFAULT 'lainnya',
  `diunggah_oleh` int(11) DEFAULT NULL,
  `diunggah_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_dokumen_perkara`
--

INSERT INTO `tabel_dokumen_perkara` (`id`, `id_perkara`, `nama_file`, `path_file`, `kategori`, `diunggah_oleh`, `diunggah_pada`) VALUES
(7, 14, 'SKK', 'uploads/dokumen/1764586253_ca2facc2a2f2816d39fe.pdf', 'surat_kuasa', 1, '2025-12-01 03:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_honorarium`
--

CREATE TABLE `tabel_honorarium` (
  `id` int(11) NOT NULL,
  `id_pengacara` int(11) NOT NULL,
  `nama_pengacara` varchar(200) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `status` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_honorarium`
--

INSERT INTO `tabel_honorarium` (`id`, `id_pengacara`, `nama_pengacara`, `jumlah`, `status`, `keterangan`, `created_at`) VALUES
(1, 6, 'Muhammad Idris Saefaturahnmah,S.H', 200000000, 'Belum Lunas', 'awe', '2025-12-01 08:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_izin_peran`
--

CREATE TABLE `tabel_izin_peran` (
  `id` int(11) NOT NULL,
  `id_peran` int(11) DEFAULT NULL,
  `izin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jadwal`
--

CREATE TABLE `tabel_jadwal` (
  `id` int(11) NOT NULL,
  `nama_klien` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status_reminder` enum('Belum','Terkirim') DEFAULT 'Belum',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jadwal_pertemuan`
--

CREATE TABLE `tabel_jadwal_pertemuan` (
  `id` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tanggal_waktu` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_jadwal_pertemuan`
--

INSERT INTO `tabel_jadwal_pertemuan` (`id`, `id_klien`, `id_pengguna`, `tanggal_waktu`, `waktu`, `lokasi`, `catatan`, `dibuat_pada`, `update_at`) VALUES
(12, 2, 6, '2025-11-20', '22:40:00', 'citahenga', 'kjkjkj', '2025-11-30 08:36:54', '2025-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jadwal_sidang`
--

CREATE TABLE `tabel_jadwal_sidang` (
  `id` int(11) NOT NULL,
  `id_perkara` int(11) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jenis_perkara`
--

CREATE TABLE `tabel_jenis_perkara` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_jenis_perkara`
--

INSERT INTO `tabel_jenis_perkara` (`id`, `nama_jenis`) VALUES
(1, 'Pidana Umum'),
(2, 'Pencurian'),
(3, 'Penganiayaan'),
(4, 'Penipuan'),
(5, 'Penggelapan'),
(6, 'Perjudian'),
(7, 'Pembunuhan'),
(8, 'Pemerasan'),
(9, 'Pengrusakan Barang'),
(10, 'Pelecehan Seksual'),
(11, 'Pemerkosaan'),
(12, 'Pengancaman'),
(13, 'KDRT (Kekerasan Dalam Rumah Tangga)'),
(14, 'Penculikan'),
(15, 'Pidana Khusus'),
(16, 'Narkotika'),
(17, 'Psikotropika'),
(18, 'Cyber Crime'),
(19, 'Money Laundering (TPPU)'),
(20, 'Terorisme'),
(21, 'TPPO (Perdagangan Orang)'),
(22, 'Illegal Logging'),
(23, 'Illegal Fishing'),
(24, 'Pelanggaran HAM Berat'),
(25, 'Tipikor (Tindak Pidana Korupsi)'),
(26, 'Gratifikasi'),
(27, 'Suap/Menyuap'),
(28, 'Penyalahgunaan Wewenang'),
(29, 'Mark Up Anggaran'),
(30, 'Perdata Umum'),
(31, 'Wanprestasi'),
(32, 'Perbuatan Melawan Hukum (PMH)'),
(33, 'Sengketa Tanah'),
(34, 'Sengketa Kontrak'),
(35, 'Sengketa Utang Piutang'),
(36, 'Perdata Khusus'),
(37, 'Kepailitan'),
(38, 'PKPU (Penundaan Kewajiban Pembayaran Utang)'),
(39, 'Sengketa Konsumen'),
(40, 'Sengketa Perbankan'),
(41, 'Sengketa Asuransi'),
(42, 'Perkara Agama'),
(43, 'Perceraian'),
(44, 'Hak Asuh Anak'),
(45, 'Waris'),
(46, 'Itsbat Nikah'),
(47, 'Harta Gono Gini'),
(48, 'Nafkah Anak'),
(49, 'Dispensasi Nikah'),
(50, 'Tata Usaha Negara'),
(51, 'Sengketa Keputusan Pemerintah'),
(52, 'Sengketa Izin Usaha'),
(53, 'Sengketa Kepegawaian ASN'),
(54, 'Sengketa Pemilu/Pilkada'),
(55, 'Sengketa Pajak'),
(56, 'Hukum Ketenagakerjaan'),
(57, 'Pemutusan Hubungan Kerja (PHK)'),
(58, 'Upah/Gaji'),
(59, 'Sengketa Serikat Pekerja'),
(60, 'Sengketa Keselamatan Kerja'),
(61, 'Perkara Militer'),
(62, 'Disiplin Militer'),
(63, 'Tindak Pidana Militer'),
(64, 'Pelanggaran Kode Etik TNI'),
(65, 'Perkara Anak'),
(66, 'Diversi Anak'),
(67, 'Pidana Anak'),
(68, 'Perlindungan Anak'),
(69, 'Hukum Niaga'),
(70, 'Sengketa Franchise'),
(71, 'Sengketa Waralaba'),
(72, 'Sengketa Investasi'),
(73, 'Sengketa Perusahaan'),
(74, 'Hukum Perbankan'),
(75, 'Hukum Asuransi'),
(76, 'Fintech / Pinjol'),
(77, 'Sengketa Kartu Kredit'),
(78, 'Imigrasi'),
(79, 'Deportasi'),
(80, 'Pelanggaran Visa'),
(81, 'Kewarganegaraan'),
(82, 'Pajak'),
(83, 'Bea Cukai'),
(84, 'Penyelundupan Barang'),
(85, 'Sengketa Aset'),
(86, 'Sengketa Properti'),
(87, 'Sengketa Lingkungan'),
(88, 'Sengketa Hibah'),
(89, 'Sengketa Warisan Non Agama'),
(90, 'Sengketa Organisasi/Lembaga'),
(91, 'Sengketa Pemilik Saham');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jurusan_hukum`
--

CREATE TABLE `tabel_jurusan_hukum` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_jurusan_hukum`
--

INSERT INTO `tabel_jurusan_hukum` (`id`, `nama_jurusan`) VALUES
(1, 'Hukum Perdata'),
(2, 'Hukum Pidana'),
(3, 'Hukum Tata Negara'),
(4, 'Hukum Internasional'),
(5, 'Hukum Ekonomi'),
(6, 'Hukum Administrasi Negara'),
(7, 'Hukum Agraria'),
(8, 'Hukum Lingkungan'),
(9, 'Hukum Administrasi Bisnis'),
(10, 'Hukum Ketenagakerjaan'),
(11, 'Hukum Perbankan & Keuangan'),
(12, 'Hukum Pajak'),
(13, 'Hukum Militer'),
(14, 'Hukum Kesehatan'),
(15, 'Hukum Telekomunikasi & IT'),
(16, 'Hukum Hak Kekayaan Intelektual'),
(17, 'Hukum Perusahaan'),
(18, 'Hukum Perdata Internasional'),
(19, 'Hukum Konstitusi'),
(20, 'Hukum Perdagangan'),
(21, 'Hukum Maritim'),
(22, 'Hukum Transportasi'),
(23, 'Hukum Properti'),
(24, 'Hukum Agraria Internasional'),
(25, 'Hukum Perkebunan'),
(26, 'Hukum Minyak & Gas'),
(27, 'Hukum Pertambangan'),
(28, 'Hukum Lingkungan Internasional'),
(29, 'Hukum Kepailitan'),
(30, 'Hukum Konsumen');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kasus`
--

CREATE TABLE `tabel_kasus` (
  `id` int(11) NOT NULL,
  `nama_kasus` varchar(150) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_klien`
--

CREATE TABLE `tabel_klien` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `id_pengacara` int(11) UNSIGNED DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_klien`
--

INSERT INTO `tabel_klien` (`id`, `nama`, `alamat`, `telepon`, `email`, `id_pengacara`, `catatan`, `dibuat_pada`) VALUES
(2, 'MUHIDIN', 'we', '008080', 'aink@yahoo.com', 6, 'llkl', '2025-11-23 21:43:54'),
(13, 'Gen', 'Tajurhalang', '081381988665', 'admin@example.com', 6, 'kookoko', '2025-12-01 08:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kwitansi`
--

CREATE TABLE `tabel_kwitansi` (
  `id` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `nomor_kwitansi` varchar(100) NOT NULL,
  `tanggal_kwitansi` date NOT NULL,
  `diterbitkan_oleh` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_log_aktivitas`
--

CREATE TABLE `tabel_log_aktivitas` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `aksi` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_notifikasi`
--

CREATE TABLE `tabel_notifikasi` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `sudah_dibaca` tinyint(1) DEFAULT 0,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pembayaran`
--

CREATE TABLE `tabel_pembayaran` (
  `id` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `metode_pembayaran` enum('Tunai','Transfer','Kartu Kredit') DEFAULT 'Transfer',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengacara`
--

CREATE TABLE `tabel_pengacara` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `nama_kampus` varchar(150) DEFAULT NULL,
  `peran` varchar(50) NOT NULL,
  `foto_pengacara` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_pengacara`
--

INSERT INTO `tabel_pengacara` (`id`, `nama`, `email`, `telepon`, `alamat`, `pendidikan`, `jurusan`, `nama_kampus`, `peran`, `foto_pengacara`, `created_at`, `updated_at`, `id_pengguna`) VALUES
(6, 'Muhammad Idris Saefaturahnmah,S.H', 'pengacara@yahoo.com', '089522191585', 'Panjeleran', 'S1', '1', 'STIS Darul Ulum Lampung Timur', '2', '1764593708_c65f577cdf0603d92a04.jpg', '2025-11-29 21:12:52', '2025-12-01 05:55:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengaturan_sistem`
--

CREATE TABLE `tabel_pengaturan_sistem` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `seo` text DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `maintenance` tinyint(1) DEFAULT 0,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diupdate_pada` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_pengaturan_sistem`
--

INSERT INTO `tabel_pengaturan_sistem` (`id`, `logo`, `nama_perusahaan`, `seo`, `keyword`, `copyright`, `maintenance`, `dibuat_pada`, `diupdate_pada`) VALUES
(1, '1764490878_62ea325ed6b585bf0a19.png', 'MDS & Rekan | Law Firm', 'MDS & Rekan adalah firma hukum yang berkomitmen memberikan layanan hukum terbaik melalui analisis mendalam, strategi efektif, dan penyelesaian masalah yang berorientasi pada hasil. Kami melayani urusan litigasi maupun non-litigasi, mencakup hukum bisnis, perdata, pidana, properti, perburuhan, dan berbagai kebutuhan hukum lainnya.', 'MDS dan Rekan, MDS Law Firm, pengacara Bogor, pengacara Cianjur, pengacara Bandung Barat, kantor hukum Bogor, kantor hukum Cianjur, advokat Bogor, advokat Cianjur, advokat Bandung Barat, jasa hukum Bogor, jasa hukum Cianjur, jasa hukum Bandung Barat, legal consultant Bogor, legal consultant Cianjur, legal consultant Bandung Barat, pengacara perdata Bogor, pengacara pidana Cianjur, corporate lawyer Bandung Barat', '2023 @ Copyright MDS Dan Rekan Law Firm', 0, '2025-11-30 07:26:39', '2025-11-30 10:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengeluaran_uang`
--

CREATE TABLE `tabel_pengeluaran_uang` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `kategori` enum('Pembelian','Transport','Honorarium','Operasional','Lain-lain') NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `id_pengacara` int(11) UNSIGNED DEFAULT NULL,
  `id_perkara` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengguna`
--

CREATE TABLE `tabel_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `peran` varchar(60) NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `tema` enum('light','dark') NOT NULL DEFAULT 'light',
  `pesan` text DEFAULT NULL,
  `notifikasi_email` tinyint(1) NOT NULL DEFAULT 1,
  `diupdate_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_pengguna`
--

INSERT INTO `tabel_pengguna` (`id`, `username`, `kata_sandi`, `email`, `peran`, `dibuat_pada`, `tema`, `pesan`, `notifikasi_email`, `diupdate_pada`) VALUES
(1, 'admin', '$2y$10$vTFEraCRhfAzL0yjviuxb.fWkZwV.YAFeTIkar2enOvirBAZeHHoC', 'admin@example.com', 'admin', '2025-11-28 01:11:23', 'light', 'Silahkan yang kang kalau mau di update ', 1, '2025-11-30 07:10:59'),
(2, 'budi1', '$2y$10$KaqHRnIL1uqm0Cj/SE2RaedG5.hZTxtm/VG.go9QCvGJY1TlkjXu.', 'budi@example.com', 'pengacara', '2025-11-28 01:11:23', 'light', NULL, 1, NULL),
(3, 'andi1', '$2y$10$wVMBaT6bV3nfdWB2OVpOIO4QbzXZ76gV7DIYwG1i1dnN2LI0r2yD2', 'andi@example.com', 'pengacara', '2025-11-28 01:11:23', 'light', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pengguna_peran`
--

CREATE TABLE `tabel_pengguna_peran` (
  `id` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_peran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_peran`
--

CREATE TABLE `tabel_peran` (
  `id` int(11) NOT NULL,
  `nama_peran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_peran`
--

INSERT INTO `tabel_peran` (`id`, `nama_peran`) VALUES
(1, 'admin'),
(3, 'paralegal'),
(2, 'pengacara'),
(4, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_perkara`
--

CREATE TABLE `tabel_perkara` (
  `id` int(11) NOT NULL,
  `nomor_perkara` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_pengacara` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `jenis_kasus` varchar(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_perkara`
--

INSERT INTO `tabel_perkara` (`id`, `nomor_perkara`, `judul`, `id_klien`, `id_pengacara`, `status`, `jenis_kasus`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `dibuat_pada`) VALUES
(14, '1/MDS/SKK/XII/2025', 'Pengancaman ', 2, 6, '1', '8', 'Pertemuan dengan klien', '2025-12-12', '0000-00-00', '2025-12-01 05:12:25'),
(15, '2/MDS/SKK/XII/2025', 'Pecabulan', 13, NULL, '23', '11', 'Tahap pengembangan', '2025-12-01', '0000-00-00', '2025-12-01 08:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_status_perkara`
--

CREATE TABLE `tabel_status_perkara` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_status_perkara`
--

INSERT INTO `tabel_status_perkara` (`id`, `nama_status`) VALUES
(1, 'Laporan / Registrasi'),
(2, 'Penyidikan / Mediasi'),
(3, 'Sidang Pertama'),
(4, 'Sidang Lanjutan'),
(5, 'Putusan'),
(6, 'Eksekusi'),
(7, 'Banding'),
(8, 'Kasasi'),
(9, 'Selesai'),
(10, 'Pendaftaran Perkara'),
(11, 'Proses Pemeriksaan Awal'),
(12, 'Sidang Pertama'),
(13, 'Sidang Lanjutan'),
(14, 'Mediasi'),
(15, 'Proses Pembuktian'),
(16, 'Putusan Pengadilan Tingkat Pertama'),
(17, 'Banding'),
(18, 'Kasasi'),
(19, 'Peninjauan Kembali'),
(20, 'Eksekusi Putusan'),
(21, 'Dihentikan Sementara'),
(22, 'Dihentikan Permanen'),
(23, 'Ditunda'),
(24, 'Belum Terdaftar'),
(25, 'Selesai'),
(26, 'Permohonan Peninjauan'),
(27, 'Pengembalian Berkas'),
(28, 'Menunggu Jadwal Sidang'),
(29, 'Menunggu Putusan'),
(30, 'Dalam Negosiasi'),
(31, 'Dalam Arbitrase'),
(32, 'Proses Gugatan'),
(33, 'Proses Jawaban'),
(34, 'Proses Replik'),
(35, 'Proses Duplik'),
(36, 'Permohonan Perbaikan Putusan');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_surat_kuasa`
--

CREATE TABLE `tabel_surat_kuasa` (
  `id` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `ttl` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `penerima` text DEFAULT NULL,
  `alamat_kantor` text DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_perkara` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_surat_kuasa`
--

INSERT INTO `tabel_surat_kuasa` (`id`, `id_klien`, `nik`, `ttl`, `jenis_kelamin`, `pekerjaan`, `alamat`, `penerima`, `alamat_kantor`, `updated_at`, `id_perkara`, `deskripsi`, `tanggal`, `created_at`) VALUES
(8, 2, '21123123123123', 'bogor, 09 cianjur 2029', 'Laki-laki', 'pemulung', 'sadas', 'awe', 'asdas', '2025-12-02', 14, 'lp', '2025-12-01', '2025-12-01 16:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tagihan`
--

CREATE TABLE `tabel_tagihan` (
  `id` int(11) NOT NULL,
  `id_klien` int(11) NOT NULL,
  `id_perkara` int(11) DEFAULT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `tanggal_terbit` date DEFAULT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_tagihan`
--

INSERT INTO `tabel_tagihan` (`id`, `id_klien`, `id_perkara`, `jumlah`, `deskripsi`, `status`, `tanggal_terbit`, `tanggal_jatuh_tempo`, `dibuat_pada`) VALUES
(2, 2, 14, 10000000.00, 'Dicicil', NULL, '2025-12-01', '2025-12-24', '2025-11-30 23:56:35'),
(3, 13, 15, 14900000.00, 'dicicil', 'Belum Lunas', '2025-12-01', '2025-12-31', '2025-12-01 01:21:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_dokumen_perkara`
--
ALTER TABLE `tabel_dokumen_perkara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perkara` (`id_perkara`),
  ADD KEY `diunggah_oleh` (`diunggah_oleh`);

--
-- Indexes for table `tabel_honorarium`
--
ALTER TABLE `tabel_honorarium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_izin_peran`
--
ALTER TABLE `tabel_izin_peran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peran` (`id_peran`);

--
-- Indexes for table `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_jadwal_pertemuan`
--
ALTER TABLE `tabel_jadwal_pertemuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klien` (`id_klien`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tabel_jadwal_sidang`
--
ALTER TABLE `tabel_jadwal_sidang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perkara` (`id_perkara`);

--
-- Indexes for table `tabel_jenis_perkara`
--
ALTER TABLE `tabel_jenis_perkara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_jurusan_hukum`
--
ALTER TABLE `tabel_jurusan_hukum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_kasus`
--
ALTER TABLE `tabel_kasus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_klien`
--
ALTER TABLE `tabel_klien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_klien_pengacara` (`id_pengacara`);

--
-- Indexes for table `tabel_kwitansi`
--
ALTER TABLE `tabel_kwitansi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tabel_log_aktivitas`
--
ALTER TABLE `tabel_log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tabel_notifikasi`
--
ALTER TABLE `tabel_notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tabel_pembayaran`
--
ALTER TABLE `tabel_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indexes for table `tabel_pengacara`
--
ALTER TABLE `tabel_pengacara`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tabel_pengaturan_sistem`
--
ALTER TABLE `tabel_pengaturan_sistem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pengeluaran_uang`
--
ALTER TABLE `tabel_pengeluaran_uang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_pengguna_peran`
--
ALTER TABLE `tabel_pengguna_peran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_peran` (`id_peran`);

--
-- Indexes for table `tabel_peran`
--
ALTER TABLE `tabel_peran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_peran` (`nama_peran`);

--
-- Indexes for table `tabel_perkara`
--
ALTER TABLE `tabel_perkara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klien` (`id_klien`),
  ADD KEY `id_pengacara` (`id_pengacara`);

--
-- Indexes for table `tabel_status_perkara`
--
ALTER TABLE `tabel_status_perkara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_surat_kuasa`
--
ALTER TABLE `tabel_surat_kuasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_tagihan`
--
ALTER TABLE `tabel_tagihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klien` (`id_klien`),
  ADD KEY `id_perkara` (`id_perkara`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tabel_dokumen_perkara`
--
ALTER TABLE `tabel_dokumen_perkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tabel_honorarium`
--
ALTER TABLE `tabel_honorarium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_izin_peran`
--
ALTER TABLE `tabel_izin_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_jadwal`
--
ALTER TABLE `tabel_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_jadwal_pertemuan`
--
ALTER TABLE `tabel_jadwal_pertemuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tabel_jadwal_sidang`
--
ALTER TABLE `tabel_jadwal_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_jenis_perkara`
--
ALTER TABLE `tabel_jenis_perkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tabel_jurusan_hukum`
--
ALTER TABLE `tabel_jurusan_hukum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tabel_kasus`
--
ALTER TABLE `tabel_kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_klien`
--
ALTER TABLE `tabel_klien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tabel_kwitansi`
--
ALTER TABLE `tabel_kwitansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_log_aktivitas`
--
ALTER TABLE `tabel_log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_notifikasi`
--
ALTER TABLE `tabel_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_pembayaran`
--
ALTER TABLE `tabel_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tabel_pengacara`
--
ALTER TABLE `tabel_pengacara`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_pengaturan_sistem`
--
ALTER TABLE `tabel_pengaturan_sistem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_pengeluaran_uang`
--
ALTER TABLE `tabel_pengeluaran_uang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_pengguna`
--
ALTER TABLE `tabel_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tabel_pengguna_peran`
--
ALTER TABLE `tabel_pengguna_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tabel_peran`
--
ALTER TABLE `tabel_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tabel_perkara`
--
ALTER TABLE `tabel_perkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tabel_status_perkara`
--
ALTER TABLE `tabel_status_perkara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tabel_surat_kuasa`
--
ALTER TABLE `tabel_surat_kuasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tabel_tagihan`
--
ALTER TABLE `tabel_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_dokumen_perkara`
--
ALTER TABLE `tabel_dokumen_perkara`
  ADD CONSTRAINT `tabel_dokumen_perkara_ibfk_1` FOREIGN KEY (`id_perkara`) REFERENCES `tabel_perkara` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabel_dokumen_perkara_ibfk_2` FOREIGN KEY (`diunggah_oleh`) REFERENCES `tabel_pengguna` (`id`);

--
-- Constraints for table `tabel_izin_peran`
--
ALTER TABLE `tabel_izin_peran`
  ADD CONSTRAINT `tabel_izin_peran_ibfk_1` FOREIGN KEY (`id_peran`) REFERENCES `tabel_peran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_jadwal_pertemuan`
--
ALTER TABLE `tabel_jadwal_pertemuan`
  ADD CONSTRAINT `tabel_jadwal_pertemuan_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `tabel_klien` (`id`);

--
-- Constraints for table `tabel_jadwal_sidang`
--
ALTER TABLE `tabel_jadwal_sidang`
  ADD CONSTRAINT `tabel_jadwal_sidang_ibfk_1` FOREIGN KEY (`id_perkara`) REFERENCES `tabel_perkara` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_klien`
--
ALTER TABLE `tabel_klien`
  ADD CONSTRAINT `fk_klien_pengacara` FOREIGN KEY (`id_pengacara`) REFERENCES `tabel_pengacara` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tabel_kwitansi`
--
ALTER TABLE `tabel_kwitansi`
  ADD CONSTRAINT `tabel_kwitansi_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `tabel_pembayaran` (`id`);

--
-- Constraints for table `tabel_log_aktivitas`
--
ALTER TABLE `tabel_log_aktivitas`
  ADD CONSTRAINT `tabel_log_aktivitas_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tabel_pengguna` (`id`);

--
-- Constraints for table `tabel_notifikasi`
--
ALTER TABLE `tabel_notifikasi`
  ADD CONSTRAINT `tabel_notifikasi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tabel_pengguna` (`id`);

--
-- Constraints for table `tabel_pembayaran`
--
ALTER TABLE `tabel_pembayaran`
  ADD CONSTRAINT `tabel_pembayaran_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tabel_tagihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_pengguna_peran`
--
ALTER TABLE `tabel_pengguna_peran`
  ADD CONSTRAINT `tabel_pengguna_peran_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tabel_pengguna` (`id`),
  ADD CONSTRAINT `tabel_pengguna_peran_ibfk_2` FOREIGN KEY (`id_peran`) REFERENCES `tabel_peran` (`id`);

--
-- Constraints for table `tabel_perkara`
--
ALTER TABLE `tabel_perkara`
  ADD CONSTRAINT `tabel_perkara_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `tabel_klien` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabel_tagihan`
--
ALTER TABLE `tabel_tagihan`
  ADD CONSTRAINT `tabel_tagihan_ibfk_1` FOREIGN KEY (`id_klien`) REFERENCES `tabel_klien` (`id`),
  ADD CONSTRAINT `tabel_tagihan_ibfk_2` FOREIGN KEY (`id_perkara`) REFERENCES `tabel_perkara` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
