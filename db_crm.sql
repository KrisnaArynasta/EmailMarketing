/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.6.14-log : Database - db_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(30) DEFAULT NULL,
  `admin_password` varchar(30) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_admin` */

insert  into `tbl_admin`(`admin_id`,`admin_username`,`admin_password`,`admin_name`) values 
(1,'admin','admin','Krisna');

/*Table structure for table `tbl_email_sender` */

DROP TABLE IF EXISTS `tbl_email_sender`;

CREATE TABLE `tbl_email_sender` (
  `email_sender_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `inbox_host` varchar(100) DEFAULT NULL,
  `sender_host` varchar(100) DEFAULT NULL,
  `limit_email` int(11) DEFAULT NULL,
  `email_status_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`email_sender_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_email_sender_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_email_sender` */

insert  into `tbl_email_sender`(`email_sender_id`,`user_id`,`email`,`password`,`inbox_host`,`sender_host`,`limit_email`,`email_status_active`) values 
(1,1,'krisnaarinasta@gmail.com','jimmysul7xx','{imap.gmail.com:993/imap/ssl}INBOX','ssl://smtp.googlemail.com',250,1),
(2,2,'krisnaarynasta@gmail.com','jimmysul7xx','{imap.gmail.com:993/imap/ssl}INBOX','ssl://smtp.googlemail.com',250,1),
(3,2,'krisnaarinasta@rocketmail.com','jimmysulivan','{imap.mail.yahoo.com:993/imap/ssl}INBOX','ssl://smtp.mail.yahoo.com',250,1);

/*Table structure for table `tbl_event` */

DROP TABLE IF EXISTS `tbl_event`;

CREATE TABLE `tbl_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_description` text,
  `event_message` text,
  `message_send_before` int(11) DEFAULT NULL,
  `event_main_photo` varchar(255) DEFAULT NULL,
  `event_status_active` tinyint(1) DEFAULT NULL,
  `event_status_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`event_id`),
  KEY `id_user` (`user_id`),
  CONSTRAINT `tbl_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_event` */

insert  into `tbl_event`(`event_id`,`user_id`,`event_name`,`event_date`,`event_description`,`event_message`,`message_send_before`,`event_main_photo`,`event_status_active`,`event_status_delete`) values 
(1,1,'Ogoh-ogoh Festival & Nyepi','2019-12-14','Nyepi is a Balinese \"Day of Silence\" that is commemorated every Isakawarsa (Saka new year) according to the Balinese calendar (in 2019, it falls on March 7). It is a Hindu celebration mainly celebrated in Bali, Indonesia. Nyepi, a public holiday in Indonesia, is a day of silence, fasting and meditation for the Balinese. The day following Nyepi is also celebrated as New Year\'s Day.[1][2] On this day, the youth of Bali in the village of Sesetan in South Bali practice the ceremony of Omed-omedan or \'The Kissing Ritual\' to celebrate the new year. The same day celebrated in India as Ugadi. ','<p>book now for any dates on march 2020 and get so much offer</p>\r\n',1,'Event_1_Nyepi_20191029030003.jpg',1,0),
(2,1,'Christmas Day','2020-12-25','Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25. as a religious and cultural celebration among billions of people around the world.','<p>Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25. as a religious and cultural celebration among billions of people around the world.</p>\r\n',216,'Event_1_Natal_20191029025924.jpg',1,0),
(3,1,'Galungan and Kuningan Day','2019-12-15','Galungan is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year. ','<h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n',1,'Event_1_Galungan_20191029030033.jpg',1,0),
(7,1,'test paging','0000-00-00','','',0,'Event_1_test_paging_20191030064253.jpg',1,0),
(8,1,'test paging 2 ','0000-00-00','','',0,'Event_1_test_paging_2__20191030064322.jpg',1,0),
(9,1,'test paging 3','0000-00-00','','',0,'Event_1_test_paging_3_20191030064336.jpg',1,0),
(10,1,'test paging 4','0000-00-00','','',0,'Event_1_test_paging_4_20191030064352.jpg',1,0),
(11,1,'test','2019-11-14','111','<p>111</p>\r\n',65,'Event_1_test_20191118094048.jpg',1,0);

/*Table structure for table `tbl_event_photos` */

DROP TABLE IF EXISTS `tbl_event_photos`;

