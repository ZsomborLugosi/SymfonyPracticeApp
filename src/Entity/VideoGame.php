<?php

namespace App\Entity;

use App\Repository\VideoGameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoGameRepository::class)]
class VideoGame extends EntertainmentMedia
{
    #[ORM\Column(length: 255)]
    private ?string $developer = null;

    public function getDeveloper(): ?string
    {
        return $this->developer;
    }

    public function setDeveloper(string $developer): static
    {
        $this->developer = $developer;
        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? 'Untitled Game';
    }
}