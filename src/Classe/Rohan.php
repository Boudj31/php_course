<?php


namespace App;
use Interfaces\CharacterOriginInterface;


class Rohan implements CharacterOriginInterface
{
    public function origine(){
        return "Vous etes une bète de la contrée de Rohan";
    }

    public function criDeGuerre(){
        return "A DADAAA !";
    }

}