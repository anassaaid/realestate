<?php

namespace AppBundle\Event;

use AppBundle\Entity\Book;
use Symfony\Component\EventDispatcher\Event;

class BookEvent extends Event
{
    const CREATE_BOOK_SUCCESS = 'app.book.create.success';

    /**
     * @var Book
     */
    private $book;

    /**
     * BookEvent constructor.
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

}