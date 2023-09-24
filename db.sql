/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 8.0.30 : Database - appz1286_app-barang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`appz1286_app-barang` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `appz1286_app-barang`;

/*Table structure for table `t_barang` */

DROP TABLE IF EXISTS `t_barang`;

CREATE TABLE `t_barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_satuan` bigint DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stok_barang` double DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_barang` */

insert  into `t_barang`(`id`,`id_satuan`,`nama_barang`,`stok_barang`,`created_at`,`updated_at`) values 
(6,15,'Laptop',96,'2023-09-07 10:55:46','2023-09-16 13:05:13'),
(7,14,'Tinta Printer',0,'2023-09-07 10:55:55',NULL),
(8,15,'Komputer',5,'2023-09-16 12:52:41',NULL);

/*Table structure for table `t_detail_permohonan_barang` */

DROP TABLE IF EXISTS `t_detail_permohonan_barang`;

CREATE TABLE `t_detail_permohonan_barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_master` bigint DEFAULT NULL,
  `id_jns_barang` bigint DEFAULT NULL,
  `jml_barang` double DEFAULT NULL,
  `jml_barang_approve` double DEFAULT '0',
  `sts_approval` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `catatan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_detail_permohonan_barang` */

insert  into `t_detail_permohonan_barang`(`id`,`id_master`,`id_jns_barang`,`jml_barang`,`jml_barang_approve`,`sts_approval`,`catatan`,`created_at`,`updated_at`) values 
(1,12,6,100,0,'0',NULL,'2023-09-19 15:12:32',NULL),
(2,12,7,90,0,'0',NULL,'2023-09-19 15:12:32',NULL),
(3,12,6,8,0,'0',NULL,'2023-09-19 15:12:32',NULL),
(4,13,6,5,5,'1','okeeh','2023-09-20 08:51:12',NULL),
(5,13,7,5,5,'2','rwtgedrgd','2023-09-20 08:51:12',NULL),
(6,14,6,5,5,'1','ok','2023-09-21 13:30:57',NULL),
(7,14,7,3,0,'2','Tolak','2023-09-21 13:30:57',NULL),
(8,14,8,8,4,'1','ok','2023-09-21 13:30:57',NULL);

/*Table structure for table `t_faktur` */

DROP TABLE IF EXISTS `t_faktur`;

CREATE TABLE `t_faktur` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `total_transaksi` double DEFAULT NULL,
  `dok_faktur` varchar(255) DEFAULT NULL,
  `dok_spm` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_faktur` */

insert  into `t_faktur`(`id`,`no_faktur`,`tgl_faktur`,`total_transaksi`,`dok_faktur`,`dok_spm`,`created_at`,`updated_at`) values 
(7,'Data-1','2023-09-01',NULL,'C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen Faktru/upload_time_2023-09-20_1695196904.pdf','C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen SPM/upload_time_2023-09-20_1695196904.pdf','2023-09-20 08:01:44',NULL),
(8,'Data - 2','2023-09-02',NULL,'C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen Faktru/upload_time_2023-09-20_1695196983.pdf','C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen SPM/upload_time_2023-09-20_1695196983.pdf','2023-09-20 08:03:03',NULL),
(9,'ABDXR890','2023-09-22',NULL,'C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen Faktru/upload_time_2023-09-21_1695302926.pdf','C:/laragon/www/app-barang/assets/upload Dokumen Input Barang/gudang/Dokumen SPM/upload_time_2023-09-21_1695302926.pdf','2023-09-21 13:28:46',NULL);

/*Table structure for table `t_kondisi_barang` */

DROP TABLE IF EXISTS `t_kondisi_barang`;

CREATE TABLE `t_kondisi_barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kondisi_barang` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_kondisi_barang` */

insert  into `t_kondisi_barang`(`id`,`kondisi_barang`,`created_at`,`updated_at`) values 
(1,'Baik','2023-09-07 11:33:59',NULL),
(2,'Rusak','2023-09-07 11:34:07',NULL),
(3,'Rusak Berat','2023-09-07 11:35:31',NULL);

