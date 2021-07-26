<?php

namespace Game;

class Mage extends Personnage{
    protected $mana;
    //Mage constructeur
    public function __construct(string $nom, string $prenom, int $age, Arme $arme)
    {
        parent::__construct($nom, $prenom, $age, $arme);
        $this->nom .= " le magicien";
        $this->sag += 2;
        $this->bonusSag = $this->tabBonus[$this->sag - 1];
        $this->mana = $this->sag * 10;
    }

    public function gagnerExperience($xp = 2){
        $this->experience += $xp;
    }

    public function bouleDeFeu(Personnage $persoCible, $degatFrappe = 0){
        //$d20Attaque = rand(1,20) + $this->bonusSag;
        $roll = $this->unD20();
        $d20 = $roll["roll"] ;
        $this->isCritic = $roll["crit"];
        $d20Attaque = $d20 + $this->bonusSag;
        if($degatFrappe === 0){
            for($i = 0;$i < 7; $i++){
                $degatFrappe += rand(1,6);
            }
            if($this->isCritic){
                $degatFrappe = $degatFrappe*2;
            }
        }
        $targetIsDead = false;
        if($d20Attaque >= $persoCible->classeArmure){
            $targetIsDead = $persoCible->setHitPoints( $persoCible->getHitPoints() - $degatFrappe );
            if($this->isCritic){
                echo "<span class='alert alert-secondary'>d20 Critique</span><br><br>";
            }
            echo "<span class=\"alert alert-success\">".$this->prenom." ".
                $this->nom." lance une boule de feu  ( d20 : ".$d20." + ".$this->bonusSag ." : ".
                $d20Attaque." CA cible ".$persoCible->classeArmure.") sur ".
                $persoCible->prenom." ".$persoCible->nom." pour ".
                $degatFrappe." dégâts</span> <br><br>";
            //le perso qui frappe va gagner de l'expérience
            $this->gagnerExperience();
        }else{
            echo "<span class=\"alert alert-warning\">".$this->prenom." ".
                $this->nom." a raté avec sa boule de feu (d20+bonus sag : ".
                $d20Attaque." CA cible ".$persoCible->classeArmure.") ".
                $persoCible->prenom." ".$persoCible->nom." </span> <br><br>";
        }
        $this->isCritic = false;
        return $targetIsDead;
    }

    public function multi(Personnage $persoCible){
        $targetIsDead = false;
        $manaUtilisee = rand(10,15);
        //$degatFrappe = 2*($this->arme->getNiveauDegats());
        if(($this->mana - $manaUtilisee) >= 0){
            echo "<span class=\"alert alert-success\">".$this->prenom." ".
                $this->nom." lance une boule de feu : </span> <br><br>";
            $targetIsDead = $this->bouleDeFeu($persoCible);
            $this->mana -= $manaUtilisee;
        }else{
            echo "<span class=\"alert alert-warning\">".$this->prenom." ".
                $this->nom." n'a pas assez de mana pour déclencher lancer la boule de feu </span> <br><br>";
            //on pourrait faire un frapper de base
        }
        return $targetIsDead;
    }
}