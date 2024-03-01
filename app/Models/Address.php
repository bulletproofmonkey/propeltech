<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class Address implements Arrayable, JsonSerializable
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $firstName = '';

    /**
     * @var string
     */
    protected string $lastName = '';

    /**
     * @var string
     */
    protected string $phone = '';

    /**
     * @var string
     */
    protected string $email = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Address
     */
    public function setId(int $id): Address
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Address
     */
    public function setFirstName(string $firstName): Address
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Address
     */
    public function setLastName(string $lastName): Address
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Address
     */
    public function setPhone(string $phone): Address
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Address
     */
    public function setEmail(string $email): Address
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'phone'      => $this->phone,
            'email'      => $this->email,
        ];
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fromArray(array $data): Address
    {
        if ($data['first_name']) {
            $this->setFirstName($data['first_name']);
        }
        if ($data['last_name']) {
            $this->setLastName($data['last_name']);
        }
        if ($data['phone']) {
            $this->setPhone($data['phone']);
        }
        if ($data['email']) {
            $this->setEmail($data['email']);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
