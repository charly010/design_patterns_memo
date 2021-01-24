<?php

interface WriterInterface
{
    public function write($data);
}

class FileWriter implements WriterInterface
{
    public function write($data)
    {
        // On écrit le code nécessaire pour envoyer les données dans un fichier
        echo('Envoie des données dans un fichier.');
    }
}

class DatabaseWriter implements WriterInterface
{
    public function write($data)
    {
        // On écrit le code nécessaire pour envoyer les données dans une base de données
        echo('Envoie des données dans une base de données.');
    }
}

class APIWriter implements WriterInterface
{
    public function write($data)
    {
        // On écrit le code nécessaire pour envoyer les données vers une API
        echo('Envoie des données vers une API.');
    }
}

class ClientWriter
{
    private $writer;

    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    public function write($data)
    {
        $this->writer->write($data);
    }
}

$data = ['data1', 'data2', 'data3'];

// On peut écrire dans un fichier
$clientFileWriter = new ClientWriter(new FileWriter());
$clientFileWriter->write($data);

// ou en base de données
$clientDatabaseWriter = new ClientWriter(new DatabaseWriter());
$clientDatabaseWriter->write($data);

// ou envoyer à une API
$clientAPIWriter = new ClientWriter(new APIWriter());
$clientAPIWriter->write($data);

// source
// https://www.christophe-meneses.fr/article/exemple-d-utilisation-de-la-strategie-strategy