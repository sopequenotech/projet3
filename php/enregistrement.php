<?php


// on vérifie que les données du formulaire sont présentes
if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['secretQuestion']) && !empty($_POST['secretReponse'])) 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();

    // on recupere les données des comptes
    $resultatAccount = $bdd->query("SELECT * FROM account");
    while ($donneesAccount = $resultatAccount->fetch())
    {
        if ($donneesAccount['username'] == $_POST['username']) 
        {
            header('Location: register.php?usernameExist=true');
        }
    }
    // creation de variable
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $secretQuestion = htmlspecialchars($_POST['secretQuestion']);
    $secretReponse = htmlspecialchars($_POST['secretReponse']);

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
    header('Location: login.php?succes=true');
} else 
{
    header('Location: register.php?succes=false');
}
?>



 
    

    