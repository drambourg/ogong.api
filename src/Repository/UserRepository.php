<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function searchUsersFromCompany(int $companyId, string $value =null, array $orderBy = null, $limit = null)
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.company = :company')
            ->setParameter('company', $companyId);
        if (isset($value) && !empty($value)) {
            $qb->andWhere('u.firstName LIKE :value OR u.lastName LIKE :value')
                ->setParameter('value', '%' . $value . '%');
        }
        if (isset($orderBy)) {
            foreach ($orderBy as $key => $value) {
                $qb = $qb->orderBy('u.' . $key, $value);
            }
        }
        $limit && $qb = $qb->setMaxResults($limit);
        return $qb->getQuery()
            ->getResult();

    }
}
