<?php
require_once "vendor/autoload.php";
include "./src/includes/functions.php";
use Game\Personnage;
use Game\Mage;
use Game\Arme;
use Game\Guerrier;

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
            <h2 class="text-center">Classes étendus </h2>
            <h3>Principes</h3>
            <p>
                une classe est etendu quand elle possède au moins une classe fille.
                La classe fille hérite automatiquement des attributs et des méthodes de la classe mère.
                L'avantage est que :
            </p>
            <ul>
                <li>Les méthodes de la classe mère peuvent etre changées</li>
                <li>La classe peut posséder ses propres méthodes</li>
            </ul>
            <h3>Simulation du jeu de role </h3><br>
            <?php
            /*
            $personnage = new Personnage("Potter", "Harry", 17, "Baguette");
            prePrint($personnage);
            $magicien = new Mage("Odin", "fff", 12, "Hache");
            prePrint($magicien);
            $morgenSten = new Arme("Morgensten", 2);
            prePrint($morgenSten);
            */
            $personnage = new Personnage("Harold", "", 21, new Arme("Morgenstern", 2));
            $personnage2 = new Personnage("Ansaka", "le fou", 21, new Arme("Dague", 1));
            $mage= new Mage("Rakkido", "el Loco", 32, new Arme("Baguette", 1));
            $personnage->frapper($personnage2);
            $personnage2->multi($personnage);
            $mage->bouleDeFeu($personnage);
            ?>
            <h3>Exercice</h3>
            <p>
                Créer la classe étendue Guerrier avec :
            </p>
            <ul>
                <li>+20 en vigueur+</li>
                <li>+2 en force</li>
                <li>le multi lance le coup "double frappe" (deux x frapper())</li>
            </ul>
            <?php
            $guerrier = new Guerrier("L'eclair", "Gilford", 30, new Arme("Epéé d'acier", 3));
            $guerrier->multi($personnage2);
            ?>
            <h3>Baston</h3> <br>
            <?php
            $barbare = new Guerrier("Le Barbare", "Conan", 20, new Arme("Epee", 2));
            $mageFou= new Mage("Ansaka", "el Loco", 3200, new Arme("Epee", 2));
            $oneIsDead = false;
            while (!$oneIsDead){
                $multi = rand(1,5);
                $oneIsDead = ($multi === 5) ? $barbare->multi($mageFou):$barbare->frapper($mageFou);
                if ($oneIsDead){
                    echo "<span class='alert alert-primary'>".$mageFou->getPrenom()." ".$mageFou->getNom(). " s'est fait tuer ! </span><br><br>";
                    exit();
                }
                $multi = rand(1,5);
                $oneIsDead = ($multi === 5) ? $mageFou->multi($barbare):$mageFou->frapper($barbare);
                if ($oneIsDead){
                    echo "<span class='alert alert-primary'>Résultat: ".$barbare->getPrenom()." ".$barbare->getNom(). " s'est fait tuer ! </span><br><br>";
                    exit();
                }

            }

            ?>

        </article>

    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>