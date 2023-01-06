<?php

namespace App\Entity;

use App\Repository\HelooRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HelooRepository::class)]
class Heloo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hellothere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHellothere(): ?string
    {
        return $this->hellothere;
    }

    public function setHellothere(string $hellothere): self
    {
        $this->hellothere = $hellothere;

        return $this;
    }
}
