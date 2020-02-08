<?php
session_start();

if(!isset($_SESSION['username']))
{
    header('Location: login.php');
    exit;
}

require 'fonctions.php';
$bdd = getBdd();

if(!empty($_POST['nouveauCommentaire']))
{
    // creation de variables
    $idUser = $_SESSION['idUser'];
    $idActeur = $_SESSION['idActeur'];
    $dateAdd = date('Y-m-d H:i:s');
    $post = htmlspecialchars($_POST['nouveauCommentaire']);

    // Requete de vérification de l'existance d'un commentaire
    $requetePost = "SELECT * FROM post WHERE id_user=? AND id_acteur=?";
    $resultatPost = $bdd->prepare($requetePost);
    $resultatPost->execute(array($idUser, $idActeur));
    // il existe 1 commentaire
    if ($resultatPost->rowcount() == 1)
    {
        // retour vers la page acteur avec un message d'erreur
        header('Location: acteurPage.php?idActeur='.$_SESSION['idActeur'].'&commentExist=true');
    } 
    // pas de commentaire
    else
    {
        // requete de creation de post
        $requeteNewPost = $bdd->prepare("INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, :date_add, :post)");
        $requeteNewPost->execute(array(
            'id_user' => $idUser,
            'id_acteur' => $idActeur,
            'date_add' => $dateAdd,
            'post' => $post
        ));
        $requeteNewPost->closeCursor();
        // retour vers la page acteur
        header('Location: acteurPage.php?idActeur='.$_SESSION['idActeur']);
    }
    $resultatPost->closeCursor();
}

?>