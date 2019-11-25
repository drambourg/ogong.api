<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use App\Entity\Company;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function search(string $value, array $orderBy = null, $limit = null)
    {
        $qb = $this->createQueryBuilder('e')

            ->leftJoin('e.company', 'c')
            ->leftJoin('e.format', 'f')
            ->leftJoin('e.status', 's')
            ->addSelect('c.name AS company')
            ->addSelect('e.title')
            ->addSelect('e.size')
            ->addSelect('e.startDateTime')
            ->addSelect('f.name AS format')
            ->addSelect('s.name AS status')
            ->andWhere('e.title LIKE :value')
            ->orWhere('c.name LIKE :value')
            ->setParameter('value', '%' . $value . '%');
        // default order by company name
        $qb =$qb->orderBy('company', 'ASC');
        if (isset($orderBy)) {
            foreach ($orderBy as $key => $value) {
                $qb =$qb->orderBy('e.'.  $key, $value);
            }
        }
        $limit && $qb = $qb->setMaxResults($limit);
        return $qb->getQuery()
            ->getResult();

    }
}
