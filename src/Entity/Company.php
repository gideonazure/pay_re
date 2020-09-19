<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cperson;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="payer")
     */
    private $payment_payer;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="recipient")
     */
    private $payment_recipient;


    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->payment_payer = new ArrayCollection();
        $this->payment_recipient = new ArrayCollection();
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCperson(): ?string
    {
        return $this->cperson;
    }

    public function setCperson(?string $cperson): self
    {
        $this->cperson = $cperson;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): self
    {
        $this->code = $code;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentPayer(): Collection
    {
        return $this->payment_payer;
    }

    public function addPaymentPayer(Payment $paymentPayer): self
    {
        if (!$this->payment_payer->contains($paymentPayer)) {
            $this->payment_payer[] = $paymentPayer;
            $paymentPayer->setPayer($this);
        }

        return $this;
    }

    public function removePaymentPayer(Payment $paymentPayer): self
    {
        if ($this->payment_payer->contains($paymentPayer)) {
            $this->payment_payer->removeElement($paymentPayer);
            // set the owning side to null (unless already changed)
            if ($paymentPayer->getPayer() === $this) {
                $paymentPayer->setPayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentRecipient(): Collection
    {
        return $this->payment_recipient;
    }

    public function addPaymentRecipient(Payment $paymentRecipient): self
    {
        if (!$this->payment_recipient->contains($paymentRecipient)) {
            $this->payment_recipient[] = $paymentRecipient;
            $paymentRecipient->setRecipient($this);
        }

        return $this;
    }

    public function removePaymentRecipient(Payment $paymentRecipient): self
    {
        if ($this->payment_recipient->contains($paymentRecipient)) {
            $this->payment_recipient->removeElement($paymentRecipient);
            // set the owning side to null (unless already changed)
            if ($paymentRecipient->getRecipient() === $this) {
                $paymentRecipient->setRecipient(null);
            }
        }

        return $this;
    }


}
