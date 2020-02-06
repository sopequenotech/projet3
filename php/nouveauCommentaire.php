<?php
session_start();

if(!isset($_SESSION['username']))
{
    header('Location: login.php');
    exit;
}

require 'fonctions.php';
$bdd = getBdd();

if(isset($_POST['nouveauCommentaire']))
{
    // creation de variables
    $idUser = $_SESSION['idUser'];
    $idActeur = $_SESSION['idActeur'];
    $dateAdd = date('Y-m-d H:i:s');
    $post = htmlspecialchars($_POST['nouveauCommentaire']);

    // requete de creation de post
    $requeteNewPost = $bdd->prepare("INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur, :date_add, :post)");
    $requeteNewPost->execute(array(
        'id_user' => $idUser,
        'id_acteur' => $idActeur,
        'date_add' => $dateAdd,
        'post' => $post
    ));

$postOk = true;
}

if($postOk == true)
{
    header('Location: acteurPage.php?idActeur='.$_SESSION['idActeur']);
}
?>