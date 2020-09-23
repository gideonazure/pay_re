<?php

namespace App\DataFixtures;

use App\Entity\Payment;
use App\Entity\PaymentTypes;
use App\Transformer\PaymentTypesTransformer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class PaymentFixtures extends AbstractFixture implements DependentFixtureInterface
{
    protected const PAYMENT_COUNT = 45;

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= self::PAYMENT_COUNT; ++$i) {
            $payment = $this->createPayment();
//            $manager->persist($payment);
        }

//        $manager->flush();
    }

    private function createPayment(): Payment
    {
//        $this->fractal->setSerializer(new ArraySerializer());

//        $paymentTypesList = $this->paymentTypes->getList();
//        dd($paymentTypesList);

        dd($this->getReference(PaymentTypes::class));

        $paymentTypesResource = new Collection($paymentTypesList, new PaymentTypesTransformer());
        $paymentTypes = $this->fractal->createData($paymentTypesResource)->toArray();

        $payment = new Payment($this->faker->text(15));

        return $payment
            ->setDescription($this->faker->text(90))
            ->setAmountUah($this->faker->randomNumber(7))
            ->setAmountUsd($this->faker->randomNumber(4))
            ->setAmountEur($this->faker->randomNumber(4))
            ->setExpectedDate($this->faker->date('U'))
            ->setActualDate($this->faker->date('U'))
            ->setStatus($this->faker->boolean(85))
            ->setType($paymentTypes[$this->faker->numberBetween(0, count($paymentTypes))]);
    }

    public function getDependencies()
    {
        return [
            PaymentTypesFixtures::class,
        ];
    }
}
