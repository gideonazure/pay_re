<?php

namespace App\Service;

use App\DTO\CreateUser;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final class UserService implements UserInterface
{
    private UserRepository $userRepository;
    private EntityManagerInterface $em;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $em
    ) {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function getById(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->userRepository->getList();
    }

    public function create(CreateUser $dto): User
    {
        $user = new User(
            $dto->getLogin(),
            $dto->getPassword(),
            $dto->getName(),
            $dto->getSurname()
        );

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function delete(int $id): void
    {
        $user = $this->userRepository->getById($id);

        $this->em->remove($user);
        $this->em->flush();
    }
}
