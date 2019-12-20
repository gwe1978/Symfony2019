<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test/exemple", name="test_exemple")
     * @Route("/helloworld", name="helloworld1")
     * @return Response
     */
    function exemple(){
        return $this->render('test/exemple.html.twig');
    }

    /**
     * @Route("/test/exemple2", name="test_exemple2")
     * @return Response
     */
    function exemple2(){
        $chaine = 'controleur';
        $calcul = 120 ;

        $tableau = [10, 20, 30, 40, 50];

        return $this->render('test/exemple2.html.twig',
            [ 'var1' => $chaine, 'var2' => 'azerty', 'var3' => $calcul,
                'tableau' => $tableau ]);
    }
}