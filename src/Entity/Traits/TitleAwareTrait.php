<?php
namespace App\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;
trait TitleAwareTrait {
    #[ORM\Column(length: 255)]
    private ?string $title = null;
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
}
