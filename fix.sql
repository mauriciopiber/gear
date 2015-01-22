DROP INDEX role_fk_role_2;
DROP INDEX role_fk_role_1;
CREATE TEMPORARY TABLE __temp__role AS SELECT id_role, id_parent, name, created, updated, created_by, updated_by FROM role;
DROP TABLE role;
CREATE TABLE role (id_role INTEGER NOT NULL, created_by INTEGER DEFAULT NULL, updated_by INTEGER DEFAULT NULL, id_parent INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_role), CONSTRAINT FK_57698A6ADE12AB56 FOREIGN KEY (created_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_57698A6A16FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_57698A6A1BB9D5A2 FOREIGN KEY (id_parent) REFERENCES role (id_role) NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO role (id_role, id_parent, name, created, updated, created_by, updated_by) SELECT id_role, id_parent, name, created, updated, created_by, updated_by FROM __temp__role;
DROP TABLE __temp__role;
CREATE INDEX fk_role_3 ON role (id_parent);
CREATE INDEX fk_role_1 ON role (created_by);
CREATE INDEX fk_role_2 ON role (updated_by);
DROP INDEX user_updated_by;
DROP INDEX user_created_by;
DROP INDEX user_email_UNIQUE;
CREATE TEMPORARY TABLE __temp__user AS SELECT id_user, email, password, username, state, uid, created, updated, created_by, updated_by FROM user;
DROP TABLE user;
CREATE TABLE user (id_user INTEGER NOT NULL, created_by INTEGER DEFAULT NULL, updated_by INTEGER DEFAULT NULL, email VARCHAR(100) NOT NULL COLLATE BINARY, password VARCHAR(100) NOT NULL COLLATE BINARY, username VARCHAR(100) DEFAULT NULL COLLATE BINARY, state INTEGER NOT NULL, uid VARCHAR(150) DEFAULT NULL COLLATE BINARY, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id_user), CONSTRAINT FK_8D93D649DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D64916FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO user (id_user, email, password, username, state, uid, created, updated, created_by, updated_by) SELECT id_user, email, password, username, state, uid, created, updated, created_by, updated_by FROM __temp__user;
DROP TABLE __temp__user;
CREATE UNIQUE INDEX email_UNIQUE ON user (email);
CREATE INDEX created_by ON user (created_by);
CREATE INDEX updated_by ON user (updated_by);
DROP INDEX user_role_linker_fk_user_role_linker_1;
DROP INDEX user_role_linker_IDX_61117899DC499668;
DROP INDEX user_role_linker_IDX_611178996B3CA4B;
CREATE TEMPORARY TABLE __temp__user_role_linker AS SELECT id_user, id_role FROM user_role_linker;
DROP TABLE user_role_linker;
CREATE TABLE user_role_linker (id_user INTEGER NOT NULL, id_role INTEGER NOT NULL, PRIMARY KEY(id_user, id_role), CONSTRAINT FK_611178996B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_61117899DC499668 FOREIGN KEY (id_role) REFERENCES role (id_role) NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO user_role_linker (id_user, id_role) SELECT id_user, id_role FROM __temp__user_role_linker;
DROP TABLE __temp__user_role_linker;
CREATE INDEX IDX_61117899DC499668 ON user_role_linker (id_role);
CREATE INDEX IDX_611178996B3CA4B ON user_role_linker (id_user);
DROP INDEX testing_suite_fk_testing_suite_1;
DROP INDEX testing_suite_updated_by;
DROP INDEX testing_suite_created_by;
CREATE TEMPORARY TABLE __temp__testing_suite AS SELECT id_testing_suite, test_date, test_datetime, test_time, test_decimal, test_decimal_money_pt_br, test_date_pt_br, test_datetime_pt_br, test_int, test_int_checkbox, test_varchar, test_varchar_image_upload, test_tinyint, test_tinyint_checkbox, created, updated, created_by, updated_by, test_text, id_test_user, test_varchar_email FROM testing_suite;
DROP TABLE testing_suite;
CREATE TABLE testing_suite (id_testing_suite INTEGER NOT NULL, id_test_user INTEGER DEFAULT NULL, created_by INTEGER DEFAULT NULL, updated_by INTEGER DEFAULT NULL, test_date DATE NOT NULL, test_datetime DATETIME NOT NULL, test_time TIME NOT NULL, test_decimal NUMERIC(10, 2) NOT NULL, test_decimal_money_pt_br NUMERIC(10, 2) NOT NULL, test_date_pt_br DATE NOT NULL, test_datetime_pt_br DATETIME NOT NULL, test_int INTEGER NOT NULL, test_int_checkbox INTEGER NOT NULL, test_varchar VARCHAR(100) NOT NULL COLLATE BINARY, test_varchar_image_upload VARCHAR(100) NOT NULL COLLATE BINARY, test_tinyint BOOLEAN NOT NULL, test_tinyint_checkbox INTEGER DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, test_text CLOB NOT NULL COLLATE BINARY, test_varchar_email VARCHAR(100) NOT NULL COLLATE BINARY, PRIMARY KEY(id_testing_suite), CONSTRAINT FK_8DC049C8DF40A1 FOREIGN KEY (id_test_user) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8DC049CDE12AB56 FOREIGN KEY (created_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8DC049C16FE72E1 FOREIGN KEY (updated_by) REFERENCES user (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO testing_suite (id_testing_suite, test_date, test_datetime, test_time, test_decimal, test_decimal_money_pt_br, test_date_pt_br, test_datetime_pt_br, test_int, test_int_checkbox, test_varchar, test_varchar_image_upload, test_tinyint, test_tinyint_checkbox, created, updated, created_by, updated_by, test_text, id_test_user, test_varchar_email) SELECT id_testing_suite, test_date, test_datetime, test_time, test_decimal, test_decimal_money_pt_br, test_date_pt_br, test_datetime_pt_br, test_int, test_int_checkbox, test_varchar, test_varchar_image_upload, test_tinyint, test_tinyint_checkbox, created, updated, created_by, updated_by, test_text, id_test_user, test_varchar_email FROM __temp__testing_suite;
DROP TABLE __temp__testing_suite;
CREATE INDEX created_by ON testing_suite (created_by);
CREATE INDEX updated_by ON testing_suite (updated_by);
CREATE INDEX fk_testing_suite_1 ON testing_suite (id_test_user);
