<?php

namespace App\Repository;

use App\Entity\PaymentTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaymentTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentTypes[]    findAll()
 * @method PaymentTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentTypes::class);
    }

    public function getById(int $id): PaymentTypes
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @return PaymentTypes[]|array
     */
    public function getList(): array
    {
        return $this->findAll();
    }
}
