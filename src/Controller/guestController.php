<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Orders;
use App\Entity\Products;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GuestController extends AbstractController
{
    #[Route('/home', name: 'home_page')]
    public function index(EntityManagerInterface $em): Response
    {
        $categories = $em->getRepository(Categories::class)->findAll();
        return $this->render('guest/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('/category/{id}', name: 'category_page')]
    public function cotton(EntityManagerInterface $entityManager, int $id): Response
    {
        // Assuming you have a Category entity, modify the logic to fetch products related to the category.
        $category = $entityManager->getRepository(Categories::class)->find($id);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id ' . $id
            );
        }

        return $this->render('guest/cotton.html.twig', [
            'controller_name' => 'GuestController',
            'category' => $category,
        ]);
    }

    #[Route('/product/{id}', name: 'product_page')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Products::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('guest/index.html.twig', ['product' => $product]);
    }
    #[Route('/story',    name: 'story_page')]
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
    #[Route ('/order/{id}' ,name: 'order_page')]
    public function order(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = $form->getData();
            $product = $em->getRepository(Products::class)->find($id);
            $order->setProduct($product);
            $em->persist($order);
            $em->flush();

            // Redirect to a success page or show a success message
            return $this->redirectToRoute('show_order');
        }

        return $this->render('guest/order.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/showOrder', name: 'show_order')]
    public function showOrder(EntityManagerInterface $em): Response
    {
        $orders = $em->getRepository(Orders::class)->findAll();
        return $this->render('guest/showOrder.html.twig', [
            'orders' => $orders
        ]);
    }
    #[Route('/product/delete/{id}', name: 'delete_product')]
    public function deleteProduct(EntityManagerInterface $em,int $id): Response
    {
        $order = $em->getRepository(Orders::class)->find($id);
        $em->remove($order);
        $em->flush();

        $this->addFlash('success', 'Product deleted');

        return $this->redirectToRoute('home_page');
    }

}
