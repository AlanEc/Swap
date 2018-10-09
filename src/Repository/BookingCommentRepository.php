<?php

namespace App\Repository;

use App\Entity\BookingComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookingComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingComment[]    findAll()
 * @method BookingComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookingComment::class);
    }

//    /**
//     * @return BookingComment[] Returns an array of BookingComment objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingComment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
