<?php
namespace App\Entity\Contracts;
interface DateAwareInterface { public function getDate(): ?\DateTimeInterface; public function setDate(\DateTimeInterface $date): self; }
