<?php
#requette pour recuperer tout les articles de la BDD
$sql = "SELECT * FROM `article`";
    $query = $db->prepare($sql);
    $query->execute();
    $articles = $query->fetchall();



?>