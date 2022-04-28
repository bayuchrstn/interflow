/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.1.31-MariaDB : Database - interflow
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`interflow` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `interflow`;

/*Table structure for table `admin_menu` */

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(50) DEFAULT NULL,
  `categories` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `order` int(2) DEFAULT '0',
  `flag` int(1) DEFAULT '0',
  `su_only` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `admin_menu` */

insert  into `admin_menu`(`id`,`parent`,`categories`,`name`,`url`,`icon`,`order`,`flag`,`su_only`) values 
(1,'0','','Dashboard','admin/Dashboard','icon-meter-fast',1,1,0),
(2,'0','Manage_user','Manajemen User','#','icon-people',2,1,0),
(4,'2','Manage_user','Super Admin','admin/Manage_user/Super_admin','flaticon2-hexagonal',2,1,0),
(5,'2','Manage_user','Agent','admin/Manage_user/Agent','flaticon2-hexagonal',4,1,0),
(6,'0','Manage_properti','Manajemen Properti','#','icon-home4',1,1,0),
(7,'6','Manage_properti','Properti','admin/Manage_properti','',2,1,0),
(8,'0','Master','Master','#','icon-stack2',4,1,0),
(9,'8','Master','Cabang','admin/Master/Cabang',NULL,1,1,0),
(10,'8','Master','Feature','admin/Master/Feature',NULL,2,1,0),
(11,'8','Master','Fasilitas','admin/Master/Fasilitas',NULL,3,1,0),
(12,'8','Master','Satuan','admin/Master/Satuan',NULL,4,1,0),
(13,'2','Manage_user','Admin Cabang','admin/Manage_user/Admin_cabang','flaticon2-hexagonal',3,1,0),
(14,'2','Manage_user','Premium Investor','admin/Manage_user/Premium_investor','flaticon2-hexagonal',4,1,0),
(15,'0','Manage_content','Manajemen Konten','#','icon-magazine',3,1,0),
(16,'15','Manage_content','Home Slider','admin/Manage_content/home_slider','',1,1,0),
(17,'15','Manage_content','About Us','admin/Manage_content/about_us','',2,1,0),
(18,'15','Manage_content','Contact Us','admin/Manage_content/contact_us','',3,1,0),
(19,'15','Manage_content','Developer','admin/Manage_content/developer','',4,1,0),
(20,'15','Manage_content','Partner','admin/Manage_content/partner','',5,1,0),
(21,'15','Manage_content','Gallery','admin/Manage_content/gallery','',6,1,0),
(22,'15','Manage_content','News','admin/Manage_content/news','',7,1,0),
(23,'15','Manage_content','Testimoni','admin/Manage_content/testimoni','',8,1,0),
(24,'15','Manage_content','Footer','admin/Manage_content/footer','',9,1,0),
(25,'15','Manage_content','Service','admin/Manage_content/service','',10,0,0),
(26,'15','Manage_content','','admin/Manage_content/','',11,0,0);

/*Table structure for table `detail_properti` */

DROP TABLE IF EXISTS `detail_properti`;

CREATE TABLE `detail_properti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_properti` */

/*Table structure for table `manage_properti` */

DROP TABLE IF EXISTS `manage_properti`;

