<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="responsible")
     */
    private $payment_responsible;

    /**
     * @var Collection|Payment[]
     *
     * @ORM\ManyToMany(targetEntity="Payment", mappedBy="supervisor")
     */
    private $payment_supervisor;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="createdBy")
     */
    private $payment_created;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="updatedBy")
     */
    private $payment_updated;

    /**
     * @var Collection|Reminders[]
     *
     * @ORM\ManyToMany(targetEntity="Reminders", mappedBy="recipients")
     */
    private $reminders_recipients;

    public function __construct($login, $password, $name, $surname)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->active = 0;
        $this->payment_responsible = new ArrayCollection();
        $this->payment_created = new ArrayCollection();
        $this->payment_updated = new ArrayCollection();
        $this->payment_supervisor = new ArrayCollection();
        $this->reminders_recipients = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
        $this->password;
    }

    public function getName(): ?string
    {
        return $this->name;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
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

    /**
     * @return Collection|Payment[]
     */
    public function getPaymentResponsible(): Collection
    {
        return $this->payment_responsible;
    }

    public function addPaymentResponsible(Payment $paymentResponsible): self
    {
        if (!$this->payment_responsible->contains($paymentResponsible)) {
            $this->payment_responsible[] = $paymentResponsible;
            $paymentResponsible->setResponsible($this);
        }

        return $this;
    }

    public function removePaymentResponsible(Payment $paymentResponsible): self
    {
        if ($this->payment_responsible->contains($paymentResponsible)) {
            $this->payment_responsible->removeElement($paymentResponsible);
            // set the owning side to null (unless already changed)
            if ($paymentResponsible->getResponsible() === $this) {
                $paymentResponsible->setResponsible(null);
            }
        }

        return $this;
    }

    public function getPaymentSupervisor(): ?Payment
    {
        return $this->payment_supervisor;
    }

    public function setPaymentSupervisor(?Payment $payment_supervisor): self
    {
        $this->payment_supervisor = $payment_supervisor;

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
            $paymentCreated->setCreatedBy($this);
        }

        return $this;
    }

    public function removePaymentCreated(Payment $paymentCreated): self
    {
        if ($this->payment_created->contains($paymentCreated)) {
            $this->payment_created->removeElement($paymentCreated);
            // set the owning side to null (unless already changed)
            if ($paymentCreated->getCreatedBy() === $this) {
                $paymentCreated->setCreatedBy(null);
            }
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
            $paymentUpdated->setUpdatedBy($this);
        }

        return $this;
    }

    public function removePaymentUpdated(Payment $paymentUpdated): self
    {
        if ($this->payment_updated->contains($paymentUpdated)) {
            $this->payment_updated->removeElement($paymentUpdated);
            // set the owning side to null (unless already changed)
            if ($paymentUpdated->getUpdatedBy() === $this) {
                $paymentUpdated->setUpdatedBy(null);
            }
        }

        return $this;
    }

    public function getRemindersRecipients(): ?Reminders
    {
        return $this->reminders_recipients;
    }

    public function setRemindersRecipients(?Reminders $reminders_recipients): self
    {
        $this->reminders_recipients = $reminders_recipients;

        return $this;
    }

    public function addPaymentSupervisor(Payment $paymentSupervisor): self
    {
        if (!$this->payment_supervisor->contains($paymentSupervisor)) {
            $this->payment_supervisor[] = $paymentSupervisor;
            $paymentSupervisor->addSupervisor($this);
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

    public function addRemindersRecipient(Reminders $remindersRecipient): self
    {
        if (!$this->reminders_recipients->contains($remindersRecipient)) {
            $this->reminders_recipients[] = $remindersRecipient;
            $remindersRecipient->addRecipient($this);
        }

        return $this;
    }

    public function removeRemindersRecipient(Reminders $remindersRecipient): self
    {
        if ($this->reminders_recipients->contains($remindersRecipient)) {
            $this->reminders_recipients->removeElement($remindersRecipient);
            $remindersRecipient->removeRecipient($this);
        }

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
