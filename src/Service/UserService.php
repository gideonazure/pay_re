<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

final class UserService implements UserInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getById(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    public function getByLogin(string $login): User
    {
        return $this->userRepository->getByLogin($login);
    }

    public function getList(): array
    {
        return $this->userRepository->getList();
    }
}
