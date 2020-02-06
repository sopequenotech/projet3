<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/forgotPassword.css" media="screen" type="text/css">
        <title>Mot de passe oublie</title>
    </head>
        <body>
            <div class="container">
                <div class="forgotPasswordForm">
                    <form action="newPassword.php" method="POST">
                        <!-- Titre login form -->
                        <div class="logoHeader">
                            <a href="../index.php"><img src="../img/logoGbafOpenclassrooms.png" alt="logo gbaf" class="logo"></a>
                        </div>
                        <div class="username">
                            <label><b>Nom d'utilisateur</b></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                        </div>
                        <div class="secretQuestion">
                            <label><b>Question secrète</b></label>
                            <br>
                            <select placeholder="Choisissez votre question secrete" name="secretQuestion">
                                <option>quelle est votre couleur préférée</option>
                                <option>quelle est votre ville favorite</option>
                                <option>quelle est votre équipe sportive favorite</option>
                                <option>Quelle était le nom de votre école primaire</option>
                            </select>
                        </div>
                        <div class="secretResponse">
                            <label><b>Quel est votre réponse secrete ?</b></label>
                            <input type="text" placeholder="Entrer votre réponse secrète" name="reponseSecret" required>
                        </div>
                        <div class="submitLogin">
                            <input type="submit" id='submit' value='Modifier votre mot de passe'>
                        </div>
                        <!-- Liens en dessous du formulaire de connexion -->
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