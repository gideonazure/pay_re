<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends AbstractFixture
{
    protected const COMPANYS_COUNT = 20;
    protected const COMPANYS_TYPES = ['Контрагент', 'Плательщик'];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::COMPANYS_COUNT; ++$i) {
            $company = $this->createCompany($i);
            $manager->persist($company);
        }

        $manager->flush();
    }

    private function createCompany(int $i): Company
    {
        $company = new Company(
            $this->faker->company,
            $this->createFromArray(self::COMPANYS_TYPES)
        );

        return $company
            ->setCperson($this->faker->name)
            ->setPhone($this->createPhone('+380'))
            ->setEmail($this->faker->email)
            ->setAddress($this->faker->streetAddress)
            ->setCode($this->faker->randomNumber(8))
            ->setActive($this->faker->boolean(65));
    }
}
