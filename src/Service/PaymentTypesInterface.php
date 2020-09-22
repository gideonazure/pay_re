<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\PaymentTypes;

interface PaymentTypesInterface
{
    public function getById(int $id): PaymentTypes;
    public function getList(): array;
}