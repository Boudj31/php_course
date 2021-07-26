<?php

namespace Game;

class Guerrier extends Personnage{

    //Guerrier constructeur
    public function __construct(string $nom, string $prenom, int $age, Arme $arme)
    {
        parent::__construct($nom, $prenom, $age, $arme);
        $this->vigueur += 20;
        $this->for += 2;
        $this->bonusFor = $this->tabBonus[$this->for - 1];
    }

    public function doubleFrappe(Personnage $persoCible, $degatFrappe = 0){
        $targetIsDead = false;
        $cptAttaque = 0;
        while(!$targetIsDead && $cptAttaque < 2){
            //$d20Attaque = rand(1,20) + $this->bonusFor;
            $roll = $this->unD20();
            $d20 = $roll["roll"] ;
            $this->isCritic = $roll["crit"];
            $d20Attaque = $d20 + $this->bonusFor;
            $degatFrappe = $this->arme->getNiveauDegats($this->isCritic);
            $targetIsDead = false;
            if($d20Attaque >= $persoCible->classeArmure){
                $targetIsDead = $persoCible->setHitPoints( $persoCible->getHitPoints() - $degatFrappe );
                if($this->isCritic){
                    echo "<span class='alert alert-secondary'>d20 Critique</span><br><br>";
                }
                echo "<span class=\"alert alert-success\">".$this->prenom." ".
                    $this->nom." frappe avec ".$this->arme->getNom()." ( d20 : ".$d20." + ".$this->bonusFor .": ".
                    $d20Attaque." CA cible ".$persoCible->classeArmure.") ".
                    $persoCible->prenom." ".$persoCible->nom." pour ".
                    $degatFrappe." dégâts</span> <br><br>";
                //le perso qui frappe va gagner de l'expérience
                $this->gagnerExperience();
            }else{
                echo "<span class=\"alert alert-warning\">".$this->prenom." ".
                    $this->nom." a raté avec ".$this->arme->getNom()." (d20+bonus force : ".
                    $d20Attaque." CA cible ".$persoCible->classeArmure.") ".
                    $persoCible->prenom." ".$persoCible->nom." </span> <br><br>";
            }
            $this->isCritic = false;
            $cptAttaque++;
        }
        return $targetIsDead;
    }

    public function multi(Personnage $persoCible){
        $targetIsDead = false;
        $vigueurUtilisee = rand(10,15);
        //$degatFrappe = 2*($this->arme->getNiveauDegats());
        if(($this->vigueur - $vigueurUtilisee) >= 0){
            echo "<span class=\"alert alert-success\">".$this->prenom." ".
                $this->nom." Lance une double frappe : </span> <br><br>";
            $targetIsDead = $this->doubleFrappe($persoCible);
            $this->vigueur -= $vigueurUtilisee;
        }else{
            echo "<span class=\"alert alert-warning\">".$this->prenom." ".
                $this->nom." n'a pas assez de vigueur pour déclencher une double frappe </span> <br><br>";
            //on pourrait faire un frapper de base
        }
        return $targetIsDead;
    }
}