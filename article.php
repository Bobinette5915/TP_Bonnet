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

#requete pour recuperer les infos de l'article selectionné dans la BDD
$sql = "SELECT * FROM `article` WHERE `id` = :idSelect";
    $query = $db->prepare($sql);
    $query->bindValue(":idSelect", $choix, PDO::PARAM_STR);
    $query->execute();
    $select = $query->fetch();

    $sql5 = "SELECT * FROM `favoris` WHERE `id_article` = :art AND `id_user` = :moi";
    $query = $db->prepare($sql5);
    $query->bindvalue(":moi",$controle["id"],PDO::PARAM_STR);
    $query->bindvalue(":art",$choix,PDO::PARAM_STR);
    $query->execute();
    $controleListe = $query->fetchAll();

$titre = $select['nom'];
include("header.php");

    


?>



        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $select['image']?>" alt="<?php echo $select['nom']?>" /></div>
                    <div class="col-md-6">
                        
                        <h1 class="display-5 fw-bolder"><?php echo $select['nom']?></h1>
                        <div class="fs-5 mb-5">
                            
                            <span><?php echo $select['prix']?> €</span>
                        </div>
                        <p class="lead"><?php echo $select['description']?></p>

                        <div class="d-flex">
                        <?php 
                        
                        
                            if (empty($controleListe) && $_SESSION['mail-Utilisateur'] !== null ) { 
                                    
                                ?>
                            <form  action='fav.php?article=<?php echo $choix?>' method="post">
                            
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                            <i class="bi bi-star me-1"></i>    
                            Mettre en Favoris
                            </button>
                            
                                <?php }
                                
                                
                                    
                                
                            elseif ($_SESSION['mail-Utilisateur'] !== null){ ?>
                                <form  action='suppr.php?article=<?php echo $choix?>' method="post">

                                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                    <i class="bi bi-star-fill"></i>    Retirer des Favoris
                                    </button>
                            
                                <?php } 
                                else {
                                    echo ("<a href='login.php'><div class='alert alert-primary col-md-5' role='alert'>
                                    Connectez vous pour mettre cet article dans vos favoris</div></a> ");
                                }?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Produits qui prourait vous interesser</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    <?php
                    $nombreTotalElements = count($articles);
                    for ($i = $nombreTotalElements - 1; $i >= $nombreTotalElements - 4; $i--) {

                        echo ('<div class="col mb-5">
                        <div class="card h-100">
                            <img  height="300" class="card-img-top" src="'.$articles[$i]['image'].'" alt="'.$articles[$i]['nom'].'" />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">'.$articles[$i]['nom'].'</h5>
                                    '.$articles[$i]['prix'].'€
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="article.php?article='.$articles[$i]['id'].'">Voir Plus</a></div>
                            </div>
                        </div>
                    </div>');
                    }

                    ?>

                </div>
            </div>
        </section>

<?php
include("footer.php");
?>