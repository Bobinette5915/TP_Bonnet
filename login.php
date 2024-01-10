<?php

include("connectToBDD.php");
include("requeteGenerale.php");
$titre = "connexion";
include("header.php");


error_reporting(E_ALL);
ini_set('display_errors', 1);

#controle que le formulaire ne sois pas vide
if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    

    $sql2 = "SELECT * FROM `user` WHERE `email`= :mail";
    $query = $db->prepare($sql2);
    $query->bindvalue(":mail",$_POST["email"],PDO::PARAM_STR);
    $query->execute();
    $controle = $query->fetch();

    

    $hash = $_POST["password"];
    #controle du mdp avec le mdp haché de la bdd
    $controleMdp = password_verify($hash,$controle["password"]);
    var_dump ($controleMdp);

    #controle que le mail existe et que le mdp sois le bon
    if ($controleMdp !== false) {
        
        session_start();
        $_SESSION['mail-Utilisateur'] = $_POST["email"];
        header("location:index.php");
    }
}
?>

<section id="test" class="py-5" >
                <div class="container px-5">
                    <!-- Contact form-->
                    
                        <div class="formulaire " >
                            <h1>Dites nous tout sur vous</h1>
                            <form method="POST">
                                
                                <div class="form-control">
                                    <input type="text" name="email" required>
                                    <label for="email" >Email</label>
                                </div>
                                <div class="form-control">
                                    <input type="password" name="password" required>
                                    <label for="password" >Mot de Passe</label>
                                </div>
                                

                                <button type="submit" id="bouton" class="btn">connexion</button>

                                
                                
                            </form>
                            <p class="text">Pas encore de compte ? <a href="inscription.php">Inscrivez-Vous</a> </p>
                        </div>
                    </div>
                </div>
</section>



<?php
include("footer.php");
?>