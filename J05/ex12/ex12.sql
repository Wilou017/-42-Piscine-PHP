SELECT `nom`, `prenom`
   FROM `db_amaitre`.`fiche_personne`
   WHERE `nom` LIKE '%-%'
   OR `prenom` LIKE '%-%'
   ORDER BY `nom` AND  `prenom` ASC