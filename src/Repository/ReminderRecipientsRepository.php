<?php

namespace App\Repository;

use App\Entity\ReminderRecipients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReminderRecipients|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReminderRecipients|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReminderRecipients[]    findAll()
 * @method ReminderRecipients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReminderRecipientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReminderRecipients::class);
    }

    // /**
    //  * @return ReminderRecipients[] Returns an array of ReminderRecipients objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReminderRecipients
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
