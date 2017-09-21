<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class HomepageController extends Controller
{
    /**
     * @Route(path="/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(
            'Homepage/index.html.twig',
            ['last_products' => $this->get('doctrine')->getRepository(Product::class)->getLasts()]
        );
    }

    public function showCategoriesAction()
    {
        return $this->render(
            'Homepage/categories.html.twig',
            [
                'categories' => $this->getDoctrine()->getRepository(Category::class)->findAll()
            ]
        );
    }
}
