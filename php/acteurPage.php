<?php
setlocale(LC_TIME, "fr_FR");
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
$idUser = $_SESSION['idUser'];
?>


<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/acteurPage.css" media="screen" type="text/css">
    <title><?php echo htmlspecialchars($donneesActeur['acteur']); ?></title>
</head>

<body>
    <div class="container-fluid">
        <!-- Header du site -->
        <header>
            <!-- Barre de navigation -->
            <div class="barreDeNavigation">
                <nav class="navbar fixed-top">
                    <div class="logo">
                        <a href="../index.php"><img src="../img/logoGbafOpenclassrooms.png" alt="" class="logoGbaf"></a>&nbsp;
                    </div>
                    <!-- Icone user parametre du profil et deconnexion
                     -->
                    <div class="username">
                        <div class="dropdown">
                            <button class="boutonsMenu"><img src="../img/icons8-male_user.png" alt="utilisateur" class="iconeUser"></button>
                            <!-- Contenu de l'icone user -->
                            <div class="dropdown-content">
                                <!-- Parametre du compte -->
                                <a class="dropdown-item" href="parametreUser.php"><img src="../img/icons8-settings.png" alt="icone de parametrege du compte"> Paramètres du compte</a>
                                <div class="divider"></div>
                                <!-- Deconnexion de l'utilisateur -->
                                <a class="dropdown-item" href="logout.php"><img src="../img/icons8-shutdown.png" alt="icone de deconnexion du site"> Déconnexion</a>
                            </div>
                        </div>
                        <!-- information sur l'utilisateur -->
                        <div class="identiteUser">
                            <!-- Nom de l'utilisateur -->
                            <div class="nom">
                                <h5><?php echo(htmlspecialchars($donneesUtilisateur['nom'])); ?>&nbsp;</h5>
                            </div>
                            <!-- Prénom de l'utilisateur -->
                            <div class="prenom">
                                <h5><?php echo(htmlspecialchars($donneesUtilisateur['prenom'])); ?></h5>
                            </div>
                        </div>
                    </div>
                    
                </nav>
            </div>
        </header>

        <!-- Section acteur -->
        <section class="acteur">
            <!-- Contenu de la section acteur -->
            <div class="acteurContenu">
                <!-- Logo de l'acteur -->
                <div class="acteurLogo">
                    <img src="../<?php echo htmlspecialchars($donneesActeur['logo']); ?>" alt="logo <?php echo htmlspecialchars($donneesActeur['acteur']); ?>" class="logo">
                </div>
                <!-- Nom de l'acteur -->
                <div class="nomActeur">
                    <h1><?php echo htmlspecialchars($donneesActeur['acteur']); ?></h1>
                </div>
                <!-- Description complete de l'acteur -->
                <div class="descriptionActeur">
                    <p><?php echo $donneesActeur['description'] ?></p>
                </div>
            </div>
        </section>

        <!-- Section commentaire acteur -->
        <section class="commentaireAnnonce">
            <!-- Contenu de la section des commentaires de l'acteur -->
            <div class="contenuCommentaire">
                <!-- Nombre de commentaire bouton nouveau commentaire et vote acteur -->
                <div class="headerContenuCommentaire">
                    <!-- Nombre de commentaire de l'acteur -->
                    <div class="xCommentaire">
                        <?php
                            // on recupere les commentaire de l'acteur 
                            $requetePost = "SELECT * FROM post WHERE id_acteur=? ORDER BY id_post DESC LIMIT 0, 3";
                            $resultatPostActeur = $bdd->prepare($requetePost);
                            $resultatPostActeur->execute(array($idActeur));

                        ?>
                        <div class="nombreCommentaires">
                            <h2><?php echo $resultatPostActeur->rowCount() ?> Commentaires.</h2> 
                        </div>
                    </div>
                    <!-- Bouton nouveau commentaire et vote de l'acteur -->
                    <div class="newCommentAndLikes">
                        <!-- Bouton nouveau commentaire -->
                        <div class="newCommentaire" >
                            <a onclick="newPost()"><p>Nouveau commentaire</p></a>
                        </div>
                        <!-- Vote de l'acteur -->
                        <div class="likeDislikeForm">
                            <form action="likeDislikeActeur.php" class="likeDislikeForm" method="POST">
                                <!-- Nombre de vote de l'acteur -->
                                <div class="nombreVote">
                                    <p><?php echo $voteTrue; ?></p>
                                </div>
                                <!-- Bouton de vote de l'acteur -->
                                <div class="boutonsVote">
                                    <!-- Bouton like -->
                                    <button type="submit" name="like" alt="like icone" class="like"><img src="../img/icons8-thumbs_up.png" alt="icone like"></button>
                                    <!-- Bouton dislike -->
                                    <button type="submit" name="dislike" alt="dislike icone" class="dislike"><img src="../img/icons8-thumbs_up.png" alt="dislike icone"></button>
                                </div>
                                <div class="votefalse">
                                    <p> <?php echo($voteTotale - $voteTrue); ?> </p>
                                </div>
                            </form>
                        </div> 
                    </div>   
                </div>
                <!-- Formulaire d'ajout de commentaire a l'acteur -->
                <div class="newPostForm" id="newPost">
                    <form action="nouveauCommentaire.php" method="POST">
                        <div>
                            <label><b>Nouveau commentaire</b></label>
                        </div>
                        <!-- Input text d'ajout de commentaire -->
                        <div>
                            <input type="text" placeholder="Entrer votre commentaire" name="nouveauCommentaire">
                        </div>
                        <!-- Bouton d'ajout de commentaire -->
                        <div>
                            <input type="submit" id="submit" value="Ajouter">
                        </div>
                    </form>
                </div>
                <div class="commentaires">
                    <!-- Message de 1 commentaire par acteur -->
                    <div class="infoComment">
                        <p> <?php 
                            if (isset($_GET['commentExist']) && $_GET['commentExist'] == true)
                            {
                                echo "Vous avez déja commenter ce prestataire vous pouvez supprimez votre commentaire depuis le parametrage de votre profil.";
                            }

                        ?> </p>
                    </div>
                    <div class="dernierCommentaires">
                        <?php
                        while ($donneesPostActeur = $resultatPostActeur->fetch())
                        {
                        ?>
                        <div class="postActeur">
                            <div class="prenom">
                                <h5>Prénom: </h5><p><?php 
                                $requeteName = "SELECT * FROM account WHERE id_user=?";
                                $resultatName = $bdd->prepare($requeteName);
                                $resultatName->execute(array($donneesPostActeur['id_user']));

                                if ($resultatName->rowCount() == 1)
                                {
                                    $donneesUser = $resultatName->fetch();
                                    $resultatName->closeCursor();
                                    $prenom = $donneesUser['prenom']; 
                                }
                                echo $prenom; ?></p>
                            </div>
                            <div class="date">
                                <h5>Date: </h5><p>  <?php echo(echo utf8_decode(strftime("%A %d %B %G", strtotime($donneesPostActeur['date_add']))))  ?></p>
                            </div>
                            <div class="textes">
                                <h5>Texte: </h5><p><?php echo $donneesPostActeur['post'] ?></p>
                            </div>
                        </div>
                        <?php
                        }
                        $resultatPostActeur->closeCursor();
                        ?>
                    </div>
                </div>
                
                
            </div>
        </section>
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
function newPost() {
  var div = document.getElementById("newPost");
  if (div.style.display === "none") {
    div.style.display = "flex";
  } else {
    div.style.display = "none";
  }
}
</script>
</body>

</html>