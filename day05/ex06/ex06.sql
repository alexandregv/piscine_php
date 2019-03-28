SELECT `titre`, `resum`
FROM `db_aguiot--`.`film`
WHERE LOWER(`resum`) LIKE '%vincent%'
ORDER BY `id_film` ASC;