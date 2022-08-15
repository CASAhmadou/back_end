<?php
namespace App\DataPersister;

use DateTime;
use App\Service\Mailer;
use App\Entity\Commande;
use App\Service\GenererNumCom;
use App\Service\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Burger;
use App\Entity\BurgerCommande;
use App\Entity\Livraison;
use App\Entity\Livreur;
use App\Service\CalculMontantTotal;
use App\Service\MontantCommande;

class LivrableDataPersister implements DataPersisterInterface
{

    private EntityManagerInterface $entityManager;
    public function __construct(
    EntityManagerInterface $entityManager,
    CalculMontantTotal $montant
    )
    {
        $this->entityManager = $entityManager;
        $this->montant = $montant;
    }
    public function supports($data): bool
    {
        return $data instanceof Livraison;
    }
    /**
    * @param Livraison $data
    */
    public function persist($data)
    {
        $montantTo = $this->montant->CalculMontant($data);
        $data->setMontantTotal($montantTo);
     
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
  

}
