<?php

$fileTwbsCss = "./vendor/twbs/bootstrap/dist/css/bootstrap.css";
$copiedToTwbsCss = "./assets/css/bootstrap.css";
if(!copy($fileTwbsCss, $copiedToTwbsCss)){
    echo "La copie ". $fileTwbsCss ." a échouée";
}

$fileTwbsJs = "./vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js";
$copiedToTwbsJs = "./assets/js/bootstrap.bundle.js";
if(!copy($fileTwbsJs, $copiedToTwbsJs)){
    echo "La copie ". $fileTwbsJs ." a échouée";
}