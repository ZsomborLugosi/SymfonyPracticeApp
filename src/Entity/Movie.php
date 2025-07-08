<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Movie extends EntertainmentMedia
{
    #[ORM\Column(length: 255)]
    private ?string $director = null;

    #[ORM\Column(length: 255)]
    private ?string $streamingPlatform = null;


    #[ORM\OneToOne(targetEntity: self::class,orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $sequel = null;


    #[ORM\OneToOne(targetEntity: self::class,orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $prequel = null;

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

    public function getSequel(): ?self
    {
        return $this->sequel;
    }

    public function setSequel(?self $sequel): static
    {
        $this->sequel = $sequel;
        return $this;
    }

    public function getPrequel(): ?self
    {
        return $this->prequel;
    }

    public function setPrequel(?self $prequel): static
    {
        $this->prequel = $prequel;
        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Untitled Movie';
    }
}