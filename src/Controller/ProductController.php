<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\CommentType;
use App\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
                'products' => $this->getDoctrine()->getRepository(Product::class)->findAll(),
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

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

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
     * @param Request $request
     * @param int     $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request, int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        $commentForm = $this->createForm(CommentType::class);
        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();
            $comment->setProduct($product);

            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product', ['id' => $product->getId()]);
        }

        return $this->render(
            'Product/get.html.twig',
            [
                'product'      => $product,
                'comment_form' => $commentForm->createView(),
            ]
        );
    }
}
