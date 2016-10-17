SELECT UCASE(`fp`.`nom`) AS `NOM`,
      `fp`.`prenom`,
      `a`.`prix`
      FROM `db_amaitre`.`abonnement` AS `a` INNER JOIN `db_amaitre`.`fiche_personne` AS `fp` INNER JOIN `membre` AS `m`
      WHERE `m`.`id_fiche_perso` = `fp`.`id_perso`
      AND `m`.`id_abo` = `a`.`id_abo`
      AND `a`.`prix` > 42
    ORDER BY `fp`.`nom` AND  `fp`.`prenom` ASC