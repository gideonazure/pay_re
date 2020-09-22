<?php

namespace App\Service;

use App\Entity\Reminders;
use App\Repository\RemindersRepository;

final class RemindersService implements RemindersInterface
{
    private RemindersRepository $remindersRepository;

    public function __construct(RemindersRepository $remindersRepository)
    {
        $this->remindersRepository = $remindersRepository;
    }

    public function getById(int $id): Reminders
    {
        return $this->remindersRepository->getById($id);
    }

    public function getByLogin(string $login): Reminders
    {
        return $this->remindersRepository->getByLogin($login);
    }

    public function getList(): array
    {
        return $this->remindersRepository->getList();
    }
}
