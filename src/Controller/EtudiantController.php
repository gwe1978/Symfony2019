<?php


namespace App\Controller;


use App\Repository\EtudiantRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    private $etudiantRepository;
    private $sectionRepository;

    function __construct(EtudiantRepository $etudiantRepository, SectionRepository $sectionRepository){
        $this->etudiantRepository = $etudiantRepository;
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @Route("/etudiant"      , name="etud"      )
     * @Route("/etudiant/index", name="etud_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function index(Request $request){
        $section = $request->query->get('section');

        $tab_sections = $this->sectionRepository->findAllSections();
        $tab = $this->etudiantRepository->findEtudiantsBySection($section);

        return $this->render('etudiant/index.html.twig', [
            'tab_sections'  => $tab_sections,
            'tab' => $tab
        ]);
    }

}