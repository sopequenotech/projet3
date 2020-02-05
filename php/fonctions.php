<?php

/**
 * Gère la connexion à la base de données
 * @return PDO Objet de connexion à la BD
 */
function getBdd() {
    return new PDO("mysql:host=localhost;dbname=gbaf-bdd;charset=utf8",
        "root", "root",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}


function getName($idUser) {
	$bdd = getBdd();
	
}

?>