/*Table structure for table `t_master_permohonan_barang` */

DROP TABLE IF EXISTS `t_master_permohonan_barang`;

CREATE TABLE `t_master_permohonan_barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username_pemohon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `path_permohonanBarang` varchar(255) DEFAULT NULL,
  `path_bast` varchar(255) DEFAULT NULL,
  `status_review` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_master_permohonan_barang` */

insert  into `t_master_permohonan_barang`(`id`,`username_pemohon`,`tgl_pengajuan`,`path_permohonanBarang`,`path_bast`,`status_review`,`created_at`,`updated_at`) values 
(12,'pic','2023-09-19','C:/laragon/www/app-barang/assets/upload Dokumen Permintaan Barang/pic/upload_time_2023-09-19_1695136352.pdf',NULL,'0','2023-09-19 15:12:32',NULL),
(13,'pic','2023-09-20','C:/laragon/www/app-barang/assets/upload Dokumen Permintaan Barang/pic/upload_time_2023-09-20_1695199872.pdf','C:/laragon/www/app-barang/assets/upload Dokumen BAST/upload_time_2023-09-24_1695529776.pdf','1','2023-09-20 08:51:12',NULL),
(14,'pic','2023-09-21','C:/laragon/www/app-barang/assets/upload Dokumen Permintaan Barang/pic/upload_time_2023-09-21_1695303057.pdf',NULL,'1','2023-09-21 13:30:57',NULL);

/*Table structure for table `t_satuan` */

DROP TABLE IF EXISTS `t_satuan`;

CREATE TABLE `t_satuan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_satuan` */

insert  into `t_satuan`(`id`,`nama_satuan`,`created_at`,`updated_at`) values 
(13,'Box','2023-09-06 02:58:44',NULL),
(14,'Dus','2023-09-06 02:59:01',NULL),
(15,'Unit','2023-09-06 03:36:56',NULL);

/*Table structure for table `t_stok_barang` */

DROP TABLE IF EXISTS `t_stok_barang`;

