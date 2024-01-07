<?php

namespace App\Entity;

use App\Repository\ActivitiesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ActivityTypes $activity_type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $beggining_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ActivityMonitors $activityMonitors = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivityType(): ?ActivityTypes
    {
        return $this->activity_type;
    }

    public function setActivityType(?ActivityTypes $activity_type): static
    {
        $this->activity_type = $activity_type;

        return $this;
    }

    public function getBegginingDate(): ?\DateTimeInterface
    {
        return $this->beggining_date;
    }

    public function setBegginingDate(\DateTimeInterface $beggining_date): static
    {
        $this->beggining_date = $beggining_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

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