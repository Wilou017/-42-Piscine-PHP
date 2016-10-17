SELECT `nom`, `prenom`, CAST(`date_naissance` AS DATE)
  FROM `db_amaitre`.`fiche_personne`
  WHERE EXTRACT(YEAR FROM `date_naissance`) = 1989
  ORDER BY `nom` ASC;