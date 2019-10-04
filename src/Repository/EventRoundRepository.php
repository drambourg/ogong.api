<?php

namespace App\Repository;

use App\Entity\EventRound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EventRound|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventRound|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventRound[]    findAll()
 * @method EventRound[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRoundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventRound::class);
    }

    // /**
    //  * @return EventRound[] Returns an array of EventRound objects
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
    public function findOneBySomeField($value): ?EventRound
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
