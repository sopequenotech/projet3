<?php
setlocale(LC_TIME, "fr_FR");
// on definit la session
session_start();
if(!isset($_SESSION['username']))
{
header('Location: login.php');
exit;
}
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
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/parametreUser.css" media="screen" type="text/css">
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
        <!-- Contenue de la page user parametre -->
        <div class="contenuProfil container-fluid">
            <!-- Contenue des informations sur l'utilisateur -->
            <div class="contenuUser">
                <!-- information de l'utilisateur -->
                <div class="informationsUser">
                    <div class="nomPrenom">
                        <div class="nom">
                            <h4>Nom  </h4>
                            <p><?php echo $donneesUtilisateur['nom'] ?></p>
                        </div>
                        <div class="prenom">
                            <h4>Prénom  </h4>
                            <p><?php echo $donneesUtilisateur['prenom'] ?></p>
                        </div>
                    </div>
                    <div class="contenuUsername">
                        <h4>Nom d'utilisateur  </h4>
                        <p><?php echo $donneesUtilisateur['username'] ?></p>
                    </div>
                    <div class="modificationProfil">
                        <button type="button" class="btn btn-primary" id="myBtn">Modifier le profil</button>
                        <?php 
                            if (isset($_GET['profilModifier']) && $_GET['profilModifier'] == true)
                            {
                                echo ("<span class=".'labelMessage'.">Votre profil a été modifier.</span>");
                            }
                         ?>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modification du profil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <form action="modifierProfilParametreProfil.php" method="POST">
                                            <!-- Champs utilisateur -->
                                            <div class="modificationNom">
                                                <label><b>Nom d'utilisateur</b></label>
                                                <br>
                                                <input type="text" value=" <?php echo $_SESSION['username']; ?> "
                                                    name="username">
                                            </div>
                                            <!-- Champ Mot de passe -->
                                            <div class="password">
                                                <label><b>Mot de passe</b></label>
                                                <br>
                                                <input type="password" placeholder="Entrer le nouveau mot de passe"
                                                    name="password1">
                                            </div>
                                            <div class="password">
                                                <label><b>Mot de passe</b></label>
                                                <br>
                                                <input type="password" placeholder="Entrer de nouveau le mot de passe"
                                                    name="password2">
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
                                            <div class="responseSecrete">
                                                <label>Réponse à la question secrète</label>
                                                <input type="text" placeholder="Réponse secrete" name="secretReponse" >
                                            </div>
                                            <input type="submit" class="btn btn-success btn-block" value="Modifier le profil">
                                        </form>   
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- images des acteurs likés -->
                <div class="acteursLikes">
                    <!-- on recupere les acteurs liker par l'utilisateur -->
                    <?php 
                        $requeteActeurLiker = "SELECT * FROM vote WHERE id_user=?";
                        $resultatActeursLiker = $bdd->prepare($requeteActeurLiker);
                        $resultatActeursLiker->execute(array($idUser));

                        // on determine les images des acteurs dont le vote est true
                        $voteTrue = 0;
                        while($donneesActeursLiker = $resultatActeursLiker->fetch())
                        {
                            if($donneesActeursLiker['vote'] == 'true')
                            {
                                // determination du lien du logo de l'acteur
                                $idActeur = $donneesActeursLiker['id_acteur'];

                                $requeteLienLogoActeur = "SELECT * FROM acteur WHERE id_acteur=?";
                                $resultatLienLogo = $bdd->prepare($requeteLienLogoActeur);
                                $resultatLienLogo->execute(array($idActeur));
                                $donneesActeursLiker = $resultatLienLogo->fetch();
                                $resultatLienLogo->closeCursor();
                                ?>
                                <div class="logoActeur">
                                    <a href="acteurPage.php?idActeur=<?php echo $donneesActeursLiker['id_acteur'] ?>"><img src="../<?php echo $donneesActeursLiker['logo']; ?>"></a>
                                </div>
                                <?php

                            }
                        }
                        $resultatActeursLiker->closeCursor();
                     ?>
                </div>
                <!-- liste des derniers commentaires et possibilité de les supprimer -->
                <div class="dernierCommentaires">
                    <h3>Derniers commentaires :</h3>
                    <?php 
                        // on recupere les commentaire de l'utilisateur
                        $requetePost = "SELECT * FROM post WHERE id_user=? ORDER BY id_post DESC LIMIT 0, 3";
                        $resultatPost = $bdd->prepare($requetePost);
                        $resultatPost->execute(array($idUser));

                        while($donneesPostUser = $resultatPost->fetch()) 
                        {
                        ?>
                        <div class="postUser">
                            <div class="date">
                                <h5>Date :</h5><p><?php echo (strftime("%A %d %B %G", strtotime($donneesPostUser['date_add']))); ?></p>
                            </div>
                            <div class="commentaire">
                                <h5>Commentaire :</h5><p><?php echo $donneesPostUser['post']; ?></p>
                            </div>
                        </div>
                        <?php
                        }
                        $resultatPost->closeCursor();
                     ?>
                </div>
            </div>
            <!-- Image de l'utilisateur -->
            <div class="imageUser">
                <img src="../img/bruno-adamo-WBYKlk-awg0-unsplash.jpg" alt="image banque de la page de profil" class="imageProfil">

            </div>
        </div>


    </div>
    <!-- Footer -->
    <footer class="page-footer font-small">
        <div class="copyright">
            <p>&copy 2020 - GBAF</p>
        </div>
        <div class="liensFooter">
            <a href="mentionsLegales.php" class="mentionsLegales">| Mentions légales</a>
            <a href="contact.php" class="contact">| Contact |</a>
        </div>
    </footer>
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