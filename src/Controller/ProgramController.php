<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    private $programRepository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $programs = $this->programRepository->findAll();

        return $this->render('program/index.html.twig', compact('programs'));
    }

    #[Route('/{id}', methods: ['get'], requirements: ['id' => '\d+'], name: 'show')]
    public function show(int $id): Response
    {
        $program = $this->programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', compact('program'));
    }

    #[Route('{param}', methods: ['get'], requirements: ['param' => '.*'], name: 'notResponse')]
    public function notResponse(): Response
    {
        return $this->render('program/404.html.twig', []);
    }
}
