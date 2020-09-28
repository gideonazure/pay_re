<?php

namespace App\Entity;

use App\Repository\AttachmentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttachmentsRepository::class)
 */
class Attachments
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
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class, inversedBy="attachments")
     */
    private $payment_attachment;

    /**
     * Attachments constructor.
     * @param $name
     * @param $path
     */
    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPaymentAttachment(): ?Payment
    {
        return $this->payment_attachment;
    }

    public function setPaymentAttachment(?Payment $payment_attachment): self
    {
        $this->payment_attachment = $payment_attachment;

        return $this;
    }
}
