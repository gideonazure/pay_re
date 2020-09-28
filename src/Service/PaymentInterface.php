<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\PaymentDTO;
use App\Entity\Payment;

interface PaymentInterface
{
    public function getById(int $id): Payment;

    public function getList(): array;

    public function create(PaymentDTO $dto): Payment;

    public function delete(int $id): void;

    public function update(int $id, PaymentDTO $dto): Payment;


}
