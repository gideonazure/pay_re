<?php

namespace App\Service;

use App\Entity\PaymentTypes;
use App\Repository\PaymentTypesRepository;

final class PaymentTypesService implements PaymentTypesInterface
{
    private PaymentTypesRepository $paymentTypesRepository;

    public function __construct(PaymentTypesRepository $paymentTypesRepository)
    {
        $this->paymentTypesRepository = $paymentTypesRepository;
    }

    public function getById(int $id): PaymentTypes
    {
        return $this->paymentTypesRepository->getById($id);
    }

    public function getByLogin(string $login): PaymentTypes
    {
        return $this->paymentTypesRepository->getByLogin($login);
    }

    public function getList(): array
    {
        return $this->paymentTypesRepository->getList();
    }
}
