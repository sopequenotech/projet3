<!--demarrage de la session -->
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
    <link rel="stylesheet" href="css/index.css" media="screen" type="text/css">
    <title>GBAF</title>
</head>

<body>
    <div class="container">
        <!-- Header du site -->
        <header>
            <div class="navBar">
                <nav class="navbar bg-light navbar-light">
                    <!-- logo GBAF -->
                    <div class="logo">
                        <a href="index.php"><img src="img/logoGBAF100_100.png" alt=""></a>
                    </div>
                    <!-- bare de navigation -->
                    <div class="userNavBar">
                        <div class="iconePlusNom">
                            <!-- icone image de l'utilisateur -->
                            <div class="imgUser">
                                <img src="img/icons8-male_user.png" alt="utilisateur" class="iconeUser">
                            </div>
                            <!-- information sur l'utilisateur -->
                            <div class="identiteUser">
                                <h4><?php echo($donneesUtilisateur['nom']) ?>&nbsp;</h4>
                                <h4><?php echo($donneesUtilisateur['prenom']) ?></h4>
                            </div>
                        </div>
                        <div class="compteUser">
                            <!-- boutton paramètre du compteUser -->
                            <div class="parametreUser">
                                <a href="parametreUser.php"><img src="img/icons8-settings.png"
                                        alt="icone de parametrege du compte"></a>
                            </div>
                            <!-- boutton de deconnexion -->
                            <div class="logout">
                                <a href="php/logout.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Section présentation -->
        <section class="presentation">

            <div class="textePresentation">
                <h1>Groupement Banque-Assurance Français</h1>
                <div class="descriptionGbaf">
                    <div class="debutDescription">
                        <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération représentant les 6 grands
                            groupes français :</p>
                        <ul>
                            <li>BNP Paribas ;</li>
                            <li>BPCE;</li>
                            <li>Crédit Agricole ;</li>
                            <li>Crédit Mutuel-CIC ;</li>
                            <li>Société Générale ;</li>
                            <li>La Banque Postale.</li>
                        </ul>
                    </div>
                    <div class="finDescription">
                        <p>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même
                            façon pour gérer près de 80 millions de comptes sur le territoire national.
                            Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la
                            réglementation financière française. Sa mission est de promouvoir l'activité bancaire à
                            l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
                    </div>
                </div>
                <img src="img/placeBourse.jpg" alt="place de la bourse bordeaux" class="imgPresentation">
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
                        <div class="logoActeur col-md-3">
                            <img src="<?php echo $donneesActeurs['logo'] ?>" alt="logo acteur">
                        </div>
                        <div class="contenuActeurDescript col-md-7">
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
                        <div class="lienActeur col-md-2">
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

        <!-- Footer -->
        <footer>
            <ul>
                <li><a href="php/mentionsLegales.php">Mentions légales</a></li>
                <li>
                    <p>|</p>
                </li>
                <li><a href="php/contact.php">Contact</a></li>
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