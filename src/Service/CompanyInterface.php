<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CompanyDTO;
use App\Entity\Company;

interface CompanyInterface
{
    public function getById(int $id): Company;

    public function getList(): array;

    public function create(CompanyDTO $dto): Company;

    public function delete(int $id): void;

    public function update(int $id, CompanyDTO $dto): Company;
}
