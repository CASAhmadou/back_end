<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[UniqueEntity(fields:'nom',message:'le nom doit etre unique')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "discr", type: "string")]
#[ORM\DiscriminatorMap(["produit" => "Produit", "boisson" => "Boisson","portionFrite" => "PortionFrite", "menu" => "Menu", "burger" =>"Burger" ])]
#[ApiResource]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["burger:read:simple","burger:read:all","write","write:boisson","com:write","catalogue:read:simple","complement:read:simple","detail","menu:write","com:read:all"])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:'le burger ne doit pas etre vide')]
    #[Groups(["burger:read:simple","menu:write","burger:read:all","write","write:boisson","catalogue:read:simple","complement:read:simple","detail","com:read:all"])]
    protected $nom;


    #[ORM\Column(type: 'float',nullable: true)]
    #[Groups(["menu:write","burger:read:simple","burger:read:all","write","catalogue:read:simple","complement:read:simple","detail","com:read:all"])]
    // #[Assert\Positive(message: 'le prix ne doit pas etre negatif')]
    protected $prix;

    #[ORM\Column(type: 'string', length: 255)]
    protected $etat="disponible";

    #[ORM\Column(type: 'text')]
    #[Groups(["menu:write","burger:read:simple","burger:read:all","write","write:boisson","detail","catalogue:read:simple"])] 
    #[Assert\NotBlank(message:'le burger doit avoir une description')]
    protected $description;

    #[ORM\Column(type: 'blob', nullable: true)]
    #[Groups(["write","write:boisson","burger:read:simple","burger:read:all","catalogue:read:simple","complement:read:simple","detail","com:read:all"])]
    protected $image;

    // #[ORM\Column(type: 'blob')]
    #[Groups(["write","write:boisson","menu:write"])]
    protected $imageBlob;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["menu:write","burger:read:simple","burger:read:all","catalogue:read:simple","detail"])] 
    protected ?string $type = null;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        if(is_resource($this->image)){
            return base64_encode(stream_get_contents($this->image));
        }elseif($this->image){
            return base64_encode($this->image);
        }
        return null;

        
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
 

    /**
     * Get the value of imageBlob
     */ 
    public function getImageBlob()
    {
        return $this->imageBlob;
    }

    /**
     * Set the value of imageBlob
     *
     * @return  self
     */ 
    public function setImageBlob($imageBlob)
    {
        $this->imageBlob = $imageBlob;

        return $this;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $test = true;
        if ($this instanceof Burger || $this instanceof PortionFrite || $this instanceof Menu){
            if ($this->getPrix() <= 0){
                $test = false;
            }
        }
        if ($test == false) {
            $context
                ->buildViolation("le prix doit ne doit pas etre negatif")
                ->addViolation()
            ;
        }
    }

    public function getType(): ?string
    {
        $app = get_called_class();
        $apps = str_replace("\\"," ",$app);
        $apps = explode(" ",$apps);
        $type =  $apps[2];
        return strtolower($type);
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
