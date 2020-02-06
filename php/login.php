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
        <title>Connexion</title>
    </head>
        <body>
            <div class="container">
                <!-- Formulaire de connexion -->
                <div class="loginForm">
                    <form action="verification.php" method="POST">
                        <!-- Titre login form -->
                        <div class="logoHeader">
                            <a href="../index.php"><img src="../img/logoGbafOpenclassrooms.png" alt="logo gbaf" class="logo"></a>
                        </div>
                        <div class="message">
                            <?php 
                                if (isset($_GET['succes']) && $_GET['succes'] == true) 
                                {
                                    echo ("<span class=".'labelMessage'.">Inscription réussi. Connectez-vous.</span>");
                                } elseif (isset($_GET['passwordChange']) && $_GET['passwordChange'] == true) 
                                {
                                    echo ("<span class=".'labelError'.">Mot de passe modifier. Connectez-vous.</span>");
                                }

                             ?>
                        </div>
                        <!-- Champs utilisateur -->
                        <div class="username">
                            <label><b>Nom d'utilisateur</b></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                        </div>
                        <!-- Champ Mot de passe -->
                        <div class="password">
                            <label><b>Mot de passe</b></label>
                            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                        </div>
                        <!-- Bouton d'envoie -->
                        <div class="submitLogin">
                            <input type="submit" id='submit' value='LOGIN'>
                        </div>
                        <!-- Liens en dessous du formulaire de connexion -->
                        <div class="liensFormLogin">
                            <ul class="inscriptionMotDePass">
                                <li class="inscription"><a href="register.php">Inscription</a></li>
                                <li class="motDePass"><a href="forgotPassword.php">Mot de passe oublié ?</a></li>
                            </ul>
                        </div>
                        <!-- Les mentions légales -->
                        <div class="mentionsLegales">
                            <p><a href="mentionsLegales.php">Mentions légales</a></p>
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