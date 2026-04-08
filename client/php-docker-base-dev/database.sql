CREATE TABLE IF NOT EXISTS `User` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`telephone` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `requests` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`client_id` int NOT NULL,
	`object` varchar(255) NOT NULL,
	`description` text NOT NULL,
	`prefferred_date` datetime NOT NULL,
	`status` varchar(255) NOT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `dossiers` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`client_id` int NOT NULL,
	`title` varchar(255) NOT NULL,
	`description` text NOT NULL,
	`type` varchar(255) NOT NULL,
	`status` varchar(255) NOT NULL,
	`updated_at` datetime NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `documents` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`dossier_id` int NOT NULL,
	`filename` varchar(255) NOT NULL,
	`uuid` varchar(255) NOT NULL,
	`access_code` varchar(255) NOT NULL,
	`created_at` datetime NOT NULL,
	PRIMARY KEY (`id`)
);


ALTER TABLE `requests` ADD CONSTRAINT `requests_fk1` FOREIGN KEY (`client_id`) REFERENCES `User`(`id`);
ALTER TABLE `dossiers` ADD CONSTRAINT `dossiers_fk1` FOREIGN KEY (`client_id`) REFERENCES `User`(`id`);
ALTER TABLE `documents` ADD CONSTRAINT `documents_fk1` FOREIGN KEY (`dossier_id`) REFERENCES `dossiers`(`id`);