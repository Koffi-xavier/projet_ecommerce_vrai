<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220927150007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, parentfour_id INT DEFAULT NULL, parentprix_id INT DEFAULT NULL, libelle VARCHAR(100) NOT NULL, quantite NUMERIC(10, 0) NOT NULL, date_arrive DATE NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BFDD3168727ACA70 (parent_id), INDEX IDX_BFDD3168538C24E1 (parentfour_id), INDEX IDX_BFDD3168226706B7 (parentprix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clear (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, lieu_naissance VARCHAR(50) NOT NULL, contacts VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, date_naissance VARCHAR(50) NOT NULL, date_naissanc DATE NOT NULL, INDEX IDX_C82E74727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, article_id INT DEFAULT NULL, date_commande DATE NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, contacts VARCHAR(15) DEFAULT NULL, email VARCHAR(30) NOT NULL, situation_geographique VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraisons (id INT AUTO_INCREMENT NOT NULL, parents_id INT DEFAULT NULL, paren_id INT DEFAULT NULL, date_livraison DATE NOT NULL, lieu_livraison VARCHAR(100) NOT NULL, parent VARCHAR(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_96A0CE61B706B6D3 (parents_id), INDEX IDX_96A0CE61B172C14D (paren_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, contacts VARCHAR(15) NOT NULL, commune VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_articles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_livraison (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168727ACA70 FOREIGN KEY (parent_id) REFERENCES livraisons (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168538C24E1 FOREIGN KEY (parentfour_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168226706B7 FOREIGN KEY (parentprix_id) REFERENCES prix_articles (id)');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74727ACA70 FOREIGN KEY (parent_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE livraisons ADD CONSTRAINT FK_96A0CE61B706B6D3 FOREIGN KEY (parents_id) REFERENCES livreurs (id)');
        $this->addSql('ALTER TABLE livraisons ADD CONSTRAINT FK_96A0CE61B172C14D FOREIGN KEY (paren_id) REFERENCES type_livraison (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168727ACA70');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168538C24E1');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168226706B7');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E74727ACA70');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7294869C');
        $this->addSql('ALTER TABLE livraisons DROP FOREIGN KEY FK_96A0CE61B706B6D3');
        $this->addSql('ALTER TABLE livraisons DROP FOREIGN KEY FK_96A0CE61B172C14D');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE clear');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE livraisons');
        $this->addSql('DROP TABLE livreurs');
        $this->addSql('DROP TABLE prix_articles');
        $this->addSql('DROP TABLE type_livraison');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
