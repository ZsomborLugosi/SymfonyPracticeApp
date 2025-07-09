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

    // Sequel kapcsolat - ha ezt a filmet törlik, a sequel sequel_id mezője NULL lesz
    #[ORM\OneToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?self $sequel = null;

    // Prequel kapcsolat - ha ezt a filmet törlik, a prequel prequel_id mezője NULL lesz
    #[ORM\OneToOne(targetEntity: self::class)]
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

    /**
     * Lifecycle callback - ez fut le a film törlése előtt
     * Automatikusan NULL-ra állítja azokat a filmeket, amelyeknek ez a film a sequel-je vagy prequel-je
     */
    #[ORM\PreRemove]
    public function onPreRemove(): void
    {
        // Ha van sequel, annak a prequel-jét NULL-ra állítjuk
        if ($this->sequel) {
            $this->sequel->setPrequel(null);
        }

        // Ha van prequel, annak a sequel-jét NULL-ra állítjuk
        if ($this->prequel) {
            $this->prequel->setSequel(null);
        }
    }

    public function __toString(): string
    {
        return $this->title ?? 'Untitled Movie';
    }
}