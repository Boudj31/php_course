<?php
include "./src/includes/functions.php";
require_once "vendor/autoload.php";


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2>Preparation TOSA</h2>
            <p>
                Rédiez le code de la fonction isMultipleOf qui prend un paramètre $number.
                Celle-ci devra retourner :
            </p>
            <ul>
                <li>0 si $number n'est ni un multiple de 2 ni un multiple de 5</li>
                <li>1 si $number est un multiple de 2 </li>
                <li>2 si $number est un multiple de 5</li>
                <li>3 si $number est un multiple de 2 et de 5</li>
            </ul>
            <?php
            function isMultipleOf($number){
                if($number % 2 == 0 && $number % 5 == 0){
                    return 3;
                }elseif ($number % 2 == 0){
                    return 1;
                }elseif ($number % 5 == 0){
                    return 2;
                }else {
                    return 0;
                }

                //écrire au dessus de cette ligne
            }
            echo 'isMultipleOf(2) : '.isMultipleOf(2).'<br />'; //la fonction doit retourner 1
            echo 'isMultipleOf(5) : '.isMultipleOf(5).'<br />'; //la fonction doit retourner 2
            echo 'isMultipleOf(10) : '.isMultipleOf(10).'<br />'; //la fonction doit retourner 3
            echo 'isMultipleOf(7) : '.isMultipleOf(7).'<br />'; //la fonction doit retourner 0
            ?>
        </article>
        <article class="col-md-12">
            <h2>Contrôler une date</h2>
            <p>
                Rédigez le code de la fonction validateDate qui reçoit en argument le paramètre $chaine.
                La fonction vérifie si la date reçue en paramètre est valide par
                rapport au format suivant : Y-m-d
                Elle devra retourner :
            </p>
            <ul>
                <li>true si la date est valide</li>
                <li>false si la date est invalide</li>
            </ul>
            <p>
                Information concernant le format :
            </p>
            <ul>
                <li>Y représente l'année sur 4 chiffres</li>
                <li>m représente le mois sur 2 chiffres</li>
                <li>d représente le jour sur 2 chiffres</li>
            </ul>
            <?php
            function validateDate($date)
            {
                date_default_timezone_set('Europe/London');
                //----------NE MODIFIEZ PAS LE CODE AU DESSUS DE CETTE LIGNE, IL SERA REINITIALISE LORS DE l'EXECUTION----------
              $dt =  DateTime::createFromFormat("Y-m-d", $date);
                return $dt && $dt->format("Y-m-d") == $date;

                //----------NE MODIFIEZ PAS LE CODE EN DESSOUS DE CETTE LIGNE, IL SERA REINITIALISE LORS DE l'EXECUTION----------
            }
            echo 'validateDate("2016-01-01") : '.validateDate("2016-01-01").'<br />'; // La fonction retourne "true" car cela correspond à une date valide
            echo 'validateDate("2016-20-05") : '.validateDate("2016-20-05").'<br />'; // La fonction retourne "false" car cela correspond à une date invalide par rapport au mois de l'année numéro 20
            ?>
        </article>
        <?php
        function addExlamation($tab = [], $chaine= ""){
            
          return  $newTab = $tab.implode("'!'",$chaine);
        }
       echo addExlamation(['foo','bar','toto','foo'], 'foo');

        ?>
    </section>
</main>
</body>

</html>