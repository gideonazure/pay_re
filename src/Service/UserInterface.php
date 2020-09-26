<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CreateUser;
use App\DTO\UpdateUser;
use App\Entity\User;

interface UserInterface
{
    public function getById(int $id): User;

    public function getList(): array;

    public function create(CreateUser $dto): User;

    public function delete(int $id): void;

    public function update(int $id, UpdateUser $dto): User;
}
