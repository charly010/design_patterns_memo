<?php

class Facade
{
    private Car $car;
    public function __construct(Car $car)
    {
        $this->car = $car;
    }
    public function turnOn()
    {
        $this->car->open();
        $this->car->check();
        $this->car->start();
        $this->car->run();
    }
}

interface Car
{
    public function open();
    public function check();
    public function start();
    public function run();
}


/*
Nous devons considérer l’utilisation du pattern Facade dans les cas 
où le code que nous voulons utiliser se compose de plusieurs classes et méthodes, 
et tout ce que nous voulons, c’est une interface simple, de préférence une méthode, 
qui peut faire tout le travail pour nous.
*/