<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuPortionFriteRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MenuPortionFriteRepository::class)]
#[ApiResource()]
class MenuPortionFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["menu:write","burger:read:all","write","burger:read:simple","detail"])]
    #[Assert\Positive(message:'la quantite doit etre egal au moins a 1')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuPortionFrites')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'menuPortionFrites')]
    #[Groups(["menu:write","burger:read:all","write","burger:read:simple","detail"])]
    private $portionFrite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getPortionFrite(): ?PortionFrite
    {
        return $this->portionFrite;
    }

    public function setPortionFrite(?PortionFrite $portionFrite): self
    {
        $this->portionFrite = $portionFrite;

        return $this;
    }
}
