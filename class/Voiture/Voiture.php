<?php
declare(strict_types=1);

namespace App\Voiture;

use App\Exceptions\VoitureException;
use App\Reservoir\Reservoir;
use App\Option\Option;
use App\Compteur\Compteur;

class Voiture{
    
    private string $model = "voiture";
    private int $prixVoiture;
    private float $consommationParKilometre;
    private ?Reservoir $reservoir = null;
    private ?Compteur $compteur = null;
    private array $options = [];
    
    public function __construct(string $model ,int $prixVoiture,float $consommationPar100Kilometre)
    {      
        $this->model = $model;
        $this->prixVoiture = $prixVoiture;
        $this->consommationParKilometre = $consommationPar100Kilometre / 100;
    }
    public function getModel():string
    {
        return $this->model;
    }
    public function getPrixVoiture():int
    {
        return $this->prixVoiture;
    }
    public function getConsommationParKilometre():float
    {
        return $this->consommationParKilometre * 100;
    }
    public function getCompteur():?Compteur
    {
        return $this->compteur;
    }
    public function getReservoir():?Reservoir
    {
        return $this->reservoir;
    }         
    public function ajouteReservoir($reservoir):void
    {
        $this->reservoir = $reservoir;
    }
    private function calculeConsommation(int $kilometre):float
    {
        return $kilometre * $this->consommationParKilometre; 
    }
    public function parcourirUneDistance(int $kilometre):void
    {
        if($this->reservoir){
            $conso = $this->calculeConsommation($kilometre);
            $contenance = $this->reservoir->interrogeCarburant();
            if ($conso <= $contenance){
                echo "<h4>Distance Parcouru</h4><ul>";
                echo "<li>Tu as parcouru {$kilometre}km</li>";
                echo "<li>Consommation {$conso}L pour {$kilometre} km</li>";
                echo "</ul>";
                $this->reservoir->consommationDuCarburant($conso);
                $this->compteur->ajouteKilometrage($kilometre);
                return;
            } else {
                throw new VoitureException("Impossible de parcourir {$kilometre} km reste que {$contenance}L");
            }  
        }
        throw new VoitureException( "Reservoir non installer");
    }
    public function estimationDistancePossible():float
    {
        $contenance = $this->reservoir->interrogeCarburant();
        $consommationParLitre = 1 / $this->consommationParKilometre;
        $consommationParLitre = number_format($consommationParLitre,1);
        $estimation = $contenance * $consommationParLitre;
        echo "!! Tu peux parcourir encore {$estimation} km avant la panne sèche !!<br>";
        return $estimation;
    }
    public function ajouteOption(Option $option)
    {
        $this->options[] = $option;
        // echo "La voiture a l'option {$option->getDescription()} au prix de {$option->interrogePrix()}€<br>";
    }
    public function calculePrix():int
    {
        $prix = 0;
        foreach ($this->options as $option){
            $prix = $prix + $option->interrogePrix();  

        }
        // if($this->boiteAuto != null)
        // {
        //     $prix = $prix + $this->boiteAuto->interrogePrix();
        // }
        // if($this->peintureMetal != null)
        // {
        //     $prix = $prix + $this->peintureMetal->interrogePrix();
        // }
        // if($this->interieurCuir != null)
        // {
        //     $prix = $prix + $this->interieurCuir->interrogePrix();
        // }
        $prix = $prix + $this->prixVoiture;
        echo "<h4>Le prix total est de {$prix} €</h4>";
        return $prix;
    }
    public function printOptions():void
    {
        echo "<h4>Liste des options</h4><ul>";
        foreach ($this->options as $option){
            echo "<li>{$option->getDescription()} au prix de {$option->interrogePrix()}€</li>";
        }
        echo "</ul>";
    }
    public function ajouteCompteur($compteur):void
    {
        $this->compteur = $compteur;
    }

}  


?>