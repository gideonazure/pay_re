<?php

namespace App\Service;

use App\DTO\UserDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService implements UserInterface
{
    private UserRepository $userRepository;
    private EntityManagerInterface $em;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->userRepository = $userRepository;
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function getById(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->userRepository->getList();
    }

    public function create(UserDTO $dto): User
    {
        $user = new User(
            $dto->getLogin(),
            $dto->getName(),
            $dto->getSurname()
        );

        $user
            ->setPassword($this->encoder->encodePassword($user, $dto->getPassword()))
            ->setRoles($dto->getRoles())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
            ->setTelegram($dto->getTelegram())
            ->setPosition($dto->getPosition())
            ->setActive($dto->getActive());

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

    public function update(int $id, UserDTO $dto): User
    {
        $user = $this->getById($id);

        if (!$user) {
            throw new \Exception('This user no longer exists');
        }

        $user
            ->setLogin($dto->getLogin())
            ->setPassword($this->encoder->encodePassword($user, $dto->getPassword()))
            ->setRoles($dto->getRoles())
            ->setName($dto->getName())
            ->setSurname($dto->getSurname())
            ->setPhone($dto->getPhone())
            ->setEmail($dto->getEmail())
            ->setTelegram($dto->getTelegram())
            ->setPosition($dto->getPosition())
            ->setActive($dto->getActive());

        $this->em->flush();

        return $user;
    }
}
