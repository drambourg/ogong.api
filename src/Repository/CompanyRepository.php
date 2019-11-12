<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function search(string $value, array $orderBy = null, $limit = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :value')
            ->orWhere('c.address LIKE :value')
            ->setParameter('value', '%' . $value . '%');
        if (isset($orderBy)) {
            foreach ($orderBy as $key => $value) {
                $qb =$qb->orderBy('c.'.  $key, $value);
            }
        }
        $limit && $qb = $qb->setMaxResults($limit);
        return $qb->getQuery()
            ->getResult();

    }
}
