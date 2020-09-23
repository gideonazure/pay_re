<?php

namespace App\DataFixtures;

use App\Entity\PaymentTypes;
use Doctrine\Persistence\ObjectManager;

class PaymentTypesFixtures extends AbstractFixture
{
    protected const PAYMENT_TYPES = [
        [
            'abbr' => 'Офис',
            'description' => 'Расходы на канцелярию и прочие офисные нужды',
        ],
        [
            'abbr' => 'Логистика',
            'description' => 'Оплата логистических услуг посредников',
        ],
        [
            'abbr' => 'Счет',
            'description' => 'Оплата счетов закупок',
        ],
        [
            'abbr' => 'Бонусы',
            'description' => '',
        ],
        [
            'abbr' => 'Прочее',
            'description' => 'Иные расходы не попадающие под стандартные категории',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PAYMENT_TYPES as $key => $type) {
            $paymentTypes = $this->createPaymentType($type);
            $manager->persist($paymentTypes);
            $this->addReference('PaymentTypes', $paymentTypes);
        }

        $manager->flush();
    }

    private function createPaymentType(array $type): PaymentTypes
    {
        $paymentTypes = new PaymentTypes($type['abbr']);
        return $paymentTypes
            ->setDescription($type['description'])
            ->setActive($this->faker->boolean(90));
    }
}
