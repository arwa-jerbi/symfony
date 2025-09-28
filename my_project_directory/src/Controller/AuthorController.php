<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    private function getAuthorsData(): array
    {
        return [
            [
                'id' => 1,
                'picture' => '/images/Victor-Hugo.webp',
                'username' => 'Victor Hugo',
                'email' => 'victor.hugo@gmail.com',
                'nb_books' => 100
            ],
            [
                'id' => 2,
                'picture' => '/images/william-shakespeare.jpeg',
                'username' => 'William Shakespeare',
                'email' => 'william.shakespeare@gmail.com',
                'nb_books' => 200
            ],
            [
                'id' => 3,
                'picture' => '/images/Taha_Hussein.jpg',
                'username' => 'Taha Hussein',
                'email' => 'taha.hussein@gmail.com',
                'nb_books' => 300
            ]
        ];
    }

    #[Route('/authors', name: 'authors_list')]
    public function list(): Response
    {
        $authors = $this->getAuthorsData();

        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }

    #[Route('/author/details/{id}', name: 'author_details')]
    public function authorDetails(int $id): Response
    {
        $authors = $this->getAuthorsData();

        // Recherche de l'auteur correspondant à l'id
        $author = null;
        foreach ($authors as $a) {
            if ($a['id'] === $id) {
                $author = $a;
                break;
            }
        }

        if (!$author) {
            throw $this->createNotFoundException('Auteur non trouvé.');
        }

        return $this->render('author/showAuthor.html.twig', [
            'author' => $author
        ]);
    }
}