<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class ProductController extends Controller
{
    /**
     * @Route(path="/products", name="products")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        return $this->render(
            'Product/list.html.twig',
            [
                'products' => $this->getDoctrine()->getRepository(Product::class)->findAll()
            ]
        );
    }


    /**
     * @Route(path="/products/new", name="product_new")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $product = $form->getData();
            $file    = $product->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('kernel.root_dir') . '/../public/uploads',
                $fileName
            );

            $product->setImage($fileName);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('Product/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(path="/products/{id}", name="product")
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(int $id)
    {
        return $this->render(
            'Product/get.html.twig',
            [
                'product' => $this->getDoctrine()->getRepository(Product::class)->find($id)
            ]
        );
    }
}
