INSERT INTO `db_amaitre`.`ft_table` (`login`, `groupe`, `date_de_creation`)
SELECT `nom` AS `login`,
       'other',
       `date_naissance` AS `date_de_creation`
  FROM `fiche_personne`
  WHERE `nom` LIKE '%a%' AND CHAR_LENGTH(`nom`) < 9
  ORDER BY `nom` ASC
  LIMIT 10;