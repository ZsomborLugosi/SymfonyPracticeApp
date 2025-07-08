<?php
namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie extends EntertainmentMedia
{

    #[ORM\Column(length: 255)]
    private ?string $director = null;
    #[ORM\Column(length: 255)]
    private ?string $streamingPlatform = null;
    public function getDirector(): ?string { return $this->director; }
    public function setDirector(string $director): static { $this->director = $director; return $this; }
    public function getStreamingPlatform(): ?string { return $this->streamingPlatform; }
    public function setStreamingPlatform(string $streamingPlatform): static { $this->streamingPlatform = $streamingPlatform; return $this; }
}
