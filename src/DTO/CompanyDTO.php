<?php

declare(strict_types=1);

namespace App\DTO;

use Assert\Assertion;
use Symfony\Component\Validator\Constraints as Assert;


final class CompanyDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    private string $name;

    /**
     * @Assert\NotBlank()
     */
    private string $type;

    /**
     * @Assert\Length(max="255")
     */
    private ?string $cperson;

    private ?string $phone;

    /**
     * @Assert\Email()
     */
    private ?string $email;

    /**
     * @Assert\Length(max="255")
     */
    private ?string $address;

    private ?int $code;

    /**
     * @Assert\PositiveOrZero()
     */
    private int $active;

    private string $created_at;

    private ?string $updated_at;

    public static function fromRequest(array $request): self
    {
        Assertion::keyExists($request, 'name');
        Assertion::keyExists($request, 'type');
        Assertion::keyExists($request, 'cperson');
        Assertion::keyExists($request, 'phone');
        Assertion::keyExists($request, 'email');
        Assertion::keyExists($request, 'address');
        Assertion::keyExists($request, 'code');
        Assertion::keyExists($request, 'active');

        $self = new self();
        $self->name = $request['name'];
        $self->type = $request['type'];
        $self->cperson = $request['cperson'];
        $self->phone = $request['phone'];
        $self->email = $request['email'];
        $self->address = $request['address'];
        $self->code = $request['code'];
        $self->active = $request['active'];

        return $self;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCperson(): ?string
    {
        return $this->cperson;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }


}
