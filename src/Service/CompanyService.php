<?php

namespace App\Service;

use App\DTO\CompanyDTO;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CompanyService implements CompanyInterface
{
    private CompanyRepository $companyRepository;
    private EntityManagerInterface $em;

    public function __construct(
        CompanyRepository $companyRepository,
        EntityManagerInterface $em
    ) {
        $this->companyRepository = $companyRepository;
        $this->em = $em;
    }

    public function getById(int $id): Company
    {
        return $this->companyRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->companyRepository->getList();
    }


    public function create(CompanyDTO $dto): Company
    {
        $company = new Company(
            $dto->getName(),
            $dto->getType(),
        );

        $company
            ->setCperson($dto->getCperson())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
            ->setAddress($dto->getAddress())
            ->setCode($dto->getCode())
            ->setActive($dto->getActive());

        $this->em->persist($company);
        $this->em->flush();

        return $company;
    }

    public function delete(int $id): void
    {
        $user = $this->companyRepository->getById($id);

        $this->em->remove($user);
        $this->em->flush();
    }

    public function update(int $id, CompanyDTO $dto): Company
    {
        $company = $this->getById($id);

        if (!$company) {
            throw new \Exception('This company no longer exists');
        }

        $company
            ->setName($dto->getName())
            ->setType($dto->getType())
            ->setCperson($dto->getCperson())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
            ->setAddress($dto->getAddress())
            ->setCode($dto->getCode())
            ->setActive($dto->getActive());

        $this->em->flush();

        return $company;
    }
}
