<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait UsernameTrait {
	#[ORM\Column(length: 100)]
    private ?string $username = null;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}

?>