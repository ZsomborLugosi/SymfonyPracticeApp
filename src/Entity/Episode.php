<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode extends EntertainmentMedia
{
    #[ORM\ManyToOne(targetEntity: Series::class, inversedBy: 'episodes')]
    #[ORM\JoinColumn(name: 'series_id', nullable: true)]
    #[Assert\NotNull(message: 'An episode must belong to a series')]
    private ?Series $series = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $rating = null;

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): static
    {
        $this->series = $series;
        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;
        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Untitled Episode';
    }
}