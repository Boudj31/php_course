<?php
include "./src/includes/functions.php";
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
            //var_dump($_SERVER);
            ?>
            <section class="row">
                <h2 class="text-center">Rappels Php</h2>
                <article class="col-md-6">
                    <h3>Variables</h3>
                    <p>
                        <?php
                        //commentaire sur une ligne
                        /**
                         * commentaire en bloc
                         */

                         // variables 
                         $mavariable = null;
                        if($mavariable){
                            echo "ma variable est instanciée <br />";
                        }else{
                        echo "ma variable n'est pas instanciée ou est égale à null <br />";
                        }

                        //ternaire
                        $varAtester = 12;
                        echo ((paire($varAtester)) ? "${varAtester} est paire" : "${varAtester} est impaire") . "<br />";
                        $varAtester = 12.9;
                        echo ((paire($varAtester)) ? "${varAtester} est paire" : "${varAtester} est impaire") . "<br />";

                        echo gettype($varAtester)."<br />";

                        $mavariable = 3;
                        echo " ${mavariable} <br />";
                        echo gettype($mavariable)."<br />";

                        $mavariable = "2";
                        echo " ${mavariable} <br />";
                        echo gettype($mavariable)."<br />";

                        $mavariable = $mavariable + 2;
                        echo " ${mavariable} <br />";
                        echo gettype($mavariable)."<br />";

                        $mavariable = $mavariable . 2;
                        echo " ${mavariable} <br />";
                        echo gettype($mavariable)."<br />";
                        
                        $tableau = [];

                        array_push($tableau, "du texte", 12, 12.3, true);

                        var_dump($tableau);
                        echo gettype($tableau)."<br />";
                        for($i = 0; $i < count($tableau); $i++){
                            echo $tableau[$i]."<br />";
                        }

                        foreach($tableau as $clef => $element){
                            echo "${clef} : ${element}<br />";
                        }

                        $monTableauAsso = ["nom" => "Duflot", "prenom" => "Nicolas", "age" => 41 ];

                        var_dump($monTableauAsso);
                        foreach($monTableauAsso as $key => $value){
                            echo "${key} : ${value}<br />";
                        }
                        echo gettype($monTableauAsso)."<br />";

                        echo $monTableauAsso["nom"] . "<br />";

                        //switch
                        $maVariableATester = "sole";
                        /*
                        if($maVariableATester === "cabillaud"){
                            //traitement
                             echo " c'est un un un ... ";
                              echo " c'est une une... ";
                              echo "c'est un poisson <br />";
                        }elseif($maVariableATester == "sole"){
                            //traitement
                            echo " c'est une une... ";
                              echo "c'est un poisson <br />";
                        }elseif(){
                            //traitement
                        }else{
                            //traitement
                        }
                        */

                        switch($maVariableATester){
                            case "cabillaud":
                                echo " c'est un un un ... ";
                            case "sole":
                                echo " c'est une... une... ";
                            case "bar":
                                echo "c'est un poisson <br />";
                                break;
                            case "sanglier":
                            case "cerf":
                            case "orc":
                                echo "c'est un mamifère <br />";
                                break;
                            default:
                                echo "ça n'est pas dans la liste <br />";
                        }
                        ?>
                    </p>
                    <?php 
                    //var_dump($GLOBALS); 
                    echo $GLOBALS["testGlob"]."<br />";
                    ?>
                    <p>
                        <?php
                        changeTestGlob();
                        ?>
                    </p>
                    </article>
                    <article class="col-md-6">
                    <h3>Fichiers</h3>
                    <h4>Ouvrir un fichier existant</h4>
                    <?php
                    $repFile = "./assets/files";
                    if( !$file = fopen($repFile."/test/"."texte.txt",  "r+") ){
                        echo "Impossible d'ouvrir ".$repFile."/test/"."texte.txt"."<br />";
                    }else{
                        //var_dump($file);
                        echo "<br />";
                        /*
                        echo fgets($file, 10)."!";
                        echo fgets($file, 10)."!";
                        echo fgets($file)."!";
                        */
                        while( !feof($file)){
                            echo fgets($file)."<br />";
                        }
                        fclose($file);
                        
                    }
                    ?>
                    <h4>Créer un fichier</h4>
                    <?php
                    $dirYear = date("Y");
                    $dirMonth = date("m");
                    $dirDate = date("d");
                    $fileName = date("H").".txt";

                    if(!file_exists($repFile."/".$dirYear)){
                        mkdir($repFile."/".$dirYear, 0777);
                    }

                    if(!file_exists($repFile."/".$dirYear."/".$dirMonth)){
                        mkdir($repFile."/".$dirYear."/".$dirMonth, 0777);
                    }

                    if(!file_exists($repFile."/".$dirYear."/".$dirMonth."/".$dirDate)){
                        mkdir($repFile."/".$dirYear."/".$dirMonth."/".$dirDate, 0777);
                    }

                    if( !$file = fopen($repFile."/".$dirYear."/".$dirMonth."/".$dirDate."/".$fileName, "w+")){
                        echo "Impossible d'ouvrir ".$repFile."/".$dirYear."/".$dirMonth."/".$dirDate."/".$fileName."<br />";
                    }else{
                        //écriture
                        if( !fwrite($file, "Coucou \n") ){
                            echo "Impossible d'ecrire dans ".$repFile."/".$dirYear."/".$dirMonth."/".$dirDate."/".$fileName."<br />";
                        }
                        foreach($monTableauAsso as $key => $value){
                            //echo "${key} : ${value}<br />";
                            if( !fwrite($file, "${key} : ${value}\n") ){
                                echo "Impossible d'ecrire dans ".$repFile."/".$dirYear."/".$dirMonth."/".$dirDate."/".$fileName."<br />";
                            }
                        }
                        fclose($file);
                    }

                    ?>
                    <h4>Lister répertoire et fichiers</h4>
                    <?php
                    echo mapDir("./assets/files");
                    ?>
                </article>
            </section>
        </main>
        <?php
        include "./src/includes/footer.php";
        ?>
    </body>
</html>