<?php

include("connectToBDD.php");
include("requeteGenerale.php");
$titre = "Inscription";
include("header.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

#controle que le formulaire ne sois pas vide
if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    
        $sql2 = "SELECT * FROM `user` WHERE `email`= :mail";
        $query = $db->prepare($sql2);
        $query->bindvalue(":mail",$_POST["email"],PDO::PARAM_STR);
        $query->execute();
        $controle = $query->fetch();
    
        #controle que le mail n'existe pas
        if ($controle === false) {
    
            #controle de mot de passe
            if (($_POST['password']) === ($_POST['passwordConfirm'])) {
                #hachage du mot de passe
                $InMdp = password_hash ($_POST["password"],PASSWORD_DEFAULT);
                
    
                #ajout dans la bdd
                $sql3="INSERT INTO `user`( `nom`, `prenom`, `email`, `password`) VALUES (:inscriptionNom, :inscriptionPrenom, :inscriptionEmail, :inscriptionMdp)";
                $query = $db->prepare($sql3);
                $query->bindvalue(":inscriptionNom",$_POST["nom"],PDO::PARAM_STR);
                $query->bindvalue(":inscriptionPrenom",$_POST["prenom"],PDO::PARAM_STR);
                $query->bindvalue(":inscriptionEmail",$_POST["email"],PDO::PARAM_STR);
                $query->bindvalue(":inscriptionMdp",$InMdp,PDO::PARAM_STR);
                $query->execute();
                session_start();
                $_SESSION['mail-Utilisateur'] = $_POST["email"];
                header("location:index.php");
            } 
            
                    
                }
        }
    
        





?>
<section id="test" class="py-5" >
                <div class="container px-5">
                    <!-- Contact form-->
                    
                        <div class="formulaire " >
                            <h1>Dites nous tout sur vous</h1>
                            <form method="POST">
                            <?php
                                            if ((($_POST['password']) !== ($_POST['passwordConfirm'])) ){
                                                echo ('<div class="alert alert-danger" role="alert">
                                                Attention, les mots de passes ne sont pas identiques.</div>');
                                            }

                                            if ($controle !== false && !empty($_POST["email"])){
                                                echo ("<div class='alert alert-danger' role='alert'>
                                                Il semblerait qu'un compte existe deja pour cette adresse mail, <br>
                                                Essayez de vous <a href='login.php'> Connectez ici ?</a></div>");
                                            }
                                            
                                            ?>
                                <div class="form-control">
                                    <input type="text" name="nom" required>
                                    <label for="nom" >Nom</label>
                                </div>
                                <div class="form-control">
                                    <input type="text" name="prenom" required>
                                    <label for="prenom" >Prenom</label>
                                </div>
                                <div class="form-control">
                                    <input type="text" name="email" required>
                                    <label for="email" >Email</label>
                                </div>
                                <div class="form-control">
                                    <input type="password" name="password" required>
                                    <label for="password" >MDP</label>
                                </div>
                                <div class="form-control">
                                    <input type="password" name="passwordConfirm" required>
                                    <label for="passwordConfirm" >Confirmer le MDP</label>
                                </div>
                                
                                <button type="submit" id="bouton" class="btn">Inscription</button>

                                
                                
                            </form>
                            <p class="text">Deja Inscrit ? <a href="login.php">Connectez-Vous</a> </p>
                        </div>
                    </div>
                </div>
</section>



<?php
include("footer.php");
?>