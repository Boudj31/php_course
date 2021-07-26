<?php
require_once "vendor/autoload.php";
include "./src/includes/functions.php";
use Doctrine\Common\Collections\ArrayCollection;
try {
    $bdd = new PDO("mysql:host=localhost;dbname=2021-07-19-php-poo;charset=utf8",
        "admin-poo",
        "admin",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

} catch (PDOException $e) {
    echo "La connexion à échoué <br>".
        "Raison:". "<br>Code Erreur: ". $e->getCode()."<br>".
        "Message: ". $e->getMessage(). "<br>à la ligne: ". $e->getLine()."<br>";
}
$messagePDO = "";
//var_dump($_COOKIE);
if (isset($_COOKIE["jeuSupp"]) && $_COOKIE["jeuSupp"] !== "") {
    $messagePDO = "<div class=\"alert alert-success alert-dismissible fade show m-2\" role=\"alert\">" .
        "Le jeu " . $_COOKIE["jeuSupp"] . " a été supprimé" .
        "<button type=\"button\" class=\"btn-close\" " .
        "data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>" .
        "</div>";
    setcookie("jeuSupp", "", time() - 3600);
}
if (isset($_COOKIE["jeuMod"]) && $_COOKIE["jeuMod"] !== "") {
    $messagePDO .= "<div class=\"alert alert-success alert-dismissible fade show m-2\" role=\"alert\">" .
        "Le jeu " . $_COOKIE["jeuMod"] . " a été Modifié" .
        "<button type=\"button\" class=\"btn-close\" " .
        "data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>" .
        "</div>";
    setcookie("jeuMod", "", time() - 3600);
}

$keys = "";
$values = "";
$tabChamps["nom"] = "";
$tabChamps["possesseur"] = "";
$tabChamps["console"] = "";
$tabChamps["prix"] = "";
$tabChamps["nbre_joueurs_max"] = "";
$tabChamps["commentaires"] = "";
$errorMessage = "";
$errorValues = false;
if(isset($_POST["ajouter"]) && $_POST["ajouter"] === "ajoutJeu"){
    $tabChamps["nom"] =  $_POST["nom"];
    $tabChamps["possesseur"] = $_POST["possesseur"];
    $tabChamps["console"] = $_POST["console"];
    $tabChamps["prix"] = (!empty($_POST["prix"])) ? $_POST["prix"] : 0;
    $tabChamps["nbre_joueurs_max"] = (!empty($_POST["nbre_joueurs_max"])) ? $_POST["nbre_joueurs_max"] : 0;

    $errorValues = ( (!is_numeric( $tabChamps["prix"]) || !is_numeric($tabChamps["nbre_joueurs_max"])) )? true: false;

    $tabChamps["commentaires"] = (isset($_POST["commentaires"])) ? $_POST["commentaires"] : "";
    if($tabChamps["nom"] !== "" && $tabChamps["possesseur"] !== "" && $tabChamps["console"] !== "" && !$errorValues ){
        prePrint($tabChamps);
        $i = 0;
        foreach($tabChamps as $key => $value){
            if($i !== 0 && $i < count($tabChamps) ){
                $keys .= ",";
                $values .= ",";
            }
            $i++;
            $keys .= $key;
            $values .= ":".$key;
        }
        $sql = "INSERT INTO `jeux_video` (". $keys.") VALUES (". $values.") ;";
        prePrint($sql);
        $req = $bdd->prepare($sql);
        $req->execute($tabChamps);
        header('Location: pdo.php');
        exit;

    }else{
        $errorMessage = "<div class=\"alert alert-warning\">".
            "Les champs \"nom\", \"possesseur\", \"console\" sont obligatoire<br />".
            "Les champs \"prix\", \"nb joueurs max\" doivent être numériques<br />".
            "</div>";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
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
    <?php echo $messagePDO ?>
    <section class="row">
        <article class="col-md-4">
            <h2 class="text-center">PDO</h2>
            <h3>Principes</h3>
            <p>
                PDO: "Php Data Object"
                C'est un moyen de se connecter et manipuler une base de données, L'avantage est qu'il peut manipuler des bdd d'origine
               différentes (MySql, Oracle, PostGrE, MariaDb...)
                En utilisant toujours les mêmes méthodes;
            </p>
            <h3>Créer l'instance PDO: connexion à la BDD</h3>
            <p>
                Lors de la creation de l'instance, il vous faut :
            </p>
            <ul>
                <li>L'hote: ici localhost</li>
                <li>Le nom de la BDD: 2021-07-19-php-poo</li>
                <li>Le charset utilisé dans la BDD: utf8</li>
                <li>L'identifiant de l'utilisateur de la BDD: 'admin-poo' </li>
                <li>Le mot de passe de l'utilisateur: 'admin'</li>
            </ul>
            <code>
                <pre>
                    $bdd = new PDO("mysql:host=localhost;dbname=2021-07-22-php-poo;charset=utf8", "admin-poo", "admin");
                </pre>
            </code>
            <?php

            prePrint($bdd);

            ?>


        </article>
        <article class="col-md-8">
            <h2>Requeter avec PDO</h2>
            <p>
                Il est possible de faire des requêtes dirextes en utilisant la méthodes PDO query();
            </p>
            <code>
                <pre>
                    $response = $bdd->query("SELECT * FROM `jeux_video` ORDER BY `jeux_video`.`nom`; ");
                </pre>
            </code>
            <?php
            try {
                $response = $bdd->query("SELECT * FROM `jeux_video` ORDER BY `jeux_video`.`nom`; ")
                or die(prePrint($bdd->errorInfo()));
                prePrint($response);
            }catch (PDOException $e){
                echo $e->getMessage();
            }
            ?>
            <p>
                $response contient les enregistements retourné par la methode query()(qui excecute la requête)
                On ne peut pas expoloiter $response directement, il va falloir itérer dans les enregistrements qu'elle contient
                en utilisant des méthodes
                $response est une instance d'objet, lié à PDO et utilise des méthodes pour gérer les enregistrements récupérés,
            </p>
            <p>
                la methode fetch() va récuperer dans un tableau associatif les données d'un enregistrement contenu dans response et va deplacer
                le pointeur vers l'enregistrement suivant. Il suffira de refaire un fetch pour récuperer le suiver etc..
            </p>
            <code>
                <pre>
                    $unEnregistrement = $response->fetch();
                </pre>
            </code>
            <?php
            $unEnregistrement = $response->fetch(PDO::FETCH_ASSOC);
            prePrint($unEnregistrement);
            prePrint($unEnregistrement["nom"]);

            ?>
            <p>
                Une fois qu'on a récupéré les enregistrements, il faut fermer le curseur.
            </p>
        </article>
    </section>
    <section class="row">
        <article class="col-md-12">
            <h2>Exploiter les résultats: mini exo</h2>
            <p>
                Relancer la requete précedente, afficher les resultat dans un tableau HTML
            </p>
            <div style="max-height:300px; overflow-y:auto">
                <table class="table table-secondary">
                    <thead>
                    <tr>
                        <th>Jeu</th>
                        <th>Possesseur</th>
                        <th>Prix</th>
                        <th>Console</th>
                        <th>Nb joueurs Max</th>
                        <th>Commentaires</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //requête et affichage des données
                    $response->execute();
                    $cpt = 0;
                    $maxCount = $response->rowCount();
                    $donnees = new ArrayCollection();
                    while($data = $response->fetch(PDO::FETCH_ASSOC)){
                        $donnees->add($data);
                        ?>
                        <tr>
                            <td><?php echo $data["nom"] ?></td>
                            <td><?php echo $data["possesseur"] ?></td>
                            <td><?php echo $data["prix"] ?> &euro;</td>
                            <td><?php echo $data["console"] ?></td>
                            <td><?php echo $data["nbre_joueurs_max"] ?></td>
                            <td><?php echo $data["commentaires"] ?></td>
                            <td>
                                <a href="./traitement.php?action=suppr&idjeu=<?=$data["ID"]?>">X</a>
                                <br>
                                <a href="./traitement.php?action=mod&idjeu=<?=$data["ID"]?>">O</a>
                                <br>
                            </td>

                        </tr>
                        <?php
                        $cpt++;
                        if($cpt %5 === 0 && $cpt !== $maxCount){
                            ?>
                            <tr>
                                <th>Jeu</th>
                                <th>Possesseur</th>
                                <th>Prix</th>
                                <th>Console</th>
                                <th>Nb joueurs Max</th>
                                <th>Commentaires</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                        }
                    }
                    $response->closeCursor();
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Jeu</th>
                        <th>Possesseur</th>
                        <th>Prix</th>
                        <th>Console</th>
                        <th>Nb joueurs Max</th>
                        <th>Commentaires</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <h2>Utiliser des données dans une collection</h2>
            <!--
            <div style="max-height: 300px; overflow-y: auto;">
                <p>
                </p>
                <?php
                 //var_dump($donnee);
                foreach ($donnee as $jeu){
                    prePrint($jeu["nom"]);
                }
                ?>
            </div>
            -->

        </article>
        <article class="col-md-6">
            <h2>Voir les erreurs</h2>
            <p>
                lors de la création de l'objet de type PDO, en argument supplémentaire on peut ajouter
                des options qui sont à null par défaut dans la classe PDO de deux manière :
            </p>
            <code>
                        <pre>
$bdd = new PDO("mysql:host=localhost;dbname=2021-07-06-php-poo;charset=utf8",
"admin-poo", "admin");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        </pre>
            </code>
            <p>
                ou directement depuis la création de l'objet :
            </p>
            <code>
                        <pre>
$bdd = new PDO("mysql:host=localhost;dbname=2021-07-06-php-poo;charset=utf8",
"admin-poo", "admin", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
                        </pre>
            </code>
            <p>
                Les options indiqués permettront d'avoir des erreurs sur la requête et la connexion
                plus "humainement" lisibles.
            </p>
            <p>
                On peut aussi améliorer l'affichage des erreur lors de la requête :
            </p>
            <code>
                        <pre>
$response = $bdd->query("SELECT * FROM `jeux_video` ORDER BY `jeux_video`.`nom`;")
or die(preprint($bdd->errorInfo()));
                        </pre>
            </code>
        </article>
        <article class="col-md-6">
            <h2>Manipulation de la BDD</h2>
            <p>
                Ajout, modification et la suppression des données
            </p>
            <h3>Ajout de données</h3>
            <?php

            echo $errorMessage;
            ?>
            <form method="post">
                <!--
                [ID] => 21              [nom] => Actua Soccer 3
                [possesseur] => Patrick [console] => PS
                [prix] => 30            [nbre_joueurs_max] => 2
                [commentaires] => Un jeu de foot assez bof ...
                [date_ajout] => 2021-07-22 09:14:14
                [date_modif] => 2021-07-22 09:14:14
                -->
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control"
                           name="nom" id="nom" value="<?php echo $tabChamps["nom"] ?>" />
                </div>

                <div class="form-group">
                    <label>Possesseur</label>
                    <input type="text" class="form-control"
                           name="possesseur" id="possesseur"
                           value="<?php echo $tabChamps["possesseur"] ?>" />
                </div>
                <div class="form-group">
                    <label>Console</label>
                    <input type="text" class="form-control"
                           name="console" id="console" value="<?php echo $tabChamps["console"] ?>" />
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="text" class="form-control"
                           name="prix" id="prix" value="<?php echo $tabChamps["prix"] ?>" />
                </div>
                <div class="form-group">
                    <label>Nb joueurs max</label>
                    <input type="text" class="form-control"
                           name="nbre_joueurs_max" id="nbre_joueurs_max" value="<?php echo $tabChamps["nbre_joueurs_max"] ?>" />
                </div>
                <div class="form-group">
                    <label>Commentaires</label>
                    <textarea class="form-control"
                              name="commentaires" id="commentaires"><?php echo $tabChamps["commentaires"] ?></textarea>
                </div>

                <div class="form-group mt-1">
                    <button type="submit" class="btn btn-outline-primary"
                            name="ajouter" value="ajoutJeu">
                        Ajouter le jeu
                    </button>
                </div>
            </form>
        </article>

    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>
