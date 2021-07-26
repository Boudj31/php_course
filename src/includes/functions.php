<?php
//setlocale(LC_ALL, "fr_FR");.
date_default_timezone_set('Europe/Paris');
$testGlob = "test variable globale";

function changeTestGlob(){
    global $testGlob; // $testGlob = $GLOBALS["testGlob"];
    echo $testGlob;
}

function pageActive(String $phpFile){
    //$phpFile contient le nom du fichier du lien, et on vérifie si ce nom est présent dans l'url de la page
    $requestUri = $_SERVER["REQUEST_URI"];
    //$filename =  pathinfo($requestUri, PATHINFO_FILENAME);
    if(strrpos($requestUri, $phpFile)){
        return " active";
    }
}

function paire(Int $variable){
    /*
    $ispaire = false;
    if($variable %2 === 0){
        $ispaire =true;
    }
    return $ispaire;
    */
    /*
    if($variable %2 === 0){
        return true;
    }else{
        return false;
    }*/
    //ternaire
    // (condition) ? <résultat si condition vraie > : <résultat si condition fausse> ; 
    return ($variable %2 === 0) ? true : false ;
}

function mapDir($dir){
    $liste = "<ul class=\"list-group list_group-flush\">";
        $folder = opendir($dir);
        //var_dump($folder);
        //$file = readdir($folder);
        while($file = readdir($folder)){
            // ./ et ../ sont des données retournées par readdir
            if($file != "." && $file != ".."){
                $pathFile = $dir."/".$file;
                if(filetype($pathFile) == "dir"){
                    $liste .= "<li class=\"list-group-item bg-dark text-white\">${file}</li>";
                }else{
                    $liste .= "<li class=\"list-group-item\">${file}</li>";
                }

                //si c'est un répertoire, je relance la fonction dans la fonction
                if(filetype($pathFile) == "dir"){
                    $liste .= mapDir($pathFile);
                }
            }
            
            //sinon on affiche le fichier
        }

    $liste .= "</ul>";
    return $liste;
}

function prePrint($value) {
    echo "<code><pre>";
    print_r($value);
    echo "</code></pre>";
}