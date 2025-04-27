<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424205046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE `admin` (id INT NOT NULL, departement VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE avis (avis_id INT AUTO_INCREMENT NOT NULL, blog_id INT NOT NULL, name VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_8F91ABF0DAE07E97 (blog_id), PRIMARY KEY(avis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE blog (blog_id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, is_featured TINYINT(1) NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(blog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE conducteur (id INT NOT NULL, numero_permis INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evenment (id_event INT NOT NULL, nom VARCHAR(50) NOT NULL, date DATE NOT NULL, lieu VARCHAR(50) NOT NULL, PRIMARY KEY(id_event)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE fedback (id INT NOT NULL, id_event INT DEFAULT NULL, commentaire VARCHAR(250) NOT NULL, note INT NOT NULL, INDEX IDX_D0BF7EED52B4B97 (id_event), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE organisateur (id INT NOT NULL, num_badge INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE produit (idproduit INT NOT NULL, nom VARCHAR(100) NOT NULL, type VARCHAR(100) NOT NULL, prix INT NOT NULL, PRIMARY KEY(idproduit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE service (id_service INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, tarif DOUBLE PRECISION NOT NULL, PRIMARY KEY(id_service)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE trajet (id INT NOT NULL, point_d VARCHAR(100) NOT NULL, point_a VARCHAR(100) NOT NULL, date_d DATETIME NOT NULL, date_a DATETIME NOT NULL, distance DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, id_veh INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT NOT NULL, nom VARCHAR(200) NOT NULL, prenom VARCHAR(200) NOT NULL, nom_utilisateur VARCHAR(200) NOT NULL, email VARCHAR(200) NOT NULL, mot_de_passe VARCHAR(200) NOT NULL, role VARCHAR(255) NOT NULL, reset_code VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vehicule (id INT NOT NULL, type VARCHAR(50) NOT NULL, capacite INT NOT NULL, statut VARCHAR(50) NOT NULL, dispo TINYINT(1) NOT NULL, conducteur_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (blog_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conducteur ADD CONSTRAINT FK_23677143BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fedback ADD CONSTRAINT FK_D0BF7EED52B4B97 FOREIGN KEY (id_event) REFERENCES evenment (id_event) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE organisateur ADD CONSTRAINT FK_4BD76D44BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0DAE07E97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conducteur DROP FOREIGN KEY FK_23677143BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fedback DROP FOREIGN KEY FK_D0BF7EED52B4B97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE organisateur DROP FOREIGN KEY FK_4BD76D44BF396750
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `admin`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE avis
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE blog
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE conducteur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evenment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE fedback
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE organisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE produit
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE trajet
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vehicule
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
