<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Gestionnaire;
use App\Entity\Livreur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher){
      
        $this->passwordHasher = $passwordHasher ;
    }

    public function load(ObjectManager $manager): void
    {
        $user=new Client();
        $user->setLogin('client@gmail.com');
        $user->setNom('Sakho');
        $user->setPrenom('Dieynaba');
        $user->setAdresse("Dakar");
        $user->setTelephone("762208564");
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user,
        'client'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_CLIENT']);

        $user1=new Gestionnaire();
        $user1->setLogin('gestionnaire@gmail.com');
        $user1->setNom('Sakho');
        $user1->setPrenom('CAS');
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user1,
        'gestionnaire'
        );
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_GESTIONNAIRE']);

        $user3=new Client();
        $user3->setLogin('client1@gmail.com');
        $user3->setNom('Deme');
        $user3->setPrenom('Abdoulaye');
        $user3->setAdresse("Thiaroye");
        $user3->setTelephone("701234567");
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user3,
        'client'
        );
        $user3->setPassword($hashedPassword);
        $user3->setRoles(['ROLE_CLIENT']);

        $user4=new Livreur();
        $user4->setLogin('livreur@gmail.com');
        $user4->setNom('Ba');
        $user4->setPrenom('Aminata');
        $user4->setMatriculeMoto('L00123');
        $user4->setTelephone('750120786');
        $hash4dPassword = $this->passwordHasher->hashPassword(
        $user4,
        'livreur'
        );
        $user4->setPassword($hashedPassword);
        $user4->setRoles(['ROLE_LIVREUR']);

        $user5=new Livreur();
        $user5->setLogin('livreur1@gmail.com');
        $user5->setNom('Ndiaye');
        $user5->setPrenom('Abdoulaye');
        $user5->setMatriculeMoto('L00456');
        $user5->setTelephone('782377733');
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user5,
        'livreur'
        );
        $user5->setPassword($hashedPassword);
        $user5->setRoles(['ROLE_LIVREUR']);
        
        $manager->persist($user1);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->flush();
    }
}
