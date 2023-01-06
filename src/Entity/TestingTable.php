<?php

namespace App\Entity;

use App\Repository\TestingTableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestingTableRepository::class)]
class TestingTable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $randomColumn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRandomColumn(): ?string
    {
        return $this->randomColumn;
    }

    public function setRandomColumn(?string $randomColumn): self
    {
        $this->randomColumn = $randomColumn;

        return $this;
    }
}
