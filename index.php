<?php
// on definit la session
session_start();
if(!isset($_SESSION['username']))
{
header('Location: php/login.php');
exit;
}
// appel de la connexion a la base de données
require 'php/fonctions.php';
$bdd = getBdd();
// on recupere les info de l'utilisateur
$requeteInfoUtilisateur = "SELECT * FROM account WHERE username=? AND password=?";
$resultatInfoUtilisateur = $bdd->prepare($requeteInfoUtilisateur);
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$resultatInfoUtilisateur->execute(array($username, $password));
$donneesUtilisateur = $resultatInfoUtilisateur->fetch();
$resultatInfoUtilisateur->closeCursor();
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
    <link rel="stylesheet" href="css/accueil.css" media="screen" type="text/css">
    <title>GBAF</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Header du site -->
        <header>
            <div class="barreDeNavigation">
                <nav class="navbar fixed-top">
                    <div class="logo">
                        <a href="index.php"><img src="img/logoGbafOpenclassrooms.png" alt="" class="logoGbaf"></a>&nbsp;
                    </div>
                    <div class="username">
                        <div class="dropdown">
                            <button class="boutonsMenu"><img src="img/icons8-male_user.png" alt="utilisateur" class="iconeUser"></button>
                            <div class="dropdown-content">
                                <a class="dropdown-item" href="php/parametreUser.php"><img src="img/icons8-settings.png" alt="icone de parametrege du compte"> Paramètres du compte</a>
                                <div class="divider"></div>
                                <a class="dropdown-item" href="php/logout.php"><img src="img/icons8-shutdown.png" alt="icone de deconnexion du site"> Déconnexion</a>
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
        <!-- Section présentation -->
        <section class="presentation">
            <img src="img/bruno-adamo-WBYKlk-awg0-unsplash.jpg" alt="place de la bourse bordeaux" class="imgPresentation">
            <div class="textePresentation">
                <div class="descriptionGbaf">
                    <h1>Groupement Banque-Assurance Français</h1>
                    <div class="finDescription">
                        <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de
                            la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à
                            l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section acteurs -->
        <section class="acteurs">
            <div class="contenuActeurs">
                <h2>Acteurs et Partenaires</h2>
                <div class="contenuActeur">
                    <?php
                            $requeteActeurs = "SELECT * FROM acteur";
                            $resultatActeurs =$bdd->prepare($requeteActeurs);
                            $resultatActeurs->execute();
                            while($donneesActeurs = $resultatActeurs->fetch())
                            {
                            ?>
                    <div class="acteur">
                        <div class="logoActeur">
                            <img src="<?php echo $donneesActeurs['logo'] ?>" alt="logo acteur">
                        </div>
                        <div class="contenuActeurDescript">
                            <h3>
                                <?php echo $donneesActeurs['acteur'] ?>
                            </h3>
                            <p>
                                <?php
                                        // portion de la description
                                        $extrait = substr($donneesActeurs['description'], 0, 120);
                                        // trouver le dernier espace de l'extrait
                                        $espace = strrpos($extrait, ' ');
                                        // recupere l'extrait en prenant en compte l'espace
                                        echo substr($extrait, 0, $espace). ' ...';
                                        ?>
                            </p>
                        </div>
                        <div class="lienActeur">
                            <a href="php/acteurPage.php?idActeur=<?php echo $donneesActeurs['id_acteur'] ?>">Lire
                                suite</a>
                        </div>
                    </div>
                    <?php
                            }
                            $resultatActeurs->closeCursor();
                            
                            ?>
                </div>
            </div>
        </section>
    </div>
    <div class="siteFooter">
        <!-- Footer -->
        <footer class="page-footer font-small">
            <div class="copyright">
                <p>&copy 2020 - GBAF</p>
            </div>
            <div class="liensFooter">
                <a href="php/mentionsLegales.php" class="mentionsLegales">| Mentions légales |</a>
                <a href="php/contact.php" class="contact">Contact |</a>
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
</body>

</html>