SELECT COUNT(id_film)
AS `nb_court_metrage`
FROM `db_aguiot--`.`film`
WHERE `duree_min` <= 42;