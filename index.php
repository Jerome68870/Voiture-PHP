<?php
declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use App\Voiture\Voiture;
use App\Exceptions\VoitureException;
use App\Reservoir\Reservoir;
use App\Option\BoiteAuto;
use App\Option\PeintureMetal;
use App\Option\InterieurCuir;
use App\Compteur\Compteur;


function affichage ($voiture):void
{
    echo "<h4>Achat ".$voiture->getModel()."</h4><ul>";
    echo "<li>Prix de base ".$voiture->getPrixVoiture()."€</li>";
    echo "<li>La ".$voiture->getModel()." consomme ".$voiture->getconsommationParKilometre()."L</li>";
    echo "</ul>";
}
function affichageCompteur ($kilometre):void
{
    echo "<h4>Le vehicule a parcouru ".$kilometre." km.</h4>";
} 

$golfGTD = new Voiture("golf GTD",27000,6.2);
affichage($golfGTD);
try{
    // $golfGTD->parcourirUneDistance(100);  // test 
    $reservoirGolfGTDDiesel = new Reservoir(55);
    $golfGTD->ajouteReservoir($reservoirGolfGTDDiesel);
    // $golfGTD->parcourirUneDistance(100); // test 2
    $compteurGolfGTDDiesel = new Compteur(22000);
    $golfGTD->ajouteCompteur($compteurGolfGTDDiesel);
    affichageCompteur($golfGTD->getCompteur()->interrogeKilometrage());
    $boiteAutoGolf = new boiteAuto(1800,"Boite Automatique");
    $golfGTD->ajouteOption($boiteAutoGolf);
    $peintureMetalGolf = new peintureMetal(1500,"Peinture metal");
    $golfGTD->ajouteOption($peintureMetalGolf);
    $interieurCuirGolf = new interieurCuir(2000,"Interieur cuir");
    $golfGTD->ajouteOption($interieurCuirGolf);
    $golfGTD->printOptions();
    $golfGTD->calculePrix();
    $golfGTD->estimationDistancePossible();
    $reservoirGolfGTDDiesel->ajouteCarburant(55);
    $golfGTD->estimationDistancePossible();
    $golfGTD->parcourirUneDistance(500);
    affichageCompteur($golfGTD->getcompteur()->interrogeKilometrage());
    $golfGTD->estimationDistancePossible();
    echo "<h4>Le reservoir contient {$golfGTD->getReservoir()->interrogeCarburant()}L/{$golfGTD->getReservoir()->getCapacite()}L.<h4>";
    $golfGTD->parcourirUneDistance(250);
    affichageCompteur($golfGTD->getCompteur()->interrogeKilometrage());
    $golfGTD->estimationDistancePossible();
    // $golfGTD->parcourirUneDistance(100); // test 3
}
catch (VoitureException $error){
    echo "Voiture Exception ".$error->getMessage()."<br>";
    echo $error->__toString()."<br>";
}
catch (Exception $error){
    echo $error->getMessage()."<br>";
}
dump($golfGTD);
?>