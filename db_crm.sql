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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_email_sender` */

insert  into `tbl_email_sender`(`email_sender_id`,`user_id`,`email`,`password`,`inbox_host`,`sender_host`,`limit_email`,`email_status_active`) values 
(1,1,'krisnaarinasta@gmail.com','jimmysul7xx','{imap.gmail.com:993/imap/ssl}INBOX','ssl://smtp.googlemail.com',250,0),
(2,2,'krisnaarynasta@gmail.com','jimmysul7xx','{imap.gmail.com:993/imap/ssl}INBOX','ssl://smtp.googlemail.com',250,1),
(3,2,'krisnaarinasta@rocketmail.com','jimmysulivan','{imap.mail.yahoo.com:993/imap/ssl}INBOX','ssl://smtp.mail.yahoo.com',250,1),
(8,1,'nyuhbengkok-treehouse@krisnaarynasta.com','wh0sy0urdaddy?','{mail.krisnaarynasta.com:993/imap/ssl}','ssl://mail.krisnaarynasta.com',100,1);

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
(1,1,'Ogoh-ogoh Festival & Nyepi','2020-05-31','Nyepi is a Balinese \"Day of Silence\" that is commemorated every Isakawarsa (Saka new year) according to the Balinese calendar (in 2019, it falls on March 7). It is a Hindu celebration mainly celebrated in Bali, Indonesia. Nyepi, a public holiday in Indonesia, is a day of silence, fasting and meditation for the Balinese. The day following Nyepi is also celebrated as New Year\'s Day.[1][2] On this day, the youth of Bali in the village of Sesetan in South Bali practice the ceremony of Omed-omedan or \'The Kissing Ritual\' to celebrate the new year. The same day celebrated in India as Ugadi. ','<p>book now for any dates on march 2020 and get so much offer</p>\r\n',66,'Event_1_Nyepi_20191029030003.jpg',1,0),
(2,1,'Christmas Day','2020-12-25','Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25. as a religious and cultural celebration among billions of people around the world.','<p>Christmas is an annual festival commemorating the birth of Jesus Christ observed on December 25. as a religious and cultural celebration among billions of people around the world.</p>\r\n',216,'Event_1_Natal_20191029025924.jpg',1,0),
(3,1,'Galungan and Kuningan Day','2019-12-15','Galungan is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year. ','<h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n',1,'Event_1_Galungan_20191029030033.jpg',1,0),
(7,1,'test paging','2001-07-08','','',10,'Event_1_test_paging_20191030064253.jpg',1,0),
(8,1,'test paging 2 ','2001-07-08','','',10,'Event_1_test_paging_2__20191030064322.jpg',1,0),
(9,1,'test paging 3','2001-07-08','','',10,'Event_1_test_paging_3_20191030064336.jpg',1,0),
(10,1,'test paging 4','2001-07-08','','',10,'Event_1_test_paging_4_20191030064352.jpg',1,0),
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
  `guest_active_status` tinyint(4) DEFAULT NULL,
  `guest_insert_date` date DEFAULT NULL,
  `guest_last_update` date DEFAULT NULL,
  `guest_subscribe_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`guest_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_guest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_guest` */

