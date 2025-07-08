<?php

namespace App\Entity;

use App\Repository\SeriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeriesRepository::class)]
class Series extends EntertainmentMedia
{
    #[ORM\Column(length: 255)]
    private ?string $director = null;

    #[ORM\Column(length: 255)]
    private ?string $streamingPlatform = null;

    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'series', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): static
    {
        $this->director = $director;
        return $this;
    }

    public function getStreamingPlatform(): ?string
    {
        return $this->streamingPlatform;
    }

    public function setStreamingPlatform(string $streamingPlatform): static
    {
        $this->streamingPlatform = $streamingPlatform;
        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSeries($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSeries() === $this) {
                $episode->setSeries(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Untitled Series';
    }
}