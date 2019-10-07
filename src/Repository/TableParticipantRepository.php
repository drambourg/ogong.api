<?php

namespace App\Repository;

use App\Entity\TableParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TableParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableParticipant[]    findAll()
 * @method TableParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableParticipant::class);
    }

    // /**
    //  * @return TableParticipant[] Returns an array of TableParticipant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TableParticipant
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
