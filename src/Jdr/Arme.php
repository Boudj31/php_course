<?php

namespace Game;
class Arme{
    private $nom;
    private $niveauDegats;
    private $tabDegats = ["1;3", "3;5", "6;10", "11;15"];

    public function __construct($nom = "Mains nues", $niveauDegats = 0){
        $this->nom = $nom;
        $this->niveauDegats = ($niveauDegats > 3)? 3 : $niveauDegats;
    }


    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of niveauDegats
     */
    public function getNiveauDegats($isCritic = false)
    {

        $tabMinMax = explode(";", $this->tabDegats[$this->niveauDegats]);
        $degats = rand( intval($tabMinMax[0]), intval($tabMinMax[1] ) );
        if($isCritic){
            echo "dégâts doublés<br />";
            $degats = $degats*2;
        }
        //return rand( intval($tabMinMax[0]), intval($tabMinMax[1] ) );
        //return $this->niveauDegats;
        return $degats;
    }

    /**
     * Set the value of niveauDegats
     *
     * @return  self
     */
    public function setNiveauDegats($niveauDegats)
    {
        $this->niveauDegats = $niveauDegats;

        return $this;
    }
}