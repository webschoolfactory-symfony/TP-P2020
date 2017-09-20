<?php

namespace App\Controller;

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
        $this->get('doctrine')->getRepository(Product::class)->findAll();

        return $this->render('Homepage/index.html.twig');
    }

    /**
     * @Route(path="/hello/{name}", name="hello")
     *
     * @param string $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function helloAction($name)
    {
        return $this->render('Homepage/hello.html.twig', ['name' => $name]);
    }
}
