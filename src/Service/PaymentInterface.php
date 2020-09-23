<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Payment;

interface PaymentInterface
{
    public function getById(int $id): Payment;

    public function getList(): array;
}
