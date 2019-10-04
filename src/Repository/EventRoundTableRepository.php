<?php

namespace App\Repository;

use App\Entity\EventRoundTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EventRoundTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventRoundTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventRoundTable[]    findAll()
 * @method EventRoundTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRoundTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventRoundTable::class);
    }

    // /**
    //  * @return EventRoundTable[] Returns an array of EventRoundTable objects
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
    public function findOneBySomeField($value): ?EventRoundTable
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
