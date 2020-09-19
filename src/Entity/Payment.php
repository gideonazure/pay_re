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
     * @ORM\OneToOne(targetEntity=PaymentTypes::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, cascade={"persist", "remove"})
     */
    private $payer;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, cascade={"persist", "remove"})
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
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="payment_responsible")
     */
    private $responsible;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, inversedBy="payment_supervisor")
     */
    private $supervisor;

    /**
     * @ORM\ManyToMany(targetEntity=Reminders::class, inversedBy="payments")
     */
    private $reminders;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="payment_created")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatesAt;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="payment_updated")
     */
    private $updatedBy;

    public function __construct()
    {
        $this->responsible = new ArrayCollection();
        $this->supervisor = new ArrayCollection();
        $this->reminders = new ArrayCollection();
        $this->createdBy = new ArrayCollection();
        $this->updatedBy = new ArrayCollection();
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

    public function getType(): ?PaymentTypes
    {
        return $this->type;
    }

    public function setType(PaymentTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPayer(): ?Company
    {
        return $this-payer;
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

    /**
     * @return Collection|Users[]
     */
    public function getResponsible(): Collection
    {
        return $this->responsible;
    }

    public function addResponsible(Users $responsible): self
    {
        if (!$this->responsible->contains($responsible)) {
            $this->responsible[] = $responsible;
            $responsible->setPayment($this);
        }

        return $this;
    }

    public function removeResponsible(Users $responsible): self
    {
        if ($this->responsible->contains($responsible)) {
            $this->responsible->removeElement($responsible);
            // set the owning side to null (unless already changed)
            if ($responsible->getPayment() === $this) {
                $responsible->setPayment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getSupervisor(): Collection
    {
        return $this->supervisor;
    }

    public function addSupervisor(Users $supervisor): self
    {
        if (!$this->supervisor->contains($supervisor)) {
            $this->supervisor[] = $supervisor;
        }

        return $this;
    }

    public function removeSupervisor(Users $supervisor): self
    {
        if ($this->supervisor->contains($supervisor)) {
            $this->supervisor->removeElement($supervisor);
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
        }

        return $this;
    }

    public function removeReminder(Reminders $reminder): self
    {
        if ($this->reminders->contains($reminder)) {
            $this->reminders->removeElement($reminder);
        }

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

    /**
     * @return Collection|Users[]
     */
    public function getCreatedBy(): Collection
    {
        return $this->createdBy;
    }

    public function addCreatedBy(Users $createdBy): self
    {
        if (!$this->createdBy->contains($createdBy)) {
            $this->createdBy[] = $createdBy;
        }

        return $this;
    }

    public function removeCreatedBy(Users $createdBy): self
    {
        if ($this->createdBy->contains($createdBy)) {
            $this->createdBy->removeElement($createdBy);
        }

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

    /**
     * @return Collection|Users[]
     */
    public function getUpdatedBy(): Collection
    {
        return $this->updatedBy;
    }

    public function addUpdatedBy(Users $updatedBy): self
    {
        if (!$this->updatedBy->contains($updatedBy)) {
            $this->updatedBy[] = $updatedBy;
        }

        return $this;
    }

    public function removeUpdatedBy(Users $updatedBy): self
    {
        if ($this->updatedBy->contains($updatedBy)) {
            $this->updatedBy->removeElement($updatedBy);
        }

        return $this;
    }
}
