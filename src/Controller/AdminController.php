<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\SearchCar;
use App\Form\CarType;
use App\Form\SearchCarType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function getAll(CarRepository $carRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $searchCar = new SearchCar();

        $form = $this->createForm(SearchCarType::class, $searchCar);
        $form->handleRequest($request);

        $cars = $paginator->paginate(
            $carRepository->findAllWithPagination($searchCar), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );

        return $this->render('car/cars.html.twig', [
            "cars" => $cars,
            "form" => $form->createView(),
            "admin" => true,
        ]);
    }


    #[Route('/admin/creation', name: 'app_create_car')]
    #[Route('/admin/{id}', name: 'app_update_car')]
    public function update(Car $car = null, Request $request, ManagerRegistry $managerRegistry): Response
    {
        if(!$car){
            $car = new Car();
        }

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $managerRegistry->getManager()->persist($car);
            $managerRegistry->getManager()->flush();

            $this->addFlash("success", "La modification a bien été effectuée.");
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/updateCar.html.twig', [
            "car" => $car,
            "form" => $form->createView(),

        ]);
    }



}