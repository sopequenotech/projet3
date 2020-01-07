<?php

/**
 * Gère la connexion à la base de données
 * @return PDO Objet de connexion à la BD
 */
function getBdd() {
    return new PDO("mysql:host=localhost;dbname=projet3k_bdd;charset=utf8",
        "projet3k_tech", "Chirac-234",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

?>