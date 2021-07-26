<?php
include "./src/includes/functions.php";
require_once "vendor/autoload.php";

try{
    $bdd = new PDO("mysql:host=localhost;dbname=2021-07-19-php-poo;charset=utf8",
        "admin-poo",
        "admin",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
}catch(Exception $e){
    die("Erreur connexion : " . $e->getMessage());
}

//traitement depuis la page de traitement
if(isset($_POST["supJeu"]) && $_POST["supJeu"] === "okSup"){
    $idJeu = $_POST["idJeuSupp"];
    setcookie("jeuSupp", $_POST["nameJeuSup"], time()+3600, "2021-07-19-php-poo");
    $sql = "DELETE FROM `jeux_video` WHERE `ID` = :id ;";
    //echo $sql;
    $req = $bdd->prepare($sql);
    $req->execute(["id" => $idJeu]) or die(preprint($bdd->errorInfo()));
    header("location:./pdo.php");
    exit;
}

$errorMessage = "";

if(isset($_POST["modJeu"]) && $_POST["modJeu"] === "okMod"){
    $idJeu = $_POST["idJeuMod"];
    $keys = "";
    $values = "";
    $tabChamps["ID"] = $idJeu;
    $tabChamps["nom"] =  $_POST["nom"];
    $tabChamps["possesseur"] = $_POST["possesseur"];
    $tabChamps["console"] = $_POST["console"];
    $tabChamps["prix"] = (!empty($_POST["prix"])) ? $_POST["prix"] : 0;
    $tabChamps["nbre_joueurs_max"] = (!empty($_POST["nbre_joueurs_max"])) ? $_POST["nbre_joueurs_max"] : 0;

    $errorValues = false;
    $errorValues = ( (!is_numeric( $tabChamps["prix"]) || !is_numeric($tabChamps["nbre_joueurs_max"])) )? true: false;

    $tabChamps["commentaires"] = (isset($_POST["commentaires"])) ? $_POST["commentaires"] : "";


    if($tabChamps["nom"] !== "" && $tabChamps["possesseur"] !== "" && $tabChamps["console"] !== "" && !$errorValues ){
        //setcookie("jeuMod", $_POST["nameJeuMod"], time()+3600, "2021-07-19-php-poo");
        $sql = "UPDATE `jeux_video` SET ".
            " `nom` = :nom, ".
            " `possesseur` = :possesseur, ".
            " `console` = :console, ".
            " `prix` = :prix, ".
            " `nbre_joueurs_max` = :nbre_joueurs_max, ".
            " `commentaires` = :commentaires ".
            "  WHERE `ID` = :ID ;";
        //echo $sql;

        $req = $bdd->prepare($sql);
        $req->execute($tabChamps) or die(preprint($bdd->errorInfo()));
        header("location:./pdo.php");
        exit;
    }else{
        $errorMessage = "<div class=\"alert alert-warning\">".
            "Les champs \"nom\", \"possesseur\", \"console\" sont obligatoire<br />".
            "Les champs \"prix\", \"nb joueurs max\" doivent être numériques<br />".
            "</div>";
    }


}

$action = "";
$action = (isset($_GET["action"]))? $_GET["action"] : "404";

switch($action){
    case "suppr":
    case "mod":
        $idJeu = (isset($_GET["idjeu"]) && is_numeric($_GET["idjeu"]))? $_GET["idjeu"] : "0";
        if($idJeu == "0"){
            //var_dump($idJeu);
            header("location:./pdo.php");
            exit;
        }
        //exercice : traiter la suppression du jeu
        //on demande la confirmation de la suppression
        //le bouton OK de la confirmation recharge la page (formulaire)
        // c'est seulement à la confirmation qu'on supprime le jeu
        //l'annulation redirige vers pdo.php
        //requête sql suppression :
        // DELETE FROM `jeux_video` WHERE `ID` = 55;
        //une fois la suppression faîte, rediriger vers la page pdo.
        //optionnel 1 : faîtes en sorte d'avoir un message qui prévienne sur la page PDO que la suppression est OK
        //optionnel 2 : faîtes en sorte d'avoir un message qui prévienne sur la page PDO que la suppression est annulée
        //optionnel 3 : le message est "effaçable" via un clique sur un bouton dessus (pas en php)
        $sql = "SELECT * FROM `jeux_video` WHERE `ID` = :id;";
        //echo $sql;
        $req = $bdd->prepare($sql);
        $req->execute(["id" => $idJeu]) or die(preprint($bdd->errorInfo()));
        if($req->rowCount() > 0){
            //echo "OK : ".$req->rowCount(). " enregistrement(s)";
            $donnees = $req->fetch();
            $nom = $donnees["nom"];
            $possesseur = $donnees["possesseur"];
            $console = $donnees["console"];
            $prix = $donnees["prix"];
            $nbre_joueurs_max = $donnees["nbre_joueurs_max"];
            $commentaires = $donnees["commentaires"];
            $req->closeCursor();
        }else{
            $action = "Erreur action";
        }

        break;
    case "404":
    default:
        header("location:./pdo.php");
        exit;
}

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
    <?php

    ?>
    <section class="row">
        <article class="col-md-12 text-center">

            <?php
            switch($action){
                case "suppr":
                    //var_dump($_COOKIE);
                    ?>
                    <h2>Confirmation de suppression ?</h2>
                    <form method="post" action="./traitement.php">
                        <article class="col-lg-4 offset-4 card mt-3 mb-3">
                            <input type="hidden" name="idJeuSupp" value="<?php echo $idJeu ?>" />
                            <input type="hidden" name="nameJeuSup" value="<?php echo $nom ?>" />
                            <header class="card-header">
                                Suppression du jeu : <?php echo $nom ?>
                            </header>
                            <main class="card-body">
                                Possesseur : <?php echo $possesseur ?><br />
                                Console : <?php echo $console ?><br />
                                Prix : <?php echo $prix ?><br />
                                Nb Joueurs max : <?php echo $nbre_joueurs_max ?><br />
                                Commentaire : <br />
                                <p>
                                    <?php echo $commentaires ?>
                                </p>
                            </main>
                            <footer class="card-footer d-flex justify-content-between">
                                <button type="submit" value="okSup" name="supJeu" class="btn btn-primary">SUPPRIMER</button>
                                <a href="./pdo.php" class="btn btn-warning">ANNULER SUPPRESSION</a>
                            </footer>
                        </article>
                    </form>
                    <?php
                    break;
                case "mod":
                    ?>
                    <h2>Modification</h2>
                    <form method="post">
                        <?php echo $errorMessage ?>
                        <article class="col-lg-6 offset-3 card mt-3 mb-3">
                            <!--
                            [ID] => 21              [nom] => Actua Soccer 3
                            [possesseur] => Patrick [console] => PS
                            [prix] => 30            [nbre_joueurs_max] => 2
                            [commentaires] => Un jeu de foot assez bof ...
                            [date_ajout] => 2021-07-22 09:14:14
                            [date_modif] => 2021-07-22 09:14:14
                            -->
                            <input type="hidden" name="idJeuMod" value="<?php echo $idJeu ?>" />
                            <input type="hidden" name="nameJeuMod" value="<?php echo $nom ?>" />
                            <header class="card-header">
                                Modification du jeu : <?php echo $nom ?>
                            </header>
                            <main class="card-body">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control"
                                           name="nom" id="nom" value="<?php echo $nom ?>" />
                                </div>

                                <div class="form-group">
                                    <label>Possesseur</label>
                                    <input type="text" class="form-control"
                                           name="possesseur" id="possesseur"
                                           value="<?php echo $possesseur ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Console</label>
                                    <input type="text" class="form-control"
                                           name="console" id="console" value="<?php echo $console ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Prix</label>
                                    <input type="text" class="form-control"
                                           name="prix" id="prix" value="<?php echo $prix ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Nb joueurs max</label>
                                    <input type="text" class="form-control"
                                           name="nbre_joueurs_max" id="nbre_joueurs_max" value="<?php echo $nbre_joueurs_max ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Commentaires</label>
                                    <textarea class="form-control"
                                              name="commentaires" id="commentaires"><?php echo $commentaires ?></textarea>
                                </div>
                            </main>
                            <footer class="card-footer d-flex justify-content-between">
                                <button type="submit" value="okMod" name="modJeu" class="btn btn-primary">MODIFIER</button>
                                <a href="./pdo.php" class="btn btn-warning">ANNULER MODIFICATION</a>
                            </footer>
                        </article>
                    </form>
                    <?php
                    break;
                default:

            }
            ?>
        </article>
    </section>
</main>
</body>
</html>