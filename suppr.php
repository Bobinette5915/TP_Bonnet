<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("connectToBDD.php");
include("requeteGenerale.php");
$choix = $_GET["article"];

$sql2 = "SELECT * FROM `user` WHERE `email`= :mail";
    $query = $db->prepare($sql2);
    $query->bindvalue(":mail",$_SESSION['mail-Utilisateur'],PDO::PARAM_STR);
    $query->execute();
    $controle = $query->fetch();

echo $controle['id'];
echo $choix;

$sql9 = "DELETE FROM `favoris` WHERE `id_user` = :idUser AND `id_article` = :idArticle";
    $query = $db->prepare($sql9);
    $query->bindValue(":idUser", $controle['id'], PDO::PARAM_STR);
    $query->bindValue(":idArticle", $choix, PDO::PARAM_STR);
    $query->execute();
header("Location: article.php?article=$choix");

?>