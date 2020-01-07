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
    <title>Inscription</title>
</head>

<body>
    <div class="container">

        <!-- Header du site -->
        <header>
            <img src="../img/logoGBAF100_100.png" alt="logo gbaf">
        </header>

        <!-- formulaire d'inscription -->
        <div class="loginForm">
            <form action="enregistrement.php" method="POST">
                <h1>Inscription</h1>

                <label><b>Nom</b></label>
                <input type="text" placeholder="Entrer votre Nom" name="nom" required>

                <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="prenom" required>

                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="password" required>

                <label><b>Question secrète</b></label>
                <input type="text" placeholder="Choisissez votre question secrete" name="secretQuestion" required>

                <label>Réponse à la question secrète</label>
                <input type="text" placeholder="Réponse secrete" name="secretReponse" required>


                <input type="submit" id='submit' value= "S'ENRÉGISTRER">

                <ul class="inscriptionMotDePass">
                    <li class="inscription"><a href="register.php">Inscription</a></li>
                    <li class="separateur">
                        <p>|</p>
                    </li>
                    <li class="motDePass"><a href="forgotPassword.php">Mot de passe oublié ?</a></li>
                </ul>

                <p><a href="mentionsLegales.php">Mentions légales</a></p>

            </form>
        </div>
        <!-- Footer du site -->
        <footer>
            <ul>
                <li><a href="mentionsLegales.php">Mentions légales</a></li>
                <li>
                    <p>|</p>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </footer>
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