<?php

namespace App\Entity;

use App\Repository\RemindersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RemindersRepository::class)
 */
class Reminders
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
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="reminders")
     */
    private $payments;

    /**
     * @var Collection|User[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="reminders_recipients")
     * @ORM\JoinTable(
     *  name="reminders_recipient",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="recipient_id", referencedColumnName="id")
     *  }
     * )
     */
    private $recipients;

    public function __construct($description, $date)
    {
        $this->description = $description;
        $this->date = $date;
        $this->recipients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

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

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPayments(): ?Payment
    {
        return $this->payments;
    }

    public function setPayments(?Payment $payments): self
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRecipients(): Collection
    {
        return $this->recipients;
    }

    public function addRecipient(User $recipient): self
    {
        if (!$this->recipients->contains($recipient)) {
            $this->recipients[] = $recipient;
            $recipient->setRemindersRecipients($this);
        }

        return $this;
    }

    public function removeRecipient(User $recipient): self
    {
        if ($this->recipients->contains($recipient)) {
            $this->recipients->removeElement($recipient);
            // set the owning side to null (unless already changed)
            if ($recipient->getRemindersRecipients() === $this) {
                $recipient->setRemindersRecipients(null);
            }
        }

        return $this;
    }
}
