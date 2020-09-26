<?php

namespace App\DataFixtures;

use App\Entity\PaymentTypes;
use Doctrine\Persistence\ObjectManager;

class PaymentTypesFixtures extends AbstractFixture
{
    public const PAYMENT_REFERENCE = 'payment-type';
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
        $typesCount = count(self::PAYMENT_TYPES);
        $currentType = self::PAYMENT_TYPES[$this->faker->numberBetween(0, $typesCount)];
//        foreach (self::PAYMENT_TYPES as $key => $type) {

        $paymentTypes = $this->createPaymentType($currentType);
        $this->addReference(self::PAYMENT_REFERENCE, $paymentTypes);



            $manager->persist($paymentTypes);
//        }

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
