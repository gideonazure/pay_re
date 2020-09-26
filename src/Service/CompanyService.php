<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\CompanyRepository;

final class CompanyService implements CompanyInterface
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getById(int $id): Company
    {
        return $this->companyRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->companyRepository->getList();
    }
}
