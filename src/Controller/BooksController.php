<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Services\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    private $myService;
    private $bookRepository;

    public function __construct(MyService $myService, BookRepository $bookRepository)
    {
        $this->myService = $myService;
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

        $this->myService->store($book);

        return $this->redirect($this->generateUrl('books'));
    }
}
