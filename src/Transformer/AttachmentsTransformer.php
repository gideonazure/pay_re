<?php

namespace App\Transformer;

use App\Entity\Attachments;
use League\Fractal\TransformerAbstract;

final class AttachmentsTransformer extends TransformerAbstract
{
    public function transform(Attachments $attachments): array
    {
        return [
            'name' => $attachments->getName(),
            'path' => $attachments->getPath(),
            'payments' => $attachments->getPaymentAttachment(),
        ];
    }
}

