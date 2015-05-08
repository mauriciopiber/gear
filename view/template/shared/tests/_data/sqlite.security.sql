DROP TABLE IF EXISTS "action";
CREATE TABLE "action" (id_action INTEGER NOT NULL, id_controller INTEGER NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_action), CONSTRAINT FK_47CC8C92E978E64D FOREIGN KEY (id_controller) REFERENCES controller (id_controller) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO "action" VALUES(1,7,'importrule','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(2,2,'login','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(3,2,'autenticate','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(4,2,'logout','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(5,2,'register','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(6,1,'register','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(7,1,'successfully-register','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(8,1,'logout','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(9,1,'login','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(10,1,'invalid-link','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(11,1,'password-recovery','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(12,1,'password-recovery-request','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(13,1,'password-recovery-successful','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(14,1,'activation','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(15,1,'activation-request','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(16,1,'activation-successful','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(17,1,'inactivation','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(18,1,'waiting-activation','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(19,1,'change-password','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(20,1,'details','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(21,1,'edit-details','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(22,3,'adicionar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(23,3,'editar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(24,3,'listar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(25,3,'deletar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(26,3,'visualizar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(27,4,'adicionar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(28,4,'editar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(29,4,'listar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(30,4,'deletar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(31,4,'visualizar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(32,5,'adicionar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(33,5,'editar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(34,5,'listar','2014-07-23 16:25:38',NULL);
INSERT INTO "action" VALUES(35,5,'deletar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(36,5,'visualizar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(37,6,'adicionar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(38,6,'editar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(39,6,'listar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(40,6,'deletar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(41,6,'visualizar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(42,7,'adicionar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(43,7,'editar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(44,7,'listar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(45,7,'deletar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(46,7,'visualizar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(47,8,'adicionar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(48,8,'editar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(49,8,'listar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(50,8,'deletar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(51,8,'visualizar','2014-07-23 16:25:39',NULL);
INSERT INTO "action" VALUES(52,1,'password-recovery-request-successful','2014-07-23 17:15:58',NULL);
INSERT INTO "action" VALUES(53,1,'index','2014-07-23 20:09:42',NULL);
INSERT INTO "action" VALUES(54,1,'change-user-data','2014-07-24 15:41:22',NULL);
INSERT INTO "action" VALUES(55,1,'send-activation','2014-08-19 00:57:51',NULL);
INSERT INTO "action" VALUES(56,1,'activation-sent','2014-08-19 00:57:51',NULL);
INSERT INTO "action" VALUES(57,1,'log-on','2014-08-19 00:57:51',NULL);
INSERT INTO "action" VALUES(58,1,'log-out','2014-08-19 00:57:51',NULL);
INSERT INTO "action" VALUES(59,1,'log-in','2014-08-19 00:57:51',NULL);
INSERT INTO "action" VALUES(60,1,'change-data','2014-08-19 00:57:51',NULL);
DROP TABLE IF EXISTS "controller";
CREATE TABLE controller (id_controller INTEGER NOT NULL, id_module INTEGER NOT NULL, name VARCHAR(150) NOT NULL, invokable VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_controller), CONSTRAINT FK_4CF2669A2A1393C5 FOREIGN KEY (id_module) REFERENCES module (id_module) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO "controller" VALUES(1,1,'Index','GearAdmin\Controller\Index','2014-07-23 16:25:38',NULL);
INSERT INTO "controller" VALUES(2,2,'ZfcUser','zfcuser','2014-07-23 16:25:38',NULL);
INSERT INTO "controller" VALUES(3,1,'Module','GearAdmin\Controller\Module','2014-07-23 16:25:38',NULL);
INSERT INTO "controller" VALUES(4,1,'Controller','GearAdmin\Controller\Controller','2014-07-23 16:25:38',NULL);
INSERT INTO "controller" VALUES(5,1,'Action','GearAdmin\Controller\Action','2014-07-23 16:25:38',NULL);
INSERT INTO "controller" VALUES(6,1,'Role','GearAdmin\Controller\Role','2014-07-23 16:25:39',NULL);
INSERT INTO "controller" VALUES(7,1,'Rule','GearAdmin\Controller\Rule','2014-07-23 16:25:39',NULL);
INSERT INTO "controller" VALUES(8,1,'User','GearAdmin\Controller\User','2014-07-23 16:25:39',NULL);
DROP TABLE IF EXISTS "email";
CREATE TABLE email (id_email INTEGER NOT NULL, remetente VARCHAR(150) DEFAULT NULL, destino VARCHAR(150) NOT NULL, assunto VARCHAR(100) NOT NULL, mensagem CLOB NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_email));
DROP TABLE IF EXISTS "module";
CREATE TABLE module (id_module INTEGER NOT NULL, name VARCHAR(150) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_module));
INSERT INTO "module" VALUES(1,'GearAdmin','2014-07-23 16:25:38',NULL);
INSERT INTO "module" VALUES(2,'ZfcUser','2014-07-23 16:25:38','2014-07-23 16:25:38');
DROP TABLE IF EXISTS "role";
CREATE TABLE role (id_role VARCHAR(255) NOT NULL, id_parent VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_role), CONSTRAINT FK_57698A6A1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES role (id_role) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO "role" VALUES('admin','client','admin','2014-07-23 16:25:38',NULL);
INSERT INTO "role" VALUES('client','guest','client','2014-07-23 16:25:38',NULL);
INSERT INTO "role" VALUES('guest',NULL,'guest','2014-07-23 16:25:38',NULL);
INSERT INTO "role" VALUES('master','admin','master','2014-07-23 16:25:38',NULL);
DROP TABLE IF EXISTS "rule";
CREATE TABLE rule (id_rule INTEGER NOT NULL, id_action INTEGER NOT NULL, id_role VARCHAR(255) NOT NULL, id_controller INTEGER NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_rule), CONSTRAINT FK_46D8ACCC61FB397F FOREIGN KEY (id_action) REFERENCES "action" (id_action) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_46D8ACCCDC499668 FOREIGN KEY (id_role) REFERENCES role (id_role) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_46D8ACCCE978E64D FOREIGN KEY (id_controller) REFERENCES controller (id_controller) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO "rule" VALUES(1,1,'guest',7,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(2,2,'guest',2,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(3,3,'guest',2,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(4,4,'admin',2,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(5,5,'guest',2,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(6,6,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(7,7,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(8,8,'client',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(9,9,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(10,10,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(11,11,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(12,12,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(13,13,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(14,14,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(15,15,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(16,16,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(17,17,'client',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(18,18,'guest',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(19,19,'client',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(20,20,'client',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(21,21,'client',1,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(22,22,'admin',3,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(23,23,'admin',3,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(24,24,'admin',3,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(25,25,'admin',3,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(26,26,'admin',3,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(27,27,'admin',4,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(28,28,'admin',4,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(29,29,'admin',4,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(30,30,'admin',4,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(31,31,'admin',4,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(32,32,'admin',5,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(33,33,'admin',5,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(34,34,'admin',5,'2014-07-23 16:25:38',NULL);
INSERT INTO "rule" VALUES(35,35,'admin',5,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(36,36,'admin',5,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(37,37,'admin',6,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(38,38,'admin',6,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(39,39,'admin',6,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(40,40,'admin',6,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(41,41,'admin',6,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(42,42,'admin',7,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(43,43,'admin',7,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(44,44,'admin',7,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(45,45,'admin',7,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(46,46,'admin',7,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(47,47,'master',8,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(48,48,'master',8,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(49,49,'master',8,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(50,50,'master',8,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(51,51,'master',8,'2014-07-23 16:25:39',NULL);
INSERT INTO "rule" VALUES(52,52,'guest',1,'2014-07-23 17:15:58',NULL);
INSERT INTO "rule" VALUES(53,53,'guest',1,'2014-07-23 20:09:42',NULL);
INSERT INTO "rule" VALUES(54,54,'client',1,'2014-07-24 15:41:23',NULL);
INSERT INTO "rule" VALUES(55,55,'guest',1,'2014-08-19 00:57:51',NULL);
INSERT INTO "rule" VALUES(56,56,'guest',1,'2014-08-19 00:57:51',NULL);
INSERT INTO "rule" VALUES(57,57,'guest',1,'2014-08-19 00:57:51',NULL);
INSERT INTO "rule" VALUES(58,58,'client',1,'2014-08-19 00:57:51',NULL);
INSERT INTO "rule" VALUES(59,59,'guest',1,'2014-08-19 00:57:51',NULL);
INSERT INTO "rule" VALUES(60,60,'client',1,'2014-08-19 00:57:51',NULL);
DROP TABLE IF EXISTS "user";
CREATE TABLE user (id_user INTEGER NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, username VARCHAR(100) DEFAULT NULL, state INTEGER NOT NULL, uid VARCHAR(150) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_user));
INSERT INTO "user" VALUES(14,'email1@gmail.com','$2y$10$UfBN6QuYiyVoCwgB/1U8yui6ADhACs8GIr0ZC2iOixZqRxD4INAEu','',1,NULL,'2014-08-19 00:57:11',NULL);
INSERT INTO "user" VALUES(15,'email2@gmail.com','$2y$10$UfBN6QuYiyVoCwgB/1U8yui6ADhACs8GIr0ZC2iOixZqRxD4INAEu','',0,NULL,'2014-08-19 00:57:11',NULL);
DROP TABLE IF EXISTS "user_role_linker";
CREATE TABLE user_role_linker (id_user INTEGER NOT NULL, id_role VARCHAR(255) NOT NULL, PRIMARY KEY(id_user, id_role), CONSTRAINT FK_611178996B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_61117899DC499668 FOREIGN KEY (id_role) REFERENCES role (id_role) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO "user_role_linker" VALUES(14,'admin');
INSERT INTO "user_role_linker" VALUES(15,'admin');
CREATE INDEX action_IDX_47CC8C92E978E64D ON action (id_controller);
CREATE INDEX controller_IDX_4CF2669A2A1393C5 ON controller (id_module);
CREATE UNIQUE INDEX email_UNIQUE ON user (email);
CREATE INDEX role_IDX_57698A6A1BB9D5A2 ON role (id_parent);
CREATE INDEX rule_IDX_46D8ACCC61FB397F ON rule (id_action);
CREATE INDEX rule_IDX_46D8ACCCDC499668 ON rule (id_role);
CREATE INDEX rule_IDX_46D8ACCCE978E64D ON rule (id_controller);
CREATE INDEX user_role_linker_IDX_611178996B3CA4B ON user_role_linker (id_user);
CREATE INDEX user_role_linker_IDX_61117899DC499668 ON user_role_linker (id_role);
