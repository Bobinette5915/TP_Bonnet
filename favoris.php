<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("connectToBDD.php");
include("requeteGenerale.php");
$titre = "Mes Favoris";
include("header.php");

$sql2 = "SELECT * FROM `user` WHERE `email`= :mail";
$query = $db->prepare($sql2);
$query->bindvalue(":mail",$_SESSION['mail-Utilisateur'],PDO::PARAM_STR);
$query->execute();
$controle = $query->fetch();

$sql5 = "SELECT * FROM `favoris` WHERE `id_user` = :moi";
$query = $db->prepare($sql5);
$query->bindvalue(":moi",$controle["id"],PDO::PARAM_STR);
$query->execute();
$controleFavoris = $query->fetchAll();

$ListeFavoris = [];

foreach($controleFavoris as $tab){
    array_push($ListeFavoris,$tab["id_article"]);
    
}

// print_r($ListeFavoris);


?>




        <!-- Header-->
<header  class="py-5 bg-dark">
    <div class="container px-4 px-lg-5 my-4">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Bienvenu <?php  echo $controle["prenom"]?></h1>
            <p class="lead fw-normal text-white-50 mb-0">Retrouvez ici vos articles préférés ..</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
<?php
foreach($ListeFavoris as $art){
    $sql8 = "SELECT * FROM `article` WHERE `id` = :id";
    $query = $db->prepare($sql8);
    $query->bindvalue(":id",$art,PDO::PARAM_STR);
    $query->execute();
    $artFav = $query->fetchAll();
    

foreach ($artFav as $article){
    echo ('<div class="col mb-5">
    <div class="card h-100">
        <img  height="300" class="card-img-top" src="'.$article['image'].'" alt="'.$article['nom'].'" />
        <div class="card-body p-4">
            <div class="text-center">
                <h5 class="fw-bolder">'.$article['nom'].'</h5>
                '.$article['prix'].' €
            </div>
        </div>
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="article.php?article='.$article['id'].'">Description</a></div>
        </div>
    </div>
</div>');
}}
?>



                </div>
            </div>
        </section>
<?php
include("footer.php");
?>