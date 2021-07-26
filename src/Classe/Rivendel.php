<?php


namespace App;
use Interfaces\CharacterOriginInterface;


class Rivendel implements CharacterOriginInterface
{
    public function origine(){
        return "Vous etes une bète de la contrée de Rivendel";
    }

    public function criDeGuerre(){
        return "Pour l'honneur de Rivendel !";
    }

}