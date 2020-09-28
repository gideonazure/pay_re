<?php

namespace App\Service;

use App\DTO\PaymentDTO;
use App\Entity\Attachments;
use App\Entity\Payment;
use App\Entity\Reminders;
use App\Entity\User;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PaymentService implements PaymentInterface
{
    private PaymentRepository $paymentRepository;
    private UserInterface $userInterface;
    private CompanyInterface $companyInterface;
    private EntityManagerInterface $em;

    public function __construct(
        PaymentRepository $paymentRepository,
        UserInterface $userInterface,
        CompanyInterface $companyInterface,
        EntityManagerInterface $em
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->userInterface = $userInterface;
        $this->companyInterface = $companyInterface;
        $this->em = $em;
    }

    public function getById(int $id): Payment
    {
        return $this->paymentRepository->getById($id);
    }

    public function getList(): array
    {
        return $this->paymentRepository->getList();
    }

    public function create(PaymentDTO $dto): Payment
    {
        $payment = new Payment($dto->getName());
        $payer = $this->companyInterface->getById($dto->getPayer());
        $recipient = $this->companyInterface->getById($dto->getRecipient());
        $responsible = $this->userInterface->getById($dto->getResponsible());

        $payment
            ->setDescription($dto->getDescription())
            ->setPayer($payer)
            ->setRecipient($recipient)
            ->setActive(1)
            ->setStatus(0)
            ->setAmountUah($dto->getAmountUah())
            ->setAmountUsd($dto->getAmountUsd())
            ->setAmountEur($dto->getAmountEur())
            ->setResponsible($responsible)
            ->setRepeatable($dto->getRepeatableId());


        foreach ($dto->getSupervisor() as $usr) {
            $payment->addSupervisor(
                $this->userInterface->getById($usr)
            );
        }

        foreach ($dto->getAttachments() as $att) {
            $payment->addAttachment(
                new Attachments(
                    $att['name'],
                    $att['path']
                )
            );
        }

        foreach ($dto->getReminders() as $remind) {
            $payment->addReminder(
                new Reminders(
                    $remind['description'],
                    $remind['date']
                )
            );
        }

        $this->em->persist($payment);
        $this->em->flush();

        return $payment;
    }

    public function delete(int $id): void
    {
        // TODO: Implement delete() method.
    }

    public function update(int $id, PaymentDTO $dto): Payment
    {
        // TODO: Implement update() method.
    }

}
