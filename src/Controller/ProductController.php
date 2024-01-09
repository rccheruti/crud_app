<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $data = $productRepository->findAll();
        // return $this->json($data);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'data' => $data
        ]);
    }

    /**
     *  @Route("/product/new", name="app_product_new")
     */
    public function create(): Response
    {
        return $this->render('product/register.html.twig');
    }

    /**
     * @route("/product/update/{id}", name="app_product_update", methods={"GET","PUT"})
     */
    public function update(ProductRepository $productRepository, $id): Response
    {
        return $this->json(['message' => 'update ok', 'id' => $id]);
    }

      /**
     * @route("/product/delete/{id}", name="app_product_delete")
     */
    public function delete(ProductRepository $productRepository, $id): Response
    {
        return $this->json(['message' => 'delete ok', 'id' => $id]);
    }
}
