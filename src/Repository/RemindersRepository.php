<?php

namespace App\Repository;

use App\Entity\Reminders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reminders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reminders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reminders[]    findAll()
 * @method Reminders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemindersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reminders::class);
    }

    public function getById(int $id): Reminders
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @return Reminders[]|array
     */
    public function getList(): array
    {
        return $this->findAll();
    }
}
