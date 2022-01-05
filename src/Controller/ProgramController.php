<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program/', name: 'program_')]

class ProgramController extends AbstractController
{
    #[Route('{id}', methods: ['get'], name: 'show',  requirements: ['id' => '\d+'])]
    public function show(int $id = 1): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id
        ]);
    }
    #[Route('{param}', methods: ['get'], requirements: ['param' => '.*'], name: 'notResponse')]
    public function notResponse(): Response
    {
        return $this->render('program/404.html.twig', []);
    }
}
