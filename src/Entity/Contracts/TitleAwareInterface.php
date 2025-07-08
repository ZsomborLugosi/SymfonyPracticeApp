<?php
namespace App\Entity\Contracts;
interface TitleAwareInterface { public function getTitle(): ?string; public function setTitle(string $title): self; }
