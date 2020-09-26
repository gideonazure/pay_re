<?php

namespace App\Transformer;

use App\Entity\PaymentTypes;
use League\Fractal\TransformerAbstract;

final class PaymentTypesTransformer extends TransformerAbstract
{
    public function transform(PaymentTypes $paymentTypes): array
    {
        return [
            'abbr' => $paymentTypes->getAbbr(),
            'description' => $paymentTypes->getDescription(),
            'payments' => $paymentTypes->getPayments(),
        ];
    }
}
