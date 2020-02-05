<?php

session_start();  // démarrage d'une session

$username = $_SESSION['username'];


// on vérifie que les données du formulaire sont présentes
if (!empty($_POST['password1']) && !empty($_POST['password2'])) 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();
    // creation de variable
    $password1 = htmlspecialchars($_POST['password1']);
    $password2 = htmlspecialchars($_POST['password2']);

    // verification des mots de asse saisi
    if($password1 == $password2)
    {
        $requete = $bdd->prepare("UPDATE account SET password=? WHERE username=?");
        $requete->execute(array($password2, $username));
    } 

    $passwordChange = true;


    if ($passwordChange == true)
    {
        header('Location: login.php?passwordChange=true');
    } else
    {
        header('Location: register.php?passwordChange=false');
    }

}