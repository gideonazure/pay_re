<?php

declare(strict_types=1);

namespace App\DTO;

use Assert\Assertion;
use Symfony\Component\Validator\Constraints as Assert;

final class PaymentDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $name;

    /**
     * @Assert\Length(max="255")
     */
    private $description;

    /**
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @Assert\NotBlank()
     */
    private $payer;

    /**
     * @Assert\NotBlank()
     */
    private $recipient;

    private $amountUah;

    private $amountEur;

    /**
     * @Assert\PositiveOrZero()
     * @Assert\NotBlank()
     */
    private $amountUsd;

    /**
     * @Assert\NotBlank()
     */
    private $expectedDate;

    /**
     * @Assert\NotBlank()
     */
    private $actualDate;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $status;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $active;

    /**
     * @Assert\NotNull()
     */
    private $repeatable;

    private $repeatableId;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $responsible;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $supervisor;

    private $reminders;

    private $attachments;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $createdBy;

    private $updatedBy;

    public static function fromRequest(array $request): self
    {
        Assertion::keyExists($request, 'name');
        Assertion::keyExists($request, 'description');
        Assertion::keyExists($request, 'type');
        Assertion::keyExists($request, 'payer');
        Assertion::keyExists($request, 'recipient');
        Assertion::keyExists($request, 'responsible');
        Assertion::keyExists($request, 'supervisor');
        Assertion::keyExists($request, 'amount_uah');
        Assertion::keyExists($request, 'amount_eur');
        Assertion::keyExists($request, 'amount_usd');
        Assertion::keyExists($request, 'expected_date');
        Assertion::keyExists($request, 'actual_date');
        Assertion::keyExists($request, 'status');
        Assertion::keyExists($request, 'active');
        Assertion::keyExists($request, 'created_by');
        Assertion::keyExists($request, 'updated_by');
        Assertion::keyExists($request, 'repeatable');
        Assertion::keyExists($request, 'repeatable_id');
        Assertion::keyExists($request, 'reminders');
        Assertion::keyExists($request, 'attachments');

        $self = new self();
        $self->name = $request['name'];
        $self->description = $request['description'];
        $self->type = $request['type'];
        $self->payer = $request['payer'];
        $self->recipient = $request['recipient'];
        $self->responsible = $request['responsible'];
        $self->supervisor = $request['supervisor'];
        $self->amountUah = $request['amount_uah'];
        $self->amountEur = $request['amount_eur'];
        $self->amountUsd = $request['amount_usd'];
        $self->expectedDate = $request['expected_date'];
        $self->actualDate = $request['actual_date'];
        $self->status = $request['status'];
        $self->active = $request['active'];
        $self->repeatable = $request['repeatable'];
        $self->repeatableId = $request['repeatable_id'];
        $self->attachments = $request['attachments'];
        $self->reminders = $request['reminders'];
        $self->createdBy = $request['created_by'];
        $self->updatedBy = $request['updated_by'];

        return $self;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPayer(): int
    {
        return $this->payer;
    }

    /**
     * @return mixed
     */
    public function getRecipient(): int
    {
        return $this->recipient;
    }

    /**
     * @return mixed
     */
    public function getAmountUah(): int
    {
        return $this->amountUah;
    }

    /**
     * @return mixed
     */
    public function getAmountEur(): int
    {
        return $this->amountEur;
    }

    /**
     * @return mixed
     */
    public function getAmountUsd(): int
    {
        return $this->amountUsd;
    }

    /**
     * @return mixed
     */
    public function getExpectedDate(): int
    {
        return $this->expectedDate;
    }

    /**
     * @return mixed
     */
    public function getActualDate(): int
    {
        return $this->actualDate;
    }

    /**
     * @return mixed
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @return mixed
     */
    public function getRepeatable(): int
    {
        return $this->repeatable;
    }

    /**
     * @return mixed
     */
    public function getRepeatableId(): int
    {
        return $this->repeatableId;
    }

    /**
     * @return mixed
     */
    public function getResponsible(): int
    {
        return $this->responsible;
    }

    /**
     * @return mixed
     */
    public function getSupervisor(): array
    {
        return $this->supervisor;
    }

    /**
     * @return mixed
     */
    public function getReminders(): array
    {
        return $this->reminders;
    }

    /**
     * @return mixed
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }
}
