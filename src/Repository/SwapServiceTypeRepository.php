<?php

namespace App\Repository;

use App\Entity\SwapServiceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SwapServiceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SwapServiceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SwapServiceType[]    findAll()
 * @method SwapServiceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwapServiceTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SwapServiceType::class);
    }

//    /**
//     * @return SwapServiceType[] Returns an array of SwapServiceType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SwapServiceType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
