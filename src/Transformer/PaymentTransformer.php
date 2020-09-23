<?php

namespace App\Transformer;

use App\Entity\Payment;
use League\Fractal\TransformerAbstract;

final class PaymentTransformer extends TransformerAbstract
{
    public function transform(Payment $payment): array
    {
        return [
            'name' => $payment->getName(),
            'description' => $payment->getDescription(),
            'type' => $payment->getType(),
            'payer' => $payment->getPayer(),
            'recipient' => $payment->getRecipient(),
            'expected_date' => $payment->getExpectedDate(),
            'actual_date' => $payment->getActualDate(),
            'amount_uah' => $payment->getAmountUah(),
            'amount_eur' => $payment->getAmountEur(),
            'amount_usd' => $payment->getAmountUsd(),
            'status' => $payment->getStatus(),
            'responsible' => $payment->getResponsible(),
            'supervisor' => $payment->getSupervisor(),
            'createdAt' => $payment->getCreatedAt(),
            'createdBy' => $payment->getCreatedBy(),
            'updatedAt' => $payment->getUpdatesAt(),
            'updatedBy' => $payment->getUpdatedBy(),
        ];
    }
}
