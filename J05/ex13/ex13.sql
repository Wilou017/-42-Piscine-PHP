SELECT ROUND(AVG(nbr_siege), 0) AS `moyenne`
     FROM `db_amaitre`.`salle`
     GROUP BY `etage_salle`