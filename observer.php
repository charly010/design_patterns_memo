<?php

class Article
{
    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}

class ArticleManager implements SplSubject
{
    /**
     * @var Article
     */
    private $article;

    /**
     * SplObjectStorage pour s'assurer de l'unicité des observateurs.
     *
     * @var SplObjectStorage
     */
    protected $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * @inheritdoc
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * @inheritdoc
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * @inheritdoc
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Crée un article dans la base de données et alerte les observateurs.
     *
     * @param Article $article
     */
    public function create(Article $article)
    {
        $this->article = $article;

        // Ici dans un cas réel, la méthode va insérer l'article en base

        // Une fois tous les traitements effectués, on alerte les observateurs
        $this->notify();
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}

class Notify implements SplObserver
{
    /**
     * @inheritdoc
     */
    public function update(SplSubject $subject)
    {
        echo("La classe Notify a été alerté. L'article '" . $subject->getArticle()->getTitle() . "' a été crée.</br>");

        // Ici dans un cas réel, on envoie un e-mail à tous les utilisateurs avec un lien vers le nouvel article
    }
}

class SearchEngine implements SplObserver
{
    /**
     * @inheritdoc
     */
    public function update(SplSubject $subject)
    {
        echo("La classe SearchEngine a été alerté. L'article '" . $subject->getArticle()->getTitle() . "' a été crée.</br>");

        // Ici dans un cas réel, on indexe le nouvel article
    }
}

// test
$notify = new Notify();
$searchEngine = new SearchEngine();

$articleManager = new ArticleManager();
$articleManager->attach($notify);
$articleManager->attach($searchEngine);

$article = new Article();
$article->setTitle('Observer');

$articleManager->create($article);