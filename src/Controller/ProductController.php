<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'create_product')]
    public function createProduct(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $product = new Product();
        $product->setName('iphone');
        $product->setPrice(1019.50);
        $product->setDescription('smartphone');
        $product->setBarcode("9254455558");

        
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    // #[Route('/product/{id}', name: 'product_show')]
    // public function show(ManagerRegistry $doctrine, int $id): Response
    // {
    //     $product = $doctrine->getRepository(Product::class)->find($id);

    //     if (!$product) {
    //         throw $this->createNotFoundException(
    //             'No product found for id '.$id
    //         );
    //     }

    //     return new Response('Check out this great product: '.$product->getName());

    //     // or render a template
    //     // in the template, print things with {{ product.name }}
    //     // return $this->render('product/show.html.twig', ['product' => $product]);
    // }
    #[Route('/product/new', name: 'product_show')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setName('sans nom');
       

        $formbuilder = $this->createFormBuilder($product);
        $formbuilder->add('name', TextType::class);
        $formbuilder->add('price', MoneyType::class);
        $formbuilder->add('description',TextareaType::class);
        $formbuilder->add('barcode', TextType::class);
        $formbuilder->add('save', SubmitType::class, ['label' => 'Create Product']);
        $form=$formbuilder->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $product = $form->getData();

            // ... perform some action, such as saving the task to the database
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_show');
        }
        return $this->renderForm('product/new.html.twig', [
            'form' => $form,
        ]);
    }
    
}