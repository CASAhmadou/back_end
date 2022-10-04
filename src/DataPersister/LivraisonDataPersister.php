<?php
namespace App\DataPersister;

use App\Entity\Livraison;
use App\Service\CalculMontantTotal;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

    class LivraisonDataPersister implements DataPersisterInterface{
        private EntityManagerInterface $entityManager;
        public function __construct(
        EntityManagerInterface $entityManager,
        CalculMontantTotal $montant
        )
        {
            $this->entityManager = $entityManager;
            $this-> montant = $montant;
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
            $montantTotal = 0;
            $commandes = $data->getCommandes();
            foreach ($commandes as $commande) {
                $montantTotal+=$commande->getMontantCommande();
            }
            $data->setMontantTotal($montantTotal);
            $data->getLivreur()->setEtat("indisponible");
            // dd($data);
        
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        public function remove($data)
        {
            $this->entityManager->remove($data);
            $this->entityManager->flush();
        }
}