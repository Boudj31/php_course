<?php


namespace App;
use Interfaces\CharacterOriginInterface;


class Mordor implements CharacterOriginInterface
{
    public function origine(){
        return "Vous etes une bète de la contrée de Mordor";
    }

    public function criDeGuerre(){
        return "Sauron va vous bouffer !";
    }

}