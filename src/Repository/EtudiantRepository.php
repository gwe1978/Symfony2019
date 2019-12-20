<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    private $sectionRepository;

    public function __construct(ManagerRegistry $registry, SectionRepository $sectionRepository)
    {
        parent::__construct($registry, Etudiant::class);
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @return Etudiant[] Returns an array of Etudiant objects
     */
    public function findAllEtudiants(){
        return $this->createQueryBuilder('e')
            ->orderBy('e.nom', 'ASC')
            ->orderBy('e.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return Etudiant
     */
    public function findEtudiantsById($id) : ?Etudiant{
         $tab_etudiants = $this->createQueryBuilder('e')
             ->andWhere('e.id = :id')
             ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

         if($tab_etudiants==null){
             return null;
         }else{
             return $tab_etudiants[0];
         }
    }

    public function findEtudiantsBySection($nomSection){
        //$section = $this->sectionRepository->findBySection($nomSection);
        /*$section = $this->sectionRepository->createQueryBuilder('s')
            ->andWhere('s.nom = :val')
            ->setParameter('val', $nomSection)
            ->getQuery()
            ->getResult();*/

        $section = $this->sectionRepository->findOneBy(array("nom" => $nomSection));

        return $this->createQueryBuilder('e')
            ->andWhere('e.section = :val')
            ->setParameter('val', $section)
            ->orderBy('e.nom', 'ASC')
            ->orderBy('e.prenom', 'ASC')
            ->getQuery()
            ->getResult();

        /*
        $id = $this->sectionRepository->createQueryBuilder('s')
            ->andWhere('s.nom = :val')
            ->setParameter('val', $section)
            ->getQuery()
            ->getResult();

        return $this->createQueryBuilder('e')
            ->andWhere('e.section = :val')
            ->setParameter('val', $id[0])
            ->orderBy('e.nom', 'ASC')
            ->orderBy('e.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    */
    }

    public function AddSection($nomSection){
        //$section = $this->sectionRepository->findBySection($nomSection);
        /*$section = $this->sectionRepository->createQueryBuilder('s')
            ->andWhere('s.nom = :val')
            ->setParameter('val', $nomSection)
            ->getQuery()
            ->getResult();*/

        $section = $this->sectionRepository->findOneBy(array("nom" => $nomSection));

        return $this->createQueryBuilder('e')
            ->andWhere('e.section = :val')
            ->setParameter('val', $section)
            ->orderBy('e.nom', 'ASC')
            ->orderBy('e.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    }
/*
    public function AddEtudiant($nom, $prenom, $nomSection){

        $section = $this->sectionRepository->findBySection("Informatique");
        $etudiant = new Etudiant();
        $etudiant->setNom("IEPSCF");
        $etudiant->setPrenom("IEPSCF");
        $etudiant->setSection($section);

        $em = $this->getDoctrine()->getManager();
        $em->persist($etudiant);
        $em->flush();

        $section = $this->sectionRepository->findOneBy(array("nom" => $nomSection));

        return $this->createQueryBuilder('e')
            ->andWhere('e.section = :val')
            ->setParameter('val', $section)
            ->orderBy('e.nom', 'ASC')
            ->orderBy('e.prenom', 'ASC')
            ->getQuery()
            ->getResult();
    }*/

    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
