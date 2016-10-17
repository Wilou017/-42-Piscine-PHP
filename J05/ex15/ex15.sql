SELECT REVERSE(RIGHT(`telephone`, CHAR_LENGTH(`telephone`) - 1)) AS `telephone`
     FROM `db_amaitre`.`distrib`
     WHERE `telephone` LIKE '05%'