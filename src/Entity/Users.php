<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
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
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telegram;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="responsible")
     */
    private $payment_responsible;

    /**
     * @ORM\ManyToMany(targetEntity=Payment::class, mappedBy="supervisor")
     */
    private $payment_supervisor;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="createdBy")
     */
    private $payment_created;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="updatedBy")
     */
    private $payment_updated;

    public function __construct()
    {
        $this->payment_supervisor = new ArrayCollection();
        $this->payment_created = new ArrayCollection();
        $this->payment_updated = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): self
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPaymentResponsible(): ?Payment
    {
        return $this->payment_responsible;
    }

    public function setPaymentResponsible(?Payment $payment_responsible): self
    {
        $this->payment_responsible = $payment_responsible;

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentSupervisor(): Collection
    {
        return $this->payment_supervisor;
    }

    public function addPaymentSupervisor(Payment $paymentSupervisor): self
    {
        if (!$this->payment_supervisor->contains($paymentSupervisor)) {
            $this->payment_supervisor[] = $paymentSupervisor;
            $paymentSupervisor->addSupervisor($this);
        }

        return $this;
    }

    public function removePaymentsSupervisor(Payment $paymentsSupervisor): self
    {
        if ($this->payments_supervisor->contains($paymentsSupervisor)) {
            $this->payments_supervisor->removeElement($paymentsSupervisor);
            $paymentsSupervisor->removeSupervisor($this);
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentCreated(): Collection
    {
        return $this->payment_created;
    }

    public function addPaymentCreated(Payment $paymentCreated): self
    {
        if (!$this->payment_created->contains($paymentCreated)) {
            $this->payment_created[] = $paymentCreated;
            $paymentCreated->addCreatedBy($this);
        }

        return $this;
    }

    public function removePaymentCreated(Payment $paymentCreated): self
    {
        if ($this->payment_created->contains($paymentCreated)) {
            $this->payment_created->removeElement($paymentCreated);
            $paymentCreated->removeCreatedBy($this);
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentUpdated(): Collection
    {
        return $this->payment_updated;
    }

    public function addPaymentUpdated(Payment $paymentUpdated): self
    {
        if (!$this->payment_updated->contains($paymentUpdated)) {
            $this->payment_updated[] = $paymentUpdated;
            $paymentUpdated->addUpdatedBy($this);
        }

        return $this;
    }

    public function removePaymentUpdated(Payment $paymentUpdated): self
    {
        if ($this->payment_updated->contains($paymentUpdated)) {
            $this->payment_updated->removeElement($paymentUpdated);
            $paymentUpdated->removeUpdatedBy($this);
        }

        return $this;
    }

    public function removePaymentSupervisor(Payment $paymentSupervisor): self
    {
        if ($this->payment_supervisor->contains($paymentSupervisor)) {
            $this->payment_supervisor->removeElement($paymentSupervisor);
            $paymentSupervisor->removeSupervisor($this);
        }

        return $this;
    }

    public function setPaymentCreated(?Payment $payment_created): self
    {
        $this->payment_created = $payment_created;

        return $this;
    }

    public function setPaymentUpdated(?Payment $payment_updated): self
    {
        $this->payment_updated = $payment_updated;

        return $this;
    }
}
