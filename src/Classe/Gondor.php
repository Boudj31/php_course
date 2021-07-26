<?php


namespace App;
use Interfaces\CharacterOriginInterface;


class Gondor implements CharacterOriginInterface
{
    public function origine(){
        return "Vous etes une bète de la contrée de Gondor";
    }

    public function criDeGuerre(){
        return "HEHEHEHE !";
    }

}