<?php

namespace App\Controller;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
