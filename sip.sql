/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 110003 (11.0.3-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : sip

 Target Server Type    : MariaDB
 Target Server Version : 110003 (11.0.3-MariaDB)
 File Encoding         : 65001

 Date: 02/02/2024 07:56:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for consultations
-- ----------------------------
DROP TABLE IF EXISTS `consultations`;
CREATE TABLE `consultations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `head` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `konsultan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of consultations
-- ----------------------------
INSERT INTO `consultations` VALUES (1, 1, '11,12', NULL, '2024-02-01 21:39:14', '2024-02-01 21:39:14');

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of districts
-- ----------------------------
INSERT INTO `districts` VALUES (1, 'Tegal Selatan', '2024-01-28 19:11:11', '2024-01-28 19:11:11');
INSERT INTO `districts` VALUES (3, 'Tegal Timur', '2024-01-28 19:13:10', '2024-01-28 19:13:10');
INSERT INTO `districts` VALUES (4, 'Tegal Barat', '2024-01-28 19:13:19', '2024-01-28 19:13:19');

-- ----------------------------
-- Table structure for documents
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `titles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` enum('surat','formulir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documents
-- ----------------------------
INSERT INTO `documents` VALUES (1, 'umum', 'Kelengkapan Dokumen', 'PEMBERITAHUAN HASIL VERIFIKASI KELENGKAPAN DOKUMEN', 'formulir', NULL, NULL, '2024-01-06 03:43:47', '2024-01-16 14:53:24');
INSERT INTO `documents` VALUES (5, 'Konsultasi Dokumen', NULL, 'konsultasi dokumen', 'surat', NULL, NULL, '2024-01-07 07:27:21', '2024-01-07 10:19:31');
INSERT INTO `documents` VALUES (9, 'menara', 'Kelengkapan Dokumen', 'PEMBERITAHUAN HASIL KOREKSI KELENGKAPAN DOKUMEN (MENARA)', 'formulir', NULL, NULL, '2024-01-16 14:50:27', '2024-01-16 14:53:37');
INSERT INTO `documents` VALUES (10, 'bak', NULL, 'BERITA ACARA KONSULTASI (BAK)', 'formulir', NULL, NULL, '2024-01-16 17:47:08', '2024-01-28 05:09:23');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for footers
-- ----------------------------
DROP TABLE IF EXISTS `footers`;
CREATE TABLE `footers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doc` bigint(20) NOT NULL,
  `item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of footers
-- ----------------------------
INSERT INTO `footers` VALUES (1, 1, '<p><em>Catatan :</em></p><p><em>*) Berlaku untuk :</em></p><ul><li><em>bangunan perumahan (yang disahkan oleh dinas terkait)</em></li><li><em>bangunan kolektif / kawasan (industri, wisata, dsb.)</em></li></ul><p><em>**) Berlaku untuk :</em></p><ul><li><em>bangunan diatas 2 lantai dan/atau memiliki basement</em></li><li><em>konstruksi baja dengan bentang lebih dari 15 meter</em></li></ul>', NULL, '2024-01-07 08:37:03', '2024-01-07 08:49:43');
INSERT INTO `footers` VALUES (2, 9, '<p>   </p>', NULL, '2024-01-16 15:08:07', '2024-01-16 16:22:35');

-- ----------------------------
-- Table structure for headers
-- ----------------------------
DROP TABLE IF EXISTS `headers`;
CREATE TABLE `headers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doc` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `item` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of headers
-- ----------------------------
INSERT INTO `headers` VALUES (1, 1, '[\"No. Registrasi\",\"Pengajuan\",\"Nama Pemohon\",\"No. Telp. \\/ HP\",\"Alamat Pemohon\",null,\"Nama Bangunan\",\"Fungsi\",\"Alamat Bangunan\"]', NULL, '2024-01-06 04:36:26', '2024-01-06 05:03:57');
INSERT INTO `headers` VALUES (4, 5, '[\"Perihal\",null,\"Nomor\"]', NULL, '2024-01-07 12:04:53', '2024-01-16 04:47:29');
INSERT INTO `headers` VALUES (5, 9, '[\"No. Registrasi\",\"Pengajuan\",\"Nama Pemohon\",\"No. Telp. \\/ HP\",\"Alamat Pemohon\",null,\"Nama Bangunan\",\"Kordinat\",\"Alamat Bangunan\"]', NULL, '2024-01-16 15:06:38', '2024-01-16 15:06:38');
INSERT INTO `headers` VALUES (6, 10, '[\"No. Registrasi\",\"Permohonan\",\"Nama Pemohon\",\"No. Telp.\\/HP\",\"Alamat Pemohon\",null,\"Nama Bangunan\",null,\"Alamat Bangunan\",null,\"Fungsi Bangunan\",null,\"Batas Lahan \\/ Lokasi\",\"Kondisi\",\"Tahun\",\"Tingkat Permanensi\",null]', NULL, '2024-01-16 17:50:25', '2024-01-16 17:50:25');

-- ----------------------------
-- Table structure for heads
-- ----------------------------
DROP TABLE IF EXISTS `heads`;
CREATE TABLE `heads`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) NULL DEFAULT NULL,
  `type` enum('menara','umum') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `grant` int(11) NOT NULL DEFAULT 0,
  `step` int(11) NOT NULL,
  `saran` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `header` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `verifikator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sekretariat` bigint(20) NULL DEFAULT NULL,
  `village` bigint(20) NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of heads
-- ----------------------------
INSERT INTO `heads` VALUES (1, '600.1.15/0000/SPm-SIMBG/II/2024', NULL, 'umum', 1, 1, 2, NULL, NULL, '[\"12345\",\"lainnya\",\"Bersama\",\"085640431190\",\"Alamat Pemohon\",\"Sekolah\",\"Pendidikan\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua\"]', '7,6', 2, 1, NULL, '2024-02-01 11:54:01', '2024-02-01 20:12:35');
INSERT INTO `heads` VALUES (2, '600.1.15/0001/SPm-SIMBG/II/2024', NULL, 'menara', 1, 0, 2, NULL, NULL, '[\"12345\",\"lainnya\",\"Bersama\",\"085640431190\",\"Alamat Pemohon\",\"Sekolah\",\"Pendidikan\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua\"]', '7,6', 2, 2, NULL, '2024-02-01 12:36:33', '2024-02-01 12:44:59');
INSERT INTO `heads` VALUES (3, '600.1.15/0002/SPm-SIMBG/II/2024', NULL, 'umum', 1, 0, 1, 'joss', NULL, '[\"54321\",\"slf\",\"Bersama\",\"085640431190\",\"Alamat Pemohon\",\"Sekolah\",\"Pendidikan\",\"Lorem ipsum dolor sit amet\"]', '5', 2, 1, '2024-02-01 20:16:31', '2024-02-01 12:54:50', '2024-02-01 20:16:31');
INSERT INTO `heads` VALUES (4, '600.1.15/0003/SPm-SIMBG/II/2024', NULL, 'menara', 1, 0, 1, 'yuhu', NULL, '[\"10012\",\"lainnya\",\"Indocal\",\"085640431190\",\"Alamat Pemohon\",\"Tower Radio\",\"Sinyal\",\"Alamat Bangunan\"]', '8', 2, 2, NULL, '2024-02-01 13:36:14', '2024-02-01 13:36:58');
INSERT INTO `heads` VALUES (5, '600.1.15/0004/SPm-SIMBG/II/2024', NULL, 'umum', 5, 0, 1, NULL, NULL, '[\"553353\",\"lainnya\",\"gas\",\"085640431122\",\"Alamat Pemohon\",\"Sekolah\",\"Pendidikan\",\"Alamat Bangunan\"]', '8', 2, 1, NULL, '2024-02-01 13:53:35', '2024-02-01 13:53:35');
INSERT INTO `heads` VALUES (6, '600.1.15/0005/SPm-SIMBG/II/2024', NULL, 'umum', 4, 0, 2, NULL, NULL, '[\"4325\",\"lainnya\",\"reju\",\"085640431120\",\"Alamat Pemohon\",\"Tower Radio\",\"Sinyal\",\"Lorem ipsum dolor sit amet\"]', '7,6', 2, 2, NULL, '2024-02-01 13:59:52', '2024-02-01 14:00:16');
INSERT INTO `heads` VALUES (7, '600.1.15/0002/SPm-SIMBG/II/2024', 3, 'umum', 5, 0, 1, NULL, NULL, '[\"54321\",\"slf\",\"Bersama\",\"085640431190\",\"Alamat Pemohon\",\"Sekolah\",\"Pendidikan\",\"Lorem ipsum dolor sit amet\"]', '5', 2, 1, NULL, '2024-02-01 20:16:31', '2024-02-01 20:16:31');

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `titles_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 'KTP / KITAS Pemohon dan Surat Kuasa (jika diwakilkan)', 1, NULL, '2024-01-06 05:17:51', '2024-01-06 05:17:51');
INSERT INTO `items` VALUES (2, 'Nomor Induk Berusaha (NIB)', 1, NULL, '2024-01-06 05:21:55', '2024-01-06 05:21:55');
INSERT INTO `items` VALUES (4, 'Dokumen Arsitektur', 2, NULL, '2024-01-06 05:57:21', '2024-01-06 05:57:21');
INSERT INTO `items` VALUES (5, 'Izin Mendirikan Bangunan Bangunan Eksisting (jika ada)', 4, NULL, '2024-01-06 05:57:51', '2024-01-06 05:57:51');
INSERT INTO `items` VALUES (6, 'Laporan Kelaikan Fungsi Bangunan Gedung / Daftar Simak', 4, NULL, '2024-01-06 05:58:06', '2024-01-06 05:58:06');
INSERT INTO `items` VALUES (7, 'Bukti Kepemilikan Tanah dan Ijin Pemanfaatan Tanah jika pemohon bukan pemilik tanah', 1, NULL, '2024-01-06 05:58:26', '2024-01-06 05:58:26');
INSERT INTO `items` VALUES (8, 'Bukti Lunas Pajak Bumi dan Bangunan', 1, NULL, '2024-01-06 05:59:45', '2024-01-06 05:59:45');
INSERT INTO `items` VALUES (9, 'Informasi Tata Ruang/ITR/IKPR dan/atau PKKPR', 1, NULL, '2024-01-06 05:59:58', '2024-01-06 05:59:58');
INSERT INTO `items` VALUES (10, 'Surat Keterangan Tanah tidak dalam sengketa yang diketahui oleh kepala desa / lurah', 1, NULL, '2024-01-06 06:00:11', '2024-01-06 06:00:11');
INSERT INTO `items` VALUES (11, 'Dokumen Lingkungan', 1, NULL, '2024-01-06 06:00:25', '2024-01-30 09:17:33');
INSERT INTO `items` VALUES (12, 'Dokumen Struktur', 2, NULL, '2024-01-06 06:00:51', '2024-01-06 06:00:51');
INSERT INTO `items` VALUES (13, 'Dokumen Utilitas', 2, NULL, '2024-01-06 06:01:03', '2024-01-06 06:01:03');
INSERT INTO `items` VALUES (14, 'Surat Pernyataan Laik Fungsi dari Pengkaji Teknis', 4, NULL, '2024-01-06 06:01:17', '2024-01-06 06:01:17');
INSERT INTO `items` VALUES (15, 'As-Build Drawing', 4, NULL, '2024-01-06 06:01:31', '2024-01-06 06:01:31');
INSERT INTO `items` VALUES (16, 'Data Pengkaji Teknis Bersertifikat (Perorangan/Badan Usaha)', 4, NULL, '2024-01-06 06:01:45', '2024-01-06 06:01:45');
INSERT INTO `items` VALUES (17, 'Dokumen pengujian atau perizinan lainnya yang diperlukan', 4, NULL, '2024-01-06 06:02:05', '2024-01-06 06:02:05');
INSERT INTO `items` VALUES (20, 'Nomor Induk Berusaha (NIB) beserta Akta Pendirian Perusahaan', 6, NULL, '2024-01-16 15:16:32', '2024-01-16 15:16:32');
INSERT INTO `items` VALUES (21, 'KTP / KITAS Pemohon', 6, NULL, '2024-01-16 15:16:44', '2024-01-16 15:16:44');
INSERT INTO `items` VALUES (22, 'Surat kuasa dari pemilik bangunan gedung (jika diwakilkan)', 6, NULL, '2024-01-16 15:41:42', '2024-01-16 15:41:42');
INSERT INTO `items` VALUES (23, 'NPWP Badan Usaha / Badan Hukum', 6, NULL, '2024-01-16 15:41:53', '2024-01-16 15:41:53');
INSERT INTO `items` VALUES (24, 'Informasi Kesesuaian Pemanfaatan Ruang/IKPR/PKKPR', 6, NULL, '2024-01-16 15:42:04', '2024-01-16 15:42:04');
INSERT INTO `items` VALUES (25, 'Dokumen Lingkungan (UKL-UPL/SPPL/AMDAL dan/atau ANDALALIN)', 6, NULL, '2024-01-16 15:42:16', '2024-01-16 15:42:16');
INSERT INTO `items` VALUES (26, 'Persetujuan warga sekitar dalam radius sesuai ketinggian Menara diketahui lurah/kepala desa dan camat setempat', 6, NULL, '2024-01-16 15:42:31', '2024-01-16 15:42:31');
INSERT INTO `items` VALUES (27, 'Bukti kepemilikan tanah dan perjanjian pemanfaatan tanah, serta bukti lunas PBB', 6, NULL, '2024-01-16 15:42:42', '2024-01-16 15:42:42');
INSERT INTO `items` VALUES (28, 'Surat penyataan tanah tidak dalam status sengketa yang diketahui kepala desa / lurah', 6, NULL, '2024-01-16 15:42:54', '2024-01-16 15:42:54');
INSERT INTO `items` VALUES (29, 'Rekomendasi dari instansi terkait  khusus untuk kawasan yang sifat dan peruntukannya memiliki karakteristik tertentu', 6, NULL, '2024-01-16 15:43:04', '2024-01-16 15:43:04');
INSERT INTO `items` VALUES (30, 'Izin Operasional Genset ke Kementerian ESDM (>500 KVa) atau Laporan Operasi Genset ke ESDM Provinsi Jawa Tengah (<500 KVa) (Apabila menggunakan Genset)', 6, NULL, '2024-01-16 15:43:17', '2024-01-16 15:43:17');
INSERT INTO `items` VALUES (31, 'Data Perencana Konstruksi dan Sertifikat Keahliannya', 6, NULL, '2024-01-16 15:43:29', '2024-01-16 15:43:29');
INSERT INTO `items` VALUES (32, 'Informasi rencana penggunaan menara bersama / tower', 6, NULL, '2024-01-16 15:43:39', '2024-01-16 15:43:39');
INSERT INTO `items` VALUES (33, 'Surat Perjanjian / kesepakatan bersama penggunaan menara bersama antara penyelenggara telekomunikasi / Pernyataan penggunaan menara bersama', 6, NULL, '2024-01-16 15:43:48', '2024-01-16 15:43:48');
INSERT INTO `items` VALUES (34, 'Bukti mengikuti Program Pertanggungjawaban / Asuransi terhadap kemungkinan kegagalan bangunan menara selama pemanfaatan menara', 6, NULL, '2024-01-16 15:43:59', '2024-01-16 15:43:59');
INSERT INTO `items` VALUES (35, 'Surat Pernyataan untuk:', 6, NULL, '2024-01-16 15:44:09', '2024-01-16 15:44:09');
INSERT INTO `items` VALUES (36, 'Dokumen Teknis', 7, NULL, '2024-01-16 15:44:22', '2024-01-16 15:44:22');
INSERT INTO `items` VALUES (37, 'Proteksi Petir dan Perijinannya', 7, NULL, '2024-01-16 15:44:32', '2024-01-16 15:44:32');
INSERT INTO `items` VALUES (38, 'Data kelengkapan sarana pendukung (Catu daya, lampu halangan penerbangan, lampu marka penerbangan, pagar pengaman dan akses lokasi)', 7, NULL, '2024-01-16 15:44:42', '2024-01-16 15:44:42');

-- ----------------------------
-- Table structure for letters
-- ----------------------------
DROP TABLE IF EXISTS `letters`;
CREATE TABLE `letters`  (
  `id` bigint(20) NOT NULL,
  `doc` bigint(20) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `titles` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of letters
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (5, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (6, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_12_30_080245_create_roles_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_12_30_080252_create_permissions_table', 1);
INSERT INTO `migrations` VALUES (11, '2023_12_30_080617_create_role_permissions_table', 1);
INSERT INTO `migrations` VALUES (12, '2024_01_04_081115_create_formulirs_table', 2);
INSERT INTO `migrations` VALUES (13, '2024_01_04_082049_create_villages_table', 2);
INSERT INTO `migrations` VALUES (14, '2024_01_04_082057_create_districts_table', 2);
INSERT INTO `migrations` VALUES (15, '2024_01_04_084551_create_letters_table', 2);
INSERT INTO `migrations` VALUES (16, '2024_01_04_084602_create_documents_table', 2);
INSERT INTO `migrations` VALUES (17, '2024_01_05_225709_create_headers_table', 2);
INSERT INTO `migrations` VALUES (18, '2024_01_05_225810_create_items_table', 2);
INSERT INTO `migrations` VALUES (19, '2024_01_05_225818_create_subs_table', 2);
INSERT INTO `migrations` VALUES (20, '2024_01_05_225827_create_titles_table', 2);
INSERT INTO `migrations` VALUES (21, '2024_01_05_230045_create_documents_table', 3);
INSERT INTO `migrations` VALUES (22, '2024_01_06_093923_create_footers_table', 4);
INSERT INTO `migrations` VALUES (23, '2024_01_08_104552_create_pages_table', 5);
INSERT INTO `migrations` VALUES (24, '2024_01_28_084235_create_heads_table', 5);
INSERT INTO `migrations` VALUES (25, '2024_01_28_084806_create_verifications_table', 5);
INSERT INTO `migrations` VALUES (26, '2024_01_28_085151_create_steps_table', 5);
INSERT INTO `migrations` VALUES (27, '2024_01_28_085329_create_consultations_table', 6);
INSERT INTO `migrations` VALUES (28, '2024_02_01_214111_create_schedules_table', 7);

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'Master Surat', 'master_surat', NULL, '2024-01-03 06:45:12', '2024-01-07 11:01:45');
INSERT INTO `permissions` VALUES (2, 'Master Formulir', 'master_formulir', NULL, '2024-01-03 06:49:15', '2024-01-07 11:02:04');
INSERT INTO `permissions` VALUES (4, 'Master Role', 'role', NULL, '2024-01-04 04:55:56', '2024-01-04 05:19:19');
INSERT INTO `permissions` VALUES (5, 'Master', 'master', '2024-01-04 05:19:04', '2024-01-04 04:56:09', '2024-01-04 05:19:04');
INSERT INTO `permissions` VALUES (6, 'Master account', 'account', NULL, '2024-01-04 04:56:20', '2024-01-04 05:19:33');
INSERT INTO `permissions` VALUES (7, 'Master permission', 'permission', NULL, '2024-01-04 04:56:31', '2024-01-04 05:19:49');
INSERT INTO `permissions` VALUES (8, 'testu', 'testa', '2024-01-05 23:46:00', '2024-01-05 23:45:44', '2024-01-05 23:46:00');
INSERT INTO `permissions` VALUES (9, 'tersd', 'teste', '2024-01-07 09:26:40', '2024-01-07 09:25:46', '2024-01-07 09:26:40');
INSERT INTO `permissions` VALUES (10, 'Dokumen formulir', 'doc_formulir', NULL, '2024-01-07 11:02:49', '2024-01-07 11:03:57');
INSERT INTO `permissions` VALUES (11, 'Dokumen surat', 'doc_surat', NULL, '2024-01-07 11:03:46', '2024-01-07 11:03:46');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Super Admin', 'SU', '1, 2, 4, 6, 7', NULL, '2024-01-04 03:56:29', '2024-01-16 06:12:40');
INSERT INTO `roles` VALUES (2, 'Admin', 'ADM', '1, 2, 6', NULL, '2024-01-04 04:59:13', '2024-01-16 06:12:47');
INSERT INTO `roles` VALUES (3, 'Kepala Dinas', 'KD', '10, 11', NULL, '2024-01-05 20:13:13', '2024-01-16 06:13:30');
INSERT INTO `roles` VALUES (5, 'Kepala Bidang', 'KB', '10, 11', NULL, '2024-01-16 06:13:52', '2024-01-16 06:13:52');
INSERT INTO `roles` VALUES (6, 'Sub-Koordinator / Pengawas', 'SK', '10, 11', NULL, '2024-01-16 06:14:18', '2024-01-16 06:14:18');
INSERT INTO `roles` VALUES (7, 'Admin Sekretariat', 'AS', '10, 11', NULL, '2024-01-16 06:14:35', '2024-01-16 06:14:35');
INSERT INTO `roles` VALUES (8, 'Operator Sekretariat', 'OS', '1, 2', NULL, '2024-01-16 06:14:57', '2024-02-01 20:46:56');
INSERT INTO `roles` VALUES (9, 'Verifikator Level 1', 'VL1', '10, 11', NULL, '2024-01-16 06:15:23', '2024-01-29 18:29:14');
INSERT INTO `roles` VALUES (10, 'Verifikator Level 2', 'VL2', '10, 11', NULL, '2024-01-16 06:16:46', '2024-01-29 18:27:53');
INSERT INTO `roles` VALUES (11, 'Verifikator Level 3', 'VL3', '10, 11', NULL, '2024-01-16 06:18:04', '2024-01-29 18:27:58');
INSERT INTO `roles` VALUES (12, 'Tim Penilai Teknis (TPT)', 'TPT', '10, 11', NULL, '2024-01-16 06:18:22', '2024-01-16 06:18:22');
INSERT INTO `roles` VALUES (13, 'Tim Profesi Ahli (TPA)', 'TPA', '10, 11', NULL, '2024-01-16 06:19:05', '2024-01-16 06:19:05');

-- ----------------------------
-- Table structure for schedules
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `head` bigint(20) NULL DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedules
-- ----------------------------

-- ----------------------------
-- Table structure for steps
-- ----------------------------
DROP TABLE IF EXISTS `steps`;
CREATE TABLE `steps`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `head` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `other` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of steps
-- ----------------------------
INSERT INTO `steps` VALUES (1, 1, 'VL3', '{\"dokumen_administrasi\":{\"item\":{\"1\":\"1\",\"2\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\"},\"saranItem\":{\"1\":null,\"2\":null,\"7\":null,\"8\":null,\"9\":null,\"10\":null},\"sub\":[{\"title\":11,\"value\":{\"43\":\"1\",\"44\":\"1\"},\"saran\":{\"43\":null,\"44\":null}}]}}', NULL, '2024-02-01 12:20:27', '2024-02-01 12:20:27');
INSERT INTO `steps` VALUES (2, 1, 'VL2', '{\"dokumen_teknis\":{\"sub\":[{\"title\":4,\"value\":{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":12,\"value\":{\"11\":\"1\",\"14\":\"1\",\"15\":\"1\",\"45\":\"1\",\"46\":\"1\",\"47\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":13,\"value\":{\"16\":\"1\",\"17\":\"1\",\"18\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}}]}}', NULL, '2024-02-01 12:31:24', '2024-02-01 12:31:24');
INSERT INTO `steps` VALUES (3, 2, 'VL2', '{\"dokumen_teknis\":{\"sub\":[{\"title\":36,\"value\":{\"40\":\"1\",\"41\":\"1\",\"42\":\"1\"},\"saran\":{\"40\":null,\"41\":null,\"42\":null}}]}}', NULL, '2024-02-01 12:37:13', '2024-02-01 12:37:13');
INSERT INTO `steps` VALUES (4, 2, 'VL3', '{\"dokumen_administrasi\":{\"item\":{\"20\":\"1\",\"21\":\"1\",\"22\":\"1\",\"23\":\"1\",\"24\":\"1\",\"25\":\"1\",\"26\":\"1\",\"27\":\"1\",\"28\":\"1\",\"29\":\"1\",\"30\":\"1\",\"31\":\"1\",\"32\":\"1\",\"33\":\"1\",\"34\":\"1\"},\"saranItem\":{\"20\":null,\"21\":null,\"22\":null,\"23\":null,\"24\":null,\"25\":null,\"26\":null,\"27\":null,\"28\":null,\"29\":null,\"30\":null,\"31\":null,\"32\":null,\"33\":null,\"34\":null},\"sub\":[{\"title\":35,\"value\":{\"36\":\"1\",\"37\":\"1\",\"38\":\"1\",\"39\":\"1\"},\"saran\":{\"36\":null,\"37\":null,\"38\":null,\"39\":null}}]}}', NULL, '2024-02-01 12:44:59', '2024-02-01 12:44:59');
INSERT INTO `steps` VALUES (6, 3, 'VL1', '{\"dokumen_pendukung_lainnya\":{\"item\":{\"5\":\"2\",\"6\":\"2\",\"14\":\"2\",\"15\":\"2\",\"16\":\"2\"},\"saranItem\":{\"5\":null,\"6\":null,\"14\":null,\"15\":null,\"16\":null},\"sub\":[{\"title\":17,\"value\":{\"19\":\"2\",\"20\":\"2\",\"21\":\"2\",\"22\":\"2\",\"23\":\"2\",\"24\":\"2\",\"25\":\"2\",\"26\":\"2\",\"27\":\"2\",\"28\":\"2\",\"29\":\"2\",\"30\":\"2\",\"31\":\"2\",\"32\":\"2\",\"33\":\"2\"},\"saran\":{\"19\":null,\"20\":null,\"21\":null,\"22\":null,\"23\":null,\"24\":null,\"25\":null,\"26\":null,\"27\":null,\"28\":null,\"29\":null,\"30\":null,\"31\":null,\"32\":null,\"33\":null}}]},\"dokumen_teknis\":{\"sub\":[{\"title\":4,\"value\":{\"1\":\"1\",\"2\":\"1\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":12,\"value\":{\"11\":\"0\",\"14\":\"0\",\"15\":\"0\",\"45\":\"0\",\"46\":\"0\",\"47\":\"0\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":13,\"value\":{\"16\":\"0\",\"17\":\"0\",\"18\":\"0\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}}]},\"dokumen_administrasi\":{\"item\":{\"1\":\"1\",\"2\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\"},\"saranItem\":{\"1\":null,\"2\":null,\"7\":null,\"8\":null,\"9\":null,\"10\":null},\"sub\":[{\"title\":11,\"value\":{\"43\":\"1\",\"44\":\"1\"},\"saran\":{\"43\":null,\"44\":null}}]}}', NULL, '2024-02-01 12:57:57', '2024-02-01 13:11:32');
INSERT INTO `steps` VALUES (7, 4, 'VL1', '{\"persyaratan_teknis\":{\"item\":{\"37\":\"1\",\"38\":\"1\"},\"saranItem\":{\"37\":null,\"38\":null},\"sub\":[{\"title\":36,\"value\":{\"40\":\"1\",\"41\":\"1\",\"42\":\"1\"},\"saran\":{\"40\":null,\"41\":null,\"42\":null}}]},\"dokumen_administrasi\":{\"item\":{\"20\":\"1\",\"21\":\"1\",\"22\":\"0\",\"23\":\"0\",\"24\":\"0\",\"25\":\"0\",\"26\":\"1\",\"27\":\"0\",\"28\":\"0\",\"29\":\"0\",\"30\":\"1\",\"31\":\"0\",\"32\":\"0\",\"33\":\"0\",\"34\":\"1\"},\"saranItem\":{\"20\":null,\"21\":null,\"22\":null,\"23\":null,\"24\":null,\"25\":null,\"26\":null,\"27\":null,\"28\":null,\"29\":null,\"30\":null,\"31\":null,\"32\":null,\"33\":null,\"34\":null},\"sub\":[{\"title\":35,\"value\":{\"36\":\"1\",\"37\":\"1\",\"38\":\"1\",\"39\":\"1\"},\"saran\":{\"36\":null,\"37\":null,\"38\":null,\"39\":null}}]}}', NULL, '2024-02-01 13:36:45', '2024-02-01 13:36:58');
INSERT INTO `steps` VALUES (8, 6, 'VL2', '{\"dokumen_teknis\":{\"sub\":[{\"title\":4,\"value\":{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":12,\"value\":{\"11\":\"1\",\"14\":\"1\",\"15\":\"1\",\"45\":\"1\",\"46\":\"1\",\"47\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}},{\"title\":13,\"value\":{\"16\":\"1\",\"17\":\"1\",\"18\":\"1\"},\"saran\":{\"1\":null,\"2\":null,\"3\":null,\"4\":null,\"5\":null,\"6\":null,\"7\":null,\"11\":null,\"14\":null,\"15\":null,\"45\":null,\"46\":null,\"47\":null,\"16\":null,\"17\":null,\"18\":null}}]}}', NULL, '2024-02-01 14:00:16', '2024-02-01 14:00:16');

-- ----------------------------
-- Table structure for subs
-- ----------------------------
DROP TABLE IF EXISTS `subs`;
CREATE TABLE `subs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `items_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subs
-- ----------------------------
INSERT INTO `subs` VALUES (1, 'Gambar situasi / Denah lokasi', 4, NULL, '2024-01-06 06:07:59', '2024-01-06 06:07:59');
INSERT INTO `subs` VALUES (2, 'Denah bangunan (termasuk basement jika ada)', 4, NULL, '2024-01-06 07:46:08', '2024-01-06 07:46:08');
INSERT INTO `subs` VALUES (3, 'Tampak depan dan samping (kanan-kiri) Bangunan', 4, NULL, '2024-01-06 07:51:51', '2024-01-06 07:51:51');
INSERT INTO `subs` VALUES (4, 'Potongan melintang dan membujur', 4, NULL, '2024-01-06 07:52:07', '2024-01-06 07:52:07');
INSERT INTO `subs` VALUES (5, 'Siteplan / masterplan', 4, NULL, '2024-01-06 07:52:23', '2024-01-06 07:52:23');
INSERT INTO `subs` VALUES (6, 'Denah / lokasi resapan, fasum, fasos, dan RTH *)', 4, NULL, '2024-01-06 07:53:02', '2024-01-30 16:45:59');
INSERT INTO `subs` VALUES (7, 'Denah dan detail jalan dan drainase *)', 4, NULL, '2024-01-06 07:53:16', '2024-01-30 16:46:13');
INSERT INTO `subs` VALUES (11, 'Denah dan detail pondasi', 12, NULL, '2024-01-06 07:54:27', '2024-01-30 16:55:50');
INSERT INTO `subs` VALUES (14, 'Denah dan detail penulangan (sloof, kolom, balok, dll)', 12, NULL, '2024-01-06 07:56:23', '2024-01-30 16:56:23');
INSERT INTO `subs` VALUES (15, 'Denah dan detail atap / kuda-kuda', 12, NULL, '2024-01-06 07:57:12', '2024-01-30 16:57:03');
INSERT INTO `subs` VALUES (16, 'Denah instalasi listrik (saklar, lampu, stopkontak, dll)', 13, NULL, '2024-01-06 07:57:27', '2024-01-06 07:57:27');
INSERT INTO `subs` VALUES (17, 'Denah instalasi air bersih dan kotor', 13, NULL, '2024-01-06 07:57:41', '2024-01-06 07:57:41');
INSERT INTO `subs` VALUES (18, 'Denah instalasi proteksi petir (jika ada)', 13, NULL, '2024-01-06 07:57:53', '2024-01-06 07:57:53');
INSERT INTO `subs` VALUES (19, 'SLO & NIDI Listrik', 17, NULL, '2024-01-06 07:58:27', '2024-01-06 07:58:27');
INSERT INTO `subs` VALUES (20, 'Persetujuan Teknis BMAL/IPAL', 17, NULL, '2024-01-06 07:58:55', '2024-01-06 07:58:55');
INSERT INTO `subs` VALUES (21, 'Persetujuan Studi Kelayakan Air Tanah', 17, NULL, '2024-01-06 08:01:10', '2024-01-06 08:01:10');
INSERT INTO `subs` VALUES (22, 'Pemeriksaan/Pengujian Penyalur Petir', 17, NULL, '2024-01-06 08:01:22', '2024-01-06 08:01:22');
INSERT INTO `subs` VALUES (23, 'Pemeriksaan/Pengujian Genset', 17, NULL, '2024-01-06 08:01:51', '2024-01-06 08:01:51');
INSERT INTO `subs` VALUES (24, 'Pemeriksaan/Pengujian Instalasi Listrik', 17, NULL, '2024-01-06 08:02:04', '2024-01-06 08:02:04');
INSERT INTO `subs` VALUES (25, 'Pemeriksaan/Pengujian Proteksi Kebakaran, APAR', 17, NULL, '2024-01-06 08:02:16', '2024-01-06 08:02:16');
INSERT INTO `subs` VALUES (26, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Fire Alarm', 17, NULL, '2024-01-06 08:02:29', '2024-01-06 08:02:29');
INSERT INTO `subs` VALUES (27, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Hydrant', 17, NULL, '2024-01-06 08:02:40', '2024-01-06 08:02:40');
INSERT INTO `subs` VALUES (28, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Sprlinker', 17, NULL, '2024-01-06 08:02:51', '2024-01-06 08:02:51');
INSERT INTO `subs` VALUES (29, 'Pemeriksaan/Pengujian Lift', 17, NULL, '2024-01-06 08:03:01', '2024-01-06 08:03:01');
INSERT INTO `subs` VALUES (30, 'Pemeriksaan/Pengujian Air Bersih, Pencahayaan, Kebisingan, dan Kualitas Udara', 17, NULL, '2024-01-06 08:03:14', '2024-01-06 08:03:14');
INSERT INTO `subs` VALUES (31, 'Pemeriksaan/Pengujian Beton', 17, NULL, '2024-01-06 08:03:29', '2024-01-06 08:03:29');
INSERT INTO `subs` VALUES (32, 'Pemeriksaan/Pengujian Radiasi', 17, NULL, '2024-01-06 08:03:40', '2024-01-06 08:03:40');
INSERT INTO `subs` VALUES (33, 'Pengelolaan Limbah (B3/Domestik/dll)', 17, NULL, '2024-01-06 08:03:54', '2024-01-06 08:03:54');
INSERT INTO `subs` VALUES (36, 'Mematuhi ketentuan dalam keterangan rencana kegiatan', 35, NULL, '2024-01-16 15:45:55', '2024-01-16 15:45:55');
INSERT INTO `subs` VALUES (37, 'Menggunakan pelaksana konstruksi', 35, NULL, '2024-01-16 15:46:15', '2024-01-16 15:46:15');
INSERT INTO `subs` VALUES (38, 'Menggunakan pengawas/MK bersertifikat', 35, NULL, '2024-01-16 15:46:33', '2024-01-16 15:46:33');
INSERT INTO `subs` VALUES (39, 'Kesanggupan pembongkaran jika telah habis masa sewa dan tidak dipergunakan', 35, NULL, '2024-01-16 15:47:22', '2024-01-16 15:47:22');
INSERT INTO `subs` VALUES (40, 'Denah, Tampak, Potongan', 36, NULL, '2024-01-16 15:47:45', '2024-01-16 15:47:45');
INSERT INTO `subs` VALUES (41, 'Denah dan Detail Pondasi beserta Perhitungan Struktur (meliputi pembebanan beban tetap, angin, gempa, dan kapasitas maksimum menara)', 36, NULL, '2024-01-16 15:48:38', '2024-01-16 15:48:38');
INSERT INTO `subs` VALUES (42, 'Data Penyelidikan Tanah / Geoteknik', 36, NULL, '2024-01-16 15:49:05', '2024-01-16 15:49:05');
INSERT INTO `subs` VALUES (43, 'SPPL/UKL-UPL/AMDAL', 11, NULL, '2024-01-30 09:18:03', '2024-01-30 09:18:03');
INSERT INTO `subs` VALUES (44, 'ANDALALIN', 11, NULL, '2024-01-30 09:18:23', '2024-01-30 09:18:23');
INSERT INTO `subs` VALUES (45, 'Denah dan detail tangga (untuk bangunan 2 lantai/lebih)', 12, NULL, '2024-01-30 16:57:25', '2024-01-30 16:57:25');
INSERT INTO `subs` VALUES (46, 'Data penyelidikan tanah **)', 12, NULL, '2024-01-30 16:57:51', '2024-01-30 16:57:51');
INSERT INTO `subs` VALUES (47, 'Perhitungan struktur **)', 12, NULL, '2024-01-30 16:58:14', '2024-01-30 16:58:14');

-- ----------------------------
-- Table structure for titles
-- ----------------------------
DROP TABLE IF EXISTS `titles`;
CREATE TABLE `titles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of titles
-- ----------------------------
INSERT INTO `titles` VALUES (1, 'Dokumen Administrasi', 1, NULL, '2024-01-06 04:52:56', '2024-01-06 04:59:21');
INSERT INTO `titles` VALUES (2, 'Dokumen Teknis', 1, NULL, '2024-01-06 04:59:32', '2024-01-06 04:59:32');
INSERT INTO `titles` VALUES (4, 'Dokumen Pendukung Lainnya (Untuk SLF)', 1, NULL, '2024-01-06 05:00:55', '2024-01-06 05:00:55');
INSERT INTO `titles` VALUES (6, 'Dokumen Administrasi', 9, NULL, '2024-01-16 15:09:53', '2024-01-16 15:16:06');
INSERT INTO `titles` VALUES (7, 'Persyaratan Teknis', 9, NULL, '2024-01-16 15:10:10', '2024-01-16 15:10:10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` bigint(20) NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'root', 'root@mail.com', 1, NULL, '$2y$10$WcjCnxaSI3XC.S6pAM/4ae.sbkJRjgikfHKFtFWVJadmPU/WtZvB.', NULL, '2024-01-04 05:08:12', '2024-01-04 05:08:12', NULL);
INSERT INTO `users` VALUES (2, 'admin', 'admin@mail.com', 2, NULL, '$2y$10$6tTzG.trRA7fOMCMximYSuicJZUlwRCZcL2F8X20wj7fmfIEsj9Zm', NULL, '2024-01-04 05:09:37', '2024-01-04 05:09:37', NULL);
INSERT INTO `users` VALUES (3, 'Jhon', 'jhon@mail.com', 3, NULL, '$2y$10$wkx/ftc/xtS0fSM0iPcAze2gMzHPUyKzzKmsgz9mYu2k8luVGW4Y6', NULL, '2024-01-05 20:14:11', '2024-01-05 23:42:32', NULL);
INSERT INTO `users` VALUES (4, 'deva', 'fa@dec.com', 3, NULL, '$2y$10$qJUTyFcrSTZrYERlXXEee.rcd8P8VwXgm5Lz.Nc50o/UbfUA8GMpy', NULL, '2024-01-07 09:27:38', '2024-01-07 09:27:47', '2024-01-07 09:27:47');
INSERT INTO `users` VALUES (5, 'one', 'verif@satu.com', 9, NULL, '$2y$10$vx6JydFoIr89cNvOj3aidOxT14jsUulvKLGZXJmsXIpYAAwDO5GRe', NULL, '2024-01-29 18:31:05', '2024-01-29 18:42:13', NULL);
INSERT INTO `users` VALUES (6, 'dua', 'verif@dua.com', 10, NULL, '$2y$10$N5ZSmNKQFj049hx3SnpIruk8Vp07ZPtOzeLqgzWZTi9dn.CL.7M9y', NULL, '2024-01-29 18:31:35', '2024-01-29 18:42:22', NULL);
INSERT INTO `users` VALUES (7, 'tiga', 'verif@tiga.com', 11, NULL, '$2y$10$buoQYBLIqPTuSrAgmLnB1uyQh0CXfPnkpkG37Tz/VTydM.YQbNmKG', NULL, '2024-01-29 18:32:13', '2024-01-29 18:42:29', NULL);
INSERT INTO `users` VALUES (8, 'wahid', 'wahid@satu.com', 9, NULL, '$2y$10$pJ6Ev9WLwYXuWY4.9NBM8ezSeggjSYbIcOVMPjks4qGXoUAkDkrq2', NULL, '2024-01-29 18:46:35', '2024-01-29 18:46:35', NULL);
INSERT INTO `users` VALUES (9, 'second', 'second@dua.com', 10, NULL, '$2y$10$0HaHo7WyBeWnXV2gmZ.Sx.yxg0VJX92OxvgLZxI02Y.n.KAl59wPG', NULL, '2024-01-29 19:05:36', '2024-01-29 19:05:36', NULL);
INSERT INTO `users` VALUES (10, 'operator', 'operator@mail.com', 8, NULL, '$2y$10$XiTZu6FCxHZoEyjqz1z5DOIB0lEXF6WJWyqPdsx/qu500cvbdGgRy', NULL, '2024-02-01 20:47:59', '2024-02-01 20:47:59', NULL);
INSERT INTO `users` VALUES (11, 'Darso', 'faisol.ajifa@gmail.com', 12, NULL, '$2y$10$yAj7jQd/a0Tq/NFn4sdeY.034NjlxxBe7QIMYumWXu56NaGuExHVG', NULL, '2024-02-01 20:55:29', '2024-02-01 21:21:01', NULL);
INSERT INTO `users` VALUES (12, 'QQ', 'codeqlab@gmail.com', 13, NULL, '$2y$10$6n2fG9DAEQFElBAjWzIEIuP/bAKN11VflHv0dXORV2ddR3WuVbqte', NULL, '2024-02-01 20:55:52', '2024-02-01 21:21:28', NULL);

-- ----------------------------
-- Table structure for verifications
-- ----------------------------
DROP TABLE IF EXISTS `verifications`;
CREATE TABLE `verifications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `head` bigint(20) NULL DEFAULT NULL,
  `step_id` bigint(20) NULL DEFAULT NULL,
  `tahap` enum('satu','dua') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `item` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`item`)),
  `other` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`other`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of verifications
-- ----------------------------

-- ----------------------------
-- Table structure for villages
-- ----------------------------
DROP TABLE IF EXISTS `villages`;
CREATE TABLE `villages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `districts_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of villages
-- ----------------------------
INSERT INTO `villages` VALUES (1, 4, 'Kaligangsa', '2024-01-28 19:22:33', '2024-01-28 19:29:48');
INSERT INTO `villages` VALUES (2, 3, 'Martoloyo', '2024-01-28 19:30:03', '2024-01-28 19:30:09');

SET FOREIGN_KEY_CHECKS = 1;
