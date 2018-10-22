<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @var \App\Repository\BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/", name="books")
     */
    public function index()
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
            'books' => $this->bookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="add_book")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(): RedirectResponse
    {
        $book = new Book();
        $book->setName('new name ' . time());

        $this->bookRepository->storeEntity($book);

        return $this->redirect($this->generateUrl('books'));
    }
}
