<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;

interface UserInterface
{
    public function getById(int $id): User;
    public function getList(): array;
}