<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201080953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE baguette (id INT AUTO_INCREMENT NOT NULL, taille DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baguette_composant (baguette_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_B64AD903513FF34B (baguette_id), INDEX IDX_B64AD9037F3310E7 (composant_id), PRIMARY KEY(baguette_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, professeurs_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FDCA8C9C3E1D55D7 (professeurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, cours_id INT NOT NULL, INDEX IDX_CFBDFA147ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naiss DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baguette_composant ADD CONSTRAINT FK_B64AD903513FF34B FOREIGN KEY (baguette_id) REFERENCES baguette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE baguette_composant ADD CONSTRAINT FK_B64AD9037F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C3E1D55D7 FOREIGN KEY (professeurs_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA147ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE eleve ADD maison_id INT NOT NULL, ADD notes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F79D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7FC56F556 FOREIGN KEY (notes_id) REFERENCES note (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F79D67D8AF ON eleve (maison_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7FC56F556 ON eleve (notes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F79D67D8AF');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7FC56F556');
        $this->addSql('ALTER TABLE baguette_composant DROP FOREIGN KEY FK_B64AD903513FF34B');
        $this->addSql('ALTER TABLE baguette_composant DROP FOREIGN KEY FK_B64AD9037F3310E7');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C3E1D55D7');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA147ECF78B0');
        $this->addSql('DROP TABLE baguette');
        $this->addSql('DROP TABLE baguette_composant');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP INDEX IDX_ECA105F79D67D8AF ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F7FC56F556 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP maison_id, DROP notes_id');
    }
}
