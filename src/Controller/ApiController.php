<?php


namespace App\Controller;

use App\Entity\Hotel;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/rooms")
     */
    public function home()
    {
        $hotels = $this -> getDoctrine()
            -> getRepository(Hotel::class)
            -> findAll();
        return $this->json(['hotels' => $hotels]);
    }
}