insert  into `tbl_guest`(`guest_id`,`guest_user_id`,`guest_name`,`guest_email`,`guest_country`,`user_id`,`guest_active_status`,`guest_insert_date`,`guest_last_update`,`guest_subscribe_status`) values 
(1,'NB001','Marl Kurl','ladysiahaan0@gmail.com','italy',2,1,'2019-12-23','2019-12-23',1),
(3,'NB002','Max Maz ','no-reply@mx2.4shared.com','USA',2,1,'2019-12-23','2019-12-23',1),
(5,'NB003','li xuan ye','krisnaarinasta@student.unud.ac.id','China',2,1,'2019-12-23','2019-12-23',1),
(6,'PD001-312','Iwan Wakanai','IW@yahoo.com','Indonesia',2,0,'2019-12-23','2019-12-23',1),
(7,'NB003','Made','putuadhikusuma98@gmail.com','Indonesia',2,1,'2019-12-23','2019-12-23',1),
(8,'NB000','Crisnha','krisnaarinasta@student.unud.ac.id','Maldive',2,0,'2019-12-23','2019-12-24',1),
(9,'NB011','Daily Tropical','dailytropicalbali@gmail.com','Maldive',1,1,'2019-12-23','2020-03-26',1),
(10,'NB007','Dedik Mahardika','krisnaarinasta@student.unud.ac.id','Indonesia',2,0,'2019-12-23','2019-12-24',1),
(12,'TST001','test1xx','test@test.com','testxx',5,0,'2019-12-23','2019-12-23',1),
(14,'PI0071','Li Mien Chok','yolixitest@gmail.com','Taiwan',5,NULL,'2020-03-23','2020-03-23',1),
(15,'NB012','Huw Xie Coe','krisnaarinasta@gmail.com','China',1,1,'2020-03-26','2020-04-13',1),
(16,'NB013','Futin White','kknsaktiunud19@gmail.com','Russia',1,0,'2020-03-26','2020-03-26',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_inbox` */

insert  into `tbl_inbox`(`inbox_id`,`user_id`,`message_id`,`inbox_subject`,`guest_id`,`inbox_guest_name`,`inbox_from`,`inbox_to`,`inbox_body`,`seen_status`,`answered_status`,`inbox_date`,`duplicate_status`) values 
(5,1,'<CADrRtahq7g4q_MaMNGcf_4ioVi1NKYpKRFn3bE54002soBfVhg@mail.gmail.com>','Re: Kak maaf saya telatnya udah telat banget, soalnya saya memang tidak mengerti kak mengenai cursor',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','<div dir3D\"auto\">Baik kak,, saya berusaha semampu saya<div dir3D\"auto\">Ma\r\nkasii kakk</div></div><br><div class3D\"gmail_quote\"><div dir3D\"ltr\">Pada \r\ntanggal Sen, 3 Des 2018 10.41 Krisna Arynasta &lt;<a href3D\"mailto:krisnaa\r\nrinasta@gmail.com\">krisnaarinasta@gmail.com</a> menulis:<br></div><blockquo\r\nte class3D\"gmail_quote\" style3D\"margin:0 0 0 .8ex;border-left:1px #ccc so\r\nlid;padding-left:1ex\"><div dir3D\"auto\">iya saya maklumi yg penting km bisa\r\n menjelaskan nantiC2A0</div><br><div class3D\"gmail_quote\"><div dir3D\"lt\r\nr\">On Mon, Dec 3, 2018, 10:27 AM Lady Siahaan &lt;<a href3D\"mailto:ladysia\r\nhaan0@gmail.com\" target3D\"_blank\" rel3D\"noreferrer\">ladysiahaan0@gmail.co\r\nm</a>&gt; wrote:<br></div><blockquote class3D\"gmail_quote\" style3D\"margin\r\n:0 0 0 .8ex;border-left:1px #ccc solid;padding-left:1ex\"><div dir3D\"auto\">\r\n</div>\r\n</blockquote></div>\r\n</blockquote></div>\r\n',1,0,'Mon, 3 Dec 2018 11:08:02 +0800',0),
(6,1,'<CADrRtajYZb=OVhyKHn69xDp4b7LBdW34yAC5238AE3k4CThLwA@mail.gmail.com>','PTBD_18_1705551038_LADY HASIANI SIAHAAN',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','REVMSU1JVEVSICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBF\r\nWElTVFMgYHNwX3RyYW5zY291dGAkJA0KDQpDUkVBVEUgREVGSU5FUj1gcm9vdGBAYGxvY2FsaG9z\r\ndGAgUFJPQ0VEVVJFIGBzcF90cmFuc2NvdXRgKElOIHRhaHVuIElOVCwgSU4gYnVsYW4gSU5ULCBP\r\nVVQgdG90YWxfdHJhbnMgSU5UKQ0KQkVHSU4gU0VUIHRvdGFsX3RyYW5zID0gKFNFTEVDVCAoU1VN\r\nKHRvdGFsX2p1bWxhaCkpIEFTIHRvdGFsX3RyYW5zIEZST00gdHJhbnNhY3Rpb25zIFdIRVJFIFlF\r\nQVIodGdsKT10YWh1biBBTkQgTU9OVEgodGdsKT1idWxhbiBHUk9VUCBCWSBNT05USCh0Z2wpLCBZ\r\nRUFSKHRnbCkpOw0KDQoNCkVORCQkDQoNCkRFTElNSVRFUiA7DQoNCg0KDQoNCg0KREVMSU1JVEVS\r\nICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBFWElTVFMgYGNy\r\nX3RyYW5zYCQkDQoNCkNSRUFURSBERUZJTkVSPWByb290YEBgbG9jYWxob3N0YCBQUk9DRURVUkUg\r\nYGNyX3RyYW5zYChJTiB0YWh1biBJTlQpDQpCRUdJTg0KICAgIERFQ0xBUkUgdGFodW4xIElOVDsN\r\nCiAgICBERUNMQVJFIGlkX2J1bGFuMSBJTlQ7DQogICAgREVDTEFSRSBuYW1hYnVsYW4xIFZBUkNI\r\nQVIoNTApOw0KICAgIERFQ0xBUkUgZG9uZSBJTlQgREVGQVVMVCAwOw0KICAgIA0KICAgIERFQ0xB\r\nUkUgdHJhbnNfY3Vyc29yIENVUlNPUiBGT1IgU0VMRUNUDQogICAgaWRfYnVsYW4sIG5hbWFidWxh\r\nbiBGUk9NIHRiX2J1bGFuIE9SREVSIEJZIChpZF9idWxhbik7DQoJDQoJREVDTEFSRSBDT05USU5V\r\nRSBIQU5ETEVSIEZPUiBTUUxTVEFURSAnMDIwMDAnIFNFVCBkb25lPTE7DQoJDQoJT1BFTiB0cmFu\r\nc19jdXJzb3I7DQoJV0hJTEUgTk9UIGRvbmUgRE8NCglGRVRDSCB0cmFuc19jdXJzb3IgSU5UTyBp\r\nZF9idWxhbjEsbmFtYWJ1bGFuMTsNCglDQUxMIHNwX3RyYW5zY291dCh0YWh1biwgaWRfYnVsYW4x\r\nLCBAc3BfdHJhbnNjb3V0KTsNCgkNCg0KCUlGIEBzcF90cmFuc2NvdXQgSVMgTlVMTCBUSEVOIA0K\r\nCQlTRVQgQHNwX3RyYW5zY291dD0wOw0KCUVORCBJRjsNCgkNCglJRiBOT1QgZG9uZSBUSEVODQoJ\r\nCUlOU0VSVCBJTlRPIGR1bW15IFZBTFVFUygnJyxpZF9idWxhbjEsIG5hbWFidWxhbjEsIEBzcF90\r\ncmFuc2NvdXQpOw0KCUVORCBJRjsNCgkNCgkgICBFTkQgV0hJTEU7DQoJQ0xPU0UgdHJhbnNfY3Vy\r\nc29yOw0KICAgIEVORCQkDQoNCkRFTElNSVRFUiA7DQo',1,0,'Mon, 3 Dec 2018 10:32:15 +0800',0),
(7,1,'<CADrRtajKrrHpxOHeXPaGH+4VsuEF2q=ngkrpmVqDGtd7Ryx3Lg@mail.gmail.com>','Kak maaf saya telatnya udah telat banget, soalnya saya memang tidak mengerti kak mengenai cursor. Da',1,'Marl Kurl','Lady Siahaan <ladysiahaan0@gmail.com>','krisnaarinasta@gmail.com','REVMSU1JVEVSICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBF\r\nWElTVFMgYHNwX3RyYW5zY291dGAkJA0KDQpDUkVBVEUgREVGSU5FUj1gcm9vdGBAYGxvY2FsaG9z\r\ndGAgUFJPQ0VEVVJFIGBzcF90cmFuc2NvdXRgKElOIHRhaHVuIElOVCwgSU4gYnVsYW4gSU5ULCBP\r\nVVQgdG90YWxfdHJhbnMgSU5UKQ0KQkVHSU4gU0VUIHRvdGFsX3RyYW5zID0gKFNFTEVDVCAoU1VN\r\nKHRvdGFsX2p1bWxhaCkpIEFTIHRvdGFsX3RyYW5zIEZST00gdHJhbnNhY3Rpb25zIFdIRVJFIFlF\r\nQVIodGdsKT10YWh1biBBTkQgTU9OVEgodGdsKT1idWxhbiBHUk9VUCBCWSBNT05USCh0Z2wpLCBZ\r\nRUFSKHRnbCkpOw0KDQoNCkVORCQkDQoNCkRFTElNSVRFUiA7DQoNCg0KDQoNCg0KREVMSU1JVEVS\r\nICQkDQoNClVTRSBgZGJfYmVuZ2tlbGAkJA0KDQpEUk9QIFBST0NFRFVSRSBJRiBFWElTVFMgYGNy\r\nX3RyYW5zYCQkDQoNCkNSRUFURSBERUZJTkVSPWByb290YEBgbG9jYWxob3N0YCBQUk9DRURVUkUg\r\nYGNyX3RyYW5zYChJTiB0YWh1biBJTlQpDQpCRUdJTg0KICAgIERFQ0xBUkUgdGFodW4xIElOVDsN\r\nCiAgICBERUNMQVJFIGlkX2J1bGFuMSBJTlQ7DQogICAgREVDTEFSRSBuYW1hYnVsYW4xIFZBUkNI\r\nQVIoNTApOw0KICAgIERFQ0xBUkUgZG9uZSBJTlQgREVGQVVMVCAwOw0KICAgIA0KICAgIERFQ0xB\r\nUkUgdHJhbnNfY3Vyc29yIENVUlNPUiBGT1IgU0VMRUNUDQogICAgaWRfYnVsYW4sIG5hbWFidWxh\r\nbiBGUk9NIHRiX2J1bGFuIE9SREVSIEJZIChpZF9idWxhbik7DQoJDQoJREVDTEFSRSBDT05USU5V\r\nRSBIQU5ETEVSIEZPUiBTUUxTVEFURSAnMDIwMDAnIFNFVCBkb25lPTE7DQoJDQoJT1BFTiB0cmFu\r\nc19jdXJzb3I7DQoJV0hJTEUgTk9UIGRvbmUgRE8NCglGRVRDSCB0cmFuc19jdXJzb3IgSU5UTyBp\r\nZF9idWxhbjEsbmFtYWJ1bGFuMTsNCglDQUxMIHNwX3RyYW5zY291dCh0YWh1biwgaWRfYnVsYW4x\r\nLCBAc3BfdHJhbnNjb3V0KTsNCgkNCg0KCUlGIEBzcF90cmFuc2NvdXQgSVMgTlVMTCBUSEVOIA0K\r\nCQlTRVQgQHNwX3RyYW5zY291dD0wOw0KCUVORCBJRjsNCgkNCglJRiBOT1QgZG9uZSBUSEVODQoJ\r\nCUlOU0VSVCBJTlRPIGR1bW15IFZBTFVFUygnJyxpZF9idWxhbjEsIG5hbWFidWxhbjEsIEBzcF90\r\ncmFuc2NvdXQpOw0KCUVORCBJRjsNCgkNCgkgICBFTkQgV0hJTEU7DQoJQ0xPU0UgdHJhbnNfY3Vy\r\nc29yOw0KICAgIEVORCQkDQoNCkRFTElNSVRFUiA7DQo',1,1,'Mon, 3 Dec 2018 10:27:14 +0800',0),
(9,1,'<CAKWndJ1V+Y4zo3pUUdVF-CH6a49krtCd_q3WJOxFoFnt82gYwg@mail.gmail.com>','Email marketing test',10,'Dedik Mahardika','I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>','krisnaarinasta@gmail.com','<div dir\"ltr\">test 1.0<br></div>\r\n',1,0,'Thu, 23 May 2019 11:05:33 +080',0),
(11,1,'<CAKWndJ0owJXBSoB=R4k0WosA=P4sE58MOm-M=LTGrvY-cbdUyg@mail.gmail.com>','test',10,'Dedik Mahardika','I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>','krisnaarinasta@rocketmail.com','<div dir\"ltr\"><br></div>\r\n',1,0,'Fri, 24 May 2019 10:57:14 +080',0),
(25,1,'<CAF5jq8cEMHQeBo9r1cQepEw6uthab69xsz93xqCcQcT0FjKqcQ@mail.gmail.com>','test imap',9,'Daily Tropical','Daily Tropical Bali <dailytropicalbali@gmail.com>','krisnaarinasta@gmail.com','<div dir\"auto\">test 1 2 3</div>\r\n',1,0,'Mon, 23 Mar 2020 21:28:45 +080',0),
(26,1,'<CAF5jq8diSaVk4JWWQV+wyi0L-qheJbhFqFmwVb_8T4QyJ0FNVA@mail.gmail.com>','forwarding email',9,'Daily Tropical','Daily Tropical Bali <dailytropicalbali@gmail.com>','krisnaarinasta@gmail.com','<div dir3D\"auto\"><div style3D\"font-family:sans-serif;font-size:13.696px\" \r\ndir3D\"auto\"><br><div style3D\"height:80px\"></div><div style3D\"width:328px\r\n;margin:16px 0px\"><div><u></u><div style3D\"color:rgb(10,10,10);font-family\r\n:roboto,sans-serif;font-size:16px;line-height:1.3;margin:0px;min-width:100%\r\n;padding:0px;width:328px\"><table style3D\"background-color:rgb(246,247,248)\r\n;border-collapse:collapse;border-color:transparent;border-spacing:0px;heigh\r\nt:1621px;line-height:1.3;margin:0px;padding:0px;vertical-align:top;width:32\r\n8px\"><tbody><tr style3D\"padding:0px;vertical-align:top\"><td align3D\"cente\r\nr\" valign3D\"top\" style3D\"line-height:1.3;margin:0px;padding:0px;vertical-\r\nalign:top;word-wrap:break-word;border-collapse:collapse!important\"><center \r\nstyle3D\"min-width:580px;width:328px\"><table style3D\"border-collapse:colla\r\npse;border-color:transparent;border-spacing:0px;float:none;margin:0px auto;\r\npadding:0px;vertical-align:top;width:328px\"><tbody><tr style3D\"padding:0px\r\n;vertical-align:top\"><td height3D\"0\" style3D\"font-size:40px;line-height:4\r\n0px;margin:0px;padding:0px;vertical-align:top;word-wrap:break-word;border-c\r\nollapse:collapse!important\">C2A0</td></tr></tbody></table><table align3D\r\n\"center\" style3D\"width:580px;background:0px 0px;border-collapse:collapse;b\r\norder-color:transparent;border-spacing:0px;float:none;margin:0px auto;paddi\r\nng:0px;vertical-align:top;max-width:580px\"><tbody><tr style3D\"padding:0px;\r\nvertical-align:top\"><td style3D\"line-height:1.3;margin:0px;padding:0px;ver\r\ntical-align:top;word-wrap:break-word;border-collapse:collapse!important\"><t\r\nable style3D\"background:0px 0px;border-collapse:collapse;border-color:tran\r\nsparent;border-spacing:0px;padding:0px;vertical-align:top;width:311px\"><tbo\r\ndy><tr style3D\"padding:0px;vertical-align:top\"><th style3D\"width:200px;pa\r\ndding:0px;font-weight:400;line-height:1.3;margin:0px auto;text-align:left;d\r\nisplay:inline-block!important;height:auto!important\"><table style3D\"border\r\n-collapse:collapse;border-color:transparent;border-spacing:0px;padding:0px;\r\nvertical-align:top;width:311px\"><tbody><tr style3D\"padding:0px;vertical-al\r\nign:top\"><th valign3D\"middle\" height3D\"49\" style3D\"font-weight:400;line-\r\nheight:1.3;margin:0px;padding:0px;text-align:left\"><img width3D\"200\" src\r\n3D\"https://client.jetorbit.com/img/logo-pos.png\" alt3D\"\" style3D\"margin:\r\n 0px auto; width: auto; height: auto; display: block; max-width: 220px; out\r\nline: 0px; max-height: 49px;\"></th></tr></tbody></table></th><th style3D\"w\r\nidth:320px;padding:0px;font-weight:400;line-height:1.3;margin:0px auto;text\r\n-align:right;vertical-align:middle;display:inline-block!important;height:au\r\nto!important\"><table style3D\"border-collapse:collapse;border-color:transpa\r\nrent;border-spacing:0px;padding:0px;text-align:left;vertical-align:top;widt\r\nh:311px\"><tbody><tr style3D\"padding:0px;text-align:right;vertical-align:to\r\np\"><th style3D\"font-weight:400;line-height:1.3;margin:0px;padding:0px;text\r\n-align:right\"><span style3D\"margin-right:auto;color:rgb(172,176,184);displ\r\nay:table;font-size:12px;line-height:29px;width:311px;margin-left:auto\">Havi\r\nng problems viewing this email?<a href3D\"https://client.jetorbit.com/clien\r\ntarea.php?action3Demails\" style3D\"text-decoration-line:none;margin:0px 0p\r\nx 0px 6px;padding:0px;text-align:left;line-height:8px;color:rgb(124,128,136\r\n)!important\">C2A0View email online</a></span></th></tr></tbody></table></\r\nth></tr></tbody></table></td></tr></tbody></table><table style3D\"border-co\r\nllapse:collapse;border-color:transparent;border-spacing:0px;float:none;marg\r\nin:0px auto;padding:0px;vertical-align:top;width:328px\"><tbody><tr style3D\r\n\"padding:0px;vertical-align:top\"><td height3D\"32px\" style3D\"font-size:32p\r\nx;line-height:32px;margin:0px;padding:0px;vertical-align:top;word-wrap:brea\r\nk-word;border-collapse:collapse!important\">C2A0</td></tr></tbody></table>\r\n<table cellspacing3D\"0\" cellpadding3D\"0\" border3D\"0\" align3D\"center\" st\r\nyle3D\"width:580px;border-bottom-left-radius:3px;border-bottom-right-radius\r\n:3px;border-collapse:collapse;border-color:transparent;border-spacing:0px;f\r\nloat:none;margin:0px auto;padding:0px;vertical-align:top;max-width:580px\"><\r\ntbody><tr style3D\"padding:0px;vertical-align:top\"><td style3D\"line-height\r\n:1.3;margin:0px;padding:0px;vertical-align:top;word-wrap:break-word;border-\r\ncollapse:collapse!important\"><img width3D\"580\" height3D\"8\" src3D\"https:/\r\n/client.jetorbit.com/img/border-top.png\" alt3D\"\" style3D\"width: 311px; he\r\night: auto; display: block; max-width: 580px; outline: 0px; background: whi\r\nte; border-top-left-radius: 3px; border-top-right-radius: 3px; min-width: 1\r\n00%;\"><table style3D\"border-spacing:48px 0px;border-width:0px 1px 1px;bord\r\ner-color:rgb(230,230,230);border-style:solid;border-bottom-left-radius:3px;\r\nborder-bottom-right-radius:3px;padding-bottom:32px;width:309px;background:r\r\ngb(255,255,255);max-width:580px;padding-top:16px!important\"><tbody><tr><td>\r\n<table style3D\"border-collapse:collapse;border-color:transparent;border-sp\r\nacing:0px;padding:0px;vertical-align:top;width:275px\"><tbody><tr style3D\"p\r\nadding:0px;vertical-align:top\"></tr></tbody></table><p>Dear Krisna Arynasta\r\n,</p><p>Berikut ini adalah tanda terima pembayaran untuk invoice nomer 1144\r\n3 dikirim pada 02/01/2020</p><p>Pluto Indonesia -C2A0<a href3D\"http://kr\r\nisnaarynasta.com/\" style3D\"text-decoration-line:none;color:rgb(66,133,244)\r\n\">krisnaarynasta.com</a>C2A0(02/01/2020 - 01/04/2020) Rp. 45,000<br>Lokas\r\ni Server: Indonesia<br>Domain Registration -C2A0<a href3D\"http://krisnaa\r\nrynasta.com/\" style3D\"text-decoration-line:none;color:rgb(66,133,244)\">kri\r\nsnaarynasta.com</a>C2A0- 1 Year/s (02/01/2020 - 01/01/2021) Rp. 115,000<b\r\nr>+ DNS Management<br>+ Email Forwarding<br>-------------------------------\r\n-----------------------<br>Sub Total: Rp. 160,000<br>Credit: Rp. 0<br>Total\r\n: Rp. 160,000</p><p>Amount: Rp. 160,000<br>Transaction #: TRSF E-BANKING CR\r\n 01/02 95031 INVOICE 11443 I PUTU KRISNA ARYNC2A0<br>Total Paid: Rp. 160,\r\n000<br>Remaining Balance: Rp. 0<br>Status: Paid</p><p>You may review your i\r\nnvoice history at any time by logging in to your client area.</p><p>Anda bi\r\nsa melihat sejarah pembayaran anda kapan saja melalui client area.</p><p>No\r\nte: Email ini adalah bukti pembayaran resmi.</p><p><br>- Jetorbit.com - Lay\r\nanan Web Hosting &amp; Domain -</p></td></tr></tbody></table><table style\r\n3D\"border-collapse:collapse;border-color:transparent;border-spacing:0px;pa\r\ndding:0px;vertical-align:top;width:311px\"><tbody><tr style3D\"padding:0px;v\r\nertical-align:top\"><td height3D\"40px\" style3D\"font-size:40px;line-height:\r\n40px;margin:0px;padding:0px;vertical-align:top;word-wrap:break-word;border-\r\ncollapse:collapse!important\">C2A0</td></tr></tbody></table><table align\r\n3D\"left\" style3D\"width:580px;background-image:initial;background-position\r\n:initial;background-size:initial;background-repeat:initial;background-origi\r\nn:initial;background-clip:initial;border-collapse:collapse;border-color:tra\r\nnsparent;border-spacing:0px;margin:0px auto;padding:0px;text-align:inherit;\r\nvertical-align:top\"><tbody><tr style3D\"padding:0px;vertical-align:top\"><td\r\n style3D\"line-height:1.3;margin:0px;padding:0px;vertical-align:top;word-wr\r\nap:break-word;border-collapse:collapse!important\"><table style3D\"border-co\r\nllapse:collapse;border-color:transparent;border-spacing:0px;padding:0px;ver\r\ntical-align:top;width:295px\"><tbody><tr style3D\"padding:0px;vertical-align\r\n:top\"><th style3D\"width:338.67px;font-weight:400;line-height:1.3;margin:0p\r\nx auto;text-align:left;vertical-align:middle;display:inline-block!important\r\n;height:auto!important;padding:0px!important\"><table style3D\"border-collap\r\nse:collapse;border-color:transparent;border-spacing:0px;padding:0px;vertica\r\nl-align:top;width:295px\"><tbody><tr style3D\"padding:0px;vertical-align:top\r\n\"><th style3D\"font-weight:400;line-height:1.3;margin:0px;text-align:left;p\r\nadding:0px!important\"><p style3D\"line-height:1.3;margin-right:0px;margin-l\r\neft:0px;margin-bottom:10px;padding:0px;margin-top:10px!important\"><a href\r\n3D\"https://www.jetorbit.com/\" style3D\"text-decoration-line:none;color:rgb\r\n(12,112,222);line-height:1.3;margin:0px;padding:0px\"><b style3D\"border-bot\r\ntom:none;border-top:none\">Jetorbit.com</b></a></p></th></tr></tbody></table\r\n></th><th style3D\"width:120px;font-weight:400;line-height:1.3;margin:0px a\r\nuto;text-align:left;display:inline-block!important;height:auto!important;pa\r\ndding:0px!important\"><table style3D\"border-collapse:collapse;border-color:\r\ntransparent;border-spacing:0px;padding:0px;vertical-align:top;width:295px\">\r\n<tbody><tr style3D\"padding:0px;vertical-align:top\"><th style3D\"font-weigh\r\nt:400;line-height:1.3;margin:0px;text-align:left;padding:0px!important\"><ta\r\nble style3D\"width:auto;border-collapse:collapse;border-color:transparent;p\r\nadding:0px;vertical-align:top;margin-left:auto;border-spacing:0px\"><tbody><\r\ntr style3D\"padding:0px;vertical-align:top\"><td style3D\"line-height:1.3;ma\r\nrgin:0px;padding:0px;vertical-align:top;word-wrap:break-word;width:auto!imp\r\nortant;display:inline-block!important;border-collapse:collapse!important\"><\r\ntable style3D\"border-collapse:collapse;border-color:transparent;border-spa\r\ncing:0px;padding:0px;vertical-align:top;width:295px\"><tbody><tr style3D\"pa\r\ndding:0px;vertical-align:top\"><th width3D\"16px\" style3D\"width:16px;displa\r\ny:inline-block;font-weight:400;line-height:1.3;margin:0px;padding:0px!impor\r\ntant\"></th><th style3D\"min-width:50px;float:none;font-weight:400;line-heig\r\nht:1.3;margin:0px auto;text-align:center;width:auto!important;display:inlin\r\ne-block!important;padding:4px 0px!important\"><a href3D\"https://www.faceboo\r\nk.com/jetorbithost/\" style3D\"text-decoration-line:none;color:rgb(0,87,255)\r\n;line-height:1.3;margin:0px;padding:0px;text-align:left\"><span style3D\"flo\r\nat:right;height:42px;width:42px\"><img src3D\"https://client.jetorbit.com/im\r\ng/fb.png\" alt3D\"\" style3D\"width: auto; height: auto; border: none; displa\r\ny: block; max-width: 100%; outline: 0px;\"></span></a></th><th width3D\"16px\r\n\" style3D\"width:16px;display:inline-block;font-weight:400;line-height:1.3;\r\nmargin:0px;padding:0px!important\"></th><th style3D\"min-width:50px;float:no\r\nne;font-weight:400;line-height:1.3;margin:0px auto;text-align:center;width:\r\nauto!important;display:inline-block!important;padding:4px 0px!important\"><a\r\n href3D\"https://jto.us/reviewjetorbit\" style3D\"text-decoration-line:none;\r\ncolor:rgb(0,87,255);line-height:1.3;margin:0px;padding:0px;text-align:left\"\r\n><span style3D\"float:right;height:42px;width:42px\"><img src3D\"https://cli\r\nent.jetorbit.com/img/g.png\" alt3D\"\" style3D\"width: auto; height: auto; bo\r\nrder: none; display: block; max-width: 100%; outline: 0px;\"></span></a></th\r\n><th width3D\"16px\" style3D\"width:16px;display:inline-block;font-weight:40\r\n0;line-height:1.3;margin:0px;padding:0px!important\"></th><th style3D\"min-w\r\nidth:50px;float:none;font-weight:400;line-height:1.3;margin:0px auto;text-a\r\nlign:center;width:auto!important;display:inline-block!important;padding:4px\r\n 0px!important\"><a href3D\"https://twitter.com/jetorbithost\" style3D\"text-\r\ndecoration-line:none;color:rgb(0,87,255);line-height:1.3;margin:0px;padding\r\n:0px;text-align:left\"><span style3D\"float:right;height:42px;width:42px\"><i\r\nmg src3D\"https://client.jetorbit.com/img/t.png\" alt3D\"\" style3D\"width: a\r\nuto; height: auto; border: none; display: block; max-width: 100%; outline: \r\n0px;\"></span></a></th><th width3D\"16px\" style3D\"width:16px;display:inline\r\n-block;font-weight:400;line-height:1.3;margin:0px;padding:0px!important\"></\r\nth><th style3D\"min-width:50px;float:none;font-weight:400;line-height:1.3;m\r\nargin:0px auto;text-align:center;width:auto!important;display:inline-block!\r\nimportant;padding:4px 0px!important\"><a href3D\"https://www.linkedin.com/co\r\nmpany/jetorbit/\" style3D\"text-decoration-line:none;color:rgb(0,87,255);lin\r\ne-height:1.3;margin:0px;padding:0px;text-align:left\"><span style3D\"float:r\r\night;height:42px;width:42px\"><img src3D\"https://client.jetorbit.com/img/li\r\nnkedin.png\" alt3D\"\" style3D\"width: auto; height: auto; border: none; disp\r\nlay: block; max-width: 100%; outline: 0px;\"></span></a></th><th width3D\"16\r\npx\" style3D\"width:16px;display:inline-block;font-weight:400;line-height:1.\r\n3;margin:0px;padding:0px!important\"></th><th style3D\"min-width:50px;float:\r\nnone;font-weight:400;line-height:1.3;margin:0px auto;text-align:center;widt\r\nh:auto!important;display:inline-block!important;padding:4px 0px!important\">\r\n<a href3D\"https://www.youtube.com/channel/UCS3VaYoWcsmHV7fbL_dATTg\" style\r\n3D\"text-decoration-line:none;color:rgb(0,87,255);line-height:1.3;margin:0p\r\nx;padding:0px;text-align:left\"><span style3D\"float:right;height:42px;width\r\n:42px\"><img src3D\"https://client.jetorbit.com/img/youtube.png\" alt3D\"\" st\r\nyle3D\"width: auto; height: auto; border: none; display: block; max-width: \r\n100%; outline: 0px;\"></span></a></th><th width3D\"16px\" style3D\"width:16px\r\n;display:inline-block;font-weight:400;line-height:1.3;margin:0px;padding:0p\r\nx!important\"></th><th style3D\"min-width:50px;float:none;font-weight:400;li\r\nne-height:1.3;margin:0px auto;text-align:center;width:auto!important;displa\r\ny:inline-block!important;padding:4px 0px!important\"><a href3D\"https://www.\r\ninstagram.com/jetorbit/\" style3D\"text-decoration-line:none;color:rgb(0,87,\r\n255);line-height:1.3;margin:0px;padding:0px;text-align:left\"><span style3D\r\n\"float:right;height:42px;width:42px\"><img src3D\"https://client.jetorbit.co\r\nm/img/instagram.png\" alt3D\"\" style3D\"width: auto; height: auto; border: n\r\none; display: block; max-width: 100%; outline: 0px;\"></span></a></th></tr><\r\n/tbody></table></td></tr></tbody></table></th></tr></tbody></table></th></t\r\nr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><tabl\r\ne style3D\"border-collapse:collapse;border-color:transparent;border-spacing\r\n:0px;float:none;margin:0px auto;padding:0px;vertical-align:top;width:328px\"\r\n><tbody><tr style3D\"padding:0px;vertical-align:top\"><td height3D\"40px\" st\r\nyle3D\"font-size:40px;line-height:40px;margin:0px;padding:0px;vertical-alig\r\nn:top;word-wrap:break-word;border-collapse:collapse!important\">C2A0</td><\r\n/tr></tbody></table><hr align3D\"center\" style3D\"background:rgb(221,222,22\r\n3);border:none;color:rgb(221,222,223);height:1px;margin-bottom:0px;margin-t\r\nop:0px\"><table align3D\"center\" style3D\"width:580px;background-image:initi\r\nal;background-position:initial;background-size:initial;background-repeat:in\r\nitial;background-origin:initial;background-clip:initial;border-collapse:col\r\nlapse;border-color:transparent;border-spacing:0px;float:none;margin:0px aut\r\no;padding:0px;vertical-align:top\"><tbody><tr style3D\"padding:0px;vertical-\r\nalign:top\"><td style3D\"line-height:1.3;margin:0px;padding:0px;vertical-ali\r\ngn:top;word-wrap:break-word;border-collapse:collapse!important\"><table styl\r\ne3D\"border-collapse:collapse;border-color:transparent;border-spacing:0px;p\r\nadding:0px;vertical-align:top;width:311px\"><tbody><tr style3D\"padding:0px;\r\nvertical-align:top\"><td><table style3D\"border-collapse:collapse;border-col\r\nor:transparent;border-spacing:0px;padding:0px;vertical-align:top;width:309p\r\nx\"><tbody><tr style3D\"padding:0px;vertical-align:top\"><th style3D\"width:5\r\n32px;font-weight:400;line-height:1.3;margin:0px auto;text-align:left;displa\r\ny:inline-block!important;height:auto!important;padding:0px!important\"><tabl\r\ne style3D\"border-collapse:collapse;border-color:transparent;border-spacing\r\n:0px;padding:0px;vertical-align:top;width:309px\"><tbody><tr style3D\"paddin\r\ng:0px;vertical-align:top\"><th style3D\"font-weight:400;line-height:1.3;marg\r\nin:0px;text-align:left;padding:0px!important\"><table style3D\"border-collap\r\nse:collapse;border-color:transparent;border-spacing:0px;padding:0px;vertica\r\nl-align:top;width:309px;background-image:initial;background-position:initia\r\nl;background-size:initial;background-repeat:initial;background-origin:initi\r\nal;background-clip:initial\"><tbody><tr style3D\"padding:0px;vertical-align:\r\ntop\"><td height3D\"16px\" style3D\"line-height:16px;margin:0px;padding:0px;v\r\nertical-align:top;word-wrap:break-word;border-collapse:collapse!important\">\r\nC2A0</td></tr></tbody></table><table style3D\"font-size:12px;line-height:\r\n1.3;margin:0px;padding:0px;border-spacing:0px!important\"><tbody><tr><th ali\r\ngn3D\"left\" style3D\"width:124px;display:block!important;height:auto!import\r\nant;padding-left:0px!important;padding-right:0px!important;text-align:left!\r\nimportant\"><a href3D\"https://client.jetorbit.com/clientarea.php\" style3D\"\r\ntext-decoration-line:none;color:rgb(12,112,222);font-weight:400;display:inl\r\nine-block;margin:0px;padding:0px;line-height:18px\"><font color3D\"#0C70DE\">\r\nLogin to your account</font></a></th><th width3D\"16px\" style3D\"width:16px\r\n;display:inline-block;font-size:16px;font-weight:400;line-height:1.3;margin\r\n:0px;padding:0px!important\"></th><th align3D\"left\" style3D\"width:124px;di\r\nsplay:block!important;height:auto!important;padding-left:0px!important;padd\r\ning-right:0px!important;text-align:left!important\"><a href3D\"https://jto.u\r\ns/bantuan\" style3D\"text-decoration-line:none;color:rgb(12,112,222);font-we\r\night:400;display:inline-block;margin:0px;padding:0px;line-height:18px\"><fon\r\nt color3D\"#0C70DE\">Support</font></a></th><th width3D\"16px\" style3D\"widt\r\nh:16px;display:inline-block;font-size:16px;font-weight:400;line-height:1.3;\r\nmargin:0px;padding:0px!important\"></th><th align3D\"left\" style3D\"width:12\r\n4px;display:block!important;height:auto!important;padding-left:0px!importan\r\nt;padding-right:0px!important;text-align:left!important\"><a href3D\"https:/\r\n/www.jetorbit.com/aturan-layanan/\" style3D\"text-decoration-line:none;color\r\n:rgb(12,112,222);font-weight:400;display:inline-block;margin:0px;padding:0p\r\nx;line-height:18px\"><font color3D\"#0C70DE\">Aturan Layanan</font></a></th><\r\nth width3D\"16px\" style3D\"width:16px;display:inline-block;font-size:16px;f\r\nont-weight:400;line-height:1.3;margin:0px;padding:0px!important\"></th><th a\r\nlign3D\"left\" style3D\"width:124px;display:block!important;height:auto!impo\r\nrtant;padding-left:0px!important;padding-right:0px!important;text-align:lef\r\nt!important\"><a href3D\"https://www.jetorbit.com/promo/\" style3D\"text-deco\r\nration-line:none;color:rgb(12,112,222);font-weight:400;display:inline-block\r\n;margin:0px;padding:0px;line-height:18px\"><font color3D\"#0C70DE\">Promo</fo\r\nnt></a></th><th width3D\"16px\" style3D\"width:16px;display:inline-block;fon\r\nt-size:16px;font-weight:400;line-height:1.3;margin:0px;padding:0px!importan\r\nt\"></th></tr></tbody></table><table style3D\"border-collapse:collapse;borde\r\nr-color:transparent;border-spacing:0px;padding:0px;vertical-align:top;width\r\n:309px;background-image:initial;background-position:initial;background-size\r\n:initial;background-repeat:initial;background-origin:initial;background-cli\r\np:initial\"><tbody><tr style3D\"padding:0px;vertical-align:top\"><td height\r\n3D\"16px\" style3D\"line-height:16px;margin:0px;padding:0px;vertical-align:t\r\nop;word-wrap:break-word;border-collapse:collapse!important\">C2A0</td></tr\r\n></tbody></table><span style3D\"color:rgb(172,176,184);font-size:11px;line-\r\nheight:18px;padding-bottom:30px\">C2A9 2019 PT Jetorbit Teknologi Indonesi\r\na</span></th><th style3D\"font-weight:400;line-height:1.3;margin:0px;text-a\r\nlign:left;width:0px;padding:0px!important\"></th></tr></tbody></table></th><\r\n/tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></c\r\nenter></td></tr></tbody></table><table style3D\"border-collapse:collapse;bo\r\nrder-color:transparent;border-spacing:0px;padding:0px;vertical-align:top;wi\r\ndth:328px;background:rgb(246,247,248)\"><tbody><tr style3D\"padding:0px;vert\r\nical-align:top\"><td height3D\"24px\" style3D\"line-height:16px;margin:0px;pa\r\ndding:0px;vertical-align:top;word-wrap:break-word;border-collapse:collapse!\r\nimportant\">C2A0</td></tr></tbody></table></div></div></div><div style3D\"\r\nheight:186px\"></div></div><div style3D\"font-family:sans-serif;font-size:13\r\n.696px;height:80px\" dir3D\"auto\"></div><br></div>\r\n',1,0,'Thu, 2 Jan 2020 13:52:07 +0800',0),
(27,1,'<CAF5jq8f_o1UNRVX9JpvqGGjtXuSerCUEYTg3mC7zCbbDdp6VpA@mail.gmail.com>','test email',9,'Daily Tropical','Daily Tropical Bali <dailytropicalbali@gmail.com>','krisnaarinasta@gmail.com','<div dir3D\"auto\">test email in hostingC2A0</div>\r\n',1,0,'Thu, 2 Jan 2020 13:49:58 +0800',0),
(31,1,'<CACMK5GASeuWQEE2Vbtg2kPs-z6uqiLsut3vay6vp5NbJL4SOhQ@mail.gmail.com>','testing local email',15,'Huw Xie Coe','Krisna Arynasta <krisnaarinasta@gmail.com>','nyuhbengkok-treehouse@krisnaar','',1,0,'Mon, 13 Apr 2020 15:12:27 +080',0);

/*Table structure for table `tbl_log_load_inbox` */

DROP TABLE IF EXISTS `tbl_log_load_inbox`;

CREATE TABLE `tbl_log_load_inbox` (
  `id_log_inbox` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `last_load_date` varchar(20) DEFAULT NULL,
  `last_load_time` time DEFAULT NULL,
  PRIMARY KEY (`id_log_inbox`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

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
(80,1,'29-Dec-2019','11:53:29'),
(81,1,'02-Jan-2020','13:10:16'),
(82,1,'09-Jan-2020','22:32:05'),
(83,1,'09-Jan-2020','22:43:16'),
(84,1,'09-Jan-2020','22:56:13'),
(85,1,'09-Jan-2020','22:57:39'),
(86,1,'09-Jan-2020','22:59:03'),
(87,1,'23-Mar-2020','20:50:24'),
(88,1,'23-Mar-2020','20:50:33'),
(89,1,'23-Mar-2020','20:50:36'),
(90,1,'23-Mar-2020','20:50:39'),
(91,1,'23-Mar-2020','20:53:45'),
(92,1,'23-Mar-2020','21:17:42'),
(93,1,'23-Mar-2020','21:17:58'),
(94,1,'23-Mar-2020','21:18:27'),
(95,1,'23-Mar-2020','21:23:45'),
(96,1,'23-Mar-2020','21:26:01'),
(97,1,'23-Mar-2020','21:28:10'),
(98,1,'23-Mar-2020','21:29:32'),
(99,1,'23-Mar-2020','21:29:43'),
(100,1,'23-Mar-2020','21:30:46'),
(101,1,'23-Mar-2020','21:31:01'),
(102,1,'23-Mar-2020','21:31:58'),
(103,1,'26-Mar-2020','12:18:22'),
(104,1,'26-Mar-2020','22:23:22'),
(105,1,'26-Mar-2020','22:49:15'),
(106,1,'26-Mar-2020','22:49:30'),
(107,1,'26-Mar-2020','22:50:22'),
(108,1,'26-Mar-2020','22:52:03'),
(109,1,'26-Mar-2020','22:54:01'),
(110,1,'01-Apr-2020','14:11:15'),
(111,1,'07-Apr-2020','19:54:36'),
(112,1,'13-Apr-2020','15:15:54'),
(113,1,'13-Apr-2020','15:16:48'),
(114,1,'13-Apr-2020','15:18:52'),
(115,1,'13-Apr-2020','15:25:55'),
(116,1,'13-Apr-2020','15:30:23');

/*Table structure for table `tbl_option_result` */

DROP TABLE IF EXISTS `tbl_option_result`;

CREATE TABLE `tbl_option_result` (
  `option_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_option_id` int(11) DEFAULT NULL,
  `question_option_date_filled` date DEFAULT NULL,
  PRIMARY KEY (`option_result_id`),
  KEY `question_option_id` (`question_option_id`),
  CONSTRAINT `tbl_option_result_ibfk_1` FOREIGN KEY (`question_option_id`) REFERENCES `tbl_question_option` (`question_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_option_result` */

insert  into `tbl_option_result`(`option_result_id`,`question_option_id`,`question_option_date_filled`) values 
(20,1,'2020-04-01'),
(21,54,'2020-04-01'),
(22,8,'2020-04-01'),
(23,10,'2020-04-01'),
(24,14,'2020-04-01'),
(25,19,'2020-04-01'),
(26,27,'2020-04-01'),
(27,32,'2020-04-01'),
(28,52,'2020-04-01'),
(29,1,'2020-04-01'),
(30,27,'2020-04-01'),
(31,52,'2020-04-01'),
(32,32,'2020-04-01'),
(33,27,'2020-04-01'),
(34,54,'2020-04-01'),
(35,1,'2020-04-01'),
(36,2,'2020-04-01'),
(37,2,'2020-04-01'),
(38,2,'2020-04-01'),
(39,2,'2020-04-01'),
(40,3,'2020-04-01'),
(41,2,'2020-04-01'),
(42,2,'2020-04-01'),
(43,1,'2020-04-01'),
(44,8,'2020-04-01'),
(45,9,'2020-04-01');

/*Table structure for table `tbl_outbox` */

DROP TABLE IF EXISTS `tbl_outbox`;

CREATE TABLE `tbl_outbox` (
  `outbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `send_date` date DEFAULT NULL,
  `send_time` time DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `questionnaire_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_outbox` */

insert  into `tbl_outbox`(`outbox_id`,`user_id`,`send_date`,`send_time`,`event_id`,`questionnaire_id`,`guest_id`,`email_send_to`,`email_sender_id`,`outbox_from`,`outbox_subject`,`message_send`,`sent_status`) values 
(20,1,'2019-05-28','16:05:39',1,NULL,10,'krisnaarinasta@student.unud.ac.id',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Nyepi','Nyepi is a Balinese \"Day of Silence\" that is commemorated every Isakawarsa (Saka new year) according to the Balinese calendar (in 2019, it falls on March 7). It is a Hindu celebration mainly celebrated in Bali, Indonesia. Nyepi, a public holiday in Indonesia, is a day of silence, fasting and meditation for the Balinese. The day following Nyepi is also celebrated as New Year\'s Day.[1][2] On this day, the youth of Bali in the village of Sesetan in South Bali practice the ceremony of Omed-omedan or \'The Kissing Ritual\' to celebrate the new year. The same day celebrated in India as Ugadi. ',1),
(22,1,'2019-05-31','13:02:09',NULL,NULL,10,'I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>',1,'Hotel Name Here','Re: Email marketing test','<blockquote>\r\n<h1><em><strong>send email test <s>1.6 </s>1.7</strong></em></h1>\r\n</blockquote>\r\n',1),
(23,1,'2019-05-31','13:02:13',NULL,NULL,10,'I PUTU KRISNA ARYNASTA <krisnaarinasta@student.unud.ac.id>',1,'Hotel Name Here','Re: Email marketing test','test test test\r\n',1),
(25,1,'2019-12-13','18:04:30',1,NULL,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Ogoh-ogoh Festival & Nyepi','<p>book now for any dates on march 2020 and get so much offer</p>\r\n',1),
(31,1,'2019-12-13','18:23:04',3,NULL,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,\'Hotel Name Here','Galungan and Kuningan Day','<h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n',1),
(33,1,'2019-12-14','13:44:42',3,NULL,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Galungan and Kuningan Day','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) Nyuh Bengkok Tree Houses</small></h4></div></div></div><strong><h2 class=\"mb-4 mt-4\" align=\"center\">Galungan and Kuningan Day<br><small>2019-12-15</small></h2></strong><div class=\"col-md-12\"><img class=\"col-md-12\" src=\"http://localhost/EmailMarketing/images/event_photos/event_main_photos/Event_1_Galungan_20191029030033.jpg\"></div><p class=\"mb-0 mt-4\"><h3><strong>Did you know Galungan is the biggest ceremony in Bali ?</strong></h3>\r\n\r\n<p><strong>Galungan</strong> is a Balinese holiday celebrating the victory of dharma over adharma. It marks the time when the ancestral spirits visit the Earth. The last day of the celebration is Kuningan, when they return. The date is calculated according to the 210-day Balinese calendar. It is related to Diwali, celebrated by Hindus in other parts of the world, which also celebrates the victory of dharma over adharma. Diwali, however, is held at the end of the year.</p>\r\n\r\n<p>come to our hotel and bring this email for special offer only for you !</p>\r\n</p><div class=\"col-md-12\"><h4 align=\"center\" style=\"margin-top:40px; border-top:1px solid #0000003b; padding-top:10px\" >Event&apos;s Photo(s)</h4><div class=\"row\" id=\"eventPhotos\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_20191029030612.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306121.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306123.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_3_Galungan_201910290306124.jpg\"></div></div>',1),
(43,1,'2020-03-26','22:31:43',1,NULL,9,'krisnaarinasta@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Ogoh-ogoh Festival & Nyepi','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) https://nyuhbengkok-treehouse.com</small></h4></div></div></div><strong><h2 class=\"mb-4 mt-4\" align=\"center\">Ogoh-ogoh Festival & Nyepi<br><small>2020-05-31</small></h2></strong><div class=\"col-md-12\"><img class=\"col-md-12\" src=\"http://localhost/EmailMarketing/images/event_photos/event_main_photos/Event_1_Nyepi_20191029030003.jpg\"></div><p class=\"mb-0 mt-4\"><p>book now for any dates on march 2020 and get so much offer</p>\r\n</p><div class=\"col-md-12\"><h4 align=\"center\" style=\"margin-top:40px; border-top:1px solid #0000003b; padding-top:10px\" >Event&apos;s Photo(s)</h4><div class=\"row\" id=\"eventPhotos\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_1_Nyepi_20191029030004.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_1_Nyepi_201910290300041.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_1_Nyepi_201910290300042.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_1_Nyepi_201910290300043.jpg\"><img width=\"24%\" style=\"margin:1px\" src=\"http://localhost/EmailMarketing/images/event_photos/events_photos/Event_photos_1_Nyepi_201910290300044.jpg\"></div></div><p style=\"margin-top:40px\">if you don&apos;t want to obtain this kind of email anymore, <a href=\"http://localhost/EmailMarketing/Unsubscribe/Unsubscribe/45c48cce2e2d7fbdea1afc51c7c6ad26\">klik here</a></p>',1),
(48,1,'2020-04-01','15:21:24',NULL,46,9,'dailytropicalbali@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Questionnaire for Offer','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) https://nyuhbengkok-treehouse.com</small></h4></div></div></div><br><p>Dear Mr/Mrs Daily Tropical</p><br><p class=\"mb-0 mt-4\"><p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s</p>\r\n</p><br><p class=\"mb-0 mt-4\">Questionnaire link: http://localhost/EmailMarketing/Questionnaire/fill/</p></div></div><p style=\"margin-top:40px\">if you don&apos;t want to obtain this kind of email anymore, <a href=\"http://localhost/EmailMarketing/Unsubscribe/Unsubscribe/45c48cce2e2d7fbdea1afc51c7c6ad26\">klik here</a></p>',1),
(50,1,'2020-03-26','15:46:53',NULL,46,16,'kknsaktiunud19@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Questionnaire for Offer','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) https://nyuhbengkok-treehouse.com</small></h4></div></div></div><br><p>Dear Mr/Mrs Futin White</p><br><p class=\"mb-0 mt-4\"><p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s</p>\r\n</p><br><p class=\"mb-0 mt-4\">Questionnaire link: http://localhost/EmailMarketing/Questionnaire/fill/6512bd43d9caa6e02c990b0a82652dca</p></div></div><p style=\"margin-top:40px\">if you don&apos;t want to obtain this kind of email anymore, <a href=\"http://localhost/EmailMarketing/Unsubscribe/Unsubscribe/c74d97b01eae257e44aa9d5bade97baf\">klik here</a></p>',1),
(51,1,'2020-04-01','16:11:04',NULL,46,16,'kknsaktiunud19@gmail.com',1,'krisnaarinasta@gmail.com ,Nyuh Bengkok Tree Houses','Questionnaire for Offer','<div class=\"col-md-12\" style=\"border-bottom:1px solid #0000003b; padding-bottom:10px\"><div class=\"row\"><div class=\"col-md-6\"><img width=\"20%\" src=\"http://localhost/EmailMarketing/images/property_logo/Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg\"></div><div class=\"col-md-6 text-right\" style=\"top: 0.6rem;\"><h4>Nyuh Bengkok Tree Houses<br><small>Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) https://nyuhbengkok-treehouse.com</small></h4></div></div></div><br><p>Dear Mr/Mrs Futin White</p><br><p class=\"mb-0 mt-4\"><p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s</p>\r\n</p><br><p class=\"mb-0 mt-4\">Questionnaire link: http://localhost/EmailMarketing/Questionnaire/fill/c20ad4d76fe97759aa27a0c99bff6710</p></div></div><p style=\"margin-top:40px\">if you don&apos;t want to obtain this kind of email anymore, <a href=\"http://localhost/EmailMarketing/Unsubscribe/Unsubscribe/c74d97b01eae257e44aa9d5bade97baf\">klik here</a></p>',1),
(52,1,'2020-04-13','15:29:01',NULL,NULL,15,'Krisna Arynasta <krisnaarinasta@gmail.com>',8,'Nyuh Bengkok Tree Houses','Re: testing local email','<p>sucsess reply from local email</p>\r\n',1);

/*Table structure for table `tbl_question` */

DROP TABLE IF EXISTS `tbl_question`;

CREATE TABLE `tbl_question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `question_status_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `questionnaire_id` (`questionnaire_id`),
  CONSTRAINT `tbl_question_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `tbl_questionnaire` (`questionnaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_question` */

insert  into `tbl_question`(`question_id`,`questionnaire_id`,`question`,`question_status_delete`) values 
(1,46,'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.',1),
(2,46,'Lorem Ipsum copy in various charsets and languages for layouts. ... Lorem Ipsum is needed for web design, web pages, website templates and CMS.',1),
(3,46,'Lorem ipsum dolor sit amet, quas fabellas sed an. Ipsum graece molestiae ne vix. Cetero conclusionemque ei est, alterum similique vituperata ius ne, ferri nulla possit qui te. Solet invenire qui in, vero corpora voluptatibus vix et. Eu nonumy quaeque eos,',0),
(4,46,'\r\nVim an deseruisse concludaturque. Vim ne error munere complectitur, ad sed quod deserunt delicata, nec omnes assentior voluptatum no. An vim nemore fierent maluisset, movet placerat qui id, at iisque nostrum est. Sit hinc magna habemus ne. Erat feugait ',0),
(5,46,'Generate Lorem Ipsum placeholder text for use in your graphic, print and web layouts, and discover plugins for your favorite writing, design and blogging tools.',0),
(6,46,'adsadasd',1),
(7,46,'qqqwqwqwq',1),
(8,47,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i',0),
(9,46,'test modal1',0),
(12,46,'test update next',0);

/*Table structure for table `tbl_question_option` */

DROP TABLE IF EXISTS `tbl_question_option`;

CREATE TABLE `tbl_question_option` (
  `question_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `question_option_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`question_option_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `tbl_question_option_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_question_option` */

insert  into `tbl_question_option`(`question_option_id`,`question_id`,`question_option_value`) values 
(1,1,'1'),
(2,1,'2'),
(3,1,'3'),
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
(18,5,'250'),
(19,6,'1'),
(20,6,'2'),
(21,6,'3'),
(22,7,'q'),
(23,7,'w'),
(24,7,'e'),
(25,7,'r'),
(26,7,'t'),
(27,7,'y'),
(28,8,'bad'),
(29,8,'weak'),
(30,8,'good'),
(31,8,'perfect'),
(32,9,'1'),
(33,9,'2'),
(34,9,'3'),
(52,12,'1 zxc'),
(53,12,'2 dsdad'),
(54,2,'20%'),
(55,2,'50%'),
(56,2,'75%'),
(57,2,'100%');

/*Table structure for table `tbl_questionnaire` */

DROP TABLE IF EXISTS `tbl_questionnaire`;

CREATE TABLE `tbl_questionnaire` (
  `questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `questionnaire_name` varchar(50) DEFAULT NULL,
  `questionnaire_date_create` date DEFAULT NULL,
  `questionnaire_send_on` date DEFAULT NULL,
  `questionnaire_message` text,
  `questionnaire_status_delete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`questionnaire_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_questionnaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_questionnaire` */

insert  into `tbl_questionnaire`(`questionnaire_id`,`user_id`,`questionnaire_name`,`questionnaire_date_create`,`questionnaire_send_on`,`questionnaire_message`,`questionnaire_status_delete`) values 
(4,2,'New Questioner','2019-12-11','2019-12-31','<p>New Questioner</p>\r\n',0),
(46,1,'Questionnaire for Offer','2019-12-11','2020-04-01','<p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500sLorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s</p>\r\n',0),
(47,1,'About the Services','2020-03-31','2020-06-30','<p>Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>\r\n',0);

/*Table structure for table `tbl_send_questionnaire` */

DROP TABLE IF EXISTS `tbl_send_questionnaire`;

CREATE TABLE `tbl_send_questionnaire` (
  `send_questionnaire_id` int(11) NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `questionnaire_fill_status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`send_questionnaire_id`),
  KEY `questionnaire_id` (`questionnaire_id`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `tbl_send_questionnaire_ibfk_1` FOREIGN KEY (`questionnaire_id`) REFERENCES `tbl_questionnaire` (`questionnaire_id`),
  CONSTRAINT `tbl_send_questionnaire_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `tbl_guest` (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_send_questionnaire` */

insert  into `tbl_send_questionnaire`(`send_questionnaire_id`,`questionnaire_id`,`guest_id`,`questionnaire_fill_status`) values 
(8,46,9,0),
(11,46,16,0),
(12,46,16,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`user_id`,`email`,`password`,`property_name`,`property_address`,`property_website`,`property_logo`,`API_key`,`secret_key`,`user_status_active`,`admin_id_approver`) values 
(1,'krisnaarinasta@gmail.com','123','Nyuh Bengkok Tree Houses','Sental Kangin, Ped Village, Nusa Penida, Indonesia (80771) ','https://nyuhbengkok-treehouse.com','Logo_1_Nyuh_Bengkok_Tree_Houses__20191118064315.jpg','ujfbcjudjn773hl2jfjsda8712polasl31982','jfghj76jhgr123',1,1),
(2,'pondokindah@gmail.com','123','Pondok Indah Villa',NULL,NULL,'dqwdqsadq.jpg','dsajhgfdjhs72613jskad263dsajkh782672d','shfdjk23742136',1,1),
(4,'a','a','a',NULL,NULL,NULL,NULL,NULL,1,1),
(5,'b','b','b',NULL,NULL,NULL,'01081920191101Lz5HpNUi9roCwSRbqycQAKvhs7kfmeal8xO436tuTIMnjF21BPGJ0gEdD20191101010819','0108192019110101081920191101Lz5HpNUi9roCwSRbqycQAKvhs7kfmeal8xO436tuTIMnjF21BPGJ0gEdD2019110101081920191101010819',1,NULL),
(8,'c','c','c',NULL,NULL,NULL,'01533920200405ry4673gBacf1vmQs9iUIje2OtqFlKHRGbCSdMPw5TpnDhN8x0zEuLAkoJ20200405015339','0153392020040501533920200405ry4673gBacf1vmQs9iUIje2OtqFlKHRGbCSdMPw5TpnDhN8x0zEuLAkoJ2020040501533920200405015339',1,NULL);

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
