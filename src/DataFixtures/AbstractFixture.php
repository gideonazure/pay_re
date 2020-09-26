<?php

namespace App\DataFixtures;

use App\Service\AttachmentsInterface;
use App\Service\CompanyInterface;
use App\Service\PaymentTypesInterface;
use App\Service\RemindersInterface;
use App\Service\UserInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use League\Fractal\Manager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class AbstractFixture extends Fixture
{
    protected Generator $faker;
    protected UserPasswordEncoderInterface $encoder;
    protected PaymentTypesInterface $paymentTypes;
    protected RemindersInterface $reminders;
    protected CompanyInterface $company;
    protected AttachmentsInterface $attachments;
    protected UserInterface $user;
    protected Manager $fractal;

    /**
     * AbstractFixture constructor.
     */
    public function __construct(
        UserPasswordEncoderInterface $encoder,
        PaymentTypesInterface $paymentTypes,
        RemindersInterface $reminders,
        CompanyInterface $company,
        AttachmentsInterface $attachments,
        UserInterface $user)
    {
        $this->faker = Factory::create();
        $this->fractal = new Manager();
        $this->encoder = $encoder;
        $this->paymentTypes = $paymentTypes;
        $this->reminders = $reminders;
        $this->company = $company;
        $this->attachments = $attachments;
        $this->user = $user;
    }

    protected function createFromArray(array $array): string
    {
        $arrayCount = count($array) - 1;

        return $array[$this->faker->numberBetween(0, $arrayCount)];
    }

    protected function createPhone(string $code): string
    {
        return $code.$this->faker->randomNumber(9);
    }
}
