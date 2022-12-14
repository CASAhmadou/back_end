<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuTailleBoissonRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MenuTailleBoissonRepository::class)]
#[ApiResource()]
class MenuTailleBoisson
{
    #[ORM\Id]   
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["com:write"])]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["menu:write","burger:read:all","write","burger:read:simple","detail"])]
    #[Assert\Positive(message:'la quantite doit etre egal au moins a 1')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuTailleBoissons')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'menuTailleBoissons')]
    #[Groups(["menu:write","burger:read:all","write","burger:read:simple","detail"])]
    private $tailleBoisson;

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

    public function getTailleBoisson(): ?TailleBoisson
    {
        return $this->tailleBoisson;
    }

    public function setTailleBoisson(?TailleBoisson $tailleBoisson): self
    {
        $this->tailleBoisson = $tailleBoisson;

        return $this;
    }
}
