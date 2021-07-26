<?php
require_once "vendor/autoload.php";
include "./src/includes/functions.php";
use Factory\MonException;

 function multiplier($x, $y){
     if(!is_numeric($x) || !is_numeric($y)){
         throw new Exception("Les deux valeurs doivent etre numériques");
     }
     return $x * $y;

function multiplier2($x, $y){
    if(!is_numeric($x) || !is_numeric($y)){
        throw new Exception("Les deux valeurs doivent etre numériques");
    }
    if(func_num_args() != 2){
        throw new Exception("deux valeurs doivent etre renseignées");}
}
    return $x * $y;
 }

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
            <h2 class="text-center">Les exceptions PHP</h2>
            <h3>Exceptions natives en php</h3>
            <p>
                Exception est une classe Php, pour générer une exception dans un programme il faut la declarer dans la fonction à tester
            </p>

            <?php

            echo multiplier(20,12)."<br>";
          //  echo multiplier(20,"text")."<br>";
            echo multiplier(20,2)."<br>"


            ?>

            <p>
                Si on ne fait que lancer l'exception mais qu'on ne la test pas dans un try catch, les instructions en dehors
                du try-catch ne s'executent pas, donc le script s'arrete.
            </p>
            <?php
            try {
                echo multiplier(20,12)."<br>";
                echo multiplier(20,"text")."<br>";
                echo multiplier(20,2)."<br>" ;
            }catch (Exception $e){
                echo "Une exception à été lancéé:
                      <br>Message: ". $e->getMessage().
                      "<br>Code:". $e->getCode().
                      "<br>File:". $e->getFile().
                      "<br>Trace:". $e->getTraceAsString().
                      "<br>Previous:". $e->getPrevious();
            }
            ?>
            <p>
                Contrairement à l'exemple précedent, les instruction hors try-catch se sont
                excecuté normalement.
            </p>
            <h3>Créer sa propre exceptions</h3>
            <p>
                Exceptions etant une classe, il est donc possible de créer sa propre classe d'exceptions étendus d'Exception.
                En Surchargant les méthodes, on peut filter ou ne demander que ces propres exceptions.
                Par exemple, n'avoir que <code>getMessage()</code> au retour d'une exception.
            </p>
            <?php
            /*
            try {
                echo multiplier2(20,"text")."<br>";
            }catch (Exception $e){
                echo $e. "<br>";
            }catch (MonException $e){
                echo $e. "<br>";
            }

            try {
                echo multiplier2(20,10, 9)."<br>";
            }catch (Exception $e){
                echo $e. "<br>";
            }catch (MonException $e){
                echo $e. "<br>";
            }
            */
            ?>

        </article>

        <article class="col-md-12">
            <h2 class="text-center">Les exceptions PDO</h2>
            <p>
                PDO possède ses propres exception mais pour pouvoir les utiliser il faut les installer à l'aide de composer
            </p>
            <p>
                On va utiliser PDOException pour les exception PDO:
            </p>
            <code>
                <pre>
                    composer require php-kit/ext-pdo
                </pre>
            </code>
            <h3>Tester la connexion</h3>
            <?php

            try {
                $bdd = new PDO("mysql:host=localhost;dbname=2021-07-19-php-poo;charset=utf8",
                    "admin-poo",
                    "admin",
                     array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            } catch (PDOException $e) {
                echo "La connexion à échoué <br>".
                    "Raison:". "<br>Code Erreur: ". $e->getCode()."<br>".
                    "Message: ". $e->getMessage(). "<br>à la ligne: ". $e->getLine()."<br>";
            } finally {
                echo "tentative de connexion à la bdd terminée.";
            }
            prePrint($bdd);

            ?>
        </article>


    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>