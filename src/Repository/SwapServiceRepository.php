<?php

namespace App\Repository;

use App\Entity\SwapService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SwapService|null find($id, $lockMode = null, $lockVersion = null)
 * @method SwapService|null findOneBy(array $criteria, array $orderBy = null)
 * @method SwapService[]    findAll()
 * @method SwapService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwapServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SwapService::class);
    }

    public function swapsByCoord($coord)
    {
        $qb = $this->createQueryBuilder('m');

        $qb
            ->where('m.longitude BETWEEN :swlng AND :nelng')
            ->setParameter('swlng', $coord['swlng'])
            ->setParameter('nelng', $coord['nelng'])
            ->andWhere('m.latitude BETWEEN :swlat AND :nelat')
            ->setParameter('swlat', $coord['swlat'])
            ->setParameter('nelat', $coord['nelat'])
        ;

        return $qb
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return SwapService[] Returns an array of SwapService objects
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
    public function findOneBySomeField($value): ?SwapService
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
