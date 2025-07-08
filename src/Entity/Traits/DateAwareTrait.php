<?php
namespace App\Entity\Traits;
use Doctrine\DBAL\Types\Types; use Doctrine\ORM\Mapping as ORM;
trait DateAwareTrait {
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;
    public function getDate(): ?\DateTimeInterface { return $this->date; }
    public function setDate(\DateTimeInterface $date): self { $this->date = $date; return $this; }
}
