<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait ContentTrait {
	#[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}

?>