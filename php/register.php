<?php
if (isset($_GET['nosucces']))
{
echo "<h2> Vous n'êtes pas inscrit, vous devez remplir tous les champs. <h2>";
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
            <link rel="stylesheet" href="../css/register.css" media="screen" type="text/css">
            <title>Inscription</title>
        </head>
        <body>
            <div class="container">
                <!-- formulaire d'inscription -->
                <div class="registerForm">
                    <form action="enregistrement.php" method="POST">
                        <!-- Titre login form -->
                        <div class="logoHeader">
                            <a href="../index.php"><img src="../img/logoGbafOpenclassrooms.png" alt="logo gbaf" class="logo"></a>
                        </div>
                        <!-- Champs nom -->
                        <div class="nom">
                            <label><b>Nom</b></label>
                            <input type="text" placeholder="Entrer votre Nom" name="nom" required>
                        </div>
                        <!-- Champs prenom -->
                        <div class="prenom">
                            <label><b>Prénom</b></label>
                            <input type="text" placeholder="Entrer votre prénom" name="prenom" required>
                        </div>
                        <!-- Champs username -->
                        <div class="username">
                            <label><b>Nom d'utilisateur</b></label>
                            <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username"required >
                            <?php 
                                if (isset($_GET['usernameExist']) && $_GET['usernameExist'] == true)
                                {
                                    echo ("<label class=".'labelError'.">Le nom d'utilisateur est déja utilisé ! choisissez en un autre. </label>");
                                } elseif (isset($_GET['succes']) && $_GET['succes'] == false) 
                                {
                                    echo ("<label class=".'labelError'.">L'enrégistrement à échouer. veuillez réessayer s'il vous plait. </label>");    
                                }
                             ?>
                        </div>
                        <!-- Champs password -->
                        <div class="password">
                            <label><b>Mot de passe</b></label>
                            <input type="password" placeholder="Entrer votre mot de passe" name="password" required>
                        </div>
                        <!-- Champs secret question -->
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
                        <!-- Champs response secrete -->
                        <div class="responseSecrete">
                            <label>Réponse à la question secrète</label>
                            <input type="text" placeholder="Réponse secrete" name="secretReponse" required>
                        </div>
                        <!-- Bouton d'envoie -->
                        <div class="submitLogin">
                            <input type="submit" id='submit' value="S'ENRÉGISTER">
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