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

    //méthode de la classe
    public function demarrer()
    {
        //moteur passe à true
        $this->moteur = true;
        return "La voiture de " . $this->proprietaire . " démarre.<br />";
    }

    public function arreter()
    {
        //moteur passe à false
        $this->moteur = false;
        echo $this->pointMort();
        return "La voiture de " . $this->proprietaire . " est arrêtée. vitesse : " . $this->vitesse . "<br />";
    }

    public function accelerer()
    {
        // si et seulement si moteur est démarré,
        // la vitesse actuelle augmente de 1 mais ne
        // doit pas dépasser la vitesse max
        if ($this->moteur) {
            if ($this->vitesse < $this->vitesseMax) {
                $this->vitesse++;
                return "a La voiture accelère : vitesse : " . $this->vitesse . "<br />";
            } else {
                return "a La voiture est à la vitesse max : " . $this->vitesse . " ème<br />";
            }
        } else {
            return "a Il faut démarrer la voiture.<br />";
        }
    }

    public function retrograder()
    {
        // si et seulement si moteur est démarré,
        // la vitesse actuelle descend de 1 mais ne
        // doit pas aller en dessous de -1 (marche arrière)
        // et on doit savoir quand on est en marche arrière
        if ($this->moteur) {
            switch ($this->vitesse) {
                case ($this->vitesse > 1):
                    $this->vitesse--;
                    return "r On passe la vitesse " . $this->vitesse . ".<br />";
                case ($this->vitesse == 1):
                    $this->vitesse--;
                    echo $this->pointMort();
                    return "r On s'arrête.<br />";
                case ($this->vitesse == 0):
                    $this->vitesse--;
                    return "r Marche Arrière !<br />";
                default:
                    return "r Peut pas aller moins vite.<br />";
            }
        } else {
            return "r Il faut démarrer la voiture.<br />";
        }
    }

    public function pointMort()
    {
        // la vitesse actuelle passe à 0
        $this->vitesse = 0;
        return "PM La voiture est au point mort<br />";
    }

}