<?php

session_start(); 

// on vérifie que les données du formulaire sont présentes
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['secretQuestion']) && !empty($_POST['secretReponse'])) 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();

    // creation de variable
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password = sha1($password);
    $secretQuestion = htmlspecialchars($_POST['secretQuestion']);
    $secretReponse = htmlspecialchars($_POST['secretReponse']);

    // cette requête permet d'enregister l'utilisateur sur la BD
    $requete = $bdd->prepare("UPDATE account SET nom = :nom, prenom = :prenom, username = :username1, password = :password1, question = :question, reponse = :reponse WHERE username = :username AND password = :password");
    $requete->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'username1' => $username,
        'password1' => $password,
        'question' => $secretQuestion,
        'reponse' => $secretReponse,
        'username' => $_SESSION['username'],
        'password' => $_SESSION['password']
    ));

    $authOK = true;
    $_SESSION['username'] = $username1;
    $_SESSION['password'] = $password1;

}

if ($authOK == true) 
{
    header('Location: ../index.php');
} else 
{
    header('Location: register.php?succes=false');
}
?>



 
    

    