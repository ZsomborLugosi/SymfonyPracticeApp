<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode extends EntertainmentMedia
{

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $rating = null;

    #[ORM\ManyToOne(targetEntity: Series::class, inversedBy: 'episodes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Series $series = null;


    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;
        return $this;
    }

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): static
    {
        $this->series = $series;
        return $this;
    }
}