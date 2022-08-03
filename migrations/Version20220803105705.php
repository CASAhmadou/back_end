<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803105705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, INDEX IDX_8B97C84D6885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson_commande (id INT AUTO_INCREMENT NOT NULL, boisson_taille_boisson_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_98ACF766D728648C (boisson_taille_boisson_id), INDEX IDX_98ACF76682EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson_taille_boisson (id INT AUTO_INCREMENT NOT NULL, boisson_id INT DEFAULT NULL, taille_boisson_id INT DEFAULT NULL, stock INT NOT NULL, INDEX IDX_3AAEDEC8734B8089 (boisson_id), INDEX IDX_3AAEDEC88421F13F (taille_boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE burger (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, INDEX IDX_EFE35A0D6885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE burger_commande (id INT AUTO_INCREMENT NOT NULL, burger_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_A0D9FE9917CE5090 (burger_id), INDEX IDX_A0D9FE9982EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, livraison_id INT DEFAULT NULL, gestionnaire_id INT DEFAULT NULL, client_id INT NOT NULL, zone_id INT DEFAULT NULL, numero_commande VARCHAR(255) NOT NULL, date_commande DATETIME NOT NULL, etat VARCHAR(255) NOT NULL, montant_commande VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67D8E54FB25 (livraison_id), INDEX IDX_6EEAA67D6885AC1B (gestionnaire_id), INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D9F2C3FAB (zone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_menu_boisson_taille (id INT AUTO_INCREMENT NOT NULL, commandes_id INT DEFAULT NULL, menus_id INT DEFAULT NULL, boisson_tailles_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_5AF24E318BF5C2E6 (commandes_id), INDEX IDX_5AF24E3114041B84 (menus_id), INDEX IDX_5AF24E31AFB63D80 (boisson_tailles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frite_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, portion_frite_id INT DEFAULT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_15E13BF882EA2E54 (commande_id), INDEX IDX_15E13BF89B17FA7B (portion_frite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionnaire (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, montant_total DOUBLE PRECISION NOT NULL, INDEX IDX_A60C9F1FF8646701 (livreur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT NOT NULL, matricule_moto VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, INDEX IDX_7D053A936885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_burger (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, burger_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_3CA402D5CCD7E912 (menu_id), INDEX IDX_3CA402D517CE5090 (burger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_commande (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_42BBE3EBCCD7E912 (menu_id), INDEX IDX_42BBE3EB82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_portion_frite (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, portion_frite_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_29FA693BCCD7E912 (menu_id), INDEX IDX_29FA693B9B17FA7B (portion_frite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_taille_boisson (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, taille_boisson_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_4030374CCCD7E912 (menu_id), INDEX IDX_4030374C8421F13F (taille_boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portion_frite (id INT NOT NULL, gestionnaire_id INT DEFAULT NULL, INDEX IDX_8F393CAD6885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, etat VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image LONGBLOB DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, zone_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_FEE8962D9F2C3FAB (zone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson (id INT AUTO_INCREMENT NOT NULL, prix INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, token VARCHAR(255) DEFAULT NULL, expired_at DATETIME DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_commande ADD CONSTRAINT FK_98ACF766D728648C FOREIGN KEY (boisson_taille_boisson_id) REFERENCES boisson_taille_boisson (id)');
        $this->addSql('ALTER TABLE boisson_commande ADD CONSTRAINT FK_98ACF76682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE boisson_taille_boisson ADD CONSTRAINT FK_3AAEDEC8734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE boisson_taille_boisson ADD CONSTRAINT FK_3AAEDEC88421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_commande ADD CONSTRAINT FK_A0D9FE9917CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE burger_commande ADD CONSTRAINT FK_A0D9FE9982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille ADD CONSTRAINT FK_5AF24E318BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille ADD CONSTRAINT FK_5AF24E3114041B84 FOREIGN KEY (menus_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille ADD CONSTRAINT FK_5AF24E31AFB63D80 FOREIGN KEY (boisson_tailles_id) REFERENCES boisson_taille_boisson (id)');
        $this->addSql('ALTER TABLE frite_commande ADD CONSTRAINT FK_15E13BF882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE frite_commande ADD CONSTRAINT FK_15E13BF89B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id)');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A936885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE menu_commande ADD CONSTRAINT FK_42BBE3EBCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_commande ADD CONSTRAINT FK_42BBE3EB82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_portion_frite ADD CONSTRAINT FK_29FA693B9B17FA7B FOREIGN KEY (portion_frite_id) REFERENCES portion_frite (id)');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_taille_boisson ADD CONSTRAINT FK_4030374C8421F13F FOREIGN KEY (taille_boisson_id) REFERENCES taille_boisson (id)');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CAD6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson_taille_boisson DROP FOREIGN KEY FK_3AAEDEC8734B8089');
        $this->addSql('ALTER TABLE boisson_commande DROP FOREIGN KEY FK_98ACF766D728648C');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille DROP FOREIGN KEY FK_5AF24E31AFB63D80');
        $this->addSql('ALTER TABLE burger_commande DROP FOREIGN KEY FK_A0D9FE9917CE5090');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D517CE5090');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE boisson_commande DROP FOREIGN KEY FK_98ACF76682EA2E54');
        $this->addSql('ALTER TABLE burger_commande DROP FOREIGN KEY FK_A0D9FE9982EA2E54');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille DROP FOREIGN KEY FK_5AF24E318BF5C2E6');
        $this->addSql('ALTER TABLE frite_commande DROP FOREIGN KEY FK_15E13BF882EA2E54');
        $this->addSql('ALTER TABLE menu_commande DROP FOREIGN KEY FK_42BBE3EB82EA2E54');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D6885AC1B');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D6885AC1B');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6885AC1B');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A936885AC1B');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CAD6885AC1B');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FF8646701');
        $this->addSql('ALTER TABLE commande_menu_boisson_taille DROP FOREIGN KEY FK_5AF24E3114041B84');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D5CCD7E912');
        $this->addSql('ALTER TABLE menu_commande DROP FOREIGN KEY FK_42BBE3EBCCD7E912');
        $this->addSql('ALTER TABLE menu_portion_frite DROP FOREIGN KEY FK_29FA693BCCD7E912');
        $this->addSql('ALTER TABLE menu_taille_boisson DROP FOREIGN KEY FK_4030374CCCD7E912');
        $this->addSql('ALTER TABLE frite_commande DROP FOREIGN KEY FK_15E13BF89B17FA7B');
        $this->addSql('ALTER TABLE menu_portion_frite DROP FOREIGN KEY FK_29FA693B9B17FA7B');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DBF396750');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93BF396750');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CADBF396750');
        $this->addSql('ALTER TABLE boisson_taille_boisson DROP FOREIGN KEY FK_3AAEDEC88421F13F');
        $this->addSql('ALTER TABLE menu_taille_boisson DROP FOREIGN KEY FK_4030374C8421F13F');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE gestionnaire DROP FOREIGN KEY FK_F4461B20BF396750');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DBF396750');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F2C3FAB');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE boisson_commande');
        $this->addSql('DROP TABLE boisson_taille_boisson');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE burger_commande');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_menu_boisson_taille');
        $this->addSql('DROP TABLE frite_commande');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE menu_commande');
        $this->addSql('DROP TABLE menu_portion_frite');
        $this->addSql('DROP TABLE menu_taille_boisson');
        $this->addSql('DROP TABLE portion_frite');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE taille_boisson');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE zone');
    }
}
