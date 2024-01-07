<?php

namespace App\Entity;

use App\Repository\ActivityMonitorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityMonitorsRepository::class)]
class ActivityMonitors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'activityMonitors', targetEntity: Activities::class)]
    private Collection $activities;

    #[ORM\OneToMany(mappedBy: 'activityMonitors', targetEntity: Monitors::class)]
    private Collection $monitors;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->monitors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Activities>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activities $activity): static
    {
        if (!$this->activities->contains($activity)) {
            $this->activities->add($activity);
            $activity->setActivityMonitors($this);
        }

        return $this;
    }

    public function removeActivity(Activities $activity): static
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getActivityMonitors() === $this) {
                $activity->setActivityMonitors(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Monitors>
     */
    public function getMonitors(): Collection
    {
        return $this->monitors;
    }

    public function addMonitor(Monitors $monitor): static
    {
        if (!$this->monitors->contains($monitor)) {
            $this->monitors->add($monitor);
            $monitor->setActivityMonitors($this);
        }

        return $this;
    }

    public function removeMonitor(Monitors $monitor): static
    {
        if ($this->monitors->removeElement($monitor)) {
            // set the owning side to null (unless already changed)
            if ($monitor->getActivityMonitors() === $this) {
                $monitor->setActivityMonitors(null);
            }
        }

        return $this;
    }
}
