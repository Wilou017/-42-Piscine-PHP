SELECT count(DISTINCT id_film) AS films
     FROM `db_amaitre`.`historique_membre`
     WHERE date
        BETWEEN '2006/10/30'
        AND '2007/07/27'
     OR (EXTRACT(DAY FROM date) = 24 AND EXTRACT(MONTH FROM date)=12);