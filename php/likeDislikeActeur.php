<?php
session_start();

if(!isset($_SESSION['username']))
{
    header('Location: login.php');
    exit;
}

require 'fonctions.php';
$bdd = getBdd();

// creation de variable
$idUser = $_SESSION['idUser'];
$idActeur = $_SESSION['idActeur'];

// on recupere ou on creer un vote pour l'utilisateur concernant l'acteur

$requeteVoteUser = "SELECT * FROM vote WHERE id_user=? AND id_acteur=?";
$resultatVoteUser = $bdd->prepare($requeteVoteUser);
$resultatVoteUser->execute(array($idUser, $idActeur));
$donneesVoteActeur = $resultatVoteUser->fetch();
$vote = $donneesVoteActeur['vote'];
$resultatVoteUser->closeCursor();


if(isset($_POST['like']))
{
    $vote = 'true';
    if($resultatVoteUser->rowcount() == 1)
    {
        $requeteUpdateVote = "UPDATE vote SET vote=? WHERE id_user=? AND id_acteur=?";
        $resultaUpdateVote = $bdd->prepare($requeteUpdateVote);
        $resultaUpdateVote->execute(array($vote, $idUser, $idActeur));
        $resultatVoteUser->closeCursor();
    } else 
    {
        $requeteFirstVote = "INSERT INTO vote (id_user, id_acteur, vote) VALUES(:id_user, :id_acteur, :vote)";
        $resultatFirstVote = $bdd->prepare($requeteFirstVote);
        $resultatFirstVote->execute(array(
            'id_user' => $idUser,
            'id_acteur' => $idActeur,
            'vote' => $vote
        ));
        $resultatFirstVote->closeCursor();
    }

} elseif(isset($_POST['dislike']))
{
    $vote = 'false';
    if($resultatVoteUser->rowcount() == 1)
    {
        $requeteUpdateVote = "UPDATE vote SET vote=? WHERE id_user=? AND id_acteur=?";
        $resultaUpdateVote = $bdd->prepare($requeteUpdateVote);
        $resultaUpdateVote->execute(array($vote, $idUser, $idActeur));
        $resultatVoteUser->closeCursor();
    } else 
    {
        $requeteFirstVote = "INSERT INTO vote (id_user, id_acteur, vote) VALUES(:id_user, :id_acteur, :vote)";
        $resultatFirstVote = $bdd->prepare($requeteFirstVote);
        $resultatFirstVote->execute(array(
            'id_user' => $idUser,
            'id_acteur' => $idActeur,
            'vote' => $vote
        ));
        $resultatFirstVote->closeCursor();
    }
}

header('Location: acteurPage.php?idActeur='.$_SESSION['idActeur']);
?>