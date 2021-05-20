<?php
declare(strict_types=1);

namespace App\Option;

class Option{

    private int $prix;
    private string $description;

    public function __construct(int $prix, string $description)
    {
        $this->prix = $prix;
        $this->description = $description;
    }
    public function getDescription():string{
     return $this->description;
    }
    public function setDescription(string $description){
        $this->description=$description;
   }
    public function interrogePrix():int
    {
        return $this->prix;
    }

}

?>