<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations:[
        "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:simple']],
        ]
    ,"post"=>[
        'method'=>'post',
        'denormalization_context' => ['groups' => ['menu:write']],
        'normalization_context' => ['groups' => ['burger:read:all']],
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        'input_formats' => [
            'multipart' => ['multipart/form-data'],
        ]
    ]],
    itemOperations:["put"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        'denormalization_context' => ['groups' => ['write']],
    ],
    "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['burger:read:all']],
        ],
    "delete"=>[
        "security"=>"is_granted('ROLE_GESTIONNAIRE')",
        "security_message"=>"Vous n'avez pas access à cette Ressource",
        ]
    ],
  
)]
class Menu extends Produit
{
   

  
    private $catalogue;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class,cascade:['persist'])]
    #[Groups(["burger:read:simple","burger:read:all","write","detail","menu:write"])]
    #[Assert\Count(min:1,minMessage:'le menu doit avoir minimum un burger')]
    #[Assert\Valid]
    private $menuBurgers;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuPortionFrite::class,cascade:['persist'])]
    #[Groups(["burger:read:simple","burger:read:all","write","detail","menu:write"])]
    #[Assert\Valid]
    private $menuPortionFrites;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTailleBoisson::class,cascade:['persist'])]
    #[Groups(["burger:read:simple","burger:read:all","write","detail","menu:write"])]
    #[Assert\Valid]
    private $menuTailleBoissons;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuCommande::class)]
    private $menuCommandes;

    #[ORM\OneToMany(mappedBy: 'menus', targetEntity: CommandeMenuBoissonTaille::class,cascade:['persist'])]
    #[Groups(["com:write"])]
    private $commandeMenuBoissonTailles;

    private Collection $details;

    public function __construct()
    { 
        $this->complements = new ArrayCollection();
        $this->menuBurgers = new ArrayCollection();
        $this->menuPortionFrites = new ArrayCollection();
        $this->menuTailleBoissons = new ArrayCollection();
        $this->burgerCommandes = new ArrayCollection();
        $this->menuCommandes = new ArrayCollection();
        $this->commandeMenuBoissonTailles = new ArrayCollection();
        $this->type='menu';
        $this->details = new ArrayCollection();
    }

    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;
        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }


    
    /**
     * @return Collection<int, MenuBurger>
     */
    public function getMenuBurgers(): Collection
    {
        return $this->menuBurgers;
    }

    public function addMenuBurger(MenuBurger $menuBurger): self
    {
        if (!$this->menuBurgers->contains($menuBurger)) {
            $this->menuBurgers[] = $menuBurger;
            $menuBurger->setMenu($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getMenu() === $this) {
                $menuBurger->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuPortionFrite>
     */
    public function getMenuPortionFrites(): Collection
    {
        return $this->menuPortionFrites;
    }

    public function addMenuPortionFrite(MenuPortionFrite $menuPortionFrite): self
    {
        if (!$this->menuPortionFrites->contains($menuPortionFrite)) {
            $this->menuPortionFrites[] = $menuPortionFrite;
            $menuPortionFrite->setMenu($this);
        }

        return $this;
    }

    public function removeMenuPortionFrite(MenuPortionFrite $menuPortionFrite): self
    {
        if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuPortionFrite->getMenu() === $this) {
                $menuPortionFrite->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuTailleBoisson>
     */
    public function getMenuTailleBoissons(): Collection
    {
        return $this->menuTailleBoissons;
    }

    public function addMenuTailleBoisson(MenuTailleBoisson $menuTailleBoisson): self
    {
        if (!$this->menuTailleBoissons->contains($menuTailleBoisson)) {
            $this->menuTailleBoissons[] = $menuTailleBoisson;
            $menuTailleBoisson->setMenu($this);
        }

        return $this;
    }

    public function removeMenuTailleBoisson(MenuTailleBoisson $menuTailleBoisson): self
    {
        if ($this->menuTailleBoissons->removeElement($menuTailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($menuTailleBoisson->getMenu() === $this) {
                $menuTailleBoisson->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuCommande>
     */
    public function getMenuCommandes(): Collection
    {
        return $this->menuCommandes;
    }

    public function addMenuCommande(MenuCommande $menuCommande): self
    {
        if (!$this->menuCommandes->contains($menuCommande)) {
            $this->menuCommandes[] = $menuCommande;
            $menuCommande->setMenu($this);
        }

        return $this;
    }

    public function removeMenuCommande(MenuCommande $menuCommande): self
    {
        if ($this->menuCommandes->removeElement($menuCommande)) {
            if ($menuCommande->getMenu() === $this) {
                $menuCommande->setMenu(null);
            }
        }

        return $this;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $test = false;
        $menuBurgers =$this->getMenuBurgers();
        $nbrMB = count($menuBurgers);
       
        for($i=0;$i<$nbrMB;$i++){
            $id0 = $menuBurgers[$i]->getBurger()->getId();
            for($j=$i+1;$j<$nbrMB;$j++){
                if($id0 == $menuBurgers[$j]->getBurger()->getId()){
                    $test = true;
                }
            }
        }
        
        $frites = count($this->getMenuPortionFrites());
        $boissons = count($this->getMenuTailleBoissons());
        if ($frites==0 && $boissons==0) {
            $context
                ->buildViolation("le menu doit avoir au moins un complement !")
                ->addViolation()
            ;
        }
        if ($test == true) {
            $context
                ->buildViolation("Vous avez mis deux fois le mm burger pour des quantites differents")
                ->addViolation()
            ;
        }
    }

    /**
     * @return Collection<int, CommandeMenuBoissonTaille>
     */
    public function getCommandeMenuBoissonTailles(): Collection
    {
        return $this->commandeMenuBoissonTailles;
    }

    public function addCommandeMenuBoissonTaille(CommandeMenuBoissonTaille $commandeMenuBoissonTaille): self
    {
        if (!$this->commandeMenuBoissonTailles->contains($commandeMenuBoissonTaille)) {
            $this->commandeMenuBoissonTailles[] = $commandeMenuBoissonTaille;
            $commandeMenuBoissonTaille->setMenus($this);
        }

        return $this;
    }

    public function removeCommandeMenuBoissonTaille(CommandeMenuBoissonTaille $commandeMenuBoissonTaille): self
    {
        if ($this->commandeMenuBoissonTailles->removeElement($commandeMenuBoissonTaille)) {
            // set the owning side to null (unless already changed)
            if ($commandeMenuBoissonTaille->getMenus() === $this) {
                $commandeMenuBoissonTaille->setMenus($this);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Detail>
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details->add($detail);
            $detail->setMenu($this);
        }

        return $this;
    }

    public function removeDetail(Detail $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getMenu() === $this) {
                $detail->setMenu(null);
            }
        }

        return $this;
    }

   
}
