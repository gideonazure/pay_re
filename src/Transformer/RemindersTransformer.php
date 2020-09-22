<?php

namespace App\Transformer;

use App\Entity\Reminders;
use League\Fractal\TransformerAbstract;

final class RemindersTransformer extends TransformerAbstract
{
    public function transform(Reminders $reminders): array
    {
        return [
            'description' => $reminders->getDescription(),
            'text' => $reminders->getText(),
            'repeatable' => $reminders->getRepeatable(),
            'date' => $reminders->getDate(),
            'payment' => $reminders->getPayments(),
            'recipients' => $reminders->getRecipients(),
        ];
    }
}

