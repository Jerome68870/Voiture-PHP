<?php
declare(strict_types=1);

namespace App\Compteur;

Class Compteur{

    private int $kilometre;

    public function __construct(int $kilometre)
    {
        $this->kilometre = $kilometre;
    
    }
    public function interrogeKilometrage():int
    {
        return $this->kilometre;
    }
    public function ajouteKilometrage(int $kilometre):void
    {
        $this->kilometre += $kilometre;
    }
}