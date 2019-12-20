<?php


namespace App\Controller;


use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Exercice07Controller extends AbstractController
{
    private $etudiantRepository;
    private $sectionRepository;

    function __construct(EtudiantRepository $etudiantRepository, SectionRepository $sectionRepository){
        $this->etudiantRepository = $etudiantRepository;
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @Route("/exercice07"      , name="exercice07"      )
     * @Route("/exercice07/index", name="exercice07_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function index(Request $request){
        $section = $request->query->get('section');

        $tab_sections = $this->sectionRepository->findAllSections();
        $tab = $this->etudiantRepository->findEtudiantsBySection($section);

        return $this->render('exercice07/index.html.twig', [
            'tab_sections'  => $tab_sections,
            'tab' => $tab
        ]);
    }

    /**
 * @Route("/exercice07/etape04", name="ex0704")
 * @return \Symfony\Component\HttpFoundation\Response
 */
    function etape04(){
        $tab = $this->etudiantRepository->findAllEtudiants();

        return $this->render('exercice07/etape04.html.twig', [
            'tab' => $tab
        ]);
    }

    /**
     * @Route("/exercice07/etape05", name="ex0705")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function etape05(){
        $tab = $this->etudiantRepository->findEtudiantsBySection("Informatique");

        return $this->render('exercice07/etape04.html.twig', [
            'tab' => $tab
        ]);
    }

    /**
     * @Route("/exercice07/etape06", name="ex0706")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function etape06(Request $request){
        $section = $request->query->get('section');
        $tab = $this->etudiantRepository->findEtudiantsBySection($section);

        return $this->render('exercice07/etape04.html.twig', [
            'tab' => $tab
        ]);
    }

    /**
     * @Route("/exercice07/etape07", name="ex0707")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function etape07(){
        $tab_sections = $this->sectionRepository->findAllSections();
        return $this->render('exercice07/etape07.html.twig', [
            'tab_sections' => $tab_sections
        ]);
    }

    /**
     * @Route("/exercice07/etape08/{id}", name="ex0708")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function etape08($id){
        $etudiant = $this->etudiantRepository->findEtudiantsById($id);

        return $this->render('exercice07/etape08.html.twig', [
            'etudiant' => $etudiant
        ]);
    }

    /**
     * @Route("/exercice07/etape11", name="ex0711")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function etape11(){
        $section = $this->sectionRepository->findBySection("Informatique");
        $etudiant = new Etudiant();
        $etudiant->setNom("IEPSCF");
        $etudiant->setPrenom("IEPSCF");
        $etudiant->setSection($section);
        $em = $this->getDoctrine()->getManager();
        $em->persist($etudiant);
        $em->flush();

        return $this->render('exercice07/etape08.html.twig', [
            'etudiant' => $etudiant
        ]);
    }
}