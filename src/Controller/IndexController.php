<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController {
    /**
     * @Route("/")
     */
    public function home() {

        $year = random_int(0,100);

        return $this -> render('index.html.twig', ['year' => $year]);
    }
}