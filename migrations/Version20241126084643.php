<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126084643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE etudiant_id_seq CASCADE');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT etudiant_pkey');
        $this->addSql('ALTER TABLE etudiant DROP id');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (idetudiant)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE etudiant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE matiere (idmatiere VARCHAR(50) NOT NULL, nom VARCHAR(50) DEFAULT NULL, semestre VARCHAR(50) DEFAULT NULL, credit INT DEFAULT NULL, PRIMARY KEY(idmatiere))');
        $this->addSql('DROP INDEX etudiant_pkey');
        $this->addSql('ALTER TABLE etudiant ADD id SERIAL NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (id)');
    }
}
