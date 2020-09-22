<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Reminders;

interface RemindersInterface
{
    public function getById(int $id): Reminders;
    public function getList(): array;
}