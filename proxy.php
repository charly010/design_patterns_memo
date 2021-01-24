<?php

/**
 * Interface ImageInterface
 */
interface ImageInterface
{
    public function display();
}

/**
 * Class Image
 */
class Image implements ImageInterface
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * Image constructor.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->load($fileName);
    }

    /**
     * @inheritdoc
     */
    public function display()
    {
        echo "Affichage de l'image : {$this->fileName}";
    }

    /**
     * @param string $fileName
     */
    private function load(string $fileName)
    {
        // Ici se trouve le code de chargement de l'image
        echo "Chargement de l'image : $fileName";
    }
}

/**
 * Class ImageProxy
 */
class ImageProxy implements ImageInterface
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var Image
     */
    private $image;

    /**
     * ImageProxy constructor.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @inheritdoc
     */
    public function display()
    {
        if (!$this->image) {
            $this->image = new Image($this->fileName);
        }

        $this->image->display();
    }
}

$imageProx = new ImageProxy('/home/images/77.png');
$imageProx->display(); 
$imageProx->display(); 
// Chargement de l'image : /home/images/77.png
// Affichage de l'image : /home/images/77.png
// Affichage de l'image : /home/images/77.png

// source
// https://www.christophe-meneses.fr/article/exemple-d-utilisation-du-proxy
