SELECT `etage_salle` AS `etage`,
       SUM(`nbr_siege`) AS `sieges`
     FROM `db_amaitre`.`salle`
     GROUP BY `etage`
     ORDER BY `sieges` DESC;