CREATE TABLE `manage_properti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `pic` varchar(30) DEFAULT NULL,
  `harga_user` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `lang` varchar(22) DEFAULT NULL,
  `lat` varchar(22) DEFAULT NULL,
  `luas_bangunan` varchar(50) DEFAULT NULL,
  `luas_tanah` varchar(50) DEFAULT NULL,
  `legalitas` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `fasilitas` text,
  `status` int(1) DEFAULT '0' COMMENT '0: Proses, 1: Sudah Aktif (Setuju), 8: Tolak, 9: Tidak Aktif',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(10) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  `view` varchar(10) DEFAULT NULL,
  `id_komen` int(11) DEFAULT NULL,
  `note_approval` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `manage_properti` */

insert  into `manage_properti`(`id`,`nama`,`alamat`,`phone`,`pic`,`harga_user`,`harga_jual`,`tanggal`,`lang`,`lat`,`luas_bangunan`,`luas_tanah`,`legalitas`,`deskripsi`,`fasilitas`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`,`view`,`id_komen`,`note_approval`) values 
(1,'Relaxing Apartmen','Jl. Banjarsari','08122 80982','Akbar',150000000,200000000,'2019-10-26','107.56197659907104','-6.920116244612456','123 m2','312 m2','SHM','','',1,'2019-10-29 14:31:41','admin','2019-10-26 14:01:57','',NULL,NULL,NULL),
(4,'Real Luxury Villa','123 Kathal St. Tampa City,\r\n                                ','08122 80982','Akbar',150000000,200000000,'2019-10-29','107.56197659907104','-6.920116244612456',NULL,NULL,NULL,NULL,NULL,1,'2019-10-29 15:02:40','admin',NULL,NULL,NULL,NULL,NULL),
(5,'Beautiful Family House','123 Kathal St. Tampa City,\r\n                                ','08122 80982','Akbar',150000000,150000000,'2019-10-29','107.56197659907104','-6.920116244612456',NULL,NULL,NULL,NULL,NULL,1,'2019-10-29 15:06:51','admin',NULL,NULL,NULL,NULL,NULL),
(6,'Elegant House','Tembalang City','08122 80982','Akbar',150000000,300000000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2019-10-29 15:11:34',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `manage_user` */

DROP TABLE IF EXISTS `manage_user`;

CREATE TABLE `manage_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipe` int(11) DEFAULT '0' COMMENT '1: Owner,2: Admin, 3: Agent, 4:Premi',
  `phone` varchar(100) DEFAULT NULL,
  `cabang` int(11) DEFAULT NULL,
  `host` varchar(200) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `status` int(1) DEFAULT '0',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` int(11) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT '0',
  `approve_at` timestamp NULL DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipe` (`tipe`),
  KEY `status` (`status`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `manage_user` */

insert  into `manage_user`(`id`,`first_name`,`last_name`,`username`,`password`,`alamat`,`email`,`tipe`,`phone`,`cabang`,`host`,`foto`,`tgl_lahir`,`tempat_lahir`,`deskripsi`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`,`status_id`,`approve_at`,`approve_by`) values 
(1,'Bayu','Christian','borntodie','81dc9bdb52d04dc20036dbd8313ed055','Semarang','borntodie@gmail.com',3,'0822 111',1,'http://localhost/interflow/assets/img/consultant/','amin.png','1989-06-20','Semarang','',1,'2019-10-29 16:02:39',0,NULL,NULL,0,NULL,NULL),
(2,'Bayu','Christian','bayu','81dc9bdb52d04dc20036dbd8313ed055','asdasd','asdasdasd@gmail.com',1,'0',1,NULL,'assets_admin/media/users/chucky.jpg','1995-05-01','Bandung','dsfsdfsdfois dadasda\r\n\r\n- asdasd\r\n- adsdasdas\r\n- 34242\r\n\r\ndsaasdasdadaasdad\r\n\r\n',1,NULL,NULL,'2019-10-25 04:51:08',4,0,NULL,NULL),
(3,NULL,NULL,NULL,NULL,NULL,NULL,0,'0',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL),
(4,'Kristian','Adhi','kriz','81dc9bdb52d04dc20036dbd8313ed055','asdasd','asdasdasd@gmail.com',1,'312313131',1,NULL,'','2000-07-29','adasdadas','\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"',1,NULL,NULL,'2019-10-25 05:10:17',2,0,NULL,NULL),
(5,'Kristian','Adhi','krizz','81dc9bdb52d04dc20036dbd8313ed055','asdasd','asdasdasd@gmail.com',2,'0',2,NULL,'',NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL),
(6,'Budi','Waluyo','budi','81dc9bdb52d04dc20036dbd8313ed055','Semarang','budi@gmail.com',3,'0822 111',8,'http://localhost/interflow/assets/img/consultant/','ardo.png','2005-10-05','Semarang','',1,'2019-10-25 02:10:35',0,'2019-10-24 22:00:50',0,0,NULL,NULL),
(7,'asd','dasd','sda','81dc9bdb52d04dc20036dbd8313ed055','sdfasd asdas','ads@sf',3,'d2313',4,NULL,'218200-colorful-hexagon-logo-element-design_1938201.jpg','2019-09-30','asdad','dassadda',0,'2019-10-25 02:12:40',0,NULL,NULL,0,NULL,NULL),
(8,'fdf','ssdfsd','sdas2','81dc9bdb52d04dc20036dbd8313ed055','asda da','ads@sf',3,'21231',8,NULL,'430541-colorful-hexagon-logo-element-design_1938201.jpg','2019-03-06','sdfsd','adadasd',0,'2019-10-25 02:17:37',0,NULL,NULL,0,NULL,NULL),
(9,'1st','2nd','exman','81dc9bdb52d04dc20036dbd8313ed055','dsfsdfsd fds fdsfsdfdsf sf','hello@yahoo.com',1,'56456545',3,NULL,NULL,'1996-07-05','Jakarta','dfjhsadfiodsf\r\nsd\r\nf\r\nsdf\r\nds\r\n\r\ndfs\r\nsdf\r\n\r\n\r\nf\r\nsf\r\nsd\r\nfds\r\n\r\n\r\nsdf\r\nsdfs',1,'2019-10-25 09:25:24',4,'2019-10-25 04:32:20',4,0,NULL,NULL),
(10,'1221','dasdas','htr','81dc9bdb52d04dc20036dbd8313ed055','das dsad asd asd asdsa','wew@fdasd',1,'211231312',2,NULL,NULL,'2019-09-11','eqwdqsdasds','adads\r\n\r\n\r\n\r\nadsasd\r\na\r\nasdads\r\n\r\nasd\r\na\r\ndas\r\ndas\r\ndas\r\n',1,'2019-10-25 10:05:16',4,'2019-10-25 05:06:03',2,0,NULL,NULL),
(11,'asdasda','fdafdfa','uytuhty','81dc9bdb52d04dc20036dbd8313ed055','dsadasdada','aasd@dasdas',2,'3412433214',2,NULL,NULL,'1970-01-01','2w3eqwdafda','dasadasd\r\n\r\nfhg\r\nhgf\r\nfgh\r\nh\r\nghf\r\nh\r\ngf\r\nfgh ',1,'2019-10-25 10:11:58',2,'2019-10-25 05:16:14',2,0,NULL,NULL),
(12,'Amin ','Richman Soeltan','richman','81dc9bdb52d04dc20036dbd8313ed055','apskdpoasklpd aopd aspo dpoasopkdas','sdfds@daffs.com',4,'23894672374',NULL,NULL,NULL,'1997-03-13','Denpasar','soddjfoisdjfioksdfdsfsd\r\n\r\nsd\r\nfsdfksdf\r\n\r\n\r\nsdfs\r\nd\r\n[fsdf\r\nsdf\r\n\r\nfs\r\n- dfdskf\r\n- kkdsfksdf\r\n\r\n\r\nskdflsdkfoskfosdf',1,'2019-10-25 11:31:21',4,'2019-10-25 06:39:57',4,0,NULL,NULL),
(13,'we43w4','reswrewrw','drfsdhdg','81dc9bdb52d04dc20036dbd8313ed055','werwerwefwd','rwstsrg@sdf.com',4,'4535346535',NULL,NULL,NULL,'2019-09-30','erwrwer','daffdsfsdf\r\n\r\n\r\nfsdf\r\nsd\r\nfsd\r\nf\r\n\r\n\r\nsdf\r\n\r\nsdf\r\nsdf\r\n\r\n\r\n',0,'2019-10-25 11:34:03',4,NULL,NULL,0,NULL,NULL),
(14,'Afrina','Lie','afrina','81dc9bdb52d04dc20036dbd8313ed055','Semarang','afrina@gmail.com',3,'0822 111',1,'http://localhost/interflow/assets/img/consultant/','afrina lie.png',NULL,'Semarang','',1,'2019-10-29 16:06:15',NULL,NULL,NULL,0,NULL,NULL),
(15,'Endang','','endang','81dc9bdb52d04dc20036dbd8313ed055','Semarang','endang@gmail.com',3,'0822 111',8,'http://localhost/interflow/assets/img/consultant/','endang.png',NULL,'Semarang','',1,'2019-10-29 16:07:21',NULL,NULL,NULL,0,NULL,NULL),
(16,'Yosephin','','yosephin','81dc9bdb52d04dc20036dbd8313ed055','Semarang','yosephin@gmail.com',3,'0822 111',1,'http://localhost/interflow/assets/img/consultant/','yosephin.png',NULL,'Semarang',NULL,1,'2019-10-29 16:15:35',NULL,NULL,NULL,0,NULL,NULL);

/*Table structure for table `ms_cabang` */

DROP TABLE IF EXISTS `ms_cabang`;

CREATE TABLE `ms_cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1:aktif, 0:non-aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ms_cabang` */

insert  into `ms_cabang`(`id`,`nama`,`status`) values 
(1,'Semarang',1),
(2,'Jakarta',1),
(3,'Surabaya',1),
(4,'abc',1),
(5,'tes',0);

/*Table structure for table `ms_fasilitas` */

DROP TABLE IF EXISTS `ms_fasilitas`;

CREATE TABLE `ms_fasilitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `logo` varchar(25) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT '',
  `status` int(1) DEFAULT '1' COMMENT '1:aktif, 0:non-aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ms_fasilitas` */

insert  into `ms_fasilitas`(`id`,`nama`,`logo`,`satuan`,`status`) values 
(1,'Surface Area','flaticon-ui','M<sup>2</sup>',1),
(2,'Building Area','lnr lnr-home','M<sup>2</sup>',1),
(3,'Beds','flaticon-bed','',1),
(4,'Bathroom','flaticon-bathroom','',1);

/*Table structure for table `ms_feature` */

DROP TABLE IF EXISTS `ms_feature`;

CREATE TABLE `ms_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1:aktif, 0:non-aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ms_feature` */

insert  into `ms_feature`(`id`,`nama`,`status`) values 
(1,'School',1),
(2,'tes',0);

/*Table structure for table `ms_jabatan` */

DROP TABLE IF EXISTS `ms_jabatan`;

CREATE TABLE `ms_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ms_jabatan` */

/*Table structure for table `ms_photo` */

DROP TABLE IF EXISTS `ms_photo`;

CREATE TABLE `ms_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(11) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `img_name` varchar(200) DEFAULT NULL,
  `cover` tinyint(1) DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `insert_at` datetime DEFAULT NULL,
  `insert_by` varchar(10) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ms_photo` */

insert  into `ms_photo`(`id`,`id_rumah`,`img_url`,`img_name`,`cover`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,1,'http://localhost/interflow/assets/img/property/pict11.jpg','pict11.jpg',1,1,'2019-10-29 14:58:49','admin',NULL,NULL),
(2,4,'http://localhost/interflow/assets/img/property/pict10.jpg','pict10.jpg',1,1,'2019-10-29 15:03:54','admin',NULL,NULL),
(3,5,'http://localhost/interflow/assets/img/property/pict6.jpg','pict6.jpg',1,1,'2019-10-29 15:08:29',NULL,NULL,NULL),
(4,6,'http://localhost/interflow/assets/img/property/pict1.jpg','pict1.jpg',1,1,'2019-10-29 15:12:25',NULL,NULL,NULL);

/*Table structure for table `ms_satuan` */

DROP TABLE IF EXISTS `ms_satuan`;

CREATE TABLE `ms_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1:aktif, 0:non-aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `ms_satuan` */

insert  into `ms_satuan`(`id`,`nama`,`status`) values 
(1,'Meter',1),
(2,'Watt',1),
(3,'tes1',1),
(4,'tes2',0),
(5,'tes3',0),
(6,'tes4',1),
(7,'tes5',0),
(8,'tes6',1),
(9,'tes7',0),
(10,'tes8',0),
(11,'tes9',0),
(12,'abc',0);

/*Table structure for table `ms_show` */

DROP TABLE IF EXISTS `ms_show`;

CREATE TABLE `ms_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(11) DEFAULT NULL,
  `tanggal_aktivasi` datetime DEFAULT NULL,
  `tanggal_end` datetime DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `insert_by` varchar(10) DEFAULT NULL,
  `insert_at` datetime DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ms_show` */

/*Table structure for table `ms_video` */

DROP TABLE IF EXISTS `ms_video`;

CREATE TABLE `ms_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(11) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `insert_at` datetime DEFAULT NULL,
  `insert_by` varchar(10) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ms_video` */

/*Table structure for table `tb_about_us` */

DROP TABLE IF EXISTS `tb_about_us`;

CREATE TABLE `tb_about_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_perusahaan` text,
  `img_profil` varchar(125) DEFAULT NULL,
  `img_url_profil` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_about_us` */

insert  into `tb_about_us`(`id`,`profil_perusahaan`,`img_profil`,`img_url_profil`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Purus in massa tempor nec feugiat. <br> In metus vulputate eu scelerisque felis imperdiet proin fermentum leo. Proin fermentum leo vel orci porta non pulvinar neque laoreet. Augue eget arcu dictum varius duis at. Augue lacus viverra vitae congue eu consequat ac felis. Aenean vel elit scelerisque mauris pellentesque. Morbi tincidunt augue interdum velit euismod in. Fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Magna etiam tempor orci eu lobortis. Aliquet lectus proin nibh nisl condimentum id venenatis a condimentum. Nulla aliquet enim tortor at auctor urna. Hac habitasse platea dictumst vestibulum rhoncus. A cras semper auctor neque vitae tempus quam pellentesque nec. Tincidunt augue interdum velit euismod in. A lacus vestibulum sed arcu non. Ultrices vitae auctor eu augue ut lectus arcu bibendum.','logowarna.jpg',NULL,1,'2019-10-28 10:05:07',NULL,NULL,NULL),
(2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Purus in massa tempor nec feugiat. <br> In metus vulputate eu scelerisque felis imperdiet proin fermentum leo. Proin fermentum leo vel orci porta non pulvinar neque laoreet. Augue eget arcu dictum varius duis at. Augue lacus viverra vitae congue eu consequat ac felis. Aenean vel elit scelerisque mauris pellentesque. Morbi tincidunt augue interdum velit euismod in. Fringilla est ullamcorper eget nulla facilisi etiam dignissim diam. Magna etiam tempor orci eu lobortis. Aliquet lectus proin nibh nisl condimentum id venenatis a condimentum. Nulla aliquet enim tortor at auctor urna. Hac habitasse platea dictumst vestibulum rhoncus. A cras semper auctor neque vitae tempus quam pellentesque nec. Tincidunt augue interdum velit euismod in. A lacus vestibulum sed arcu non. Ultrices vitae auctor eu augue ut lectus arcu bibendum.','logowarna.jpg',NULL,0,'2019-10-28 10:05:07',NULL,NULL,NULL);

/*Table structure for table `tb_contact_us` */

DROP TABLE IF EXISTS `tb_contact_us`;

CREATE TABLE `tb_contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` text,
  `kontak` text,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_contact_us` */

insert  into `tb_contact_us`(`id`,`alamat`,`kontak`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'dasdasdas daasdasd <br>\r\nasd\r\n\r\ndass\r\nda\r\n<br>\r\nsdasdasdadasdadaadada\r\nsa\r\nd\r\nasdasdas','05882468a\r\nasasda65da65dassda\r\na\r\ndas\r\ndas',1,'2019-10-28 10:03:51',NULL,NULL,NULL),
(2,'dasdasdas daasdasd\r\na\r\n\r\ndas\r\ndas\r\nd\r\nasd\r\na\r\n\r\ndass\r\nda\r\nsdasdasdadasdadaadada\r\nsa\r\nd\r\nasdasdas','05882468a\r\nasasda65da65dassda\r\na\r\ndas\r\ndas',0,'2019-10-28 10:03:51',NULL,NULL,NULL);

/*Table structure for table `tb_developer` */

DROP TABLE IF EXISTS `tb_developer`;

CREATE TABLE `tb_developer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(50) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address` text,
  `img_name` varchar(125) DEFAULT NULL,
  `pdf_name` varchar(125) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `pdf_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_developer` */

insert  into `tb_developer`(`id`,`name_tag`,`name`,`address`,`img_name`,`pdf_name`,`img_url`,`pdf_url`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(3,'Framedia Property & Developer','Framedia','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo1.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo1.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(4,'Eden','Eden','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo2.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo2.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(5,'Central Point','Central Point','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo3.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo3.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(6,'Wohnen','Wohnen','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo4.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo4.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(7,'Valair','Valair','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo5.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo5.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(8,'Eton Gate','Eton Gate','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo6.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo6.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(9,'Ideal of Property','Ideal of Property','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo7.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo7.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(10,'Live Property','Live Property','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo8.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo8.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL),
(11,'Asia Karya Reality','Asia Karya Reality','Forest Hill Citraland Bsb, 50212 Pesantren, Mijen, Semarang.','logo9.jpg',NULL,'http://localhost/interflow/assets/img/developer/logo9.jpg',NULL,1,'2019-10-28 13:22:10',NULL,NULL,NULL);

/*Table structure for table `tb_faq` */

DROP TABLE IF EXISTS `tb_faq`;

CREATE TABLE `tb_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_faq` */

insert  into `tb_faq`(`id`,`question`,`answer`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'Apa itu interflow ???','Interflow Property merupakan suatu wadah komunitas diman kami selaku kantor property agent tepatnya bebebra principle kantor property agent merasa bahwa kami harus melindungi sumua pihak baik buyer / investor maupun kami selaku marketing pemasaran property.',1,'2019-10-29 09:06:13',NULL,NULL,NULL);

/*Table structure for table `tb_footer` */

DROP TABLE IF EXISTS `tb_footer`;

CREATE TABLE `tb_footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` text,
  `phone` text,
  `email` varchar(80) DEFAULT NULL,
  `facebook_url` varchar(150) DEFAULT NULL,
  `instagram_url` varchar(150) DEFAULT NULL,
  `social_media` text,
  `img_name` varchar(80) DEFAULT NULL,
  `img_url` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_footer` */

insert  into `tb_footer`(`id`,`alamat`,`phone`,`email`,`facebook_url`,`instagram_url`,`social_media`,`img_name`,`img_url`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'Jl. .................','0080444848 <br>\r\n5421211','interflow@abc.com',NULL,NULL,'Facebook: .......... <br>\r\nInstagram: .......... <br>','logogrey.png',NULL,1,'2019-10-28 10:01:43',NULL,NULL,NULL),
(2,'Jl. .................','0080444848 <br>\r\n5421211','interflow@abc.com',NULL,NULL,'Facebook: .......... <br>\r\nInstagram: .......... <br>','logogrey.png',NULL,0,'2019-10-28 10:01:43',NULL,NULL,NULL);

/*Table structure for table `tb_gallery` */

DROP TABLE IF EXISTS `tb_gallery`;

CREATE TABLE `tb_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(125) DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `tb_gallery` */

insert  into `tb_gallery`(`id`,`file_name`,`file_url`,`title`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-28 14:51:31',NULL,NULL,NULL),
(2,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-28 14:51:31',NULL,NULL,NULL),
(3,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-28 14:51:31',NULL,NULL,NULL),
(4,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-28 14:51:31',NULL,NULL,NULL),
(5,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:47',NULL,NULL,NULL),
(6,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:47',NULL,NULL,NULL),
(7,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:47',NULL,NULL,NULL),
(8,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:47',NULL,NULL,NULL),
(12,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(13,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(14,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(15,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(16,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(17,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(18,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(19,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:48',NULL,NULL,NULL),
(27,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(28,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(29,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(30,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(31,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(32,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(33,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(34,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(35,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(36,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(37,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(38,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(39,'zoom1.jpg','http://localhost/interflow/assets/img/gallery/zoom1.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(40,'zoom2.jpg','http://localhost/interflow/assets/img/gallery/zoom2.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(41,'zoom3.jpg','http://localhost/interflow/assets/img/gallery/zoom3.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL),
(42,'zoom4.jpg','http://localhost/interflow/assets/img/gallery/zoom4.jpg','Photo Gallery',1,'2019-10-29 20:37:49',NULL,NULL,NULL);

/*Table structure for table `tb_home_slider` */

DROP TABLE IF EXISTS `tb_home_slider`;

CREATE TABLE `tb_home_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(125) DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_home_slider` */

insert  into `tb_home_slider`(`id`,`file_name`,`file_url`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'slide.jpg','http://localhost/interflow/assets/img/slider/slide.jpg',1,'2019-10-28 09:58:12',NULL,NULL,NULL),
(3,'slide_1.jpg','http://localhost/interflow/assets/img/slider/slide_1.jpg',1,'2019-10-29 09:09:58',NULL,NULL,NULL),
(4,'slide_2.jpg','http://localhost/interflow/assets/img/slider/slide_2.jpg',1,'2019-10-29 09:19:29',NULL,NULL,NULL),
(5,'slide_3.jpg','http://localhost/interflow/assets/img/slider/slide_3.jpg',1,'2019-10-29 09:19:39',NULL,NULL,NULL),
(6,'slide_4.jpg','http://localhost/interflow/assets/img/slider/slide_4.jpg',1,'2019-10-29 09:19:49',NULL,NULL,NULL);

/*Table structure for table `tb_home_video` */

DROP TABLE IF EXISTS `tb_home_video`;

CREATE TABLE `tb_home_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(125) DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_home_video` */

/*Table structure for table `tb_news` */

DROP TABLE IF EXISTS `tb_news`;

CREATE TABLE `tb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `berita` text,
  `img_name` varchar(125) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `tb_news` */

insert  into `tb_news`(`id`,`tanggal`,`judul`,`berita`,`img_name`,`img_url`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-28 09:55:40',NULL,NULL,NULL),
(3,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:45:58',NULL,NULL,NULL),
(4,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:45:59',NULL,NULL,NULL),
(5,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:45:59',NULL,NULL,NULL),
(7,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:00',NULL,NULL,NULL),
(8,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:00',NULL,NULL,NULL),
(9,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:00',NULL,NULL,NULL),
(10,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:00',NULL,NULL,NULL),
(14,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(15,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(16,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(17,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(18,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(19,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(20,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(21,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:01',NULL,NULL,NULL),
(30,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(31,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(32,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(33,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(34,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(35,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(36,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(37,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(38,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(39,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(40,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(41,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(42,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(43,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(44,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL),
(45,'2019-10-27','Breaking News','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the','pict11.jpg','http://localhost/interflow/assets/img/property/pict11.jpg',1,'2019-10-29 19:46:25',NULL,NULL,NULL);

/*Table structure for table `tb_partner` */

DROP TABLE IF EXISTS `tb_partner`;

CREATE TABLE `tb_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_tag` varchar(50) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address` text,
  `img_name` varchar(125) DEFAULT NULL,
  `pdf_name` varchar(125) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `pdf_url` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_partner` */

insert  into `tb_partner`(`id`,`name_tag`,`name`,`address`,`img_name`,`pdf_name`,`img_url`,`pdf_url`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'BCA','BCA',NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/bca.png',NULL,1,'2019-10-29 20:17:39',NULL,NULL,NULL),
(2,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/bni_1.png',NULL,1,'2019-10-29 20:18:44',NULL,NULL,NULL),
(3,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/bni_2.png',NULL,1,'2019-10-29 20:18:49',NULL,NULL,NULL),
(4,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/btn.png',NULL,1,'2019-10-29 20:19:03',NULL,NULL,NULL),
(5,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/China-Constraction.png',NULL,1,'2019-10-29 20:19:25',NULL,NULL,NULL),
(6,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/CIMB.png',NULL,1,'2019-10-29 20:19:37',NULL,NULL,NULL),
(7,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/Commonwealth.png',NULL,1,'2019-10-29 20:19:47',NULL,NULL,NULL),
(8,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/danamon.png',NULL,1,'2019-10-29 20:19:54',NULL,NULL,NULL),
(9,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/KEB-Hana.png',NULL,1,'2019-10-29 20:20:03',NULL,NULL,NULL),
(10,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/Mandiri.png',NULL,1,'2019-10-29 20:20:16',NULL,NULL,NULL),
(11,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/Maybank.png',NULL,1,'2019-10-29 20:20:30',NULL,NULL,NULL),
(12,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/mnc.png',NULL,1,'2019-10-29 20:20:46',NULL,NULL,NULL),
(13,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/ocbc.png',NULL,1,'2019-10-29 20:20:57',NULL,NULL,NULL),
(14,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/panin.png',NULL,1,'2019-10-29 20:21:05',NULL,NULL,NULL),
(15,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/permata-bank.png',NULL,1,'2019-10-29 20:21:16',NULL,NULL,NULL),
(16,NULL,NULL,NULL,NULL,NULL,'http://localhost/interflow/assets/img/partner/UOB.png',NULL,1,'2019-10-29 20:21:23',NULL,NULL,NULL);

/*Table structure for table `tb_properti_fasilitas` */

DROP TABLE IF EXISTS `tb_properti_fasilitas`;

CREATE TABLE `tb_properti_fasilitas` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(20) DEFAULT NULL,
  `id_fasilitas` int(20) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tb_properti_fasilitas` */

insert  into `tb_properti_fasilitas`(`id`,`id_rumah`,`id_fasilitas`,`label`) values 
(1,1,1,'100'),
(2,1,2,'65'),
(4,1,3,'3'),
(5,1,4,'2'),
(6,4,1,'150'),
(7,4,2,'65'),
(8,4,3,'2'),
(9,4,4,'3'),
(10,5,1,'200'),
(11,5,2,'65'),
(12,5,3,'3'),
(13,5,4,'4'),
(14,6,1,'350'),
(15,6,2,'65'),
(16,6,3,'2'),
(17,6,4,'2');

/*Table structure for table `tb_properti_feature` */

DROP TABLE IF EXISTS `tb_properti_feature`;

CREATE TABLE `tb_properti_feature` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_rumah` int(20) DEFAULT NULL,
  `id_feature` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_properti_feature` */

/*Table structure for table `tb_testimony` */

DROP TABLE IF EXISTS `tb_testimony`;

CREATE TABLE `tb_testimony` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) DEFAULT NULL,
  `title` varchar(70) DEFAULT NULL,
  `testimony` text,
  `img_name` varchar(125) DEFAULT NULL,
  `img_url` varchar(200) DEFAULT NULL,
  `rating` double DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `insert_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` varchar(100) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_testimony` */

insert  into `tb_testimony`(`id`,`name`,`title`,`testimony`,`img_name`,`img_url`,`rating`,`status`,`insert_at`,`insert_by`,`update_at`,`update_by`) values 
(1,'Maikel Alisa','Amazing Home','Nice property as usual. <br> Thanks...','','http://placehold.it/60x60',4,1,'2019-10-28 09:54:11',NULL,NULL,NULL),
(2,'John Flaca','Goods','Nice property as usual. <br> Thanks...','','http://placehold.it/60x60',3,1,'2019-10-28 09:54:11',NULL,NULL,NULL),
(3,'Freddy Mercury','Amazing Home','Nice property as usual. <br> Thanks...','','http://placehold.it/60x60',5,1,'2019-10-29 10:13:19',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
