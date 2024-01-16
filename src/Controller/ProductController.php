<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Product;
use App\Entity\Category;

use App\Repository\ProductRepository;
use App\Form\ProductType;

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
     *  @Route("/product/new", name="app_product_add")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product;

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect($this->generateUrl('app_product', array('id' => $product->getId())));
        }

        return $this->renderForm(
            'product/form.html.twig',
            [
                'titulo' => 'Cadastro de produtos',
                'form' => $form
            ]
        );
    }

    /**
     * @route("/product/update/{id}", name="app_product_update")
     */
    public function update(Request $request, EntityManagerInterface $em, ProductRepository $productRepository, $id): Response
    {
        $product = $productRepository->find($id);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('app_product', array('id' => $product->getId())));

        }

        return $this->renderForm(
            'product/form.html.twig',
            [
                'titulo' => 'Cadastro de produtos',
                'form' => $form
            ]
        );
    }

    /**
     * @route("/product/delete/{id}", name="app_product_delete")
     */
    public function delete(ProductRepository $productRepository, $id, EntityManagerInterface $em): Response
    {
        $product = $productRepository->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('app_product');
    }
}
