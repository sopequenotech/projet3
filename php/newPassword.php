<?php

session_start();  // démarrage d'une session


// on vérifie que les données du formulaire sont présentes
if (!empty($_POST['username']) && !empty($_POST['secretQuestion']) && !empty($_POST['reponseSecret'])); 
{
    // appel de la connexion a la base de données
    require 'fonctions.php';
    $bdd = getBdd();
    
    // creation de variable
    $username = htmlspecialchars($_POST['username']);
    $questionSecret = htmlspecialchars($_POST['secretQuestion']);
    $reponseSecret = htmlspecialchars($_POST['reponseSecret']);

    // verification des information saisie
    $requete = "SELECT * FROM account WHERE username=? AND question=? AND reponse=?";
    $resultat = $bdd->prepare($requete);
    $resultat->execute(array($username, $questionSecret, $reponseSecret));
    
    if($resultat->rowCount() == 1)
    {
        $_SESSION['username'] = $username;
    }
}

?>

<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css" media="screen" type="text/css">
    <title>Nouveau Mot De Passe</title>
</head>

<body>
  <div class="container">

    <div class="newPasswordForm">
        <form action="updatePassword.php" method="POST">
            <!-- Titre login form -->
            <div class="logoHeader">
                <a href="../index.php"><img src="../img/logoGBAF100_100.png" alt="logo gbaf"></a>
            </div>
            <div class="password1">
                <label><b>Nouveau mot de passe</b></label>
                <input type="password" placeholder="Saisir le nouveau mot de passe" name="password1" required>
            </div>
            <div class="password2">
                <label><b>Ressaisir le mot de passe</b></label>
                <input type="password" placeholder="Ressaisir le mot de passe" name="password2" required>
            </div>
            <div class="bouttonModifier">
                <input type="submit" id='submit' value='MODIFIER'>
            </div>
            <div class="liensFormLogin">
                <ul class="inscriptionMotDePass">
                    <li class="connexion"><a href="../index.php">Connexion</a></li>
                    <li class="inscription"><a href="register.php">Inscription</a></li>
                    <li class="mentionsLegales"><a href="mentionsLegales.php">Mentions légales</a></li>
                </ul>
            </div>
        </form>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</body>

</html>