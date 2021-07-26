<?php
require_once "vendor/autoload.php";
include "./src/includes/functions.php";
use Doctrine\Common\Collections\ArrayCollection;

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
            <h2 class="text-center">Collections</h2>
            <h3>Principe</h3>
            <p>
                Une collection est un objet itérables, comparable à un tableau mais avec plus de méthodes spécifiques.
            </p>
            <code>
                <pre>
                    use Doctrine\Common\Collections\ArrayCollection;
                    $collection = new ArrayCollection();
                    $collection->add("Rachid");
                </pre>
            </code>
            <?php
            /*
             si on veut avoir un autoload, on peut aussi appeler la collection installé via composer de cette facon
            $collection = new Doctrine\Common\Collections\ArrayCollection;
             */
            $collection = new ArrayCollection();
            $collection->add("Rachid");
            $collection->add("Ansaka");
            $collection->add("Nadjila");
            prePrint($collection);
            echo "<p>";
            echo  $collection->count(). "<br />";
            echo   $collection->current(). "<br />";
            echo   $collection->next(). "<br />";
            echo   $collection->next(). "<br />";
            echo   $collection->first(). "<br />";
            echo   $collection->last(). "<br />";
            echo "</p>";
            $collection->clear(). "<br />";
            $collection->add("Rachid");
            $collection->add("Ansaka");
            $collection->add("Nadjila");
            prePrint($collection);
            $contains = $collection->contains("Ansaka");
            if ($collection->contains("Rachid")){
                echo "Rachid est dans la collection <br />";
            }
            $collection->first();
            $nbItem = $collection->count();
            for($i = 0; $i < $nbItem;  $i++){
                echo $collection->key(). " => " .$collection->current(). "<br />";
                $collection->next();
            }
            $collection2 = new ArrayCollection([1,5,6,7,2,3,4]);
            $filteredCollection = $collection2->filter(function ($test){
                return $test > 3;
            });
            prePrint($filteredCollection);
            $collection3 = new ArrayCollection(["Arbre", "Barbe", "Rab", "Coco"]);
            $filteredCollection2 = $collection3->filter(function ($test){
               // return $test > 3;
                preg_match("/rb/", $test, $occurence, PREG_OFFSET_CAPTURE);
                return $occurence;
            });
            prePrint($filteredCollection2);

            ?>

        </article>

    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>