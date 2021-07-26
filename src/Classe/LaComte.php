<?php


namespace App;
use Interfaces\CharacterOriginInterface;


class LaComte implements CharacterOriginInterface
{
    public function origine(){
        return "Vous etes une bète de la contrée de la Comté";
    }

    public function criDeGuerre(){
        return "a TABLE ";
    }

}