<?php

/**
 * Interface BookInterface
 */
interface BookInterface
{
    /**
     * Open the book.
     */
    public function open();

    /**
     * Turn the page.
     */
    public function turnPage();

    /**
     * Get the page number.
     *
     * @return int
     */
    public function getPage(): int;
}

/**
 * Class Book
 */
class Book implements BookInterface
{
    /**
     * @var int
     */
    private $page;

    /**
     * @inheritdoc
     */
    public function open()
    {
        $this->page = 1;
    }

    /**
     * @inheritdoc
     */
    public function turnPage()
    {
        $this->page++;
    }

    /**
     * @inheritdoc
     */
    public function getPage(): int
    {
        return $this->page;
    }
}

/**
 * Interface EBookInterface
 */
interface EBookInterface
{
    /**
     * Unlock the ebook.
     */
    public function unlock();

    /**
     * Go to the next page.
     */
    public function pressNext();

    /**
     * Returns current page and total number of pages, like [10, 100] is page 10 of 100.
     *
     * @return int[]
     */
    public function getPage(): array;
}

/**
 * Class EBook
 */
class EBook implements EBookInterface
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $totalPages = 100;

    /**
     * @inheritdoc
     */
    public function unlock()
    {
    }

    /**
     * @inheritdoc
     */
    public function pressNext()
    {
        $this->page++;
    }

    /**
     * @inheritdoc
     */
    public function getPage(): array
    {
        return [$this->page, $this->totalPages];
    }
}

/**
 * Class EBookAdapter
 */
class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    private $eBook;

    /**
     * EBookAdapter constructor.
     *
     * @param EBookInterface $eBook
     */
    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    /**
     * @inheritdoc
     */
    public function open()
    {
        $this->eBook->unlock();
    }

    /**
     * @inheritdoc
     */
    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    /**
     * @inheritdoc
     */
    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}

// ça s'utilise comme ça
$eBookAdapter = new EBookAdapter(new EBook()); 