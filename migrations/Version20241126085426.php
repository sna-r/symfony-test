<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126085426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_etudiant (id SERIAL NOT NULL, id_etudiant VARCHAR(255) NOT NULL, idmatiere VARCHAR(255) NOT NULL, note NUMERIC(10, 0) NOT NULL, session DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE noteetudiant DROP CONSTRAINT noteetudiant_idetudiant_fkey');
        $this->addSql('ALTER TABLE noteetudiant DROP CONSTRAINT noteetudiant_idmatiere_fkey');
        $this->addSql('DROP TABLE noteetudiant');
        $this->addSql('ALTER TABLE matiere ALTER idmatiere TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE matiere ALTER nom SET NOT NULL');
        $this->addSql('ALTER TABLE matiere ALTER nom TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE matiere ALTER semestre SET NOT NULL');
        $this->addSql('ALTER TABLE matiere ALTER semestre TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE matiere ALTER credit SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE noteetudiant (idetudiant VARCHAR(50) NOT NULL, idmatiere VARCHAR(50) NOT NULL, note NUMERIC(10, 0) DEFAULT NULL, session DATE DEFAULT NULL, PRIMARY KEY(idetudiant, idmatiere))');
        $this->addSql('CREATE INDEX IDX_84900704DBAB6AEE ON noteetudiant (idetudiant)');
        $this->addSql('CREATE INDEX IDX_849007044F100524 ON noteetudiant (idmatiere)');
        $this->addSql('ALTER TABLE noteetudiant ADD CONSTRAINT noteetudiant_idetudiant_fkey FOREIGN KEY (idetudiant) REFERENCES etudiant (idetudiant) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE noteetudiant ADD CONSTRAINT noteetudiant_idmatiere_fkey FOREIGN KEY (idmatiere) REFERENCES matiere (idmatiere) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE note_etudiant');
        $this->addSql('ALTER TABLE matiere ALTER idmatiere TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE matiere ALTER nom DROP NOT NULL');
        $this->addSql('ALTER TABLE matiere ALTER nom TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE matiere ALTER semestre DROP NOT NULL');
        $this->addSql('ALTER TABLE matiere ALTER semestre TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE matiere ALTER credit DROP NOT NULL');
    }
}
