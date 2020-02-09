<?php
// appel de la connexion a la base de données
require 'fonctions.php';
$bdd = getBdd();
// on recupere les info de l'utilisateur
$requeteInfoUtilisateur = "SELECT * FROM account WHERE username=? AND password=?";
$resultatInfoUtilisateur = $bdd->prepare($requeteInfoUtilisateur);
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$resultatInfoUtilisateur->execute(array($username, $password));
$donneesUtilisateur = $resultatInfoUtilisateur->fetch();
$resultatInfoUtilisateur->closeCursor();


// données de la session
$_SESSION['idUser'] = $donneesUtilisateur['id_user'];
$idUser = $_SESSION['idUser'];

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
    <link rel="stylesheet" href="../css/contact.css" media="screen" type="text/css">
    <title>GBAF</title>
</head>

<body>
    <div class="profil container-fluid">
        <!-- Header du site -->
        <header>
            <div class="barreDeNavigation">
                <nav class="navbar fixed-top">
                    <div class="logo">
                        <a href="../index.php"><img src="../img/logoGbafOpenclassrooms.png" alt="" class="logoGbaf"></a>&nbsp;
                    </div>
                    <div class="username">
                        <div class="dropdown">
                            <button class="boutonsMenu"><img src="../img/icons8-male_user.png" alt="utilisateur" class="iconeUser"></button>
                            <div class="dropdown-content">
                                <a class="dropdown-item" href="parametreUser.php"><img src="../img/icons8-settings.png" alt="icone de parametrege du compte"> Paramètres du compte</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="logout.php"><img src="../img/icons8-shutdown.png" alt="icone de deconnexion du site"> Déconnexion</a>
                            </div>
                        </div>
                        <!-- information sur l'utilisateur -->
                        <div class="identiteUser">
                            <div class="nom">
                                <h5><?php echo($donneesUtilisateur['nom']) ?>&nbsp;</h5>
                            </div>
                            <div class="prenom">
                                <h5><?php echo($donneesUtilisateur['prenom']) ?></h5>
                            </div>
                        </div>
                    </div>
                    
                </nav>
            </div>
        </header>
        <!-- Contenue de la page contact -->
        <div class="contenuContactPage">
            <!-- Contenue des informations sur l'utilisateur -->
            <div class="contactForm">
                <form action="" method="POST">
                    <div class="enteteForm">
                        <h1>Contact</h1>
                        <p>Une remarque ? une sugestion ? n'hésitez pas à nous écrire.</p>
                    </div>
                    <!-- Champs nom -->
                    <div class="nom">
                        <label><b>nom </b></label>
                        <input type="text" placeholder="Entrer votre nom (Obligatoire)" name="nom" required>
                    </div>
                    <!-- Champ mail -->
                    <div class="mail">
                        <label><b>E-mail</b></label>
                        <input type="email" placeholder="Entrer votre adresse (Obligatoire)" name="mail" required>
                    </div>
                    <!-- Champs sujet -->
                    <div class="mail">
                        <label><b>Sujet</b></label>
                        <input type="text" name="sujet" >
                    </div>
                    <!-- Champs du message -->
                    <div class="message">
                        <label><b>Méssage</b></label>
                        <textarea name="message" required></textarea>
                    </div>
                    <!-- Bouton d'envoie -->
                    <div class="submitMessage">
                        <input type="submit" id='submit' value='Envoyer'>
                    </div>
                    <p><?php 
                //verification des donnée du foemulaire
                if (!empty($_POST['nom']) && !empty(['mail']) && !empty(['sujet']) && !empty(['message']))
                {
                    $from = htmlspecialchars($_POST['mail']);
                    $to ="contact@projet3.kellysossoe.xyz";
                    $subject = htmlspecialchars($_POST['sujet']);
                    $message = htmlspecialchars($_POST['message']);
                    $headers = "From:" . $from;
                    mail($to,$subject,$message, $headers);
                    echo "Méssage envoyer !";

                } ?></p>
                </form>
                
            </div>
            <!-- Image de l'utilisateur -->
            <div class="imageContact col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <img src="../img/bruno-adamo-WBYKlk-awg0-unsplash.jpg" alt="image banque de la page de profil" class="imageProfil">

            </div>
        </div>


    </div>
    <div class="siteFooter">
        <!-- Footer -->
        <footer class="page-footer font-small">
            <div class="copyright">
                <p>&copy 2020 - GBAF</p>
            </div>
            <div class="liensFooter">
                <a href="mentionsLegales.php" class="mentionsLegales">| Mentions légales |</a>
                <a href="contact.php" class="contact">Contact |</a>
            </div>
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
    <script>
        $(document).ready(function () {
            $("#myBtn").click(function () {
                $("#myModal").modal();
            });
        });
    </script>
</body>

</html>