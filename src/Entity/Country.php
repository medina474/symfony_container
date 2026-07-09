<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\Column(length: 2)]
    private ?string $code = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $country = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $long = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $flag = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $sepa = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $intracommunity = false;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;
        return $this;
    }

    public function getLong(): ?string
    {
        return $this->long;
    }

    public function setLong(?string $long): static
    {
        $this->long = $long;
        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): static
    {
        $this->flag = $flag;
        return $this;
    }

    public function isSepa(): bool
    {
        return $this->sepa;
    }

    public function setSepa(bool $sepa): static
    {
        $this->sepa = $sepa;
        return $this;
    }

    public function isIntracommunity(): bool
    {
        return $this->intracommunity;
    }

    public function setIntracommunity(bool $intracommunity): static
    {
        $this->intracommunity = $intracommunity;
        return $this;
    }

    public function __toString(): string
    {
        return $this->country;
    }
}
