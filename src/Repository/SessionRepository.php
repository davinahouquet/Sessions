<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */
   public function findSessionsAVenir(): array
   {
        $now = new \DateTime();
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateDebut > :now')
           ->setParameter('now', $now)
           ->orderBy('s.dateDebut', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findSessionsEnCours(): array
   {
        $now = new \DateTime();
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateDebut < :now')
           ->andWhere('s.dateFin > :now')
           ->setParameter('now', $now)
           ->orderBy('s.dateDebut', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findSessionsPassees(): array
   {
        $now = new \DateTime();
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateFin < :now')
           ->setParameter('now', $now)
           ->orderBy('s.dateDebut', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    Pour afficher les stagaires non inscrits
   public function findNonInscrits($session_id)
   {
    $em = $this->getEntityManager();
    $sub = $em->createQueryBuilder();

    $qb = $sub;
    // Séléctionner tous les stagiaires d'une session dont l'id est passé en paramètres
    $qb->select('s')
        ->from('App\Entity\Stagiaire', 's')
        ->leftJoin('s.sessions', 'se')
        ->where('se.id = :id');

    $sub = $em->createQueryBuilder();
    // Séléctionner tous les stagiaires qui ne sont pas (NOT IN) dans le résultat précédent
    $sub->select('st')
        ->from('App\Entity\Stagiaire', 'st')
        ->where($sub->expr()->notIn('st.id', $qb->getDQL()))
        // Requête paramétrée
        ->setParameter('id', $session_id)
        ->orderBy('st.nom');

    // Renvoyer le résultat
    $query = $sub->getQuery();
    return $query->getResult();
   }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
