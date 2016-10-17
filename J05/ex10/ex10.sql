SELECT `titre` AS `Titre` ,
       `resum` AS `Resume`,
       `annee_prod`
    FROM `db_amaitre`.`film` AS `f` INNER JOIN `db_amaitre`.`genre` AS `g`
    WHERE `f`.`id_genre` = `g`.`id_genre`
    AND `g`.`nom` = 'erotic'
    ORDER BY `annee_prod` DESC