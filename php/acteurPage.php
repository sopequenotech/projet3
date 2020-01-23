<?php
session_start();

if(!isset($_SESSION['username']))
{
    header('Location: ../index.php');
    exit;
}

// appel de la connexion a la base de données
require 'fonctions.php';
$bdd = getBdd();

$idActeur = $_GET['idActeur'];
$_SESSION['idActeur'] = $idActeur;


// on récupere les infos de l'acteur sélectioner
$requeteInfoActeur = "SELECT * FROM acteur WHERE id_acteur=?";
$resultatInfoActeur = $bdd->prepare($requeteInfoActeur);
$resultatInfoActeur->execute(array($idActeur));
$donneesActeur = $resultatInfoActeur->fetch();
$resultatInfoActeur->closeCursor();

// on recupere les infos de l'utilisateur 
$requeteInfoUtilisateur = "SELECT * FROM account WHERE username=? AND password=?";
$resultatInfoUtilisateur = $bdd->prepare($requeteInfoUtilisateur);
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$resultatInfoUtilisateur->execute(array($username, $password));
$donneesUtilisateur = $resultatInfoUtilisateur->fetch();
$resultatInfoUtilisateur->closeCursor();


// on recupere les vote de l'acteur
$requeteVoteActeur = "SELECT * FROM vote WHERE id_acteur=?";
$resultatvoteActeur = $bdd->prepare($requeteVoteActeur);
$resultatvoteActeur->execute(array($idActeur));
// on determine la note de l'acteur
$voteTrue = 0;
while($donneesVoteActeur = $resultatvoteActeur->fetch())
{
    if($donneesVoteActeur['vote'] == "true")
    {
        $voteTrue += 1;
    }
}
$resultatvoteActeur->closeCursor();

$voteTotale = $resultatvoteActeur->rowCount();

$noteVote = ($voteTrue * 5) / $voteTotale;


// données de la session
$_SESSION['idUser'] = $donneesUtilisateur['id_user'];
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
    <link rel="stylesheet" href="../css/acteurPage.css" media="screen" type="text/css">
    <title><?php echo $donneesActeur['acteur']?> </title>
</head>

<body>
    <div class="container">

        <!-- Header du site -->
        <header>
            <div class="navBar">
                <nav class="navbar bg-light navbar-light">
                    <div class="logo">
                        <img src="../img/logoGBAF100_100.png" alt="">
                    </div>
                    <div class="userNavBar">
                        <div class="imgUser">
                            <img src="../img/boy.png" alt="utilisateur">
                        </div>
                        <div class="compteUser">
                            <div class="identiteUser">
                                <h3><?php echo($donneesUtilisateur['nom']) ?></h3>
                                <p><?php echo($donneesUtilisateur['prenom']) ?></p>
                            </div>
                            <div class="logout">
                                <a href="logout.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Section acteur -->
        <section class="acteur">
            <div class="contenuActeur">
                <img src="../<?php echo $donneesActeur['logo'] ?>" alt="logo <?php echo $donneesActeur['acteur']?>">
                <h2><?php echo $donneesActeur['acteur']; ?></h2>
                <p><?php echo $donneesActeur['description'] ?></p>
            </div>
        </section>

        <!-- Section commentaire acteur -->
        <section class="commentaireAnnonce">
            <div class="contenuCommentaire">
                <?php
                    // on recupere les commentaire de l'acteur 
                    $requetePost = "SELECT * FROM post WHERE id_acteur=?";
                    $resultatPostActeur = $bdd->prepare($requetePost);
                    $resultatPostActeur->execute(array($idActeur));

                ?>
                <h2><?php echo $resultatPostActeur->rowCount() ?> Commentaires</h2>
                <a href="nouveauCommentaire.php?">Nouveau Commentaire</a>
                <div class="likeDislikeForm">
                    <form action="likeDislikeActeur.php" class="likeDislikeForm" method="POST">
                        <p><?php echo number_format($noteVote, 2, '.', ',') ?></p>
                        <input type="submit" name="like" alt="like icone" src="../img/like.png" value="true" />
                        <input type="submit" name="dislike" alt="dislike icone" src="../img/disLike.png"value="false" />
                    </form>
                </div>
                <div class="newPostForm">
                    <form action="nouveauCommentaire.php" method="POST">
                        <label><b>Nouveau commentaire</b></label>
                        <input type="text" placeholder="Entrer votre commentaire" name="nouveauCommentaire">
                        <input type="submit" id="submit" value="Ajouter">
                    </form>
                </div>

                <?php
                    while ($donneesPostActeur = $resultatPostActeur->fetch())
                    {
                    ?>
                    <div class="postActeur">
                        <p>Prénom = <?php echo $donneesUtilisateur['prenom'] ?></p>
                        <p>Date = <?php echo $donneesPostActeur['date_add'] ?></p>
                        <p>Texte = <?php echo $donneesPostActeur['post'] ?></p>
                    </div>
                    <?php
                    }
                    $resultatPostActeur->closeCursor();
                ?>
            </div>
        </section>

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