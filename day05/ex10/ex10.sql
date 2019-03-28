SELECT `titre` AS `Titre`, `resum` AS `Resume`, `annee_prod`
FROM `db_aguiot--`.`film`
INNER JOIN `db_aguiot--`.`genre`
ON `db_aguiot--`.`film`.`id_genre` = `db_aguiot--`.`genre`.`id_genre`
WHERE `genre`.`nom` = 'erotic'
ORDER BY `db_aguiot--`.`annee_prod` DESC;