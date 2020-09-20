<?php

namespace App\Transformer;

use App\Entity\User;
use League\Fractal\TransformerAbstract;

final class UserTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'position' => $user->getPosition(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'telegram' => $user->getTelegram(),
        ];
    }
}