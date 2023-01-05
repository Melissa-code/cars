<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/client/voitures', name: 'app_cars')]
    public function getAll(CarRepository $carRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $cars = $paginator->paginate(
            $carRepository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('car/cars.html.twig', [
            "cars" => $cars
        ]);
    }
}
