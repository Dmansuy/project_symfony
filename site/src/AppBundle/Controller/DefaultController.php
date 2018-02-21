<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/hello-{name}", name="hello")
     * @param $name
     * @return Response
     */
    public function HelloWorld($name)
    {
        return $this->render('default/hello-world.html.twig', ['name' => $name]);
    }

    /**
     * @Route ("/calc-{number1}-{number2}", name="calc")
     * @param $number1
     * @param $number2
     * @return Response
     */
    public function calc($number1, $number2)
    {
        return $this->render('default/calc.html.twig', [
            'result' => $number1 + $number2
        ]);
    }
}
