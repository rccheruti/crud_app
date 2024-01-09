<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="app_category")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $data = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'data' => $data
        ]);
    }

    /**
     * @Route("/category/new", name="app_category_new") 
     */
    public function create(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/register.html.twig', [
            'controller_name' => 'CategoryController',
            'data' => 'Ok'
        ]);
    }
}
