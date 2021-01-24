<?php

/**
 * iterator est un design pattern qui permet de parcourir une structure de données complexe sans exposer ses détails internes.
 *
 * Le pattern Iterator est très courant en PHP. De nombreux frameworks et bibliothèques l’utilisent pour fournir un moyen standard de parcourir leurs collections.
 * 
 */

class Car
{
    private string $name;
    private string $model;
    public function __construct(string $name, string $model)
    {
        $this->name = $name;
        $this->model = $model;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getModel(): string
    {
        return $this->model;
    }
    public function getNameAndModel(): string
    {
        return $this->getName().' & '.$this->getModel();
    }
}

class CarListIterator implements \Countable, \Iterator
{
    private array $cars = [];
    private int $i = 0;
    public function addCar(Car $car)
    {
        $this->cars[] = $car;
    }
    public function removeCar(Car $car_in)
    {
        foreach ($this->cars as $key => $car) {
            if ($car->getNameAndModel() === $car_in->getNameAndModel()) {
                unset($this->cars[$key]);
            }
        }
        $this->cars = array_values($this->cars);
    }
    public function count(): int
    {
        return count($this->cars);
    }
    public function current(): Car
    {
        return $this->cars[$this->i];
    }
    public function key(): int
    {
        return $this->i;
    }
    public function next()
    {
        $this->i++;
    }
    public function rewind()
    {
        $this->i = 0;
    }
    public function valid(): bool
    {
        return isset($this->cars[$this->i]);
    }
}

// code de test

$carList = new CarListIterator();
$carList->addCar(new Car('Audi', 'A7'));
$carList->addCar(new Car('Bmw', 'X25'));
$carList->addCar(new Car('Mercedes', 'Classe C'));
$cars = [];
foreach ($carList as $car) {
  $cars[] = $car->getNameAndModel();
}