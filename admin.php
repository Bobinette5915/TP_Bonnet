<?php

include("connectToBDD.php");
include("requeteGenerale.php");
$titre = "Inscription";
include("header.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

#controle que le formulaire ne sois pas vide
if (!empty($_POST["nom"]) && !empty($_POST["description"]) && !empty($_POST["url"]) && !empty($_POST["prix"])) {
    
        
    
        #ajout dans la bdd
        $sql3="INSERT INTO `article`( `nom`, `description`, `image`, `prix`) VALUES (:nom, :descript, :urlimage, :prix)";
        $query = $db->prepare($sql3);
        $query->bindvalue(":nom",$_POST["nom"],PDO::PARAM_STR);
        $query->bindvalue(":descript",$_POST["description"],PDO::PARAM_STR);
        $query->bindvalue(":urlimage",$_POST["url"],PDO::PARAM_STR);
        $query->bindvalue(":prix",$_POST["prix"],PDO::PARAM_STR);
        $query->execute();
        session_start();
        
        
    } 







?>
<section id="test" class="py-5" >
                <div class="container px-5">
                    <!-- Contact form-->
                    
                        <div class="formulaire " >
                            <h1>Ajouter un nouvel article</h1>


                            <?php
if (!empty($_POST["nom"]) && !empty($_POST["description"]) && !empty($_POST["url"]) && !empty($_POST["prix"])) {
    
        
    
    #ajout dans la bdd
    $sql3="INSERT INTO `article`( `nom`, `description`, `image`, `prix`) VALUES (:nom, :descript, :urlimage, :prix)";
    $query = $db->prepare($sql3);
    $query->bindvalue(":nom",$_POST["nom"],PDO::PARAM_STR);
    $query->bindvalue(":descript",$_POST["description"],PDO::PARAM_STR);
    $query->bindvalue(":urlimage",$_POST["url"],PDO::PARAM_STR);
    $query->bindvalue(":prix",$_POST["prix"],PDO::PARAM_STR);
    $query->execute();
    session_start();
    echo ("<div class='alert alert-success' role='alert'>
                                                Votre article a bien été enregistré, <br>
                                                Vous pouves des a present le retrouver <a href='index.php'> ici</a></div>");
    
} 
                            ?>
                            <form method="POST">
                            
                                <div class="form-control">
                                    <input type="text" name="nom" required>
                                    <label for="nom" >Nom</label>
                                </div>
                                <div class="form-control">
                                    <input type="text" name="description" required>
                                    <label for="description" >description</label>
                                </div>
                                <div class="form-control">
                                    <input type="textaera" name="url" required>
                                    <label for="url" >URL de l'image</label>
                                </div>
                                <div class="form-control">
                                    <input type="text" name="prix" required>
                                    <label for="prix" >prix HT</label>
                                </div>
                                
                                
                                <button type="submit" id="bouton" class="btn">Ajouter</button>

                                
                                
                            </form>
                        </div>
                    </div>
                </div>
</section>



<?php
include("footer.php");
?>