<?php
$sql2 = "SELECT * FROM `user` WHERE `email`= :mail";
$query = $db->prepare($sql2);
$query->bindvalue(":mail",$_SESSION['mail-Utilisateur'],PDO::PARAM_STR);
$query->execute();
$controle = $query->fetch();



if ($controle === false) {
$nbFav = "0";
} else {
#recuperation des favoris de l'utilisateurs
$sql5 = "SELECT * FROM `favoris` WHERE `id_user` = :moi";
$query = $db->prepare($sql5);
$query->bindvalue(":moi",$controle["id"],PDO::PARAM_STR);
$query->execute();
$controleFavoris = $query->fetchAll();

$nbFav = count($controleFavoris);
}
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $titre;?></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->

        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/form.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        <nav style="background: linear-gradient(25deg, #8600b3 50%, #cc33ff 50%); height:100px;" class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container px-5 px-lg-5">
                <a class="navbar-brand" href="index.php">Mon Shooping en linge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Accueil</a></a></li>
                        <?php if (($_SESSION["mail-Utilisateur"]===null)){
                                echo('<li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>');
                            }
                            ?>
                        
                        <?php if (($_SESSION["mail-Utilisateur"]!==null)){
                                echo('<li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>');
                            }
                            ?>
                        
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Boutique</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">Tous les Produits</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">En Vedettes</a></li>
                                <li><a class="dropdown-item" href="#!">Nouveautées</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <div class="d-flex">
                        <a href="favoris.php"><button class="btn btn-outline-dark" >
                            <i class="bi bi-star me-1"></i>
                            Mes favoris
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $nbFav?></span>
                        </button></a>
                    </div>
                </div>
            </div>
        </nav>








