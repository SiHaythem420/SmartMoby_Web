<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250411130533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conducteur ADD CONSTRAINT FK_23677143BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenment ADD CONSTRAINT FK_27EC167B9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)
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
            ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE conducteur DROP FOREIGN KEY FK_23677143BF396750
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenment DROP FOREIGN KEY FK_27EC167B9F34925F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE fedback DROP FOREIGN KEY FK_D0BF7EED52B4B97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE organisateur DROP FOREIGN KEY FK_4BD76D44BF396750
        SQL);
    }
}
