USE `db_aguiot--`;
DROP TABLE IF EXISTS `db_aguiot--`.`ft_table`;
CREATE TABLE `ft_table` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`login` CHAR(8) NOT NULL DEFAULT 'toto',
	`groupe` ENUM('staff', 'student', 'other') NOT NULL,
	`date_de_creation` DATE NOT NULL,
	PRIMARY KEY (`id`)
);