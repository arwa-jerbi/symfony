<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Auteur;

final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(EntityManagerInterface $em): Response
    {
        $authors = $em->getRepository(Auteur::class)->findAll(); // use Auteur::class
        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/author/add/static', name: 'app_author_add_static')] 
    public function addStatic(EntityManagerInterface $em): Response
    {
       $a = new Auteur(); // French entity
       $a->setNom('asma');
       $a->setEmail('asma@gmail.com');
       $em->persist($a);
       $em->flush(); 

       return $this->redirectToRoute('app_author');
    }
}


/*final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

     #[Route('/showAuthor/{name}', name: 'showAuthor')]
    public function showAuthor(string $name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/listAuthors', name: 'listAuthors')]
    public function listAuthors(): Response
    {
       $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-hugo.jpeg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/TahaHussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
);

        $totalbooks =array_sum(array_column($authors, 'nb_books'));

    return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalbooks' => $totalbooks,
    ]); 
 
       
    }

   #[Route('/authorDetails/{id}', name: 'authorDetails')]
    public function authorDetails(int $id): Response
    {
         $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-hugo.jpeg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpeg', 'username' => ' William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/TahaHussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        $author = $authors[$id - 1] ?? null;

        if (!$author) {
            throw $this->createNotFoundException('Auteur non trouvé');
        }
        return $this->render('author/showAuthor.html.twig', [
           'author' => $author,
        ]);
    }


}*/
