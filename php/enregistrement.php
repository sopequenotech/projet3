<?php


// on vérifie que les données du formulaire sont présentes
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['secretQuestion']) && !empty($_POST['secretReponse'])) 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();
    // creation de variable
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $secretQuestion = $_POST['secretQuestion'];
    $secretReponse = $_POST['secretReponse'];

    // cette requête permet d'enregister l'utilisateur sur la BD
    $requete = $bdd->prepare("INSERT INTO account (nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)");
    $requete->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'username' => $username,
        'password' => $password,
        'question' => $secretQuestion,
        'reponse' => $secretReponse
    ));
    

    // on ajoute ses infos en tant que variables de session
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    // cette variable indique que l'authentification a réussi
    $authOK = true;
}

if ($authOK == true) 
{
    header('Location: ../login.php?succes');
} else 
{
    header('Location: register.php?nosucces');
}
?>