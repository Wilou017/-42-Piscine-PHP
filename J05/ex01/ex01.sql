CREATE TABLE IF NOT EXISTS `ft_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(8) DEFAULT 'toto',
  `groupe` enum('staff','student','other') DEFAULT 'other' NOT NULL,
  `date_de_creation` DATE NOT NULL,
  PRIMARY KEY (`id`)
);