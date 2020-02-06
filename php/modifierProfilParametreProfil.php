<?php 
    session_start();  // démarrage d'une session
    // verification des données du formulaire
    if (!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['secretReponse']))
    {
        // creation de variables
        $username = $_SESSION['username'];
        $newUsername = htmlspecialchars($_POST['username']);
        $newPassword1 = htmlspecialchars($_POST['password1']);
        $newPassword2 = htmlspecialchars($_POST['password2']);
        $newSecretQuestion = htmlspecialchars($_POST['secretQuestion']);
        $newResponseSecret = htmlspecialchars($_POST['secretReponse']);

        // Appel de la connexion a la base de donnée
        require 'fonctions.php';
        $bdd = getBdd();

        if ($newPassword1 == $newPassword2)
        {
            // requete permettant de mettre à jour les infos de l'utilisateur
            $requeteUpdateUser = $bdd->prepare("UPDATE account SET username = :username, password = :password, question = :question, reponse = :reponse WHERE username = :username1");
            $requeteUpdateUser->execute(array(
                'username' => $newUsername,
                'password' => $newPassword1,
                'question' => $newSecretQuestion,
                'reponse' => $newResponseSecret,
                'username1' => $username
            ));

            // on mets à jour les informations de la session
            $_SESSION['username'] = $newUsername;
            $_SESSION['password'] = $newPassword1;

            $profilModifier = true;
            
        }

    }

    if ($profilModifier == true)
    {
        header('Location: parametreUser.php?profilModifier=true');
    }
?>