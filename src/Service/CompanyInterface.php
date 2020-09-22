<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Company;

interface CompanyInterface
{
    public function getById(int $id): Company;
    public function getList(): array;
}