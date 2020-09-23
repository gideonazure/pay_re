<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentRepository::class)
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PaymentTypes::class, inversedBy="payments")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="payment_payer")
     */
    private $payer;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="payment_recipient")
     */
    private $recipient;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount_uah;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount_eur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount_usd;

    /**
     * @ORM\Column(type="integer")
     */
    private $expected_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $actual_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="payment_responsible")
     */
    private $responsible;

    /**
     * @var Collection|User[]
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="payment_supervisor")
     * @ORM\JoinTable(
     *  name="payment_supervisor",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="supervisor_id", referencedColumnName="id")
     *  }
     * )
     */
    private $supervisor;

    /**
     * @ORM\OneToMany(targetEntity=Reminders::class, mappedBy="payments")
     */
    private $reminders;

    /**
     * @ORM\OneToMany(targetEntity=Attachments::class, mappedBy="payment_attachment")
     */
    private $attachments;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="payment_created")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatesAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="payment_updated")
     */
    private $updatedBy;

    public function __construct($name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTimeImmutable();
        $this->supervisor = new ArrayCollection();
        $this->reminders = new ArrayCollection();
        $this->attachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmountUah(): ?int
    {
        return $this->amount_uah;
    }

    public function setAmountUah(int $amount_uah): self
    {
        $this->amount_uah = $amount_uah;

        return $this;
    }

    public function getAmountEur(): ?int
    {
        return $this->amount_eur;
    }

    public function setAmountEur(?int $amount_eur): self
    {
        $this->amount_eur = $amount_eur;

        return $this;
    }

    public function getAmountUsd(): ?int
    {
        return $this->amount_usd;
    }

    public function setAmountUsd(?int $amount_usd): self
    {
        $this->amount_usd = $amount_usd;

        return $this;
    }

    public function getExpectedDate(): ?int
    {
        return $this->expected_date;
    }

    public function setExpectedDate(int $expected_date): self
    {
        $this->expected_date = $expected_date;

        return $this;
    }

    public function getActualDate(): ?int
    {
        return $this->actual_date;
    }

    public function setActualDate(int $actual_date): self
    {
        $this->actual_date = $actual_date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatesAt(): ?\DateTimeImmutable
    {
        return $this->updatesAt;
    }

    public function setUpdatesAt(?\DateTimeImmutable $updatesAt): self
    {
        $this->updatesAt = $updatesAt;

        return $this;
    }

    public function getType(): ?PaymentTypes
    {
        return $this->type;
    }

    public function setType(?PaymentTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPayer(): ?Company
    {
        return $this->payer;
    }

    public function setPayer(?Company $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getRecipient(): ?Company
    {
        return $this->recipient;
    }

    public function setRecipient(?Company $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getResponsible(): ?User
    {
        return $this->responsible;
    }

    public function setResponsible(?User $responsible): self
    {
        $this->responsible = $responsible;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getSupervisor(): Collection
    {
        return $this->supervisor;
    }

    public function addSupervisor(User $supervisor): self
    {
        if (!$this->supervisor->contains($supervisor)) {
            $this->supervisor[] = $supervisor;
            $supervisor->setPaymentSupervisor($this);
        }

        return $this;
    }

    public function removeSupervisor(User $supervisor): self
    {
        if ($this->supervisor->contains($supervisor)) {
            $this->supervisor->removeElement($supervisor);
            // set the owning side to null (unless already changed)
            if ($supervisor->getPaymentSupervisor() === $this) {
                $supervisor->setPaymentSupervisor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reminders[]
     */
    public function getReminders(): Collection
    {
        return $this->reminders;
    }

    public function addReminder(Reminders $reminder): self
    {
        if (!$this->reminders->contains($reminder)) {
            $this->reminders[] = $reminder;
            $reminder->setPayments($this);
        }

        return $this;
    }

    public function removeReminder(Reminders $reminder): self
    {
        if ($this->reminders->contains($reminder)) {
            $this->reminders->removeElement($reminder);
            // set the owning side to null (unless already changed)
            if ($reminder->getPayments() === $this) {
                $reminder->setPayments(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Attachments[]
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function addAttachment(Attachments $attachment): self
    {
        if (!$this->attachments->contains($attachment)) {
            $this->attachments[] = $attachment;
            $attachment->setPaymentAttachment($this);
        }

        return $this;
    }

    public function removeAttachment(Attachments $attachment): self
    {
        if ($this->attachments->contains($attachment)) {
            $this->attachments->removeElement($attachment);
            // set the owning side to null (unless already changed)
            if ($attachment->getPaymentAttachment() === $this) {
                $attachment->setPaymentAttachment(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
