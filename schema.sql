CREATE DATABASE BooksRent CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE `books` (
  `id` INT AUTO_INCREMENT,
  `title` VARCHAR(80) NOT NULL,
  `author` VARCHAR(30) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);