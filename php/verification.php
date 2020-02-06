<?php
session_start();  // démarrage d'une session


// on vérifie que les données du formulaire sont présentes
if (isset($_POST['username']) && isset($_POST['password'])) {

    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM account WHERE username=? AND password=?";
    $resultat = $bdd->prepare($requete);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $resultat->execute(array($username, $password));
    if ($resultat->rowCount() == 1) {

        
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}

if (isset($authOK)) 
{
    header('Location: ../index.php');
} else 
{
    header('Location: login.php');
}
?>