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
     * @Route(path="/products")
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
}
