<?php

abstract class Coffee implements CoffeeInterface
{
    protected $description = 'Café';
 
    public function getDescription() {
        return $this->description;
    }
}

interface CoffeeInterface {
    public function getDescription();
}

class Expresso extends Coffee implements CoffeeInterface
{
    public function getDescription() {
        
        $content = parent::getDescription();

        return $content. ' expresso';
    }
}

class CaramelDecorator implements CoffeeInterface {
    private $coffee;

    public function __construct(CoffeeInterface $coffee) {
        $this->coffee = $coffee;
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ' supplément caramel';
    }
}

class SucreDecorator implements CoffeeInterface {
    private $coffee;

    public function __construct(CoffeeInterface $coffee) {
        $this->coffee = $coffee;
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ' avec du sucre';
    }
}

$expresso = new Expresso;
echo $expresso->getDescription(); //Café expresso

echo '</br>';

$expressoSucre = new SucreDecorator($expresso);
echo $expressoSucre->getDescription(); // Café expresso avec du sucre

echo '</br>';

$expressoCaramel = new CaramelDecorator($expresso);
echo $expressoCaramel->getDescription();// Café expresso supplément caramel

echo '</br>';

$expressoCaramelSucre = new SucreDecorator($expressoCaramel);
echo $expressoCaramelSucre->getDescription();// Café expresso supplément caramel avec du sucre
