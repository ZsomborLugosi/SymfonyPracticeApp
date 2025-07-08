<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\HasLifecycleCallbacks] // Erre továbbra is szükség van!
class Movie extends EntertainmentMedia
{
    #[ORM\Column(length: 255)]
    private ?string $director = null;

    #[ORM\Column(length: 255)]
    private ?string $streamingPlatform = null;

    // A 'cascade' és 'orphanRemoval' opciók eltávolítva!
    #[ORM\OneToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')] // onDelete hozzáadva
    private ?self $sequel = null;

    // A 'cascade' és 'orphanRemoval' opciók eltávolítva!
    #[ORM\OneToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')] // onDelete hozzáadva
    private ?self $prequel = null;

    /**
     * Törlés előtt megszakítja a hivatkozásokat a kapcsolódó entitásokon.
     * Ez a metódus biztosítja, hogy a másik film ne hivatkozzon
     * egy nem létező (közben törölt) filmre.
     */
    #[ORM\PreRemove]
    public function removePrequelAndSequelLinks(): void
    {
        if ($this->sequel !== null) {
            $this->sequel->setPrequel(null);
        }

        if ($this->prequel !== null) {
            $this->prequel->setSequel(null);
        }
    }

    // ... a többi getter és setter metódus változatlan ...

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