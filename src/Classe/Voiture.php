<?php

namespace App;
class Voiture
{
// attributs ou variables de la classe

    /**
     * Voiture constructor
     * @param string $marque
     */
    private $marque;
    private $modele;
    private $couleur;
    private $proprietaire;
    private $vitesseMax;
    private $moteur = false;

    /**
     * Voiture constructor.
     * @param $marque
     * @param $modele
     * @param $couleur
     * @param $proprietaire
     * @param $vitesseMax
     */
    public function __construct($marque, $modele, $couleur, $proprietaire, $vitesseMax)
    {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->couleur = $couleur;
        $this->proprietaire = $proprietaire;
        $this->vitesse = 0;
        $this->vitesseMax = $vitesseMax;
    }
    /**
     * @return string
     */
    public function getMarque(): string
    {
        $upperMarque = strtoupper($this->marque);
        return $upperMarque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param mixed $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    /**
     * @return mixed
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getProprietaire()
    {
        return $this->proprietaire;
    }

    /**
     * @param mixed $proprietaire
     */
    public function setProprietaire($proprietaire)
    {
        $this->proprietaire = $proprietaire;
    }

    /**
     * @return mixed
     */
    public function getVitesseMax()
    {
        return $this->vitesseMax;
    }

    /**
     * @param mixed $vitesseMax
     */
    public function setVitesseMax($vitesseMax)
    {
        $this->vitesseMax = $vitesseMax;
    }

    //m??thode de la classe
    public function demarrer()
    {
        //moteur passe ?? true
        $this->moteur = true;
        return "La voiture de " . $this->proprietaire . " d??marre.<br />";
    }

    public function arreter()
    {
        //moteur passe ?? false
        $this->moteur = false;
        echo $this->pointMort();
        return "La voiture de " . $this->proprietaire . " est arr??t??e. vitesse : " . $this->vitesse . "<br />";
    }

    public function accelerer()
    {
        // si et seulement si moteur est d??marr??,
        // la vitesse actuelle augmente de 1 mais ne
        // doit pas d??passer la vitesse max
        if ($this->moteur) {
            if ($this->vitesse < $this->vitesseMax) {
                $this->vitesse++;
                return "a La voiture accel??re : vitesse : " . $this->vitesse . "<br />";
            } else {
                return "a La voiture est ?? la vitesse max : " . $this->vitesse . " ??me<br />";
            }
        } else {
            return "a Il faut d??marrer la voiture.<br />";
        }
    }

    public function retrograder()
    {
        // si et seulement si moteur est d??marr??,
        // la vitesse actuelle descend de 1 mais ne
        // doit pas aller en dessous de -1 (marche arri??re)
        // et on doit savoir quand on est en marche arri??re
        if ($this->moteur) {
            switch ($this->vitesse) {
                case ($this->vitesse > 1):
                    $this->vitesse--;
                    return "r On passe la vitesse " . $this->vitesse . ".<br />";
                case ($this->vitesse == 1):
                    $this->vitesse--;
                    echo $this->pointMort();
                    return "r On s'arr??te.<br />";
                case ($this->vitesse == 0):
                    $this->vitesse--;
                    return "r Marche Arri??re !<br />";
                default:
                    return "r Peut pas aller moins vite.<br />";
            }
        } else {
            return "r Il faut d??marrer la voiture.<br />";
        }
    }

    public function pointMort()
    {
        // la vitesse actuelle passe ?? 0
        $this->vitesse = 0;
        return "PM La voiture est au point mort<br />";
    }

}