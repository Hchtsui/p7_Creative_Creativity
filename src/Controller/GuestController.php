<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GuestController extends AbstractController
{
    #[Route('/home', name: 'home_page')]
    public function index(): Response
    {
        return $this->render('guest/index.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/cotton', name: 'cotton_page')]
    public function cotton(): Response
    {
        return $this->render('guest/cotton.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/bio', name: 'bio_page')]
    public function bio(): Response
    {
        return $this->render('guest/bio.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/wool', name: 'wool_page')]
    public function wool(): Response
    {
        return $this->render('guest/wool.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/story', name: 'story_page')]
    public function story(): Response
    {
        return $this->render('guest/story.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/mission', name: 'mission_page')]
    public function mission(): Response
    {
        return $this->render('guest/mission.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/team', name: 'team_page')]
    public function team(): Response
    {
        return $this->render('guest/team.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }
    #[Route('/contact', name: 'contact_page')]
    public function contact(): Response
    {
        return $this->render('guest/contact.html.twig', [
            'controller_name' => 'GuestController',
        ]);
        }
}
