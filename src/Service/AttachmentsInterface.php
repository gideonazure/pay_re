<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Attachments;

interface AttachmentsInterface
{
    public function getById(int $id): Attachments;

    public function getList(): array;
}
