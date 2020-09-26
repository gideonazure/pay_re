<?php

namespace App\Service;

use App\Entity\Payment;
use App\Repository\PaymentRepository;

final class PaymentService implements PaymentInterface
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getById(int $id): Payment
    {
        return $this->paymentRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->paymentRepository->getList();
    }
}
