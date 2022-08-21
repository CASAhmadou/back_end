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
        // $user=new Client();
        // $user->setLogin('client@gmail.com');
        // $user->setNom('Sakho');
        // $user->setPrenom('Dieyna');
        // $user->setAdresse("Dakar");
        // $user->setTelephone("762208564");
        // $hashedPassword = $this->passwordHasher->hashPassword(
        // $user,
        // 'cas'
        // );
        // $user->setPassword($hashedPassword);
        // $user->setRoles(['ROLE_CLIENT']);

        $user2=new Gestionnaire();
        $user2->setLogin('gestionnaire1@gmail.com');
        $user2->setNom('Sarr');
        $user2->setPrenom('Bintou');
        $hashedPassword = $this->passwordHasher->hashPassword(
        $user2,
        'gestionnaire'
        );
        $user2->setPassword($hashedPassword);
        $user2->setRoles(['ROLE_GESTIONNAIRE']);

        $user3=new Client();
        $user3->setLogin('client1@gmail.com');
        $user3->setNom('Deme');
        $user3->setPrenom('Abdoulaye');
        $user3->setAdresse("Thiaroye");
        $user3->setTelephone("701234567");
        $has3dPassword = $this->passwordHasher->hashPassword(
        $user3,
        'client'
        );
        $user3->setPassword($hashedPassword);
        $user3->setRoles(['ROLE_CLIENT']);

        $user4=new Livreur();
        $user4->setLogin('livreur@gmail.com');
        $user4->setNom('Ndiaye');
        $user4->setPrenom('Abdoulaye');
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
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->flush();
    }
}