CREATE TABLE `tbl_event_photos` (
  `event_photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `event_photo` varchar(255) DEFAULT NULL,
  `event_photo_upload_date` date DEFAULT NULL,
  PRIMARY KEY (`event_photo_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `tbl_event_photos_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_event_photos` */

insert  into `tbl_event_photos`(`event_photo_id`,`event_id`,`event_photo`,`event_photo_upload_date`) values 
(45,1,'Event_photos_1_Nyepi_20191029030004.jpg','2019-10-29'),
(46,1,'Event_photos_1_Nyepi_201910290300041.jpg','2019-10-29'),
(47,1,'Event_photos_1_Nyepi_201910290300042.jpg','2019-10-29'),
(48,1,'Event_photos_1_Nyepi_201910290300043.jpg','2019-10-29'),
(49,1,'Event_photos_1_Nyepi_201910290300044.jpg','2019-10-29'),
(52,3,'Event_photos_3_Galungan_20191029030612.jpg','2019-10-29'),
(53,3,'Event_photos_3_Galungan_201910290306121.jpg','2019-10-29'),
(55,3,'Event_photos_3_Galungan_201910290306123.jpg','2019-10-29'),
(56,3,'Event_photos_3_Galungan_201910290306124.jpg','2019-10-29'),
(60,2,'Event_photos_2_Natal_20191029031001.jpg','2019-10-29'),
(61,2,'Event_photos_2_Natal_201910290310011.jpg','2019-10-29'),
(62,2,'Event_photos_2_Natal_201910290310012.jpg','2019-10-29');

/*Table structure for table `tbl_guest` */

DROP TABLE IF EXISTS `tbl_guest`;

CREATE TABLE `tbl_guest` (
  `guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_user_id` varchar(255) DEFAULT NULL,
  `guest_name` varchar(50) DEFAULT NULL,
  `guest_email` varchar(50) DEFAULT NULL,
  `guest_country` varchar(30) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_active_status` tinyint(1) DEFAULT '1',
  `guest_insert_date` date DEFAULT NULL,
  `guest_last_update` date DEFAULT NULL,
  PRIMARY KEY (`guest_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_guest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_guest` */

insert  into `tbl_guest`(`guest_id`,`guest_user_id`,`guest_name`,`guest_email`,`guest_country`,`user_id`,`guest_active_status`,`guest_insert_date`,`guest_last_update`) values 
(1,'NB001','Marl Kurl','ladysiahaan0@gmail.com','italy',2,1,'2019-12-23','2019-12-23'),
(3,'NB002','Max Maz ','no-reply@mx2.4shared.com','USA',2,1,'2019-12-23','2019-12-23'),
(5,'NB003','li xuan ye','krisnaarinasta@student.unud.ac.id','China',2,1,'2019-12-23','2019-12-23'),
(6,'PD001-312','Iwan Wakanai','IW@yahoo.com','Indonesia',2,0,'2019-12-23','2019-12-23'),
(7,'NB003','Made','putuadhikusuma98@gmail.com','Indonesia',2,1,'2019-12-23','2019-12-23'),
(8,'NB000','Crisnha','krisnaarinasta@student.unud.ac.id','Maldive',2,0,'2019-12-23','2019-12-24'),
(9,'NB011','Daily Tropical','dailytropicalbali@gmail.com','Maldive',1,1,'2019-12-23','2019-12-23'),
(10,'NB007','Dedik Mahardika','krisnaarinasta@student.unud.ac.id','Indonesia',2,0,'2019-12-23','2019-12-24'),
(12,'TST001','test1xx','test@test.com','testxx',5,0,'2019-12-23','2019-12-23'),
(13,'PI0071','Li Mien Chok','yolixitest9117@gmail.com','Taiwan',5,1,'2019-12-23','2019-12-23');

/*Table structure for table `tbl_inbox` */

DROP TABLE IF EXISTS `tbl_inbox`;

CREATE TABLE `tbl_inbox` (
  `inbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message_id` varchar(100) DEFAULT NULL,
  `inbox_subject` varchar(100) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `inbox_guest_name` varchar(30) DEFAULT NULL,
  `inbox_from` varchar(100) DEFAULT NULL,
  `inbox_to` varchar(30) DEFAULT NULL,
  `inbox_body` text,
  `seen_status` tinyint(1) DEFAULT NULL,
  `answered_status` tinyint(1) DEFAULT NULL,
  `inbox_date` varchar(30) DEFAULT NULL,
  `duplicate_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`inbox_id`),
  KEY `user_id` (`user_id`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `tbl_inbox_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `tbl_inbox_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `tbl_guest` (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_inbox` */

insert  into `tbl_inbox`(`inbox_id`,`user_id`,`message_id`,`inbox_subject`,`guest_id`,`inbox_guest_name`,`inbox_from`,`inbox_to`,`inbox_body`,`seen_status`,`answered_status`,`inbox_date`,`duplicate_status`) values 
(5,1,'<CADrRtahq7g4q_MaMNGcf_4ioVi1NKYpKRFn3bE54002soBfVhg@mail.gmail.com>','Re: Kak maaf saya telatnya udah telat banget, soalnya saya memang tidak mengerti kak mengenai cursor',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','<div dir3D\"auto\">Baik kak,, saya berusaha semampu saya<div dir3D\"auto\">Ma\r\nkasii kakk</div></div><br><div class3D\"gmail_quote\"><div dir3D\"ltr\">Pada \r\ntanggal Sen, 3 Des 2018 10.41 Krisna Arynasta &lt;<a href3D\"mailto:krisnaa\r\nrinasta@gmail.com\">krisnaarinasta@gmail.com</a> menulis:<br></div><blockquo\r\nte class3D\"gmail_quote\" style3D\"margin:0 0 0 .8ex;border-left:1px #ccc so\r\nlid;padding-left:1ex\"><div dir3D\"auto\">iya saya maklumi yg penting km bisa\r\n menjelaskan nantiC2A0</div><br><div class3D\"gmail_quote\"><div dir3D\"lt\r\nr\">On Mon, Dec 3, 2018, 10:27 AM Lady Siahaan &lt;<a href3D\"mailto:ladysia\r\nhaan0@gmail.com\" target3D\"_blank\" rel3D\"noreferrer\">ladysiahaan0@gmail.co\r\nm</a>&gt; wrote:<br></div><blockquote class3D\"gmail_quote\" style3D\"margin\r\n:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir3D\"auto\">\r\n</div>\r\n</blockquote></div>\r\n</blockquote></div>\r\n',1,0,'Mon, 3 Dec 2018 11:08:02 +0800',0),
(6,1,'<CADrRtajYZb=OVhyKHn69xDp4b7LBdW34yAC5238AE3k4CThLwA@mail.gmail.com>','PTBD_18_1705551038_LADY HASIANI SIAHAAN',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','REVMSU1JVEVSICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBF\r\nWElTVFMgYHNwX3RyYW5zY291dGAkJA0KDQpDUkVBVEUgREVGSU5FUj1gcm9vdGBAYGxvY2FsaG9z\r\ndGAgUFJPQ0VEVVJFIGBzcF90cmFuc2NvdXRgKElOIHRhaHVuIElOVCwgSU4gYnVsYW4gSU5ULCBP\r\nVVQgdG90YWxfdHJhbnMgSU5UKQ0KQkVHSU4gU0VUIHRvdGFsX3RyYW5zID0gKFNFTEVDVCAoU1VN\r\nKHRvdGFsX2p1bWxhaCkpIEFTIHRvdGFsX3RyYW5zIEZST00gdHJhbnNhY3Rpb25zIFdIRVJFIFlF\r\nQVIodGdsKT10YWh1biBBTkQgTU9OVEgodGdsKT1idWxhbiBHUk9VUCBCWSBNT05USCh0Z2wpLCBZ\r\nRUFSKHRnbCkpOw0KDQoNCkVORCQkDQoNCkRFTElNSVRFUiA7DQoNCg0KDQoNCg0KREVMSU1JVEVS\r\nICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBFWElTVFMgYGNy\r\nX3RyYW5zYCQkDQoNCkNSRUFURSBERUZJTkVSPWByb290YEBgbG9jYWxob3N0YCBQUk9DRURVUkUg\r\nYGNyX3RyYW5zYChJTiB0YWh1biBJTlQpDQpCRUdJTg0KICAgIERFQ0xBUkUgdGFodW4xIElOVDsN\r\nCiAgICBERUNMQVJFIGlkX2J1bGFuMSBJTlQ7DQogICAgREVDTEFSRSBuYW1hYnVsYW4xIFZBUkNI\r\nQVIoNTApOw0KICAgIERFQ0xBUkUgZG9uZSBJTlQgREVGQVVMVCAwOw0KICAgIA0KICAgIERFQ0xB\r\nUkUgdHJhbnNfY3Vyc29yIENVUlNPUiBGT1IgU0VMRUNUDQogICAgaWRfYnVsYW4sIG5hbWFidWxh\r\nbiBGUk9NIHRiX2J1bGFuIE9SREVSIEJZIChpZF9idWxhbik7DQoJDQoJREVDTEFSRSBDT05USU5V\r\nRSBIQU5ETEVSIEZPUiBTUUxTVEFURSAnMDIwMDAnIFNFVCBkb25lPTE7DQoJDQoJT1BFTiB0cmFu\r\nc19jdXJzb3I7DQoJV0hJTEUgTk9UIGRvbmUgRE8NCglGRVRDSCB0cmFuc19jdXJzb3IgSU5UTyBp\r\nZF9idWxhbjEsbmFtYWJ1bGFuMTsNCglDQUxMIHNwX3RyYW5zY291dCh0YWh1biwgaWRfYnVsYW4x\r\nLCBAc3BfdHJhbnNjb3V0KTsNCgkNCg0KCUlGIEBzcF90cmFuc2NvdXQgSVMgTlVMTCBUSEVOIA0K\r\nCQlTRVQgQHNwX3RyYW5zY291dD0wOw0KCUVORCBJRjsNCgkNCglJRiBOT1QgZG9uZSBUSEVODQoJ\r\nCUlOU0VSVCBJTlRPIGR1bW15IFZBTFVFUygnJyxpZF9idWxhbjEsIG5hbWFidWxhbjEsIEBzcF90\r\ncmFuc2NvdXQpOw0KCUVORCBJRjsNCgkNCgkgICBFTkQgV0hJTEU7DQoJQ0xPU0UgdHJhbnNfY3Vy\r\nc29yOw0KICAgIEVORCQkDQoNCkRFTElNSVRFUiA7DQo',1,0,'Mon, 3 Dec 2018 10:32:15 +0800',0),
(7,1,'<CADrRtajKrrHpxOHeXPaGH+4VsuEF2q=ngkrpmVqDGtd7Ryx3Lg@mail.gmail.com>','Kak maaf saya telatnya udah telat banget, soalnya saya memang tidak mengerti kak mengenai cursor. Da',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','REVMSU1JVEVSICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBF\r\nWElTVFMgYHNwX3RyYW5zY291dGAkJA0KDQpDUkVBVEUgREVGSU5FUj1gcm9vdGBAYGxvY2FsaG9z\r\ndGAgUFJPQ0VEVVJFIGBzcF90cmFuc2NvdXRgKElOIHRhaHVuIElOVCwgSU4gYnVsYW4gSU5ULCBP\r\nVVQgdG90YWxfdHJhbnMgSU5UKQ0KQkVHSU4gU0VUIHRvdGFsX3RyYW5zID0gKFNFTEVDVCAoU1VN\r\nKHRvdGFsX2p1bWxhaCkpIEFTIHRvdGFsX3RyYW5zIEZST00gdHJhbnNhY3Rpb25zIFdIRVJFIFlF\r\nQVIodGdsKT10YWh1biBBTkQgTU9OVEgodGdsKT1idWxhbiBHUk9VUCBCWSBNT05USCh0Z2wpLCBZ\r\nRUFSKHRnbCkpOw0KDQoNCkVORCQkDQoNCkRFTElNSVRFUiA7DQoNCg0KDQoNCg0KREVMSU1JVEVS\r\nICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBFWElTVFMgYGNy\r\nX3RyYW5zYCQkDQoNCkNSRUFURSBERUZJTkVSPWByb290YEBgbG9jYWxob3N0YCBQUk9DRURVUkUg\r\nYGNyX3RyYW5zYChJTiB0YWh1biBJTlQpDQpCRUdJTg0KICAgIERFQ0xBUkUgdGFodW4xIElOVDsN\r\nCiAgICBERUNMQVJFIGlkX2J1bGFuMSBJTlQ7DQogICAgREVDTEFSRSBuYW1hYnVsYW4xIFZBUkNI\r\nQVIoNTApOw0KICAgIERFQ0xBUkUgZG9uZSBJTlQgREVGQVVMVCAwOw0KICAgIA0KICAgIERFQ0xB\r\nUkUgdHJhbnNfY3Vyc29yIENVUlNPUiBGT1IgU0VMRUNUDQogICAgaWRfYnVsYW4sIG5hbWFidWxh\r\nbiBGUk9NIHRiX2J1bGFuIE9SREVSIEJZIChpZF9idWxhbik7DQoJDQoJREVDTEFSRSBDT05USU5V\r\nRSBIQU5ETEVSIEZPUiBTUUxTVEFURSAnMDIwMDAnIFNFVCBkb25lPTE7DQoJDQoJT1BFTiB0cmFu\r\nc19jdXJzb3I7DQoJV0hJTEUgTk9UIGRvbmUgRE8NCglGRVRDSCB0cmFuc19jdXJzb3IgSU5UTyBp\r\nZF9idWxhbjEsbmFtYWJ1bGFuMTsNCglDQUxMIHNwX3RyYW5zY291dCh0YWh1biwgaWRfYnVsYW4x\r\nLCBAc3BfdHJhbnNjb3V0KTsNCgkNCg0KCUlGIEBzcF90cmFuc2NvdXQgSVMgTlVMTCBUSEVOIA0K\r\nCQlTRVQgQHNwX3RyYW5zY291dD0wOw0KCUVORCBJRjsNCgkNCglJRiBOT1QgZG9uZSBUSEVODQoJ\r\nCUlOU0VSVCBJTlRPIGR1bW15IFZBTFVFUygnJyxpZF9idWxhbjEsIG5hbWFidWxhbjEsIEBzcF90\r\ncmFuc2NvdXQpOw0KCUVORCBJRjsNCgkNCgkgICBFTkQgV0hJTEU7DQoJQ0xPU0UgdHJhbnNfY3Vy\r\nc29yOw0KICAgIEVORCQkDQoNCkRFTElNSVRFUiA7DQo',1,1,'Mon, 3 Dec 2018 10:27:14 +0800',0),
(9,1,'<CAKWndJ1V+Y4zo3pUUdVF-CH6a49krtCd_q3WJOxFoFnt82gYwg@mail.gmail.com>','Email marketing test',10,'Dedik Mahardika','I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>','krisnaarinasta@gmail.com','<div dir\"ltr\">test 1.0<br></div>\r\n',1,0,'Thu, 23 May 2019 11:05:33 +080',0),
(11,1,'<CAKWndJ0owJXBSoB=R4k0WosA=P4sE58MOm-M=LTGrvY-cbdUyg@mail.gmail.com>','test',10,'Dedik Mahardika','I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>','krisnaarinasta@rocketmail.com','<div dir\"ltr\"><br></div>\r\n',1,0,'Fri, 24 May 2019 10:57:14 +080',0);

/*Table structure for table `tbl_log_load_inbox` */

DROP TABLE IF EXISTS `tbl_log_load_inbox`;

CREATE TABLE `tbl_log_load_inbox` (
  `id_log_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_load_date` varchar(20) DEFAULT NULL,
  `last_load_time` time DEFAULT NULL,
  PRIMARY KEY (`id_log_inbox`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_log_load_inbox` */

insert  into `tbl_log_load_inbox`(`id_log_inbox`,`user_id`,`last_load_date`,`last_load_time`) values 
(1,1,'28-May-2019','15:02:59'),
(2,1,'28-May-2019','15:07:30'),
(3,1,'28-May-2019','15:18:10'),
(4,1,'28-May-2019','15:22:29'),
(5,1,'28-May-2019','15:22:50'),
(6,1,'28-May-2019','15:23:49'),
(7,1,'28-May-2019','15:25:47'),
(8,1,'28-May-2019','15:25:54'),
(9,1,'28-May-2019','15:25:59'),
(10,1,'28-May-2019','15:26:34'),
(11,1,'28-May-2019','15:29:13'),
(12,1,'28-May-2019','15:29:57'),
(13,1,'28-May-2019','15:31:14'),
(14,1,'28-May-2019','15:36:46'),
(15,1,'28-May-2019','15:42:46'),
(16,1,'28-May-2019','15:42:50'),
(17,1,'28-May-2019','15:43:59'),
(18,1,'28-May-2019','15:44:22'),
(19,1,'28-May-2019','15:48:00'),
(20,1,'28-May-2019','15:53:39'),
(21,1,'28-May-2019','15:53:56'),
(22,1,'28-May-2019','15:55:07'),
(23,1,'28-May-2019','15:59:48'),
(24,1,'30-May-2019','11:11:22'),
(25,1,'30-May-2019','11:14:43'),
(26,1,'30-May-2019','11:16:46'),
(27,1,'30-May-2019','11:17:47'),
(28,1,'30-May-2019','11:18:58'),
(29,1,'30-May-2019','12:44:28'),
(30,1,'30-May-2019','12:49:52'),
(31,1,'30-May-2019','13:15:15'),
(32,1,'30-May-2019','13:16:50'),
(33,1,'30-May-2019','13:17:18'),
(34,1,'30-May-2019','13:18:57'),
(35,1,'30-May-2019','13:20:20'),
(36,1,'31-May-2019','12:50:58'),
(37,1,'03-Jun-2019','10:12:24'),
(38,1,'03-Jun-2019','10:12:46'),
(39,1,'03-Jun-2019','10:13:26'),
(40,1,'03-Jun-2019','10:14:52'),
(41,1,'03-Jun-2019','10:15:26'),
(42,1,'03-Jun-2019','11:14:40'),
(43,1,'06-Sep-2019','17:17:58'),
(44,1,'06-Sep-2019','17:20:38'),
(45,1,'14-Oct-2019','12:53:31'),
(46,1,'25-Oct-2019','13:17:42'),
(47,1,'25-Oct-2019','13:19:24'),
(48,1,'25-Oct-2019','13:20:33'),
(49,1,'25-Oct-2019','13:21:00'),
(50,1,'25-Oct-2019','13:25:47'),
(51,1,'25-Oct-2019','13:27:03'),
(52,1,'25-Oct-2019','13:27:41'),
(53,1,'25-Oct-2019','13:30:43'),
(54,1,'25-Oct-2019','13:43:21'),
(55,1,'25-Oct-2019','13:47:54'),
(56,1,'25-Oct-2019','13:50:00'),
(57,1,'25-Oct-2019','13:51:03'),
(58,1,'25-Oct-2019','13:51:42'),
(59,1,'25-Oct-2019','15:08:20'),
(60,1,'25-Oct-2019','15:09:02'),
(61,1,'25-Oct-2019','15:15:02'),
(62,1,'25-Oct-2019','15:16:55'),
(63,1,'25-Oct-2019','15:17:12'),
(64,1,'25-Oct-2019','15:18:02'),
(65,1,'25-Oct-2019','15:20:57'),
(66,1,'25-Oct-2019','15:24:58'),
(67,1,'30-Oct-2019','21:07:02'),
(68,1,'08-Nov-2019','14:08:33'),
(69,1,'08-Nov-2019','14:23:42'),
(70,1,'15-Nov-2019','11:18:51'),
(71,1,'15-Nov-2019','11:19:33'),
(72,1,'15-Nov-2019','11:21:14'),
(73,1,'18-Nov-2019','23:25:13'),
(74,1,'13-Dec-2019','18:34:27'),
(75,1,'16-Dec-2019','21:35:50'),
(76,1,'16-Dec-2019','21:42:01'),
(77,1,'24-Dec-2019','13:53:42'),
(78,1,'24-Dec-2019','14:24:34'),
(79,1,'24-Dec-2019','14:25:15'),
(80,NULL,'29-Dec-2019','11:53:29');

/*Table structure for table `tbl_option_result` */

DROP TABLE IF EXISTS `tbl_option_result`;

CREATE TABLE `tbl_option_result` (
  `option_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_option_id` int(11) DEFAULT NULL,
  `question_option_date_filled` date DEFAULT NULL,
  PRIMARY KEY (`option_result_id`),
  KEY `question_option_id` (`question_option_id`),
  CONSTRAINT `tbl_option_result_ibfk_1` FOREIGN KEY (`question_option_id`) REFERENCES `tbl_question_option` (`question_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_option_result` */

/*Table structure for table `tbl_outbox` */

DROP TABLE IF EXISTS `tbl_outbox`;

CREATE TABLE `tbl_outbox` (
  `outbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `send_date` date DEFAULT NULL,
  `send_time` time DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `email_send_to` varchar(100) DEFAULT NULL,
  `email_sender_id` int(11) DEFAULT NULL,
  `outbox_from` varchar(100) DEFAULT NULL,
  `outbox_subject` varchar(30) DEFAULT NULL,
  `message_send` text,
  `sent_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`outbox_id`),
  KEY `id_event` (`event_id`),
  KEY `guest_id` (`guest_id`),
  KEY `email_sender_id` (`email_sender_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_outbox_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `tbl_event` (`event_id`),
  CONSTRAINT `tbl_outbox_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `tbl_guest` (`guest_id`),
  CONSTRAINT `tbl_outbox_ibfk_3` FOREIGN KEY (`email_sender_id`) REFERENCES `tbl_email_sender` (`email_sender_id`),
  CONSTRAINT `tbl_outbox_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_outbox` */

insert  into `tbl_outbox`(`outbox_id`,`user_id`,`send_date`,`send_time`,`event_id`,`guest_id`,`email_send_to`,`email_sender_id`,`outbox_from`,`outbox_subject`,`message_send`,`sent_status`) values 
(20,1,'2019-05-28','16:05:39',1,10,'krisnaarinasta@student.unud.ac.id',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Nyepi','Nyepi is a Balinese \"Day of Silence\" that is commemorated every Isakawarsa (Saka new year) according to the Balinese calendar (in 2019, it falls on March 7). It is a Hindu celebration mainly celebrated in Bali, Indonesia. Nyepi, a public holiday in Indonesia, is a day of silence, fasting and meditation for the Balinese. The day following Nyepi is also celebrated as New Year\'s Day.[1][2] On this day, the youth of Bali in the village of Sesetan in South Bali practice the ceremony of Omed-omedan or \'The Kissing Ritual\' to celebrate the new year. The same day celebrated in India as Ugadi. ',1),
(22,1,'2019-05-31','13:02:09',NULL,10,'I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>',1,'Hotel Name Here','Re: Email marketing test','<blockquote>\r\n<h1><em><strong>send email test <s>1.6 </s>1.7</strong></em></h1>\r\n</blockquote>\r\n',0),
(23,1,'2019-05-31','13:02:13',NULL,10,'I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>',1,'Hotel Name Here','Re: Email marketing test','test test test\r\n',1),
(25,1,'2019-12-13','18:04:30',1,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Ogoh-ogoh Festival & Nyepi','<p>book now for any dates on march 2020 and get so much offer</p>\r\n',1),
(31,1,'2019-12-13','18:23:04',3,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Galungan and Kuningan Day','<h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n',1),
(33,1,'2019-12-14','13:44:42',3,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Galungan and Kuningan Day','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) Nyuh Bengkok Tree Houses</small></h4></div></div></div><strong><h2 class=\"mb-4 mt-4\" align=\"center\">Galungan and Kuningan Day<br><small>2019-12-15</small></h2></strong><div class=\"col-md-12\"><img class=\"col-md-12\" src=\"http://localhost/EmailMarketing/images/event_photos/event_main_photos/Event_1_Galungan_20191029030033.jpg\"></div><p class=\"mb-0 mt-4\"><h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n</p><div class=\"col-md-12\"><h4 align=\"center\" style=\"margin-top:40px; border-top:1px solid #0000003b; padding-top:10px\" >Event&apos;s Photo(s)</h4><div class=\"row\" id=\"eventPhotos\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_20191029030612.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306121.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306123.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306124.jpg\"></div></div>',1);

/*Table structure for table `tbl_question` */

DROP TABLE IF EXISTS `tbl_question`;

CREATE TABLE `tbl_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `questionnaire_id` (`questionnaire_id`),
  CONSTRAINT `tbl_question_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `tbl_questionnaire` (`questionnaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_question` */

insert  into `tbl_question`(`question_id`,`questionnaire_id`,`question`) values 
(1,46,'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.'),
(2,46,'Lorem Ipsum copy in various charsets and languages for layouts. ... Lorem Ipsum is needed for web design, web pages, website templates and CMS.'),
(3,46,'Lorem ipsum dolor sit amet, quas fabellas sed an. Ipsum graece molestiae ne vix. Cetero conclusionemque ei est, alterum similique vituperata ius ne, ferri nulla possit qui te. Solet invenire qui in, vero corpora voluptatibus vix et. Eu nonumy quaeque eos,'),
(4,46,'\r\nVim an deseruisse concludaturque. Vim ne error munere complectitur, ad sed quod deserunt delicata, nec omnes assentior voluptatum no. An vim nemore fierent maluisset, movet placerat qui id, at iisque nostrum est. Sit hinc magna habemus ne. Erat feugait '),
(5,46,'Generate Lorem Ipsum placeholder text for use in your graphic, print and web layouts, and discover plugins for your favorite writing, design and blogging tools.');

/*Table structure for table `tbl_question_option` */

DROP TABLE IF EXISTS `tbl_question_option`;

CREATE TABLE `tbl_question_option` (
  `question_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `question_option_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`question_option_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `tbl_question_option_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_question_option` */

insert  into `tbl_question_option`(`question_option_id`,`question_id`,`question_option_value`) values 
(1,1,'1'),
(2,1,'2'),
(3,1,'3'),
(4,2,'a'),
(5,2,'b'),
(6,2,'c'),
(7,2,'d'),
(8,3,'true'),
(9,3,'false'),
(10,4,'oke'),
(11,4,'cool'),
(12,4,'greate'),
(13,4,'perfect'),
(14,5,'50'),
(15,5,'100'),
(16,5,'150'),
(17,5,'200'),
(18,5,'250');

/*Table structure for table `tbl_questionnaire` */

DROP TABLE IF EXISTS `tbl_questionnaire`;

CREATE TABLE `tbl_questionnaire` (
  `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `questionnaire_name` varchar(50) DEFAULT NULL,
  `questionnaire_date_create` date DEFAULT NULL,
  `questionnaire_send_on` date DEFAULT NULL,
  `questionnaire_message` text,
  PRIMARY KEY (`questionnaire_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_questionnaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_questionnaire` */

insert  into `tbl_questionnaire`(`questionnaire_id`,`user_id`,`questionnaire_name`,`questionnaire_date_create`,`questionnaire_send_on`,`questionnaire_message`) values 
(4,2,'New Questioner','2019-12-11','2019-12-31','<p>New Questioner</p>\r\n'),
(46,1,'Questionnaire for diskon','2019-12-11','2019-12-30','<p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s</p>\r\n');

/*Table structure for table `tbl_send_questionnaire` */

DROP TABLE IF EXISTS `tbl_send_questionnaire`;

CREATE TABLE `tbl_send_questionnaire` (
  `send_questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`send_questionnaire_id`),
  KEY `questionnaire_id` (`questionnaire_id`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `tbl_send_questionnaire_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `tbl_questionnaire` (`questionnaire_id`),
  CONSTRAINT `tbl_send_questionnaire_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `tbl_guest` (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_send_questionnaire` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `property_name` varchar(100) DEFAULT NULL,
  `property_address` varchar(255) DEFAULT NULL,
  `property_website` varchar(100) DEFAULT NULL,
  `property_logo` varchar(255) DEFAULT NULL,
  `API_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `user_status_active` tinyint(1) DEFAULT NULL,
  `admin_id_approver` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `admin_id_aprover` (`admin_id_approver`),
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`admin_id_approver`) REFERENCES `tbl_admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`email`,`password`,`property_name`,`property_address`,`property_website`,`property_logo`,`API_key`,`secret_key`,`user_status_active`,`admin_id_approver`) values 
(1,'krisnaarinasta@gmail.com','123','Nyuh Bengkok Tree Houses','Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) ','Nyuh Bengkok Tree Houses','Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg','ujfbcjudjn773hl2jfjsda8712polasl31982','jfghj76jhgr123',1,1),
(2,'pondokindah@gmail.com','123','Pondok Indah Villa',NULL,NULL,'dqwdqsadq.jpg','dsajhgfdjhs72613jskad263dsajkh782672d','shfdjk23742136',1,1),
(4,'a','a','a',NULL,NULL,NULL,NULL,NULL,NULL,1),
(5,'b','b','b',NULL,NULL,NULL,'01081920191101Lz5HpNUi9roCwSRbqycQAKvhs7kfmeal8xO436tuTIMnjF21BPGJ0gEdD20191101010819','0108192019110101081920191101Lz5HpNUi9roCwSRbqycQAKvhs7kfmeal8xO436tuTIMnjF21BPGJ0gEdD2019110101081920191101010819',0,NULL);

/* Procedure structure for procedure `masuk` */

/*!50003 DROP PROCEDURE IF EXISTS  `masuk` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `masuk`(in email int)
BEGIN
    DECLARE i INTEGER;
    set i = 0;
	while (i<270) do
		insert into tbl_outbox (send_date,email_sender_id,message_send,sent_status) values (curdate(),email, "dummy",1);
		set i=i+1;
	end while;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
