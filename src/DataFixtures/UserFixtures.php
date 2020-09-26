<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends AbstractFixture
{
    private const USERS_COUNT = 5;
    private const USERS_POSITION = [
        'Менеджер',
        'Руководитель отдела',
        'Бухгалтер',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::USERS_COUNT; ++$i) {
            $user = $this->createUser($i);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function createUser(int $i): User
    {
        $user = new User(
            'user'.$i++,
            $this->faker->firstName(),
            $this->faker->firstName()
        );

        $pass = $this->encoder->encodePassword($user, 'userPass');

        return $user
            ->setPassword($pass)
            ->setRoles(['ROLE_USER'])
            ->setEmail($this->faker->email)
            ->setPhone($this->createPhone('+380'))
            ->setPosition($this->createFromArray(self::USERS_POSITION))
            ->setActive($this->faker->boolean(60));
    }
}
