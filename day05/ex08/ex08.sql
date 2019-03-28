SELECT `nom`, `prenom`, `date_naissance`
FROM `db_aguiot--`.`fiche_personne`
WHERE YEAR(`date_naissance`) = 1989
ORDER BY `nom` ASC;