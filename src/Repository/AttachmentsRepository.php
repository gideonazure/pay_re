<?php

namespace App\Repository;

use App\Entity\Attachments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attachments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attachments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attachments[]    findAll()
 * @method Attachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attachments::class);
    }

    public function getById(int $id): Attachments
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @return Attachments[]|array
     */
    public function getList(): array
    {
        return $this->findAll();
    }
}
