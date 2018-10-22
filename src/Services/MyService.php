<?php
/**
 * Created by PhpStorm.
 * User: wunder
 * Date: 22.10.2018
 * Time: 21:07
 */

namespace App\Services;


use App\Entity\Book;
use App\Repository\BookRepository;

class MyService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function store(Book $book)
    {
        $this->bookRepository->storeEntity($book);
    }
}