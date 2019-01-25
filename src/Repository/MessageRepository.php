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
            ->groupBy('m.serviceId')
            ->addGroupBy('m.userSender')
            ->getQuery()
            ->execute();
    }

    public function conversationRecovery($serviceId, $senderId, $receiverId)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.serviceId = :searchTerm ')
            ->setParameter('searchTerm', $serviceId)
            ->andWhere('IDENTITY(m.userSender) LIKE :search OR IDENTITY(m.userReceiver) LIKE :search')
            ->setParameter('search', '%'.$receiverId.'%')
            ->andWhere('IDENTITY(m.userSender) LIKE :search2 OR IDENTITY(m.userReceiver) LIKE :search2')
            ->setParameter('search2', '%'.$senderId.'%')
            ->orderBy('m.date_send', 'DESC')
            ->getQuery()
            ->execute();
    }
}
