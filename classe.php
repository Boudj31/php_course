<?php
require_once "vendor/autoload.php";
use Factory\Voiture;
include "./src/includes/functions.php";
// pour pouvoir appeler une classe, il faut la declarer dans la page en cours en utilisant 'require'
//require "./src/Classe/Voiture.php";



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
        <article class="col-md-6">
            <h2>POO- Programation Orienté Objet </h2>
            <p>
             Un objet est une variable de type OBject qui contient des attributs et des methodes <br>
                Certains objets peuvent etre utilisé directement dans crée d'instance,
                ou via une instance <br> (Date()).
                <code>$madate = new Date();</code>
            </p>
            <h3>Crée une classe</h3>
            <p>Pour créer une classe il faut :</p>
            <ul>
                <li>Un constructeur : sert à créer l'instance de la classe </li>
            </ul>
            <?php
            $maVoiture = new Voiture("Mercedes", "A45 AMG", "Gris Nardo", "Jul",  300);
            prePrint($maVoiture);
            echo $maVoiture->getMarque();
            prePrint($maVoiture->setMarque("Renault"));
            echo $maVoiture->getMarque();
            echo $maVoiture->demarrer();
            echo $maVoiture->accelerer();
            echo $maVoiture->accelerer();
            echo $maVoiture->accelerer();
            echo $maVoiture->retrograder();
            echo $maVoiture->accelerer();
            echo $maVoiture->retrograder();
            echo $maVoiture->pointMort();
            echo $maVoiture->arreter();


            ?>
        </article>
        <article class="col-md-6">
            <h2>Composer</h2>
            <p>
                Composer est un gestionnaire de paquets, il aide à l'installation et à la gestion
                des bibliothèques et des dépendances Php?
            </p>
            <h3>Installer composer</h3>
            <p>
                Récupérer l'installeur composeur sur le site, et indiquer lors de l'installation
                qu'il soit accessible depuis tous les répertoires.
            </p>
            <h3>Initialiser composer</h3>
            <p>
                Composer utilise un fichier nommé <code>composer.json</code> pour fonctionner. Il est possible
                de le créer soit-même, dans ce cas il faut le créer à la racine du projet ou bien
                d'utiliser la fonction composer init qui est un assistant de création de ce fichier.
                Il faut que dans le terminal vous vous trouviez à la racine du projet avant de lancer la commande.
            </p>
            <ul>
                <li>Le nom du projet qu'on peut laisser par défaut (sauf s'il y a des caractères
                    spéciaux dans ce cas il faut changer le fichier une fois qu'il est généré)</li>
                <li>La description du projet</li>
                <li>L'auteur du projet sous la forme <code>nom prenom &lt;adresse.email@email.com&gt;</code></li>
                <li>La stabilité minimale, permet de filtrer les librairies par rapport à la valeur attribuée : en
                    tapant <code>stable</code> tous les packages utilisés doivent être à la version stable</li>
                <li>Type du package, ici il s'agit d'un projet, donc on utilise <code>project</code></li>
                <li>License : on indique la valeur de licence du projet (au choix, libre, etc.)</li>
                <li>On répond ici non aux trois dernière question, pour ne pas jouer avec les interdépendance des paquets</li>
            </ul>
            <p>
                Une fois que c'est fini, composer demande la confirmation de création du fichier.
            </p>
            <h3>Implémenter composer sur le projet</h3>
            <p>
                Pour implémenter composer sur le projet, il faut lancer la commande <code>composer install</code> qui va :
            </p>
            <ul>
                <li>Il va lire le fichier composer.json</li>
                <li>Il va créer le fichier composer.lock</li>
                <li>Il créer le <code>vendor</code> du site</li>
                <li>Il récupère les dépendance de composer</li>
                <li>Il ajoute les dépendances si il y en a (dans composer.json)</li>
            </ul>
        </article>
        <article class="col-md-6">
            <h2>Autoload et PSR-4</h2>
            <p>
                Le fichier autoload permet de charger automatiquement les liaison vers les dépendance, classe, etc
                installée par composer. on peut aussi créer ses propres namespaces de classes et les ajouter
                à l'autoload.
            </p>
            <p>
                Il suffit d'ajouter les lignes suivantes au fichier composer.json
            </p>
            <code>
                        <pre>
"autoload" : {
    "psr-4": {
        "App\\": "src/Classes"
    }
}
                        </pre>
            </code>
            <p>
                Il faut lancer ensuite <code>composer update</code> pour que le namespace et le répertoire des
                fichiers associés soient pris en compte dans le psr-4
            </p>
            <p>
                il ne faut pas oublier de préciser le namespace des classes dans la déclarations des classes
            </p>
            <code>
                        <pre>
&lt;?php
namespace App;

class Voiture{
    //code de la classe Voiture
}
?&gt;
                        </pre>
            </code>
        </article>
        <article class="col-lg-6">
            <h2>Installer d'autres dépendances</h2>
            <p>
                Grace au site packagist.org il est possible de trouver les dépendances et librairies
                qu'on peut installer en utilisant composer. si on a demandé dans l'init du json
                de profiter des package stables, on peut directement utiliser la ligne de commande
                donnée par le site. Par exemple, pour twbs/bootstrap : <code>composer require twbs/bootstrap</code>
                nous donnera la dernière version stable du bootstrap. On peut aussi choisir un version fixe :
                <code>composer require twbs/bootstrap:5.0.2</code> qui ne changera pas la version
            </p>
            <p>
                pour profiter des dernières versions stables mineures
                sans passer par les versions majeure on va écrire par exemple
                <code>composer require twbs/bootstrap:^5.0.2</code>
            </p>
            <ul>
                <li>>=1.0 (version 1 et supérieures)</li>
                <li>>=1.0 <=2.0 (Version supérieire ou égale à 1 et inférieure ou égale à 2)</li>
                <li>>=1.0 <1.1 || >=1.2 (Version supérieure ou égale à 1 et inférieure ou égale à 1.1
                    <b>OU</b> version supérieur ou égal à 1.2)</li>
                <li>1.0 - 2.0 (plage de version qui équivaut à >=1.0.0 &gt;2.1 )</li>
                <li>1.0.* (version 1.0 à inférieur strictement à 1.1)</li>
                <li>~1.4 (version supérieur ou égale à 1.4 mais strictement inférieure à 2.0)</li>
                <li>^1.4.5 (permet les mises à jour mineures suivantes mais pas la mise à jour majeure 2.0)</li>
            </ul>
        </article>

    </section>
</main>
<?php
include "./src/includes/footer.php";
?>
</body>
</html>