CREATE TABLE `t_stok_barang` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_kategori_barang` bigint DEFAULT NULL,
  `id_kondisi_barang` bigint DEFAULT NULL,
  `id_faktur` bigint DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `terpakai` varchar(10) DEFAULT '0',
  `tgl_terpakai` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_detail_barang_penggguna` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_stok_barang` */

insert  into `t_stok_barang`(`id`,`id_kategori_barang`,`id_kondisi_barang`,`id_faktur`,`nama_barang`,`harga_satuan`,`terpakai`,`tgl_terpakai`,`created_at`,`updated_at`,`id_detail_barang_penggguna`) values 
(251,6,1,7,'Laptop Toyiba',3000000,'1','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(252,6,1,7,'Laptop Toyiba',3000000,'1','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(253,6,1,7,'Laptop Toyiba',3000000,'1','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(254,6,1,7,'Laptop Toyiba',3000000,'1','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(255,6,1,7,'Laptop Toyiba',3000000,'1','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(256,7,1,7,'Laser JET A102',300000,'0','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(257,7,1,7,'Laser JET A102',300000,'0','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(258,7,1,7,'Laser JET A102',300000,'0','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(259,7,1,7,'Laser JET A102',300000,'0','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(260,7,1,7,'Laser JET A102',300000,'0','2023-09-20','2023-09-20 08:01:44',NULL,NULL),
(261,6,1,8,'Lenovo Deh',4000000,'1','2023-09-21','2023-09-20 08:03:03',NULL,NULL),
(262,6,1,8,'Lenovo Deh',4000000,'1','2023-09-21','2023-09-20 08:03:03',NULL,NULL),
(263,6,1,8,'Lenovo Deh',4000000,'1','2023-09-21','2023-09-20 08:03:03',NULL,NULL),
(264,6,1,8,'Lenovo Deh',4000000,'1','2023-09-21','2023-09-20 08:03:03',NULL,NULL),
(265,6,1,8,'Lenovo Deh',4000000,'1','2023-09-21','2023-09-20 08:03:03',NULL,NULL),
(266,7,1,8,'Tinta Oke deh',250000,'0','2023-09-20','2023-09-20 08:03:03',NULL,NULL),
(267,7,1,8,'Tinta Oke deh',250000,'0','2023-09-20','2023-09-20 08:03:03',NULL,NULL),
(268,7,1,8,'Tinta Oke deh',250000,'0','2023-09-20','2023-09-20 08:03:03',NULL,NULL),
(269,7,1,8,'Tinta Oke deh',250000,'0','2023-09-20','2023-09-20 08:03:03',NULL,NULL),
(270,7,1,8,'Tinta Oke deh',250000,'0','2023-09-20','2023-09-20 08:03:03',NULL,NULL),
(271,6,1,9,'Laptop Toyiba',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(272,6,1,9,'Laptop Toyiba',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(273,6,1,9,'Laptop Toyiba',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(274,6,1,9,'Laptop Toyiba',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(275,6,1,9,'Laptop Toyiba',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(276,7,1,9,'Tinta Oke deh',650000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(277,7,1,9,'Tinta Oke deh',650000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(278,7,1,9,'Tinta Oke deh',650000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(279,7,1,9,'Tinta Oke deh',650000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(280,7,1,9,'Tinta Oke deh',650000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL),
(281,8,1,9,'Lenovo Deh',8000000,'1','2023-09-21','2023-09-21 13:28:46',NULL,NULL),
(282,8,1,9,'Lenovo Deh',8000000,'1','2023-09-21','2023-09-21 13:28:46',NULL,NULL),
(283,8,1,9,'Lenovo Deh',8000000,'1','2023-09-21','2023-09-21 13:28:46',NULL,NULL),
(284,8,1,9,'Lenovo Deh',8000000,'1','2023-09-21','2023-09-21 13:28:46',NULL,NULL),
(285,8,1,9,'Lenovo Deh',8000000,'0',NULL,'2023-09-21 13:28:46',NULL,NULL);

/*Table structure for table `t_sts_approval` */

DROP TABLE IF EXISTS `t_sts_approval`;

CREATE TABLE `t_sts_approval` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_sts_approval` */

insert  into `t_sts_approval`(`id`,`nama_status`,`created_at`,`updated_at`) values 
(1,'Panding','2023-09-09 18:16:56',NULL),
(2,'Approve','2023-09-09 18:16:59',NULL),
(3,'Reject','2023-09-09 18:17:07',NULL);

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_roll` bigint DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_user` */

insert  into `t_user`(`id`,`id_roll`,`nama`,`email`,`username`,`password`,`created_at`,`updated_at`) values 
(1,1,'Admin','admin@mail.com','admin','admin4123','2023-09-05 10:59:30',NULL),
(2,3,'subag','subag@mail.com','subag','subag','2023-09-11 05:39:55',NULL),
(3,4,'Petugas Gudang','gudang@mail.com','gudang','gudang','2023-09-12 14:19:01',NULL),
(4,5,'PIC Subbag TU','pic@gmail.com','pic','pic','2023-09-12 14:22:23',NULL);

/*Table structure for table `t_user_roll` */

DROP TABLE IF EXISTS `t_user_roll`;

CREATE TABLE `t_user_roll` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nama_rool` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `t_user_roll` */

insert  into `t_user_roll`(`id`,`nama_rool`,`created_at`,`updated_at`) values 
(1,'Admin','2023-09-05 10:58:03',NULL),
(3,'Subag TU','2023-09-11 05:34:00',NULL),
(4,'Petugas Gudang','2023-09-12 15:27:33',NULL),
(5,'PIC Subagg TU','2023-09-09 17:46:22',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
