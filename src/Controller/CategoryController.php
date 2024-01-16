<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Category;
use App\Form\CategoryType;
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
     *  @Route("/category/add", name="app_category_add")
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {

        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'app_category',
                    array('id' => $category->getId())
                )
            );
        }

        return $this->renderForm('category/form.html.twig', [
            'titulo' => 'Adicionar uma categoria',
            'form' => $form
        ]);
    }

    /**
     * @route("/category/update/{id}", name="app_category_update")
     */
    public function update(Request $request, CategoryRepository $categoryRepository, $id, EntityManagerInterface $em): Response
    {
        $category = $categoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'app_category',
                    array('id' => $category->getId())
                )
            );
        }

        return $this->renderForm('category/form.html.twig', [
            'titulo' => 'Editar categoria',
            'form' => $form
        ]);
    }

    /**
     * @route("/category/delete/{id}", name="app_category_delete")
     */
    public function delete(CategoryRepository $categoryRepository, $id, EntityManagerInterface $em): Response
    {
        $category = $categoryRepository->find($id);
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('app_category');
    }
}
