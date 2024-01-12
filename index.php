<?php
session_start();
include("connectToBDD.php");
include("requeteGenerale.php");
$titre = "Mon Shooping en ligne";
include("header.php");



?>




        <!-- Header-->
<header  class="py-5 bg-dark">
    <div class="container px-4 px-lg-5 my-4">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">Trouve ton goodies</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
<?php
$articlesReverse = array_reverse($articles);
foreach ($articlesReverse as $article){
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
}
?>



                </div>
            </div>
        </section>
<?php
include("footer.php");
?>