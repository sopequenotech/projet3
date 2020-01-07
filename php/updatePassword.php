<?php

session_start();  // démarrage d'une session

$username = $_SESSION['username'];


// on vérifie que les données du formulaire sont présentes
if (isset($_POST['password1']) && isset($_POST['password2'])) 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();
    // creation de variable
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    // verification des mots de asse saisi
    if($password1 == $password2)
    {
        $requete = $bdd->prepare("UPDATE account SET password=? WHERE username=?");
        $requete->execute(array($password2, $username));
    } 

    // l'utilisateur existe dans la table
    // on ajoute ses infos en tant que variables de session
    $_SESSION['password'] = $password2;
    // cette variable indique que l'authentification a réussi
    $authOK = true;

    if ($authOK == true)
    {
        header('Location: ../index.php');
    } else
    {
        header('Location: login.php');
    }

}