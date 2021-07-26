<?php

namespace Game;

class Personnage{
    protected $nom;
    protected $prenom;
    private $age;
    protected $arme;
    protected $for, $dex, $cons, $int, $sag, $cha;
    protected $bonusFor, $bonusDex, $bonusCons, $bonusInt, $bonusSag, $bonusCha;
    protected $tabBonus = [
        -5, -4, -4, -3, -3, -2, -2, -1, -1, 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5
    ];
    private $hitPoints;
    protected $experience;
    private $localisation;
    protected $classeArmure;
    protected $vigueur;
    protected $isCritic;

    public function __construct(string $nom, string $prenom, int $age, Arme $arme){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->arme = $arme;
        //générer les capacités (for, int, etc)
        $this->for = $this->randStat();
        $this->dex = $this->randStat();
        $this->cons = $this->randStat();
        $this->int = $this->randStat();
        $this->sag = $this->randStat();
        $this->cha = $this->randStat();
        //déterminer les bonus des capacités
        $this->bonusFor = $this->tabBonus[$this->for - 1];
        $this->bonusDex = $this->tabBonus[$this->dex - 1];
        $this->bonusCons = $this->tabBonus[$this->cons - 1];
        $this->bonusInt = $this->tabBonus[$this->int - 1];
        $this->bonusSag = $this->tabBonus[$this->sag - 1];
        $this->bonusCha = $this->tabBonus[$this->cha - 1];
        //générer les point de vie
        $this->hitPoints = rand(50,90);
        //gérer l'expérience
        $this->experience = 1;
        //déterminer son emplacement à sa création
        $this->localisation = "Entrée du donjon";
        // déterminer la classe d'armure
        $this->classeArmure = 10 + $this->bonusDex;
        // déterminer la vigueur
        $this->vigueur = $this->cons * 10;
        $this->isCritic = false;
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
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of arme
     */
    public function getArme()
    {
        return $this->arme;
    }

    /**
     * Set the value of arme
     *
     * @return  self
     */
    public function setArme($arme)
    {
        $this->arme = $arme;

        return $this;
    }

    private function randStat(){
        return rand(1,6) + rand(1,6) + 6;
    }

    /**
     * Get the value of hitPoints
     */
    public function getHitPoints()
    {
        return $this->hitPoints;
    }

    /**
     * Set the value of hitPoints
     *
     * @return  self
     */
    public function setHitPoints($hitPoints)
    {
        if($hitPoints <= 0){
            $this->hitPoints = 0;
            return true;
        }else{
            $this->hitPoints = $hitPoints;
            return false;
        }
        //return $this;
    }

    public function frapper(Personnage $persoCible, $degatFrappe = 0){
        $roll = $this->unD20();
        $d20 = $roll["roll"] ;
        $this->isCritic = $roll["crit"];
        $d20Attaque = $d20 + $this->bonusFor;
        if($degatFrappe === 0){
            $degatFrappe = $this->arme->getNiveauDegats($this->isCritic);
        }
        $targetIsDead = false;
        if($d20Attaque >= $persoCible->classeArmure){
            $targetIsDead = $persoCible->setHitPoints( $persoCible->getHitPoints() - $degatFrappe );
            if($this->isCritic){
                echo "<span class='alert alert-secondary'>d20 Critique</span><br><br>";
            }
            echo "<span class=\"alert alert-success\">".$this->prenom." ".
                $this->nom." frappe avec ".$this->arme->getNom().
                " ( d20 : ".$d20." + ".$this->bonusFor .": ".
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
        return $targetIsDead;
    }

    public function multi(Personnage $persoCible){
        $targetIsDead = false;
        $vigueurUtilisee = rand(10,15);
        $degatFrappe = 2*($this->arme->getNiveauDegats($this->isCritic));
        if(($this->vigueur - $vigueurUtilisee) >= 0){
            echo "<span class=\"alert alert-success\">".$this->prenom." ".
                $this->nom." Frappe fort : </span> <br><br>";
            $targetIsDead = $this->frapper($persoCible, $degatFrappe);
            $this->vigueur -= $vigueurUtilisee;
        }else{
            echo "<span class=\"alert alert-warning\">".$this->prenom." ".
                $this->nom." n'a pas assez de vigueur pour déclencher le multi </span> <br><br>";
            //on pourrait faire un frapper de base
        }
        return $targetIsDead;
    }

    public function gagnerExperience($xp = 1){
        $this->experience += $xp;
    }

    static function unD20(){
        $d20Roll = rand(1,20);
        $isCritic = false;
        if($d20Roll === 20){
            $isCritic = true;
        }
        return ["roll" => $d20Roll, "crit" => $isCritic];
    }

    /**
     * Get the value of isCritic
     */
    public function getIsCritic()
    {
        return $this->isCritic;
    }

    /**
     * Set the value of isCritic
     *
     * @return  self
     */
    public function setIsCritic($isCritic)
    {
        $this->isCritic = $isCritic;

        return $this;
    }
}
