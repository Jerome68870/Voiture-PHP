<?php
declare(strict_types=1);

namespace App\Reservoir;

use Exception;

class Reservoir{
    
    private  int $capacite;
    private  float $litre = 0;

    public function __construct(int $capacite)
    {
        $this->capacite = $capacite;
        echo "<h4>Ajout d'un reservoir d'une capacite de {$capacite}L</h4>";
    }
    public function interrogeCarburant():float
    {
        return $this->litre;
    }
    public function getCapacite():int
    {
        return $this->capacite;
    }
    public function ajouteCarburant(int $litre):void
    {
        if($this->litre + $litre > $this->capacite){
            throw new ReservoirException ("La capacite maximun du reservoir est de {$this->litre}L");

        }
        echo "<p> --> Ajout de {$litre}L de carburant dans le reservoir.<p>";
        $this->litre = $this->litre + $litre;
    }

    public function consommationDuCarburant(float $litre):void
    {
        $this->litre = $this->litre - $litre;
        if($this->litre <= 5){
            $this->litre = 5;
            echo "<h4>Attention tu es sur reserve!!</h4>";
        }
    }

}
class ReservoirException extends Exception{}

?>