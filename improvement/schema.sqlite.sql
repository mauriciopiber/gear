CREATE TABLE "user" (
  "id_user" INTEGER PRIMARY KEY,
  "email" varchar(100) NOT NULL,
  "password" varchar(100) NOT NULL,
  "username" varchar(100) DEFAULT NULL,
  "state" int(11) NOT NULL,
  "uid" varchar(150) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) DEFAULT NULL,
  "updated_by" int(1) DEFAULT NULL,

  CONSTRAINT "user_ibfk_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "user_ibfk_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "user" VALUES(1,'mauriciopiber@gmail.com','$2y$14$6kI6xLm29/jObosCpE/7xOh9AFP6F1qGGmY7dYCYfWK9D54jSA2tu','',1,'154bee9246cc1a8.09461015','2015-01-20 21:47:48','2015-01-20 21:47:48',1,1);
INSERT INTO "user" VALUES(2,'1Email','1Password','1Username',1,'1Uid','2015-01-20 21:47:48',NULL,2,NULL);
INSERT INTO "user" VALUES(3,'2Email','2Password','2Username',2,'2Uid','2015-01-20 21:47:48',NULL,3,NULL);
INSERT INTO "user" VALUES(4,'3Email','3Password','3Username',3,'3Uid','2015-01-20 21:47:48',NULL,4,NULL);
INSERT INTO "user" VALUES(5,'4Email','4Password','4Username',4,'4Uid','2015-01-20 21:47:48',NULL,5,NULL);
INSERT INTO "user" VALUES(6,'5Email','5Password','5Username',5,'5Uid','2015-01-20 21:47:48',NULL,6,NULL);
INSERT INTO "user" VALUES(7,'6Email','6Password','6Username',6,'6Uid','2015-01-20 21:47:48',NULL,7,NULL);
INSERT INTO "user" VALUES(8,'7Email','7Password','7Username',7,'7Uid','2015-01-20 21:47:48',NULL,8,NULL);
INSERT INTO "user" VALUES(9,'8Email','8Password','8Username',8,'8Uid','2015-01-20 21:47:48',NULL,9,NULL);
INSERT INTO "user" VALUES(10,'9Email','9Password','9Username',9,'9Uid','2015-01-20 21:47:48',NULL,10,NULL);
INSERT INTO "user" VALUES(11,'10Email','10Password','10Username',10,'10Uid','2015-01-20 21:47:48',NULL,11,NULL);
INSERT INTO "user" VALUES(12,'11Email','11Password','11Username',11,'11Uid','2015-01-20 21:47:48',NULL,12,NULL);
INSERT INTO "user" VALUES(13,'12Email','12Password','12Username',12,'12Uid','2015-01-20 21:47:48',NULL,13,NULL);
INSERT INTO "user" VALUES(14,'13Email','13Password','13Username',13,'13Uid','2015-01-20 21:47:48',NULL,14,NULL);
INSERT INTO "user" VALUES(15,'14Email','14Password','14Username',14,'14Uid','2015-01-20 21:47:48',NULL,15,NULL);
INSERT INTO "user" VALUES(16,'15Email','15Password','15Username',15,'15Uid','2015-01-20 21:47:48',NULL,16,NULL);
INSERT INTO "user" VALUES(17,'16Email','16Password','16Username',16,'16Uid','2015-01-20 21:47:48',NULL,17,NULL);
INSERT INTO "user" VALUES(18,'17Email','17Password','17Username',17,'17Uid','2015-01-20 21:47:48',NULL,18,NULL);
INSERT INTO "user" VALUES(19,'18Email','18Password','18Username',18,'18Uid','2015-01-20 21:47:48',NULL,19,NULL);
INSERT INTO "user" VALUES(20,'19Email','19Password','19Username',19,'19Uid','2015-01-20 21:47:48',NULL,20,NULL);
INSERT INTO "user" VALUES(21,'20Email','20Password','20Username',20,'20Uid','2015-01-20 21:47:48',NULL,21,NULL);
INSERT INTO "user" VALUES(22,'21Email','21Password','21Username',21,'21Uid','2015-01-20 21:47:48',NULL,22,NULL);
INSERT INTO "user" VALUES(23,'22Email','22Password','22Username',22,'22Uid','2015-01-20 21:47:48',NULL,23,NULL);
INSERT INTO "user" VALUES(24,'23Email','23Password','23Username',23,'23Uid','2015-01-20 21:47:48',NULL,24,NULL);
INSERT INTO "user" VALUES(25,'24Email','24Password','24Username',24,'24Uid','2015-01-20 21:47:48',NULL,25,NULL);
INSERT INTO "user" VALUES(26,'25Email','25Password','25Username',25,'25Uid','2015-01-20 21:47:48',NULL,26,NULL);
INSERT INTO "user" VALUES(27,'26Email','26Password','26Username',26,'26Uid','2015-01-20 21:47:48',NULL,27,NULL);
INSERT INTO "user" VALUES(28,'27Email','27Password','27Username',27,'27Uid','2015-01-20 21:47:48',NULL,28,NULL);
INSERT INTO "user" VALUES(29,'28Email','28Password','28Username',28,'28Uid','2015-01-20 21:47:48',NULL,29,NULL);
INSERT INTO "user" VALUES(30,'29Email','29Password','29Username',29,'29Uid','2015-01-20 21:47:48',NULL,30,NULL);
INSERT INTO "user" VALUES(31,'30Email','30Password','30Username',30,'30Uid','2015-01-20 21:47:48',NULL,31,NULL);

