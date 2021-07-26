<?php
require_once "vendor/autoload.php";
include "./src/includes/functions.php";
use Factory\CharacterOriginFactory;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
    <?php
    include "./src/includes/headCalls.php";
    ?>
</head>
<body>
<?php
include "./src/includes/navigation.php";
?>
<main class="container">
    <section class="row">
        <article class="col-md-12">
            <h2 class="text-center">Les factories PHP</h2>
            <p>
                Permet d'instancier les classes nécessaires au fonctionnement d'une application
            </p>
            <?php
            // perso 1
            $originPerso1 = "La comte";
            $persoOrigin1 = CharacterOriginFactory::createOrigin($originPerso1);
            prePrint($persoOrigin1->origine());
            prePrint($persoOrigin1->criDeGuerre());
            // perso 2
            $originPerso2 = "la Mordor";
            $persoOrigin2 = CharacterOriginFactory::createOrigin($originPerso2);
            prePrint($persoOrigin2->origine());
            prePrint($persoOrigin2->criDeGuerre());
            // perso 3
            $originPerso3 = "Rivendel";
            $persoOrigin3 = CharacterOriginFactory::createOrigin($originPerso3);
            prePrint($persoOrigin3->origine());
            prePrint($persoOrigin3->criDeGuerre());
            ?>


        </article>


    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>
