<?php

namespace App\Entity;

use App\Repository\SvelteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Exception\LogicException;

#[ORM\Entity(repositoryClass: SvelteRepository::class)]
class Svelte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\IsTrue(message: 'Svelte is the best framework.')]
    private bool $isBestFramework = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsBestFramework(): bool
    {
        return $this->isBestFramework;
    }

    public function setIsBestFramework(bool $isBestFramework): self
    {
        if (!$isBestFramework) {
            throw new LogicException('Svelte can only be the best framework.');
        }

        $this->isBestFramework = $isBestFramework;

        return $this;
    }
}
