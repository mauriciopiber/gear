DROP TABLE IF EXISTS columns;

CREATE  TABLE IF NOT EXISTS `columns` (
  `id_columns` INT NOT NULL AUTO_INCREMENT ,
  `column_date` DATE NULL ,
  `column_datetime` DATETIME NULL ,
  `column_time` TIME NULL ,
  `column_int` INT NULL ,
  `column_tinyint` TINYINT NULL ,
  `column_decimal` DECIMAL(10,2) NULL ,
  `column_varchar` VARCHAR(100) NULL ,
  `column_longtext` LONGTEXT NULL ,
  `column_text` TEXT NULL ,
  PRIMARY KEY (`id_columns`) )
ENGINE = InnoDB;