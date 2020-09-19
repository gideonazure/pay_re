<?php

namespace App\Entity;

use App\Repository\ReminderRecipientsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReminderRecipientsRepository::class)
 */
class ReminderRecipients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $reminder_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $recipient_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReminderId(): ?int
    {
        return $this->reminder_id;
    }

    public function setReminderId(int $reminder_id): self
    {
        $this->reminder_id = $reminder_id;

        return $this;
    }

    public function getRecipientId(): ?int
    {
        return $this->recipient_id;
    }

    public function setRecipientId(int $recipient_id): self
    {
        $this->recipient_id = $recipient_id;

        return $this;
    }
}
