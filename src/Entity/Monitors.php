<?php

namespace App\Entity;

use App\Repository\MonitorsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonitorsRepository::class)]
class Monitors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Photo = null;

    #[ORM\ManyToOne(inversedBy: 'monitors')]
    private ?ActivityMonitors $activityMonitors = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getActivityMonitors(): ?ActivityMonitors
    {
        return $this->activityMonitors;
    }

    public function setActivityMonitors(?ActivityMonitors $activityMonitors): static
    {
        $this->activityMonitors = $activityMonitors;

        return $this;
    }
}