CREATE TABLE "role" (
  "id_role" INTEGER PRIMARY KEY,
  "id_parent" int(11) DEFAULT NULL,
  "name" varchar(255) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  CONSTRAINT "fk_role_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "fk_role_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "fk_role_3" FOREIGN KEY ("id_parent") REFERENCES "role" ("id_role") ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "role" VALUES(1,NULL,'guest','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(2,1,'admin','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(3,NULL,'1Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(4,NULL,'2Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(5,NULL,'3Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(6,NULL,'4Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(7,NULL,'5Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(8,NULL,'6Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(9,NULL,'7Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(10,NULL,'8Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(11,NULL,'9Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(12,NULL,'10Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(13,NULL,'11Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(14,NULL,'12Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(15,NULL,'13Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(16,NULL,'14Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(17,NULL,'15Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(18,NULL,'16Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(19,NULL,'17Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(20,NULL,'18Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(21,NULL,'19Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(22,NULL,'20Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(23,NULL,'21Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(24,NULL,'22Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(25,NULL,'23Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(26,NULL,'24Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(27,NULL,'25Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(28,NULL,'26Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(29,NULL,'27Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(30,NULL,'28Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(31,NULL,'29Name','2015-01-20 21:47:48',NULL,1,NULL);
INSERT INTO "role" VALUES(32,NULL,'30Name','2015-01-20 21:47:48',NULL,1,NULL);


CREATE TABLE "user_role_linker" (
  "id_user" int(11) NOT NULL,
  "id_role" int(11) NOT NULL,
  CONSTRAINT "FK_611178996B3CA4B" FOREIGN KEY ("id_user") REFERENCES "user" ("id_user") ON DELETE CASCADE,
  CONSTRAINT "fk_user_role_linker_1" FOREIGN KEY ("id_role") REFERENCES "role" ("id_role") ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "user_role_linker" VALUES(1,2);


CREATE TABLE "testing_suite" ("id_testing_suite" integer PRIMARY KEY  NOT NULL  DEFAULT (null) ,"test_date" date NOT NULL ,"test_datetime" datetime NOT NULL ,"test_time" time NOT NULL ,"test_decimal" decimal(10,2) NOT NULL ,"test_decimal_money_pt_br" decimal(10,2) NOT NULL ,"test_date_pt_br" date NOT NULL ,"test_datetime_pt_br" datetime NOT NULL ,"test_int" int(11) NOT NULL ,"test_int_checkbox" int(11) NOT NULL ,"test_varchar" varchar(100) NOT NULL ,"test_varchar_image_upload" varchar(100) NOT NULL ,"test_tinyint" tinyint(4) NOT NULL ,"test_tinyint_checkbox" int(11) DEFAULT (NULL) ,"created" datetime NOT NULL ,"updated" datetime DEFAULT (NULL) ,"created_by" int(1) NOT NULL ,"updated_by" int(1) DEFAULT (NULL) ,"test_text" text NOT NULL ,"id_test_user" int(11) NOT NULL ,"test_varchar_email" varchar(100) NOT NULL );
INSERT INTO "testing_suite" VALUES(1,'2020-12-01','2020-12-01 01:00:02','01:00:02',1.1,1.1,'2020-12-01','2020-12-01 01:00:02',1,1,'1Test Varchar','1Test Varchar Image Upload',1,1,'2015-01-20 21:47:48',NULL,1,NULL,'1Test Text',2,'test.varchar.email1@gmail.com');
INSERT INTO "testing_suite" VALUES(2,'2020-12-02','2020-12-02 02:00:02','02:00:02',2.2,2.2,'2020-12-02','2020-12-02 02:00:02',2,0,'2Test Varchar','2Test Varchar Image Upload',2,0,'2015-01-20 21:47:48',NULL,1,NULL,'2Test Text',3,'test.varchar.email2@gmail.com');
INSERT INTO "testing_suite" VALUES(3,'2020-12-03','2020-12-03 03:00:02','03:00:02',3.3,3.3,'2020-12-03','2020-12-03 03:00:02',3,1,'3Test Varchar','3Test Varchar Image Upload',3,1,'2015-01-20 21:47:48',NULL,1,NULL,'3Test Text',4,'test.varchar.email3@gmail.com');
INSERT INTO "testing_suite" VALUES(4,'2020-12-04','2020-12-04 04:00:02','04:00:02',4.4,4.4,'2020-12-04','2020-12-04 04:00:02',4,0,'4Test Varchar','4Test Varchar Image Upload',4,0,'2015-01-20 21:47:48',NULL,1,NULL,'4Test Text',5,'test.varchar.email4@gmail.com');
INSERT INTO "testing_suite" VALUES(5,'2020-12-05','2020-12-05 05:00:02','05:00:02',5.5,5.5,'2020-12-05','2020-12-05 05:00:02',5,1,'5Test Varchar','5Test Varchar Image Upload',5,1,'2015-01-20 21:47:48',NULL,1,NULL,'5Test Text',6,'test.varchar.email5@gmail.com');
INSERT INTO "testing_suite" VALUES(6,'2020-12-06','2020-12-06 06:00:02','06:00:02',6.6,6.6,'2020-12-06','2020-12-06 06:00:02',6,0,'6Test Varchar','6Test Varchar Image Upload',6,0,'2015-01-20 21:47:48',NULL,1,NULL,'6Test Text',7,'test.varchar.email6@gmail.com');
INSERT INTO "testing_suite" VALUES(7,'2020-12-07','2020-12-07 07:00:02','07:00:02',7.7,7.7,'2020-12-07','2020-12-07 07:00:02',7,1,'7Test Varchar','7Test Varchar Image Upload',7,1,'2015-01-20 21:47:48',NULL,1,NULL,'7Test Text',8,'test.varchar.email7@gmail.com');
INSERT INTO "testing_suite" VALUES(8,'2020-12-08','2020-12-08 08:00:02','08:00:02',8.8,8.8,'2020-12-08','2020-12-08 08:00:02',8,0,'8Test Varchar','8Test Varchar Image Upload',8,0,'2015-01-20 21:47:48',NULL,1,NULL,'8Test Text',9,'test.varchar.email8@gmail.com');
INSERT INTO "testing_suite" VALUES(9,'2020-12-09','2020-12-09 09:00:02','09:00:02',9.9,9.9,'2020-12-09','2020-12-09 09:00:02',9,1,'9Test Varchar','9Test Varchar Image Upload',9,1,'2015-01-20 21:47:48',NULL,1,NULL,'9Test Text',10,'test.varchar.email9@gmail.com');
INSERT INTO "testing_suite" VALUES(10,'2020-12-10','2020-12-10 10:00:02','10:00:02',10.1,10.1,'2020-12-10','2020-12-10 10:00:02',10,0,'10Test Varchar','10Test Varchar Image Upload',10,0,'2015-01-20 21:47:48',NULL,1,NULL,'10Test Text',11,'test.varchar.email10@gmail.com');
INSERT INTO "testing_suite" VALUES(11,'2020-12-11','2020-12-11 11:00:02','11:00:02',11.11,11.11,'2020-12-11','2020-12-11 11:00:02',11,1,'11Test Varchar','11Test Varchar Image Upload',11,1,'2015-01-20 21:47:48',NULL,1,NULL,'11Test Text',12,'test.varchar.email11@gmail.com');
INSERT INTO "testing_suite" VALUES(12,'2020-12-12','2020-12-12 12:00:02','12:00:02',12.12,12.12,'2020-12-12','2020-12-12 12:00:02',12,0,'12Test Varchar','12Test Varchar Image Upload',12,0,'2015-01-20 21:47:48',NULL,1,NULL,'12Test Text',13,'test.varchar.email12@gmail.com');
INSERT INTO "testing_suite" VALUES(13,'2020-12-13','2020-12-13 13:00:02','13:00:02',13.13,13.13,'2020-12-13','2020-12-13 13:00:02',13,1,'13Test Varchar','13Test Varchar Image Upload',13,1,'2015-01-20 21:47:48',NULL,1,NULL,'13Test Text',14,'test.varchar.email13@gmail.com');
INSERT INTO "testing_suite" VALUES(14,'2020-12-14','2020-12-14 14:00:02','14:00:02',14.14,14.14,'2020-12-14','2020-12-14 14:00:02',14,0,'14Test Varchar','14Test Varchar Image Upload',14,0,'2015-01-20 21:47:48',NULL,1,NULL,'14Test Text',15,'test.varchar.email14@gmail.com');
INSERT INTO "testing_suite" VALUES(15,'2020-12-15','2020-12-15 15:00:02','15:00:02',15.15,15.15,'2020-12-15','2020-12-15 15:00:02',15,1,'15Test Varchar','15Test Varchar Image Upload',15,1,'2015-01-20 21:47:48',NULL,1,NULL,'15Test Text',16,'test.varchar.email15@gmail.com');
INSERT INTO "testing_suite" VALUES(16,'2020-12-16','2020-12-16 16:00:02','16:00:02',16.16,16.16,'2020-12-16','2020-12-16 16:00:02',16,0,'16Test Varchar','16Test Varchar Image Upload',16,0,'2015-01-20 21:47:48',NULL,1,NULL,'16Test Text',17,'test.varchar.email16@gmail.com');
INSERT INTO "testing_suite" VALUES(17,'2020-12-17','2020-12-17 17:00:02','17:00:02',17.17,17.17,'2020-12-17','2020-12-17 17:00:02',17,1,'17Test Varchar','17Test Varchar Image Upload',17,1,'2015-01-20 21:47:48',NULL,1,NULL,'17Test Text',18,'test.varchar.email17@gmail.com');
INSERT INTO "testing_suite" VALUES(18,'2020-12-18','2020-12-18 18:00:02','18:00:02',18.18,18.18,'2020-12-18','2020-12-18 18:00:02',18,0,'18Test Varchar','18Test Varchar Image Upload',18,0,'2015-01-20 21:47:48',NULL,1,NULL,'18Test Text',19,'test.varchar.email18@gmail.com');
INSERT INTO "testing_suite" VALUES(19,'2020-12-19','2020-12-19 19:00:02','19:00:02',19.19,19.19,'2020-12-19','2020-12-19 19:00:02',19,1,'19Test Varchar','19Test Varchar Image Upload',19,1,'2015-01-20 21:47:48',NULL,1,NULL,'19Test Text',20,'test.varchar.email19@gmail.com');
INSERT INTO "testing_suite" VALUES(20,'2020-12-20','2020-12-20 20:00:02','20:00:02',20.2,20.2,'2020-12-20','2020-12-20 20:00:02',20,0,'20Test Varchar','20Test Varchar Image Upload',20,0,'2015-01-20 21:47:48',NULL,1,NULL,'20Test Text',21,'test.varchar.email20@gmail.com');
INSERT INTO "testing_suite" VALUES(21,'2020-12-21','2020-12-21 21:00:02','21:00:02',21.21,21.21,'2020-12-21','2020-12-21 21:00:02',21,1,'21Test Varchar','21Test Varchar Image Upload',21,1,'2015-01-20 21:47:48',NULL,1,NULL,'21Test Text',22,'test.varchar.email21@gmail.com');
INSERT INTO "testing_suite" VALUES(22,'2020-12-22','2020-12-22 22:00:02','22:00:02',22.22,22.22,'2020-12-22','2020-12-22 22:00:02',22,0,'22Test Varchar','22Test Varchar Image Upload',22,0,'2015-01-20 21:47:48',NULL,1,NULL,'22Test Text',23,'test.varchar.email22@gmail.com');
INSERT INTO "testing_suite" VALUES(23,'2020-12-23','2020-12-23 23:00:02','23:00:02',23.23,23.23,'2020-12-23','2020-12-23 23:00:02',23,1,'23Test Varchar','23Test Varchar Image Upload',23,1,'2015-01-20 21:47:48',NULL,1,NULL,'23Test Text',24,'test.varchar.email23@gmail.com');
INSERT INTO "testing_suite" VALUES(24,'2020-12-24','2020-12-24 06:00:02','06:00:02',24.24,24.24,'2020-12-24','2020-12-24 06:00:02',24,0,'24Test Varchar','24Test Varchar Image Upload',24,0,'2015-01-20 21:47:48',NULL,1,NULL,'24Test Text',25,'test.varchar.email24@gmail.com');
INSERT INTO "testing_suite" VALUES(25,'2020-12-25','2020-12-25 05:00:02','05:00:02',25.25,25.25,'2020-12-25','2020-12-25 05:00:02',25,1,'25Test Varchar','25Test Varchar Image Upload',25,1,'2015-01-20 21:47:48',NULL,1,NULL,'25Test Text',26,'test.varchar.email25@gmail.com');
INSERT INTO "testing_suite" VALUES(26,'2020-12-26','2020-12-26 04:00:02','04:00:02',26.26,26.26,'2020-12-26','2020-12-26 04:00:02',26,0,'26Test Varchar','26Test Varchar Image Upload',26,0,'2015-01-20 21:47:48',NULL,1,NULL,'26Test Text',27,'test.varchar.email26@gmail.com');
INSERT INTO "testing_suite" VALUES(27,'2020-12-27','2020-12-27 03:00:02','03:00:02',27.27,27.27,'2020-12-27','2020-12-27 03:00:02',27,1,'27Test Varchar','27Test Varchar Image Upload',27,1,'2015-01-20 21:47:48',NULL,1,NULL,'27Test Text',28,'test.varchar.email27@gmail.com');
INSERT INTO "testing_suite" VALUES(28,'2020-12-28','2020-12-28 02:00:02','02:00:02',28.28,28.28,'2020-12-28','2020-12-28 02:00:02',28,0,'28Test Varchar','28Test Varchar Image Upload',28,0,'2015-01-20 21:47:48',NULL,1,NULL,'28Test Text',29,'test.varchar.email28@gmail.com');
INSERT INTO "testing_suite" VALUES(29,'2020-12-29','2020-12-29 01:00:02','01:00:02',29.29,29.29,'2020-12-29','2020-12-29 01:00:02',29,1,'29Test Varchar','29Test Varchar Image Upload',29,1,'2015-01-20 21:47:48',NULL,1,NULL,'29Test Text',30,'test.varchar.email29@gmail.com');
INSERT INTO "testing_suite" VALUES(30,'2020-12-30','2020-12-30 00:00:02','00:00:02',30.3,30.3,'2020-12-30','2020-12-30 00:00:02',30,0,'30Test Varchar','30Test Varchar Image Upload',30,0,'2015-01-20 21:47:48',NULL,1,NULL,'30Test Text',31,'test.varchar.email30@gmail.com');