<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Service\DateCalculator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HotelRepository;


class IndexController extends AbstractController {

    private const HOTEL_OPENED = 1969;

    /**
     * @Route("/")
     */
    public function home(LoggerInterface $logger, DateCalculator $dateCalculator) {

        $logger -> info( message: 'Homepage Loaded.' );

        $year = $dateCalculator -> yearsDifference( year: self::HOTEL_OPENED );

        $hotels = $this -> getDoctrine()
            -> getRepository( persistentObject: Hotel::class )
            -> findAllBelowPrice(1000);

        $images = [
            ['url' => 'images/hotel/intro_room.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_pool.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_dining.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_attractions.jpg', 'class' => ''],
            ['url' => 'images/hotel/intro_wedding.jpg', 'class' => '']
        ];

        return 
            $this -> render('index.html.twig', 
                ['year' => $year, 'images' => $images, 'hotels' => $hotels]
        );
    }
}