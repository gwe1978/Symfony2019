<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExempleController extends AbstractController
{
    /**
     * @Route("/exemple/a", name="exemple_a")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function a(){
        $a = 50;
        $b = 20;
        $nbr = $a+$b;

        return $this->render('exemple/a.html.twig', [
            'var1' => 123,
            'var2' => "ppppppp",
            'var3' => $nbr
        ]);
    }

    /**
     * @Route("/exemple/b", name="exemple_b")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function b(){
        return $this->render('exemple/b.html.twig');
    }

    /**
     * @Route("/exemple/c", name="exemple_c")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function c(){
        return $this->render('exemple/c.html.twig');
    }
}