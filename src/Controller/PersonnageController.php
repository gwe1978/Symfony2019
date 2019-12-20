<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController
{
    /**
 * @Route("/personnage", name="perso")
 * @Route("/personnage/index", name="perso_index")
 * @return mixed
 */
    function index(SessionInterface $session){

        $erreur = $session->get('erreur');
        /*if ($erreur == 1) {
            throw $this->createNotFoundException('Une erreur a été rencontrée');
        }*/

        return $this->render('personnage/index.html.twig', [
            'erreur' => $erreur
        ]);
    }

    /**
     * @Route("/personnage/ajouter", name="perso_ajouter")
     * @return mixed
     */
    function ajouter(Request $request, SessionInterface $session){
        $personnage = array();
        $personnage['nom']    = $request->request->get('nom');
        $personnage['niveau'] = $request->request->get('niveau');
        $personnage['classe'] = $request->request->get('classe');
        if(empty($personnage['nom']))
        {
            $url = $this->generateUrl('perso_index');
            $session->set('erreur', 1);

            $this->addFlash(
                'message',
                'Problème avec le nom du personnage'
            );

            $this->addFlash(
                'message',
                'Problème avec le niveau'
            );

            return new RedirectResponse($url);
        }
        return $this->render('personnage/ajouter.html.twig', [
            'personnage' => $personnage
        ]);
    }
}