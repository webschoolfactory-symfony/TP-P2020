<?php

namespace App\Controller;

use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Yohan Giarelli <yohan@un-zero-un.fr>
 */
class CategoryController extends Controller
{
    /**
     * @Route("/categories/{id}", name="category")
     *
     * @param Category $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Category $category)
    {
        return $this->render('Category/get.html.twig', ['category' => $category]);
    }
}
