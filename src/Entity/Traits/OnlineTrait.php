<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait OnlineTrait
{

    #[ORM\Column]
        private ?bool $online = null;


    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): static
    {
        $this->online = $online;
        return $this;
    }
}