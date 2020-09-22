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
            'surname' => $attachments->getSurname(),
            'position' => $attachments->getPosition(),
            'email' => $attachments->getEmail(),
            'phone' => $attachments->getPhone(),
            'telegram' => $attachments->getTelegram(),
        ];
    }
}

