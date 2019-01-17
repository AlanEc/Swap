<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getMessagesByUser($idUser)
    {
        $qb = $this->createQueryBuilder('m');

        return $this->createQueryBuilder('m')
            ->andWhere('IDENTITY(m.userSender) LIKE :search OR IDENTITY(m.userReceiver) LIKE :search')
            ->setParameter('search', '%'.$idUser.'%')
            ->distinct('m.serviceId')
            ->groupBy('m.serviceId')
            ->getQuery()
            ->execute();
    }

    public function conversationRecovery($serviceId, $senderId)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.serviceId = :searchTerm ')
            ->setParameter('searchTerm', $serviceId)
            ->andWhere('IDENTITY(m.userSender) LIKE :search OR IDENTITY(m.userReceiver) LIKE :search')
            ->setParameter('search', '%'.$senderId.'%')
            ->orderBy('m.date_send', 'DESC')
            ->getQuery()
            ->execute();
    }
}
