PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE "action" (
  "id_action" int(11) NOT NULL ,
  "id_controller" int(11) NOT NULL,
  "name" varchar(150) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_action")
  CONSTRAINT "action_ibfk_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "action_ibfk_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "FK_47CC8C92E978E64D" FOREIGN KEY ("id_controller") REFERENCES "controller" ("id_controller") ON DELETE CASCADE
);

INSERT INTO "action" VALUES(1,1,'AutoincrementDatabase','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(2,1,'DropTable','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(3,1,'GetOrder','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(4,1,'AnalyseDatabase','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(5,1,'AnalyseTable','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(6,1,'AutoincrementTable','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(7,1,'ClearTable','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(8,1,'CreateColumn','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(9,1,'FixDatabase','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(10,1,'FixTable','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(11,2,'Build','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(12,3,'Version','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(13,4,'Action','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(14,4,'Controller','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(15,4,'Db','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(16,4,'Src','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(17,4,'Test','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(18,4,'View','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(19,5,'Module','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(20,5,'Load','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(21,5,'Push','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(22,5,'ModuleLight','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(23,6,'Deploy','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(24,6,'Mysql2sqlite','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(25,6,'ResetAcl','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(26,6,'Acl','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(27,6,'Config','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(28,6,'Dump','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "action" VALUES(29,6,'Entities','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(30,6,'Entity','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(31,6,'Environment','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(32,6,'Global','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(33,6,'Local','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(34,6,'Mysql','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(35,6,'Project','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(36,6,'Sqlite','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(37,7,'Login','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(38,7,'SendPasswordRecoveryRequest','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(39,7,'PasswordRecoveryRequestSent','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(40,7,'PasswordRecovery','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(41,7,'PasswordRecoverySuccessful','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(42,7,'Index','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(43,7,'ChangePassword','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(44,7,'ChangePasswordSuccessful','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(45,7,'Logout','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(46,7,'InvalidLink','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(47,8,'Register','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(48,8,'Acl','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(49,9,'Index','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(50,10,'Create','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(51,10,'Edit','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(52,10,'List','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "action" VALUES(53,10,'Delete','2015-01-20 21:47:51',NULL,1,NULL);
INSERT INTO "action" VALUES(54,10,'View','2015-01-20 21:47:51',NULL,1,NULL);
CREATE TABLE "controller" (
  "id_controller" int(11) NOT NULL ,
  "id_module" int(11) NOT NULL,
  "name" varchar(150) NOT NULL,
  "invokable" varchar(150) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_controller")
  CONSTRAINT "controller_ibfk_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "controller_ibfk_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "FK_4CF2669A2A1393C5" FOREIGN KEY ("id_module") REFERENCES "module" ("id_module") ON DELETE CASCADE
);
INSERT INTO "controller" VALUES(1,1,'Db','Gear\Controller\Db','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(2,1,'Build','Gear\Controller\Build','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(3,1,'Gear','Gear\Controller\Gear','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(4,1,'Constructor','Gear\Controller\Constructor','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(5,1,'Module','Gear\Controller\Module','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(6,1,'Project','Gear\Controller\Project','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "controller" VALUES(7,2,'Index','Security\Controller\Index','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "controller" VALUES(8,2,'User','Security\Controller\User','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "controller" VALUES(9,3,'IndexController','Teste\Controller\Index','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "controller" VALUES(10,3,'TestingSuiteController','Teste\Controller\TestingSuite','2015-01-20 21:47:50',NULL,1,NULL);
CREATE TABLE "custo" (
  "id_custo" int(11) NOT NULL ,
  "id_status_custo" int(11) DEFAULT NULL,
  "id_tipo_custo" int(11) DEFAULT NULL,
  "valor" decimal(10,2) DEFAULT NULL,
  "data_custo" date DEFAULT NULL,
  "planejado" tinyint(1) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_custo")
  CONSTRAINT "custo_ibfk_3" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "custo_ibfk_4" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "fk_custo_1" FOREIGN KEY ("id_status_custo") REFERENCES "status_custo" ("id_status_custo") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "fk_custo_2" FOREIGN KEY ("id_tipo_custo") REFERENCES "tipo_custo" ("id_tipo_custo") ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE "email" (
  "id_email" int(11) NOT NULL ,
  "remetente" varchar(150) DEFAULT NULL,
  "destino" varchar(150) NOT NULL,
  "assunto" varchar(100) NOT NULL,
  "mensagem" longtext NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_email")
  CONSTRAINT "email_ibfk_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "email_ibfk_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE TABLE "grupo_custo" (
  "id_grupo_custo" int(11) NOT NULL ,
  "nome" varchar(100) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_grupo_custo")
  CONSTRAINT "grupo_custo_ibfk_3" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "grupo_custo_ibfk_4" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE "module" (
  "id_module" int(11) NOT NULL ,
  "name" varchar(150) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_module")
  CONSTRAINT "module_ibfk_1" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "module" VALUES(1,'Gear','2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "module" VALUES(2,'Security','2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "module" VALUES(3,'Teste','2015-01-20 21:47:50',NULL,1,NULL);
CREATE TABLE "mytablelog" (
  "id_mytablelog" int(11) NOT NULL ,
  "version" bigint(14) NOT NULL,
  "start_time" timestamp NOT NULL ,
  "end_time" timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY ("id_mytablelog")
);
CREATE TABLE "role" (
  "id_role" int(11) NOT NULL ,
  "id_parent" int(11) DEFAULT NULL,
  "name" varchar(255) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_role")
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
CREATE TABLE "rule" (
  "id_rule" int(11) NOT NULL ,
  "id_action" int(11) NOT NULL,
  "id_role" int(11) NOT NULL,
  "id_controller" int(11) NOT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_rule")
  CONSTRAINT "FK_46D8ACCC61FB397F" FOREIGN KEY ("id_action") REFERENCES "action" ("id_action") ON DELETE CASCADE,
  CONSTRAINT "FK_46D8ACCCE978E64D" FOREIGN KEY ("id_controller") REFERENCES "controller" ("id_controller") ON DELETE CASCADE,
  CONSTRAINT "fk_rule_1" FOREIGN KEY ("id_role") REFERENCES "role" ("id_role") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "rule_ibfk_1" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT "rule_ibfk_2" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE NO ACTION ON UPDATE NO ACTION
);
INSERT INTO "rule" VALUES(1,1,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(2,2,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(3,3,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(4,4,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(5,5,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(6,6,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(7,7,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(8,8,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(9,9,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(10,10,1,1,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(11,11,1,2,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(12,12,1,3,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(13,13,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(14,14,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(15,15,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(16,16,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(17,17,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(18,18,1,4,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(19,19,1,5,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(20,20,1,5,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(21,21,1,5,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(22,22,1,5,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(23,23,1,6,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(24,24,1,6,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(25,25,1,6,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(26,26,1,6,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(27,27,1,6,'2015-01-20 21:47:49',NULL,1,NULL);
INSERT INTO "rule" VALUES(28,28,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(29,29,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(30,30,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(31,31,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(32,32,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(33,33,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(34,34,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(35,35,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(36,36,1,6,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(37,37,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(38,38,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(39,39,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(40,40,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(41,41,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(42,42,2,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(43,43,2,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(44,44,2,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(45,45,2,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(46,46,1,7,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(47,47,1,8,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(48,48,1,8,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(49,49,1,9,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(50,50,2,10,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(51,51,2,10,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(52,52,2,10,'2015-01-20 21:47:50',NULL,1,NULL);
INSERT INTO "rule" VALUES(53,53,2,10,'2015-01-20 21:47:51',NULL,1,NULL);
INSERT INTO "rule" VALUES(54,54,2,10,'2015-01-20 21:47:51',NULL,1,NULL);
CREATE TABLE "status_custo" (
  "id_status_custo" int(11) NOT NULL ,
  "nome" varchar(100) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_status_custo")
  CONSTRAINT "status_custo_ibfk_3" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "status_custo_ibfk_4" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE "tipo_custo" (
  "id_tipo_custo" int(11) NOT NULL ,
  "id_grupo_custo" int(11) NOT NULL,
  "nome" varchar(100) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) NOT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_tipo_custo")
  CONSTRAINT "fk_tipo_custo_1" FOREIGN KEY ("id_grupo_custo") REFERENCES "grupo_custo" ("id_grupo_custo") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "tipo_custo_ibfk_2" FOREIGN KEY ("created_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT "tipo_custo_ibfk_3" FOREIGN KEY ("updated_by") REFERENCES "user" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE "user" (
  "id_user" int(11) NOT NULL ,
  "email" varchar(100) NOT NULL,
  "password" varchar(100) NOT NULL,
  "username" varchar(100) DEFAULT NULL,
  "state" int(11) NOT NULL,
  "uid" varchar(150) DEFAULT NULL,
  "created" datetime NOT NULL,
  "updated" datetime DEFAULT NULL,
  "created_by" int(1) DEFAULT NULL,
  "updated_by" int(1) DEFAULT NULL,
  PRIMARY KEY ("id_user")
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
CREATE TABLE "user_role_linker" (
  "id_user" int(11) NOT NULL,
  "id_role" int(11) NOT NULL,
  PRIMARY KEY ("id_user","id_role")
  CONSTRAINT "FK_611178996B3CA4B" FOREIGN KEY ("id_user") REFERENCES "user" ("id_user") ON DELETE CASCADE,
  CONSTRAINT "fk_user_role_linker_1" FOREIGN KEY ("id_role") REFERENCES "role" ("id_role") ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "user_role_linker" VALUES(1,2);
CREATE TABLE `phinxlog` (`version` BIGINT NULL, `start_time` DATETIME NULL, `end_time` DATETIME NULL);
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
CREATE INDEX "custo_fk_custo_2" ON "custo" ("id_tipo_custo");
CREATE INDEX "custo_fk_custo_1" ON "custo" ("id_status_custo");
CREATE INDEX "custo_created_by" ON "custo" ("created_by");
CREATE INDEX "custo_updated_by" ON "custo" ("updated_by");
CREATE INDEX "rule_IDX_46D8ACCC61FB397F" ON "rule" ("id_action");
CREATE INDEX "rule_IDX_46D8ACCCE978E64D" ON "rule" ("id_controller");
CREATE INDEX "rule_created_by" ON "rule" ("created_by");
CREATE INDEX "rule_updated_by" ON "rule" ("updated_by");
CREATE INDEX "rule_fk_rule_1" ON "rule" ("id_role");
CREATE INDEX "role_fk_role_1" ON "role" ("created_by");
CREATE INDEX "user_email_UNIQUE" ON "user" ("email");
CREATE INDEX "user_created_by" ON "user" ("created_by");
CREATE INDEX "user_updated_by" ON "user" ("updated_by");
CREATE INDEX "tipo_custo_fk_tipo_custo_1" ON "tipo_custo" ("id_grupo_custo");
CREATE INDEX "tipo_custo_created_by" ON "tipo_custo" ("created_by");
CREATE INDEX "tipo_custo_updated_by" ON "tipo_custo" ("updated_by");
CREATE INDEX "grupo_custo_created_by" ON "grupo_custo" ("created_by");
CREATE INDEX "grupo_custo_updated_by" ON "grupo_custo" ("updated_by");
CREATE INDEX "email_created_by" ON "email" ("created_by");
CREATE INDEX "email_updated_by" ON "email" ("updated_by");
CREATE INDEX "controller_IDX_4CF2669A2A1393C5" ON "controller" ("id_module");
CREATE INDEX "controller_created_by" ON "controller" ("created_by");
CREATE INDEX "controller_updated_by" ON "controller" ("updated_by");
CREATE INDEX "module_updated_by" ON "module" ("updated_by");
CREATE INDEX "user_role_linker_IDX_611178996B3CA4B" ON "user_role_linker" ("id_user");
CREATE INDEX "user_role_linker_IDX_61117899DC499668" ON "user_role_linker" ("id_role");
CREATE INDEX "user_role_linker_fk_user_role_linker_1" ON "user_role_linker" ("id_role");
CREATE INDEX "status_custo_created_by" ON "status_custo" ("created_by");
CREATE INDEX "status_custo_updated_by" ON "status_custo" ("updated_by");
CREATE INDEX "action_IDX_47CC8C92E978E64D" ON "action" ("id_controller");
CREATE INDEX "action_created_by" ON "action" ("created_by");
CREATE INDEX "action_updated_by" ON "action" ("updated_by");
COMMIT;
